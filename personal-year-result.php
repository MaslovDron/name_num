<?php
include 'app/include/config.php';
include 'app/include/connect.php';
include 'app/include/functions-front.php';

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

// Удаляем результат из сессии после прочтения
unset($_SESSION['year_result']);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ваш персональный год — число <?= $personalYear ?> | Полная нумерологическая матрица</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/all-style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(145deg, #fefaf4 0%, #f9f2ea 100%);
            font-family: 'Georgia', 'Times New Roman', serif;
            color: #2c2c2c;
            padding: 40px 20px;
        }
        
        .result-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 60px;
            padding: 50px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.05);
            border: 1px solid #f0e4d6;
        }
        
        .result-header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid #f0e4d6;
        }
        
        .result-header h1 {
            font-size: 42px;
            color: #3b2b22;
            margin-bottom: 15px;
        }
        
        .result-date {
            color: #8b7a6b;
            font-size: 16px;
        }
        
        .main-number-card {
            text-align: center;
            background: linear-gradient(135deg, #b5654b 0%, #9a4c3a 100%);
            border-radius: 40px;
            padding: 40px;
            margin-bottom: 40px;
            color: white;
        }
        
        .main-number {
            font-size: 120px;
            font-weight: bold;
            line-height: 1;
            text-shadow: 5px 5px 15px rgba(0,0,0,0.2);
        }
        
        .main-title {
            font-size: 28px;
            margin-top: 15px;
            letter-spacing: 2px;
        }
        
        .section-title {
            font-size: 28px;
            color: #3b2b22;
            margin: 40px 0 25px 0;
            padding-left: 15px;
            border-left: 4px solid #b5654b;
        }
        
        .numbers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .number-card {
            background: #f9f5f0;
            border-radius: 30px;
            padding: 25px;
            border: 1px solid #f0e4d6;
            transition: 0.2s;
        }
        
        .number-card:hover {
            transform: translateY(-3px);
            border-color: #b38b5f;
            box-shadow: 0 10px 25px rgba(179, 139, 95, 0.1);
        }
        
        .number-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }
        
        .number-icon {
            font-size: 32px;
        }
        
        .number-card-header h3 {
            font-size: 20px;
            color: #3b2b22;
        }
        
        .number-value {
            font-size: 56px;
            font-weight: bold;
            color: #b5654b;
            margin: 15px 0;
            text-align: center;
        }
        
        .number-value.small {
            font-size: 42px;
        }
        
        .number-desc {
            font-size: 14px;
            color: #6a5a4c;
            line-height: 1.5;
            text-align: center;
        }
        
        .quarter-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 40px;
        }
        
        .quarter-card {
            background: #f9f5f0;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
        }
        
        .quarter-card h4 {
            color: #b5654b;
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .quarter-number {
            font-size: 48px;
            font-weight: bold;
            color: #3b2b22;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0e4d6;
        }
        
        .info-label {
            color: #8b7a6b;
        }
        
        .info-value {
            font-weight: bold;
            color: #b5654b;
            font-size: 20px;
        }
        
        .footer-pif {
            text-align: center;
            margin-top: 50px;
            padding-top: 30px;
            border-top: 1px solid #f0e4d6;
            color: #8b7a6b;
        }
        
        @media (max-width: 768px) {
            .result-container {
                padding: 25px;
            }
            .main-number {
                font-size: 80px;
            }
            .quarter-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .numbers-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 480px) {
            .quarter-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<div class="result-container">
    
    <!-- Шапка -->
    <div class="result-header">
        <h1>🔮 Ваша нумерологическая матрица</h1>
        <div class="result-date">
            <i class="fas fa-calendar-alt"></i> Дата рождения: <?= date('d.m.Y', strtotime($birthdate)) ?> | 
            Расчёт для <?= $currentYear ?> года
        </div>
    </div>
    
    <!-- Главное число -->
    <!-- <div class="main-number-card">
        <div class="main-number"><?= $personalYear ?></div>
        <div class="main-title">Ваш персональный год</div>
    </div> -->
    
    <!-- Основные числа -->
    <h2 class="section-title">📊 Основные числа года</h2>
    <div class="numbers-grid">
        <div class="number-card">
            <div class="number-card-header">
                <div class="number-icon">🌟</div>
                <h3>Персональный год</h3>
            </div>
            <div class="number-value"><?= $allNumbers['main']['personal_year'] ?></div>
            <div class="number-desc">Главное число года — ваша энергия и задачи</div>
        </div>
        
        <div class="number-card">
            <div class="number-card-header">
                <div class="number-icon">📅</div>
                <h3>Персональный месяц</h3>
            </div>
            <div class="number-value"><?= $allNumbers['main']['personal_month'] ?></div>
            <div class="number-desc">Энергия текущего месяца</div>
        </div>
        
        <div class="number-card">
            <div class="number-card-header">
                <div class="number-icon">🌀</div>
                <h3>Число судьбы</h3>
            </div>
            <div class="number-value"><?= $allNumbers['main']['life_path'] ?></div>
            <div class="number-desc">Ваш жизненный путь (по дате рождения)</div>
        </div>
        
        <div class="number-card">
            <div class="number-card-header">
                <div class="number-icon">⚡</div>
                <h3>Кармическое число года</h3>
            </div>
            <div class="number-value"><?= $allNumbers['main']['karmic_year'] ?></div>
            <div class="number-desc">Уроки и кармические задачи на этот год</div>
        </div>
    </div>
    
    <!-- Дополнительные числа -->
    <h2 class="section-title">🔢 Дополнительные контрольные числа</h2>
    <div class="numbers-grid">
        <div class="number-card">
            <div class="number-card-header">
                <div class="number-icon">🔄</div>
                <h3>Цикл года</h3>
            </div>
            <div class="number-value small"><?= $allNumbers['additional']['year_cycle'] ?></div>
            <div class="number-desc">Ваш личный цикл (совпадает с годом)</div>
        </div>
        
        <div class="number-card">
            <div class="number-card-header">
                <div class="number-icon">🚪</div>
                <h3>Число перехода</h3>
            </div>
            <div class="number-value small"><?= $allNumbers['additional']['transition'] ?></div>
            <div class="number-desc">Переходная энергия между годами</div>
        </div>
        
        <div class="number-card">
            <div class="number-card-header">
                <div class="number-icon">🧘</div>
                <h3>Духовное число</h3>
            </div>
            <div class="number-value small"><?= $allNumbers['additional']['spiritual'] ?></div>
            <div class="number-desc">Духовные задачи и рост</div>
        </div>
        
        <div class="number-card">
            <div class="number-card-header">
                <div class="number-icon">🏆</div>
                <h3>Число реализации</h3>
            </div>
            <div class="number-value small"><?= $allNumbers['additional']['achievement'] ?></div>
            <div class="number-desc">Потенциал достижений в этом году</div>
        </div>
        
        <div class="number-card">
            <div class="number-card-header">
                <div class="number-icon">⚠️</div>
                <h3>Тест-число (вызовы)</h3>
            </div>
            <div class="number-value small"><?= $allNumbers['additional']['challenge'] ?></div>
            <div class="number-desc">Внутренние вызовы и уроки года</div>
        </div>
        
        <div class="number-card">
            <div class="number-card-header">
                <div class="number-icon">🌱</div>
                <h3>Число зрелости</h3>
            </div>
            <div class="number-value small"><?= $allNumbers['additional']['maturity'] ?></div>
            <div class="number-desc">Судьба + персональный год</div>
        </div>
        
        <div class="number-card">
            <div class="number-card-header">
                <div class="number-icon">🎂</div>
                <h3>Число дня рождения</h3>
            </div>
            <div class="number-value small"><?= $allNumbers['additional']['birth_day_number'] ?></div>
            <div class="number-desc">Ваш личный талант и характер</div>
        </div>
        
        <div class="number-card">
            <div class="number-card-header">
                <div class="number-icon">📆</div>
                <h3>Число месяца рождения</h3>
            </div>
            <div class="number-value small"><?= $allNumbers['additional']['birth_month_number'] ?></div>
            <div class="number-desc">Эмоциональный фон и внутренний мир</div>
        </div>
    </div>
    
    <!-- Энергетические пики по кварталам -->
    <h2 class="section-title">📅 Энергетические пики по кварталам</h2>
    <div class="quarter-grid">
        <div class="quarter-card">
            <h4>1 квартал</h4>
            <div class="quarter-number"><?= $allNumbers['quarters']['q1'] ?></div>
            <div class="number-desc">Январь — Март</div>
        </div>
        <div class="quarter-card">
            <h4>2 квартал</h4>
            <div class="quarter-number"><?= $allNumbers['quarters']['q2'] ?></div>
            <div class="number-desc">Апрель — Июнь</div>
        </div>
        <div class="quarter-card">
            <h4>3 квартал</h4>
            <div class="quarter-number"><?= $allNumbers['quarters']['q3'] ?></div>
            <div class="number-desc">Июль — Сентябрь</div>
        </div>
        <div class="quarter-card">
            <h4>4 квартал</h4>
            <div class="quarter-number"><?= $allNumbers['quarters']['q4'] ?></div>
            <div class="number-desc">Октябрь — Декабрь</div>
        </div>
    </div>
    
    <!-- Исходные данные -->
    <h2 class="section-title">📌 Исходные данные</h2>
    <div style="background: #f9f5f0; border-radius: 20px; padding: 20px;">
        <div class="info-row">
            <span class="info-label">День рождения (цифра):</span>
            <span class="info-value"><?= $allNumbers['basic']['birth_day'] ?> → <?= $allNumbers['basic']['reduced_day'] ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Месяц рождения (цифра):</span>
            <span class="info-value"><?= $allNumbers['basic']['birth_month'] ?> → <?= $allNumbers['basic']['reduced_month'] ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Год рождения (редуцированный):</span>
            <span class="info-value"><?= $allNumbers['basic']['reduced_birth_year'] ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Текущий год (редуцированный):</span>
            <span class="info-value"><?= $allNumbers['basic']['reduced_current_year'] ?></span>
        </div>
    </div>
    
    <!-- Тизер полного отчёта -->
    <div style="margin-top: 40px; padding: 30px; background: linear-gradient(135deg, #fff8f0, #fff); border-radius: 30px; border: 2px dashed #b38b5f; text-align: center;">
        <h3 style="color: #b5654b; margin-bottom: 15px;">🔒 Хотите узнать значение каждого числа?</h3>
        <p style="margin-bottom: 20px;">В полной версии вы получите расшифровку всех 14 чисел + помесячный прогноз + персональный талисман</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <a href="#" style="background: linear-gradient(135deg, #b5654b, #9a4c3a); color: white; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: bold;">🌟 Получить полный отчёт за 149 ₽</a>
            <a href="#" style="background: #f0e4d6; color: #b5654b; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: bold;">📲 Написать в Telegram</a>
        </div>
        <p class="number-desc" style="margin-top: 15px;">* Отправьте сообщение с числом <?= $personalYear ?> — я пришлю бесплатную расшифровку</p>
    </div>
    
    <!-- Футер -->
    <div class="footer-pif">
        <p><i class="far fa-clock"></i> Расчёт выполнен: <?= date('d.m.Y H:i:s') ?></p>
        <p>© <?= date('Y') ?> Нумерология персонального года</p>
    </div>
</div>
</body>
</html>
