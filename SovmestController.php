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
    if(empty($errMsg))//если передали все данные
        {
        }

}
