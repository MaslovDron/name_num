//обработка вывода результата по фио и дате
if(empty($errMsg))
{
    // 1. Подключаем необходимые файлы (если еще не подключены)
    include '../app/include/matr-fio.php';
    include '../app/include/sovmest-function.php';
    
    // 2. Функция для расчета числа по дате рождения
    function calculateDateNumber($date) {
        // Удаляем все символы, кроме цифр
        $cleanDate = preg_replace('/[^0-9]/', '', $date);
        if (strlen($cleanDate) != 8) return 0;
        
        $sum = array_sum(str_split($cleanDate));
        // Редукция с учетом мастер-чисел 11,22,33
        if ($sum == 11 || $sum == 22 || $sum == 33) return $sum;
        while ($sum > 9) {
            $sum = array_sum(str_split($sum));
        }
        return $sum;
    }
    
    // 3. Склеиваем полные ФИО
    $fio1 = trim($familia1 . $imya1 . $otchestvo1);
    $fio2 = trim($familia2 . $imya2 . $otchestvo2);

    $fio_disp1 = trim($familia1.' '. $imya1 .' '. $otchestvo1);
    $fio_disp2 = trim($familia2 .' '.$imya2 .' '. $otchestvo2);
    
    // 4. Рассчитываем числа для ФИО (используем существующую функцию!)
    $numbers1 = calculateNameNumbers($fio1, $letterValues, $vowels, $consonants);
    $numbers2 = calculateNameNumbers($fio2, $letterValues, $vowels, $consonants);
    
    // 5. Рассчитываем числа по датам рождения
    $dateNumber1 = calculateDateNumber($date1);
    $dateNumber2 = calculateDateNumber($date2);
    
    // 6. КОРРЕКТИРУЕМ числа партнеров с учетом даты
    // Суммируем число ФИО и число даты, редуцируем
    $totalNameDate1 = $numbers1['name'] + $dateNumber1;
    $totalNameDate2 = $numbers2['name'] + $dateNumber2;
    
    // Редукция итоговых чисел (с учетом мастер-чисел)
    $finalNumber1 = $totalNameDate1;
    if ($finalNumber1 != 11 && $finalNumber1 != 22 && $finalNumber1 != 33) {
        while ($finalNumber1 > 9) {
            $finalNumber1 = array_sum(str_split($finalNumber1));
        }
    }
    
    $finalNumber2 = $totalNameDate2;
    if ($finalNumber2 != 11 && $finalNumber2 != 22 && $finalNumber2 != 33) {
        while ($finalNumber2 > 9) {
            $finalNumber2 = array_sum(str_split($finalNumber2));
        }
    }
    
    // 7. ========== ГЛАВНОЕ: ДОБАВЛЯЕМ ВСЕ НУЖНЫЕ ПОЛЯ В МАССИВ numbers ==========
    // Добавляем число даты
    $numbers1['date'] = $dateNumber1;
    $numbers2['date'] = $dateNumber2;
    
    // Добавляем итоговое число (ФИО + дата)
    $numbers1['name_with_date'] = $finalNumber1;
    $numbers2['name_with_date'] = $finalNumber2;
    // ========== КОНЕЦ ДОБАВЛЕНИЯ ==========
    
    // 8. Рассчитываем совместимость (используем существующую функцию!)
    $compatibility = calculateCompatibility($numbers1, $numbers2);
    
    // 9. Получаем полную расшифровку (теперь в ней будут и date_interpretation, и final_interpretation)
    $interpretation = getFullCompatibilityInterpretation($compatibility, $numbers1, $numbers2);
    
    // 10. Сохраняем результат в сессию
    $_SESSION['sovmest_fio_data_result'] = [
        'imya1' => $imya1,
        'imya2' => $imya2,
        'otchestvo1' => $otchestvo1,
        'otchestvo2' => $otchestvo2,
        'familia1' => $familia1,
        'familia2' => $familia2,
        'date1' => $date1,
        'date2' => $date2,
        'fio1' => $fio1,
        'fio2' => $fio2,
        'fio_disp1'=>$fio_disp1,
        'fio_disp2'=>$fio_disp2,
        'date_number1' => $dateNumber1,
        'date_number2' => $dateNumber2,
        'final_number1' => $finalNumber1,
        'final_number2' => $finalNumber2,
        'numbers1' => $numbers1,  // ← теперь здесь есть 'date' и 'name_with_date'
        'numbers2' => $numbers2,  // ← теперь здесь есть 'date' и 'name_with_date'
        'compatibility' => $compatibility,
        'interpretation' => $interpretation,
        'calculated_at' => date('d.m.Y H:i:s')
    ];
    //формируем html документ
    // 10. Сохраняем в сессию (для текущего показа)
   // $_SESSION['sovmest_fio_data_result'] = $resultData;
    
    // ========== НОВЫЙ БЛОК: СОЗДАЁМ HTML-ФАЙЛ ==========
 $order_id = time() . '_' . rand(100, 999);
        $name1_clean = preg_replace('/[^А-ЯЁа-яё]/iu', '_', mb_strtolower($imya1));
        $name2_clean = preg_replace('/[^А-ЯЁа-яё]/iu', '_', mb_strtolower($imya2));
        $filename = "sovmest_fio_data_{$order_id}_{$name1_clean}_{$name2_clean}.html";
        
        $save_dir = "../results/";
        if (!is_dir($save_dir)) {
            mkdir($save_dir, 0777, true);
        }
        $filepath = $save_dir . $filename;
        $file_url = ABS_PATH . "results/" . $filename;
        
        // Добавляем поля в сессию (не перезаписывая)
        $_SESSION['sovmest_fio_data_result']['saved_filename'] = $filename;
        $_SESSION['sovmest_fio_data_result']['saved_file_url'] = $file_url;
            
    // Генерируем HTML-контент (используем буферизацию)
    ob_start();
    ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Совместимость по ФИО и дате рождения: <?= htmlspecialchars($imya1) ?> и <?= htmlspecialchars($imya2) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/all-style.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/sovmest.css">
    <style>
        .date-badge { background: #f0e6d2; padding: 5px 15px; border-radius: 30px; font-size: 14px; margin-top: 8px; display: inline-block; color: #5a3a2a; }
        .final-number-block { background: linear-gradient(135deg, #b38b5f, #8b5a2b); border-radius: 20px; padding: 12px; text-align: center; min-width: 80px; }
        .final-number-block .num { font-size: 2em; font-weight: bold; color: white; }
        .final-number-block .label { font-size: 11px; color: rgba(255,255,255,0.8); }
        .number-item.date-item { background: #e8e0d0; }
        .strength-weakness { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 12px; }
        .strength-box { background: #d4edda; border-left: 4px solid #28a745; padding: 8px 12px; border-radius: 8px; flex: 1; font-size: 13px; }
        .weakness-box { background: #f8d7da; border-left: 4px solid #dc3545; padding: 8px 12px; border-radius: 8px; flex: 1; font-size: 13px; }
        .dynamic-box { background: #e2e3e5; border-left: 4px solid #6c757d; padding: 8px 12px; border-radius: 8px; margin-top: 10px; font-size: 13px; }
        @media print { @page { margin: 0.5cm; size: A4; } @top-center, @bottom-center { content: ""; } 
        .no-print { display: none !important; } }
    </style>
</head>
<body>
<div class="landing">
    <div class="container">
        
        <div class="header-pif">
            <h1><i class="fas fa-heart"></i> Совместимость по ФИО и дате рождения</h1>
            <div class="subtitle">Детальный анализ на основе полных имён и дат рождения</div>
        </div>
        
        <div class="date-info" style="display: flex; justify-content: center; align-items: center; gap: 30px; flex-wrap: wrap;">
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($fio_disp1) ?></div>
                <div class="date-label">Партнёр 1</div>
                <div class="date-badge"><i class="fas fa-calendar-alt"></i> <?= htmlspecialchars($date1) ?></div>
            </div>
            <div style="font-size: 48px; font-weight: bold; color: #b38b5f;">+</div>
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($fio_disp2) ?></div>
                <div class="date-label">Партнёр 2</div>
                <div class="date-badge"><i class="fas fa-calendar-alt"></i> <?= htmlspecialchars($date2) ?></div>
            </div>
        </div>
        
        <div class="compatibility-score">
            <div class="score-circle">
                <div class="score-value"><?= $interpretation['percentage'] ?>%</div>
                <div class="score-label">совместимости</div>
            </div>
        </div>
        
        <h2 class="matrix-title"><i class="fas fa-magic"></i> Ключевые числа</h2>
        <div class="pair-numbers">
            <div class="number-block">
                <h3><?= htmlspecialchars($imya1) ?></h3>
                <div class="number-list">
                    <div class="number-item final-number-block"><div class="num"><?= $finalNumber1 ?></div><div class="label">итоговое</div></div>
                    <div class="number-item"><div class="num"><?= $numbers1['name'] ?></div><div class="label">имя</div></div>
                    <div class="number-item date-item"><div class="num"><?= $dateNumber1 ?></div><div class="label">дата</div></div>
                    <div class="number-item"><div class="num"><?= $numbers1['soul'] ?></div><div class="label">душа</div></div>
                    <div class="number-item"><div class="num"><?= $numbers1['personality'] ?></div><div class="label">личность</div></div>
                    <div class="number-item"><div class="num"><?= $numbers1['karmic'] ?></div><div class="label">карма</div></div>
                </div>
            </div>
            <div class="heart-icon"><i class="fas fa-heart"></i></div>
            <div class="number-block">
                <h3><?= htmlspecialchars($imya2) ?></h3>
                <div class="number-list">
                    <div class="number-item final-number-block"><div class="num"><?= $finalNumber2 ?></div><div class="label">итоговое</div></div>
                    <div class="number-item"><div class="num"><?= $numbers2['name'] ?></div><div class="label">имя</div></div>
                    <div class="number-item date-item"><div class="num"><?= $dateNumber2 ?></div><div class="label">дата</div></div>
                    <div class="number-item"><div class="num"><?= $numbers2['soul'] ?></div><div class="label">душа</div></div>
                    <div class="number-item"><div class="num"><?= $numbers2['personality'] ?></div><div class="label">личность</div></div>
                    <div class="number-item"><div class="num"><?= $numbers2['karmic'] ?></div><div class="label">карма</div></div>
                </div>
            </div>
        </div>
        
        <h2 class="matrix-title"><i class="fas fa-chart-bar"></i> Детальный разбор</h2>
        <div class="criteria-grid">
            <div class="criteria-card">
                <div class="criteria-title">⭐ Итоговое число (ФИО + дата)</div>
                <div class="criteria-numbers"><span><?= $finalNumber1 ?></span><span>→</span><span><?= $finalNumber2 ?></span></div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['final_interpretation']['title'] ?? 'Главная вибрация союза' ?></strong>
                    <p><?= $interpretation['final_interpretation']['full'] ?? '' ?></p>
                    <p><strong>Число ФИО:</strong> <?= $numbers1['name'] ?> и <?= $numbers2['name'] ?> | <strong>Число даты:</strong> <?= $dateNumber1 ?> и <?= $dateNumber2 ?></p>
                    <?php if(isset($interpretation['final_interpretation']['strength'])): ?>
                    <div class="strength-weakness"><div class="strength-box">💪 <?= $interpretation['final_interpretation']['strength'] ?></div><div class="weakness-box">⚠️ <?= $interpretation['final_interpretation']['weakness'] ?></div></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="criteria-card">
                <div class="criteria-title">🎭 Число имени</div>
                <div class="criteria-numbers"><span><?= $numbers1['name'] ?></span><span>→</span><span><?= $numbers2['name'] ?></span></div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['name_interpretation']['title'] ?? '' ?></strong>
                    <p><?= $interpretation['name_interpretation']['full'] ?? '' ?></p>
                    <?php if(isset($interpretation['name_interpretation']['strength'])): ?>
                    <div class="strength-weakness"><div class="strength-box">💪 <?= $interpretation['name_interpretation']['strength'] ?></div><div class="weakness-box">⚠️ <?= $interpretation['name_interpretation']['weakness'] ?></div></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="criteria-card">
                <div class="criteria-title">📅 Число даты рождения</div>
                <div class="criteria-numbers"><span><?= $dateNumber1 ?></span><span>→</span><span><?= $dateNumber2 ?></span></div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['date_interpretation']['title'] ?? '' ?></strong>
                    <p><?= $interpretation['date_interpretation']['full'] ?? '' ?></p>
                    <?php if(isset($interpretation['date_interpretation']['strength'])): ?>
                    <div class="strength-weakness"><div class="strength-box">💪 <?= $interpretation['date_interpretation']['strength'] ?></div><div class="weakness-box">⚠️ <?= $interpretation['date_interpretation']['weakness'] ?></div></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="criteria-card">
                <div class="criteria-title">💖 Число души</div>
                <div class="criteria-numbers"><span><?= $numbers1['soul'] ?></span><span>→</span><span><?= $numbers2['soul'] ?></span></div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['soul_interpretation']['title'] ?? '' ?></strong>
                    <p><?= $interpretation['soul_interpretation']['full'] ?? '' ?></p>
                    <?php if(isset($interpretation['soul_interpretation']['strength'])): ?>
                    <div class="strength-weakness"><div class="strength-box">💪 <?= $interpretation['soul_interpretation']['strength'] ?></div><div class="weakness-box">⚠️ <?= $interpretation['soul_interpretation']['weakness'] ?></div></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="criteria-card">
                <div class="criteria-title">👤 Число личности</div>
                <div class="criteria-numbers"><span><?= $numbers1['personality'] ?></span><span>→</span><span><?= $numbers2['personality'] ?></span></div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['personality_interpretation']['title'] ?? '' ?></strong>
                    <p><?= $interpretation['personality_interpretation']['full'] ?? '' ?></p>
                    <?php if(isset($interpretation['personality_interpretation']['strength'])): ?>
                    <div class="strength-weakness"><div class="strength-box">💪 <?= $interpretation['personality_interpretation']['strength'] ?></div><div class="weakness-box">⚠️ <?= $interpretation['personality_interpretation']['weakness'] ?></div></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="criteria-card">
                <div class="criteria-title">🌀 Кармическое число</div>
                <div class="criteria-numbers"><span><?= $numbers1['karmic'] ?></span><span>→</span><span><?= $numbers2['karmic'] ?></span></div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['karmic_interpretation']['title'] ?? '' ?></strong>
                    <p><?= $interpretation['karmic_interpretation']['full'] ?? '' ?></p>
                    <?php if(isset($interpretation['karmic_interpretation']['strength'])): ?>
                    <div class="strength-weakness"><div class="strength-box">💪 <?= $interpretation['karmic_interpretation']['strength'] ?></div><div class="weakness-box">⚠️ <?= $interpretation['karmic_interpretation']['weakness'] ?></div></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <?php if(!empty($interpretation['strengthening_advice'])): ?>
        <div class="advice-block">
            <h2><i class="fas fa-tools"></i> Как укрепить ваш союз?</h2>
            <ul><?php foreach($interpretation['strengthening_advice'] as $advice): ?><li><i class="fas fa-heart"></i> <?= $advice ?></li><?php endforeach; ?></ul>
        </div>
        <?php endif; ?>
        
        <div class="quality-card"><div class="quality-title">💫 Общая рекомендация</div><div class="quality-text"><?= $interpretation['general_advice'] ?></div></div>
        <div class="quality-card"><div class="quality-title">✨ Общая оценка</div><div class="quality-text"><?= $interpretation['short_description'] ?></div></div>
        <div class="quality-card"><div class="quality-title">📖 Подробный разбор</div><div class="quality-text"><?= $interpretation['full_description'] ?></div></div>
        <!--вывод в пдф -->
           <div class="action-buttons no-print">
            <button onclick="window.print()" class="btn btn-primary" style="background: #9b59b6;">
                <i class="fas fa-file-pdf"></i> Сохранить в PDF
            </button>
        </div>
        <!--вывод в пдф -->
        <div class="footer-pif">
            <p><i class="far fa-clock"></i> Расчёт выполнен: <?= date('d.m.Y H:i:s') ?></p>
           <p>© <?= date('Y') ?> Совместимость по ФИО и дате рождения | Нумерологический анализ</p>
        </div>
    </div>
</div>
</body>
</html>
    <?php
    //передаем в сессии имя файла
    $_SESSION['sovmest_fio_data_result']['filename'] = $filename;
    $html_content = ob_get_clean();
    file_put_contents($filepath, $html_content);

    //формируем html документ
    
    // 11. Перенаправляем на страницу результата
    header('Location: sovmest-fio-data-result.php');
    exit;
}
//обработка вывода результата по фио и дате
