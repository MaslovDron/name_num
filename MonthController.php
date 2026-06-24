<?php
$errMsg='';
$birthDate='';
$targetMonth='';
$ch1='';
//на фронте
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['FrMonthCalc'])) {
    //echo '1111';
    // tt($_POST);
        $birthDate = $_POST['birthdate'];
       if (empty($birthDate)) {
        $errMsg .='Вы не ввели дату рождения<br>';
    }
    
    // 2. Валидация даты
    $date = DateTime::createFromFormat('Y-m-d', $birthDate);
    if (!$date) {
        $errMsg.='Вы некорректно ввели дату рождения<br>';
    } 
    $chdate=$_POST['consent'];
    if($chdate=='on')
        {
            $ch1='checked';
        }
    else
        {
            $ch1='';
        }
    if (empty($chdate)) 
        {
            $errMsg .='Дайте согласие на обработку персональных данных<br>';
        }
        //валидация пройдена
        if(empty($errMsg))
            {
                //подключаем расшифровку
                include 'app/include/month-front.php';
                //подключаем расшифровку
                //подключаем функции для месяца
                include 'app/include/month-function.php';
                //подключаем функции для месяца

            // Разбираем дату рождения
        $birthDateObj = new DateTime($birthDate);
        $day = (int)$birthDateObj->format('d');
        $month = (int)$birthDateObj->format('m');  
        // Текущий месяц и год (можно будет заменить на выбранные позже)
        $currentMonth = (int)date('n');  // 1..12
        $currentYear = (int)date('Y');

        $result = calculatePersonalMonth($day, $month, $currentMonth, $currentYear);
        $personalMonth = $result['personal_month'];
        // Получаем расшифровку ДО сохранения в сессию
        $interpretation = getMonthInterpretation($personalMonth);
                
        $_SESSION['month_result'] = [
            'birthdate' => $birthDate,
            'current_year' => $currentYear,
            'current_month' => $currentMonth,
            'current_month_name' => getRussianMonthName($currentMonth),
            'personal_year' => $result['personal_year'],
            'personal_month' => $result['personal_month'],
            'calculation_details' => [
                'day_raw' => $day,
                'month_raw' => $month,
                'day_reduced' => $result['details']['day_reduced'],
                'month_reduced' => $result['details']['month_reduced'],
                'year_reduced' => $result['details']['year_reduced'],
                'personal_year_raw' => $result['details']['personal_year_raw'],
                'personal_month_raw' => $result['details']['personal_month_raw']
            ],
            // 👇 СОХРАНЯЕМ РАСШИФРОВКУ
            'interpretation' => $interpretation
        ];
        
        header('Location: ' . ABS_PATH . 'personal-month');
        exit;
            }
}
//на фронте
//на бэке
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['BackMonthCalc'])) {
    //tt($_POST);
     $birthDate = $_POST['daterozd'];
       if (empty($birthDate)) {
        $errMsg .='Вы не ввели дату рождения<br>';
    }
        // 2. Валидация даты
    $date = DateTime::createFromFormat('Y-m-d', $birthDate);
    if (!$date) {
        $errMsg.='Вы некорректно ввели дату<br>';
    }
      $targetMonth = trim($_POST['intMon'] ?? '');
        if (empty($$targetMonth)) {
        $errMsg .='Вы не ввели интересующий год<br>';
    }
    $targetMonInt = (int)$targetMonth;
    $currentYearInt = (int)date('Y');
       if ($targetMonInt < $currentYearInt) {
            $errMsg .= "Интересующий год ($targetMonInt) не может быть меньше текущего года ($currentYearInt)<br>";
        }
        //1111
        if(empty($errMsg))
            {
                //
            }
        //1111
}
//на бэке
?>
