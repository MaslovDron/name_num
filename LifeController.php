<?php
$errMsg='';
$birthDate='';
$targetMonth='';
$ch1='';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['FrLifeChart'])) {
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
}
?>
