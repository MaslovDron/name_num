<?php
include 'app/include/config.php';
include 'app/include/connect.php';
include 'app/include/functions-front.php';
include 'app/controllers/NameController.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
    <title>Нумерология имени — цифровой код вашей судьбы</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- ВАШИ СТИЛИ (те же, что и у Пифагора) -->
    <!-- <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/pifagor-form.css"> -->
     <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/name-form.css">
    <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/all-style.css">
</head>
<body>
    <div class="landing">
        <!-- ===== ГЕРОЙ ===== -->
        <div class="hero">
            <div class="hero-content">
                <span class="hero-badge">✨ 2500 лет точности</span>
                <h1>
                    <span>Нумерология имени</span><br>
                    цифровой код вашей личности
                </h1>
                <p class="hero-text">
                    Ваше имя — не случайность. Это матрица ваших талантов, 
                    кармических задач и скрытых способностей. Получите расшифровку за 2 минуты.
                </p>
                <div class="hero-stats">
                    <div>
                        <strong>9</strong>
                        <span style="color: #6a5a4c;">чисел</span>
                    </div>
                    <div>
                        <strong>3</strong>
                        <span style="color: #6a5a4c;">уровня</span>
                    </div>
                    <div>
                        <strong>6</strong>
                        <span style="color: #6a5a4c;">характеристик</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
               <img src="<?php echo ABS_PATH;?>img-calc/name.jpg" alt="Нумерология имени" onerror="this.src='https://via.placeholder.com/500x400?text=Имя'">
            </div>
        </div>

        <!-- ===== ФОРМА ===== -->
        <div class="form-section" id="calculate">
            <form method="POST" action="" id="nameForm">
                <p class="error" style="display: none;"></p>
                <?php
                if($errMsg!='')
                {
                    ?>
                <p><?php echo $errMsg; ?></p>
                <?php 
                }
                 ?>
                <div class="form-grid">
                    <!-- Поле для имени -->
                    <div class="form-field">
                        <label>👤 ВАШЕ ИМЯ</label>
                        <input type="text" name="firstname" class="date-input" placeholder="Например: Александр" value="<?php echo $firstName ?>">
                    </div>
                    
                    <!-- Чекбокс согласия -->
                    <div class="consent-wrapper">
                        <div class="consent-item">
                            <div class="consent-checkbox">
                                <input type="checkbox" name="consent" value="<?php echo $firstName; ?>" id="consentData">
                                <span class="checkmark"></span>
                            </div>
                            <label for="consentData" class="consent-text">
                                Я согласен(на) на <a href="/privacy-policy.php" target="_blank">обработку персональных данных</a>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Кнопка -->
                    <div class="form-button">
                        <button type="submit" name="submitNameFr" class="calc-btn">
                            <span>🔮</span> Рассчитать
                        </button>
                    </div>
                </div>
                
                <div class="privacy-note">
                    <i class="fas fa-shield-alt"></i> Ваше имя используется только для расчета и не передается третьим лицам
                </div>
            </form>
        </div>

        <!-- ===== ПРЕИМУЩЕСТВА ===== -->
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">🧠</div>
                <h3>Характер и воля</h3>
                <p>Сильные стороны, лидерские качества, темперамент</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Энергетика</h3>
                <p>Ваш уровень жизненной силы, эмоциональный фон</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3>Предназначение</h3>
                <p>В чём ваш талант, какая работа принесёт успех</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">❤️</div>
                <h3>Совместимость</h3>
                <p>С кем вы создадите гармоничный союз</p>
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
                    <h4>Вводите имя</h4>
                    <p>Ваше имя — код вашей личности</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h4>Анализ чисел</h4>
                    <p>Мы переводим буквы в числа и вычисляем ключевые значения</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h4>Трактовка</h4>
                    <p>Вы получаете разбор каждого числа и рекомендации</p>
                </div>
            </div>
        </div>

        <!-- ===== ПРИМЕР РАСШИФРОВКИ ===== -->
        <div class="example">
            <h2 style="font-size: 32px; margin-bottom: 30px; color: white;">✨ Пример расшифровки</h2>
            <div class="example-grid">
                <div class="example-square">
                    <div class="square-grid name-example-grid">
                        <div class="square-cell">
                            7
                            <span class="square-label">число имени</span>
                        </div>
                        <div class="square-cell">
                            3
                            <span class="square-label">число души</span>
                        </div>
                        <div class="square-cell">
                            4
                            <span class="square-label">число личности</span>
                        </div>
                        <div class="square-cell">
                            9
                            <span class="square-label">кармическое</span>
                        </div>
                    </div>
                </div>
                <div class="example-desc">
                    <h3>Аналитик, творец, наставник</h3>
                    <p>
                        У человека <strong>число имени 7</strong> — глубокий ум, интерес к знаниям. 
                        <strong>Число души 3</strong> — творческий потенциал, оптимизм. 
                        <strong>Число личности 4</strong> — надежность, трудолюбие.
                        <strong>Кармическое число 9</strong> — миссия наставника, служение людям.
                    </p>
                    <p style="font-size: 16px; opacity: 0.8;">
                        * Это пример для имени "Александр". Вы получите свой уникальный профиль.
                    </p>
                </div>
            </div>
        </div>

        <!-- ===== СЛАЙДЕР ОТЗЫВОВ ===== -->
        <div class="testimonials">
            <h2 class="section-title">
                <span>💬</span> Отзывы о расчётах
            </h2>

            <div class="swiper reviewsSwiper">
                <div class="swiper-wrapper">
                    <?php  
                    $otzivi = selectArticlesFiltered('otzivi','', 
                    ['is_active'=>1,
                    'id_calc'=>$imya['id']
                    ]
                    );
                    foreach($otzivi as $otziv) {
                    ?>
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-header">
                                <div class="testimonial-author">
                                    <h4><?php echo htmlspecialchars($otziv['name']); ?></h4>
                                </div>
                            </div>
                            <div class="testimonial-text">
                                <?php echo nl2br(htmlspecialchars($otziv['description'])); ?>
                            </div>
                            <!-- <div class="testimonial-date"><?php echo substr($otziv['date_create'], 0, 10); ?></div> -->
                        </div>
                    </div>
                    <?php } ?>
                </div>
                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- ===== ФИНАЛЬНЫЙ ПРИЗЫВ ===== -->
        <div class="cta">
            <h3>Готовы узнать свой код?</h3>
            <p>2 минуты — и вы увидите свою нумерологическую матрицу</p>
            <a href="#calculate" class="cta-btn">🔮 Начать расчёт</a>
        </div>

        <!-- ===== ФУТЕР ===== -->
        <div class="footer-pif">
            <p>© 2026 Нумерология имени · Нумерологический портал</p>
            <p>Расчёты основаны на классической школе халдейской нумерологии</p>
        </div>
    </div>

    <?php include_once 'app/include/FooterAll.php'; ?>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="<?php echo ABS_PATH ?>assets/js/swipper.js"></script>
    <!-- Валидация формы -->
    <script src="<?php echo ABS_PATH ?>assets/js/name-valid.js"></script>
</body>
</html>
