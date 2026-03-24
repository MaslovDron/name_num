//tt($_POST);
    $firstName = htmlspecialchars(trim($_POST['FirstName'] ?? ''), ENT_QUOTES, 'UTF-8');
    $lastName = htmlspecialchars(trim($_POST['LastName'] ?? ''), ENT_QUOTES, 'UTF-8');
    $Famely = htmlspecialchars(trim($_POST['Famely'] ?? ''), ENT_QUOTES, 'UTF-8');
        if(empty($firstName)) {
            $errMsg .= 'Пожалуйста, введите имя<br>';
        }
           if(empty($lastName)) {
            $errMsg .= 'Пожалуйста, введите отчество<br>';
        }
        if(empty($Famely)) {
            $errMsg .= 'Пожалуйста, введите Фамилию<br>';
        }
        //если нет ошибок, выводим результат
        if(empty($errMsg))
{
    // 1. Собираем полное ФИО в правильном порядке: ФАМИЛИЯ + ИМЯ + ОТЧЕСТВО
    $fullName = trim($Famely . ' ' . $firstName . ' ' . $lastName);
    // Убираем лишние пробелы внутри
    $fullName = preg_replace('/\s+/', ' ', $fullName);
    
    // 2. ВЫЧИСЛЯЕМ ЧИСЛА
    $nameSum = sumLetters($fullName, $letterValues);
    $nameNumber = reduceNumber($nameSum);
    
    $soulSum = sumLetters($fullName, $letterValues, $vowels);
    $soulNumber = reduceNumber($soulSum);
    
    $personalitySum = sumLetters($fullName, $letterValues, $consonants);
    $personalityNumber = reduceNumber($personalitySum);
    
    $karmicSum = $nameNumber + $soulNumber;
    $karmicNumber = reduceNumber($karmicSum);
    
    // 3. Проверяем совпадения чисел
    $combinations = [];
    if ($nameNumber == $soulNumber) {
        $combinationKey = $nameNumber . '_' . $soulNumber;
        if (isset($interpretations['combinations'][$combinationKey])) {
            $_SESSION['fio_result']['combination'] = $interpretations['combinations'][$combinationKey];
        }
    }
/////////////создаем файл для пользователя
// Вызываем функцию сохранения отчета
$save_result = saveNumerologyFioReport($_SESSION['fio_result'], $_POST['email'] ?? '');

// Сохраняем ссылку на файл в сессии
if ($save_result['success']) {
    $_SESSION['fio_report_url'] = $save_result['full_url'];
    $_SESSION['fio_report_filename'] = $save_result['filename'];
}
/////////////создаем файл для пользователя
    
    if ($nameNumber == $personalityNumber && $nameNumber != $soulNumber) {
        $combinations[] = [
            'type' => 'Имя = Личность',
            'text' => 'Ваши число имени и число личности совпадают. Вы живёте в гармонии с собой — ваше внутреннее и внешнее едины.'
        ];
    }
    if ($nameNumber == $karmicNumber && $nameNumber != $soulNumber) {
        $combinations[] = [
            'type' => 'Имя = Кармическое',
            'text' => 'Ваше число имени совпадает с кармическим числом. Ваша личность и кармические задачи идут рука об руку.'
        ];
    }
    if ($soulNumber == $personalityNumber && $soulNumber != $nameNumber) {
        $combinations[] = [
            'type' => 'Душа = Личность',
            'text' => 'Ваши число души и число личности совпадают. Вы искренни и открыты — внутреннее совпадает с внешним.'
        ];
    }
    if ($soulNumber == $karmicNumber && $soulNumber != $nameNumber) {
        $combinations[] = [
            'type' => 'Душа = Кармическое',
            'text' => 'Ваши число души и кармическое число совпадают. Ваши желания соответствуют вашим кармическим задачам.'
        ];
    }
    if ($personalityNumber == $karmicNumber && $personalityNumber != $nameNumber && $personalityNumber != $soulNumber) {
        $combinations[] = [
            'type' => 'Личность = Кармическое',
            'text' => 'Ваши число личности и кармическое число совпадают. То, как вас видят другие, соответствует вашим кармическим задачам.'
        ];
    }
    if (!empty($combinations)) {
        $_SESSION['fio_result']['additional_combinations'] = $combinations;
    }
    
    // 4. Дополнительный анализ
    $additional_fio = [];
    
    if ($nameNumber == $soulNumber) {
        $additional_fio[] = 'Ваши число имени и число души совпадают. Вы живете в гармонии с собой.';
    }
    if ($nameNumber == $personalityNumber) {
        $additional_fio[] = 'Ваше внутреннее и внешнее совпадают. Вы искренни и открыты.';
    }
    
    $evenCount = 0;
    $oddCount = 0;
    foreach ([$nameNumber, $soulNumber, $personalityNumber, $karmicNumber] as $num) {
        if ($num % 2 == 0) $evenCount++; else $oddCount++;
    }
    if ($evenCount > $oddCount) {
        $additional_fio[] = 'У вас преобладают четные числа — вы практичны и уравновешены.';
    } elseif ($oddCount > $evenCount) {
        $additional_fio[] = 'У вас преобладают нечетные числа — вы творческая и импульсивная личность.';
    }
    
    // 5. Суммарное число
    $totalSum = $nameNumber + $soulNumber + $personalityNumber + $karmicNumber;
    $totalNumber = reduceNumber($totalSum);
    
    // 6. СПЕКТР ИМЕНИ (для полного ФИО)
    $allNameNumbers = [];
    $nameLower = mb_strtolower($fullName);
    $length = mb_strlen($nameLower);
    for ($i = 0; $i < $length; $i++) {
        $char = mb_substr($nameLower, $i, 1);
        if (isset($letterValues[$char])) {
            $allNameNumbers[] = $letterValues[$char];
        }
    }
    
    $spectrum = array_fill(1, 9, 0);
    foreach ($allNameNumbers as $num) {
        if ($num >= 1 && $num <= 9) {
            $spectrum[$num]++;
        }
    }
    
    $dominantNumbers = array_keys($spectrum, max($spectrum));
    $dominantText = '';
    if (count($dominantNumbers) == 1) {
        $dominantText = "Преобладает число {$dominantNumbers[0]} — это ваш главный архетип.";
    } else {
        $dominantText = "Преобладают числа " . implode(', ', $dominantNumbers) . " — многогранная личность.";
    }
    
    $missingNumbers = array_keys(array_filter($spectrum, function($count) { return $count == 0; }));
    $missingText = empty($missingNumbers) ? "В вашем имени представлены все числа — гармоничная личность." 
        : "Отсутствуют числа: " . implode(', ', $missingNumbers) . " — это ваши зоны роста.";
    
    $evenSpectrum = 0;
    $oddSpectrum = 0;
    for ($i = 1; $i <= 9; $i++) {
        if ($i % 2 == 0) $evenSpectrum += $spectrum[$i];
        else $oddSpectrum += $spectrum[$i];
    }
    $balanceText = ($evenSpectrum > $oddSpectrum) ? "Преобладают четные числа — вы практичны и уравновешены."
        : (($oddSpectrum > $evenSpectrum) ? "Преобладают нечетные числа — вы творческая и импульсивная личность."
        : "Баланс четных и нечетных чисел — гармония.");
    
    // 7. ЧИСЛО ПОДСОЗНАНИЯ
    $subconsciousSum = array_sum($allNameNumbers);
    $subconsciousNumber = reduceNumber($subconsciousSum);
    
    // 8. ДИНАМИКА ИМЕНИ
    $transitions = [];
    for ($i = 0; $i < count($allNameNumbers) - 1; $i++) {
        $from = $allNameNumbers[$i];
        $to = $allNameNumbers[$i + 1];
        $transitions[] = "$from → $to";
    }
    $dynamicAnalysis = [];
    if (count($transitions) > 0) {
        $dynamicAnalysis[] = "Начало пути: число {$allNameNumbers[0]}, цель: число " . end($allNameNumbers);
        $transitionCounts = array_count_values($transitions);
        foreach ($transitionCounts as $transition => $count) {
            if ($count > 1) {
                $dynamicAnalysis[] = "Повторяющийся переход: $transition — важная тема в вашей жизни.";
            }
        }
    }
    
    // 9. КОРРЕКЦИЯ ИМЕНИ
    $corrections_fio = [];
    if ($nameNumber == 1 || $soulNumber == 1 || $personalityNumber == 1) {
        $corrections_fio[] = "Уменьшительные формы смягчат жесткость Единицы, добавят мягкости в общение.";
    }
    if ($nameNumber == 3 || $soulNumber == 3 || $personalityNumber == 3) {
        $corrections_fio[] = "Более сдержанные формы имени помогут сконцентрироваться и доводить дела до конца.";
    }
    if ($nameNumber == 4 || $soulNumber == 4 || $personalityNumber == 4) {
        $corrections_fio[] = "Использование более мягких форм имени добавит гибкости и лёгкости.";
    }
    if ($nameNumber == 5 || $soulNumber == 5 || $personalityNumber == 5) {
        $corrections_fio[] = "Более устойчивые формы имени помогут найти баланс между свободой и ответственностью.";
    }
    if ($nameNumber == 6 || $soulNumber == 6 || $personalityNumber == 6) {
        $corrections_fio[] = "Использование полного имени поможет выстроить личные границы.";
    }
    if ($nameNumber == 7 || $soulNumber == 7 || $personalityNumber == 7) {
        $corrections_fio[] = "Более тёплые, уменьшительные формы помогут открыться миру и людям.";
    }
    if ($nameNumber == 8 || $soulNumber == 8 || $personalityNumber == 8) {
        $corrections_fio[] = "Мягкие, домашние формы имени смягчат властность и добавят человечности.";
    }
    if ($nameNumber == 9 || $soulNumber == 9 || $personalityNumber == 9) {
        $corrections_fio[] = "Более приземлённые формы имени помогут сохранять связь с реальностью.";
    }
    if (in_array($nameNumber, $missingNumbers)) {
        $corrections_fio[] = "Добавление в обращение имени, содержащего отсутствующее число, поможет развить недостающее качество.";
    }
    if (count($missingNumbers) > 2) {
        $corrections_fio[] = "Попробуйте использовать разные формы имени (полное, уменьшительное, отчество) в разных сферах жизни для баланса энергий.";
    }
    
    // 10. ЧИСЛО СУДЬБЫ И СКРЫТЫЙ ПОТЕНЦИАЛ
    $destinyNumber = reduceNumber($nameNumber + $soulNumber + $personalityNumber);
    $hiddenPotential = reduceNumber($personalityNumber + $destinyNumber);
    
    // 11. РАСШИФРОВКИ ДЛЯ СУММАРНОГО ЧИСЛА
    $totalData = $totalMeanings[$totalNumber] ?? [
        'title' => 'Искатель',
        'short' => 'Ваш путь уникален.',
        'full' => 'Ваше суммарное число открывает особый путь познания себя и мира. Исследуйте, развивайтесь, доверяйте своей интуиции.',
        'advice' => 'Будьте внимательны к знакам судьбы и не бойтесь своего пути.'
    ];
    
    // 12. ИНТЕРПРЕТАЦИИ
    $nameInterpretation = $interpretations[$nameNumber] ?? $interpretations[1];
    $soulInterpretation = $interpretations[$soulNumber] ?? $interpretations[1];
    $personalityInterpretation = $interpretations[$personalityNumber] ?? $interpretations[1];
    $karmicInterpretation = $interpretations[$karmicNumber] ?? $interpretations[1];
    
    // 13. СОХРАНЯЕМ В СЕССИЮ
    $_SESSION['fio_result'] = [
        'firstname' => $firstName,
        'lastname' => $lastName,
        'famely' => $Famely,
        'fullname' => $fullName,
        'numbers' => [
            'name' => $nameNumber,
            'soul' => $soulNumber,
            'personality' => $personalityNumber,
            'karmic' => $karmicNumber
        ],
        'interpretations' => [
            'name' => [
                'title' => $nameInterpretation['title'] ?? 'Лидер',
                'essence' => $nameInterpretation['essence'] ?? $nameInterpretation['name']['essence'] ?? 'Описание характера',
                'strengths' => $nameInterpretation['strengths'] ?? $nameInterpretation['name']['strengths'] ?? 'Сильные стороны',
                'weaknesses' => $nameInterpretation['weaknesses'] ?? $nameInterpretation['name']['weaknesses'] ?? 'Слабые стороны',
                'in_shadow' => $nameInterpretation['in_shadow'] ?? $nameInterpretation['name']['in_shadow'] ?? 'Теневая сторона',
                'mythology' => $nameInterpretation['mythology'] ?? '',
                'archetype' => $nameInterpretation['archetype'] ?? '',
                'sacred' => $nameInterpretation['sacred'] ?? '',
                'life' => $nameInterpretation['life'] ?? [],
                'intensity' => $nameInterpretation['intensity'] ?? [],
                'ages' => $nameInterpretation['ages'] ?? [],
                'celebrities' => $nameInterpretation['celebrities'] ?? '',
                'compatibility_matrix' => $nameInterpretation['compatibility_matrix'] ?? [],
                'recommendations' => $nameInterpretation['recommendations'] ?? [],
                'mission' => $nameInterpretation['mission'] ?? '',
                'keywords' => $nameInterpretation['keywords'] ?? '',
                'affirmations' => $nameInterpretation['affirmations'] ?? []
            ],
            'soul' => [
                'title' => $soulInterpretation['title'] ?? 'Загадочная душа',
                'essence' => $soulInterpretation['essence'] ?? $soulInterpretation['soul']['essence'] ?? 'Описание души',
                'desires' => $soulInterpretation['desires'] ?? $soulInterpretation['soul']['desires'] ?? 'Желания',
                'fears' => $soulInterpretation['fears'] ?? $soulInterpretation['soul']['fears'] ?? 'Страхи',
                'mythology' => $soulInterpretation['mythology'] ?? '',
                'archetype' => $soulInterpretation['archetype'] ?? '',
                'sacred' => $soulInterpretation['sacred'] ?? '',
                'strengths' => $soulInterpretation['strengths'] ?? '',
                'weaknesses' => $soulInterpretation['weaknesses'] ?? '',
                'in_shadow' => $soulInterpretation['in_shadow'] ?? '',
                'life' => $soulInterpretation['life'] ?? [],
                'celebrities' => $soulInterpretation['celebrities'] ?? '',
                'mission' => $soulInterpretation['mission'] ?? '',
                'keywords' => $soulInterpretation['keywords'] ?? '',
                'affirmations' => $soulInterpretation['affirmations'] ?? []
            ],
            'personality' => [
                'title' => $personalityInterpretation['title'] ?? 'Индивидуальность',
                'essence' => $personalityInterpretation['essence'] ?? $personalityInterpretation['personality']['essence'] ?? 'Описание личности',
                'image' => $personalityInterpretation['image'] ?? $personalityInterpretation['personality']['image'] ?? 'Образ',
                'first_impression' => $personalityInterpretation['first_impression'] ?? $personalityInterpretation['personality']['first_impression'] ?? 'Первое впечатление',
                'mythology' => $personalityInterpretation['mythology'] ?? '',
                'archetype' => $personalityInterpretation['archetype'] ?? '',
                'strengths' => $personalityInterpretation['strengths'] ?? '',
                'weaknesses' => $personalityInterpretation['weaknesses'] ?? '',
                'in_shadow' => $personalityInterpretation['in_shadow'] ?? '',
                'life' => $personalityInterpretation['life'] ?? [],
                'celebrities' => $personalityInterpretation['celebrities'] ?? '',
                'mission' => $personalityInterpretation['mission'] ?? '',
                'keywords' => $personalityInterpretation['keywords'] ?? '',
                'affirmations' => $personalityInterpretation['affirmations'] ?? []
            ],
            'karmic' => [
                'title' => $karmicInterpretation['title'] ?? 'Кармическая задача',
                'essence' => $karmicInterpretation['essence'] ?? $karmicInterpretation['name']['essence'] ?? '',
                'tasks' => $karmicInterpretation['karmic']['tasks'] ?? $karmicInterpretation['karmic_tasks'] ?? ['Познание себя'],
                'lesson' => $karmicInterpretation['karmic']['lesson'] ?? $karmicInterpretation['karmic_lesson'] ?? 'Главный урок',
                'mythology' => $karmicInterpretation['mythology'] ?? '',
                'archetype' => $karmicInterpretation['archetype'] ?? '',
                'strengths' => $karmicInterpretation['strengths'] ?? '',
                'weaknesses' => $karmicInterpretation['weaknesses'] ?? '',
                'in_shadow' => $karmicInterpretation['in_shadow'] ?? '',
                'life' => $karmicInterpretation['life'] ?? [],
                'celebrities' => $karmicInterpretation['celebrities'] ?? '',
                'mission' => $karmicInterpretation['mission'] ?? '',
                'keywords' => $karmicInterpretation['keywords'] ?? '',
                'affirmations' => $karmicInterpretation['affirmations'] ?? []
            ]
        ],
        'additional' => $additional_fio,
        'total' => [
            'value' => $totalNumber,
            'title' => $totalData['title'],
            'short' => $totalData['short'],
            'full' => $totalData['full'],
            'advice' => $totalData['advice']
        ],
        'spectrum' => [
            'all_numbers' => $allNameNumbers,
            'counts' => $spectrum,
            'dominant' => $dominantNumbers,
            'dominant_text' => $dominantText,
            'missing' => $missingNumbers,
            'missing_text' => $missingText,
            'balance' => $balanceText
        ],
        'subconscious' => [
            'number' => $subconsciousNumber,
            'meaning' => $subconsciousMeanings[$subconsciousNumber] ?? 'Ваше подсознание уникально. Доверяйте своей интуиции.'
        ],
        'dynamics' => [
            'sequence' => $allNameNumbers,
            'transitions' => $transitions,
            'analysis' => $dynamicAnalysis
        ],
        'corrections' => $corrections_fio,
        'destiny' => [
            'number' => $destinyNumber,
            'meaning' => $destinyMeanings[$destinyNumber] ?? 'Познание себя и мира'
        ],
        'hidden_potential' => [
            'number' => $hiddenPotential,
            'meaning' => $potentialMeanings[$hiddenPotential] ?? 'Раскройте свою уникальность'
        ],
        'calculated_at' => date('d.m.Y H:i:s')
    ];
    
    // 14. РЕДИРЕКТ НА СТРАНИЦУ РЕЗУЛЬТАТА
    header('Location: ' . ABS_PATH . 'supp/fio-result.php');
    exit;
}
}
// выводим реультат на бэкенде
?>
