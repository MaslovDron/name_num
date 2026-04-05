<?php
$errMsg='';
$name1='';
$name2='';
$ch1='';
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
    //дипсик
    /*
    function calculateNameNumbers($name, $letterValues, $vowels, $consonants) {
        $nameSum = sumLetters($name, $letterValues);
        $soulSum = sumLetters($name, $letterValues, $vowels);
        $personalitySum = sumLetters($name, $letterValues, $consonants);
        $karmicSum = reduceNumber($nameSum) + reduceNumber($soulSum);
        
        return [
            'name' => reduceNumber($nameSum),
            'soul' => reduceNumber($soulSum),
            'personality' => reduceNumber($personalitySum),
            'karmic' => reduceNumber($karmicSum)
        ];
    }
        */
    //дипсик
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
    //дипсик
    /*
    function calculateCompatibility($numbers1, $numbers2) {
        $totalScore = 0;
        $maxScore = 0;
        $details = [];
        
        // Число имени (40%)
        $nameDiff = abs($numbers1['name'] - $numbers2['name']);
        $nameScore = 40 - min(40, $nameDiff * 8);
        $details[] = ['criterion' => 'Число имени', 'score' => $nameScore, 'max' => 40];
        $totalScore += $nameScore;
        $maxScore += 40;
        
        // Число души (30%)
        $soulDiff = abs($numbers1['soul'] - $numbers2['soul']);
        $soulScore = 30 - min(30, $soulDiff * 6);
        $details[] = ['criterion' => 'Число души', 'score' => $soulScore, 'max' => 30];
        $totalScore += $soulScore;
        $maxScore += 30;
        
        // Число личности (20%)
        $personalityDiff = abs($numbers1['personality'] - $numbers2['personality']);
        $personalityScore = 20 - min(20, $personalityDiff * 5);
        $details[] = ['criterion' => 'Число личности', 'score' => $personalityScore, 'max' => 20];
        $totalScore += $personalityScore;
        $maxScore += 20;
        
        // Кармическое число (10%)
        $karmicDiff = abs($numbers1['karmic'] - $numbers2['karmic']);
        $karmicScore = 10 - min(10, $karmicDiff * 3);
        $details[] = ['criterion' => 'Кармическое число', 'score' => $karmicScore, 'max' => 10];
        $totalScore += $karmicScore;
        $maxScore += 10;
        
        $percentage = round(($totalScore / $maxScore) * 100);
        
        // Уровень совместимости
        if ($percentage >= 85) $level = 'Гармоничный союз';
        elseif ($percentage >= 70) $level = 'Хорошая совместимость';
        elseif ($percentage >= 50) $level = 'Средняя совместимость';
        elseif ($percentage >= 30) $level = 'Низкая совместимость';
        else $level = 'Сложный союз';
        
        return ['percentage' => $percentage, 'level' => $level, 'details' => $details];
    }
    */
    //дипсик
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

    if((!preg_match('/^[а-яёА-ЯЁ]+$/u', $imya1)) or (!preg_match('/^[а-яёА-ЯЁ]+$/u', $ymya2))) 
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
        
    }
}
    //на бэке
?>
