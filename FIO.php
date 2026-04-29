    if(empty($errMsg))//если передали все данные
{
    // 1. Склеиваем полные ФИО
    $fio1 = trim($familia1 . ' ' . $imya1 . ' ' . $otchestvo1);
    $fio2 = trim($familia2 . ' ' . $imya2 . ' ' . $otchestvo2);
    
    // 2. Подключаем кодировку букв и функции расшифровки
    include '../app/include/matr-fio.php';
    include '../app/include/sovmest-function.php'; // ← подключаем расшифровки
    
    // 3. Рассчитываем числа для полного ФИО
    $numbers1 = calculateNameNumbers($fio1, $letterValues, $vowels, $consonants);
    $numbers2 = calculateNameNumbers($fio2, $letterValues, $vowels, $consonants);
    
    // 4. Рассчитываем совместимость
    $compatibility = calculateCompatibility($numbers1, $numbers2);
    
    // 5. Получаем полную расшифровку (та же функция, что и для имён!)
    $interpretation = getFullCompatibilityInterpretation($compatibility, $numbers1, $numbers2);
    
    // 6. Сохраняем результат в сессию
    $_SESSION['sovmest_fio_result'] = [
        'imya1' => $imya1,
        'imya2' => $imya2,
        'otchestvo1' => $otchestvo1,
        'otchestvo2' => $otchestvo2,
        'familia1' => $familia1,
        'familia2' => $familia2,
        'fio1' => $fio1,
        'fio2' => $fio2,
        'numbers1' => $numbers1,
        'numbers2' => $numbers2,
        'compatibility' => $compatibility,
        'interpretation' => $interpretation,
        'calculated_at' => date('d.m.Y H:i:s')
    ];
    
    // 7. Генерируем уникальное имя файла
    $order_id = time() . '_' . rand(100, 999);
    $name1_clean = preg_replace('/[^А-ЯЁа-яё]/iu', '_', mb_strtolower($imya1));
    $name2_clean = preg_replace('/[^А-ЯЁа-яё]/iu', '_', mb_strtolower($imya2));
    $filename = "sovmest_fio_{$order_id}_{$name1_clean}_{$name2_clean}.html";
    
    // 8. Папка для сохранения
    $save_dir ="../results/";
    if (!is_dir($save_dir)) {
        mkdir($save_dir, 0777, true);
    }
    $filepath = $save_dir . $filename;
    
    // 9. Буферизация и создание HTML-файла (точная копия стиля sovmest-result.php)
    ob_start();
    ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Совместимость по ФИО: <?= htmlspecialchars($imya1) ?> и <?= htmlspecialchars($imya2) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/all-style.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/sovmest.css">
    <style>
        /* @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; margin: 0 !important; }
            .container { box-shadow: none !important; padding: 20px !important; max-width: 100% !important; }
        } */
                    /* для пдф */
        @media print {
             /*убираем колонтитулы в пдф*/
         @page {
        margin: .5cm; /* Увеличиваем поля, чтобы URL не влезал */
        size: A4;
       }
       /* не выводим кнопку в пдф */
    .no-print {
        display: none !important;
    }

        /* Вариант 1: Пытаемся скрыть через пустой контент (работает не во всех браузерах) */
        @top-center {
            content: "";
        }
        
        @bottom-center {
            content: "";
        }
         .number-card {
        background: #2c1a47 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        page-break-inside: avoid;
    }
    .number-value {
        color: white !important;
        font-weight: 800 !important;
        font-size: 3em !important;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5) !important;
    }
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
        <!-- Заголовок -->
        <div class="header-pif">
            <h1><i class="fas fa-heart"></i> Совместимость по ФИО</h1>
            <div class="subtitle">Детальный анализ совместимости пары на основе полных имён</div>
        </div>
        
        <!-- Информация об ФИО -->
        <div class="date-info" style="display: flex; justify-content: center; align-items: center; gap: 20px; flex-wrap: wrap;">
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($fio1) ?></div>
                <div class="date-label">Партнёр 1</div>
            </div>
            <div style="font-size: 48px; font-weight: bold; color: #b38b5f;">+</div>
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($fio2) ?></div>
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
                <h3><?= htmlspecialchars($imya1) ?></h3>
                <div class="number-list">
                    <div class="number-item"><div class="num"><?= $numbers1['name'] ?></div><div class="label">имя</div></div>
                    <div class="number-item"><div class="num"><?= $numbers1['soul'] ?></div><div class="label">душа</div></div>
                    <div class="number-item"><div class="num"><?= $numbers1['personality'] ?></div><div class="label">личность</div></div>
                    <div class="number-item"><div class="num"><?= $numbers1['karmic'] ?></div><div class="label">карма</div></div>
                </div>
            </div>
            <div class="heart-icon"><i class="fas fa-heart"></i></div>
            <div class="number-block">
                <h3><?= htmlspecialchars($imya2) ?></h3>
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
        
        <!-- Кнопки действий -->
        <div class="action-buttons no-print">

            <button onclick="window.print()" class="btn btn-primary" style="background: #9b59b6;">
                <i class="fas fa-file-pdf"></i> Сохранить в PDF
            </button>
        </div>
        
        <!-- Футер -->
        <div class="footer-pif">
            <p><i class="far fa-clock"></i> Расчёт выполнен: <?= date('d.m.Y H:i:s') ?></p>
            <p>© <?= date('Y') ?> Совместимость по ФИО | Профессиональный нумерологический анализ</p>
        </div>
    </div>
</div>
</body>
</html>
    <?php
    $html_content = ob_get_clean();
    $_SESSION['sovmest_filename'] = $filename;
    file_put_contents($filepath, $html_content);
    
    // 10. Редирект на страницу результата
    header('Location: ' . ABS_PATH . 'supp/sovmest-result.php');
    exit;
}
