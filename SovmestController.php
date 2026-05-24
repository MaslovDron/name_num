<?php
$errMsg='';
$name1='';
$name2='';
$ch1='';

$imya1='';
$imya2='';
$otchestvo1='';
$otchestvo2='';
$familia1='';
$familia2='';
$date1='';
$date2='';
$Sovmest=selectOne('calc', ['id'=>11]);
//функции для расчета
function reduceNumber($num) {
        if ($num == 11 || $num == 22 || $num == 33) return $num;
        while ($num > 9) $num = array_sum(str_split((string)$num));
        return $num;
    }
    
    function sumLetters($name, $letterValues, $filter = null) {
        $sum = 0;
        $name = mb_strtolower($name);
        for ($i = 0; $i < mb_strlen($name); $i++) {
            $char = mb_substr($name, $i, 1);
            if ($filter !== null && !in_array($char, $filter)) continue;
            if (isset($letterValues[$char])) $sum += $letterValues[$char];
        }
        return $sum;
    }

    // гигачат
    function calculateNameNumbers($name, $letterValues, $vowels, $consonants) {
    // 1. Считаем сырые суммы (без сокращения)
    $nameSum = sumLetters($name, $letterValues);
    $soulSum = sumLetters($name, $letterValues, $vowels);
    $personalitySum = sumLetters($name, $letterValues, $consonants);

    // 2. НОВОЕ: Кармическое число считаем как сумму сырых значений Имени и Души
    // Только потом сокращаем результат.
    $karmicSum = $nameSum + $soulSum; 

    return [
        'name' => reduceNumber($nameSum),
        'soul' => reduceNumber($soulSum),
        'personality' => reduceNumber($personalitySum),
        'karmic' => reduceNumber($karmicSum) // Редуцируем уже готовую сумму
    ];
}
    // гигачат   
    //гигачат
    function calculateCompatibility($numbers1, $numbers2) {
    $totalScore = 0;
    $maxScore = 0;
    $details = [];

    // Число имени (40%)
    $nameDiff = abs($numbers1['name'] - $numbers2['name']);
    // Защита от отрицательного балла: если разница слишком большая, балл станет 0, а не минус
    $nameScore = max(0, 40 - min(40, $nameDiff * 8));
    $details[] = ['criterion' => 'Число имени', 'score' => $nameScore, 'max' => 40];
    $totalScore += $nameScore;
    $maxScore += 40;

    // Число души (30%)
    $soulDiff = abs($numbers1['soul'] - $numbers2['soul']);
    $soulScore = max(0, 30 - min(30, $soulDiff * 6));
    $details[] = ['criterion' => 'Число души', 'score' => $soulScore, 'max' => 30];
    $totalScore += $soulScore;
    $maxScore += 30;

    // Число личности (20%)
    $personalityDiff = abs($numbers1['personality'] - $numbers2['personality']);
    $personalityScore = max(0, 20 - min(20, $personalityDiff * 5));
    $details[] = ['criterion' => 'Число личности', 'score' => $personalityScore, 'max' => 20];
    $totalScore += $personalityScore;
    $maxScore += 20;

    // Кармическое число (10%)
    // Используем твою логику штрафа (умножение на 3), но с защитой от минуса
    $karmicDiff = abs($numbers1['karmic'] - $numbers2['karmic']);
    // Сначала вычисляем штраф (максимум 10 баллов)
    $karmicPenalty = min(10, abs($karmicDiff * 3));
    // Вычитаем штраф из максимума, но не даем результату уйти ниже нуля
    $karmicScore = max(0, 10 - $karmicPenalty);
    
    $details[] = ['criterion' => 'Кармическое число', 'score' => $karmicScore, 'max' => 10];
    $totalScore += $karmicScore;
    $maxScore += 10;

    // Расчет итогового процента
    if ($maxScore == 0) {
        return ['percentage' => 0];
    }

    $percentage = round(($totalScore / $maxScore) * 100);

    // Определение уровня совместимости
    if ($percentage >= 85) {
        $level = 'Гармоничный союз';
    } elseif ($percentage >= 70) {
        $level = 'Хорошая совместимость';
    } elseif ($percentage >= 50) {
        $level = 'Средняя совместимость';
    } elseif ($percentage >= 30) {
        $level = 'Низкая совместимость';
    } else {
        $level = 'Сложный союз';
    }

    // Форматируем детали для красивого вывода
    return [
        'percentage' => $percentage,
        'level' => $level,
        'details' => array_map(function($item){
            // Определяем максимум для каждого критерия по его названию
            $maxValues = [
                'Число имени'     => 40,
                'Число души'      => 30,
                'Число личности'  => 20,
                'Кармическое число'=> 10,
            ];
            return sprintf('%s: %d из %d', $item['criterion'], round($item['score']), $maxValues[$item['criterion']] );
        }, $details)
    ];
}
    //гигачат
//функции для расчета
//на фронте
if($_SERVER['REQUEST_METHOD']=='POST' && isset ($_POST['SovmFr']))
{
    //tt($_POST);
    $name1 = htmlspecialchars(trim($_POST['name1'] ?? ''), ENT_QUOTES, 'UTF-8');
    $name2 = htmlspecialchars(trim($_POST['name2'] ?? ''), ENT_QUOTES, 'UTF-8');
    if (strpos($name1, ' ') !== false) 
        {
            $name_1 = explode(' ', $name1)[0];
        }
         else 
        {
            $name_1 = $name1;
        }
         if (strpos($name2, ' ') !== false) 
        {
            $name_2 = explode(' ', $name2)[0];
        }
         else 
        {
            $name_2 = $name2;
        }
    if(empty($name_1)) 
        {
            $errMsg .= 'Пожалуйста, введит первое имя<br>';
        }
     if(empty($name_2)) 
        {
            $errMsg .= 'Пожалуйста, введит второе имя<br>';
        }
    if ((mb_strlen($name_1) > 20) or (mb_strlen($name_2) > 20)) 
        {
            $errMsg .= 'Имена не должны быть длиннее 20 символов<br>';
        }
    if((!preg_match('/^[а-яёА-ЯЁ]+$/u', $name_1)) or (!preg_match('/^[а-яёА-ЯЁ]+$/u', $name_2))) 
        {
             $errMsg .= 'Имя может содержать только русские буквы<br>';
        }
    if ((mb_strlen($name_1) < 2) or (mb_strlen($name_2) < 2)) 
        {
            $errMsg .= 'Имя должно содержать минимум 2 буквы<br>';
        }
            $chdate=$_POST['consent'] ?? '';
    if($chdate=='on')
        {
            $ch1='checked';
        }
    else
        {
            $ch1=='';
        }
    if (empty($chdate)) 
        {
            $errMsg .='Дайте согласие на обработкуперсональных данных<br>';
        }
    /////////////////////////////////////////////////////////////////
    if(empty($errMsg))//если передали все данные
        {
            include 'app/include/matr-fio.php';
         //передаем расшифровку  
            //include 'app/include/sovmest-function.php';     
    // 3. Расчёт чисел для обоих имён
    $numbers1 = calculateNameNumbers($name_1, $letterValues, $vowels, $consonants);
    $numbers2 = calculateNameNumbers($name_2, $letterValues, $vowels, $consonants);
    
    // 4. Расчёт совместимости
    $compatibility = calculateCompatibility($numbers1, $numbers2);
    
    // 5. Сохраняем в сессию
    $_SESSION['compatibility_result'] = [
        'name1' => $name_1,
        'name2' => $name_2,
        'numbers1' => $numbers1,
        'numbers2' => $numbers2,
        'compatibility' => $compatibility,
        'calculated_at' => date('d.m.Y H:i:s')
    ];
    //tt($_SESSION);
    header('Location: ' . ABS_PATH . $Sovmest['ssilka_result_fr']);
    exit;

        }
}
        //на фронте
        //на бэке
        if($_SERVER['REQUEST_METHOD']=='POST' && isset ($_POST['submitSovmBack']))
{
        //tt($_POST);
        $imya1=htmlspecialchars(trim($_POST['imya1'] ?? ''), ENT_QUOTES, 'UTF-8');
        $otchestvo1=htmlspecialchars(trim($_POST['otchestvo1'] ?? ''), ENT_QUOTES, 'UTF-8');
        $familia1=htmlspecialchars(trim($_POST['familia1'] ?? ''), ENT_QUOTES, 'UTF-8');
        $imya2=htmlspecialchars(trim($_POST['imya2'] ?? ''), ENT_QUOTES, 'UTF-8');
        $otchestvo2=htmlspecialchars(trim($_POST['otchestvo2'] ?? ''), ENT_QUOTES, 'UTF-8');
        $familia2=htmlspecialchars(trim($_POST['familia2'] ?? ''), ENT_QUOTES, 'UTF-8');
        //для имени 
        if(empty($imya1) or empty($imya2)) 
        {
            $errMsg .= 'Пожалуйста, введит поля имя<br>';
        }

    if((!preg_match('/^[а-яёА-ЯЁ]+$/u', $imya1)) or (!preg_match('/^[а-яёА-ЯЁ]+$/u', $imya2))) 
        {
             $errMsg .= 'Имя может содержать только русские буквы<br>';
        }
    if ((mb_strlen($imya1) < 2) or (mb_strlen($imya2) < 2)) 
        {
            $errMsg .= 'Имя должно содержать минимум 2 буквы<br>';
        }
        //для отчества
          if(empty($otchestvo1) or empty($otchestvo2)) 
        {
            $errMsg .= 'Пожалуйста, введит поля отчества<br>';
        }

        if((!preg_match('/^[а-яёА-ЯЁ]+$/u', $otchestvo1)) or (!preg_match('/^[а-яёА-ЯЁ]+$/u', $otchestvo2))) 
            {
                $errMsg .= 'Отчество может содержать только русские буквы<br>';
            }
        if ((mb_strlen($otchestvo1) < 2) or (mb_strlen($otchestvo2) < 2)) 
        {
            $errMsg .= 'Отчество должны содержать минимум 2 буквы<br>';
        }
        //для фамилии
              if(empty($familia1) or empty($familia2)) 
        {
            $errMsg .= 'Пожалуйста, введит поля фамилии<br>';
        }

        if((!preg_match('/^[а-яёА-ЯЁ]+$/u', $familia1)) or (!preg_match('/^[а-яёА-ЯЁ]+$/u', $familia2))) 
            {
                $errMsg .= 'Фамилие может содержать только русские буквы<br>';
            }
        if ((mb_strlen($familia1) < 2) or (mb_strlen($familia2) < 2)) 
        {
            $errMsg .= 'Фамилии должны содержать минимум 2 буквы<br>';
        }
        /////////////////////////////////////////////////////////////////
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
}
    //на бэке
    //фио+дата
    if($_SERVER['REQUEST_METHOD']=='POST' && isset ($_POST['submitSovmDataBack']))
        {
            //tt($_POST);
        $imya1=htmlspecialchars(trim($_POST['imya1'] ?? ''), ENT_QUOTES, 'UTF-8');
        $otchestvo1=htmlspecialchars(trim($_POST['otchestvo1'] ?? ''), ENT_QUOTES, 'UTF-8');
        $familia1=htmlspecialchars(trim($_POST['familia1'] ?? ''), ENT_QUOTES, 'UTF-8');
        $date1=$_POST['date1'];
        $imya2=htmlspecialchars(trim($_POST['imya2'] ?? ''), ENT_QUOTES, 'UTF-8');
        $otchestvo2=htmlspecialchars(trim($_POST['otchestvo2'] ?? ''), ENT_QUOTES, 'UTF-8');
        $familia2=htmlspecialchars(trim($_POST['familia2'] ?? ''), ENT_QUOTES, 'UTF-8');
        $date2=$_POST['date2'];
        //для имени 
        if(empty($imya1) or empty($imya2)) 
        {
            $errMsg .= 'Пожалуйста, введит поля имя<br>';
        }

    if((!preg_match('/^[а-яёА-ЯЁ]+$/u', $imya1)) or (!preg_match('/^[а-яёА-ЯЁ]+$/u', $imya2))) 
        {
             $errMsg .= 'Имя может содержать только русские буквы<br>';
        }
    if ((mb_strlen($imya1) < 2) or (mb_strlen($imya2) < 2)) 
        {
            $errMsg .= 'Имя должно содержать минимум 2 буквы<br>';
        }
        //для отчества
          if(empty($otchestvo1) or empty($otchestvo2)) 
        {
            $errMsg .= 'Пожалуйста, введит поля отчества<br>';
        }

        if((!preg_match('/^[а-яёА-ЯЁ]+$/u', $otchestvo1)) or (!preg_match('/^[а-яёА-ЯЁ]+$/u', $otchestvo2))) 
            {
                $errMsg .= 'Отчество может содержать только русские буквы<br>';
            }
        if ((mb_strlen($otchestvo1) < 2) or (mb_strlen($otchestvo2) < 2)) 
        {
            $errMsg .= 'Отчество должны содержать минимум 2 буквы<br>';
        }
        //для фамилии
              if(empty($familia1) or empty($familia2)) 
        {
            $errMsg .= 'Пожалуйста, введит поля фамилии<br>';
        }

        if((!preg_match('/^[а-яёА-ЯЁ]+$/u', $familia1)) or (!preg_match('/^[а-яёА-ЯЁ]+$/u', $familia2))) 
            {
                $errMsg .= 'Фамилие может содержать только русские буквы<br>';
            }
        if ((mb_strlen($familia1) < 2) or (mb_strlen($familia2) < 2)) 
        {
            $errMsg .= 'Фамилии должны содержать минимум 2 буквы<br>';
        }
        if(empty($date1) or empty($date2))
            {
               $errMsg .= 'дата обязательный атрибут для заполнения<br>'; 
            }
            $date11 = DateTime::createFromFormat('Y-m-d', $date1);
            $date22 = DateTime::createFromFormat('Y-m-d', $date2);
            if (!$date11 or !$date22) {
        // $_SESSION['error'] = "Неверный формат даты. Используйте ГГГГ-ММ-ДД";
        // header('Location: pythagoras-form.php');
        // exit;
        $errMsg.='Вы некорректно ввели дату<br>';
    }
        /////////////////////////////////////////////////////////////////
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
    //$compatibility = calculateCompatibility($numbers1, $numbers2);
    $compatibility = calculateCompatibilityFioData($numbers1, $numbers2);
    
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
        @media print { @page { margin: 0.5cm; size: A4; } @top-center, @bottom-center { content: ""; } .no-print { display: none !important; } }
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
            
            <!-- 1. Итоговое число -->
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
                    <?php if(isset($interpretation['final_interpretation']['dynamic'])): ?>
                    <div class="dynamic-box">🔄 <?= $interpretation['final_interpretation']['dynamic'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- 2. Число имени -->
            <div class="criteria-card">
                <div class="criteria-title">🎭 Число имени</div>
                <div class="criteria-numbers"><span><?= $numbers1['name'] ?></span><span>→</span><span><?= $numbers2['name'] ?></span></div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['name_interpretation']['title'] ?? '' ?></strong>
                    <p><?= $interpretation['name_interpretation']['full'] ?? '' ?></p>
                    <?php if(isset($interpretation['name_interpretation']['strength'])): ?>
                    <div class="strength-weakness"><div class="strength-box">💪 <?= $interpretation['name_interpretation']['strength'] ?></div><div class="weakness-box">⚠️ <?= $interpretation['name_interpretation']['weakness'] ?></div></div>
                    <?php endif; ?>
                    <?php if(isset($interpretation['name_interpretation']['dynamic'])): ?>
                    <div class="dynamic-box">🔄 <?= $interpretation['name_interpretation']['dynamic'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- 3. Число даты рождения -->
            <div class="criteria-card">
                <div class="criteria-title">📅 Число даты рождения</div>
                <div class="criteria-numbers"><span><?= $dateNumber1 ?></span><span>→</span><span><?= $dateNumber2 ?></span></div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['date_interpretation']['title'] ?? '' ?></strong>
                    <p><?= $interpretation['date_interpretation']['full'] ?? '' ?></p>
                    <?php if(isset($interpretation['date_interpretation']['strength'])): ?>
                    <div class="strength-weakness"><div class="strength-box">💪 <?= $interpretation['date_interpretation']['strength'] ?></div><div class="weakness-box">⚠️ <?= $interpretation['date_interpretation']['weakness'] ?></div></div>
                    <?php endif; ?>
                    <?php if(isset($interpretation['date_interpretation']['dynamic'])): ?>
                    <div class="dynamic-box">🔄 <?= $interpretation['date_interpretation']['dynamic'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- 4. Число души -->
            <div class="criteria-card">
                <div class="criteria-title">💖 Число души</div>
                <div class="criteria-numbers"><span><?= $numbers1['soul'] ?></span><span>→</span><span><?= $numbers2['soul'] ?></span></div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['soul_interpretation']['title'] ?? '' ?></strong>
                    <p><?= $interpretation['soul_interpretation']['full'] ?? '' ?></p>
                    <?php if(isset($interpretation['soul_interpretation']['strength'])): ?>
                    <div class="strength-weakness"><div class="strength-box">💪 <?= $interpretation['soul_interpretation']['strength'] ?></div><div class="weakness-box">⚠️ <?= $interpretation['soul_interpretation']['weakness'] ?></div></div>
                    <?php endif; ?>
                    <?php if(isset($interpretation['soul_interpretation']['dynamic'])): ?>
                    <div class="dynamic-box">🔄 <?= $interpretation['soul_interpretation']['dynamic'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- 5. Число личности -->
            <div class="criteria-card">
                <div class="criteria-title">👤 Число личности</div>
                <div class="criteria-numbers"><span><?= $numbers1['personality'] ?></span><span>→</span><span><?= $numbers2['personality'] ?></span></div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['personality_interpretation']['title'] ?? '' ?></strong>
                    <p><?= $interpretation['personality_interpretation']['full'] ?? '' ?></p>
                    <?php if(isset($interpretation['personality_interpretation']['strength'])): ?>
                    <div class="strength-weakness"><div class="strength-box">💪 <?= $interpretation['personality_interpretation']['strength'] ?></div><div class="weakness-box">⚠️ <?= $interpretation['personality_interpretation']['weakness'] ?></div></div>
                    <?php endif; ?>
                    <?php if(isset($interpretation['personality_interpretation']['dynamic'])): ?>
                    <div class="dynamic-box">🔄 <?= $interpretation['personality_interpretation']['dynamic'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- 6. Кармическое число -->
            <div class="criteria-card">
                <div class="criteria-title">🌀 Кармическое число</div>
                <div class="criteria-numbers"><span><?= $numbers1['karmic'] ?></span><span>→</span><span><?= $numbers2['karmic'] ?></span></div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['karmic_interpretation']['title'] ?? '' ?></strong>
                    <p><?= $interpretation['karmic_interpretation']['full'] ?? '' ?></p>
                    <?php if(isset($interpretation['karmic_interpretation']['strength'])): ?>
                    <div class="strength-weakness"><div class="strength-box">💪 <?= $interpretation['karmic_interpretation']['strength'] ?></div><div class="weakness-box">⚠️ <?= $interpretation['karmic_interpretation']['weakness'] ?></div></div>
                    <?php endif; ?>
                    <?php if(isset($interpretation['karmic_interpretation']['dynamic'])): ?>
                    <div class="dynamic-box">🔄 <?= $interpretation['karmic_interpretation']['dynamic'] ?></div>
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
        
        <div class="action-buttons no-print">
            <button onclick="window.print()" class="btn btn-primary" style="background: #9b59b6;">
                <i class="fas fa-file-pdf"></i> Сохранить в PDF
            </button>
        </div>
        
        <div class="footer-pif">
            <p><i class="far fa-clock"></i> Расчёт выполнен: <?= date('d.m.Y H:i:s') ?></p>
            <p>© <?= date('Y') ?> Совместимость по ФИО и дате рождения | Нумерологический анализ</p>
        </div>
    </div>
</div>
</body>
</html>    <?php
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
}
?>
