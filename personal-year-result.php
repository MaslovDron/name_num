<?php
include 'app/include/config.php';
include 'app/include/connect.php';
include 'app/include/functions-front.php';
include 'app/include/year-front.php';

// Проверяем, есть ли результат в сессии
if (!isset($_SESSION['year_result'])) {
    header('Location: ' . ABS_PATH . 'year-form.php');
    exit;
}

$result = $_SESSION['year_result'];
$birthdate = $result['birthdate'];
$currentYear = $result['current_year'];
$personalYear = $result['personal_year'];
$allNumbers = $result['all_numbers'];
$interpretation = $result['interpretation'];

// Получаем данные о калькуляторе из БД (если есть)
$YearCalc = selectOne('calc', ['id' => 17]); // ID для персонального года

// Удаляем результат из сессии после прочтения
unset($_SESSION['year_result']);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ваш персональный год — число <?= $personalYear ?> | Нумерологический прогноз</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/all-style.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/pifagor-style.css">
    <style>
        /* Дополнительные стили для персонального года */
        .hero-block {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 40px;
            padding: 50px 30px;
            margin-bottom: 50px;
            color: white;
            text-align: center;
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
        
        .hero-info {
            background: rgba(255,255,255,0.15);
            border-radius: 30px;
            padding: 20px;
            margin-top: 20px;
            text-align: left;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 15px;
        }
        
        .hero-info-item {
            flex: 1;
            min-width: 150px;
            text-align: center;
        }
        
        .hero-info-label {
            font-size: 12px;
            opacity: 0.8;
            margin-bottom: 5px;
        }
        
        .hero-info-value {
            font-size: 16px;
            font-weight: bold;
        }
        
        .numbers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .number-card-custom {
            background: white;
            border-radius: 30px;
            padding: 25px;
            border: 1px solid #f0e4d6;
            transition: 0.2s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
        }
        
        .number-card-custom:hover {
            transform: translateY(-3px);
            border-color: #b38b5f;
            box-shadow: 0 10px 25px rgba(179, 139, 95, 0.1);
        }
        
        .number-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0e4d6;
        }
        
        .number-icon {
            font-size: 28px;
        }
        
        .number-card-header h3 {
            font-size: 18px;
            color: #3b2b22;
        }
        
        .number-value-large {
            font-size: 48px;
            font-weight: bold;
            color: #b38b5f;
            margin: 10px 0;
            text-align: center;
        }
        
        .number-desc {
            font-size: 13px;
            color: #8b7a6b;
            text-align: center;
            margin-bottom: 15px;
        }
        
        .number-meaning {
            font-size: 14px;
            color: #4a4a4a;
            line-height: 1.5;
            padding-top: 12px;
            border-top: 1px dashed #f0e4d6;
            margin-top: 10px;
        }
        
        .quarter-grid-custom {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 50px;
        }
        
        .quarter-card-custom {
            background: white;
            border-radius: 25px;
            padding: 20px;
            text-align: center;
            border: 1px solid #f0e4d6;
            transition: 0.2s;
        }
        
        .quarter-card-custom:hover {
            border-color: #b38b5f;
            transform: translateY(-3px);
        }
        
        .quarter-card-custom h4 {
            color: #b38b5f;
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
            font-size: 13px;
            color: #4a4a4a;
            line-height: 1.4;
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
            padding: 15px;
            border: 1px solid #f0e4d6;
            transition: 0.2s;
        }
        
        .month-card-custom:hover {
            border-color: #b38b5f;
        }
        
        .month-name {
            font-weight: bold;
            color: #b38b5f;
            margin-bottom: 10px;
            font-size: 16px;
            text-align: center;
        }
        
        .month-forecast {
            font-size: 13px;
            color: #4a4a4a;
            line-height: 1.4;
        }
        
        .info-block-custom {
            background: #f9f5f0;
            border-radius: 25px;
            padding: 25px;
            margin-bottom: 40px;
        }
        
        .info-row-custom {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0d5c8;
        }
        
        .info-row-custom:last-child {
            border-bottom: none;
        }
        
        .info-label-custom {
            color: #8b7a6b;
        }
        
        .info-value-custom {
            font-weight: bold;
            color: #b38b5f;
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
            hero-features {
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
            .quarter-grid-custom {
                grid-template-columns: repeat(2, 1fr);
            }
            .hero-info {
                flex-direction: column;
            }
        }
        
        @media (max-width: 480px) {
            .quarter-grid-custom {
                grid-template-columns: 1fr;
            }
            .monthly-grid-custom {
                grid-template-columns: 1fr;
            }
            .numbers-grid {
                grid-template-columns: 1fr;
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
            <h1><i class="fas fa-calendar-alt"></i> Персональный год</h1>
            <div class="subtitle">Ваш нумерологический прогноз на <?= $currentYear ?> год</div>
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
        </div>
        
        <!-- ГЛАВНЫЙ БЛОК с числом года -->
        <div class="hero-block">
            <div class="hero-number"><?= $personalYear ?></div>
            <div class="hero-title"><?= $interpretation['title'] ?></div>
            <div class="hero-desc"><?= $interpretation['full_desc'] ?></div>
            <div class="hero-features">
    <div class="hero-feature">
        <div class="feature-icon">🎯</div>
        <div class="feature-text">
            <strong>Благоприятные возможности</strong>
            <span><?= $interpretation['opportunities'] ?></span>
        </div>
    </div>
    <div class="hero-feature">
        <div class="feature-icon">⚠️</div>
        <div class="feature-text">
            <strong>На что обратить внимание</strong>
            <span><?= $interpretation['warning'] ?></span>
        </div>
    </div>
    <div class="hero-feature hero-feature-small">
        <div class="feature-icon">💎</div>
        <div class="feature-text">
            <strong>Камень года</strong>
            <span><?= $interpretation['stone'] ?></span>
        </div>
    </div>
    <div class="hero-feature hero-feature-small">
        <div class="feature-icon">🎨</div>
        <div class="feature-text">
            <strong>Цвет года</strong>
            <span><?= $interpretation['color'] ?></span>
        </div>
    </div>
</div>
        </div>
        <!-- призыв к действию -->
                <div class="actions-ps">Полный нумерологический расчет Персонального года вы можете заказать:</div>
                    <?php include 'app/include/socseti.php'; ?>
                    <div class="summa0">
            <div class="summa">Стоимость услуги <?= $YearCalc['price'] ?? '149'; ?> рублей</div>
        </div>
        <!-- призыв к действию -->
        <!-- Основные числа года -->
        <h2 class="matrix-title"><i class="fas fa-magic"></i> Основные числа года</h2>
        <div class="numbers-grid">
            <div class="number-card-custom">
                <div class="number-card-header">
                    <div class="number-icon">🌟</div>
                    <h3>Персональный год</h3>
                </div>
                <div class="number-value-large"><?= $allNumbers['main']['personal_year'] ?></div>
                <div class="number-desc">Главное число года — ваша энергия и задачи</div>
                <div class="number-meaning"><?= getYearFull($allNumbers['main']['personal_year']) ?></div>
            </div>
            
            <div class="number-card-custom">
                <div class="number-card-header">
                    <div class="number-icon">📅</div>
                    <h3>Персональный месяц</h3>
                </div>
                <div class="number-value-large"><?= $allNumbers['main']['personal_month'] ?></div>
                <div class="number-desc">Энергия текущего месяца</div>
                <div class="number-meaning"><?= getMonthlyForecast($personalYear, date('n')) ?></div>
            </div>
            
            <div class="number-card-custom">
                <div class="number-card-header">
                    <div class="number-icon">🌀</div>
                    <h3>Число судьбы</h3>
                </div>
                <div class="number-value-large"><?= $allNumbers['main']['life_path'] ?></div>
                <div class="number-desc">Ваш жизненный путь (по дате рождения)</div>
                <div class="number-meaning"><?= getLifePathDesc($allNumbers['main']['life_path']) ?></div>
            </div>
            
            <div class="number-card-custom">
                <div class="number-card-header">
                    <div class="number-icon">⚡</div>
                    <h3>Кармическое число года</h3>
                </div>
                <div class="number-value-large"><?= $allNumbers['main']['karmic_year'] ?></div>
                <div class="number-desc">Уроки и кармические задачи на этот год</div>
                <div class="number-meaning"><?= getKarmicDesc($allNumbers['main']['karmic_year']) ?></div>
            </div>
        </div>
        
        <!-- Дополнительные контрольные числа -->
        <h2 class="matrix-title"><i class="fas fa-chart-bar"></i> Дополнительные контрольные числа</h2>
        <div class="numbers-grid">
            <div class="number-card-custom">
                <div class="number-card-header">
                    <div class="number-icon">🔄</div>
                    <h3>Цикл года</h3>
                </div>
                <div class="number-value-large"><?= $allNumbers['additional']['year_cycle'] ?></div>
                <div class="number-desc">Ваш личный цикл (совпадает с годом)</div>
                <div class="number-meaning"><?= getYearFull($allNumbers['additional']['year_cycle']) ?></div>
            </div>
            
            <div class="number-card-custom">
                <div class="number-card-header">
                    <div class="number-icon">🚪</div>
                    <h3>Число перехода</h3>
                </div>
                <div class="number-value-large"><?= $allNumbers['additional']['transition'] ?></div>
                <div class="number-desc">Переходная энергия между годами</div>
                <div class="number-meaning"><?= getTransitionDesc($allNumbers['additional']['transition']) ?></div>
            </div>
            
            <div class="number-card-custom">
                <div class="number-card-header">
                    <div class="number-icon">🧘</div>
                    <h3>Духовное число</h3>
                </div>
                <div class="number-value-large"><?= $allNumbers['additional']['spiritual'] ?></div>
                <div class="number-desc">Духовные задачи и рост</div>
                <div class="number-meaning"><?= getSpiritualDesc($allNumbers['additional']['spiritual']) ?></div>
            </div>
            
            <div class="number-card-custom">
                <div class="number-card-header">
                    <div class="number-icon">🏆</div>
                    <h3>Число реализации</h3>
                </div>
                <div class="number-value-large"><?= $allNumbers['additional']['achievement'] ?></div>
                <div class="number-desc">Потенциал достижений в этом году</div>
                <div class="number-meaning"><?= getAchievementDesc($allNumbers['additional']['achievement']) ?></div>
            </div>
            
            <div class="number-card-custom">
                <div class="number-card-header">
                    <div class="number-icon">⚠️</div>
                    <h3>Тест-число (вызовы)</h3>
                </div>
                <div class="number-value-large"><?= $allNumbers['additional']['challenge'] ?></div>
                <div class="number-desc">Внутренние вызовы и уроки года</div>
                <div class="number-meaning"><?= getChallengeDesc($allNumbers['additional']['challenge']) ?></div>
            </div>
            
            <div class="number-card-custom">
                <div class="number-card-header">
                    <div class="number-icon">🌱</div>
                    <h3>Число зрелости</h3>
                </div>
                <div class="number-value-large"><?= $allNumbers['additional']['maturity'] ?></div>
                <div class="number-desc">Судьба + персональный год</div>
                <div class="number-meaning"><?= getMaturityDesc($allNumbers['additional']['maturity']) ?></div>
            </div>
            
            <div class="number-card-custom">
                <div class="number-card-header">
                    <div class="number-icon">🎂</div>
                    <h3>Число дня рождения</h3>
                </div>
                <div class="number-value-large"><?= $allNumbers['additional']['birth_day_number'] ?></div>
                <div class="number-desc">Ваш личный талант и характер</div>
                <div class="number-meaning"><?= getBirthDayDesc($allNumbers['additional']['birth_day_number']) ?></div>
            </div>
            
            <div class="number-card-custom">
                <div class="number-card-header">
                    <div class="number-icon">📆</div>
                    <h3>Число месяца рождения</h3>
                </div>
                <div class="number-value-large"><?= $allNumbers['additional']['birth_month_number'] ?></div>
                <div class="number-desc">Эмоциональный фон и внутренний мир</div>
                <div class="number-meaning"><?= getBirthMonthDesc($allNumbers['additional']['birth_month_number']) ?></div>
            </div>
        </div>
        
        <!-- Энергетические пики по кварталам -->
        <h2 class="matrix-title"><i class="fas fa-chart-line"></i> Энергетические пики по кварталам</h2>
        <div class="quarter-grid-custom">
            <div class="quarter-card-custom">
                <h4>1 квартал</h4>
                <div class="quarter-number"><?= $allNumbers['quarters']['q1'] ?></div>
                <div class="number-desc">Январь — Март</div>
                <div class="quarter-meaning"><?= getQuarterPeakDesc($allNumbers['quarters']['q1']) ?></div>
            </div>
            <div class="quarter-card-custom">
                <h4>2 квартал</h4>
                <div class="quarter-number"><?= $allNumbers['quarters']['q2'] ?></div>
                <div class="number-desc">Апрель — Июнь</div>
                <div class="quarter-meaning"><?= getQuarterPeakDesc($allNumbers['quarters']['q2']) ?></div>
            </div>
            <div class="quarter-card-custom">
                <h4>3 квартал</h4>
                <div class="quarter-number"><?= $allNumbers['quarters']['q3'] ?></div>
                <div class="number-desc">Июль — Сентябрь</div>
                <div class="quarter-meaning"><?= getQuarterPeakDesc($allNumbers['quarters']['q3']) ?></div>
            </div>
            <div class="quarter-card-custom">
                <h4>4 квартал</h4>
                <div class="quarter-number"><?= $allNumbers['quarters']['q4'] ?></div>
                <div class="number-desc">Октябрь — Декабрь</div>
                <div class="quarter-meaning"><?= getQuarterPeakDesc($allNumbers['quarters']['q4']) ?></div>
            </div>
        </div>
        
        <!-- Помесячный прогноз -->
        <h2 class="matrix-title"><i class="fas fa-calendar-week"></i> Помесячный прогноз на <?= $currentYear ?> год</h2>
        <div class="monthly-grid-custom">
            <?php
            $months = [
                1 => 'Январь', 2 => 'Февраль', 3 => 'Март',
                4 => 'Апрель', 5 => 'Май', 6 => 'Июнь',
                7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь',
                10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь'
            ];
            for ($m = 1; $m <= 12; $m++):
            ?>
            <div class="month-card-custom">
                <div class="month-name"><?= $months[$m] ?></div>
                <div class="month-forecast"><?= getMonthlyForecast($personalYear, $m) ?></div>
            </div>
            <?php endfor; ?>
        </div>
        
        <!-- Исходные данные расчёта -->
        <h2 class="matrix-title"><i class="fas fa-database"></i> Исходные данные расчёта</h2>
        <div class="info-block-custom">
            <div class="info-row-custom">
                <span class="info-label-custom">День рождения (цифра):</span>
                <span class="info-value-custom"><?= $allNumbers['basic']['birth_day'] ?> → <?= $allNumbers['basic']['reduced_day'] ?></span>
            </div>
            <div class="info-row-custom">
                <span class="info-label-custom">Месяц рождения (цифра):</span>
                <span class="info-value-custom"><?= $allNumbers['basic']['birth_month'] ?> → <?= $allNumbers['basic']['reduced_month'] ?></span>
            </div>
            <div class="info-row-custom">
                <span class="info-label-custom">Год рождения (редуцированный):</span>
                <span class="info-value-custom"><?= $allNumbers['basic']['reduced_birth_year'] ?></span>
            </div>
            <div class="info-row-custom">
                <span class="info-label-custom">Текущий год (редуцированный):</span>
                <span class="info-value-custom"><?= $allNumbers['basic']['reduced_current_year'] ?></span>
            </div>
        </div>
        
        <!-- призыв к действию -->
        <div class="actions-ps">Полный нумерологический расчет Персонального года вы можете заказать:</div>
        <?php include 'app/include/socseti.php'; ?>
        <div class="summa0">
            <div class="summa">Стоимость услуги <?= $YearCalc['price'] ?? '149'; ?> рублей</div>
        </div>
        <!-- призыв к действию -->
        
        <!-- Кнопки действий -->
        <div class="action-buttons">
            <a href="<?= ABS_PATH ?>#all-calcs" class="btn btn-primary">
                <i class="fas fa-chart-line"></i> Другие расчёты
            </a>
        </div>
        
        <!-- Футер -->
        <div class="footer-pif">
            <p><i class="far fa-clock"></i> Расчет выполнен: <?= date('d.m.Y H:i:s') ?></p>
            <p>© <?= date('Y') ?> Нумерология персонального года | Профессиональный нумерологический анализ</p>
        </div>
    </div>
    
    <!-- Футер сайта -->
    <?php include_once 'app/include/FooterAll.php'; ?>
</body>
</html>
