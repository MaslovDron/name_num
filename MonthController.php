<?php
$errMsg='';
$birthDate='';
//$targetYear='';
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
            $ch1=='';
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
        
            }
}
//на фронте
?>
