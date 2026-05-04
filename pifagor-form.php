<?php
include 'app/include/config.php';
include 'app/include/connect.php';
include 'app/include/functions-front.php';
include 'app/controllers/PifagorController.php';
?>
 <!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">

    <!-- 1. ОСНОВНЫЕ МЕТА-ТЕГИ ДЛЯ ПОИСКА -->
    <title>Квадрат Пифагора: расчет по дате рождения онлайн | Расшифровка психоматрицы</title>
    <meta name="description" content="Бесплатный расчет Квадрата Пифагора (психоматрицы) по дате рождения. Детальная расшифровка 9 ячеек: характер, энергия, здоровье, удача, долг, память и совместимость. Узнайте свой код судьбы!">
    <link rel="canonical" href="https://калькулятор-судьбы.рф/pifagor-form" />

    <!-- 2. OPEN GRAPH ДЛЯ СОЦСЕТЕЙ (ВК, ТГ, ОК) -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://калькулятор-судьбы.рф/pifagor-form">
    <meta property="og:title" content="Квадрат Пифагора: расчет по дате рождения онлайн | Расшифровка психоматрицы">
    <meta property="og:description" content="Бесплатный расчет психоматрицы по дате рождения. Узнайте свой характер, таланты, энергию, здоровье и совместимость. Полная расшифровка 9 ячеек.">
    <meta property="og:image" content="https://калькулятор-судьбы.рф/img-calc/pifagor.jpg">
    <meta property="og:site_name" content="Калькулятор Судьбы">

    <!-- 3. СТРУКТУРИРОВАННЫЕ ДАННЫЕ ДЛЯ ПОИСКОВИКОВ (SCHEMA.ORG) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Квадрат Пифагора: расчет по дате рождения",
      "description": "Бесплатный онлайн расчет психоматрицы по дате рождения. Расшифровка характера, энергии, здоровья, удачи, долга и памяти.",
      "url": "https://калькулятор-судьбы.рф/pifagor-form",
      "mainEntity": {
        "@type": "SoftwareApplication",
        "name": "Калькулятор Квадрата Пифагора",
        "applicationCategory": "Lifestyle",
        "operatingSystem": "All",
        "offers": {
          "@type": "Offer",
          "price": "0",
          "priceCurrency": "RUB"
        }
      }
    }
    </script>

    <!-- Ваши стили (оставляем как есть) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/pifagor-form.css">
    <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/all-style.css">
</head>
<body>
    <!-- шапка -->
        <?php  
            include_once 'app/include/header-front.php';
        ?>
    <!-- шапка -->
    <div class="landing">
        <!-- ===== ГЕРОЙ ===== -->
        <div class="hero">
            <div class="hero-content">
                <span class="hero-badge">✨ 2500 лет точности</span>
                <h1>
                    <span>Квадрат Пифагора</span><br>
                    цифровой код вашей судьбы
                </h1>
                <p class="hero-text">
                    Дата рождения — не случайность. Это матрица ваших талантов, 
                    кармических задач и скрытых способностей. Получите расшифровку за 2 минуты.
                </p>
                <div class="hero-stats">
                    <div>
                        <strong>9</strong>
                        <span style="color: #6a5a4c;">ячеек</span>
                    </div>
                    <div>
                        <strong>3</strong>
                        <span style="color: #6a5a4c;">строки</span>
                    </div>
                    <div>
                        <strong>3</strong>
                        <span style="color: #6a5a4c;">столбца</span>
                    </div>
                    <div>
                        <strong>2</strong>
                        <span style="color: #6a5a4c;">диагонали</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
               <img src="<?php echo ABS_PATH;?>img-calc/pifagor.jpg" alt="Квадрат Пифагора - нумерологический расчет по дате рождения">
            </div>
        </div>

        <!-- ===== ФОРМА ===== -->
        <div class="form-section" id="calculate">
            <form method="POST" id="pifagorForm">
                <p class="error">
                    <?php echo $errMsg;?>
                </p>
               <div class="form-grid">
    <!-- Поле с датой (первое) -->
    <div class="form-field">
        <label>📅 ВАША ДАТА РОЖДЕНИЯ</label>
        <input type="date" name="daterozd" value="<?php echo $birthDate; ?>" class="date-input">
    </div>
    
    <!-- Чекбокс (второй) -->
  <div class="consent-wrapper">
    <div class="consent-item">
        <div class="consent-checkbox">
            <input type="checkbox" name="consent" <?php echo $ch1; ?> id="consentData">
            <span class="checkmark"></span>
        </div>
        <label for="consentData" class="consent-text">
            Я согласен(на) на <a href="/privacy-policy.php" target="_blank">обработку персональных данных</a>
        </label>
    </div>
</div>
    
    <!-- Кнопка (третья, последняя) -->
    <div class="form-button">
        <button type="submit" name="TablPifFr" class="calc-btn">
            <span>🔮</span> Рассчитать
        </button>
    </div>
</div>
            
            
            <div class="privacy-note">
                <i class="fas fa-shield-alt"></i> Ваша дата рождения используется только для расчета и не передается третьим лицам
            </div>

                <!-- добавляем чекбокс -->
            </form>
        </div>
        <!-- ===== ФОРМА ===== -->
        <!-- ===== ПРЕИМУЩЕСТВА ===== -->
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">🧠</div>
                <h3>Характер и воля</h3>
                <p>Сильные стороны, лидерские качества, упрямство и гибкость</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Энергетика</h3>
                <p>Ваш уровень жизненной силы, эмоциональный фон, выносливость</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3>Предназначение</h3>
                <p>В чём ваш талант, какая работа принесёт успех</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">❤️</div>
                <h3>Совместимость</h3>
                <p>С кем вы создадите гармоничный союз, а кто будет конфликтовать</p>
            </div>
        </div>

        <!-- ===== КАК РАБОТАЕТ ===== -->
        <div class="how-it-works">
            <h2 class="section-title">
                <span>⚡</span> Как работает расчёт
            </h2>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h4>Вводите дату</h4>
                    <p>День, месяц, год вашего рождения — код вашей личности</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h4>Анализ чисел</h4>
                    <p>Мы вычисляем 4 рабочих числа и заполняем 9 ячеек</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h4>Трактовка</h4>
                    <p>Вы получаете разбор каждой ячейки и рекомендации</p>
                </div>
            </div>
        </div>

        <!-- ===== ПРИМЕР РАСШИФРОВКИ ===== -->
        <div class="example">
            <h2 style="font-size: 32px; margin-bottom: 30px; color: white;">✨ Пример расшифровки</h2>
            <div class="example-grid">
                <div class="example-square">
                    <div class="square-grid">
                        <div class="square-cell">
                            1111
                            <span class="square-label">характер</span>
                        </div>
                        <div class="square-cell">
                            2
                            <span class="square-label">энергия</span>
                        </div>
                        <div class="square-cell">
                            3
                            <span class="square-label">интерес</span>
                        </div>
                        <div class="square-cell">
                            —
                            <span class="square-label">здоровье</span>
                        </div>
                        <div class="square-cell">
                            5
                            <span class="square-label">логика</span>
                        </div>
                        <div class="square-cell">
                            6
                            <span class="square-label">труд</span>
                        </div>
                        <div class="square-cell">
                            77
                            <span class="square-label">удача</span>
                        </div>
                        <div class="square-cell">
                            8
                            <span class="square-label">долг</span>
                        </div>
                        <div class="square-cell">
                            99
                            <span class="square-label">память</span>
                        </div>
                    </div>
                </div>
                <div class="example-desc">
                    <h3>Волевой, удачливый, с хорошей памятью</h3>
                    <p>
                        У человека <strong>4 единицы</strong> — диктаторский характер, лидер. 
                        <strong>Две семёрки</strong> — везение, ангел-хранитель. 
                        <strong>Две девятки</strong> — аналитический ум, способность к обучению.
                    </p>
                    <p style="font-size: 16px; opacity: 0.8;">
                        * Это реальный расчёт. Каждый получает свой уникальный профиль.
                    </p>
                </div>
            </div>
        </div>

        <!-- ===== СЛАЙДЕР ОТЗЫВОВ НА SWIPER ===== -->
                <div class="testimonials">
            <h2 class="section-title">
                <span>💬</span> Отзывы о расчётах
            </h2>

            <div class="swiper reviewsSwiper">
                <div class="swiper-wrapper">
                       <?php  
                    $otzivi=selectArticlesFiltered('otzivi','', 
                     [
                        'is_active'=>1,
                        'id_calc'=>$Pifagor['id']
                        ]);
                       // tt($otzivi);
                        ////////////////////////////////
                        foreach($otzivi as $otziv)
                            {

                    ?>
                    <!-- Отзыв 1 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-header">
                                <div class="testimonial-author">
                                    <h4><?php echo $otziv['name']?></h4>

                                </div>
                            </div>
                            <div class="testimonial-text">
                                <?php echo $otziv['description']?>
                            </div>
                            <!-- <div class="testimonial-date"><?php echo substr($otziv['date_create'], 0, 10)?></div> -->
                        </div>
                    </div>
                 <?php
                            }
                            ?>                  
                    
                </div>
                
                <!-- Кнопки навигации -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                
                <!-- Пагинация (точки) -->
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- ===== ФИНАЛЬНЫЙ ПРИЗЫВ ===== -->
        <div class="cta">
            <h3>Готовы узнать свой код?</h3>
            <p>2 минуты — и вы увидите свою психоматрицу</p>
            <a href="#calculate" class="cta-btn">🔮 Начать расчёт</a>
        </div>

        <!-- ===== ФУТЕР ===== -->
        <div class="footer-pif">
            <p>© 2026 Квадрат Пифагора · Нумерологический портал</p>
            <p>Расчёты основаны на классической школе Александрова</p>
        </div>
    </div>
    <!-- Футер -->        
<?php
include_once 'app/include/FooterAll.php';
?>
<!-- Футер -->

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="<?php echo ABS_PATH ?>assets/js/swipper.js"></script>
    <script src="<?php echo ABS_PATH ?>assets/js/pifagor-form.js"></script>
    </body>
</html>
