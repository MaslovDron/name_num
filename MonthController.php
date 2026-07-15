<?php
$errMsg='';
$birthDate='';
$targetMonth='';
$ch1='';
//на фронте
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['FrMonthCalc'])) {
    //echo '1111';
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
                //подключаем расшифровку
                include 'app/include/month-front.php';
                //подключаем расшифровку
                //подключаем функции для месяца
                include 'app/include/month-function.php';
                //подключаем функции для месяца

            // Разбираем дату рождения
        $birthDateObj = new DateTime($birthDate);
        $day = (int)$birthDateObj->format('d');
        $month = (int)$birthDateObj->format('m');  
        // Текущий месяц и год (можно будет заменить на выбранные позже)
        $currentMonth = (int)date('n');  // 1..12
        $currentYear = (int)date('Y');

        $result = calculatePersonalMonth($day, $month, $currentMonth, $currentYear);
        $personalMonth = $result['personal_month'];
        // Получаем расшифровку ДО сохранения в сессию
        $interpretation = getMonthInterpretation($personalMonth);
                
        $_SESSION['month_result'] = [
            'birthdate' => $birthDate,
            'current_year' => $currentYear,
            'current_month' => $currentMonth,
            'current_month_name' => getRussianMonthName($currentMonth),
            'personal_year' => $result['personal_year'],
            'personal_month' => $result['personal_month'],
            'calculation_details' => [
                'day_raw' => $day,
                'month_raw' => $month,
                'day_reduced' => $result['details']['day_reduced'],
                'month_reduced' => $result['details']['month_reduced'],
                'year_reduced' => $result['details']['year_reduced'],
                'personal_year_raw' => $result['details']['personal_year_raw'],
                'personal_month_raw' => $result['details']['personal_month_raw']
            ],
            // 👇 СОХРАНЯЕМ РАСШИФРОВКУ
            'interpretation' => $interpretation
        ];
        
        header('Location: ' . ABS_PATH . 'personal-month');
        exit;
            }
}
//на фронте
//на бэке
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['BackMonthCalc'])) {
    //tt($_POST);
     $birthDate = $_POST['daterozd'];
       if (empty($birthDate)) {
        $errMsg .='Вы не ввели дату рождения<br>';
    }
        // 2. Валидация даты
    $date = DateTime::createFromFormat('Y-m-d', $birthDate);
    if (!$date) {
        $errMsg.='Вы некорректно ввели дату<br>';
    }
      $targetMonth = trim($_POST['intMon'] ?? '');
        if (empty($targetMonth)) {
        $errMsg .='Вы не ввели интересующий год<br>';
    }
    $targetMonInt = (int)$targetMonth;
    $currentYearInt = (int)date('Y');
       if ($targetMonInt < $currentYearInt) {
            $errMsg .= "Интересующий год ($targetMonInt) не может быть меньше текущего года ($currentYearInt)<br>";
        }
        //1111
        if(empty($errMsg))
            {
                /*
                // Подключаем функции и данные
        include '../app/include/month-back.php';
        include '../app/include/month-function.php';
        
        // Разбиваем месяц на год и номер месяца
        list($targetYear, $targetMonthNum) = explode('-', $targetMonth);
        $targetYear = (int)$targetYear;
        $targetMonthNum = (int)$targetMonthNum;
        
        // Разбираем дату рождения
        $birthDateObj = new DateTime($birthDate);
        $day = (int)$birthDateObj->format('d');
        $month = (int)$birthDateObj->format('m');
        $birthYear = (int)$birthDateObj->format('Y');
        
        // ============================================================
        // РАСЧЁТ КОНТРОЛЬНЫХ ЧИСЕЛ
        // ============================================================
        
        // Шаг 1: Редуцируем день рождения
        $dayReduced = reduceToMasterOrSingle($day);
        
        // Шаг 2: Редуцируем месяц рождения
        $monthReduced = reduceToMasterOrSingle($month);
        
        // Шаг 3: Редуцируем выбранный год
        $yearReduced = reduceToMasterOrSingle($targetYear);
        
        // Шаг 4: Персональный год
        $personalYearRaw = $dayReduced + $monthReduced + $yearReduced;
        $personalYear = reduceToMasterOrSingle($personalYearRaw);
        
        // Шаг 5: Персональный месяц
        $personalMonthRaw = $personalYear + $targetMonthNum;
        $personalMonth = reduceToMasterOrSingle($personalMonthRaw);
        
        // Шаг 6: Дополнительные контрольные числа
        $lifePathRaw = $day + $month + $birthYear;
        $lifePath = reduceToMasterOrSingle($lifePathRaw);
        
        $karmicMonthRaw = $personalMonth + $lifePath;
        $karmicMonth = reduceToMasterOrSingle($karmicMonthRaw);
        
        $transitionRaw = $personalYear + $personalMonth;
        $transition = reduceToMasterOrSingle($transitionRaw);
        
        $achievementRaw = $personalMonth + $dayReduced;
        $achievement = reduceToMasterOrSingle($achievementRaw);
        
        $challenge = abs($personalMonth - $lifePath);
        if ($challenge > 9) {
            $challenge = reduceToMasterOrSingle($challenge);
        }
        
        $maturityRaw = $lifePath + $personalMonth;
        $maturity = reduceToMasterOrSingle($maturityRaw);
        
        $birthDayNumber = $dayReduced;
        $birthMonthNumber = $monthReduced;
        
        // ============================================================
        // ПОЛУЧАЕМ ПОЛНУЮ РАСШИФРОВКУ (с action и всеми полями)
        // ============================================================
        $interpretation = getMonthInterpretation($personalMonth);
        
        // ЯВНО добавляем action, если его нет (на всякий случай)
        if (!isset($interpretation['action'])) {
            $interpretation['action'] = 'Доверьтесь интуиции в этом месяце.';
        }
        
        // Явно добавляем недели и дни, если их нет
        if (!isset($interpretation['weeks'])) {
            $interpretation['weeks'] = [];
        }
        if (!isset($interpretation['days'])) {
            $interpretation['days'] = [];
        }
        
        $monthName = getRussianMonthName($targetMonthNum);
        
        // ============================================================
        // СОХРАНЯЕМ ВСЁ В СЕССИЮ
        // ============================================================
        $_SESSION['month_result_sup'] = [
            'birthdate' => $birthDate,
            'target_year' => $targetYear,
            'target_month' => $targetMonthNum,
            'target_month_name' => $monthName,
            'personal_year' => $personalYear,
            'personal_month' => $personalMonth,
            'interpretation' => $interpretation, // ✅ ПОЛНАЯ РАСШИФРОВКА (с action)
            
            // Все контрольные числа
            'control_numbers' => [
                'day_reduced' => $dayReduced,
                'month_reduced' => $monthReduced,
                'year_reduced' => $yearReduced,
                'personal_year_raw' => $personalYearRaw,
                'personal_month_raw' => $personalMonthRaw,
                'life_path' => $lifePath,
                'karmic_month' => $karmicMonth,
                'transition' => $transition,
                'achievement' => $achievement,
                'challenge' => $challenge,
                'maturity' => $maturity,
                'birth_day_number' => $birthDayNumber,
                'birth_month_number' => $birthMonthNumber
            ],
            
            // Детали расчёта (для вывода)
            'calculation_details' => [
                'day_raw' => $day,
                'month_raw' => $month,
                'day_reduced' => $dayReduced,
                'month_reduced' => $monthReduced,
                'year_reduced' => $yearReduced,
                'personal_year_raw' => $personalYearRaw,
                'personal_month_raw' => $personalMonthRaw
            ]
        ];
        
        header('Location: ' . ABS_PATH . 'supp/personal-month-result-sup.php');
        exit;  //
        */
         // Подключаем функции и данные
        include '../app/include/month-front.php';
        include '../app/include/month-function.php';
        include '../app/include/month-back.php'; // для платной версии
        
        // Разбиваем месяц на год и номер месяца
        list($targetYear, $targetMonthNum) = explode('-', $targetMonth);
        $targetYear = (int)$targetYear;
        $targetMonthNum = (int)$targetMonthNum;
        
        // Разбираем дату рождения
        $birthDateObj = new DateTime($birthDate);
        $day = (int)$birthDateObj->format('d');
        $month = (int)$birthDateObj->format('m');
        $birthYear = (int)$birthDateObj->format('Y');
        
        // ============================================================
        // РАСЧЁТ КОНТРОЛЬНЫХ ЧИСЕЛ
        // ============================================================
        $dayReduced = reduceToMasterOrSingle($day);
        $monthReduced = reduceToMasterOrSingle($month);
        $yearReduced = reduceToMasterOrSingle($targetYear);
        
        $personalYearRaw = $dayReduced + $monthReduced + $yearReduced;
        $personalYear = reduceToMasterOrSingle($personalYearRaw);
        
        $personalMonthRaw = $personalYear + $targetMonthNum;
        $personalMonth = reduceToMasterOrSingle($personalMonthRaw);
        
        $lifePathRaw = $day + $month + $birthYear;
        $lifePath = reduceToMasterOrSingle($lifePathRaw);
        
        $karmicMonthRaw = $personalMonth + $lifePath;
        $karmicMonth = reduceToMasterOrSingle($karmicMonthRaw);
        
        $transitionRaw = $personalYear + $personalMonth;
        $transition = reduceToMasterOrSingle($transitionRaw);
        
        $achievementRaw = $personalMonth + $dayReduced;
        $achievement = reduceToMasterOrSingle($achievementRaw);
        
        $challenge = abs($personalMonth - $lifePath);
        if ($challenge > 9) {
            $challenge = reduceToMasterOrSingle($challenge);
        }
        
        $maturityRaw = $lifePath + $personalMonth;
        $maturity = reduceToMasterOrSingle($maturityRaw);
        
        $birthDayNumber = $dayReduced;
        $birthMonthNumber = $monthReduced;
        
        // ============================================================
        // ПОЛУЧАЕМ РАСШИФРОВКУ
        // ============================================================
        $interpretation = getMonthInterpretation($personalMonth);
        
        // Гарантируем наличие всех ключей
        if (!isset($interpretation['action'])) {
            $interpretation['action'] = 'Доверьтесь интуиции в этом месяце.';
        }
        if (!isset($interpretation['weeks'])) {
            $interpretation['weeks'] = [];
        }
        if (!isset($interpretation['days'])) {
            $interpretation['days'] = [];
        }
        
        $monthName = getRussianMonthName($targetMonthNum);
        
        // ============================================================
        // СОЗДАЁМ HTML-ФАЙЛ
        // ============================================================
        $order_id = time() . '_' . rand(100, 999);
        $filename = "personal_month_{$order_id}_{$targetYear}-{$targetMonthNum}_{$personalMonth}.html";
        
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
    <title>Персональный месяц — число <?= $personalMonth ?> | Нумерологический прогноз</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/all-style.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/sovmest.css">
    <style>
        .date-badge { background: #f0e6d2; padding: 5px 15px; border-radius: 30px; font-size: 14px; margin-top: 8px; display: inline-block; color: #5a3a2a; }
        .month-number-large { font-size: 80px; font-weight: bold; color: #8b5f9e; line-height: 1; }
        .month-title { font-size: 28px; color: #3b2b22; margin: 15px 0 10px; }
        .month-short-desc { font-size: 18px; color: #6a5a4c; max-width: 600px; margin: 0 auto; }
        .numbers-grid-result { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .number-card-result { background: #f9f5f0; border-radius: 20px; padding: 20px; text-align: center; border: 1px solid #f0e4d6; transition: 0.2s; }
        .number-card-result:hover { transform: translateY(-3px); border-color: #8b5f9e; }
        .number-card-result .num { font-size: 42px; font-weight: bold; color: #8b5f9e; }
        .number-card-result .label { font-size: 14px; color: #6a5a4c; margin-top: 5px; }
        .number-card-result .desc { font-size: 12px; color: #8b7a6b; margin-top: 8px; }
        .week-grid-result { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .week-card-result { background: #f9f5f0; border-radius: 20px; padding: 20px; text-align: center; border: 1px solid #f0e4d6; }
        .week-card-result .num { font-size: 28px; font-weight: bold; color: #8b5f9e; }
        .week-card-result .week-label { font-size: 14px; color: #6a5a4c; margin: 5px 0 10px; }
        .week-card-result .week-text { font-size: 13px; color: #4a3f38; line-height: 1.4; }
        .day-grid-result { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; margin-bottom: 40px; }
        .day-card-result { background: #f9f5f0; border-radius: 15px; padding: 12px 15px; border: 1px solid #f0e4d6; text-align: center; }
        .day-card-result .day-label { font-weight: bold; color: #8b5f9e; font-size: 14px; }
        .day-card-result .day-text { font-size: 12px; color: #4a3f38; margin-top: 5px; line-height: 1.3; }
        .info-text { background: #f9f5f0; padding: 10px 15px; border-radius: 15px; margin-top: 8px; font-size: 13px; color: #4a3f38; }
        .highlight-box { background: #f0e6d2; border-radius: 20px; padding: 20px 25px; margin: 20px 0 30px; border-left: 6px solid #8b5f9e; }
        .sector-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .sector-card { background: #f9f5f0; border-radius: 20px; padding: 20px; border: 1px solid #f0e4d6; transition: 0.2s; }
        .sector-card:hover { border-color: #8b5f9e; transform: translateY(-3px); }
        .sector-card .sector-title { font-size: 18px; font-weight: bold; color: #8b5f9e; margin-bottom: 10px; }
        .sector-card .sector-text { font-size: 15px; color: #4a3f38; line-height: 1.5; }
        @media print { @page { margin: 0.5cm; size: A4; } @top-center, @bottom-center { content: ""; } .no-print { display: none !important; } }
        @media (max-width: 768px) { .week-grid-result { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 480px) { .week-grid-result { grid-template-columns: 1fr; } .day-grid-result { grid-template-columns: repeat(2, 1fr); } .sector-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<div class="landing">
    <div class="container">
        
        <!-- ЗАГОЛОВОК -->
        <div class="header-pif">
            <h1><i class="fas fa-moon"></i> Персональный месяц</h1>
            <div class="subtitle">Детальный нумерологический прогноз</div>
        </div>
        
        <!-- ИНФОРМАЦИЯ О ДАТАХ -->
        <div class="date-info" style="display: flex; justify-content: center; align-items: center; gap: 30px; flex-wrap: wrap;">
            <div class="date-item">
                <div class="date-value"><?= date('d', strtotime($birthDate)) ?></div>
                <div class="date-label">День рождения</div>
                <div class="date-badge"><i class="fas fa-calendar-alt"></i> <?= date('m', strtotime($birthDate)) ?> месяц</div>
            </div>
            <div style="font-size: 48px; font-weight: bold; color: #8b5f9e;">→</div>
            <div class="date-item">
                <div class="date-value"><?= $monthName ?> <?= $targetYear ?></div>
                <div class="date-label">Месяц расчёта</div>
                <div class="date-badge"><i class="fas fa-chart-line"></i> персональный</div>
            </div>
        </div>
        
        <!-- ГЛАВНОЕ ЧИСЛО МЕСЯЦА -->
        <div class="compatibility-score" style="margin-bottom: 40px;">
            <div class="score-circle">
                <div class="score-value"><?= $personalMonth ?></div>
                <div class="score-label">персональный<br>месяц</div>
            </div>
            <div class="month-title"><?= $interpretation['title'] ?></div>
            <div class="month-short-desc" style="margin-top: 15px;"><?= $interpretation['subtitle'] ?? $interpretation['full_desc'] ?></div>
        </div>
        
        <!-- ГЛОБАЛЬНЫЙ СМЫСЛ -->
        <div class="quality-card">
            <div class="quality-title">📖 Глобальный смысл месяца</div>
            <div class="quality-text"><?= $interpretation['full_desc'] ?></div>
        </div>
        
        <div class="quality-card">
            <div class="quality-title">🎯 Главные задачи месяца</div>
            <div class="quality-text"><?= $interpretation['opportunities'] ?></div>
        </div>
        
        <!-- ПРЕДОСТЕРЕЖЕНИЯ -->
        <div class="quality-card" style="border-left-color: #e74c3c;">
            <div class="quality-title">⚠️ На что обратить внимание</div>
            <div class="quality-text"><?= $interpretation['warning'] ?></div>
        </div>
        
        <!-- КАМЕНЬ И ЦВЕТ -->
        <div style="display: flex; gap: 20px; flex-wrap: wrap; margin: 20px 0 30px;">
            <div style="background: #f9f5f0; border-radius: 20px; padding: 15px 25px; border: 1px solid #f0e4d6; flex: 1;">
                <strong style="color: #8b5f9e;">💎 Камень месяца:</strong> <?= $interpretation['stone'] ?>
            </div>
            <div style="background: #f9f5f0; border-radius: 20px; padding: 15px 25px; border: 1px solid #f0e4d6; flex: 1;">
                <strong style="color: #8b5f9e;">🎨 Цвет месяца:</strong> <?= $interpretation['color'] ?>
            </div>
        </div>
        
        <!-- ДЕЙСТВИЕ -->
        <div class="highlight-box">
            <div style="font-size: 24px; margin-bottom: 8px;">⚡ Ваше действие на этот месяц</div>
            <div style="font-size: 18px; color: #3b2b22; font-weight: 500;"><?= $interpretation['action'] ?></div>
        </div>
        
        <!-- КЛЮЧЕВЫЕ ЧИСЛА -->
        <h2 class="matrix-title"><i class="fas fa-magic"></i> Ключевые числа</h2>
        <div class="numbers-grid-result">
            <div class="number-card-result"><div class="num"><?= $personalMonth ?></div><div class="label">Персональный месяц</div><div class="desc">Главное число месяца</div></div>
            <div class="number-card-result"><div class="num"><?= $personalYear ?></div><div class="label">Персональный год</div><div class="desc">Энергия года</div></div>
            <div class="number-card-result"><div class="num"><?= $lifePath ?></div><div class="label">Число судьбы</div><div class="desc">Ваш жизненный путь</div></div>
            <div class="number-card-result"><div class="num"><?= $karmicMonth ?></div><div class="label">Кармическое число месяца</div><div class="desc">Уроки и задачи</div></div>
        </div>
        
        <!-- ДОПОЛНИТЕЛЬНЫЕ КОНТРОЛЬНЫЕ ЧИСЛА -->
        <h2 class="matrix-title"><i class="fas fa-chart-bar"></i> Дополнительные контрольные числа</h2>
        <div class="numbers-grid-result">
            <div class="number-card-result"><div class="num"><?= $transition ?></div><div class="label">Число перехода</div><div class="desc">Переходная энергия</div></div>
            <div class="number-card-result"><div class="num"><?= $achievement ?></div><div class="label">Число реализации</div><div class="desc">Потенциал достижений</div></div>
            <div class="number-card-result"><div class="num"><?= $challenge ?></div><div class="label">Тест-число (вызовы)</div><div class="desc">Внутренние вызовы месяца</div></div>
            <div class="number-card-result"><div class="num"><?= $maturity ?></div><div class="label">Число зрелости</div><div class="desc">Судьба + персональный месяц</div></div>
            <div class="number-card-result"><div class="num"><?= $birthDayNumber ?></div><div class="label">Число дня рождения</div><div class="desc">Личный талант и характер</div></div>
            <div class="number-card-result"><div class="num"><?= $birthMonthNumber ?></div><div class="label">Число месяца рождения</div><div class="desc">Эмоциональный фон</div></div>
        </div>
        
        <!-- ПРОГНОЗ ПО СФЕРАМ ЖИЗНИ -->
        <h2 class="matrix-title"><i class="fas fa-chart-line"></i> Прогноз по сферам жизни</h2>
        <div class="sector-grid">
            <div class="sector-card"><div class="sector-title">💼 Карьера и бизнес</div><div class="sector-text"><?= $interpretation['career'] ?? $interpretation['finance'] ?></div></div>
            <div class="sector-card"><div class="sector-title">💰 Финансы и деньги</div><div class="sector-text"><?= $interpretation['money'] ?? $interpretation['finance'] ?></div></div>
            <div class="sector-card"><div class="sector-title">❤️ Любовь и отношения</div><div class="sector-text"><?= $interpretation['love'] ?></div></div>
            <div class="sector-card"><div class="sector-title">🏠 Семья</div><div class="sector-text"><?= $interpretation['family'] ?? 'Время для укрепления семейных уз.' ?></div></div>
            <div class="sector-card"><div class="sector-title">🤝 Друзья</div><div class="sector-text"><?= $interpretation['friends'] ?? 'Будьте открыты к новым знакомствам.' ?></div></div>
            <div class="sector-card"><div class="sector-title">🏥 Здоровье</div><div class="sector-text"><?= $interpretation['health'] ?? 'Уделите внимание своему самочувствию.' ?></div></div>
            <div class="sector-card"><div class="sector-title">🎨 Творчество</div><div class="sector-text"><?= $interpretation['creativity'] ?? 'Вдохновение придёт к вам.' ?></div></div>
            <div class="sector-card"><div class="sector-title">📚 Обучение</div><div class="sector-text"><?= $interpretation['learning'] ?? 'Хорошее время для получения новых знаний.' ?></div></div>
        </div>
        
        <!-- ПРОГНОЗ ПО НЕДЕЛЯМ -->
        <h2 class="matrix-title"><i class="fas fa-calendar-week"></i> Прогноз по неделям</h2>
        <div class="week-grid-result">
            <?php 
            $weeksCount = ceil(date('t', strtotime($targetYear . '-' . $targetMonthNum . '-01')) / 7);
            for ($week = 1; $week <= $weeksCount; $week++): 
                $weekText = $interpretation['weeks'][$week] ?? 'Неделя ' . $week . ' — время для внутренней работы.';
            ?>
            <div class="week-card-result">
                <div class="num">Неделя <?= $week ?></div>
                <div class="week-label"><?= $monthName ?></div>
                <div class="week-text"><?= $weekText ?></div>
            </div>
            <?php endfor; ?>
        </div>
        
        <!-- ПРОГНОЗ ПО ДНЯМ -->
        <h2 class="matrix-title"><i class="fas fa-calendar-day"></i> Прогноз по дням</h2>
        <div class="day-grid-result">
            <?php 
            $daysInMonth = date('t', strtotime($targetYear . '-' . $targetMonthNum . '-01'));
            for ($day = 1; $day <= $daysInMonth; $day++): 
                $dayText = $interpretation['days'][$day] ?? 'День ' . $day . ' — прислушайтесь к себе.';
            ?>
            <div class="day-card-result">
                <div class="day-label">📅 <?= $day ?> <?= $monthName ?></div>
                <div class="day-text"><?= $dayText ?></div>
            </div>
            <?php endfor; ?>
        </div>
        
        <!-- ИСХОДНЫЕ ДАННЫЕ -->
        <h2 class="matrix-title"><i class="fas fa-database"></i> Исходные данные расчёта</h2>
        <div style="background: #f9f5f0; border-radius: 20px; padding: 20px; margin-bottom: 40px;">
            <div class="info-row" style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e0d5c8;"><span class="info-label">Дата рождения:</span><span class="info-value"><?= date('d.m.Y', strtotime($birthDate)) ?></span></div>
            <div class="info-row" style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e0d5c8;"><span class="info-label">Год расчёта:</span><span class="info-value"><?= $targetYear ?></span></div>
            <div class="info-row" style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e0d5c8;"><span class="info-label">Месяц расчёта:</span><span class="info-value"><?= $monthName ?></span></div>
            <div class="info-row" style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e0d5c8;"><span class="info-label">Персональный год:</span><span class="info-value"><?= $personalYear ?></span></div>
            <div class="info-row" style="display: flex; justify-content: space-between; padding: 8px 0;"><span class="info-label">Персональный месяц:</span><span class="info-value"><?= $personalMonth ?></span></div>
        </div>
        
        <!-- КНОПКИ -->
        <div class="action-buttons no-print">
            <button onclick="window.print()" class="btn btn-primary" style="background: #9b59b6;"><i class="fas fa-file-pdf"></i> Сохранить в PDF</button>
        </div>
        
        <!-- ФУТЕР -->
        <div class="footer-pif">
            <p><i class="far fa-clock"></i> Расчёт выполнен: <?= date('d.m.Y H:i:s') ?></p>
            <p>© <?= date('Y') ?> Персональный месяц | Нумерологический прогноз</p>
        </div>
        
    </div>
</div>
</body>
</html>
        <?php
        $html_content = ob_get_clean();
        file_put_contents($filepath, $html_content);
        
        // Сохраняем всё в сессию
        $_SESSION['month_result_sup'] = [
            'birthdate' => $birthDate,
            'target_year' => $targetYear,
            'target_month' => $targetMonthNum,
            'target_month_name' => $monthName,
            'personal_year' => $personalYear,
            'personal_month' => $personalMonth,
            'interpretation' => $interpretation,
            'control_numbers' => [
                'day_reduced' => $dayReduced,
                'month_reduced' => $monthReduced,
                'year_reduced' => $yearReduced,
                'personal_year_raw' => $personalYearRaw,
                'personal_month_raw' => $personalMonthRaw,
                'life_path' => $lifePath,
                'karmic_month' => $karmicMonth,
                'transition' => $transition,
                'achievement' => $achievement,
                'challenge' => $challenge,
                'maturity' => $maturity,
                'birth_day_number' => $birthDayNumber,
                'birth_month_number' => $birthMonthNumber
            ],
            'calculation_details' => [
                'day_raw' => $day,
                'month_raw' => $month,
                'day_reduced' => $dayReduced,
                'month_reduced' => $monthReduced,
                'year_reduced' => $yearReduced,
                'personal_year_raw' => $personalYearRaw,
                'personal_month_raw' => $personalMonthRaw
            ],
            'filename' => $filename,
            'file_url' => $file_url,
            'generated_at' => date('d.m.Y H:i:s')
        ];
        
        // Перенаправляем на страницу результата
         header('Location: ' . ABS_PATH . 'supp/personal-month-result-sup.php');
        exit;
            }
        //1111
}
//на бэке
?>
