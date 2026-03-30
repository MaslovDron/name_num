<?php
$errMsg='';
$name1='';
$name2='';
$ch1='';
$Sovmest=selectOne('calc', ['id'=>11]);
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
             $letterValues = [
        'а' => 1, 'б' => 2, 'в' => 3, 'г' => 4, 'д' => 5, 'е' => 6, 'ё' => 7,
        'ж' => 8, 'з' => 9, 'и' => 1, 'й' => 1, 'к' => 2, 'л' => 3, 'м' => 4,
        'н' => 5, 'о' => 6, 'п' => 7, 'р' => 8, 'с' => 9, 'т' => 2, 'у' => 3,
        'ф' => 4, 'х' => 5, 'ц' => 6, 'ч' => 7, 'ш' => 8, 'щ' => 9, 'ъ' => 1,
        'ы' => 2, 'ь' => 3, 'э' => 4, 'ю' => 5, 'я' => 6
    ];
    
    $vowels = ['а', 'е', 'ё', 'и', 'о', 'у', 'ы', 'э', 'ю', 'я'];
    $consonants = ['б', 'в', 'г', 'д', 'ж', 'з', 'й', 'к', 'л', 'м', 'н', 'п', 'р', 'с', 'т', 'ф', 'х', 'ц', 'ч', 'ш', 'щ'];
    
    // 2. Функции
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
    tt($_SESSION);
        }

}
?>
