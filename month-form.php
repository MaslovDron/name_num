<?php
include 'app/include/config.php';
include 'app/include/connect.php';
include 'app/include/functions-front.php';
include 'app/controllers/MonthController.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
    <title>Нумерология: расчёт персонального месяца | Энергия вашего текущего месяца</title>
    <meta name="description" content="Бесплатный расчёт персонального месяца в нумерологии. Узнайте, какие возможности, людей и события принесёт вам текущий месяц. Точный расчёт по дате рождения.">
    <link rel="canonical" href="https://калькулятор-судьбы.рф/personal-month" />

    <!-- OPEN GRAPH -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://калькулятор-судьбы.рф/personal-month">
    <meta property="og:title" content="Нумерология: расчёт персонального месяца онлайн">
    <meta property="og:description" content="Бесплатный нумерологический прогноз на текущий месяц по вашей дате рождения. Что вас ждёт в любви, работе и финансах.">
    <meta property="og:image" content="https://калькулятор-судьбы.рф/img-calc/persmes.jpg">
    <meta property="og:site_name" content="Калькулятор Судьбы">

    <link rel="icon" href="/icon/favicon.ico" type="image/x-icon"> 
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/icon180.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icon/icon32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icon/icon16.png">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/all-style.css">
    <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/month-form.css">
</head>
<body>
    <?php include_once 'app/include/header-front.php'; ?>
    
    <div class="landing">
        <!-- ГЕРОЙ -->
        <div class="hero">
            <div class="hero-content">
                <span class="hero-badge">🌙 Нумерология настоящего</span>
                <h1>
                    <span>Персональный месяц</span><br>
                    Ваш нумерологический прогноз на месяц
                </h1>
                <p class="hero-text">
                    Каждый месяц несёт уникальную волну событий, встреч и настроения. 
                    Рассчитайте число вашего персонального месяца и действуйте в согласии с ритмом Вселенной.
                </p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">9</span>
                        <span class="stat-label">чисел месяца</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">12</span>
                        <span class="stat-label">месяцев</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">100%</span>
                        <span class="stat-label">бесплатно</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
               <img src="<?=ABS_PATH?>img-calc/persmes.jpg" alt="Нумерология персонального месяца">
            </div>
        </div>

        <!-- ФОРМА (только дата рождения + чекбокс) -->
        <div class="form-section" id="calculate">
            <form method="POST" action="" id="monthForm">
                <p class="error" style="display: none;"></p>
                <?php if($errMsg != ''): ?>
                    <p class="error">⚠️ <?php echo $errMsg; ?></p>
                <?php endif; ?>
                
                <div class="form-grid">
                    <div class="form-field">
                        <label>📅 ВАША ДАТА РОЖДЕНИЯ</label>
                        <input type="date" name="birthdate" class="date-input" value="<?php echo htmlspecialchars($birthDate); ?>" id="birthdate">
                        <small style="display: block; margin-top: 8px; color: #8b7a6b;">Расчёт для текущего <span id="currentYear"></span> года, текущего месяца</small>
                    </div>

                    
                    
                    <div class="consent-wrapper">
                        <div class="consent-item">
                            <div class="consent-checkbox">
                                <input type="checkbox" name="consent" <?php echo $ch1; ?> id="consentData">
                                <span class="checkmark"></span>
                            </div>
                            <label for="consentData" class="consent-text">
                                Я согласен(на) на <a href="/policy" target="_blank">обработку персональных данных</a>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-button">
                        <button type="submit" name="FrMonthCalc" class="calc-btn">
                            <span>🌙</span> Узнать прогноз на месяц
                        </button>
                    </div>
                </div>
                
                <div class="privacy-note">
                    <i class="fas fa-shield-alt"></i> Ваши данные используются только для расчёта и не передаются третьим лицам
                </div>
            </form>
            

        <!-- ПРЕИМУЩЕСТВА (адаптировано под месяц) -->
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3>Планирование</h3>
                <p>Узнайте, какой месяц подходит для старта, а какой для завершения дел</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">❤️</div>
                <h3>Личная жизнь</h3>
                <p>Поймите, когда ждать встреч, а когда стоит укрепить отношения</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3>Финансы</h3>
                <p>Определите месяцы для инвестиций и крупных покупок</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🧘</div>
                <h3>Духовный рост</h3>
                <p>Узнайте, когда лучше заняться саморазвитием и медитацией</p>
            </div>
        </div>

        <!-- КАК РАБОТАЕТ -->
        <div class="how-it-works">
            <h2 class="section-title">
                <span>⚡</span> Как работает расчёт
            </h2>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h4>Укажите дату рождения</h4>
                    <p>День и месяц рождения — ваш личный код</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h4>Автоматический расчёт</h4>
                    <p>Мы складываем цифры вашего рождения, текущего года и месяца</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h4>Получите прогноз</h4>
                    <p>Узнайте число месяца и подробную расшифровку</p>
                </div>
            </div>
        </div>

        <!-- ПРИМЕР -->
        <div class="example">
            <h2 style="font-size: 32px; margin-bottom: 30px; color: white;">✨ Пример расшифровки</h2>
            <div class="example-grid">
                <div class="example-square">
                    <div class="square-grid">
                        <div class="square-cell">
                            3
                            <span class="square-label">персональный месяц</span>
                        </div>
                    </div>
                </div>
                <div class="example-desc">
                    <h3>Месяц творчества, общения и лёгкости</h3>
                    <p>
                        <strong>Число 3</strong> — время самовыражения, новых знакомств и радости. 
                        В этот месяц вам будет легко даваться общение, появятся идеи, 
                        захочется творить и путешествовать. Отличное время для презентаций, 
                        переговоров и свиданий.
                    </p>
                    <p style="font-size: 16px; opacity: 0.8; margin-top: 15px;">
                        * Для человека с днём рождения 15.03 в текущем месяце
                    </p>
                </div>
            </div>
        </div>

        <!-- СЛАЙДЕР ОТЗЫВОВ -->
        <div class="testimonials">
            <h2 class="section-title">
                <span>💬</span> Что говорят наши пользователи
            </h2>

            <div class="swiper reviewsSwiper">
                <div class="swiper-wrapper">
                    <?php  
                    $otzivi = selectArticlesFiltered('otzivi', '', [
                        'is_active' => 1,
                        'id_calc' => 18 // ID для калькулятора месяца
                    ]);
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
                        </div>
                    </div>
                    <?php } ?>
                </div>
                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- ПРИЗЫВ -->
        <div class="cta">
            <h3>Готовы узнать энергию этого месяца?</h3>
            <p>1 минута — и вы получите персональный прогноз на текущий месяц</p>
            <a href="#calculate" class="cta-btn">🌙 Начать расчёт</a>
        </div>

        <!-- ФУТЕР -->
        <div class="footer-pif">
            <p>© 2026 Нумерология персонального месяца · Нумерологический портал</p>
            <p>Расчёты основаны на классической школе нумерологии</p>
        </div>
    </div>
    
    <?php include_once 'app/include/FooterAll.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="<?php echo ABS_PATH ?>assets/js/swipper.js"></script>
        <!-- Валидация формы -->
    <!-- <script src="<?=ABS_PATH?>assets/js/month-valid.js"></script> -->
</body>
</html>
