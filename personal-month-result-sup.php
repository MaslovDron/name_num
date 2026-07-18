<?php
// supp/life-chart-result-sup.php

include '../app/include/config.php';
include '../app/include/connect.php';
include '../app/include/functions-adm.php';

// Проверка авторизации
if (empty($_SESSION['id_num'])) {
    header('Location: ' . ABS_PATH . 'supp/index.php');
    exit;
}

// Проверяем, есть ли результат в сессии
if (!isset($_SESSION['life_chart_result_sup'])) {
    header('Location: ' . ABS_PATH . 'supp/life-chart-form-supp.php');
    exit;
}

$data = $_SESSION['life_chart_result_sup'];
$birthdate = $data['birthdate'];
$formattedDate = $data['formatted_date'];
$baseNumber = $data['base_number'];
$digitsDisplay = $data['digits_display'];
$years = $data['years'];
$values = $data['values'];
$periods = $data['periods'];
$stats = $data['stats'];
$step = $data['step'];
$calculationDetails = $data['calculation_details'];

// Удаляем результат из сессии после прочтения
unset($_SESSION['life_chart_result_sup']);

// Функция склонения года
function getAgeWord($age) {
    $lastDigit = $age % 10;
    $lastTwoDigits = $age % 100;
    if ($lastTwoDigits >= 11 && $lastTwoDigits <= 14) {
        return 'лет';
    }
    if ($lastDigit == 1) {
        return 'год';
    } elseif ($lastDigit >= 2 && $lastDigit <= 4) {
        return 'года';
    } else {
        return 'лет';
    }
}

// Подключаем расширенную расшифровку
include '../app/include/life-interpretation-ultimate.php';
$periodsUltimate = [];
foreach ($values as $value) {
    $periodsUltimate[] = getUltimateInterpretation($value);
}
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
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .date-badge {
            background: #f0e6d2;
            padding: 5px 15px;
            border-radius: 30px;
            font-size: 14px;
            margin-top: 8px;
            display: inline-block;
            color: #5a3a2a;
        }
        
        .number-large {
            font-size: 80px;
            font-weight: bold;
            color: #b38b5f;
            line-height: 1;
        }
        
        .periods-grid-result {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .period-card-result {
            background: #f9f5f0;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            border: 1px solid #f0e4d6;
            transition: 0.2s;
        }
        
        .period-card-result:hover {
            transform: translateY(-3px);
            border-color: #b38b5f;
        }
        
        .period-card-result.peak {
            border-color: #2ecc71;
            background: #f0fff4;
        }
        
        .period-card-result.low {
            border-color: #e74c3c;
            background: #fff5f5;
        }
        
        .period-card-result .period-age {
            font-size: 22px;
            font-weight: bold;
            color: #3b2b22;
        }
        
        .period-card-result .period-value {
            font-size: 42px;
            font-weight: bold;
            color: #b38b5f;
            margin: 5px 0;
        }
        
        .period-card-result .period-status {
            font-size: 18px;
            color: #6a5a4c;
            margin-top: 5px;
        }
        
        .period-card-result .period-desc {
            font-size: 15px;
            color: #8b7a6b;
            margin-top: 8px;
        }
        
        .stats-grid-result {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin: 30px 0 40px;
        }
        
        .stat-card-result {
            background: #f9f5f0;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            border: 1px solid #f0e4d6;
            transition: 0.2s;
        }
        
        .stat-card-result:hover {
            transform: translateY(-3px);
            border-color: #b38b5f;
        }
        
        .stat-card-result .stat-value {
            font-size: 38px;
            font-weight: bold;
            color: #b38b5f;
        }
        
        .stat-card-result .stat-label {
            font-size: 16px;
            color: #6a5a4c;
            margin-top: 5px;
        }
        
        .stat-card-result.peak .stat-value { color: #2ecc71; }
        .stat-card-result.low .stat-value { color: #e74c3c; }
        
        .details-grid-result {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 30px 0 40px;
        }
        
        .detail-card-result {
            background: #f9f5f0;
            border-radius: 20px;
            padding: 20px;
            border: 1px solid #f0e4d6;
            transition: 0.2s;
        }
        
        .detail-card-result:hover {
            border-color: #b38b5f;
            transform: translateY(-3px);
        }
        
        .detail-card-result .detail-title {
            font-size: 20px;
            font-weight: bold;
            color: #b38b5f;
            margin-bottom: 10px;
            border-bottom: 2px solid #f0e4d6;
            padding-bottom: 8px;
        }
        
        .detail-card-result .detail-item {
            font-size: 15px;
            color: #4a3f38;
            padding: 5px 0;
            line-height: 1.5;
        }
        
        .detail-card-result .detail-item strong {
            color: #8a6e4b;
        }
        
        .detail-card-result .detail-emoji {
            font-size: 24px;
            margin-right: 8px;
        }
        
        .detail-card-result .detail-full {
            font-size: 15px;
            color: #4a3f38;
            padding: 8px 0;
            line-height: 1.6;
            border-top: 1px solid #f0e4d6;
            margin-top: 8px;
        }
        
        .info-block-custom {
            background: #f9f5f0;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 40px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e0d5c8;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .info-label {
            color: #8b7a6b;
        }
        
        .info-value {
            font-weight: bold;
            color: #3b2b22;
        }
        
        .chart-section {
            background: white;
            border-radius: 30px;
            padding: 30px;
            border: 1px solid #f0e4d6;
            margin-bottom: 40px;
        }
        
        .chart-section h2 {
            text-align: center;
            font-size: 24px;
            color: #3b2b22;
            margin-bottom: 20px;
            font-weight: 400;
        }
        
        .chart-wrapper {
            height: 380px;
        }
        
        .chart-legend {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin-top: 15px;
            font-size: 14px;
            color: #6a5a4c;
        }
        
        .legend-item {
            font-weight: 600;
        }
        
        /* Стили для расширенной расшифровки */
        .ultimate-details {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
            margin: 10px 0;
        }
        .ultimate-item {
            background: #f5efe8;
            border-radius: 12px;
            padding: 10px 12px;
            font-size: 14px;
            line-height: 1.4;
            border-left: 3px solid #b38b5f;
        }
        .ultimate-item strong {
            color: #8a6e4b;
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }
        .ultimate-item .value {
            color: #3b2b22;
        }
        .archetype-box {
            background: #f5efe8;
            border-radius: 16px;
            padding: 15px 20px;
            margin: 10px 0;
            border-left: 4px solid #b38b5f;
        }
        .archetype-box .label {
            font-size: 12px;
            text-transform: uppercase;
            color: #8b7a6b;
            letter-spacing: 1px;
        }
        .archetype-box .text {
            font-size: 18px;
            color: #3b2b22;
            font-weight: 500;
        }
        .forecast-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin: 10px 0;
        }
        .forecast-item {
            background: #f5efe8;
            border-radius: 12px;
            padding: 10px 12px;
            font-size: 14px;
            border-left: 3px solid #b38b5f;
        }
        .forecast-item strong {
            color: #8a6e4b;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .forecast-item .value {
            color: #3b2b22;
            display: block;
            margin-top: 2px;
        }
        
        @media (max-width: 1024px) {
            .details-grid-result {
                grid-template-columns: 1fr;
            }
            .ultimate-details {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .stats-grid-result {
                grid-template-columns: repeat(2, 1fr);
            }
            .periods-grid-result {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
            .number-large {
                font-size: 56px;
            }
            .chart-wrapper {
                height: 280px;
            }
            .ultimate-details {
                grid-template-columns: 1fr;
            }
            .forecast-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 480px) {
            .stats-grid-result {
                grid-template-columns: 1fr;
            }
            .periods-grid-result {
                grid-template-columns: repeat(2, 1fr);
            }
            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
            .chart-legend {
                flex-wrap: wrap;
                gap: 10px;
            }
            .details-grid-result {
                grid-template-columns: 1fr;
            }
        }
        
        @media print {
            @page { margin: 0.5cm; size: A4; }
            @top-center, @bottom-center { content: ""; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>
<a href="<?php echo $_SESSION['file_url'];?>"><?php echo $_SESSION['file_url'];?></a> 
<div class="landing">
    <div class="container">
        
        <!-- ==================== ЗАГОЛОВОК ==================== -->
        <div class="header-pif">
            <h1><i class="fas fa-chart-line"></i> Карта Жизни</h1>
            <div class="subtitle">Полный нумерологический разбор по дате рождения</div>
        </div>
        
        <!-- ==================== ИНФОРМАЦИЯ О ДАТЕ ==================== -->
        <div class="date-info" style="display: flex; justify-content: center; align-items: center; gap: 30px; flex-wrap: wrap;">
            <div class="date-item">
                <div class="date-value"><?= $calculationDetails['day'] ?></div>
                <div class="date-label">День рождения</div>
                <div class="date-badge"><i class="fas fa-calendar-alt"></i> <?= $calculationDetails['month'] ?> месяц</div>
            </div>
            <div style="font-size: 48px; font-weight: bold; color: #b38b5f;">→</div>
            <div class="date-item">
                <div class="date-value"><?= $formattedDate ?></div>
                <div class="date-label">Дата рождения</div>
                <div class="date-badge"><i class="fas fa-chart-line"></i> шаг <?= $step ?> года</div>
            </div>
        </div>
        
        <!-- ==================== ГЛАВНЫЙ БЛОК ==================== -->
        <div class="compatibility-score" style="margin-bottom: 40px;">
            <div class="score-circle" style="background: linear-gradient(135deg, #b38b5f, #8a6e4b);">
                <div class="score-value"><?= $stats['max'] ?></div>
                <div class="score-label">максимум<br>энергии</div>
            </div>
            <div style="margin-top: 20px;">
                <span class="level-badge" style="background: #f0e6d2; color: #5a3a2a;">
                    <i class="fas fa-code"></i> <?= $digitsDisplay ?>
                </span>
            </div>
            <div class="month-title" style="margin-top: 15px;">Базовое число: <?= number_format($baseNumber) ?></div>
            <div class="month-short-desc" style="margin-top: 15px;">
                Всего периодов: <strong><?= count($years) ?></strong> (шаг <?= $step ?> года, до <?= max($years) ?> лет)
            </div>
        </div>
        
        <!-- ==================== ГРАФИК ==================== -->
        <div class="chart-section">
            <h2><i class="fas fa-chart-line" style="color: #b38b5f;"></i> График жизненной энергии</h2>
            <div class="chart-wrapper">
                <canvas id="lifeChartSup"></canvas>
            </div>
            <div class="chart-legend">
                <span class="legend-item" style="color: #2ecc71;">●</span> Пик энергии (7-9)
                <span class="legend-item" style="color: #3498db;">●</span> Стабильность (4-6)
                <span class="legend-item" style="color: #e74c3c;">●</span> Спад энергии (1-3)
            </div>
        </div>
        
        <!-- ==================== КЛЮЧЕВЫЕ ВЫВОДЫ ==================== -->
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
        
        <!-- ==================== СТАТИСТИКА ==================== -->
        <!-- <h2 class="matrix-title"><i class="fas fa-chart-bar"></i> Статистика энергии</h2>
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
        </div>-->
        <!-- ////////////////////////////////////////////////// -->
        <h2 class="matrix-title"><i class="fas fa-chart-bar"></i> Статистика энергии!!</h2>
        <div class="stats-grid-result">
    <div class="stat-card-result peak">
        <div class="stat-value"><?= $stats['max'] ?></div>
        <div class="stat-label">📈 Максимальная энергия</div>
    </div>
    <div class="stat-card-result low">
        <div class="stat-value"><?= $stats['min'] ?></div>
        <div class="stat-label">📉 Минимальная энергия</div>
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
<!-- ////////////////////////////////////////////////// -->
        <!-- ==================== ВСЕ ПЕРИОДЫ ==================== -->
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
        
        <!-- ==================== ДЕТАЛЬНЫЙ РАЗБОР ПО СФЕРАМ ==================== -->
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
                
                <!-- Полное описание -->
                <div class="detail-full"><?= $period['full'] ?></div>
                
                <!-- Советы по сферам -->
                <div class="detail-item"><strong>💡 Совет:</strong> <?= $period['advice'] ?></div>
                <div class="detail-item"><strong>❤️ Любовь:</strong> <?= $period['love'] ?></div>
                <div class="detail-item"><strong>💼 Работа:</strong> <?= $period['work'] ?></div>
                <div class="detail-item"><strong>💰 Финансы:</strong> <?= $period['finance'] ?></div>
                <div class="detail-item"><strong>🏥 Здоровье:</strong> <?= $period['health'] ?></div>
                <div class="detail-item"><strong>🧘 Духовность:</strong> <?= $period['spiritual'] ?></div>
                
                <!-- Детальные советы -->
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
                
                <!-- Архетип -->
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
                
                <!-- Эзотерика -->
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
                
                <!-- Прогноз -->
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
                
                <!-- Действие и аффирмация -->
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
        
        <!-- ==================== РАСЧЁТНЫЕ ДАННЫЕ ==================== -->
        <h2 class="matrix-title"><i class="fas fa-calculator"></i> Как мы рассчитали</h2>
        <div class="info-block-custom">
            <div class="info-row">
                <span class="info-label">День рождения:</span>
                <span class="info-value"><?= $calculationDetails['day'] ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Месяц рождения:</span>
                <span class="info-value"><?= $calculationDetails['month'] ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Год рождения:</span>
                <span class="info-value"><?= $calculationDetails['year'] ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Базовое число:</span>
                <span class="info-value"><?= $calculationDetails['day'] ?> × <?= $calculationDetails['month'] ?> × <?= $calculationDetails['year'] ?> = <?= number_format($calculationDetails['base_number']) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Разбивка на цифры:</span>
                <span class="info-value"><?= $calculationDetails['digits_raw'] ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Жизненный код (без нулей):</span>
                <span class="info-value"><?= $digitsDisplay ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Шаг периода:</span>
                <span class="info-value"><?= $step ?> года</span>
            </div>
            <div class="info-row">
                <span class="info-label">Количество периодов:</span>
                <span class="info-value"><?= count($years) ?> (до <?= max($years) ?> лет)</span>
            </div>
        </div>
        
        <!-- ==================== ПРИЗЫВ ==================== -->
        <div class="actions-ps" style="display: block; text-align: center; font-size: 24px; font-weight: 700; color: #b38b5f; padding: 20px 30px; margin: 40px 0 20px; border: 3px solid #b38b5f; border-radius: 80px; background: #fcf9f5;">
            <i class="fas fa-gem"></i> Полный разбор Карты Жизни готов!
        </div>
        
        <?php include '../app/include/socseti.php'; ?>
        
        <div class="summa0">
            <div class="summa">Стоимость услуги 379 рублей</div>
        </div>
        
        <!-- ==================== КНОПКИ ДЕЙСТВИЙ ==================== -->
        <div class="action-buttons no-print">
            <a href="life-chart-form-supp.php" class="btn btn-primary">
                <i class="fas fa-redo"></i> Новый расчёт
            </a>
            <button onclick="window.print()" class="btn btn-primary" style="background: #9b59b6; border-bottom-color: #6a3d7a;">
                <i class="fas fa-file-pdf"></i> Сохранить в PDF
            </button>
        </div>
        
        <!-- ==================== ФУТЕР ==================== -->
        <div class="footer-pif">
            <p><i class="far fa-clock"></i> Расчёт выполнен: <?= date('d.m.Y H:i:s') ?></p>
            <p>© <?= date('Y') ?> Карта Жизни | Нумерологический прогноз</p>
        </div>
        
    </div>
</div>

<!-- ==================== СКРИПТ ДЛЯ ГРАФИКА ==================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const years = <?= json_encode($years) ?>;
    const values = <?= json_encode($values) ?>;
    
    const colors = values.map(v => {
        if (v >= 7) return '#2ecc71';
        if (v <= 3) return '#e74c3c';
        return '#3498db';
    });
    
    const ctx = document.getElementById('lifeChartSup');
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
    
    function getAgeWord(age) {
        const lastDigit = age % 10;
        const lastTwoDigits = age % 100;
        if (lastTwoDigits >= 11 && lastTwoDigits <= 14) return 'лет';
        if (lastDigit == 1) return 'год';
        if (lastDigit >= 2 && lastDigit <= 4) return 'года';
        return 'лет';
    }
});
</script>

</body>
</html>
