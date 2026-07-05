<?php
$errMsg='';
$birthDate='';
$targetMonth='';
$ch1='';
//фронт
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['FrLifeChart'])) {
   // tt($_POST);
           $birthDate = $_POST['birthdate'];
       if (empty($birthDate)) {
        $errMsg .='Вы не ввели дату рождения<br>';
    }
    
    // 2. Валидация даты
    $date = DateTime::createFromFormat('Y-m-d', $birthDate);
    if (!$date) {
        $errMsg.='Вы некорректно ввели дату рождения<br>';
    } 
    $chdate=$_POST['consent'];
    if($chdate=='on')
        {
            $ch1='checked';
        }
    else
        {
            $ch1='';
        }
    if (empty($chdate)) 
        {
            $errMsg .='Дайте согласие на обработку персональных данных<br>';
        }
        //валидация пройдена
        if(empty($errMsg))
            {
                $birthDate = $_POST['birthdate']; // формат: YYYY-MM-DD
    list($year, $month, $day) = explode('-', $birthDate);
    
                // Преобразуем в целые числа
                $day = (int)$day;
                $month = (int)$month;
                $year = (int)$year;
                //tt($day.'<br>'.$month.'<br>'.$year);
                 $baseNumber = $day * $month * $year;
                // tt($baseNumber);
                $digitsString = (string)$baseNumber;      // "178740"
                $digits = array_map('intval', str_split($digitsString));
                //tt($digits);
                $digitsClean = array_filter($digits, function($v) {
                    return $v > 0;
                });
                //tt($digitsClean);
                $digitsClean = array_values($digitsClean);
                // Результат: [1, 7, 8, 7, 4]
                //tt($digitsClean);
                // Если вдруг пусто — fallback
                if (empty($digitsClean)) {
                    $digitsClean = [1, 2, 3, 4, 5];
                }
               // tt($digitsClean);
               $years = range(0, 60, 6);//разбиваем число на периоды по 6
                // Результат: [0, 6, 12, 18, 24, 30, 36, 42, 48, 54, 60]
                //tt($years);
                   $values = [];
    $countDigits = count($digitsClean);
    $countYears = count($years);
    
    for ($i = 0; $i < $countYears; $i++) {
        $index = $i % $countDigits;
        $values[] = $digitsClean[$index];
    }
    //tt($values);
    // Результат: [1, 7, 8, 7, 4, 1, 7, 8, 7, 4, 1]
    
    // ============================================
    // ШАГ 7: Формируем результат
    // ============================================
 include 'app/include/life-interpritation-front.php';
        
        $periods = [];
        foreach ($values as $value) {
            $periods[] = getFullInterpretation($value);
        }
        
        // ============================================
        // СТАТИСТИКА
        // ============================================
        $maxVal = max($values);
        $minVal = min($values);
        $avgVal = round(array_sum($values) / count($values), 1);
        
        $maxIndex = array_search($maxVal, $values);
        $minIndex = array_search($minVal, $values);
        
        $stats = [
            'max' => $maxVal,
            'max_age' => $years[$maxIndex],
            'min' => $minVal,
            'min_age' => $years[$minIndex],
            'average' => $avgVal,
            'trend' => $values[count($values)-1] > $values[0] ? 'rising' : 
                       ($values[count($values)-1] < $values[0] ? 'falling' : 'stable')
        ];
         // ---- МЕСЯЦА ДЛЯ ФОРМАТИРОВАНИЯ ДАТЫ ----
    $months = [
        1 => 'января', 2 => 'февраля', 3 => 'марта',
        4 => 'апреля', 5 => 'мая', 6 => 'июня',
        7 => 'июля', 8 => 'августа', 9 => 'сентября',
        10 => 'октября', 11 => 'ноября', 12 => 'декабря'
    ];
    
    // ============================================
    // 3. СОХРАНЯЕМ РЕЗУЛЬТАТ В СЕССИЮ
    // ============================================
    $_SESSION['life_chart_result'] = [
        'birthdate' => $birthDate,
        'day' => $day,
        'month' => $month,
        'year' => $year,
        'formatted_date' => $day . ' ' . $months[$month] . ' ' . $year . ' года',
        'base_number' => $baseNumber,
        'digits' => $digits,
        'digits_clean' => $digitsClean,
        'digits_display' => implode(' → ', $digitsClean),
        'years' => $years,
        'values' => $values,
        'periods' => $periods,
        'stats' => $stats,
        'calculation_details' => [
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'base_number' => $baseNumber,
            'digits_raw' => implode(' × ', $digits),
            'digits_clean' => implode(' → ', $digitsClean)
        ]
    ];
    
    // Сохраняем дату для формы
    $_SESSION['life_chart_birthdate'] = $birthDate;
    //$_SESSION['life_chart_consent'] = 'checked';
    
    // Очищаем ошибки
    //unset($_SESSION['life_chart_error']);
    
    // ============================================
    // 4. РЕДИРЕКТ НА СТРАНИЦУ РЕЗУЛЬТАТА
    // ============================================
    header('Location: ' . ABS_PATH . 'life-chart');
    exit;

    }
}

            
//фронт
?>
