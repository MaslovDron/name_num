<?php
$errMsg='';
$birthDate='';
$chdate='';
$ch1='';
 $Pifagor=selectOne('calc', ['id'=>2]);
//в админке
if($_SERVER['REQUEST_METHOD']=='POST' && isset ($_POST['TablPif']))
{
    
    // 1. Получаем дату
    $birthDate = $_POST['daterozd'] ?? '';
    
    if (empty($birthDate)) {
        $errMsg .='Вы не ввели дату<br>';
    }
    
    // 2. Валидация даты
    $date = DateTime::createFromFormat('Y-m-d', $birthDate);
    if (!$date) {
        // $_SESSION['error'] = "Неверный формат даты. Используйте ГГГГ-ММ-ДД";
        // header('Location: pythagoras-form.php');
        // exit;
        $errMsg.='Вы некорректно ввели дату<br>';
    }
    if(empty($errMsg)){
    // 3. Извлекаем числа
    $day = (int)$date->format('d');
    $month = (int)$date->format('m');
    $year = (int)$date->format('Y');
 
     $firstNumber = sumDigits($day) + sumDigits($month) + sumDigits($year);//первое рабочее число
     $secondNumber = sumDigits($firstNumber);//второе рабочее число
     $firstDigitOfDay = (int)substr((string)$day, 0, 1);
    $thirdNumber = $firstNumber - 2 * $firstDigitOfDay;//3-е рабочее число
    if ($thirdNumber < 0) $thirdNumber = abs($thirdNumber);
    $fourthNumber = sumDigits($thirdNumber);//4 рабочее число
    
    // 6. Матрица Пифагора
    $allDigits = $day . $month . $year . $firstNumber . $secondNumber . $thirdNumber . $fourthNumber;
    
    // Инициализируем матрицу
    $matrix = [
        1 => 0, 2 => 0, 3 => 0,
        4 => 0, 5 => 0, 6 => 0,
        7 => 0, 8 => 0, 9 => 0
    ];
    
    // Заполняем матрицу
    for ($i = 0; $i < strlen($allDigits); $i++) {
        $digit = (int)$allDigits[$i];
        if ($digit >= 1 && $digit <= 9) {
            $matrix[$digit]++;
        }
    }
    
    // ==================== РАСШИРЕННЫЕ ИНТЕРПРЕТАЦИИ ПО ЯЧЕЙКАМ ====================
    
    $interpretations = [];
    
    // 1️⃣ ХАРАКТЕР, ВОЛЯ, ЛИДЕРСТВО
    $cell1 = $matrix[1];
    $interpretations[] = getCharacterAnalysis($cell1);
    
    // 2️⃣ ЭНЕРГИЯ, ЭМОЦИИ, ЧУВСТВИТЕЛЬНОСТЬ
    $cell2 = $matrix[2];
    $interpretations[] = getEnergyAnalysis($cell2);
    
    // 3️⃣ ИНТЕРЕС К НАУКЕ, ТЕХНИКЕ, ЛЮБОЗНАТЕЛЬНОСТЬ
    $cell3 = $matrix[3];
    $interpretations[] = getIntelligenceAnalysis($cell3);
    
    // 4️⃣ ЗДОРОВЬЕ, СИЛА, ВЫНОСЛИВОСТЬ
    $cell4 = $matrix[4];
    $interpretations[] = getHealthAnalysis($cell4);
    
    // 5️⃣ ЛОГИКА, ИНТУИЦИЯ, ПРОГНОЗИРОВАНИЕ
    $cell5 = $matrix[5];
    $interpretations[] = getLogicAnalysis($cell5);
    
    // 6️⃣ СКЛОННОСТЬ К ФИЗИЧЕСКОМУ ТРУДУ, ЗЕМНЫЕ ДЕЛА
    $cell6 = $matrix[6];
    $interpretations[] = getPhysicalAnalysis($cell6);
    
    // 7️⃣ ВЕЗЕНИЕ, ТАЛАНТЫ, УДАЧА
    $cell7 = $matrix[7];
    $interpretations[] = getLuckAnalysis($cell7);
    
    // 8️⃣ ЧУВСТВО ДОЛГА, ОТВЕТСТВЕННОСТЬ, ТЕРПЕНИЕ
    $cell8 = $matrix[8];
    $interpretations[] = getDutyAnalysis($cell8);
    
    // 9️⃣ УМ, ПАМЯТЬ, ЭРУДИЦИЯ
    $cell9 = $matrix[9];
    $interpretations[] = getMindAnalysis($cell9);
    
    // ==================== АНАЛИЗ ЛИНИЙ МАТРИЦЫ ====================
    
    $lines_analysis = [];
    
    // 📌 ВЕРТИКАЛЬНЫЕ ЛИНИИ (СТОЛБЦЫ)
    
    // Столбец 1-4-7: САМООЦЕНКА
    // Формула: сумма ячеек 1 + 4 + 7
    $column1 = $matrix[1] + $matrix[4] + $matrix[7];
    $lines_analysis[] = getColumn1Analysis($column1);
    
    // Столбец 2-5-8: МАТЕРИАЛЬНОЕ БЛАГОСОСТОЯНИЕ
    // Формула: сумма ячеек 2 + 5 + 8
    $column2 = $matrix[2] + $matrix[5] + $matrix[8];
    $lines_analysis[] = getColumn2Analysis($column2);
    
    // Столбец 3-6-9: ТВОРЧЕСКИЙ ПОТЕНЦИАЛ, ТАЛАНТЫ
    // Формула: сумма ячеек 3 + 6 + 9
    $column3 = $matrix[3] + $matrix[6] + $matrix[9];
    $lines_analysis[] = getColumn3Analysis($column3);
    
    // 📌 ГОРИЗОНТАЛЬНЫЕ ЛИНИИ (СТРОКИ)
    
    // Строка 1-2-3: ЦЕЛЕУСТРЕМЛЁННОСТЬ
    // Формула: сумма ячеек 1 + 2 + 3
    $line1 = $matrix[1] + $matrix[2] + $matrix[3];
    $lines_analysis[] = getLine1Analysis($line1);
    
    // Строка 4-5-6: СЕМЕЙНОСТЬ, БЫТ, ПРИВЯЗАННОСТЬ К ДОМУ
    // Формула: сумма ячеек 4 + 5 + 6
    $line2 = $matrix[4] + $matrix[5] + $matrix[6];
    $lines_analysis[] = getLine2Analysis($line2);
    
    // Строка 7-8-9: ДУХОВНОСТЬ, ТАЛАНТЫ, ИНТЕРЕСЫ
    // Формула: сумма ячеек 7 + 8 + 9
    $line3 = $matrix[7] + $matrix[8] + $matrix[9];
    $lines_analysis[] = getLine3Analysis($line3);
    
    // 📌 ДИАГОНАЛЬНЫЕ ЛИНИИ
    
    // Диагональ 1-5-9: ДУХОВНАЯ СТАБИЛЬНОСТЬ, ТЕМПЕРАМЕНТ
    // Формула: сумма ячеек 1 + 5 + 9
    $diag1 = $matrix[1] + $matrix[5] + $matrix[9];
    $lines_analysis[] = getDiag1Analysis($diag1);
    
    // Диагональ 3-5-7: СЕКСУАЛЬНОСТЬ, ЧУВСТВЕННОСТЬ
    // Формула: сумма ячеек 3 + 5 + 7
    $diag2 = $matrix[3] + $matrix[5] + $matrix[7];
    $lines_analysis[] = getDiag2Analysis($diag2);
    
    // ==================== ДОПОЛНИТЕЛЬНЫЙ АНАЛИЗ ====================
    
    $additional_analysis = [];
    
    // Количество пустых ячеек
    $empty_cells = 0;
    foreach($matrix as $value) {
        if($value == 0) $empty_cells++;
    }
    $additional_analysis[] = getEmptyCellsAnalysis($empty_cells);
    
    // Самые сильные числа (максимальные значения)
    $max_value = max($matrix);
    $strong_numbers = array_keys($matrix, $max_value);
    $additional_analysis[] = getStrongNumbersAnalysis($strong_numbers, $max_value);
    
    // Самые слабые числа (нулевые значения)
    $weak_numbers = array_keys($matrix, 0);
    $additional_analysis[] = getWeakNumbersAnalysis($weak_numbers);
    
// 9. Сохраняем всё в сессию
$result_data = [
    'birth_date' => $birthDate,
    'day' => $day,
    'month' => $month,
    'year' => $year,
    'working_numbers' => [
        'first' => $firstNumber,
        'second' => $secondNumber,
        'third' => $thirdNumber,
        'fourth' => $fourthNumber
    ],
    'matrix' => $matrix,
    'interpretations' => $interpretations,
    'lines_analysis' => $lines_analysis,
    'additional_analysis' => $additional_analysis,
    'calculated_at' => date('d.m.Y H:i:s'),
    'DopAnal1'=>AnalDopNum1($firstNumber),
    'DopAnal2'=>AnalDopNum2($secondNumber),
    'DopAnal3'=>AnalDopNum3($thirdNumber),
    'DopAnal4'=>AnalDopNum4($fourthNumber),
];

$_SESSION['pythagoras_result'] = $result_data;

// 10. Сохраняем отчет на сервер
$save_result = saveNumerologyReport($result_data, $_POST['email'] ?? '');

// 11. Сохраняем ссылку на файл в сессии
if ($save_result['success']) {
    $_SESSION['report_url'] = $save_result['full_url'];
    $_SESSION['report_filename'] = $save_result['filename'];
}

// 12. Редирект на страницу с результатом
header('Location: pifagor-result.php');
exit;
    }
}
//в админке
//в пользовательской части(неполный вывод)
if($_SERVER['REQUEST_METHOD']=='POST' && isset ($_POST['TablPifFr']))
    {
    //tte($_POST);
    //$Pifagor=selectOne('calc', $params = ['id'=>2, 'is_active=>1']);
    //tt($Pifagor);
    // 1. Получаем дату
    $birthDate = $_POST['daterozd'] ?? '';
    $chdate=$_POST['consent'] ?? '';
    if($chdate=='on')
        {
            $ch1='checked';
        }
        else
            {
                $ch1=='';
            }
    
    if (empty($birthDate)) {
       
        $errMsg .='Вы не ввели дату<br>';
    }
    if (empty($chdate)) {
       
        $errMsg .='Дайте согласие на обработкуперсональных данных<br>';
    }

    // 2. Валидация даты
    $date = DateTime::createFromFormat('Y-m-d', $birthDate);
    // if (!$date) {
    //     // $_SESSION['error'] = "Неверный формат даты. Используйте ГГГГ-ММ-ДД";
    //     // header('Location: pythagoras-form.php');
    //     // exit;
    //     $errMsg.='Вы некорректно ввели дату<br>';
    // }
    if(empty($errMsg)){
    // 3. Извлекаем числа
    $day = (int)$date->format('d');
    $month = (int)$date->format('m');
    $year = (int)$date->format('Y');

     $firstNumber = sumDigits($day) + sumDigits($month) + sumDigits($year);//первое рабочее число
     $secondNumber = sumDigits($firstNumber);//второе рабочее число
     $firstDigitOfDay = (int)substr((string)$day, 0, 1);
    $thirdNumber = $firstNumber - 2 * $firstDigitOfDay;
    if ($thirdNumber < 0) $thirdNumber = abs($thirdNumber);
    $fourthNumber = sumDigits($thirdNumber);//4 рабочее число
    
    // 6. Матрица Пифагора
    $allDigits = $day . $month . $year . $firstNumber . $secondNumber . $thirdNumber . $fourthNumber;
    
    // Инициализируем матрицу
    $matrix = [
        1 => 0, 2 => 0, 3 => 0,
        4 => 0, 5 => 0, 6 => 0,
        7 => 0, 8 => 0, 9 => 0
    ];
    
    // Заполняем матрицу
    for ($i = 0; $i < strlen($allDigits); $i++) {
        $digit = (int)$allDigits[$i];
        if ($digit >= 1 && $digit <= 9) {
            $matrix[$digit]++;
        }
    }
    
    // ==================== РАСШИРЕННЫЕ ИНТЕРПРЕТАЦИИ ПО ЯЧЕЙКАМ ====================
    
    $interpretations = [];
    
    // 1️⃣ ХАРАКТЕР, ВОЛЯ, ЛИДЕРСТВО
    $cell1 = $matrix[1];
    $interpretations[] = getCharacterAnalysis($cell1);
    
    // 2️⃣ ЭНЕРГИЯ, ЭМОЦИИ, ЧУВСТВИТЕЛЬНОСТЬ
    $cell2 = $matrix[2];
    $interpretations[] = getEnergyAnalysis($cell2);
    
    // 3️⃣ ИНТЕРЕС К НАУКЕ, ТЕХНИКЕ, ЛЮБОЗНАТЕЛЬНОСТЬ
    $cell3 = $matrix[3];
    $interpretations[] = getIntelligenceAnalysis($cell3);
    
    // 4️⃣ ЗДОРОВЬЕ, СИЛА, ВЫНОСЛИВОСТЬ
    $cell4 = $matrix[4];
    $interpretations[] = getHealthAnalysis($cell4);
    
    // 5️⃣ ЛОГИКА, ИНТУИЦИЯ, ПРОГНОЗИРОВАНИЕ
    $cell5 = $matrix[5];
    $interpretations[] = getLogicAnalysis($cell5);
    
    // 6️⃣ СКЛОННОСТЬ К ФИЗИЧЕСКОМУ ТРУДУ, ЗЕМНЫЕ ДЕЛА
    $cell6 = $matrix[6];
    $interpretations[] = getPhysicalAnalysis($cell6);
    
    // 7️⃣ ВЕЗЕНИЕ, ТАЛАНТЫ, УДАЧА
    $cell7 = $matrix[7];
    $interpretations[] = getLuckAnalysis($cell7);
    
    // 8️⃣ ЧУВСТВО ДОЛГА, ОТВЕТСТВЕННОСТЬ, ТЕРПЕНИЕ
    $cell8 = $matrix[8];
    $interpretations[] = getDutyAnalysis($cell8);
    
    // 9️⃣ УМ, ПАМЯТЬ, ЭРУДИЦИЯ
    $cell9 = $matrix[9];
    $interpretations[] = getMindAnalysis($cell9);
    
    // ==================== АНАЛИЗ ЛИНИЙ МАТРИЦЫ ====================
    
    $lines_analysis = [];
    
    // 📌 ВЕРТИКАЛЬНЫЕ ЛИНИИ (СТОЛБЦЫ)
    
    // Столбец 1-4-7: САМООЦЕНКА
    // Формула: сумма ячеек 1 + 4 + 7
    $column1 = $matrix[1] + $matrix[4] + $matrix[7];
    $lines_analysis[] = getColumn1Analysis($column1);
    
    // Столбец 2-5-8: МАТЕРИАЛЬНОЕ БЛАГОСОСТОЯНИЕ
    // Формула: сумма ячеек 2 + 5 + 8
    $column2 = $matrix[2] + $matrix[5] + $matrix[8];
    $lines_analysis[] = getColumn2Analysis($column2);
    
    // Столбец 3-6-9: ТВОРЧЕСКИЙ ПОТЕНЦИАЛ, ТАЛАНТЫ
    // Формула: сумма ячеек 3 + 6 + 9
    $column3 = $matrix[3] + $matrix[6] + $matrix[9];
    $lines_analysis[] = getColumn3Analysis($column3);
    
    // 📌 ГОРИЗОНТАЛЬНЫЕ ЛИНИИ (СТРОКИ)
    
    // Строка 1-2-3: ЦЕЛЕУСТРЕМЛЁННОСТЬ
    // Формула: сумма ячеек 1 + 2 + 3
    $line1 = $matrix[1] + $matrix[2] + $matrix[3];
    $lines_analysis[] = getLine1Analysis($line1);
    
    // Строка 4-5-6: СЕМЕЙНОСТЬ, БЫТ, ПРИВЯЗАННОСТЬ К ДОМУ
    // Формула: сумма ячеек 4 + 5 + 6
    $line2 = $matrix[4] + $matrix[5] + $matrix[6];
    $lines_analysis[] = getLine2Analysis($line2);
    
    // Строка 7-8-9: ДУХОВНОСТЬ, ТАЛАНТЫ, ИНТЕРЕСЫ
    // Формула: сумма ячеек 7 + 8 + 9
    $line3 = $matrix[7] + $matrix[8] + $matrix[9];
    $lines_analysis[] = getLine3Analysis($line3);
    
    // 📌 ДИАГОНАЛЬНЫЕ ЛИНИИ
    
    // Диагональ 1-5-9: ДУХОВНАЯ СТАБИЛЬНОСТЬ, ТЕМПЕРАМЕНТ
    // Формула: сумма ячеек 1 + 5 + 9
    $diag1 = $matrix[1] + $matrix[5] + $matrix[9];
    $lines_analysis[] = getDiag1Analysis($diag1);
    
    // Диагональ 3-5-7: СЕКСУАЛЬНОСТЬ, ЧУВСТВЕННОСТЬ
    // Формула: сумма ячеек 3 + 5 + 7
    $diag2 = $matrix[3] + $matrix[5] + $matrix[7];
    $lines_analysis[] = getDiag2Analysis($diag2);
    
    // ==================== ДОПОЛНИТЕЛЬНЫЙ АНАЛИЗ ====================
    
    $additional_analysis = [];
    
    // Количество пустых ячеек
    $empty_cells = 0;
    foreach($matrix as $value) {
        if($value == 0) $empty_cells++;
    }
    $additional_analysis[] = getEmptyCellsAnalysis($empty_cells);
    
    // Самые сильные числа (максимальные значения)
    $max_value = max($matrix);
    $strong_numbers = array_keys($matrix, $max_value);
    $additional_analysis[] = getStrongNumbersAnalysis($strong_numbers, $max_value);
    
    // Самые слабые числа (нулевые значения)
    $weak_numbers = array_keys($matrix, 0);
    $additional_analysis[] = getWeakNumbersAnalysis($weak_numbers);
    
    // 9. Сохраняем всё в сессию
    $_SESSION['pythagoras_result'] = [
        'birth_date' => $birthDate,
        'day' => $day,
        'month' => $month,
        'year' => $year,
        'working_numbers' => [
            'first' => $firstNumber,
            'second' => $secondNumber,
            'third' => $thirdNumber,
            'fourth' => $fourthNumber
        ],
        'matrix' => $matrix,
        'interpretations' => $interpretations,
        'lines_analysis' => $lines_analysis,
        'additional_analysis' => $additional_analysis,
        'calculated_at' => date('d.m.Y H:i:s'),
       
        
    ];
    
    // 10. Редирект на страницу с результатом
    header('Location:'.ABS_PATH.'pifagor');
    exit;
}
}
//в пользовательской части(неполный вывод)
  
// ==================== ФУНКЦИИ ДЛЯ РАСШИРЕННЫХ ИНТЕРПРЕТАЦИЙ ====================
function sumDigits($num) {
        $sum = 0;
        $str = (string)$num;
        for ($i = 0; $i < strlen($str); $i++) {
            $sum += (int)$str[$i];
        }
        return $sum;
    }

// 1️⃣ ХАРАКТЕР, ВОЛЯ, ЛИДЕРСТВО
function getCharacterAnalysis($value) {
    $analysis = "1️⃣ <b>Характер, воля, лидерство:</b> ";
    
    switch ($value) {
        case 0:
            $analysis .= "<span style='color: #e74c3c;'>ОТСУТСТВУЕТ (0 единиц)</span><br>";
            $analysis .= "• Очень мягкий, уступчивый характер<br>";
            $analysis .= "• Сложно отстаивать своё мнение<br>";
            $analysis .= "• Зависит от мнения окружающих<br>";
            $analysis .= "• Избегает ответственности<br>";
            $analysis .= "• Рекомендация: развивать уверенность, брать на себя небольшие обязательства";
            break;
        case 1:
            $analysis .= "<span style='color: #f39c12;'>СРЕДНИЙ (1 единица)</span><br>";
            $analysis .= "• Уравновешенный, гибкий характер<br>";
            $analysis .= "• Может проявить волю, когда это необходимо<br>";
            $analysis .= "• Компромиссный подход к решению проблем<br>";
            $analysis .= "• Не стремится к лидерству, но может взять ответственность<br>";
            $analysis .= "• Умеет слушать и учитывать мнение других";
            break;
        case 2:
            $analysis .= "<span style='color: #2ecc71;'>СИЛЬНЫЙ (2 единицы)</span><br>";
            $analysis .= "• Целеустремлённый, настойчивый<br>";
            $analysis .= "• Чётко знает, чего хочет от жизни<br>";
            $analysis .= "• Умеет отстаивать свои интересы<br>";
            $analysis .= "• Прирождённый организатор<br>";
            $analysis .= "• Люди часто обращаются за советом";
            break;
        case 3:
            $analysis .= "<span style='color: #3498db;'>ОЧЕНЬ СИЛЬНЫЙ (3 единицы)</span><br>";
            $analysis .= "• Прирождённый лидер<br>";
            $analysis .= "• Сильная воля, железный характер<br>";
            $analysis .= "• Непоколебим в своих принципах<br>";
            $analysis .= "• Может вести за собой людей<br>";
            $analysis .= "• Часто занимает руководящие должности";
            break;
        default:
            $analysis .= "<span style='color: #9b59b6;'>ДИКТАТОРСКИЙ (4+ единицы)</span><br>";
            $analysis .= "• Чрезвычайно сильная воля<br>";
            $analysis .= "• Может подавлять окружающих<br>";
            $analysis .= "• Упрямство, которое мешает в отношениях<br>";
            $analysis .= "• Нужно учиться гибкости и дипломатии<br>";
            $analysis .= "• Рекомендация: учитывать мнение других, делегировать";
            break;
    }
    
    return $analysis;
}

// 2️⃣ ЭНЕРГИЯ, ЭМОЦИИ, ЧУВСТВИТЕЛЬНОСТЬ
function getEnergyAnalysis($value) {
    $analysis = "2️⃣ <b>Энергия, эмоции, чувствительность:</b> ";
    
    switch ($value) {
        case 0:
            $analysis .= "<span style='color: #e74c3c;'>НИЗКАЯ (0 двоек)</span><br>";
            $analysis .= "• Быстрая утомляемость, хроническая усталость<br>";
            $analysis .= "• Эмоциональное выгорание<br>";
            $analysis .= "• Восприимчивость к энерговампирам<br>";
            $analysis .= "• Нужен регулярный отдых и восстановление<br>";
            $analysis .= "• Рекомендация: йога, медитация, здоровый сон";
            break;
        case 1:
            $analysis .= "<span style='color: #f39c12;'>НОРМАЛЬНАЯ (1 двойка)</span><br>";
            $analysis .= "• Стабильный энергетический уровень<br>";
            $analysis .= "• Эмоционально устойчивый<br>";
            $analysis .= "• Восстанавливается после отдыха<br>";
            $analysis .= "• Может работать в нормальном режиме<br>";
            $analysis .= "• Важно избегать перегрузок";
            break;
        case 2:
            $analysis .= "<span style='color: #2ecc71;'>ВЫСОКАЯ (2 двойки)</span><br>";
            $analysis .= "• Высокая работоспособность<br>";
            $analysis .= "• Может заряжать энергией других<br>";
            $analysis .= "• Быстро восстанавливает силы<br>";
            $analysis .= "• Эмоционально отзывчивый<br>";
            $analysis .= "• Хороший энергетический донор";
            break;
        case 3:
            $analysis .= "<span style='color: #3498db;'>ОЧЕНЬ ВЫСОКАЯ (3 двойки)</span><br>";
            $analysis .= "• Неиссякаемый источник энергии<br>";
            $analysis .= "• Возможны экстрасенсорные способности<br>";
            $analysis .= "• Может быть целителем или тренером<br>";
            $analysis .= "• Сильное биоэнергетическое поле<br>";
            $analysis .= "• Нужно учиться управлять энергией";
            break;
        default:
            $analysis .= "<span style='color: #9b59b6;'>КОСМИЧЕСКАЯ (4+ двойки)</span><br>";
            $analysis .= "• Колоссальный энергетический потенциал<br>";
            $analysis .= "• Может влиять на события и людей<br>";
            $analysis .= "• Часто обладает паранормальными способностями<br>";
            $analysis .= "• Важно использовать энергию во благо<br>";
            $analysis .= "• Рекомендация: духовные практики";
            break;
    }
    
    return $analysis;
}

// 3️⃣ ИНТЕРЕС К НАУКЕ, ТЕХНИКЕ, ЛЮБОЗНАТЕЛЬНОСТЬ
function getIntelligenceAnalysis($value) {
    $analysis = "3️⃣ <b>Интерес к науке, технике, любознательность:</b> ";
    
    switch ($value) {
        case 0:
            $analysis .= "<span style='color: #e74c3c;'>ОТСУТСТВУЕТ (0 троек)</span><br>";
            $analysis .= "• Гуманитарный склад ума<br>";
            $analysis .= "• Не интересуется техникой и точными науками<br>";
            $analysis .= "• Практичный подход к жизни<br>";
            $analysis .= "• Лучше усваивает через практику<br>";
            $analysis .= "• Рекомендация: развивать логическое мышление";
            break;
        case 1:
            $analysis .= "<span style='color: #f39c12;'>НОРМАЛЬНЫЙ (1 тройка)</span><br>";
            $analysis .= "• Сбалансированные интересы<br>";
            $analysis .= "• Может разобраться в технике при необходимости<br>";
            $analysis .= "• Любознательность в меру<br>";
            $analysis .= "• Учится по мере необходимости<br>";
            $analysis .= "• Не стремится к научным открытиям";
            break;
        case 2:
            $analysis .= "<span style='color: #2ecc71;'>ВЫРАЖЕННЫЙ (2 тройки)</span><br>";
            $analysis .= "• Аналитический склад ума<br>";
            $analysis .= "• Интерес к технологиям и инновациям<br>";
            $analysis .= "• Хорошо разбирается в технике<br>";
            $analysis .= "• Постоянно учится чему-то новому<br>";
            $analysis .= "• Может быть инженером или учёным";
            break;
        case 3:
            $analysis .= "<span style='color: #3498db;'>ОЧЕНЬ СИЛЬНЫЙ (3 тройки)</span><br>";
            $analysis .= "• Пытливый ум, исследователь<br>";
            $analysis .= "• Талант к точным наукам<br>";
            $analysis .= "• Может делать открытия<br>";
            $analysis .= "• Постоянно ищет новую информацию<br>";
            $analysis .= "• Часто работает в IT или науке";
            break;
        default:
            $analysis .= "<span style='color: #9b59b6;'>ГЕНИАЛЬНЫЙ (4+ тройки)</span><br>";
            $analysis .= "• Гениальные способности<br>";
            $analysis .= "• Может совершать открытия<br>";
            $analysis .= "• Нестандартное мышление<br>";
            $analysis .= "• Интерес ко всему новому<br>";
            $analysis .= "• Важно направить талант в нужное русло";
            break;
    }
    
    return $analysis;
}

// 4️⃣ ЗДОРОВЬЕ, СИЛА, ВЫНОСЛИВОСТЬ
function getHealthAnalysis($value) {
    $analysis = "4️⃣ <b>Здоровье, сила, выносливость:</b> ";
    
    switch ($value) {
        case 0:
            $analysis .= "<span style='color: #e74c3c;'>СЛАБОЕ (0 четвёрок)</span><br>";
            $analysis .= "• Врождённые проблемы со здоровьем<br>";
            $analysis .= "• Нужен особый режим и уход<br>";
            $analysis .= "• Быстрая утомляемость<br>";
            $analysis .= "• Важно укреплять иммунитет с детства<br>";
            $analysis .= "• Рекомендация: регулярные обследования, ЗОЖ";
            break;
        case 1:
            $analysis .= "<span style='color: #f39c12;'>СРЕДНЕЕ (1 четвёрка)</span><br>";
            $analysis .= "• Есть уязвимые места в организме<br>";
            $analysis .= "• В целом здоров, но нужна профилактика<br>";
            $analysis .= "• Восстанавливается после болезней<br>";
            $analysis .= "• Может заниматься спортом умеренно<br>";
            $analysis .= "• Важен режим и правильное питание";
            break;
        case 2:
            $analysis .= "<span style='color: #2ecc71;'>ХОРОШЕЕ (2 четвёрки)</span><br>";
            $analysis .= "• Крепкое здоровье от природы<br>";
            $analysis .= "• Быстрое восстановление<br>";
            $analysis .= "• Выносливость выше среднего<br>";
            $analysis .= "• Может заниматься спортом<br>";
            $analysis .= "• Редко обращается к врачам";
            break;
        case 3:
            $analysis .= "<span style='color: #3498db;'>ОТЛИЧНОЕ (3 четвёрки)</span><br>";
            $analysis .= "• Железное здоровье<br>";
            $analysis .= "• Высокая выносливость<br>";
            $analysis .= "• Практически не болеет<br>";
            $analysis .= "• Быстрое заживление ран<br>";
            $analysis .= "• Потенциальный долгожитель";
            break;
        default:
            $analysis .= "<span style='color: #9b59b6;'>НЕВЕРОЯТНОЕ (4+ четвёрок)</span><br>";
            $analysis .= "• Невероятно крепкое здоровье<br>";
            $analysis .= "• Может быть спортсменом<br>";
            $analysis .= "• Сопротивляемость болезням<br>";
            $analysis .= "• Быстрая реабилитация<br>";
            $analysis .= "• Может прожить более 90 лет";
            break;
    }
    
    return $analysis;
}

// Остальные функции (5-9) будут аналогичны по структуре.
// Для экономии места привожу только заголовки, вы можете расширить их аналогично:
//////////////////////////////////////////////////////

// 5️⃣ ЛОГИКА, ИНТУИЦИЯ, ПРОГНОЗИРОВАНИЕ
function getLogicAnalysis($value) {
    $analysis = "5️⃣ <b>Логика, интуиция, аналитические способности:</b> ";
    
    switch ($value) {
        case 0:
            $analysis .= "<span style='color: #e74c3c;'>ОТСУТСТВУЕТ (0 пятёрок)</span><br>";
            $analysis .= "• Слабое логическое мышление<br>";
            $analysis .= "• Доверяет чувствам больше, чем разуму<br>";
            $analysis .= "• Часто ошибается в расчётах<br>";
            $analysis .= "• Интуиция слабо развита<br>";
            $analysis .= "• Рекомендация: развивать аналитическое мышление";
            break;
        case 1:
            $analysis .= "<span style='color: #f39c12;'>НОРМАЛЬНАЯ (1 пятёрка)</span><br>";
            $analysis .= "• Баланс логики и интуиции<br>";
            $analysis .= "• Может анализировать простые ситуации<br>";
            $analysis .= "• Интуиция проявляется в важные моменты<br>";
            $analysis .= "• Учится на своих ошибках<br>";
            $analysis .= "• Принимает решения, взвесив все «за» и «против»";
            break;
        case 2:
            $analysis .= "<span style='color: #2ecc71;'>ХОРОШАЯ (2 пятёрки)</span><br>";
            $analysis .= "• Сильная логика и аналитический ум<br>";
            $analysis .= "• Хорошо развитая интуиция<br>";
            $analysis .= "• Может предвидеть развитие событий<br>";
            $analysis .= "• Редко ошибается в расчётах<br>";
            $analysis .= "• Часто даёт дельные советы другим";
            break;
        case 3:
            $analysis .= "<span style='color: #3498db;'>ОТЛИЧНАЯ (3 пятёрки)</span><br>";
            $analysis .= "• Выдающиеся аналитические способности<br>";
            $analysis .= "• Почти всегда точная интуиция<br>";
            $analysis .= "• Может быть стратегом или аналитиком<br>";
            $analysis .= "• Видит ситуацию на несколько шагов вперёд<br>";
            $analysis .= "• Часто работает в науке, финансах или IT";
            break;
        default:
            $analysis .= "<span style='color: #9b59b6;'>ГЕНИАЛЬНАЯ (4+ пятёрок)</span><br>";
            $analysis .= "• Блестящий аналитический ум<br>";
            $analysis .= "• Интуиция на грани ясновидения<br>";
            $analysis .= "• Может решать сложнейшие задачи<br>";
            $analysis .= "• Часто предсказывает будущее<br>";
            $analysis .= "• Важно использовать дар во благо";
            break;
    }
    
    return $analysis;
}

// 6️⃣ СКЛОННОСТЬ К ФИЗИЧЕСКОМУ ТРУДУ, ЗЕМНЫЕ ДЕЛА
function getPhysicalAnalysis($value) {
    $analysis = "6️⃣ <b>Связь с землёй, физический труд, мастерство:</b> ";
    
    switch ($value) {
        case 0:
            $analysis .= "<span style='color: #e74c3c;'>ОТСУТСТВУЕТ (0 шестёрок)</span><br>";
            $analysis .= "• Не любит физический труд<br>";
            $analysis .= "• Нет связи с землёй и природой<br>";
            $analysis .= "• Руки не «золотые»<br>";
            $analysis .= "• Предпочитает умственную работу<br>";
            $analysis .= "• Рекомендация: развивать мелкую моторику";
            break;
        case 1:
            $analysis .= "<span style='color: #f39c12;'>НОРМАЛЬНАЯ (1 шестёрка)</span><br>";
            $analysis .= "• Может заниматься физическим трудом при необходимости<br>";
            $analysis .= "• Есть базовые навыки ручного труда<br>";
            $analysis .= "• Не боится испачкать руки<br>";
            $analysis .= "• Может что-то починить в доме<br>";
            $analysis .= "• Уважает труд других людей";
            break;
        case 2:
            $analysis .= "<span style='color: #2ecc71;'>ХОРОШАЯ (2 шестёрки)</span><br>";
            $analysis .= "• Хорошие руки, есть талант к ремеслу<br>";
            $analysis .= "• Любит работать с материалами<br>";
            $analysis .= "• Может стать хорошим мастером<br>";
            $analysis .= "• Чувствует связь с землёй<br>";
            $analysis .= "• Часто занимается садом, ремонтом";
            break;
        case 3:
            $analysis .= "<span style='color: #3498db;'>ОТЛИЧНАЯ (3 шестёрки)</span><br>";
            $analysis .= "• Прирождённый мастер, «золотые руки»<br>";
            $analysis .= "• Может создавать вещи своими руками<br>";
            $analysis .= "• Сильная связь с землёй и природой<br>";
            $analysis .= "• Часто работает в ремесле, строительстве<br>";
            $analysis .= "• Может быть фермером или строителем";
            break;
        default:
            $analysis .= "<span style='color: #9b59b6;'>ВЫДАЮЩАЯСЯ (4+ шестёрок)</span><br>";
            $analysis .= "• Исключительный талант к ручному труду<br>";
            $analysis .= "• Может создавать произведения искусства<br>";
            $analysis .= "• Глубокая связь с земными энергиями<br>";
            $analysis .= "• Часто становится известным мастером<br>";
            $analysis .= "• Важно передавать знания другим";
            break;
    }
    
    return $analysis;
}

// 7️⃣ ВЕЗЕНИЕ, ТАЛАНТЫ, УДАЧА
function getLuckAnalysis($value) {
    $analysis = "7️⃣ <b>Везение, удача, ангел-хранитель:</b> ";
    
    switch ($value) {
        case 0:
            $analysis .= "<span style='color: #e74c3c;'>ОТСУТСТВУЕТ (0 семёрок)</span><br>";
            $analysis .= "• Невезучий человек<br>";
            $analysis .= "• Всего добивается тяжёлым трудом<br>";
            $analysis .= "• Часто попадает в неприятности<br>";
            $analysis .= "• Нет поддержки свыше<br>";
            $analysis .= "• Рекомендация: рассчитывать только на себя";
            break;
        case 1:
            $analysis .= "<span style='color: #f39c12;'>СЛАБОЕ (1 семёрка)</span><br>";
            $analysis .= "• Удача проявляется редко<br>";
            $analysis .= "• В основном полагается на упорство<br>";
            $analysis .= "• Иногда везёт в мелочах<br>";
            $analysis .= "• Нужно «ловить» удачные моменты<br>";
            $analysis .= "• Ангел-хранитель есть, но слабый";
            break;
        case 2:
            $analysis .= "<span style='color: #2ecc71;'>НОРМАЛЬНОЕ (2 семёрки)</span><br>";
            $analysis .= "• Умеренная удачливость<br>";
            $analysis .= "• Везунчик в важных ситуациях<br>";
            $analysis .= "• «Сам себе создаёт удачу»<br>";
            $analysis .= "• Ангел-хранитель помогает в критических моментах<br>";
            $analysis .= "• Часто выигрывает в лотереи";
            break;
        case 3:
            $analysis .= "<span style='color: #3498db;'>СИЛЬНОЕ (3 семёрки)</span><br>";
            $analysis .= "• Очень везучий, «баловень судьбы»<br>";
            $analysis .= "• Часто оказывается в нужное время в нужном месте<br>";
            $analysis .= "• Сильный ангел-хранитель<br>";
            $analysis .= "• Талантлив во многих сферах<br>";
            $analysis .= "• Удача в азартных играх";
            break;
        default:
            $analysis .= "<span style='color: #9b59b6;'>НЕВЕРОЯТНОЕ (4+ семёрок)</span><br>";
            $analysis .= "• Невероятная удача, ангел-хранитель всегда рядом<br>";
            $analysis .= "• Судьба буквально ведёт за руку<br>";
            $analysis .= "• Часто избегает опасностей чудом<br>";
            $analysis .= "• Множество талантов<br>";
            $analysis .= "• Важно благодарить судьбу и делиться удачей";
            break;
    }
    
    return $analysis;
}

// 8️⃣ ЧУВСТВО ДОЛГА, ОТВЕТСТВЕННОСТЬ, ТЕРПЕНИЕ
function getDutyAnalysis($value) {
    $analysis = "8️⃣ <b>Чувство долга, ответственность, терпение:</b> ";
    
    switch ($value) {
        case 0:
            $analysis .= "<span style='color: #e74c3c;'>ОТСУТСТВУЕТ (0 восьмёрок)</span><br>";
            $analysis .= "• Безответственный<br>";
            $analysis .= "• Не держит обещания<br>";
            $analysis .= "• Избегает обязательств<br>";
            $analysis .= "• Нет терпения<br>";
            $analysis .= "• Рекомендация: учиться брать ответственность";
            break;
        case 1:
            $analysis .= "<span style='color: #f39c12;'>НОРМАЛЬНОЕ (1 восьмёрка)</span><br>";
            $analysis .= "• Ответственный в важных вопросах<br>";
            $analysis .= "• Держит обещания, данные близким<br>";
            $analysis .= "• Имеет чувство долга<br>";
            $analysis .= "• Терпелив в пределах разумного<br>";
            $analysis .= "• Выполняет взятые обязательства";
            break;
        case 2:
            $analysis .= "<span style='color: #2ecc71;'>ХОРОШЕЕ (2 восьмёрки)</span><br>";
            $analysis .= "• Очень ответственный человек<br>";
            $analysis .= "• Всегда держит слово<br>";
            $analysis .= "• Сильное чувство долга<br>";
            $analysis .= "• Терпелив и выдержан<br>";
            $analysis .= "• На такого можно положиться";
            break;
        case 3:
            $analysis .= "<span style='color: #3498db;'>ОТЛИЧНОЕ (3 восьмёрки)</span><br>";
            $analysis .= "• Чрезвычайно ответственный<br>";
            $analysis .= "• Чувство долга развито очень сильно<br>";
            $analysis .= "• Ангельское терпение<br>";
            $analysis .= "• Всегда выполняет обещанное<br>";
            $analysis .= "• Часто берёт на себя слишком много";
            break;
        default:
            $analysis .= "<span style='color: #9b59b6;'>КРАЙНЕЕ (4+ восьмёрок)</span><br>";
            $analysis .= "• Гипертрофированное чувство долга<br>";
            $analysis .= "• Берёт ответственность за всех вокруг<br>";
            $analysis .= "• Может страдать от этого<br>";
            $analysis .= "• Кармические долги<br>";
            $analysis .= "• Важно научиться отпускать и прощать себя";
            break;
    }
    
    return $analysis;
}

// 9️⃣ УМ, ПАМЯТЬ, ЭРУДИЦИЯ
function getMindAnalysis($value) {
    $analysis = "9️⃣ <b>Ум, память, эрудиция, обучаемость:</b> ";
    
    switch ($value) {
        case 0:
            $analysis .= "<span style='color: #e74c3c;'>СЛАБЫЙ (0 девяток)</span><br>";
            $analysis .= "• Плохая память<br>";
            $analysis .= "• Трудно учиться новому<br>";
            $analysis .= "• Неэрудированный<br>";
            $analysis .= "• Медленно соображает<br>";
            $analysis .= "• Рекомендация: тренировать память и ум";
            break;
        case 1:
            $analysis .= "<span style='color: #f39c12;'>НОРМАЛЬНЫЙ (1 девятка)</span><br>";
            $analysis .= "• Средние способности к обучению<br>";
            $analysis .= "• Память в пределах нормы<br>";
            $analysis .= "• Может освоить новое при желании<br>";
            $analysis .= "• Эрудиция на бытовом уровне<br>";
            $analysis .= "• Учится по необходимости";
            break;
        case 2:
            $analysis .= "<span style='color: #2ecc71;'>ХОРОШИЙ (2 девятки)</span><br>";
            $analysis .= "• Хорошая память<br>";
            $analysis .= "• Быстро обучается<br>";
            $analysis .= "• Эрудированный человек<br>";
            $analysis .= "• Широкий кругозор<br>";
            $analysis .= "• Может быть отличником в учёбе";
            break;
        case 3:
            $analysis .= "<span style='color: #3498db;'>ОТЛИЧНЫЙ (3 девятки)</span><br>";
            $analysis .= "• Отличная память<br>";
            $analysis .= "• Высокая обучаемость<br>";
            $analysis .= "• Большая эрудиция<br>";
            $analysis .= "• Часто становится учёным или исследователем<br>";
            $analysis .= "• Может знать несколько языков";
            break;
        default:
            $analysis .= "<span style='color: #9b59b6;'>ГЕНИАЛЬНЫЙ (4+ девяток)</span><br>";
            $analysis .= "• Феноменальная память<br>";
            $analysis .= "• Гениальные способности к обучению<br>";
            $analysis .= "• Энциклопедические знания<br>";
            $analysis .= "• Может быть вундеркиндом<br>";
            $analysis .= "• Важно использовать ум во благо";
            break;
    }
    
    return $analysis;
}
//////////////////////////////////////////////
// ==================== ФУНКЦИИ ДЛЯ АНАЛИЗА ЛИНИЙ ====================


//////////////////////////////////////////////////////////
/* Столбец 1-4-7: САМООЦЕНКА И УВЕРЕННОСТЬ В СЕБЕ
 * Формула: сумма значений ячеек 1 + 4 + 7
 * Отвечает за: самооценку, уверенность в себе, самодостаточность
 */
function getColumn1Analysis($value) {
    $analysis = "<div class='line-item'>";
    $analysis .= "<h4><i class='fas fa-user-shield'></i> Столбец 1-4-7: <span class='line-name'>Самооценка и уверенность в себе</span></h4>";
    $analysis .= "<div class='line-formula'>Формула: [1] + [4] + [7] = <strong>$value</strong> баллов</div>";
    $analysis .= "<div class='line-description'>";
    
    if ($value == 0) {
        $analysis .= "<span class='level-critical'>КРИТИЧЕСКИ НИЗКАЯ (0 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Полное отсутствие уверенности в себе</li>";
        $analysis .= "<li>Постоянные сомнения в своих силах</li>";
        $analysis .= "<li>Зависимость от мнения окружающих</li>";
        $analysis .= "<li>Боязнь брать на себя ответственность</li>";
        $analysis .= "<li>Склонность к самокритике и самоуничижению</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> работа с психологом, развитие самоуважения</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 2) {
        $analysis .= "<span class='level-weak'>НИЗКАЯ (1-2 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Неуверенность в большинстве ситуаций</li>";
        $analysis .= "<li>Частые колебания самооценки</li>";
        $analysis .= "<li>Нуждается в поддержке и одобрении</li>";
        $analysis .= "<li>Избегает публичных выступлений и лидерства</li>";
        $analysis .= "<li>Сложности в отстаивании своих интересов</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> курсы уверенности, небольшие достижения</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 4) {
        $analysis .= "<span class='level-medium'>НОРМАЛЬНАЯ (3-4 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Адекватная самооценка в знакомых ситуациях</li>";
        $analysis .= "<li>Знает свои сильные и слабые стороны</li>";
        $analysis .= "<li>Может проявить уверенность при необходимости</li>";
        $analysis .= "<li>Нормально воспринимает конструктивную критику</li>";
        $analysis .= "<li>Не зависит полностью от чужого мнения</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> постепенно расширять зону комфорта</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 6) {
        $analysis .= "<span class='level-good'>ВЫСОКАЯ (5-6 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Уверен в своих силах и способностях</li>";
        $analysis .= "<li>Спокойно принимает решения</li>";
        $analysis .= "<li>Не боится ответственности</li>";
        $analysis .= "<li>Умеет отстаивать свою точку зрения</li>";
        $analysis .= "<li>Стабильная самооценка, не зависящая от обстоятельств</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> использовать уверенность для помощи другим</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 8) {
        $analysis .= "<span class='level-strong'>ОЧЕНЬ ВЫСОКАЯ (7-8 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Высокая степень уверенности в себе</li>";
        $analysis .= "<li>Природное лидерство и харизма</li>";
        $analysis .= "<li>Берёт ответственность за других</li>";
        $analysis .= "<li>Не зависит от мнения окружающих</li>";
        $analysis .= "<li>Способен вдохновлять и вести за собой</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> следить, чтобы уверенность не переросла в самоуверенность</li>";
        $analysis .= "</ul>";
    } else {
        $analysis .= "<span class='level-excellent'>ЗАВЫШЕННАЯ (9+ баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Возможна завышенная самооценка</li>";
        $analysis .= "<li>Склонность переоценивать свои возможности</li>";
        $analysis .= "<li>Может игнорировать мнение других</li>";
        $analysis .= "<li>Рисковать без достаточных оснований</li>";
        $analysis .= "<li>Потенциальные конфликты из-за излишней самоуверенности</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> развивать эмпатию, учиться слушать других</li>";
        $analysis .= "</ul>";
    }
    
    $analysis .= "</div></div>";
    return $analysis;
}

/**
 * Столбец 2-5-8: МАТЕРИАЛЬНОЕ БЛАГОПОЛУЧИЕ И ФИНАНСЫ
 * Формула: сумма значений ячеек 2 + 5 + 8
 * Отвечает за: отношение к деньгам, способность зарабатывать, финансовую удачу
 */
function getColumn2Analysis($value) {
    $analysis = "<div class='line-item'>";
    $analysis .= "<h4><i class='fas fa-money-bill-wave'></i> Столбец 2-5-8: <span class='line-name'>Материальное благополучие и финансы</span></h4>";
    $analysis .= "<div class='line-formula'>Формула: [2] + [5] + [8] = <strong>$value</strong> баллов</div>";
    $analysis .= "<div class='line-description'>";
    
    if ($value == 0) {
        $analysis .= "<span class='level-critical'>КРИТИЧЕСКИ НИЗКИЙ (0 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Хронические финансовые проблемы</li>";
        $analysis .= "<li>Деньги «утекают сквозь пальцы»</li>";
        $analysis .= "<li>Невозможность накопить даже небольшую сумму</li>";
        $analysis .= "<li>Частые долги и кредиты</li>";
        $analysis .= "<li>Отсутствие финансовой дисциплины</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> финансовый консультант, строгий бюджет</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 2) {
        $analysis .= "<span class='level-weak'>НИЗКИЙ (1-2 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Денег хватает только на самое необходимое</li>";
        $analysis .= "<li>Отсутствие финансовой подушки безопасности</li>";
        $analysis .= "<li>Работа за небольшую зарплату</li>";
        $analysis .= "<li>Сложности с планированием бюджета</li>";
        $analysis .= "<li>Импульсивные траты</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> обучение финансовой грамотности</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 4) {
        $analysis .= "<span class='level-medium'>СРЕДНИЙ (3-4 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Стабильный, но невысокий доход</li>";
        $analysis .= "<li>Возможность делать небольшие накопления</li>";
        $analysis .= "<li>Финансовая дисциплина в пределах нормы</li>";
        $analysis .= "<li>Может позволить себе некоторые развлечения</li>";
        $analysis .= "<li>Нет серьёзных долгов</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> создание дополнительных источников дохода</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 6) {
        $analysis .= "<span class='level-good'>ХОРОШИЙ (5-6 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Хорошее материальное положение</li>";
        $analysis .= "<li>Возможность откладывать и инвестировать</li>";
