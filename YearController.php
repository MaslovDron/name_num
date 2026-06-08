<?php
$errMsg='';
$birthDate='';
$targetYear='';
$ch1='';
//функции

//функции
//на фронте
if($_SERVER['REQUEST_METHOD']=='POST' && isset ($_POST['FrYearCalc']))
{
   // tt($_POST);
    $birthDate = $_POST['birthdate'];
       if (empty($birthDate)) {
        $errMsg .='Вы не ввели дату<br>';
    }
    
    // 2. Валидация даты
    $date = DateTime::createFromFormat('Y-m-d', $birthDate);
    if (!$date) {
        $errMsg.='Вы некорректно ввели дату<br>';
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
            $errMsg .='Дайте согласие на обработкуперсональных данных<br>';
        }
        //когда прошла валидация
        if(empty($errMsg))
            {
                //подключаем расшифровку
                include 'app/include/year-front.php';
                //подключаем расшифровку
                //функции для расчета персонального года
                // Функция редукции чисел (с мастер-числами 11,22,33)
///////////////////////////////////////////////////////////////////////////////////////                
include 'app/include/pers-year-function.php';
///////////////////////////////////////////////////////////////////////////////////////

                //функции для расчета персонального года
                 $currentYear = date('Y');
        
        // Рассчитываем персональный год
        $personalYear = calculatePersonalYear($birthDate, $currentYear);
        
        // Рассчитываем ВСЕ контрольные числа
        $allNumbers = calculateAllNumbers($birthDate, $currentYear);
        
        // Сохраняем результат в сессию
      $_SESSION['year_result'] = [
    'birthdate' => $birthDate,
    'current_year' => $currentYear,
    'personal_year' => $personalYear,
    'all_numbers' => $allNumbers,
    'interpretation' => [
        'title' => getYearTitle($personalYear),
        'short_desc' => getYearShort($personalYear),
        'full_desc' => getYearFull($personalYear),
        'opportunities' => getYearOpportunities($personalYear),
        'warning' => getYearWarning($personalYear),
        'color' => getYearColor($personalYear),
        'stone' => getYearStone($personalYear),
        'number' => getYearNumber($personalYear)
    ],
    'calculated_at' => date('d.m.Y H:i:s')
];
        
        // Перенаправляем на страницу с результатом
        // $resultPage = selectOne('calc', ['id' => 12]); // ID вашего калькулятора года в БД
        // if ($resultPage && !empty($resultPage['ssilka_result_fr'])) {
        //     header('Location: ' . ABS_PATH . $resultPage['ssilka_result_fr']);
        // } else {
        //     // Запасной вариант
        //     header('Location: ' . ABS_PATH . 'personal-year-result.php');
        // }
        // exit;
        /////////////////////////////////////////////////////////////
            header('Location: ' . ABS_PATH . 'personal-year');
            exit;
        /////////////////////////////////////////////////////////////
            }
}
//на фронте
//на беке
if($_SERVER['REQUEST_METHOD']=='POST' && isset ($_POST['BackYearCalc']))
{
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
    $targetYear = trim($_POST['intgod'] ?? '');
        if (empty($targetYear)) {
        $errMsg .='Вы не ввели интересующий год<br>';
    }
    $targetYearInt = (int)$targetYear;
    $currentYearInt = (int)date('Y');
       if ($targetYearInt < $currentYearInt) {
            $errMsg .= "Интересующий год ($targetYearInt) не может быть меньше текущего года ($currentYearInt)<br>";
        }
        if(empty($errMsg))
            {
                //подключаем функции для персонального года
                include '../app/include/pers-year-function.php';
                //подключаем функции для персонального года
                //подключаем расшифровку  для персонального года
                include '../app/include/pers-year-interpr-supp.php';
                //подключаем расшифровку  для персонального года
                 // Берём год из POST (пользователь ввёл в поле intgod)
    $targetYear = $targetYearInt; // $targetYearInt уже есть из валидации
    
    // Рассчитываем персональный год
    $personalYear = calculatePersonalYear($birthDate, $targetYear);
    
    // Рассчитываем все контрольные числа
    $allNumbers = calculateAllNumbers($birthDate, $targetYear);
    
    // Получаем расшифровку для этого года
    $interpretation = getUltimateInterpretation($personalYear);
    
    // Заполняем сессию
    $_SESSION['year_report'] = [
        'birthdate' => $birthDate,
        'target_year' => $targetYear,
        'personal_year' => $personalYear,
        'all_numbers' => $allNumbers,
        'interpretation' => $interpretation,
        'generated_at' => date('d.m.Y H:i:s')
    ];
                //открываем файл с результатом
                header('Location: ' . ABS_PATH . 'supp/pers-year-result.php');
                exit;
                //открываем файл с результатом
            }

}
//на беке
?>
