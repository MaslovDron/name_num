<?php
$errMsg='';
$birthDate='';
$targetYear='';
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
                //подключаем расшифровку
                include 'app/include/year-front.php';
                //подключаем расшифровку
                //функции для расчета персонального года
                // Функция редукции чисел (с мастер-числами 11,22,33)
///////////////////////////////////////////////////////////////////////////////////////                
include 'app/include/pers-year-function.php';
///////////////////////////////////////////////////////////////////////////////////////

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
    'interpretation' => [
        'title' => getYearTitle($personalYear),
        'short_desc' => getYearShort($personalYear),
        'full_desc' => getYearFull($personalYear),
        'opportunities' => getYearOpportunities($personalYear),
        'warning' => getYearWarning($personalYear),
        'color' => getYearColor($personalYear),
        'stone' => getYearStone($personalYear),
        'number' => getYearNumber($personalYear)
    ],
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
//на беке
if($_SERVER['REQUEST_METHOD']=='POST' && isset ($_POST['BackYearCalc']))
{
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
    $targetYear = trim($_POST['intgod'] ?? '');
        if (empty($targetYear)) {
        $errMsg .='Вы не ввели интересующий год<br>';
    }
    $targetYearInt = (int)$targetYear;
    $currentYearInt = (int)date('Y');
       if ($targetYearInt < $currentYearInt) {
            $errMsg .= "Интересующий год ($targetYearInt) не может быть меньше текущего года ($currentYearInt)<br>";
        }
        if(empty($errMsg))
            {
                //подключаем функции для персонального года
                include '../app/include/pers-year-function.php';
                //подключаем функции для персонального года
                //подключаем расшифровку  для персонального года
                include '../app/include/pers-year-interpr-supp.php';
                //подключаем расшифровку  для персонального года
                 // Берём год из POST (пользователь ввёл в поле intgod)
    $targetYear = $targetYearInt; // $targetYearInt уже есть из валидации
    
    // Рассчитываем персональный год
    $personalYear = calculatePersonalYear($birthDate, $targetYear);
    
    // Рассчитываем все контрольные числа
    $allNumbers = calculateAllNumbers($birthDate, $targetYear);
    
    // Получаем расшифровку для этого года
    $interpretation = getUltimateInterpretation($personalYear);
    
    // Заполняем сессию
    $_SESSION['year_report'] = [
        'birthdate' => $birthDate,
        'target_year' => $targetYear,
        'personal_year' => $personalYear,
        'all_numbers' => $allNumbers,
        'interpretation' => $interpretation,
        'generated_at' => date('d.m.Y H:i:s')
    ];

       // ========== СОЗДАЁМ HTML-ФАЙЛ ==========
    $order_id = time() . '_' . rand(100, 999);
    $filename = "personal_year_{$order_id}_{$targetYear}_{$personalYear}.html";
    
    $save_dir = "../results/";
    if (!is_dir($save_dir)) {
        mkdir($save_dir, 0777, true);
    }
    $filepath = $save_dir . $filename;
    $file_url = ABS_PATH . "results/" . $filename;
    
    // Сохраняем имя файла в сессию
    $_SESSION['year_report']['filename'] = $filename;
    $_SESSION['year_report']['file_url'] = $file_url;
    
    // Генерируем HTML-контент
    ob_start();
    ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Персональный год — число <?= $personalYear ?> | Нумерологический прогноз</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/all-style.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/sovmest.css">
    <style>
        .date-badge { background: #f0e6d2; padding: 5px 15px; border-radius: 30px; font-size: 14px; margin-top: 8px; display: inline-block; color: #5a3a2a; }
        .year-number-large { font-size: 80px; font-weight: bold; color: #b38b5f; line-height: 1; }
        .year-title { font-size: 28px; color: #3b2b22; margin: 15px 0 10px; }
        .year-short-desc { font-size: 18px; color: #6a5a4c; max-width: 600px; margin: 0 auto; }
        .numbers-grid-result { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .number-card-result { background: #f9f5f0; border-radius: 20px; padding: 20px; text-align: center; border: 1px solid #f0e4d6; transition: 0.2s; }
        .number-card-result:hover { transform: translateY(-3px); border-color: #b38b5f; }
        .number-card-result .num { font-size: 42px; font-weight: bold; color: #b38b5f; }
        .number-card-result .label { font-size: 14px; color: #6a5a4c; margin-top: 5px; }
        .number-card-result .desc { font-size: 12px; color: #8b7a6b; margin-top: 8px; }
        .quarter-grid-result { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 40px; }
        .quarter-card-result { background: #f9f5f0; border-radius: 20px; padding: 20px; text-align: center; border: 1px solid #f0e4d6; }
        .quarter-card-result .num { font-size: 36px; font-weight: bold; color: #b38b5f; }
        .info-text { background: #f9f5f0; padding: 10px 15px; border-radius: 15px; margin-top: 8px; font-size: 13px; color: #4a3f38; }
        .month-card { background: #f9f5f0; border-radius: 15px; padding: 15px; border: 1px solid #f0e4d6; }
        .month-name { font-weight: bold; color: #b38b5f; margin-bottom: 10px; font-size: 18px; }
        .month-advice { font-size: 15px; color: #4a4a4a; line-height: 1.5; }
        @media print { @page { margin: 0.5cm; size: A4; } @top-center, @bottom-center { content: ""; } .no-print { display: none !important; } }
        @media (max-width: 768px) { .quarter-grid-result { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 480px) { .quarter-grid-result { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<div class="landing">
    <div class="container">
        
        <div class="header-pif">
            <h1><i class="fas fa-calendar-alt"></i> Персональный год</h1>
            <div class="subtitle">Детальный нумерологический прогноз</div>
        </div>
        
        <div class="date-info" style="display: flex; justify-content: center; align-items: center; gap: 30px; flex-wrap: wrap;">
            <div class="date-item">
                <div class="date-value"><?= date('d', strtotime($birthDate)) ?></div>
                <div class="date-label">День рождения</div>
                <div class="date-badge"><i class="fas fa-calendar-alt"></i> <?= date('m', strtotime($birthDate)) ?> месяц</div>
            </div>
            <div style="font-size: 48px; font-weight: bold; color: #b38b5f;">→</div>
            <div class="date-item">
                <div class="date-value"><?= $targetYear ?></div>
                <div class="date-label">Год расчёта</div>
                <div class="date-badge"><i class="fas fa-chart-line"></i> персональный</div>
            </div>
        </div>
        
        <div class="compatibility-score" style="margin-bottom: 40px;">
            <div class="score-circle">
                <div class="score-value"><?= $personalYear ?></div>
                <div class="score-label">персональный год</div>
            </div>
            <div class="year-title"><?= $interpretation['title'] ?></div>
            <div class="year-short-desc" style="margin-top: 15px;"><?= $interpretation['subtitle'] ?></div>
        </div>
        
        <div class="quality-card"><div class="quality-title">📖 Глобальный смысл года</div><div class="quality-text"><?= $interpretation['meaning'] ?></div></div>
        <div class="quality-card"><div class="quality-title">🎯 Главные задачи года</div><div class="quality-text"><?= $interpretation['tasks'] ?></div></div>
        
        <h2 class="matrix-title"><i class="fas fa-magic"></i> Ключевые числа</h2>
        <div class="numbers-grid-result">
            <div class="number-card-result"><div class="num"><?= $allNumbers['main']['personal_year'] ?></div><div class="label">Персональный год</div><div class="desc">Главное число года</div></div>
            <div class="number-card-result"><div class="num"><?= $allNumbers['main']['personal_month'] ?></div><div class="label">Персональный месяц</div><div class="desc">Энергия текущего месяца</div></div>
            <div class="number-card-result"><div class="num"><?= $allNumbers['main']['life_path'] ?></div><div class="label">Число судьбы</div><div class="desc">Ваш жизненный путь</div></div>
            <div class="number-card-result"><div class="num"><?= $allNumbers['main']['karmic_year'] ?></div><div class="label">Кармическое число года</div><div class="desc">Уроки и задачи</div></div>
        </div>
        
        <h2 class="matrix-title"><i class="fas fa-chart-bar"></i> Дополнительные контрольные числа</h2>
        <div class="numbers-grid-result">
            <div class="number-card-result"><div class="num"><?= $allNumbers['additional']['year_cycle'] ?></div><div class="label">Цикл года</div><div class="desc">Совпадает с персональным годом</div></div>
            <div class="number-card-result"><div class="num"><?= $allNumbers['additional']['transition'] ?></div><div class="label">Число перехода</div><div class="desc">Переходная энергия между годами</div></div>
            <div class="number-card-result"><div class="num"><?= $allNumbers['additional']['spiritual'] ?></div><div class="label">Духовное число</div><div class="desc">Духовные задачи и рост</div></div>
            <div class="number-card-result"><div class="num"><?= $allNumbers['additional']['achievement'] ?></div><div class="label">Число реализации</div><div class="desc">Потенциал достижений</div></div>
            <div class="number-card-result"><div class="num"><?= $allNumbers['additional']['challenge'] ?></div><div class="label">Тест-число (вызовы)</div><div class="desc">Внутренние вызовы года</div></div>
            <div class="number-card-result"><div class="num"><?= $allNumbers['additional']['maturity'] ?></div><div class="label">Число зрелости</div><div class="desc">Судьба + персональный год</div></div>
            <div class="number-card-result"><div class="num"><?= $allNumbers['additional']['birth_day_number'] ?></div><div class="label">Число дня рождения</div><div class="desc">Личный талант и характер</div></div>
            <div class="number-card-result"><div class="num"><?= $allNumbers['additional']['birth_month_number'] ?></div><div class="label">Число месяца рождения</div><div class="desc">Эмоциональный фон</div></div>
        </div>
        
        <h2 class="matrix-title"><i class="fas fa-calendar-week"></i> Энергетические пики по кварталам</h2>
        <div class="quarter-grid-result">
            <div class="quarter-card-result"><div class="num"><?= $allNumbers['quarters']['q1'] ?></div><div class="label">1 квартал</div><div class="desc">Январь — Март</div><div class="info-text">Период планирования и постановки целей</div></div>
            <div class="quarter-card-result"><div class="num"><?= $allNumbers['quarters']['q2'] ?></div><div class="label">2 квартал</div><div class="desc">Апрель — Июнь</div><div class="info-text">Период активной работы и закладки фундамента</div></div>
            <div class="quarter-card-result"><div class="num"><?= $allNumbers['quarters']['q3'] ?></div><div class="label">3 квартал</div><div class="desc">Июль — Сентябрь</div><div class="info-text">Период плодов и коррекции планов</div></div>
            <div class="quarter-card-result"><div class="num"><?= $allNumbers['quarters']['q4'] ?></div><div class="label">4 квартал</div><div class="desc">Октябрь — Декабрь</div><div class="info-text">Завершающий этап, подведение итогов</div></div>
        </div>
        
        <h2 class="matrix-title"><i class="fas fa-chart-line"></i> Прогноз по сферам жизни</h2>
        <div class="quality-card"><div class="quality-title">💼 Карьера и бизнес</div><div class="quality-text"><?= $interpretation['career'] ?></div></div>
        <div class="quality-card"><div class="quality-title">💰 Финансы и деньги</div><div class="quality-text"><?= $interpretation['money'] ?></div></div>
        <div class="quality-card"><div class="quality-title">❤️ Любовь и отношения</div><div class="quality-text"><?= $interpretation['love'] ?></div></div>
        <div class="quality-card"><div class="quality-title">🏠 Семья</div><div class="quality-text"><?= $interpretation['family'] ?></div></div>
        <div class="quality-card"><div class="quality-title">🤝 Дружба</div><div class="quality-text"><?= $interpretation['friends'] ?></div></div>
        <div class="quality-card"><div class="quality-title">🏥 Здоровье</div><div class="quality-text"><?= $interpretation['health'] ?></div></div>
        <div class="quality-card"><div class="quality-title">🎨 Творчество</div><div class="quality-text"><?= $interpretation['creativity'] ?></div></div>
        <div class="quality-card"><div class="quality-title">📚 Обучение</div><div class="quality-text"><?= $interpretation['learning'] ?></div></div>
        
        <h2 class="matrix-title"><i class="fas fa-calendar-alt"></i> Помесячный прогноз на <?= $targetYear ?> год</h2>
        <div class="monthly-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 15px; margin-bottom: 40px;">
            <?php
            $monthNames = [1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь'];
            for ($m = 1; $m <= 12; $m++):
                $monthAdvice = isset($interpretation['months'][$m]) ? $interpretation['months'][$m] : 'Рекомендация на этот месяц';
            ?>
            <div class="month-card"><div class="month-name"><?= $monthNames[$m] ?></div><div class="month-advice"><?= nl2br(htmlspecialchars($monthAdvice)) ?></div></div>
            <?php endfor; ?>
        </div>
        
        <h2 class="matrix-title"><i class="fas fa-database"></i> Исходные данные</h2>
        <div style="background: #f9f5f0; border-radius: 20px; padding: 20px; margin-bottom: 40px;">
            <div class="info-row" style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e0d5c8;"><span class="info-label">Дата рождения:</span><span class="info-value"><?= date('d.m.Y', strtotime($birthDate)) ?></span></div>
            <div class="info-row" style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e0d5c8;"><span class="info-label">Год расчёта:</span><span class="info-value"><?= $targetYear ?></span></div>
            <div class="info-row" style="display: flex; justify-content: space-between; padding: 8px 0;"><span class="info-label">Персональный год:</span><span class="info-value"><?= $personalYear ?></span></div>
        </div>
        
        <div class="action-buttons no-print">
            <button onclick="window.print()" class="btn btn-primary" style="background: #9b59b6;"><i class="fas fa-file-pdf"></i> Сохранить в PDF</button>
        </div>
        
        <div class="footer-pif"><p><i class="far fa-clock"></i> Расчёт выполнен: <?= date('d.m.Y H:i:s') ?></p><p>© <?= date('Y') ?> Персональный год | Нумерологический прогноз</p></div>
        
    </div>
</div>
</body>
</html>
    <?php
    $html_content = ob_get_clean();
    file_put_contents($filepath, $html_content);
                //открываем файл с результатом
                header('Location: ' . ABS_PATH . 'supp/pers-year-result.php');
                exit;
                //открываем файл с результатом
            }

}
//на беке
?>
