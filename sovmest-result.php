<?
include 'app/include/connect.php';
include 'app/include/config.php';
include 'app/include/functions-front.php';
include 'app/include/sovmest-function.php';
//tt($_SESSION);
// Проверяем, есть ли результаты в сессии
$sovmest = selectOne('calc', ['id'=>11]);
if(!isset($_SESSION['compatibility_result'])) {
    header('Location: '. ABS_PATH . $sovmest['ssilka']);
    exit;
}

$result = $_SESSION['compatibility_result'];
$numbers1 = $result['numbers1'];
$numbers2 = $result['numbers2'];
$compatibility = $result['compatibility'];

// Получаем полную расшифровку
$interpretation = getFullCompatibilityInterpretation($compatibility, $numbers1, $numbers2);

// Получаем цену из базы (если есть)

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
    
</head>
<body>
           <!-- шапка -->
        <?php  
            include_once 'app/include/header-front.php';
        ?>
    <!-- шапка -->
    <div class="landing">
        <div class="container">
            <!-- Заголовок -->
            <div class="header-pif">
                <h1><i class="fas fa-heart"></i> Совместимость имён</h1>
                <div class="subtitle">Детальный анализ совместимости пары</div>
            </div>
            
            <!-- Информация об именах -->
          
            <div class="date-info" style="display: flex; justify-content: center; align-items: center; gap: 20px;">
                <div class="date-item" style="flex: 0 0 auto;">
                    <div class="date-value"><?= htmlspecialchars($result['name1']) ?></div>
                    <div class="date-label">Партнёр 1</div>
                </div>
                <div style="font-size: 48px; font-weight: bold; color: #b38b5f; margin: 0 10px;">+</div>
                <div class="date-item" style="flex: 0 0 auto;">
                    <div class="date-value"><?= htmlspecialchars($result['name2']) ?></div>
                    <div class="date-label">Партнёр 2</div>
                </div>
            </div>
            
              <!-- Процент совместимости -->
            <div class="compatibility-score">
                <div class="score-circle">
                    <div class="score-value"><?= $interpretation['percentage'] ?>%</div>
                    <div class="score-label">совместимости</div>
                </div>
                <!-- <div class="level-badge" style="background: <?= $interpretation['percentage'] >= 70 ? '#27ae60' : ($interpretation['percentage'] >= 50 ? '#f39c12' : '#e74c3c') ?>; color: white;">
                    <?= $interpretation['level_icon'] ?> <?= $interpretation['level'] ?>
                </div> -->
            </div>   
            <!--///////////////////-- >
              <!-- Призыв к полному анализу -->
            <div class="actions-ps">Хотите более глубокий анализ по ФИО и дате рождения?</div>
            <?php 
            include_once 'app/include/socseti.php'; 
            ?>
            <div class="summa0">
                <div class="summa">Стоимость полного анализа — <?php echo $sovmest['price'];?> рублей</div>
            </div>
            <!--///////////////////-- >

            
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
                        <p style="margin-top: 8px;"><?= $interpretation['name_interpretation']['full'] ?? '' ?></p>
                        <?php if(isset($interpretation['name_interpretation']['strength'])): ?>
                        <div class="strength-weakness">
                            <div class="strength-box">💪 <?= $interpretation['name_interpretation']['strength'] ?></div>
                            <div class="weakness-box">⚠️ <?= $interpretation['name_interpretation']['weakness'] ?></div>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($interpretation['name_interpretation']['dynamic'])): ?>
                        <div class="dynamic-box">🔄 <?= $interpretation['name_interpretation']['dynamic'] ?></div>
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
                        <p style="margin-top: 8px;"><?= $interpretation['soul_interpretation']['full'] ?? '' ?></p>
                        <?php if(isset($interpretation['soul_interpretation']['strength'])): ?>
                        <div class="strength-weakness">
                            <div class="strength-box">💪 <?= $interpretation['soul_interpretation']['strength'] ?></div>
                            <div class="weakness-box">⚠️ <?= $interpretation['soul_interpretation']['weakness'] ?></div>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($interpretation['soul_interpretation']['dynamic'])): ?>
                        <div class="dynamic-box">🔄 <?= $interpretation['soul_interpretation']['dynamic'] ?></div>
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
                        <p style="margin-top: 8px;"><?= $interpretation['personality_interpretation']['full'] ?? '' ?></p>
                        <?php if(isset($interpretation['personality_interpretation']['strength'])): ?>
                        <div class="strength-weakness">
                            <div class="strength-box">💪 <?= $interpretation['personality_interpretation']['strength'] ?></div>
                            <div class="weakness-box">⚠️ <?= $interpretation['personality_interpretation']['weakness'] ?></div>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($interpretation['personality_interpretation']['dynamic'])): ?>
                        <div class="dynamic-box">🔄 <?= $interpretation['personality_interpretation']['dynamic'] ?></div>
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
                        <p style="margin-top: 8px;"><?= $interpretation['karmic_interpretation']['full'] ?? '' ?></p>
                        <?php if(isset($interpretation['karmic_interpretation']['strength'])): ?>
                        <div class="strength-weakness">
                            <div class="strength-box">💪 <?= $interpretation['karmic_interpretation']['strength'] ?></div>
                            <div class="weakness-box">⚠️ <?= $interpretation['karmic_interpretation']['weakness'] ?></div>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($interpretation['karmic_interpretation']['dynamic'])): ?>
                        <div class="dynamic-box">🔄 <?= $interpretation['karmic_interpretation']['dynamic'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Совет по укреплению союза (для низкой совместимости) -->
            <?php if($interpretation['percentage'] < 70 && !empty($interpretation['strengthening_advice'])): ?>
            <div class="advice-block">
                <h2><i class="fas fa-tools"></i> Как укрепить ваш союз?</h2>
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
       
            
            <!-- Призыв к полному анализу -->
            <div class="actions-ps">Хотите более глубокий анализ по ФИО и дате рождения?</div>
            <?php 
            include_once 'app/include/socseti.php'; 
            ?>
            <div class="summa0">
                <div class="summa">Стоимость полного анализа — <?php echo $sovmest['price'];?> рублей</div>
            </div>
            
            <!-- Кнопки действий -->
            <div class="action-buttons">
                <a href="<?php echo ABS_PATH;?>#all-calcs" class="btn btn-primary">
                <i class="fas fa-chart-line"></i> Другие расчёты
                </a>
            </div>
            
            <!-- Футер -->
            <div class="footer-pif">
                <p><i class="far fa-clock"></i> Расчёт выполнен: <?= $result['calculated_at'] ?></p>
                <p>© <?= date('Y') ?> Совместимость имён | Профессиональный нумерологический анализ</p>
            </div>
        </div>
    </div>
    
    <?php include_once 'app/include/FooterAll.php'; ?>
</body>
</html>
