<?php
include '../app/include/config.php';
include '../app/include/functions-adm.php';
//tt($_SESSION);
// Проверяем, есть ли результаты в сессии
if(!isset($_SESSION['fio_result'])) {
    header('Location: fio.php');
    exit;
}

$result = $_SESSION['fio_result'];
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

// Подготовим данные для JavaScript
$js_result = json_encode($result);
$js_numbers = json_encode($numbers);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нумерология ФИО - Результаты</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            padding: 30px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #9b59b6;
        }
        
        .header h1 {
            color: #2c3e50;
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .header .subtitle {
            color: #7f8c8d;
            font-size: 1.2em;
        }
        
        .date-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .date-item {
            text-align: center;
            flex: 1;
            min-width: 150px;
        }
        
        .date-value {
            font-size: 2em;
            font-weight: bold;
            color: #9b59b6;
        }
        
        .date-label {
            color: #7f8c8d;
            font-size: 0.9em;
            margin-top: 5px;
        }
        
        .working-numbers {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .number-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        
        .number-value {
            font-size: 3em;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .number-name {
            font-size: 1em;
            opacity: 0.9;
        }
        
        .number-desc {
            font-size: 0.8em;
            opacity: 0.7;
            margin-top: 5px;
        }
        
        .matrix-section {
            margin: 40px 0;
        }
        
        .matrix-title {
            text-align: center;
            font-size: 1.8em;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        
        .matrix-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .matrix-cell {
            aspect-ratio: 1;
            background: white;
            border: 3px solid #9b59b6;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 1.8em;
            font-weight: bold;
            color: #2c3e50;
            position: relative;
            box-shadow: 0 5px 15px rgba(155, 89, 182, 0.2);
            transition: transform 0.3s ease;
        }
        
        .matrix-cell:hover {
            transform: scale(1.05);
        }
        
        .cell-number {
            font-size: 2.5em;
        }
        
        .cell-count {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: #9b59b6;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8em;
        }
        
        .cell-label {
            position: absolute;
            top: 5px;
            left: 5px;
            font-size: 0.8em;
            color: #7f8c8d;
        }
        
        .interpretations {
            margin: 40px 0;
        }
        
        .section-title {
            background: #2c3e50;
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 1.4em;
        }
        
        .section-title.purple {
            background: #9b59b6;
        }
        
        .quality-card {
            background: white;
            border-left: 5px solid #9b59b6;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 0 10px 10px 0;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .quality-card:hover {
            transform: translateX(5px);
        }
        
        .quality-title {
            font-size: 1.2em;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .quality-text {
            color: #555;
            line-height: 1.5;
        }
        
        .quality-details {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }
        
        .additional-analysis {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            margin-top: 40px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .stat-value {
            font-size: 2.5em;
            font-weight: bold;
            color: #9b59b6;
            margin-bottom: 10px;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1em;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }
        
        .btn-pdf {
            background: #9b59b6;
            color: white;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(0,0,0,0.2);
        }
        
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #7f8c8d;
            font-size: 0.9em;
        }
        
        @media (max-width: 768px) {
            .container { padding: 15px; }
            .header h1 { font-size: 1.8em; }
            .matrix-grid { gap: 10px; }
            .date-info { flex-direction: column; align-items: center; }
        }
        
        /* @media print {
            .action-buttons, .btn, .footer p:last-child { display: none !important; }
            body { background: white !important; color: black !important; }
            .container { max-width: 100% !important; box-shadow: none !important; padding: 10px !important; margin: 0 !important; }
            .matrix-cell { border: 2px solid black !important; }
            .number-card { background: #f0f0f0 !important; color: black !important; }
        } */     
        .loading-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(155, 89, 182, 0.95);
            color: white;
            padding: 25px 40px;
            border-radius: 15px;
            z-index: 99999;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            min-width: 300px;
            display: none;
        }
        
        .success-message {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #2ecc71;
            color: white;
            padding: 20px 25px;
            border-radius: 10px;
            z-index: 10000;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease;
            display: none;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @media print {
    /* Жёсткое скрытие всех колонтитулов */
    @page {
        margin: 0;
        @top-center {
            content: none !important;
        }
        @bottom-center {
            content: none !important;
        }
    }
    
    /* Убираем URL и дату из браузера */
    #header, #footer, .header, .footer, .page-header, .page-footer {
        display: none !important;
    }
}
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
    <a href="<?php echo ABS_PATH.'results/'.$_SESSION['filename'];?>">
    <?php echo ABS_PATH.'results/'.$_SESSION['filename'];?></a>
        <!-- Заголовок -->
        <div class="header">
            <h1><i class="fas fa-font"></i> Нумерология ФИО</h1>
            <div class="subtitle">Детальный анализ личности по полному имени</div>
        </div>
        
        <!-- Информация о ФИО -->
        <div class="date-info">
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($result['famely'] ?? '') ?></div>
                <div class="date-label">Фамилия</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($result['firstname'] ?? '') ?></div>
                <div class="date-label">Имя</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($result['lastname'] ?? '') ?></div>
                <div class="date-label">Отчество</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($result['fullname'] ?? '') ?></div>
                <div class="date-label">Полное имя</div>
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
            <h2 class="section-title purple"><i class="fas fa-star"></i> Усиленный архетип</h2>
            <div class="quality-card" style="border-left-color: #f39c12;">
                <div class="quality-title" style="font-size: 24px;"><?= $result['combination']['title'] ?></div>
                <div class="quality-text"><?= $result['combination']['description'] ?></div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- ==================== ДОПОЛНИТЕЛЬНЫЕ СОВПАДЕНИЯ ==================== -->
        <?php if(isset($result['additional_combinations']) && !empty($result['additional_combinations'])): ?>
        <div class="additional-analysis">
            <h2 class="section-title purple"><i class="fas fa-handshake"></i> Совпадения чисел</h2>
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
                
                <?php if(isset($interpretations['name']['strengths'])): ?>
                <div class="quality-details" style="margin-top: 15px;">
                    <div><strong>💪 Сильные стороны:</strong> <?= $interpretations['name']['strengths'] ?></div>
                    <div style="margin-top: 8px;"><strong>⚠️ Слабые стороны:</strong> <?= $interpretations['name']['weaknesses'] ?></div>
                    <div style="margin-top: 8px;"><strong>🌑 Теневая сторона:</strong> <?= $interpretations['name']['in_shadow'] ?></div>
                </div>
                <?php endif; ?>
                
                <?php if(!empty($interpretations['name']['life']['profession']['text'])): ?>
                <div style="margin-top: 15px;">
                    <strong>💼 Профессии:</strong> <?= $interpretations['name']['life']['profession']['text'] ?>
                    <?php if(!empty($interpretations['name']['life']['profession']['examples'])): ?>
                    <div style="margin-top: 5px;"><strong>🌟 Примеры:</strong> <?= $interpretations['name']['life']['profession']['examples'] ?></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <?php if(!empty($interpretations['name']['life']['relationships']['text'])): ?>
                <div style="margin-top: 15px;"><strong>❤️ Отношения:</strong> <?= $interpretations['name']['life']['relationships']['text'] ?></div>
                <?php endif; ?>
                
                <?php if(!empty($interpretations['name']['life']['money']['text'])): ?>
                <div style="margin-top: 15px;"><strong>💰 Деньги:</strong> <?= $interpretations['name']['life']['money']['text'] ?></div>
                <?php endif; ?>
                
                <?php if(!empty($interpretations['name']['life']['health']['text'])): ?>
                <div style="margin-top: 15px;"><strong>🏥 Здоровье:</strong> <?= $interpretations['name']['life']['health']['text'] ?></div>
                <?php endif; ?>
                
                <?php if(!empty($interpretations['name']['celebrities'])): ?>
                <div style="margin-top: 15px;"><strong>⭐ Знаменитости:</strong> <?= $interpretations['name']['celebrities'] ?></div>
                <?php endif; ?>
                
                <?php if(!empty($interpretations['name']['mission'])): ?>
                <div style="margin-top: 15px; background: #f0e4d6; padding: 12px; border-radius: 15px;">
                    <strong>🎯 Миссия:</strong> <?= $interpretations['name']['mission'] ?>
                </div>
                <?php endif; ?>
                
                <?php if(!empty($interpretations['name']['keywords'])): ?>
                <div style="margin-top: 15px;"><strong>🔑 Ключевые слова:</strong> <?= $interpretations['name']['keywords'] ?></div>
                <?php endif; ?>
                
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
                
                <?php if(isset($interpretations['soul']['desires'])): ?>
                <div class="quality-details" style="margin-top: 15px;">
                    <div><strong>💭 Желания:</strong> <?= $interpretations['soul']['desires'] ?></div>
                    <div style="margin-top: 8px;"><strong>😟 Страхи:</strong> <?= $interpretations['soul']['fears'] ?></div>
                </div>
                <?php endif; ?>
                
                <?php if(!empty($interpretations['soul']['strengths'])): ?>
                <div class="quality-details" style="margin-top: 15px;">
                    <div><strong>💪 Сильные стороны:</strong> <?= $interpretations['soul']['strengths'] ?></div>
                    <div style="margin-top: 8px;"><strong>⚠️ Слабые стороны:</strong> <?= $interpretations['soul']['weaknesses'] ?></div>
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
                
                <?php if(isset($interpretations['personality']['image'])): ?>
                <div class="quality-details" style="margin-top: 15px;">
                    <div><strong>🎭 Образ:</strong> <?= $interpretations['personality']['image'] ?></div>
                    <div style="margin-top: 8px;"><strong>👀 Первое впечатление:</strong> <?= $interpretations['personality']['first_impression'] ?></div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- ==================== КАРМИЧЕСКОЕ ЧИСЛО ==================== -->
        <div class="interpretations">
            <h2 class="section-title"><i class="fas fa-infinity"></i> Кармическое число (<?= $numbers['karmic'] ?>)</h2>
            <div class="quality-card">
                <div class="quality-title"><?= $interpretations['karmic']['title'] ?? 'Кармическая задача' ?></div>
                
                <?php if(!empty($interpretations['karmic']['essence'])): ?>
                <div class="quality-text"><?= $interpretations['karmic']['essence'] ?></div>
                <?php endif; ?>
                
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
            </div>
        </div>
        
        <!-- Суммарное число -->
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
            <h2 class="section-title purple"><i class="fas fa-chart-pie"></i> Спектр имени</h2>
            <div class="quality-card">
                <div style="display: flex; gap: 15px; flex-wrap: wrap; margin: 15px 0; justify-content: center;">
                    <?php for($i = 1; $i <= 9; $i++): ?>
                    <div style="text-align: center; width: 60px;">
                        <div style="font-size: 28px; font-weight: bold; color: #9b59b6;"><?= $spectrum['counts'][$i] ?? 0 ?></div>
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
            <h2 class="section-title purple"><i class="fas fa-brain"></i> Число подсознания</h2>
            <div class="quality-card">
                <div class="quality-title" style="font-size: 24px;">Число <?= $subconscious['number'] ?? '?' ?></div>
                <div class="quality-text"><?= $subconscious['meaning'] ?? 'Доверяйте своей интуиции' ?></div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Динамика имени -->
        <?php if(!empty($dynamics['analysis'])): ?>
        <div class="additional-analysis">
            <h2 class="section-title purple"><i class="fas fa-chart-line"></i> Динамика имени</h2>
            <div class="quality-card">
                <p><strong>Последовательность чисел:</strong> <?= implode(' → ', $dynamics['sequence'] ?? []) ?></p>
                <?php foreach($dynamics['analysis'] as $item): ?>
                <p>📈 <?= $item ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Коррекция имени -->
        <?php if(!empty($corrections)): ?>
        <div class="additional-analysis">
            <h2 class="section-title purple"><i class="fas fa-pen-fancy"></i> Коррекция имени</h2>
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
            <h2 class="section-title purple"><i class="fas fa-road"></i> Число судьбы</h2>
            <div class="quality-card">
                <div class="quality-title" style="font-size: 24px;">Число <?= $destiny['number'] ?? '?' ?></div>
                <div class="quality-text"><?= $destiny['meaning'] ?? 'Познание себя и мира' ?></div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Скрытый потенциал -->
        <?php if(!empty($hiddenPotential)): ?>
        <div class="additional-analysis">
            <h2 class="section-title purple"><i class="fas fa-gem"></i> Скрытый потенциал</h2>
            <div class="quality-card">
                <div class="quality-title" style="font-size: 24px;">Число <?= $hiddenPotential['number'] ?? '?' ?></div>
                <div class="quality-text"><?= $hiddenPotential['meaning'] ?? 'Раскройте свою уникальность' ?></div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Дополнительный анализ -->
        <?php if(!empty($additional)): ?>
        <div class="additional-analysis">
            <h2 class="section-title purple"><i class="fas fa-chart-line"></i> Дополнительный анализ</h2>
            <div class="quality-card">
                <?php foreach($additional as $item): ?>
                <p style="margin: 10px 0;">📌 <?= $item ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Кнопки действий -->
        <div class="action-buttons">
            <a href="fio.php" class="btn btn-primary">
                <i class="fas fa-redo"></i> Новый расчет
            </a>
            <button onclick="saveAsPDF()" class="btn btn-pdf">
                <i class="fas fa-download"></i> Сохранить PDF
            </button>
            <button onclick="savePageAsHTML()" class="btn btn-pdf">
                <i class="fa-brands fa-html5"></i> Сохранить HTML
            </button>
        </div>
        
        <!-- Футер -->
        <div class="footer">
            <p><i class="far fa-clock"></i> Расчет выполнен: <?= $result['calculated_at'] ?></p>
            <p>© <?= date('Y') ?> Нумерология ФИО | Профессиональный нумерологический анализ</p>
        </div>
    </div>
    
    <div id="loading-message" class="loading-message"></div>
    <div id="success-message" class="success-message"></div>
    
    <script>
        // Сохранение в PDF и HTML (те же функции, что и в name-result.php)
        function showLoadingMessage(text) {
            const loader = document.getElementById('loading-message');
            loader.innerHTML = `<div style="margin-bottom:15px;"><i class="fas fa-spinner fa-spin"></i></div><div>${text}</div>`;
            loader.style.display = 'block';
        }
        function hideLoadingMessage() { document.getElementById('loading-message').style.display = 'none'; }
        function showSuccessMessage(text) {
            const msg = document.getElementById('success-message');
            msg.innerHTML = `<i class="fas fa-check-circle"></i><div>${text}</div>`;
            msg.style.display = 'flex';
            setTimeout(() => { msg.style.display = 'none'; }, 3000);
        }
        
        function saveAsPDF() {
            showLoadingMessage('Подготовка к печати...');
            const result = <?= $js_result ?>;
            const numbers = <?= $js_numbers ?>;
            const printWindow = window.open('', '_blank');
            printWindow.document.write(createPrintContent(result, numbers));
            printWindow.document.close();
            printWindow.onload = function() {
                setTimeout(() => {
                    printWindow.print();
                    hideLoadingMessage();
                    showSuccessMessage('Откройте окно печати и выберите "Сохранить как PDF"');
                    setTimeout(() => { printWindow.close(); }, 1000);
                }, 1000);
            };
        }
        
//   выводим в пдф
function createPrintContent(result, numbers) {
    // Очищаем HTML-теги из текстов
    const cleanNameInterpretation = (result.interpretations.name.essence || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    const cleanSoulInterpretation = (result.interpretations.soul.essence || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    const cleanPersonalityInterpretation = (result.interpretations.personality.essence || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    const cleanKarmicInterpretation = (result.interpretations.karmic.essence || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    
    // Сильные/слабые стороны
    const strengths = (result.interpretations.name.strengths || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    const weaknesses = (result.interpretations.name.weaknesses || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    const inShadow = (result.interpretations.name.in_shadow || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    
    // Желания и страхи
    const desires = (result.interpretations.soul.desires || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    const fears = (result.interpretations.soul.fears || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    
    // Образ личности
    const image = (result.interpretations.personality.image || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    const firstImpression = (result.interpretations.personality.first_impression || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    
    // Кармические задачи
    const tasks = result.interpretations.karmic.tasks || [];
    const lesson = (result.interpretations.karmic.lesson || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    
    // Мифология и архетипы
    const mythology = (result.interpretations.name.mythology || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    const archetype = (result.interpretations.name.archetype || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    const sacred = (result.interpretations.name.sacred || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    
    // Профессии
    const professionText = (result.interpretations.name.life?.profession?.text || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    const professionExamples = (result.interpretations.name.life?.profession?.examples || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    
    // Отношения
    const relationshipsText = (result.interpretations.name.life?.relationships?.text || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    
    // Деньги
    const moneyText = (result.interpretations.name.life?.money?.text || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    
    // Здоровье
    const healthText = (result.interpretations.name.life?.health?.text || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    
    // Знаменитости
    const celebrities = (result.interpretations.name.celebrities || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    
    // Миссия
    const mission = (result.interpretations.name.mission || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    
    // Ключевые слова
    const keywords = (result.interpretations.name.keywords || '').replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
    
    // Аффирмации
    const affirmations = result.interpretations.name.affirmations || [];
    
    // Спектр
    const spectrum = result.spectrum || {};
    const spectrumCounts = spectrum.counts || {};
    
    // Подсознание
    const subconscious = result.subconscious || {};
    
    // Динамика
    const dynamics = result.dynamics || {};
    
    // Коррекции
    const corrections = result.corrections || [];
    
    // Судьба
    const destiny = result.destiny || {};
    
    // Скрытый потенциал
    const hiddenPotential = result.hidden_potential || {};
    
    // Дополнительный анализ
    const additional = result.additional || [];
    
    // Суммарное число
    const total = result.total || {};
    
    // Комбинации
    const combination = result.combination || null;
    const additionalCombinations = result.additional_combinations || [];
    
    return `
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <title>Нумерология ФИО - ${escapeHtml(result.fullname)}</title>
            <style>
                @page {
                    size: A4;
                    margin: 15mm;
                }
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.4;
                    color: #000;
                    background: #fff;
                    padding: 15mm;
                    margin: 0;
                    font-size: 12px;
                }
                .print-container { max-width: 100%; }
                h1 { text-align: center; color: #000; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; font-size: 20px; }
                h2 { color: #000; margin: 15px 0 10px 0; font-size: 16px; border-left: 4px solid #9b59b6; padding-left: 10px; }
                h3 { font-size: 14px; margin: 10px 0 5px 0; color: #333; }
                .section { margin: 15px 0; page-break-inside: avoid; }
                .section-title { background: #f0f0f0; color: #000; padding: 8px 10px; margin: 15px 0 8px 0; border-radius: 3px; border-left: 4px solid #9b59b6; font-weight: bold; }
                .date-info { display: flex; justify-content: space-around; background: #f8f9fa; padding: 10px; border-radius: 5px; margin: 15px 0; border: 1px solid #ddd; flex-wrap: wrap; }
                .date-item { text-align: center; padding: 5px 10px; }
                .date-value { font-size: 16px; font-weight: bold; color: #000; }
                .working-numbers { display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; margin: 15px 0; }
                .number-card { background: #f0f0f0; border: 1px solid #ccc; padding: 10px; border-radius: 5px; text-align: center; }
                .number-value { font-size: 18px; font-weight: bold; color: #000; }
                .matrix-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; max-width: 250px; margin: 15px auto; }
                .matrix-cell { border: 2px solid #000; aspect-ratio: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; font-weight: bold; font-size: 14px; text-align: center; }
                .quality-item { border-left: 3px solid #9b59b6; padding: 8px 10px; margin: 8px 0; background: #f8f9fa; border-radius: 0 3px 3px 0; }
                .stats-grid-print { display: flex; flex-wrap: wrap; gap: 10px; margin: 10px 0; }
                .stat-number { display: inline-block; text-align: center; width: 50px; margin: 5px; padding: 5px; background: #f0f0f0; border-radius: 5px; }
                .footer { margin-top: 25px; padding-top: 10px; border-top: 1px solid #ddd; text-align: center; font-size: 10px; color: #666; }
                .page-break { page-break-after: always; }
                ul { margin: 5px 0 5px 20px; }
                li { margin: 3px 0; }
                @media print {
                    body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
                    @page { margin: 20mm 15mm; }
                }
            </style>
        </head>
        <body>
            <div class="print-container">
                <h1>Нумерология ФИО</h1>
                
                <!-- Информация о ФИО -->
                <div class="section">
                    <div class="date-info">
                        <div class="date-item"><div class="date-value">${escapeHtml(result.famely || '')}</div><div>Фамилия</div></div>
                        <div class="date-item"><div class="date-value">${escapeHtml(result.firstname || '')}</div><div>Имя</div></div>
                        <div class="date-item"><div class="date-value">${escapeHtml(result.lastname || '')}</div><div>Отчество</div></div>
                        <div class="date-item"><div class="date-value">${escapeHtml(result.fullname || '')}</div><div>Полное имя</div></div>
                    </div>
                </div>
                
                <!-- Ключевые числа -->
                <div class="section">
                    <div class="section-title">Ключевые числа</div>
                    <div class="working-numbers">
                        <div class="number-card"><div class="number-value">${numbers.name}</div><div>Число имени</div><div style="font-size:10px;">Характер, таланты</div></div>
                        <div class="number-card"><div class="number-value">${numbers.soul}</div><div>Число души</div><div style="font-size:10px;">Желания, мотивация</div></div>
                        <div class="number-card"><div class="number-value">${numbers.personality}</div><div>Число личности</div><div style="font-size:10px;">Как видят другие</div></div>
                        <div class="number-card"><div class="number-value">${numbers.karmic}</div><div>Кармическое число</div><div style="font-size:10px;">Задачи души</div></div>
                    </div>
                </div>
                
                <!-- Нумерологический код -->
                <div class="section">
                    <div class="section-title">Нумерологический код</div>
                    <div class="matrix-grid">
                        <div class="matrix-cell"><div>${numbers.name}</div><small>Число имени</small></div>
                        <div class="matrix-cell"><div>${numbers.soul}</div><small>Число души</small></div>
                        <div class="matrix-cell"><div>${numbers.personality}</div><small>Число личности</small></div>
                        <div class="matrix-cell"><div>${numbers.karmic}</div><small>Кармическое число</small></div>
                    </div>
                </div>
                
                <!-- Усиленный архетип -->
                ${combination ? `
                <div class="section">
                    <div class="section-title">Усиленный архетип</div>
                    <div class="quality-item">
                        <strong>${escapeHtml(combination.title)}</strong><br>
                        ${escapeHtml(combination.description || '')}
                    </div>
                </div>
                ` : ''}
                
                <!-- Дополнительные совпадения -->
                ${additionalCombinations.length ? `
                <div class="section">
                    <div class="section-title">Совпадения чисел</div>
                    ${additionalCombinations.map(c => `
                        <div class="quality-item">
                            <strong>${escapeHtml(c.type)}</strong><br>
                            ${escapeHtml(c.text)}
                        </div>
                    `).join('')}
                </div>
                ` : ''}
                
                <!-- Число имени -->
                <div class="section">
                    <div class="section-title">Число имени (${numbers.name})</div>
                    <div class="quality-item">
                        <strong>${escapeHtml(result.interpretations.name.title)}</strong><br>
                        ${cleanNameInterpretation}
                    </div>
                    ${mythology ? `<div class="quality-item"><strong>🏛️ Мифология:</strong> ${mythology}</div>` : ''}
                    ${sacred ? `<div class="quality-item"><strong>✨ Сакральный смысл:</strong> ${sacred}</div>` : ''}
                    ${archetype ? `<div class="quality-item"><strong>🎭 Архетип:</strong> ${archetype}</div>` : ''}
                    ${strengths ? `<div class="quality-item"><strong>💪 Сильные стороны:</strong> ${strengths}</div>` : ''}
                    ${weaknesses ? `<div class="quality-item"><strong>⚠️ Слабые стороны:</strong> ${weaknesses}</div>` : ''}
                    ${inShadow ? `<div class="quality-item"><strong>🌑 Теневая сторона:</strong> ${inShadow}</div>` : ''}
                    ${professionText ? `<div class="quality-item"><strong>💼 Профессии:</strong> ${professionText}${professionExamples ? ' (Примеры: ' + professionExamples + ')' : ''}</div>` : ''}
                    ${relationshipsText ? `<div class="quality-item"><strong>❤️ Отношения:</strong> ${relationshipsText}</div>` : ''}
                    ${moneyText ? `<div class="quality-item"><strong>💰 Деньги:</strong> ${moneyText}</div>` : ''}
                    ${healthText ? `<div class="quality-item"><strong>🏥 Здоровье:</strong> ${healthText}</div>` : ''}
                    ${celebrities ? `<div class="quality-item"><strong>⭐ Знаменитости:</strong> ${celebrities}</div>` : ''}
                    ${mission ? `<div class="quality-item"><strong>🎯 Миссия:</strong> ${mission}</div>` : ''}
                    ${keywords ? `<div class="quality-item"><strong>🔑 Ключевые слова:</strong> ${keywords}</div>` : ''}
                    ${affirmations.length ? `<div class="quality-item"><strong>📿 Аффирмации:</strong><ul>${affirmations.map(a => `<li>${escapeHtml(a)}</li>`).join('')}</ul></div>` : ''}
                </div>
                
                <!-- Число души -->
                <div class="section">
                    <div class="section-title">Число души (${numbers.soul})</div>
                    <div class="quality-item">
                        <strong>${escapeHtml(result.interpretations.soul.title)}</strong><br>
                        ${cleanSoulInterpretation}
                    </div>
                    ${desires ? `<div class="quality-item"><strong>💭 Желания:</strong> ${desires}</div>` : ''}
                    ${fears ? `<div class="quality-item"><strong>😟 Страхи:</strong> ${fears}</div>` : ''}
                    ${result.interpretations.soul.strengths ? `<div class="quality-item"><strong>💪 Сильные стороны:</strong> ${escapeHtml(result.interpretations.soul.strengths)}</div>` : ''}
                    ${result.interpretations.soul.weaknesses ? `<div class="quality-item"><strong>⚠️ Слабые стороны:</strong> ${escapeHtml(result.interpretations.soul.weaknesses)}</div>` : ''}
                </div>
                
                <!-- Число личности -->
                <div class="section">
                    <div class="section-title">Число личности (${numbers.personality})</div>
                    <div class="quality-item">
                        <strong>${escapeHtml(result.interpretations.personality.title)}</strong><br>
                        ${cleanPersonalityInterpretation}
                    </div>
                    ${image ? `<div class="quality-item"><strong>🎭 Образ:</strong> ${image}</div>` : ''}
                    ${firstImpression ? `<div class="quality-item"><strong>👀 Первое впечатление:</strong> ${firstImpression}</div>` : ''}
                    ${result.interpretations.personality.strengths ? `<div class="quality-item"><strong>💪 Сильные стороны:</strong> ${escapeHtml(result.interpretations.personality.strengths)}</div>` : ''}
                    ${result.interpretations.personality.weaknesses ? `<div class="quality-item"><strong>⚠️ Слабые стороны:</strong> ${escapeHtml(result.interpretations.personality.weaknesses)}</div>` : ''}
                </div>
                
                <!-- Кармическое число -->
                <div class="section">
                    <div class="section-title">Кармическое число (${numbers.karmic})</div>
                    <div class="quality-item">
                        <strong>${escapeHtml(result.interpretations.karmic.title)}</strong><br>
                        ${cleanKarmicInterpretation || 'Познание себя'}
                    </div>
                    ${tasks.length ? `<div class="quality-item"><strong>📜 Задачи:</strong><ul>${tasks.map(t => `<li>${escapeHtml(t)}</li>`).join('')}</ul></div>` : ''}
                    ${lesson ? `<div class="quality-item"><strong>📖 Главный урок:</strong> ${lesson}</div>` : ''}
                </div>
                
                <!-- Общий энергетический потенциал -->
                ${total.value ? `
                <div class="section">
                    <div class="section-title">Общий энергетический потенциал</div>
                    <div class="quality-item">
                        <strong>Число ${total.value} — ${escapeHtml(total.title)}</strong><br>
                        ${escapeHtml(total.short || '')}<br>
                        ${escapeHtml(total.full || '')}
                        ${total.advice ? `<br><br><strong>💡 Совет:</strong> ${escapeHtml(total.advice)}` : ''}
                    </div>
                </div>
                ` : ''}
                
                <!-- Спектр имени -->
                ${Object.keys(spectrumCounts).length ? `
                <div class="section">
                    <div class="section-title">Спектр имени</div>
                    <div class="quality-item">
                        <div class="stats-grid-print">
                            ${[1,2,3,4,5,6,7,8,9].map(i => `
                                <div class="stat-number">
                                    <div style="font-size:20px; font-weight:bold;">${spectrumCounts[i] || 0}</div>
                                    <div style="font-size:10px;">число ${i}</div>
                                </div>
                            `).join('')}
                        </div>
                        ${spectrum.dominant_text ? `<p><strong>📊 ${escapeHtml(spectrum.dominant_text)}</strong></p>` : ''}
                        ${spectrum.missing_text ? `<p><strong>📌 ${escapeHtml(spectrum.missing_text)}</strong></p>` : ''}
                        ${spectrum.balance ? `<p>⚖️ ${escapeHtml(spectrum.balance)}</p>` : ''}
                    </div>
                </div>
                ` : ''}
                
                <!-- Число подсознания -->
                ${subconscious.number ? `
                <div class="section">
                    <div class="section-title">Число подсознания</div>
                    <div class="quality-item">
                        <strong>Число ${subconscious.number}</strong><br>
                        ${escapeHtml(subconscious.meaning || 'Доверяйте своей интуиции')}
                    </div>
                </div>
                ` : ''}
                
                <!-- Динамика имени -->
                ${dynamics.analysis && dynamics.analysis.length ? `
                <div class="section">
                    <div class="section-title">Динамика имени</div>
                    <div class="quality-item">
                        <p><strong>Последовательность чисел:</strong> ${(dynamics.sequence || []).join(' → ')}</p>
                        ${dynamics.analysis.map(item => `<p>📈 ${escapeHtml(item)}</p>`).join('')}
                    </div>
                </div>
                ` : ''}
                
                <!-- Коррекция имени -->
                ${corrections.length ? `
                <div class="section">
                    <div class="section-title">Коррекция имени</div>
                    <div class="quality-item">
                        ${corrections.map(c => `<p>✍️ ${escapeHtml(c)}</p>`).join('')}
                    </div>
                </div>
                ` : ''}
                
                <!-- Число судьбы -->
                ${destiny.number ? `
                <div class="section">
                    <div class="section-title">Число судьбы</div>
                    <div class="quality-item">
                        <strong>Число ${destiny.number}</strong><br>
                        ${escapeHtml(destiny.meaning || 'Познание себя и мира')}
                    </div>
                </div>
                ` : ''}
                
                <!-- Скрытый потенциал -->
                ${hiddenPotential.number ? `
                <div class="section">
                    <div class="section-title">Скрытый потенциал</div>
                    <div class="quality-item">
                        <strong>Число ${hiddenPotential.number}</strong><br>
                        ${escapeHtml(hiddenPotential.meaning || 'Раскройте свою уникальность')}
                    </div>
                </div>
                ` : ''}
                
                <!-- Дополнительный анализ -->
                ${additional.length ? `
                <div class="section">
                    <div class="section-title">Дополнительный анализ</div>
                    <div class="quality-item">
                        ${additional.map(item => `<p>📌 ${escapeHtml(item)}</p>`).join('')}
                    </div>
                </div>
                ` : ''}
                
                <div class="footer">
                    <p>Расчет выполнен: ${result.calculated_at}</p>
                    <p>© Нумерология ФИО | Профессиональный нумерологический анализ</p>
                </div>
            </div>
            <script>
                window.onload = function() { setTimeout(() => { window.print(); }, 500); };
                function escapeHtml(str) { if(!str) return ''; return str.replace(/[&<>]/g, function(m) { if(m === '&') return '&amp;'; if(m === '<') return '&lt;'; if(m === '>') return '&gt;'; return m; }); }
            <\/script>
        </body>
        </html>
    `;
}
//   выводим в пдф
        function escapeHtml(str) { if(!str) return ''; return str.replace(/[&<>]/g, function(m) { if(m==='&') return '&amp;'; if(m==='<') return '&lt;'; if(m==='>') return '&gt;'; return m; }); }
        
        function savePageAsHTML() {
            const btns = document.querySelector('.action-buttons');
            const origDisplay = btns ? btns.style.display : null;
            if(btns) btns.style.display = 'none';
            const html = document.documentElement.outerHTML;
            const blob = new Blob([html], {type:'text/html'});
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `нумерология_фио_${new Date().toISOString().split('T')[0]}.html`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
            if(btns && origDisplay !== null) btns.style.display = origDisplay;
        }
    </script>
    <?php unset($_SESSION['fio_result']); ?>
</body>
</html>
