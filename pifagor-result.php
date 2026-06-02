<?php
//session_start();
include 'app/include/config.php';
include 'app/include/connect.php';
include 'app/include/functions-front.php';
include 'app/controllers/PifagorController.php';

// Проверяем, есть ли результаты в сессии
if(!isset($_SESSION['pythagoras_result'])) {
    // header('Location: pifagor-form.php');
    header('Location: ' . ABS_PATH . $Pifagor['ssilka']);
    exit;
}

$result = $_SESSION['pythagoras_result'];
$matrix = $result['matrix'];

// Подготовим данные для JavaScript
$js_result = json_encode($result);
$js_matrix = json_encode($matrix);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Матрица Судьбы Пифагора - Результаты</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
     <link rel="apple-touch-icon" sizes="180x180" href="/icon/icon180.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/icon/icon32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/icon/icon16.png">
        <link rel="manifest" href="/site.webmanifest">
        <meta name="msapplication-TileColor" content="#b38b5f">
        <meta name="theme-color" content="#ffffff">
    <!-- style-->
   <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/pifagor-style.css">
   <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/all-style.css">
   <!-- style-->
</head>
<body>
    <!-- шапка -->
        <?php  
            include_once 'app/include/header-front.php';
        ?>
    <!-- шапка -->
    <div class="container">
        <!-- Заголовок -->
        <div class="header-pif">
            <h1><i class="fas fa-calculator"></i> Матрица Судьбы Пифагора</h1>
            <div class="subtitle">Детальный анализ личности по дате рождения</div>
        </div>
        
        <!-- Информация о дате рождения -->
        <div class="date-info">
            <div class="date-item">
                <div class="date-value"><?= $result['day'] ?></div>
                <div class="date-label">День рождения</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= $result['month'] ?></div>
                <div class="date-label">Месяц рождения</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= $result['year'] ?></div>
                <div class="date-label">Год рождения</div>
            </div>
            <div class="date-item">
                <div class="date-value"><?= date('d.m.Y', strtotime($result['birth_date'])) ?></div>
                <div class="date-label">Полная дата</div>
            </div>
        </div>
        
        <!-- Рабочие числа -->
        <h2 class="matrix-title"><i class="fas fa-magic"></i> Рабочие Числа</h2>
        <div class="working-numbers">
            <div class="number-card">
                <div class="number-value"><?= $result['working_numbers']['first'] ?></div>
                <div class="number-name">Первое рабочее число</div>
            </div>
            <div class="number-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="number-value"><?= $result['working_numbers']['second'] ?></div>
                <div class="number-name">Второе рабочее число</div>
            </div>
            <div class="number-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="number-value"><?= $result['working_numbers']['third'] ?></div>
                <div class="number-name">Третье рабочее число</div>
            </div>
            <div class="number-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <div class="number-value"><?= $result['working_numbers']['fourth'] ?></div>
                <div class="number-name">Четвёртое рабочее число</div>
            </div>
        </div>
            <!-- расценка -->
        <div class="actions-ps">Полный нумерологический расчет Mатрицы судьбы Пифагора вы можете заказать:</div>
        <?php
        include 'app/include/socseti.php';
        ?>
        <div class="summa0">
        <div class="summa">Стоимость услуги <?php echo $Pifagor['price'];?> рублей</div>
        </div>
            <!-- расценка -->
        <!-- Матрица Пифагора -->
        <div class="matrix-section">
            <h2 class="matrix-title"><i class="fas fa-th"></i> Психоматрица Пифагора</h2>
            <div class="matrix-grid">
                <?php
                $cellLabels = [
                    1 => 'Характер', 2 => 'Энергия', 3 => 'Интерес',
                    4 => 'Здоровье', 5 => 'Логика', 6 => 'Труд',
                    7 => 'Удача', 8 => 'Долг', 9 => 'Память'
                ];
                
                for($row = 0; $row < 3; $row++)
                    {
                    for($col = 0; $col < 3; $col++)
                        {
                        $number = $row * 3 + $col + 1;
                        $count = $matrix[$number];
                ?>
                <div class="matrix-cell">
                    <div class="cell-label"><?= $cellLabels[$number] ?></div>
                    <div class="cell-number"><?= $number ?></div>
                    <div class="cell-count"><?= $count ?></div>
                </div>
                <?php 
                        }
                    } ?>
            </div>
        </div>
        
        <!-- Основные характеристики -->
        <div class="interpretations">
            <h2 class="section-title"><i class="fas fa-chart-bar"></i> Основные Характеристики Личности</h2>
            <?php foreach($result['interpretations'] as $interpretation)
            { 
            ?>
            <div class="quality-card">
                <?= $interpretation ?>
            </div>
            <?php 
            } 
            ?>
        </div>
        
        <div class="actions-ps">Полный нумерологический расчет Mатрицы судьбы Пифагора вы можете заказать:</div>
        <?php
        include 'app/include/socseti.php';
        ?>
        <div class="summa0">
        <div class="summa">Стоимость услуги <?php echo $Pifagor['price'];?> рублей</div>
        </div> 

     
        
        <!-- Кнопки действий -->
        <div class="action-buttons">
            <a href="<?php echo ABS_PATH;?>#all-calcs" class="btn btn-primary">
            <i class="fas fa-chart-line"></i> Другие расчёты
            </a>
            <!-- <button onclick="window.print()" class="btn btn-secondary">
                <i class="fas fa-print"></i> Распечатать
            </button> -->
            <!-- <button onclick="saveAsPDF()" class="btn btn-pdf">
                <i class="fas fa-download"></i> Сохранить PDF
            </button> -->
        </div>
        
        <!-- Футер -->
        <div class="footer-pif">
            <p><i class="far fa-clock"></i> Расчет выполнен: <?= $result['calculated_at'] ?></p>
            <p>© <?= date('Y') ?> Матрица Судьбы Пифагора | Профессиональный нумерологический анализ</p>
        </div>

    </div> 
<!-- Футер -->        
<?php
include_once 'app/include/FooterAll.php';
?>
<!-- Футер -->
</body>
</html>
