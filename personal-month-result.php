<?php
include 'app/include/config.php';
include 'app/include/connect.php';
include 'app/include/functions-front.php';

// Проверяем, есть ли результат в сессии
if (!isset($_SESSION['month_result'])) {
    header('Location: ' . ABS_PATH . 'month-form.php');
    exit;
}

$result = $_SESSION['month_result'];
$birthdate = $result['birthdate'];
$currentYear = $result['current_year'];
$currentMonth = $result['current_month'];
$currentMonthName = $result['current_month_name'];
$personalYear = $result['personal_year'];
$personalMonth = $result['personal_month'];
$calculationDetails = $result['calculation_details'];
$data = $result['interpretation'];

// Получаем цену из базы
$monthCalc = selectOne('calc', ['id' => 18]); // ID для персонального месяца

// Удаляем результат из сессии после прочтения
unset($_SESSION['month_result']);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ваш персональный месяц — число <?= $personalMonth ?> | Нумерологический прогноз</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/name-style.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/all-style.css">
    <style>
        /* Дополнительные стили для персонального месяца */
        .hero-block {
            background: linear-gradient(135deg, #5b4b8a 0%, #8b5f9e 100%);
            border-radius: 40px;
            padding: 50px 30px;
            margin-bottom: 50px;
            color: white;
            text-align: center;
            box-shadow: 0 15px 30px rgba(91, 75, 138, 0.25);
        }
        
        .hero-number {
            font-size: 100px;
            font-weight: bold;
            line-height: 1;
            text-shadow: 3px 3px 10px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        
        .hero-title {
            font-size: 32px;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }
        
        .hero-desc {
            font-size: 18px;
            max-width: 700px;
            margin: 0 auto 25px;
            opacity: 0.95;
        }
        
        .hero-features {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 30px;
            justify-content: center;
        }
        
        .hero-feature {
            background: rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 15px 20px;
            flex: 2;
            min-width: 220px;
            display: flex;
            align-items: center;
            gap: 15px;
            backdrop-filter: blur(4px);
            transition: 0.2s;
        }
        
        .hero-feature-small {
            flex: 1;
            min-width: 160px;
        }
        
        .hero-feature:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }
        
        .feature-icon {
            font-size: 32px;
        }
        
        .feature-text {
            flex: 1;
        }
        
        .feature-text strong {
            display: block;
            font-size: 13px;
            opacity: 0.85;
            margin-bottom: 4px;
        }
        
        .feature-text span {
            font-size: 15px;
            font-weight: 500;
        }
        
        .details-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 50px;
        }
        
        .action-card {
            background: linear-gradient(145deg, #f5effa, #e8d9f0);
            border-radius: 40px;
            padding: 30px;
            margin: 40px 0;
            text-align: center;
            border: 2px solid #8b5f9e;
            box-shadow: 0 10px 25px rgba(139, 95, 158, 0.1);
        }
        
        .action-card .action-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        
        .action-card .action-text {
            font-size: 20px;
            color: #3b2b22;
            font-weight: 500;
            line-height: 1.6;
        }
        
        .quarter-grid-custom {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 50px;
        }
        
        .quarter-card-custom {
            background: white;
            border-radius: 30px;
            padding: 25px 20px;
            text-align: center;
            border: 1px solid #f0e4d6;
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
            transition: 0.2s;
        }
        
        .quarter-card-custom:hover {
            border-color: #b38b5f;
            transform: translateY(-3px);
        }
        
        .quarter-card-custom h4 {
            color: #8b5f9e;
            margin-bottom: 10px;
            font-size: 16px;
        }
        
        .quarter-number {
            font-size: 42px;
            font-weight: bold;
            color: #3b2b22;
            margin-bottom: 5px;
        }
        
        .quarter-meaning {
            font-size: 14px;
            color: #4a4a4a;
            line-height: 1.5;
            margin-top: 12px;
            padding-top: 10px;
            border-top: 1px dashed #f0e4d6;
        }
        
        .monthly-grid-custom {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 15px;
            margin-bottom: 40px;
        }
        
        .month-card-custom {
            background: white;
            border-radius: 20px;
            padding: 18px 15px;
            border: 1px solid #f0e4d6;
            transition: 0.2s;
            box-shadow: 0 3px 10px rgba(0,0,0,0.02);
        }
        
        .month-card-custom:hover {
            border-color: #b38b5f;
            transform: translateY(-2px);
        }
        
        .month-name {
            font-weight: bold;
            color: #8b5f9e;
            margin-bottom: 10px;
            font-size: 16px;
            text-align: center;
        }
        
        .month-forecast {
            font-size: 14px;
            color: #4a4a4a;
            line-height: 1.5;
        }
        
        .calculation-block {
            background: #f9f5f0;
            border-radius: 30px;
            padding: 25px 30px;
            margin-bottom: 40px;
            border: 1px solid #f0e4d6;
        }
        
        .calc-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e0d5c8;
        }
        
        .calc-row:last-child {
            border-bottom: none;
        }
        
        .calc-row.highlight {
            background: #e8d9f0;
            margin: 10px -15px;
            padding: 12px 15px;
            border-radius: 15px;
        }
        
        .calc-label {
            color: #8b7a6b;
        }
        
        .calc-value {
            font-weight: bold;
            color: #8b5f9e;
        }
        
        @media (max-width: 900px) {
            .details-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .quarter-grid-custom {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .hero-number {
                font-size: 70px;
            }
            .hero-title {
                font-size: 24px;
            }
            .hero-desc {
                font-size: 16px;
            }
            .hero-feature {
                flex-direction: column;
                text-align: center;
            }
        }
        
        @media (max-width: 480px) {
            .details-grid {
                grid-template-columns: 1fr;
            }
            .quarter-grid-custom {
                grid-template-columns: 1fr;
            }
            .monthly-grid-custom {
                grid-template-columns: 1fr;
            }
            .calc-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <!-- шапка -->
    <?php include_once 'app/include/header-front.php'; ?>
    
    <div class="container">
        <!-- Заголовок -->
        <div class="header-pif">
            <h1><i class="fas fa-moon"></i> Персональный месяц</h1>
            <div class="subtitle">Ваш нумерологический прогноз на <?= $currentMonthName ?> <?= $currentYear ?> года</div>
        </div>
        
        <!-- Информация о дате рождения -->
        <div class="date-info">
            <div class="date-item">
                <div class="date-value"><?= date('d', strtotime($birthdate)) ?></div>
                <div class="date-label">День рождения</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= date('m', strtotime($birthdate)) ?></div>
                <div class="date-label">Месяц рождения</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= date('Y', strtotime($birthdate)) ?></div>
                <div class="date-label">Год рождения</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= $currentYear ?></div>
                <div class="date-label">Год расчёта</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= $currentMonthName ?></div>
                <div class="date-label">Месяц расчёта</div>
            </div>
        </div>
         <!-- ==================== ПРИЗЫВ ==================== -->
        <div class="actions-ps">Полный нумерологический расчёт Персонального месяца вы можете заказать:</div>
        <?php include 'app/include/socseti.php'; ?>
        <div class="summa0">
            <div class="summa">Стоимость услуги <?= $monthCalc['price'] ?? '99'; ?> рублей</div>
        </div>
        
        <!-- ==================== КНОПКИ ДЕЙСТВИЙ ==================== -->
        <div class="action-buttons">
          
            <a href="<?= ABS_PATH ?>#all-calcs" class="btn btn-primary">
                <i class="fas fa-chart-line"></i> Другие расчёты
            </a>
        </div>
        <!-- ГЛАВНЫЙ БЛОК с числом месяца -->
        <div class="hero-block">
            <div class="hero-number"><?= $personalMonth ?></div>
            <div class="hero-title"><?= $data['title'] ?></div>
            <div class="hero-desc"><?= $data['full_desc'] ?></div>
            
            <div class="hero-features">
                <div class="hero-feature">
                    <div class="feature-icon">🎯</div>
                    <div class="feature-text">
                        <strong>Возможности</strong>
                        <span><?= $data['opportunities'] ?></span>
                    </div>
                </div>
                <div class="hero-feature">
                    <div class="feature-icon">⚠️</div>
                    <div class="feature-text">
                        <strong>Предостережения</strong>
                        <span><?= $data['warning'] ?></span>
                    </div>
                </div>
                <div class="hero-feature hero-feature-small">
                    <div class="feature-icon">💎</div>
                    <div class="feature-text">
                        <strong>Камень месяца</strong>
                        <span><?= $data['stone'] ?></span>
                    </div>
                </div>
                <div class="hero-feature hero-feature-small">
                    <div class="feature-icon">🎨</div>
                    <div class="feature-text">
                        <strong>Цвет месяца</strong>
                        <span><?= $data['color'] ?></span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ==================== ПРОГНОЗ ПО СФЕРАМ ==================== -->
        <h2 class="matrix-title"><i class="fas fa-heart"></i> Прогноз по сферам жизни</h2>
        <div class="details-grid">
            <div class="number-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="number-value" style="font-size: 36px;">❤️</div>
                <div class="number-name">Любовь и отношения</div>
                <div class="number-desc" style="font-size: 14px; opacity: 0.9; margin-top: 10px;"><?= $data['love'] ?></div>
            </div>
            <div class="number-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="number-value" style="font-size: 36px;">💰</div>
                <div class="number-name">Финансы и карьера</div>
                <div class="number-desc" style="font-size: 14px; opacity: 0.9; margin-top: 10px;"><?= $data['finance'] ?></div>
            </div>
            <div class="number-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <div class="number-value" style="font-size: 36px;">🧘</div>
                <div class="number-name">Главный совет</div>
                <div class="number-desc" style="font-size: 14px; opacity: 0.9; margin-top: 10px;"><?= $data['advice'] ?></div>
            </div>
        </div>
        
        <!-- ==================== ACTION (ДЕЙСТВИЕ) ==================== -->
        <div class="action-card">
            <div class="action-icon">⚡</div>
            <h3 style="color: #5b4b8a; margin-bottom: 10px; font-size: 24px;">Ваше действие на этот месяц</h3>
            <div class="action-text"><?= $data['action'] ?></div>
        </div>
        
        <!-- ==================== РАСШИФРОВКА ПО НЕДЕЛЯМ ==================== -->
        <h2 class="matrix-title"><i class="fas fa-calendar-week"></i> Прогноз по неделям</h2>
        <div class="quarter-grid-custom">
            <?php 
            $weeksCount = ceil(date('t', strtotime($currentYear . '-' . $currentMonth . '-01')) / 7);
            for ($week = 1; $week <= $weeksCount; $week++): 
                $weekText = $data['weeks'][$week] ?? 'Неделя ' . $week . ' — время для внутренней работы.';
            ?>
            <div class="quarter-card-custom">
                <h4>Неделя <?= $week ?></h4>
                <div class="quarter-number"><?= $week ?></div>
                <div class="quarter-meaning"><?= $weekText ?></div>
            </div>
            <?php endfor; ?>
        </div>
        
        <!-- ==================== РАСШИФРОВКА ПО ДНЯМ ==================== -->
        <h2 class="matrix-title"><i class="fas fa-calendar-day"></i> Прогноз по дням месяца</h2>
        <div class="monthly-grid-custom">
            <?php 
            $daysInMonth = date('t', strtotime($currentYear . '-' . $currentMonth . '-01'));
            for ($day = 1; $day <= $daysInMonth; $day++): 
                $dayText = $data['days'][$day] ?? 'День ' . $day . ' — прислушайтесь к себе.';
            ?>
            <div class="month-card-custom">
                <div class="month-name">📅 <?= $day ?> <?= $currentMonthName ?></div>
                <div class="month-forecast">
                    <span style="color: #8b5f9e;">🔹 <?= $dayText ?></span>
                </div>
            </div>
            <?php endfor; ?>
        </div>
        
        <!-- ==================== РАСЧЁТНЫЕ ДАННЫЕ ==================== -->
        <h2 class="matrix-title"><i class="fas fa-calculator"></i> Как мы рассчитали</h2>
        <div class="calculation-block">
            <div class="calc-row">
                <span class="calc-label">День рождения:</span>
                <span class="calc-value"><?= $calculationDetails['day_raw'] ?> → <?= $calculationDetails['day_reduced'] ?></span>
            </div>
            <div class="calc-row">
                <span class="calc-label">Месяц рождения:</span>
                <span class="calc-value"><?= $calculationDetails['month_raw'] ?> → <?= $calculationDetails['month_reduced'] ?></span>
            </div>
            <div class="calc-row">
                <span class="calc-label">Текущий год (редуцированный):</span>
                <span class="calc-value"><?= $currentYear ?> → <?= $calculationDetails['year_reduced'] ?></span>
            </div>
            <div class="calc-row">
                <span class="calc-label">Персональный год:</span>
                <span class="calc-value"><?= $calculationDetails['day_reduced'] ?> + <?= $calculationDetails['month_reduced'] ?> + <?= $calculationDetails['year_reduced'] ?> = <?= $calculationDetails['personal_year_raw'] ?> → <?= $personalYear ?></span>
            </div>
            <div class="calc-row highlight">
                <span class="calc-label">Персональный месяц:</span>
                <span class="calc-value"><?= $personalYear ?> + <?= $currentMonth ?> = <?= $calculationDetails['personal_month_raw'] ?> → <strong><?= $personalMonth ?></strong></span>
            </div>
        </div>
        
        <!-- ==================== ПРИЗЫВ ==================== -->
        <div class="actions-ps">Полный нумерологический расчёт Персонального месяца вы можете заказать:</div>
        <?php include 'app/include/socseti.php'; ?>
        <div class="summa0">
            <div class="summa">Стоимость услуги <?= $monthCalc['price'] ?? '99'; ?> рублей</div>
        </div>
        
        <!-- ==================== КНОПКИ ДЕЙСТВИЙ ==================== -->
        <div class="action-buttons">
          
            <a href="<?= ABS_PATH ?>#all-calcs" class="btn btn-primary">
                <i class="fas fa-chart-line"></i> Другие расчёты
            </a>
        </div>
        
        <!-- ==================== ФУТЕР ==================== -->
        <div class="footer-pif">
            <p><i class="far fa-clock"></i> Расчёт выполнен: <?= date('d.m.Y H:i:s') ?></p>
            <p>© <?= date('Y') ?> Нумерология персонального месяца | Профессиональный нумерологический анализ</p>
        </div>
    </div>
    
    <?php include_once 'app/include/FooterAll.php'; ?>
</body>
</html>
