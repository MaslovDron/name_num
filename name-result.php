<?php
include 'app/include/config.php';
include 'app/include/connect.php';
include 'app/include/functions-front.php';
include 'app/controllers/NameController.php';
// Получаем цену из базы
$imya = selectOne('calc', ['id'=>10]);
// Проверяем, есть ли результаты в сессии
if(!isset($_SESSION['name_result'])) {
    //header('Location: name-form.php');
    header('Location: ' . ABS_PATH . $imya['ssilka']);
    exit;
}

$result = $_SESSION['name_result'];
$numbers = $result['numbers'];
$interpretations = $result['interpretations'];
$additional = $result['additional'] ?? [];
$total = $result['total'] ?? [];
$spectrum = $result['spectrum'] ?? [];
$subconscious = $result['subconscious'] ?? [];
$dynamics = $result['dynamics'] ?? [];
$corrections = $result['corrections'] ?? [];
$destiny = $result['destiny'] ?? [];
$hiddenPotential = $result['hidden_potential'] ?? [];

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нумерология имени - Результаты</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/name-style.css">
    <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/all-style.css">
</head>
<body>
    <!-- шапка -->
        <?php  
            include_once 'app/include/header-front.php';
        ?>
    <!-- шапка -->
    <div class="container">
        <!-- Заголовок -->
        <div class="header-pif">
            <h1><i class="fas fa-font"></i> Нумерология имени</h1>
            <div class="subtitle">Детальный анализ личности по имени</div>
        </div>
        
        <!-- Информация об имени -->
        <div class="date-info">
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($result['firstname']) ?></div>
                <div class="date-label">Ваше имя</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= $numbers['name'] ?></div>
                <div class="date-label">Число имени</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= $numbers['soul'] ?></div>
                <div class="date-label">Число души</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= $numbers['personality'] ?></div>
                <div class="date-label">Число личности</div>
            </div>
        </div>
       
        
        <!-- Ключевые числа -->
        <h2 class="matrix-title"><i class="fas fa-magic"></i> Ключевые числа</h2>
        <div class="working-numbers">
            <div class="number-card">
                <div class="number-value"><?= $numbers['name'] ?></div>
                <div class="number-name">Число имени</div>
                <div class="number-desc">Характер, таланты</div>
            </div>
            <div class="number-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="number-value"><?= $numbers['soul'] ?></div>
                <div class="number-name">Число души</div>
                <div class="number-desc">Желания, мотивация</div>
            </div>
            <div class="number-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="number-value"><?= $numbers['personality'] ?></div>
                <div class="number-name">Число личности</div>
                <div class="number-desc">Как видят другие</div>
            </div>
            <div class="number-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <div class="number-value"><?= $numbers['karmic'] ?></div>
                <div class="number-name">Кармическое число</div>
                <div class="number-desc">Задачи души</div>
            </div>
        </div>
         <!-- .............. -->
          <div class="actions-ps">Полный нумерологический расчет по полному ФИО вы можете заказать:</div>
        <?php 
        include 'app/include/socseti.php'; 
        ?>
        <div class="summa0">
            <div class="summa">Стоимость услуги <?php echo $imya['price'] ?? '199';?> рублей</div>
        </div>
        <!-- .............. -->
        
        <!-- Матрица чисел (2x2) -->
        <div class="matrix-section">
            <h2 class="matrix-title"><i class="fas fa-th"></i> Ваш нумерологический код</h2>
            <div class="matrix-grid" style="grid-template-columns: repeat(2, 1fr);">
                <?php
                $matrixCells = [
                    1 => ['number' => $numbers['name'], 'label' => 'Число имени'],
                    2 => ['number' => $numbers['soul'], 'label' => 'Число души'],
                    3 => ['number' => $numbers['personality'], 'label' => 'Число личности'],
                    4 => ['number' => $numbers['karmic'], 'label' => 'Кармическое число']
                ];
                
                foreach($matrixCells as $cell):
                ?>
                <div class="matrix-cell">
                    <div class="cell-label"><?= $cell['label'] ?></div>
                    <div class="cell-number"><?= $cell['number'] ?></div>
                    <div class="cell-count">&nbsp;</div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- ==================== УСИЛЕННЫЙ АРХЕТИП (имя = душа) ==================== -->
        <?php if(isset($result['combination']) && !empty($result['combination'])): ?>
        <div class="additional-analysis">
            <h2 class="section-title"><i class="fas fa-star"></i> Усиленный архетип</h2>
            <div class="quality-card" style="border-left-color: #f39c12;">
                <div class="quality-title" style="font-size: 24px;"><?= $result['combination']['title'] ?></div>
                <div class="quality-text"><?= $result['combination']['description'] ?></div>
            </div>
        </div>
        <?php endif; ?>
        <!-- ==================== ДОПОЛНИТЕЛЬНЫЕ СОВПАДЕНИЯ ==================== -->
        <?php if(isset($result['additional_combinations']) && !empty($result['additional_combinations'])): ?>
        <div class="additional-analysis">
            <h2 class="section-title"><i class="fas fa-handshake"></i> Совпадения чисел</h2>
            <?php foreach($result['additional_combinations'] as $comb): ?>
            <div class="quality-card">
                <div class="quality-title"><?= $comb['type'] ?></div>
                <div class="quality-text"><?= $comb['text'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>        
        <!-- ==================== ЧИСЛО ИМЕНИ ==================== -->
        <div class="interpretations">
            <h2 class="section-title"><i class="fas fa-chart-bar"></i> Число имени (<?= $numbers['name'] ?>)</h2>
            <div class="quality-card">
                <div class="quality-title"><?= $interpretations['name']['title'] ?? 'Лидер' ?></div>
                <div class="quality-text"><?= $interpretations['name']['essence'] ?? 'Описание характера' ?></div>
                
                <!-- Мифология и сакральный смысл -->
                <?php if(!empty($interpretations['name']['mythology'])): ?>
                <div style="margin-top: 15px; padding: 12px; background: #f9f5f0; border-radius: 15px;">
                    <div><strong>🏛️ Мифология:</strong> <?= $interpretations['name']['mythology'] ?></div>
                    <?php if(!empty($interpretations['name']['sacred'])): ?>
                    <div style="margin-top: 8px;"><strong>✨ Сакральный смысл:</strong> <?= $interpretations['name']['sacred'] ?></div>
                    <?php endif; ?>
                    <?php if(!empty($interpretations['name']['archetype'])): ?>
                    <div style="margin-top: 8px;"><strong>🎭 Архетип:</strong> <?= $interpretations['name']['archetype'] ?></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <!-- Сильные и слабые стороны -->
                <?php if(isset($interpretations['name']['strengths'])): ?>
                <div class="quality-details" style="margin-top: 15px;">
                    <div><strong>💪 Сильные стороны:</strong> <?= $interpretations['name']['strengths'] ?></div>
                    <div style="margin-top: 8px;"><strong>⚠️ Слабые стороны:</strong> <?= $interpretations['name']['weaknesses'] ?></div>
                    <div style="margin-top: 8px;"><strong>🌑 Теневая сторона:</strong> <?= $interpretations['name']['in_shadow'] ?></div>
                </div>
                <?php endif; ?>
                
                <!-- Профессии -->
                <?php if(!empty($interpretations['name']['life']['profession']['text'])): ?>
                <div style="margin-top: 15px;">
                    <strong>💼 Профессии:</strong> <?= $interpretations['name']['life']['profession']['text'] ?>
                    <?php if(!empty($interpretations['name']['life']['profession']['examples'])): ?>
                    <div style="margin-top: 5px;"><strong>🌟 Примеры:</strong> <?= $interpretations['name']['life']['profession']['examples'] ?></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <!-- Отношения -->
                <?php if(!empty($interpretations['name']['life']['relationships']['text'])): ?>
                <div style="margin-top: 15px;">
                    <strong>❤️ Отношения:</strong> <?= $interpretations['name']['life']['relationships']['text'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Деньги -->
                <?php if(!empty($interpretations['name']['life']['money']['text'])): ?>
                <div style="margin-top: 15px;">
                    <strong>💰 Деньги:</strong> <?= $interpretations['name']['life']['money']['text'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Здоровье -->
                <?php if(!empty($interpretations['name']['life']['health']['text'])): ?>
                <div style="margin-top: 15px;">
                    <strong>🏥 Здоровье:</strong> <?= $interpretations['name']['life']['health']['text'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Знаменитости -->
                <?php if(!empty($interpretations['name']['celebrities'])): ?>
                <div style="margin-top: 15px;">
                    <strong>⭐ Знаменитости:</strong> <?= $interpretations['name']['celebrities'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Миссия -->
                <?php if(!empty($interpretations['name']['mission'])): ?>
                <div style="margin-top: 15px; background: #f0e4d6; padding: 12px; border-radius: 15px;">
                    <strong>🎯 Миссия:</strong> <?= $interpretations['name']['mission'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Ключевые слова -->
                <?php if(!empty($interpretations['name']['keywords'])): ?>
                <div style="margin-top: 15px;">
                    <strong>🔑 Ключевые слова:</strong> <?= $interpretations['name']['keywords'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Аффирмации -->
                <?php if(!empty($interpretations['name']['affirmations'])): ?>
                <div style="margin-top: 15px;">
                    <strong>📿 Аффирмации:</strong>
                    <ul style="margin-top: 5px; margin-left: 20px;">
                        <?php foreach($interpretations['name']['affirmations'] as $affirmation): ?>
                        <li><?= $affirmation ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- ==================== ЧИСЛО ДУШИ ==================== -->
        <div class="interpretations">
            <h2 class="section-title"><i class="fas fa-heart"></i> Число души (<?= $numbers['soul'] ?>)</h2>
            <div class="quality-card">
                <div class="quality-title"><?= $interpretations['soul']['title'] ?? 'Загадочная душа' ?></div>
                <div class="quality-text"><?= $interpretations['soul']['essence'] ?? 'Описание души' ?></div>
                
                <!-- Желания и страхи -->
                <?php if(isset($interpretations['soul']['desires'])): ?>
                <div class="quality-details" style="margin-top: 15px;">
                    <div><strong>💭 Желания:</strong> <?= $interpretations['soul']['desires'] ?></div>
                    <div style="margin-top: 8px;"><strong>😟 Страхи:</strong> <?= $interpretations['soul']['fears'] ?></div>
                </div>
                <?php endif; ?>
                
                <!-- Мифология -->
                <?php if(!empty($interpretations['soul']['mythology'])): ?>
                <div style="margin-top: 15px; padding: 12px; background: #f9f5f0; border-radius: 15px;">
                    <div><strong>🏛️ Мифология:</strong> <?= $interpretations['soul']['mythology'] ?></div>
                    <?php if(!empty($interpretations['soul']['archetype'])): ?>
                    <div style="margin-top: 8px;"><strong>🎭 Архетип:</strong> <?= $interpretations['soul']['archetype'] ?></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <!-- Сильные и слабые стороны -->
                <?php if(!empty($interpretations['soul']['strengths'])): ?>
                <div class="quality-details" style="margin-top: 15px;">
                    <div><strong>💪 Сильные стороны:</strong> <?= $interpretations['soul']['strengths'] ?></div>
                    <div style="margin-top: 8px;"><strong>⚠️ Слабые стороны:</strong> <?= $interpretations['soul']['weaknesses'] ?></div>
                    <div style="margin-top: 8px;"><strong>🌑 Теневая сторона:</strong> <?= $interpretations['soul']['in_shadow'] ?></div>
                </div>
                <?php endif; ?>
                
                <!-- Профессии -->
                <?php if(!empty($interpretations['soul']['life']['profession']['text'])): ?>
                <div style="margin-top: 15px;">
                    <strong>💼 Профессии:</strong> <?= $interpretations['soul']['life']['profession']['text'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Знаменитости -->
                <?php if(!empty($interpretations['soul']['celebrities'])): ?>
                <div style="margin-top: 15px;">
                    <strong>⭐ Знаменитости:</strong> <?= $interpretations['soul']['celebrities'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Миссия -->
                <?php if(!empty($interpretations['soul']['mission'])): ?>
                <div style="margin-top: 15px; background: #f0e4d6; padding: 12px; border-radius: 15px;">
                    <strong>🎯 Миссия:</strong> <?= $interpretations['soul']['mission'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Ключевые слова -->
                <?php if(!empty($interpretations['soul']['keywords'])): ?>
                <div style="margin-top: 15px;">
                    <strong>🔑 Ключевые слова:</strong> <?= $interpretations['soul']['keywords'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Аффирмации -->
                <?php if(!empty($interpretations['soul']['affirmations'])): ?>
                <div style="margin-top: 15px;">
                    <strong>📿 Аффирмации:</strong>
                    <ul style="margin-top: 5px; margin-left: 20px;">
                        <?php foreach($interpretations['soul']['affirmations'] as $affirmation): ?>
                        <li><?= $affirmation ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- ==================== ЧИСЛО ЛИЧНОСТИ ==================== -->
        <div class="interpretations">
            <h2 class="section-title"><i class="fas fa-user"></i> Число личности (<?= $numbers['personality'] ?>)</h2>
            <div class="quality-card">
                <div class="quality-title"><?= $interpretations['personality']['title'] ?? 'Индивидуальность' ?></div>
                <div class="quality-text"><?= $interpretations['personality']['essence'] ?? 'Описание личности' ?></div>
                
                <!-- Образ и первое впечатление -->
                <?php if(isset($interpretations['personality']['image'])): ?>
                <div class="quality-details" style="margin-top: 15px;">
                    <div><strong>🎭 Образ:</strong> <?= $interpretations['personality']['image'] ?></div>
                    <div style="margin-top: 8px;"><strong>👀 Первое впечатление:</strong> <?= $interpretations['personality']['first_impression'] ?></div>
                </div>
                <?php endif; ?>
                
                <!-- Мифология -->
                <?php if(!empty($interpretations['personality']['mythology'])): ?>
                <div style="margin-top: 15px; padding: 12px; background: #f9f5f0; border-radius: 15px;">
                    <div><strong>🏛️ Мифология:</strong> <?= $interpretations['personality']['mythology'] ?></div>
                    <?php if(!empty($interpretations['personality']['archetype'])): ?>
                    <div style="margin-top: 8px;"><strong>🎭 Архетип:</strong> <?= $interpretations['personality']['archetype'] ?></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <!-- Сильные и слабые стороны -->
                <?php if(!empty($interpretations['personality']['strengths'])): ?>
                <div class="quality-details" style="margin-top: 15px;">
                    <div><strong>💪 Сильные стороны:</strong> <?= $interpretations['personality']['strengths'] ?></div>
                    <div style="margin-top: 8px;"><strong>⚠️ Слабые стороны:</strong> <?= $interpretations['personality']['weaknesses'] ?></div>
                    <div style="margin-top: 8px;"><strong>🌑 Теневая сторона:</strong> <?= $interpretations['personality']['in_shadow'] ?></div>
                </div>
                <?php endif; ?>
                
                <!-- Профессии -->
                <?php if(!empty($interpretations['personality']['life']['profession']['text'])): ?>
                <div style="margin-top: 15px;">
                    <strong>💼 Профессии:</strong> <?= $interpretations['personality']['life']['profession']['text'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Знаменитости -->
                <?php if(!empty($interpretations['personality']['celebrities'])): ?>
                <div style="margin-top: 15px;">
                    <strong>⭐ Знаменитости:</strong> <?= $interpretations['personality']['celebrities'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Миссия -->
                <?php if(!empty($interpretations['personality']['mission'])): ?>
                <div style="margin-top: 15px; background: #f0e4d6; padding: 12px; border-radius: 15px;">
                    <strong>🎯 Миссия:</strong> <?= $interpretations['personality']['mission'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Ключевые слова -->
                <?php if(!empty($interpretations['personality']['keywords'])): ?>
                <div style="margin-top: 15px;">
                    <strong>🔑 Ключевые слова:</strong> <?= $interpretations['personality']['keywords'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Аффирмации -->
                <?php if(!empty($interpretations['personality']['affirmations'])): ?>
                <div style="margin-top: 15px;">
                    <strong>📿 Аффирмации:</strong>
                    <ul style="margin-top: 5px; margin-left: 20px;">
                        <?php foreach($interpretations['personality']['affirmations'] as $affirmation): ?>
                        <li><?= $affirmation ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- ==================== КАРМИЧЕСКОЕ ЧИСЛО ==================== -->
        <div class="interpretations">
            <h2 class="section-title"><i class="fas fa-infinity"></i> Кармическое число (<?= $numbers['karmic'] ?>)</h2>
            <div class="quality-card">
                <div class="quality-title"><?= $interpretations['karmic']['title'] ?? 'Кармическая задача' ?></div>
                
                <!-- Суть -->
                <?php if(!empty($interpretations['karmic']['essence'])): ?>
                <div class="quality-text"><?= $interpretations['karmic']['essence'] ?></div>
                <?php endif; ?>
                
                <!-- Задачи -->
                <?php if(isset($interpretations['karmic']['tasks'])): ?>
                <div class="quality-text" style="margin-top: 15px;">
                    <strong>📜 Задачи:</strong>
                    <ul style="margin-top: 10px; margin-left: 20px;">
                        <?php foreach($interpretations['karmic']['tasks'] as $task): ?>
                        <li><?= $task ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="quality-text" style="margin-top: 10px;">
                    <strong>📖 Главный урок:</strong> <?= $interpretations['karmic']['lesson'] ?? 'Познание себя' ?>
                </div>
                <?php endif; ?>
                
                <!-- Мифология -->
                <?php if(!empty($interpretations['karmic']['mythology'])): ?>
                <div style="margin-top: 15px; padding: 12px; background: #f9f5f0; border-radius: 15px;">
                    <div><strong>🏛️ Мифология:</strong> <?= $interpretations['karmic']['mythology'] ?></div>
                </div>
                <?php endif; ?>
                
                <!-- Сильные и слабые стороны -->
                <?php if(!empty($interpretations['karmic']['strengths'])): ?>
                <div class="quality-details" style="margin-top: 15px;">
                    <div><strong>💪 Сильные стороны:</strong> <?= $interpretations['karmic']['strengths'] ?></div>
                    <div style="margin-top: 8px;"><strong>⚠️ Слабые стороны:</strong> <?= $interpretations['karmic']['weaknesses'] ?></div>
                    <div style="margin-top: 8px;"><strong>🌑 Теневая сторона:</strong> <?= $interpretations['karmic']['in_shadow'] ?></div>
                </div>
                <?php endif; ?>
                
                <!-- Профессии -->
                <?php if(!empty($interpretations['karmic']['life']['profession']['text'])): ?>
                <div style="margin-top: 15px;">
                    <strong>💼 Профессии:</strong> <?= $interpretations['karmic']['life']['profession']['text'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Знаменитости -->
                <?php if(!empty($interpretations['karmic']['celebrities'])): ?>
                <div style="margin-top: 15px;">
                    <strong>⭐ Знаменитости:</strong> <?= $interpretations['karmic']['celebrities'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Миссия -->
                <?php if(!empty($interpretations['karmic']['mission'])): ?>
                <div style="margin-top: 15px; background: #f0e4d6; padding: 12px; border-radius: 15px;">
                    <strong>🎯 Миссия:</strong> <?= $interpretations['karmic']['mission'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Ключевые слова -->
                <?php if(!empty($interpretations['karmic']['keywords'])): ?>
                <div style="margin-top: 15px;">
                    <strong>🔑 Ключевые слова:</strong> <?= $interpretations['karmic']['keywords'] ?>
                </div>
                <?php endif; ?>
                
                <!-- Аффирмации -->
                <?php if(!empty($interpretations['karmic']['affirmations'])): ?>
                <div style="margin-top: 15px;">
                    <strong>📿 Аффирмации:</strong>
                    <ul style="margin-top: 5px; margin-left: 20px;">
                        <?php foreach($interpretations['karmic']['affirmations'] as $affirmation): ?>
                        <li><?= $affirmation ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Суммарное число (общий потенциал) -->
        <?php if(isset($total['value'])): ?>
        <div class="total-number">
            <h2 class="section-title"><i class="fas fa-star-of-life"></i> Ваш общий энергетический потенциал</h2>
            <div class="quality-card" style="border-left-color: #f39c12; background: linear-gradient(145deg, #fff9f0, #fff);">
                <div class="quality-title" style="font-size: 28px;">Число <?= $total['value'] ?> — <?= $total['title'] ?? 'Искатель' ?></div>
                <div class="quality-text" style="font-size: 18px; margin: 15px 0;"><?= $total['short'] ?? '' ?></div>
                <div class="quality-text"><?= $total['full'] ?? '' ?></div>
                <?php if(isset($total['advice'])): ?>
                <div style="margin-top: 20px; padding: 15px; background: #f0e4d6; border-radius: 20px;">
                    <strong>💡 Совет:</strong> <?= $total['advice'] ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Спектр имени -->
        <?php if(!empty($spectrum)): ?>
        <div class="additional-analysis">
            <h2 class="section-title"><i class="fas fa-chart-pie"></i> Спектр имени</h2>
            <div class="quality-card">
                <div style="display: flex; gap: 15px; flex-wrap: wrap; margin: 15px 0; justify-content: center;">
                    <?php for($i = 1; $i <= 9; $i++): ?>
                    <div style="text-align: center; width: 60px;">
                        <div style="font-size: 28px; font-weight: bold; color: #b38b5f;"><?= $spectrum['counts'][$i] ?? 0 ?></div>
                        <div style="font-size: 14px; color: #6a5a4c;">число <?= $i ?></div>
                    </div>
                    <?php endfor; ?>
                </div>
                <p>📊 <strong><?= $spectrum['dominant_text'] ?? '' ?></strong></p>
                <p>📌 <strong><?= $spectrum['missing_text'] ?? '' ?></strong></p>
                <p>⚖️ <?= $spectrum['balance'] ?? '' ?></p>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Число подсознания -->
        <?php if(!empty($subconscious)): ?>
        <div class="additional-analysis">
            <h2 class="section-title"><i class="fas fa-brain"></i> Число подсознания</h2>
            <div class="quality-card">
                <div class="quality-title" style="font-size: 24px;">Число <?= $subconscious['number'] ?? '?' ?></div>
                <div class="quality-text"><?= $subconscious['meaning'] ?? 'Доверяйте своей интуиции' ?></div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Динамика имени -->
        <?php if(!empty($dynamics['analysis'])): ?>
        <div class="additional-analysis">
            <h2 class="section-title"><i class="fas fa-chart-line"></i> Динамика имени</h2>
            <div class="quality-card">
                <p><strong>Последовательность чисел:</strong> <?= implode(' → ', $dynamics['sequence'] ?? []) ?></p>
                <?php foreach($dynamics['analysis'] as $item): ?>
                <p>📈 <?= $item ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Рекомендации по коррекции имени -->
        <?php if(!empty($corrections)): ?>
        <div class="additional-analysis">
            <h2 class="section-title"><i class="fas fa-pen-fancy"></i> Коррекция имени</h2>
            <div class="quality-card">
                <?php foreach($corrections as $correction): ?>
                <p style="margin: 10px 0;">✍️ <?= $correction ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Число судьбы -->
        <?php if(!empty($destiny)): ?>
        <div class="additional-analysis">
            <h2 class="section-title"><i class="fas fa-road"></i> Число судьбы</h2>
            <div class="quality-card">
                <div class="quality-title" style="font-size: 24px;">Число <?= $destiny['number'] ?? '?' ?></div>
                <div class="quality-text"><?= $destiny['meaning'] ?? 'Познание себя и мира' ?></div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Скрытый потенциал -->
        <?php if(!empty($hiddenPotential)): ?>
        <div class="additional-analysis">
            <h2 class="section-title"><i class="fas fa-gem"></i> Скрытый потенциал</h2>
            <div class="quality-card">
                <div class="quality-title" style="font-size: 24px;">Число <?= $hiddenPotential['number'] ?? '?' ?></div>
                <div class="quality-text"><?= $hiddenPotential['meaning'] ?? 'Раскройте свою уникальность' ?></div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Дополнительный анализ -->
        <?php if(!empty($additional)): ?>
        <div class="additional-analysis">
            <h2 class="section-title"><i class="fas fa-chart-line"></i> Дополнительный анализ</h2>
            <div class="quality-card">
                <?php foreach($additional as $item): ?>
                <p style="margin: 10px 0;">📌 <?= $item ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="actions-ps">Полный нумерологический расчет по полному ФИО вы можете заказать:</div>
        <?php 
        include 'app/include/socseti.php'; 
        ?>
        <div class="summa0">
            <div class="summa">Стоимость услуги <?php echo $imya['price'] ?? '199';?> рублей</div>
        </div>
        
        <!-- Кнопки действий -->
        <div class="action-buttons">
             <a href="<?php echo ABS_PATH;?>#all-calcs" class="btn btn-primary">
            <i class="fas fa-chart-line"></i> Другие расчёты
            </a>
        </div>
        
        <!-- Футер -->
        <div class="footer-pif">
            <p><i class="far fa-clock"></i> Расчет выполнен: <?= $result['calculated_at'] ?></p>
            <p>© <?= date('Y') ?> Нумерология имени | Профессиональный нумерологический анализ</p>
        </div>
    </div>
    
    <?php include_once 'app/include/FooterAll.php'; ?>
</body>
</html>
