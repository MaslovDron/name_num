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
              // $years = range(0, 60, 6);//разбиваем число на периоды по 6
              $years = range(1, 61, 6);
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
   // tte($_SESSION);
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
//бэк
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['BackLifeCalc'])) {
    //tt($_POST);
         $birthDate = $_POST['daterozd'];
       if (empty($birthDate)) {
        $errMsg .='Вы не ввели дату рождения<br>';
    }
        // 2. Валидация даты
    $date = DateTime::createFromFormat('Y-m-d', $birthDate);
    $period=(int)$_POST['period'];
       if (empty($period)) {
        $errMsg .='Не задан период<br>';
    }
     if (empty($errMsg)) {
        
        // ---- 1. РАЗБИРАЕМ ДАТУ ----
        list($year, $month, $day) = explode('-', $birthDate);
        $day = (int)$day;
        $month = (int)$month;
        $year = (int)$year;
        
        // ---- 2. БАЗОВОЕ ЧИСЛО ----
        $baseNumber = $day * $month * $year;
        
        // ---- 3. РАЗБИВАЕМ НА ЦИФРЫ ----
        $digitsString = (string)$baseNumber;
        $digits = array_map('intval', str_split($digitsString));
        
        // ---- 4. УДАЛЯЕМ НУЛИ ----
        $digitsClean = array_filter($digits, function($v) {
            return $v > 0;
        });
        $digitsClean = array_values($digitsClean);
        
        if (empty($digitsClean)) {
            $digitsClean = [1, 2, 3, 4, 5];
        }
        
        // ---- 5. СОЗДАЁМ МАССИВ ПЕРИОДОВ (с выбранным шагом) ----
        $step = $period; // 1, 2, 3, 4, 5 или 6
        $years = range(1, 80, $step);
        
        // ---- 6. ЗАПОЛНЯЕМ ЗНАЧЕНИЯ ЦИКЛИЧЕСКИ ----
        $values = [];
        $countDigits = count($digitsClean);
        $countYears = count($years);
        
        for ($i = 0; $i < $countYears; $i++) {
            $index = $i % $countDigits;
            $values[] = $digitsClean[$index];
        }
        
        // ---- 7. ПОДКЛЮЧАЕМ РАСШИФРОВКИ ----
        include '../app/include/life-interpretation-ultimate.php';
        
        $periods = [];
        foreach ($values as $value) {
            $periods[] = getUltimateInterpretation($value);
        }
        
        // ---- 8. СТАТИСТИКА ----
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
        
        // ---- 9. МЕСЯЦА ДЛЯ ФОРМАТИРОВАНИЯ ДАТЫ ----
        $months = [
            1 => 'января', 2 => 'февраля', 3 => 'марта',
            4 => 'апреля', 5 => 'мая', 6 => 'июня',
            7 => 'июля', 8 => 'августа', 9 => 'сентября',
            10 => 'октября', 11 => 'ноября', 12 => 'декабря'
        ];
        
        // ---- 10. ФОРМИРУЕМ МАССИВ ДЛЯ СОХРАНЕНИЯ ----
        $resultData = [
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
            'step' => $step,
            'calculation_details' => [
                'day' => $day,
                'month' => $month,
                'year' => $year,
                'base_number' => $baseNumber,
                'digits_raw' => implode(' × ', $digits),
                'digits_clean' => implode(' → ', $digitsClean),
                'step' => $step,
                'periods_count' => count($years)
            ]
        ];
        //формируем html файл
         $periodsUltimate = [];
    foreach ($values as $value) {
    $periodsUltimate[] = getUltimateInterpretation($value);
    }
        // СОЗДАЁМ HTML-ФАЙЛ
// ============================================================
$order_id = time() . '_' . rand(100, 999);
$filename = "life_chart_{$order_id}_{$day}-{$month}-{$year}.html";

$save_dir = "../results/";
if (!is_dir($save_dir)) {
    mkdir($save_dir, 0777, true);
}
$filepath = $save_dir . $filename;
$file_url = ABS_PATH . "results/" . $filename;

// ============================================================
// ГЕНЕРАЦИЯ HTML-КОНТЕНТА
// ============================================================
ob_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📈 Карта Жизни — полный разбор</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/all-style.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/sovmest.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* ===== ОСНОВНЫЕ СТИЛИ ===== */
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: linear-gradient(145deg, #fefaf4 0%, #f9f2ea 100%); font-family: 'Georgia', 'Times New Roman', serif; color: #2c2c2c; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px 20px 40px; }
        
        /* ===== ШАПКА ===== */
        .header-pif { text-align: center; margin: 30px 0 40px; padding: 20px; background: linear-gradient(145deg, #fefaf4, #fff); border-radius: 40px 40px 40px 0; border-left: 12px solid #b38b5f; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
        .header-pif h1 { font-size: 42px; color: #3b2b22; margin-bottom: 15px; font-weight: 400; letter-spacing: 1px; }
        .header-pif h1 i { color: #b38b5f; margin-right: 15px; }
        .header-pif .subtitle { font-size: 20px; color: #8a6e4b; font-style: italic; }
        
        /* ===== ДАТА ===== */
        .date-info { display: flex; justify-content: center; align-items: center; gap: 30px; flex-wrap: wrap; margin: 40px 0; }
        .date-item { background: white; padding: 25px 20px; border-radius: 30px; text-align: center; border: 1px solid #f0e4d6; box-shadow: 0 5px 15px rgba(0,0,0,0.02); transition: 0.2s; min-width: 120px; }
        .date-item:hover { border-color: #b38b5f; transform: translateY(-3px); }
        .date-value { font-size: 38px; font-weight: bold; color: #b38b5f; margin-bottom: 8px; line-height: 1.2; }
        .date-label { color: #6a5a4c; font-size: 15px; text-transform: uppercase; letter-spacing: 1px; }
        .date-badge { background: #f0e6d2; padding: 5px 15px; border-radius: 30px; font-size: 14px; margin-top: 8px; display: inline-block; color: #5a3a2a; }
        
        /* ===== ГЛАВНЫЙ БЛОК ===== */
        .compatibility-score { text-align: center; margin: 30px 0; }
        .score-circle { width: 180px; height: 180px; margin: 0 auto; background: linear-gradient(135deg, #b38b5f, #8a6e4b); border-radius: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; box-shadow: 0 15px 35px rgba(179, 139, 95, 0.3); }
        .score-value { font-size: 56px; font-weight: bold; }
        .score-label { font-size: 18px; opacity: 0.9; text-align: center; }
        .level-badge { display: inline-block; padding: 8px 25px; border-radius: 60px; font-size: 20px; font-weight: bold; margin: 15px 0; background: #f0e6d2; color: #5a3a2a; }
        .month-title { font-size: 28px; color: #3b2b22; margin: 15px 0 10px; }
        .month-short-desc { font-size: 18px; color: #6a5a4c; max-width: 600px; margin: 0 auto; }
        
        /* ===== ГРАФИК ===== */
        .chart-section { background: white; border-radius: 30px; padding: 30px; border: 1px solid #f0e4d6; margin-bottom: 40px; }
        .chart-section h2 { text-align: center; font-size: 24px; color: #3b2b22; margin-bottom: 20px; font-weight: 400; }
        .chart-wrapper { height: 380px; }
        .chart-legend { display: flex; justify-content: center; gap: 25px; margin-top: 15px; font-size: 14px; color: #6a5a4c; }
        .legend-item { font-weight: 600; }
        
        /* ===== ЗАГОЛОВКИ РАЗДЕЛОВ ===== */
        .matrix-title { font-size: 32px; color: #3b2b22; margin: 50px 0 30px; display: flex; align-items: center; gap: 15px; border-bottom: 3px solid #f0e4d6; padding-bottom: 15px; }
        .matrix-title i { color: #b38b5f; font-size: 28px; background: #f5efe8; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        
        /* ===== КАРТОЧКИ СТАТИСТИКИ ===== */
        .stats-grid-result { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin: 30px 0 40px; }
        .stat-card-result { background: #f9f5f0; border-radius: 20px; padding: 20px; text-align: center; border: 1px solid #f0e4d6; transition: 0.2s; }
        .stat-card-result:hover { transform: translateY(-3px); border-color: #b38b5f; }
        .stat-card-result .stat-value { font-size: 38px; font-weight: bold; color: #b38b5f; }
        .stat-card-result .stat-label { font-size: 16px; color: #6a5a4c; margin-top: 5px; }
        .stat-card-result.peak .stat-value { color: #2ecc71; }
        .stat-card-result.low .stat-value { color: #e74c3c; }
        
        /* ===== ПЕРИОДЫ ===== */
        .periods-grid-result { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .period-card-result { background: #f9f5f0; border-radius: 20px; padding: 20px; text-align: center; border: 1px solid #f0e4d6; transition: 0.2s; }
        .period-card-result:hover { transform: translateY(-3px); border-color: #b38b5f; }
        .period-card-result.peak { border-color: #2ecc71; background: #f0fff4; }
        .period-card-result.low { border-color: #e74c3c; background: #fff5f5; }
        .period-card-result .period-age { font-size: 22px; font-weight: bold; color: #3b2b22; }
        .period-card-result .period-value { font-size: 42px; font-weight: bold; color: #b38b5f; margin: 5px 0; }
        .period-card-result .period-status { font-size: 18px; color: #6a5a4c; margin-top: 5px; }
        .period-card-result .period-desc { font-size: 15px; color: #8b7a6b; margin-top: 8px; }
        
        /* ===== ДЕТАЛЬНЫЙ РАЗБОР ===== */
        .details-grid-result { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 30px 0 40px; }
        .detail-card-result { background: #f9f5f0; border-radius: 20px; padding: 20px; border: 1px solid #f0e4d6; transition: 0.2s; }
        .detail-card-result:hover { border-color: #b38b5f; transform: translateY(-3px); }
        .detail-card-result .detail-title { font-size: 20px; font-weight: bold; color: #b38b5f; margin-bottom: 10px; border-bottom: 2px solid #f0e4d6; padding-bottom: 8px; }
        .detail-card-result .detail-item { font-size: 15px; color: #4a3f38; padding: 5px 0; line-height: 1.5; }
        .detail-card-result .detail-item strong { color: #8a6e4b; }
        .detail-card-result .detail-emoji { font-size: 24px; margin-right: 8px; }
        .detail-card-result .detail-full { font-size: 15px; color: #4a3f38; padding: 8px 0; line-height: 1.6; border-top: 1px solid #f0e4d6; margin-top: 8px; }
        
        /* ===== ДЕТАЛЬНЫЕ СОВЕТЫ ===== */
        .ultimate-details { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin: 10px 0; }
        .ultimate-item { background: #f5efe8; border-radius: 12px; padding: 10px 12px; font-size: 14px; line-height: 1.4; border-left: 3px solid #b38b5f; }
        .ultimate-item strong { color: #8a6e4b; display: block; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 3px; }
        .ultimate-item .value { color: #3b2b22; }
        
        /* ===== АРХЕТИП ===== */
        .archetype-box { background: #f5efe8; border-radius: 16px; padding: 15px 20px; margin: 10px 0; border-left: 4px solid #b38b5f; }
        .archetype-box .label { font-size: 12px; text-transform: uppercase; color: #8b7a6b; letter-spacing: 1px; }
        .archetype-box .text { font-size: 18px; color: #3b2b22; font-weight: 500; }
        
        /* ===== ПРОГНОЗ ===== */
        .forecast-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin: 10px 0; }
        .forecast-item { background: #f5efe8; border-radius: 12px; padding: 10px 12px; font-size: 14px; border-left: 3px solid #b38b5f; }
        .forecast-item strong { color: #8a6e4b; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; }
        .forecast-item .value { color: #3b2b22; display: block; margin-top: 2px; }
        
        /* ===== КАРТОЧКА КАЧЕСТВА ===== */
        .quality-card { background: white; border-left: 8px solid #b38b5f; padding: 30px; margin: 20px 0; border-radius: 30px; box-shadow: 0 8px 20px rgba(0,0,0,0.02); transition: 0.2s; font-size: 18px; line-height: 1.7; color: #4a3f38; }
        .quality-card:hover { box-shadow: 0 15px 30px rgba(179, 139, 95, 0.08); transform: translateX(5px); }
        .quality-title { font-weight: 700; color: #3b2b22; font-size: 20px; display: inline-block; margin-right: 10px; }
        .quality-text { margin-top: 10px; }
        
        /* ===== РАСЧЁТНЫЕ ДАННЫЕ ===== */
        .info-block-custom { background: #f9f5f0; border-radius: 20px; padding: 20px; margin-bottom: 40px; }
        .info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e0d5c8; }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #8b7a6b; }
        .info-value { font-weight: bold; color: #3b2b22; }
        
        /* ===== КНОПКИ ===== */
        .action-buttons { display: flex; justify-content: center; gap: 20px; margin: 40px 0 30px; flex-wrap: wrap; }
        .btn { display: inline-flex; align-items: center; gap: 10px; padding: 16px 35px; font-size: 18px; border-radius: 60px; text-decoration: none; transition: 0.2s; cursor: pointer; border: none; font-weight: 600; border-bottom: 4px solid transparent; }
        .btn-primary { background: #8a6e4b; color: white; border-bottom-color: #5e3e2b; }
        .btn-primary:hover { background: #6f543a; transform: translateY(-2px); }
        
        /* ===== ПРИЗЫВ ===== */
        .summa0 { text-align: center; margin: 30px 0; }
        .summa { display: inline-block; background: linear-gradient(135deg, #8a6e4b 0%, #b38b5f 100%); color: white; font-size: 28px; font-weight: bold; padding: 18px 40px; border-radius: 60px; box-shadow: 0 10px 20px rgba(179, 139, 95, 0.3); border-bottom: 4px solid #5e3e2b; }
        
        /* ===== ФУТЕР ===== */
        .footer-pif { text-align: center; margin-top: 60px; padding: 30px 0; color: #8b7a6b; border-top: 2px solid #f0e4d6; font-size: 15px; }
        .footer-pif p { margin: 8px 0; }
        .footer-pif i { color: #b38b5f; margin-right: 8px; }
        
        /* ===== АДАПТИВ ===== */
        @media (max-width: 1024px) { .details-grid-result { grid-template-columns: 1fr; } .ultimate-details { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 768px) { .stats-grid-result { grid-template-columns: repeat(2, 1fr); } .periods-grid-result { grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); } .chart-wrapper { height: 280px; } .ultimate-details { grid-template-columns: 1fr; } .forecast-grid { grid-template-columns: 1fr; } }
        @media (max-width: 480px) { .stats-grid-result { grid-template-columns: 1fr; } .periods-grid-result { grid-template-columns: repeat(2, 1fr); } .info-row { flex-direction: column; align-items: flex-start; gap: 5px; } .header-pif h1 { font-size: 28px; } .score-circle { width: 140px; height: 140px; } .score-value { font-size: 42px; } }
        
        /* ===== ПЕЧАТЬ ===== */
        @media print { @page { margin: 0.5cm; size: A4; } @top-center, @bottom-center { content: ""; } .no-print { display: none !important; } }
    </style>
</head>
<body>
<div class="landing">
    <div class="container">
        
        <!-- ===== ЗАГОЛОВОК ===== -->
        <div class="header-pif">
            <h1><i class="fas fa-chart-line"></i> Карта Жизни</h1>
            <div class="subtitle">Полный нумерологический разбор по дате рождения</div>
        </div>
        
        <!-- ===== ИНФОРМАЦИЯ О ДАТЕ ===== -->
        <div class="date-info">
            <div class="date-item">
                <div class="date-value"><?= $day ?></div>
                <div class="date-label">День рождения</div>
                <div class="date-badge"><i class="fas fa-calendar-alt"></i> <?= $month ?> месяц</div>
            </div>
            <div style="font-size: 48px; font-weight: bold; color: #b38b5f;">→</div>
            <div class="date-item">
                <div class="date-value"><?= $day ?>.<?= $month ?>.<?= $year ?></div>
                <div class="date-label">Дата рождения</div>
                <div class="date-badge"><i class="fas fa-chart-line"></i> шаг <?= $step ?> года</div>
            </div>
        </div>
        
        <!-- ===== ГЛАВНЫЙ БЛОК ===== -->
        <div class="compatibility-score" style="margin-bottom: 40px;">
            <div class="score-circle">
                <div class="score-value"><?= $stats['max'] ?></div>
                <div class="score-label">максимум<br>энергии</div>
            </div>
            <div style="margin-top: 20px;">
                <span class="level-badge"><i class="fas fa-code"></i> <?= implode(' → ', $digitsClean) ?></span>
            </div>
            <div class="month-title">Базовое число: <?= number_format($baseNumber) ?></div>
            <div class="month-short-desc">
                Всего периодов: <strong><?= count($years) ?></strong> (шаг <?= $step ?> года, до <?= max($years) ?> лет)
            </div>
        </div>
        
        <!-- ===== ГРАФИК ===== -->
        <div class="chart-section">
            <h2><i class="fas fa-chart-line" style="color: #b38b5f;"></i> График жизненной энергии</h2>
            <div class="chart-wrapper">
                <canvas id="lifeChart"></canvas>
            </div>
            <div class="chart-legend">
                <span class="legend-item" style="color: #2ecc71;">●</span> Пик энергии (7-9)
                <span class="legend-item" style="color: #3498db;">●</span> Стабильность (4-6)
                <span class="legend-item" style="color: #e74c3c;">●</span> Спад энергии (1-3)
            </div>
        </div>
        
        <!-- ===== КЛЮЧЕВЫЕ ВЫВОДЫ ===== -->
        <div class="quality-card">
            <div class="quality-title">📖 Ключевые выводы</div>
            <div class="quality-text">
                <p><strong>Пик энергии:</strong> <?= $stats['max'] ?> в <?= $stats['max_age'] ?> <?= getAgeWord($stats['max_age']) ?></p>
                <p><strong>Спад энергии:</strong> <?= $stats['min'] ?> в <?= $stats['min_age'] ?> <?= getAgeWord($stats['min_age']) ?></p>
                <p><strong>Средний уровень:</strong> <?= $stats['average'] ?></p>
                <p><strong>Тренд:</strong> 
                    <?php if ($stats['trend'] == 'rising'): ?>📈 Восходящий
                    <?php elseif ($stats['trend'] == 'falling'): ?>📉 Нисходящий
                    <?php else: ?>➡️ Стабильный<?php endif; ?>
                </p>
            </div>
        </div>
        
        <!-- ===== СТАТИСТИКА ===== -->
        <h2 class="matrix-title"><i class="fas fa-chart-bar"></i> Статистика энергии</h2>
        <div class="stats-grid-result">
            <div class="stat-card-result peak">
                <div class="stat-value"><?= $stats['max'] ?></div>
                <div class="stat-label">📈 Максимум в <?= $stats['max_age'] ?> <?= getAgeWord($stats['max_age']) ?></div>
            </div>
            <div class="stat-card-result low">
                <div class="stat-value"><?= $stats['min'] ?></div>
                <div class="stat-label">📉 Минимум в <?= $stats['min_age'] ?> <?= getAgeWord($stats['min_age']) ?></div>
            </div>
            <div class="stat-card-result">
                <div class="stat-value"><?= $stats['average'] ?></div>
                <div class="stat-label">📊 Средний уровень</div>
            </div>
            <div class="stat-card-result">
                <div class="stat-value">
                    <?php if ($stats['trend'] == 'rising'): ?>⬆
                    <?php elseif ($stats['trend'] == 'falling'): ?>⬇
                    <?php else: ?>➡<?php endif; ?>
                </div>
                <div class="stat-label">
                    <?php if ($stats['trend'] == 'rising'): ?>Восходящий тренд
                    <?php elseif ($stats['trend'] == 'falling'): ?>Нисходящий тренд
                    <?php else: ?>Стабильный<?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- ===== ВСЕ ПЕРИОДЫ ===== -->
        <h2 class="matrix-title"><i class="fas fa-list"></i> Все периоды жизни</h2>
        <div class="periods-grid-result">
            <?php foreach ($years as $index => $age): 
                $value = $values[$index];
                $period = $periodsUltimate[$index];
                $isPeak = $value >= 7;
                $isLow = $value <= 3;
                $cardClass = $isPeak ? 'peak' : ($isLow ? 'low' : '');
            ?>
            <div class="period-card-result <?= $cardClass ?>">
                <div class="period-age"><?= $age ?> <?= getAgeWord($age) ?></div>
                <div class="period-value" style="color: <?= $period['color'] ?>">
                    <?= $value ?>
                </div>
                <div class="period-status"><?= $period['emoji'] ?> <?= $period['status'] ?></div>
                <div class="period-desc"><?= $period['short'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- ===== ДЕТАЛЬНЫЙ РАЗБОР ===== -->
        <h2 class="matrix-title"><i class="fas fa-heart"></i> Детальный разбор по сферам</h2>
        <div class="details-grid-result">
            <?php foreach ($years as $index => $age): 
                $period = $periodsUltimate[$index];
            ?>
            <div class="detail-card-result">
                <div class="detail-title">
                    <span class="detail-emoji"><?= $period['emoji'] ?></span>
                    <?= $age ?> <?= getAgeWord($age) ?> — <?= $period['status'] ?>
                </div>
                
                <div class="detail-full"><?= $period['full'] ?></div>
                
                <div class="detail-item"><strong>💡 Совет:</strong> <?= $period['advice'] ?></div>
                <div class="detail-item"><strong>❤️ Любовь:</strong> <?= $period['love'] ?></div>
                <div class="detail-item"><strong>💼 Работа:</strong> <?= $period['work'] ?></div>
                <div class="detail-item"><strong>💰 Финансы:</strong> <?= $period['finance'] ?></div>
                <div class="detail-item"><strong>🏥 Здоровье:</strong> <?= $period['health'] ?></div>
                <div class="detail-item"><strong>🧘 Духовность:</strong> <?= $period['spiritual'] ?></div>
                
                <?php if (isset($period['detailed_advice'])): ?>
                <div style="margin-top: 12px; padding-top: 12px; border-top: 2px solid #f0e4d6;">
                    <div class="ultimate-details">
                        <div class="ultimate-item"><strong>Что делать</strong><span class="value"><?= $period['detailed_advice']['Что делать'] ?></span></div>
                        <div class="ultimate-item"><strong>Чего избегать</strong><span class="value"><?= $period['detailed_advice']['Чего избегать'] ?></span></div>
                        <div class="ultimate-item"><strong>С кем общаться</strong><span class="value"><?= $period['detailed_advice']['С кем общаться'] ?></span></div>
                        <div class="ultimate-item"><strong>Где искать вдохновение</strong><span class="value"><?= $period['detailed_advice']['Где искать вдохновение'] ?></span></div>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (isset($period['archetype'])): ?>
                <div class="archetype-box" style="margin-top:12px;">
                    <div class="label">🎭 Архетип периода</div>
                    <div class="text"><?= $period['archetype'] ?></div>
                    <div style="display:flex; gap:15px; margin-top:5px; flex-wrap:wrap; font-size:13px; color:#6a5a4c;">
                        <span><strong>Урок:</strong> <?= $period['life_lesson'] ?></span>
                        <span><strong>Суперсила:</strong> <?= $period['superpower'] ?></span>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (isset($period['element'])): ?>
                <div style="display:flex; flex-wrap:wrap; gap:8px; margin-top:10px; font-size:13px; color:#6a5a4c; background:#f5efe8; border-radius:12px; padding:10px;">
                    <span><strong>🌿 Стихия:</strong> <?= $period['element'] ?></span>
                    <span><strong>🪐 Планета:</strong> <?= $period['planet'] ?></span>
                    <span><strong>🃏 Таро:</strong> <?= $period['tarot'] ?></span>
                    <span><strong>💎 Камни:</strong> <?= $period['crystals'] ?></span>
                    <span><strong>🌸 Аромат:</strong> <?= $period['aroma'] ?></span>
                    <span><strong>🔮 Чакра:</strong> <?= $period['chakra'] ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (isset($period['forecast'])): ?>
                <div style="margin-top:10px;">
                    <div style="font-size:13px; font-weight:bold; color:#8a6e4b; margin-bottom:5px;">📊 Прогноз на период:</div>
                    <div class="forecast-grid">
                        <div class="forecast-item"><strong>Общий</strong><span class="value"><?= $period['forecast']['общий'] ?></span></div>
                        <div class="forecast-item"><strong>Карьера</strong><span class="value"><?= $period['forecast']['карьера'] ?></span></div>
                        <div class="forecast-item"><strong>Отношения</strong><span class="value"><?= $period['forecast']['отношения'] ?></span></div>
                        <div class="forecast-item"><strong>Финансы</strong><span class="value"><?= $period['forecast']['финансы'] ?></span></div>
                    </div>
                </div>
                <?php endif; ?>
                
                <div style="margin-top:12px; padding-top:12px; border-top: 2px solid #f0e4d6; display:flex; flex-wrap:wrap; gap:15px; font-size:14px;">
                    <div style="flex:1; min-width:200px; background:#f0e6d2; border-radius:12px; padding:10px;">
                        <strong>⚡ Действие:</strong><br>
                        <span style="color:#3b2b22;"><?= $period['action'] ?></span>
                    </div>
                    <div style="flex:1; min-width:200px; background:#e8d9f0; border-radius:12px; padding:10px;">
                        <strong>✨ Аффирмация:</strong><br>
                        <span style="color:#3b2b22;">"<?= $period['affirmation'] ?>"</span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- ===== РАСЧЁТНЫЕ ДАННЫЕ ===== -->
        <h2 class="matrix-title"><i class="fas fa-calculator"></i> Как мы рассчитали</h2>
        <div class="info-block-custom">
            <div class="info-row"><span class="info-label">День рождения:</span><span class="info-value"><?= $day ?></span></div>
            <div class="info-row"><span class="info-label">Месяц рождения:</span><span class="info-value"><?= $month ?></span></div>
            <div class="info-row"><span class="info-label">Год рождения:</span><span class="info-value"><?= $year ?></span></div>
            <div class="info-row"><span class="info-label">Базовое число:</span><span class="info-value"><?= $day ?> × <?= $month ?> × <?= $year ?> = <?= number_format($baseNumber) ?></span></div>
            <div class="info-row"><span class="info-label">Разбивка на цифры:</span><span class="info-value"><?= implode(' × ', $digits) ?></span></div>
            <div class="info-row"><span class="info-label">Жизненный код (без нулей):</span><span class="info-value"><?= implode(' → ', $digitsClean) ?></span></div>
            <div class="info-row"><span class="info-label">Шаг периода:</span><span class="info-value"><?= $step ?> года</span></div>
            <div class="info-row"><span class="info-label">Количество периодов:</span><span class="info-value"><?= count($years) ?> (до <?= max($years) ?> лет)</span></div>
        </div>
        
        <!-- ===== ПРИЗЫВ ===== -->
        <div class="summa0">
            <div class="summa">💎 Полный разбор Карты Жизни — 379 рублей</div>
        </div>
        
        <!-- ===== КНОПКИ ===== -->
        <div class="action-buttons no-print">
            <button onclick="window.print()" class="btn btn-primary" style="background: #9b59b6; border-bottom-color: #6a3d7a;">
                <i class="fas fa-file-pdf"></i> Сохранить в PDF
            </button>
        </div>
        
        <!-- ===== ФУТЕР ===== -->
        <div class="footer-pif">
            <p><i class="far fa-clock"></i> Расчёт выполнен: <?= date('d.m.Y H:i:s') ?></p>
            <p>© <?= date('Y') ?> Карта Жизни | Нумерологический прогноз</p>
        </div>
        
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const years = <?= json_encode($years) ?>;
    const values = <?= json_encode($values) ?>;
    
    const colors = values.map(v => {
        if (v >= 7) return '#2ecc71';
        if (v <= 3) return '#e74c3c';
        return '#3498db';
    });
    
    const ctx = document.getElementById('lifeChart');
    if (!ctx) return;
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: years.map(y => y + ''),
            datasets: [{
                label: 'Уровень энергии',
                data: values,
                backgroundColor: 'rgba(179, 139, 95, 0.15)',
                borderColor: '#b38b5f',
                borderWidth: 3,
                tension: 0.4,
                pointBackgroundColor: colors,
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 8,
                pointHoverRadius: 12,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 13 },
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            const value = context.raw;
                            const statuses = {
                                1: '🌱 Новое начало',
                                2: '🤝 Партнёрство',
                                3: '🎨 Творчество',
                                4: '🏗️ Стабильность',
                                5: '🌈 Перемены',
                                6: '💖 Гармония',
                                7: '🔮 Мудрость',
                                8: '💰 Успех',
                                9: '🌟 Завершение'
                            };
                            return statuses[value] || '🌀 Трансформация';
                        },
                        afterLabel: function(context) {
                            return 'Возраст: ' + years[context.dataIndex] + ' ' + getAgeWord(years[context.dataIndex]);
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 12 }, color: '#636e72' },
                    title: {
                        display: true,
                        text: 'Возраст (лет)',
                        font: { size: 14, weight: 'bold' },
                        color: '#2d3436'
                    }
                },
                y: {
                    min: 0,
                    max: 10,
                    ticks: { stepSize: 1, font: { size: 12 }, color: '#636e72' },
                    grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                    title: {
                        display: true,
                        text: 'Уровень энергии',
                        font: { size: 14, weight: 'bold' },
                        color: '#2d3436'
                    }
                }
            }
        }
    });
});

function getAgeWord(age) {
    const lastDigit = age % 10;
    const lastTwoDigits = age % 100;
    if (lastTwoDigits >= 11 && lastTwoDigits <= 14) return 'лет';
    if (lastDigit == 1) return 'год';
    if (lastDigit >= 2 && lastDigit <= 4) return 'года';
    return 'лет';
}
</script>

</body>
</html>
<?php
$html_content = ob_get_clean();
file_put_contents($filepath, $html_content);

        //формируем html файл
           
        // ---- 11. СОХРАНЯЕМ В СЕССИЮ (как в MonthController) ----
        $_SESSION['life_chart_result_sup'] = $resultData;
        //$_SESSION['file_url']=$file_url;
        
        // ---- 12. РЕДИРЕКТ НА СТРАНИЦУ РЕЗУЛЬТАТА ----
        header('Location: ' . ABS_PATH . 'supp/life-chart-result-sup.php');
        exit;
    }
}
//бэк
?>
