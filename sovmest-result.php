<?php
include 'app/include/config.php';
include 'app/include/functions-front.php';
include 'app/include/sovmest-function.php';
//tt($_SESSION);
// Проверяем, есть ли результаты в сессии
if(!isset($_SESSION['compatibility_result'])) {
    header('Location: sovmest-form.php');
    exit;
}

$result = $_SESSION['compatibility_result'];
$numbers1 = $result['numbers1'];
$numbers2 = $result['numbers2'];
$compatibility = $result['compatibility'];

// Получаем полную расшифровку
$interpretation = getFullCompatibilityInterpretation($compatibility, $numbers1, $numbers2);

// Получаем цену из базы (если есть)
//$sovmest = selectOne('calc', ['id'=>11]);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Совместимость имён - Результаты</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/all-style.css">
    <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/sovmest.css">
    
    <!-- <style>
        /* Дополнительные стили для совместимости */
        .compatibility-score {
            text-align: center;
            margin: 30px 0;
        }
        .score-circle {
            width: 180px;
            height: 180px;
            margin: 0 auto;
            background: linear-gradient(135deg, #b38b5f, #8a6e4b);
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 15px 35px rgba(179, 139, 95, 0.3);
        }
        .score-value {
            font-size: 56px;
            font-weight: bold;
        }
        .score-label {
            font-size: 18px;
            opacity: 0.9;
        }
        .level-badge {
            display: inline-block;
            padding: 8px 25px;
            border-radius: 60px;
            font-size: 20px;
            font-weight: bold;
            margin: 15px 0;
        }
        .pair-numbers {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 30px;
            align-items: center;
            margin: 30px 0;
        }
        .number-block {
            background: white;
            border-radius: 30px;
            padding: 25px;
            text-align: center;
            border: 1px solid #f0e4d6;
        }
        .number-block h3 {
            color: #b38b5f;
            margin-bottom: 15px;
        }
        .number-list {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        .number-item {
            text-align: center;
        }
        .number-item .num {
            font-size: 32px;
            font-weight: bold;
            color: #b38b5f;
        }
        .number-item .label {
            font-size: 12px;
            color: #8b7a6b;
        }
        .heart-icon {
            font-size: 48px;
            color: #b38b5f;
        }
        .advice-block {
            background: #f9f5f0;
            border-radius: 30px;
            padding: 25px;
            margin: 20px 0;
            border-left: 5px solid #b38b5f;
        }
        .strengthening-list {
            list-style: none;
            padding: 0;
        }
        .strengthening-list li {
            padding: 12px 0;
            border-bottom: 1px solid #f0e4d6;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
        .strengthening-list li:last-child {
            border-bottom: none;
        }
        .criteria-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 30px 0;
        }
        .criteria-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            border: 1px solid #f0e4d6;
        }
        .criteria-title {
            font-weight: bold;
            color: #b38b5f;
            margin-bottom: 10px;
            font-size: 18px;
        }
        .criteria-numbers {
            display: flex;
            justify-content: space-between;
            margin: 15px 0;
            padding: 10px;
            background: #fefaf4;
            border-radius: 15px;
        }
        .criteria-numbers span {
            font-size: 24px;
            font-weight: bold;
        }
        .criteria-desc {
            font-size: 14px;
            color: #6a5a4c;
            line-height: 1.5;
        }
        .strength-weakness {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 15px 0;
        }
        .strength-box, .weakness-box {
            padding: 12px;
            border-radius: 15px;
            font-size: 14px;
        }
        .strength-box {
            background: #e8f5e9;
            color: #2e7d32;
        }
        .weakness-box {
            background: #ffebee;
            color: #c62828;
        }
        @media (max-width: 768px) {
            .pair-numbers {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .heart-icon {
                transform: rotate(90deg);
            }
            .criteria-grid {
                grid-template-columns: 1fr;
            }
            .strength-weakness {
                grid-template-columns: 1fr;
            }
        }
    </style> -->
</head>
<body>
    <div class="container">
        <!-- Заголовок -->
        <div class="header-pif">
            <h1><i class="fas fa-heart"></i> Совместимость имён</h1>
            <div class="subtitle">Детальный анализ совместимости пары</div>
        </div>
        
        <!-- Информация об именах -->
        <div class="date-info">
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($result['name1']) ?></div>
                <div class="date-label">Партнёр 1</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($result['name2']) ?></div>
                <div class="date-label">Партнёр 2</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= $interpretation['percentage'] ?>%</div>
                <div class="date-label">Совместимость</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= $result['calculated_at'] ?></div>
                <div class="date-label">Дата расчёта</div>
            </div>
        </div>
        
        <!-- Процент совместимости -->
        <div class="compatibility-score">
            <div class="score-circle">
                <div class="score-value"><?= $interpretation['percentage'] ?>%</div>
                <div class="score-label">совместимости</div>
            </div>
            <div class="level-badge" style="background: <?= $interpretation['percentage'] >= 70 ? '#27ae60' : ($interpretation['percentage'] >= 50 ? '#f39c12' : '#e74c3c') ?>; color: white;">
                <?= $interpretation['level_icon'] ?> <?= $interpretation['level'] ?>
            </div>
        </div>
        
        <!-- Краткое описание уровня -->
        <div class="quality-card">
            <div class="quality-title">✨ Общая оценка</div>
            <div class="quality-text"><?= $interpretation['short_description'] ?></div>
        </div>
        
        <!-- Полное описание -->
        <div class="quality-card">
            <div class="quality-title">📖 Подробный разбор</div>
            <div class="quality-text"><?= $interpretation['full_description'] ?></div>
        </div>
        
        <!-- Ключевые числа пары -->
        <h2 class="matrix-title"><i class="fas fa-magic"></i> Ключевые числа</h2>
        <div class="pair-numbers">
            <div class="number-block">
                <h3><?= htmlspecialchars($result['name1']) ?></h3>
                <div class="number-list">
                    <div class="number-item">
                        <div class="num"><?= $numbers1['name'] ?></div>
                        <div class="label">имя</div>
                    </div>
                    <div class="number-item">
                        <div class="num"><?= $numbers1['soul'] ?></div>
                        <div class="label">душа</div>
                    </div>
                    <div class="number-item">
                        <div class="num"><?= $numbers1['personality'] ?></div>
                        <div class="label">личность</div>
                    </div>
                    <div class="number-item">
                        <div class="num"><?= $numbers1['karmic'] ?></div>
                        <div class="label">карма</div>
                    </div>
                </div>
            </div>
            <div class="heart-icon">
                <i class="fas fa-heart"></i>
            </div>
            <div class="number-block">
                <h3><?= htmlspecialchars($result['name2']) ?></h3>
                <div class="number-list">
                    <div class="number-item">
                        <div class="num"><?= $numbers2['name'] ?></div>
                        <div class="label">имя</div>
                    </div>
                    <div class="number-item">
                        <div class="num"><?= $numbers2['soul'] ?></div>
                        <div class="label">душа</div>
                    </div>
                    <div class="number-item">
                        <div class="num"><?= $numbers2['personality'] ?></div>
                        <div class="label">личность</div>
                    </div>
                    <div class="number-item">
                        <div class="num"><?= $numbers2['karmic'] ?></div>
                        <div class="label">карма</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Детальный разбор по критериям -->
        <h2 class="matrix-title"><i class="fas fa-chart-bar"></i> Детальный разбор</h2>
        <div class="criteria-grid">
            <!-- Число имени -->
            <div class="criteria-card">
                <div class="criteria-title">🎭 Число имени</div>
                <div class="criteria-numbers">
                    <span><?= $numbers1['name'] ?></span>
                    <span>→</span>
                    <span><?= $numbers2['name'] ?></span>
                </div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['name_interpretation']['title'] ?? 'Анализ характеров' ?></strong>
                    <p style="margin-top: 8px;"><?= $interpretation['name_interpretation']['full'] ?? $interpretation['name_interpretation'] ?></p>
                    <?php if(isset($interpretation['name_interpretation']['strength'])): ?>
                    <div class="strength-weakness">
                        <div class="strength-box">💪 <?= $interpretation['name_interpretation']['strength'] ?></div>
                        <div class="weakness-box">⚠️ <?= $interpretation['name_interpretation']['weakness'] ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Число души -->
            <div class="criteria-card">
                <div class="criteria-title">💖 Число души</div>
                <div class="criteria-numbers">
                    <span><?= $numbers1['soul'] ?></span>
                    <span>→</span>
                    <span><?= $numbers2['soul'] ?></span>
                </div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['soul_interpretation']['title'] ?? 'Эмоциональная связь' ?></strong>
                    <p style="margin-top: 8px;"><?= $interpretation['soul_interpretation']['full'] ?? $interpretation['soul_interpretation'] ?></p>
                    <?php if(isset($interpretation['soul_interpretation']['strength'])): ?>
                    <div class="strength-weakness">
                        <div class="strength-box">💪 <?= $interpretation['soul_interpretation']['strength'] ?></div>
                        <div class="weakness-box">⚠️ <?= $interpretation['soul_interpretation']['weakness'] ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Число личности -->
            <div class="criteria-card">
                <div class="criteria-title">👤 Число личности</div>
                <div class="criteria-numbers">
                    <span><?= $numbers1['personality'] ?></span>
                    <span>→</span>
                    <span><?= $numbers2['personality'] ?></span>
                </div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['personality_interpretation']['title'] ?? 'Социальный образ' ?></strong>
                    <p style="margin-top: 8px;"><?= $interpretation['personality_interpretation']['full'] ?? $interpretation['personality_interpretation'] ?></p>
                    <?php if(isset($interpretation['personality_interpretation']['strength'])): ?>
                    <div class="strength-weakness">
                        <div class="strength-box">💪 <?= $interpretation['personality_interpretation']['strength'] ?></div>
                        <div class="weakness-box">⚠️ <?= $interpretation['personality_interpretation']['weakness'] ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Кармическое число -->
            <div class="criteria-card">
                <div class="criteria-title">🌀 Кармическое число</div>
                <div class="criteria-numbers">
                    <span><?= $numbers1['karmic'] ?></span>
                    <span>→</span>
                    <span><?= $numbers2['karmic'] ?></span>
                </div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['karmic_interpretation']['title'] ?? 'Кармическая задача' ?></strong>
                    <p style="margin-top: 8px;"><?= $interpretation['karmic_interpretation']['full'] ?? $interpretation['karmic_interpretation'] ?></p>
                    <?php if(isset($interpretation['karmic_interpretation']['strength'])): ?>
                    <div class="strength-weakness">
                        <div class="strength-box">💪 <?= $interpretation['karmic_interpretation']['strength'] ?></div>
                        <div class="weakness-box">⚠️ <?= $interpretation['karmic_interpretation']['weakness'] ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Совет по укреплению союза (для низкой совместимости) -->
        <?php if($interpretation['percentage'] < 70 && !empty($interpretation['strengthening_advice'])): ?>
        <div class="advice-block">
            <h2 class="section-title" style="background: #f39c12; margin-top: 0;"><i class="fas fa-tools"></i> Как укрепить ваш союз?</h2>
            <ul class="strengthening-list">
                <?php foreach($interpretation['strengthening_advice'] as $advice): ?>
                <li>
                    <i class="fas fa-heart" style="color: #b38b5f;"></i>
                    <span><?= $advice ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
        
        <!-- Общая рекомендация -->
        <div class="quality-card">
            <div class="quality-title">💫 Общая рекомендация</div>
            <div class="quality-text"><?= $interpretation['general_advice'] ?></div>
        </div>
        
        <!-- Призыв к полному анализу -->
        <div class="actions-ps">Хотите более глубокий анализ по ФИО и дате рождения?</div>
        <?php include_once 'app/include/socseti.php'; ?>
        <div class="summa0">
            <div class="summa">Стоимость полного анализа — <?php echo $sovmest['price'] ?? '399';?> рублей</div>
        </div>
        
        <!-- Кнопки действий -->
        <div class="action-buttons">
            <a href="compatibility-form.php" class="btn btn-primary">
                <i class="fas fa-redo"></i> Новый расчёт
            </a>
            <button onclick="window.print()" class="btn btn-secondary">
                <i class="fas fa-print"></i> Распечатать
            </button>
        </div>
        
        <!-- Футер -->
        <div class="footer-pif">
            <p><i class="far fa-clock"></i> Расчёт выполнен: <?= $result['calculated_at'] ?></p>
            <p>© <?= date('Y') ?> Совместимость имён | Профессиональный нумерологический анализ</p>
        </div>
    </div>
    
    <?php include_once 'app/include/FooterAll.php'; ?>
    
    <script>
        // Плавная прокрутка при загрузке
        document.addEventListener('DOMContentLoaded', function() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        });
    </script>
</body>
</html>
