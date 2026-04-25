<?php
include '../app/include/config.php';
include '../app/include/connect.php';
include '../app/include/functions-adm.php';
include '../app/include/sovmest-function.php';

// Проверяем, есть ли результаты в сессии
if(!isset($_SESSION['sovmest_fio_result'])) {
    header('Location: sovmest-form-back.php');
    exit;
}
//tt($_SESSION);
$result = $_SESSION['sovmest_fio_result'];
$numbers1 = $result['numbers1'];
$numbers2 = $result['numbers2'];
$compatibility = $result['compatibility'];
$interpretation = $result['interpretation'];

// Получаем цену из базы (если есть)
$sovmest = selectOne('calc', ['id'=>11]);
$price = $sovmest['price'] ?? 399;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Совместимость по ФИО - Результаты</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/all-style.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/sovmest.css">
    <style>
        @media print {
            .action-buttons, .btn, .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; margin: 0 !important; }
            .container { box-shadow: none !important; padding: 20px !important; max-width: 100% !important; }
        }
        .link-to-file {
            background: #e8f5e9;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            word-break: break-all;
        }
    </style>
</head>
<body>
<div class="landing">
    <div class="container">
        <!-- Ссылка на сохранённый HTML (для отправки клиенту) -->
        <?php if(isset($_SESSION['sovmest_filename']) && !empty($_SESSION['sovmest_filename'])): ?>
        <div class="link-to-file no-print">
            <i class="fas fa-link"></i> <strong>Ссылка для отправки клиенту:</strong><br>
            <a href="<?= ABS_PATH ?>results/<?= $_SESSION['sovmest_filename'] ?>" target="_blank">
                <?= ABS_PATH ?>results/<?= $_SESSION['sovmest_filename'] ?>
            </a>
        </div>
        <?php endif; ?>
        
        <!-- Заголовок -->
        <div class="header-pif">
            <h1><i class="fas fa-heart"></i> Совместимость по ФИО</h1>
            <div class="subtitle">Детальный анализ совместимости пары на основе полных имён</div>
        </div>
        
        <!-- Информация об ФИО -->
        <div class="date-info" style="display: flex; justify-content: center; align-items: center; gap: 20px; flex-wrap: wrap;">
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($result['fio1']) ?></div>
                <div class="date-label">Партнёр 1</div>
            </div>
            <div style="font-size: 48px; font-weight: bold; color: #b38b5f;">+</div>
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($result['fio2']) ?></div>
                <div class="date-label">Партнёр 2</div>
            </div>
        </div>
        
        <!-- Процент совместимости -->
        <div class="compatibility-score">
            <div class="score-circle">
                <div class="score-value"><?= $interpretation['percentage'] ?>%</div>
                <div class="score-label">совместимости</div>
            </div>
        </div>
        
        <!-- Ключевые числа пары -->
        <h2 class="matrix-title"><i class="fas fa-magic"></i> Ключевые числа</h2>
        <div class="pair-numbers">
            <div class="number-block">
                <h3><?= htmlspecialchars($result['imya1']) ?></h3>
                <div class="number-list">
                    <div class="number-item"><div class="num"><?= $numbers1['name'] ?></div><div class="label">имя</div></div>
                    <div class="number-item"><div class="num"><?= $numbers1['soul'] ?></div><div class="label">душа</div></div>
                    <div class="number-item"><div class="num"><?= $numbers1['personality'] ?></div><div class="label">личность</div></div>
                    <div class="number-item"><div class="num"><?= $numbers1['karmic'] ?></div><div class="label">карма</div></div>
                </div>
            </div>
            <div class="heart-icon"><i class="fas fa-heart"></i></div>
            <div class="number-block">
                <h3><?= htmlspecialchars($result['imya2']) ?></h3>
                <div class="number-list">
                    <div class="number-item"><div class="num"><?= $numbers2['name'] ?></div><div class="label">имя</div></div>
                    <div class="number-item"><div class="num"><?= $numbers2['soul'] ?></div><div class="label">душа</div></div>
                    <div class="number-item"><div class="num"><?= $numbers2['personality'] ?></div><div class="label">личность</div></div>
                    <div class="number-item"><div class="num"><?= $numbers2['karmic'] ?></div><div class="label">карма</div></div>
                </div>
            </div>
        </div>
        
        <!-- Детальный разбор по критериям -->
        <h2 class="matrix-title"><i class="fas fa-chart-bar"></i> Детальный разбор</h2>
        <div class="criteria-grid">
            <div class="criteria-card">
                <div class="criteria-title">🎭 Число имени</div>
                <div class="criteria-numbers"><span><?= $numbers1['name'] ?></span><span>→</span><span><?= $numbers2['name'] ?></span></div>
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
            <div class="criteria-card">
                <div class="criteria-title">💖 Число души</div>
                <div class="criteria-numbers"><span><?= $numbers1['soul'] ?></span><span>→</span><span><?= $numbers2['soul'] ?></span></div>
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
            <div class="criteria-card">
                <div class="criteria-title">👤 Число личности</div>
                <div class="criteria-numbers"><span><?= $numbers1['personality'] ?></span><span>→</span><span><?= $numbers2['personality'] ?></span></div>
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
            <div class="criteria-card">
                <div class="criteria-title">🌀 Кармическое число</div>
                <div class="criteria-numbers"><span><?= $numbers1['karmic'] ?></span><span>→</span><span><?= $numbers2['karmic'] ?></span></div>
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
        
        <!-- Совет по укреплению союза -->
        <?php if($interpretation['percentage'] < 70 && !empty($interpretation['strengthening_advice'])): ?>
        <div class="advice-block">
            <h2><i class="fas fa-tools"></i> Как укрепить ваш союз?</h2>
            <ul class="strengthening-list">
                <?php foreach($interpretation['strengthening_advice'] as $advice): ?>
                <li><i class="fas fa-heart" style="color: #b38b5f;"></i> <span><?= $advice ?></span></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
        
        <!-- Общая рекомендация -->
        <div class="quality-card">
            <div class="quality-title">💫 Общая рекомендация</div>
            <div class="quality-text"><?= $interpretation['general_advice'] ?></div>
        </div>
        
        <div class="quality-card">
            <div class="quality-title">✨ Общая оценка</div>
            <div class="quality-text"><?= $interpretation['short_description'] ?></div>
        </div>
        
        <div class="quality-card">
            <div class="quality-title">📖 Подробный разбор</div>
            <div class="quality-text"><?= $interpretation['full_description'] ?></div>
        </div>
        
        <!-- Призыв к полному анализу -->
        <div class="actions-ps">Хотите более глубокий анализ по дате рождения?</div>
        <div class="summa0">
            <div class="summa">Стоимость полного анализа — <?= $price ?> рублей</div>
        </div>
        
        <!-- Кнопки действий -->
        <div class="action-buttons no-print">
            <a href="sovmest-form-back.php" class="btn btn-primary">
                <i class="fas fa-redo"></i> Новый расчёт
            </a>
            <button onclick="window.print()" class="btn btn-primary" style="background: #9b59b6;">
                <i class="fas fa-file-pdf"></i> Сохранить в PDF
            </button>
        </div>
        
        <!-- Футер -->
        <div class="footer-pif">
            <p><i class="far fa-clock"></i> Расчёт выполнен: <?= $result['calculated_at'] ?></p>
            <p>© <?= date('Y') ?> Совместимость по ФИО | Профессиональный нумерологический анализ</p>
        </div>
    </div>
</div>

<?php 
// Очищаем сессию после показа
unset($_SESSION['sovmest_fio_result']);
unset($_SESSION['sovmest_filename']);
?>
</body>
</html>
