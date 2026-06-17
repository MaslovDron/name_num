<?php
include 'app/include/config.php';
include 'app/include/connect.php';
include 'app/include/functions-front.php';
// ❌ НЕ НУЖНО: include 'app/include/month-front.php';

// Проверяем, есть ли результат в сессии
if (!isset($_SESSION['month_result'])) {
    header('Location: ' . ABS_PATH . 'month-form.php');
    exit;
}

$result = $_SESSION['month_result'];
$birthdate = $result['birthdate'];
$currentYear = $result['current_year'];
$currentMonth = $result['current_month'];
$currentMonthName = $result['current_month_name'];
$personalYear = $result['personal_year'];
$personalMonth = $result['personal_month'];
$calculationDetails = $result['calculation_details'];

// 👇 БЕРЁМ РАСШИФРОВКУ ИЗ СЕССИИ (уже сохранена в контроллере)
$data = $result['interpretation'];

// Получаем данные о калькуляторе из БД
$MonthCalc = selectOne('calc', ['id' => 18]);

// Удаляем результат из сессии после прочтения
unset($_SESSION['month_result']);
tt($data);
