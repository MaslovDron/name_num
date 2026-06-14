<?php
// month-functions.php - все функции для персонального месяца

/**
 * Сворачивание числа до 1-9 или мастер-числа (11,22,33)
 */
function reduceToMasterOrSingle($num) {
    if ($num == 11 || $num == 22 || $num == 33) {
        return $num;
    }
    while ($num > 9) {
        $sum = 0;
        $numStr = (string)$num;
        for ($i = 0; $i < strlen($numStr); $i++) {
            $sum += (int)$numStr[$i];
        }
        $num = $sum;
        if ($num == 11 || $num == 22 || $num == 33) {
            return $num;
        }
    }
    return $num;
}

/**
 * Получение названия месяца на русском
 */
function getRussianMonthName($monthNum) {
    $months = [
        1 => 'январь', 2 => 'февраль', 3 => 'март', 4 => 'апрель',
        5 => 'май', 6 => 'июнь', 7 => 'июль', 8 => 'август',
        9 => 'сентябрь', 10 => 'октябрь', 11 => 'ноябрь', 12 => 'декабрь'
    ];
    return $months[$monthNum] ?? '';
}

/**
 * Получение расшифровки по числу месяца (загружает данные из month-data.php)
 */
function getMonthInterpretation($number) {
    global $monthInterpretations;
    return $monthInterpretations[$number] ?? $monthInterpretations[1];
}

/**
 * Расчет персонального месяца (принимает день, месяц рождения, текущий месяц и год)
 */
function calculatePersonalMonth($birthDay, $birthMonth, $currentMonth, $currentYear) {
    $dayReduced = reduceToMasterOrSingle($birthDay);
    $monthReduced = reduceToMasterOrSingle($birthMonth);
    $yearReduced = reduceToMasterOrSingle($currentYear);
    
    $personalYearRaw = $dayReduced + $monthReduced + $yearReduced;
    $personalYear = reduceToMasterOrSingle($personalYearRaw);
    
    $personalMonthRaw = $personalYear + $currentMonth;
    $personalMonth = reduceToMasterOrSingle($personalMonthRaw);
    
    return [
        'personal_year' => $personalYear,
        'personal_month' => $personalMonth,
        'details' => [
            'day_reduced' => $dayReduced,
            'month_reduced' => $monthReduced,
            'year_reduced' => $yearReduced,
            'personal_year_raw' => $personalYearRaw,
            'personal_month_raw' => $personalMonthRaw
        ]
    ];
}
?>
