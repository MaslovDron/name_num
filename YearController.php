<?php
$errMsg='';
$birthDate='';
$ch1='';
//функции

//функции
//на фронте
if($_SERVER['REQUEST_METHOD']=='POST' && isset ($_POST['FrYearCalc']))
{
   // tt($_POST);
    $birthDate = $_POST['birthdate'];
       if (empty($birthDate)) {
        $errMsg .='Вы не ввели дату<br>';
    }
    
    // 2. Валидация даты
    $date = DateTime::createFromFormat('Y-m-d', $birthDate);
    if (!$date) {
        $errMsg.='Вы некорректно ввели дату<br>';
    } 
    $chdate=$_POST['consent'];
    if($chdate=='on')
        {
            $ch1='checked';
        }
    else
        {
            $ch1=='';
        }
    if (empty($chdate)) 
        {
            $errMsg .='Дайте согласие на обработкуперсональных данных<br>';
        }
        //когда прошла валидация
        if(empty($errMsg))
            {
                //функции для расчета персонального года
                // Функция редукции чисел (с мастер-числами 11,22,33)
function reduceNumber($num) {
    if ($num == 11 || $num == 22 || $num == 33) return $num;
    while ($num > 9) $num = array_sum(str_split((string)$num));
    return $num;
}

// Расчёт персонального года
function calculatePersonalYear($birthdate, $targetYear = null) {
    if ($targetYear === null) {
        $targetYear = date('Y');
    }
    
    $birthTimestamp = strtotime($birthdate);
    if ($birthTimestamp === false) {
        return false;
    }
    
    $birthDay = date('d', $birthTimestamp);
    $birthMonth = date('m', $birthTimestamp);
    
    $daySum = array_sum(str_split($birthDay));
    $monthSum = array_sum(str_split($birthMonth));
    $yearSum = array_sum(str_split($targetYear));
    
    $sum = $daySum + $monthSum + $yearSum;
    
    return reduceNumber($sum);
}

// ============================================
// РАСЧЁТ ВСЕХ КОНТРОЛЬНЫХ ЧИСЕЛ
// ============================================
function calculateAllNumbers($birthdate, $currentYear) {
    $birthTimestamp = strtotime($birthdate);
    $birthDay = (int)date('d', $birthTimestamp);
    $birthMonth = (int)date('m', $birthTimestamp);
    $birthYear = (int)date('Y', $birthTimestamp);
    
    // Суммы цифр
    $daySum = array_sum(str_split($birthDay));
    $monthSum = array_sum(str_split($birthMonth));
    $birthYearSum = array_sum(str_split($birthYear));
    $currentYearSum = array_sum(str_split($currentYear));
    
    // Редуцированные базовые числа
    $reducedDay = reduceNumber($daySum);
    $reducedMonth = reduceNumber($monthSum);
    $reducedBirthYear = reduceNumber($birthYearSum);
    $reducedCurrentYear = reduceNumber($currentYearSum);
    
    // 1. Персональный год (основной)
    $personalYearRaw = $daySum + $monthSum + $currentYearSum;
    $personalYear = reduceNumber($personalYearRaw);
    
    // 2. Персональный месяц (для текущего месяца)
    $currentMonth = (int)date('m');
    $currentMonthSum = array_sum(str_split($currentMonth));
    $personalMonthRaw = $daySum + $monthSum + $currentMonthSum + $currentYearSum;
    $personalMonth = reduceNumber($personalMonthRaw);
    
    // 3. Кармическое число года
    $karmicYearRaw = $daySum + $monthSum + $birthYearSum;
    $karmicYear = reduceNumber($karmicYearRaw);
    
    // 4. Число судьбы (жизненный путь)
    $lifePathRaw = $daySum + $monthSum + $birthYearSum;
    $lifePath = reduceNumber($lifePathRaw);
    
    // 5. Цикл года (совпадает с персональным годом)
    $yearCycle = $personalYear;
    
    // 6. Энергетические пики по кварталам
    $quarter1 = reduceNumber($daySum + $monthSum);
    $quarter2 = reduceNumber($daySum + $reducedCurrentYear);
    $quarter3 = reduceNumber($monthSum + $reducedCurrentYear);
    $quarter4 = reduceNumber($daySum + $monthSum + $reducedCurrentYear);
    
    // 7. Число перехода (между годами)
    $transitionNumber = reduceNumber($personalYear + $lifePath);
    
    // 8. Духовное число года
    $spiritualNumber = reduceNumber($personalYear + $karmicYear);
    
    // 9. Число реализации (достижений)
    $achievementNumber = reduceNumber($personalYear + $lifePath + $karmicYear);
    
    // 10. Тест-число (внутренние вызовы)
    $challengeNumber = abs($reducedDay - $reducedMonth);
    if ($challengeNumber == 0) $challengeNumber = 9;
    $challengeNumber = reduceNumber($challengeNumber);
    
    // 11. Число дня рождения (простое)
    $birthDayNumber = $reducedDay;
    
    // 12. Число месяца рождения
    $birthMonthNumber = $reducedMonth;
    
    // 13. Зрелость (жизненный путь + персональный год)
    $maturityNumber = reduceNumber($lifePath + $personalYear);
    
    // 14. Личное число года (альтернативный расчёт)
    $personalYearAlt = reduceNumber($reducedDay + $reducedMonth + $reducedCurrentYear);
    
    // Собираем всё в массив
    return [
        'basic' => [
            'birth_day' => $birthDay,
            'birth_month' => $birthMonth,
            'birth_year' => $birthYear,
            'current_year' => $currentYear,
            'reduced_day' => $reducedDay,
            'reduced_month' => $reducedMonth,
            'reduced_birth_year' => $reducedBirthYear,
            'reduced_current_year' => $reducedCurrentYear
        ],
        'main' => [
            'personal_year' => $personalYear,
            'personal_month' => $personalMonth,
            'life_path' => $lifePath,
            'karmic_year' => $karmicYear
        ],
        'additional' => [
            'year_cycle' => $yearCycle,
            'transition' => $transitionNumber,
            'spiritual' => $spiritualNumber,
            'achievement' => $achievementNumber,
            'challenge' => $challengeNumber,
            'maturity' => $maturityNumber,
            'personal_year_alt' => $personalYearAlt,
            'birth_day_number' => $birthDayNumber,
            'birth_month_number' => $birthMonthNumber
        ],
        'quarters' => [
            'q1' => $quarter1,
            'q2' => $quarter2,
            'q3' => $quarter3,
            'q4' => $quarter4
        ]
    ];
}

                //функции для расчета персонального года
                 $currentYear = date('Y');
        
        // Рассчитываем персональный год
        $personalYear = calculatePersonalYear($birthDate, $currentYear);
        
        // Рассчитываем ВСЕ контрольные числа
        $allNumbers = calculateAllNumbers($birthDate, $currentYear);
        
        // Сохраняем результат в сессию
        $_SESSION['year_result'] = [
            'birthdate' => $birthDate,
            'current_year' => $currentYear,
            'personal_year' => $personalYear,
            'all_numbers' => $allNumbers,
            'calculated_at' => date('d.m.Y H:i:s')
        ];
        
        // Перенаправляем на страницу с результатом
        // $resultPage = selectOne('calc', ['id' => 12]); // ID вашего калькулятора года в БД
        // if ($resultPage && !empty($resultPage['ssilka_result_fr'])) {
        //     header('Location: ' . ABS_PATH . $resultPage['ssilka_result_fr']);
        // } else {
        //     // Запасной вариант
        //     header('Location: ' . ABS_PATH . 'personal-year-result.php');
        // }
        // exit;
        /////////////////////////////////////////////////////////////
            header('Location: ' . ABS_PATH . 'personal-year');
            exit;
        /////////////////////////////////////////////////////////////
            }
}
//на фронте
?>
