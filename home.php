<?php
include 'app/include/config.php';
include 'app/include/connect.php';
include 'app/include/functions-front.php';
//include 'app/controllers/BlogController.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нумерологический портал · Расчёт судьбы</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- font awesome cdn link  -->
   <!-- style-->
   <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/home.css">
   <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/all-style.css">
   <!-- style-->
</head>
<body>
<div class="wrapper">
        <div class="hero">
            <h1>🔮 Нумерология<br>цифры вашей судьбы</h1>
            <div class="subhead">
                Пифагор, именные коды, совместимость.<br>
                Профессиональные расчёты с глубокой трактовкой.
            </div>
        </div>

        <h2 style="font-size: 32px; font-weight: 300; margin-bottom: 20px; color: #4e3b2e;">
            ✦ Выберите расчёт
        </h2>

        <div class="grid-cards" id="all-calcs">
            <!-- Карточка 1: Квадрат Пифагора -->
            <a href="<?php echo ABS_PATH?>pifagor-form" class="calc-card">
                <div class="card-icon">⬛</div>
                <h3>Квадрат Пифагора</h3>
                <p>Психоматрица: характер, таланты, кармические задачи, совместимость. Базовый разбор личности.</p>
                <span class="badge">9 энергий</span>
            </a>
            <!-- Карточка 2: Матрица судьбы -->
            <a href="<?php echo ABS_PATH?>pifagor-form" class="calc-card">
                <div class="card-icon">✡️</div>
                <h3>Матрица судьбы</h3>
                <p>22 аркана. Предназначение, деньги, отношения, детско-родительская карма, таланты.</p>
                <span class="badge">арканы Таро</span>
            </a>
            <!-- Карточка 3: Именная нумерология -->
            <a href="<?php echo ABS_PATH?>pifagor-form" class="calc-card">
                <div class="card-icon">🕯️</div>
                <h3>Код имени</h3>
                <p>Число души, экспрессии, личности, зрелости. Ваше полное имя как формула судьбы.</p>
                <span class="badge">глубокий портрет</span>
            </a>
            <!-- Карточка 4: Совместимость -->
            <a href="calc-templates/compatibility.php" class="calc-card">
                <div class="card-icon">🤝</div>
                <h3>Совместимость</h3>
                <p>Анализ пары по датам рождения. Любовь, брак, кармические связи, конфликты.</p>
                <span class="badge">парный расчёт</span>
            </a>
        </div>

        <div style="background: #f5efe8; padding: 45px; border-radius: 40px; margin-top: 50px;">
            <h3 style="font-size: 28px; font-weight: 400; margin-bottom: 15px; color: #4e3e31;">
                ⚡ Почему наши расчёты точнее?
            </h3>
            <p style="font-size: 18px; color: #5b4d40;">
                Мы используем классические школы (Пифагор, каббала, Ладини) без «усреднённых» алгоритмов. 
                Каждый калькулятор выдаёт не просто число, а развёрнутый психологический портрет. 
                Никакой воды — только суть.
            </p>
        </div>

        <div class="footer-pif">
            <p>© Нумерологический портал · Цифры не лгут</p>
</div>
    </div>
       <!-- Футер -->        
<?php
include_once 'app/include/FooterAll.php';
?>
<!-- Футер -->
</body>
</html>
