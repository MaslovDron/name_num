<?php
include 'app/include/config.php';
include 'app/include/connect.php';
include 'app/include/functions-front.php';
include 'app/controllers/LifeController.php';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
    <title>🔮 Карта Жизни — бесплатный нумерологический расчет по дате рождения</title>
    <meta name="description" content="Рассчитайте свою Карту Жизни по дате рождения бесплатно. Узнайте периоды подъёма и спада энергии, ключевые циклы судьбы и получите персональный прогноз.">
    <link rel="canonical" href="https://калькулятор-судьбы.рф/" />

    <!-- OPEN GRAPH -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://калькулятор-судьбы.рф.">
    <meta property="og:title" content="Карта Жизни — бесплатный нумерологический расчет по дате рождения">
    <meta property="og:description" content="Рассчитайте свою Карту Жизни по дате рождения бесплатно. Узнайте периоды подъёма и спада энергии.">
    <meta property="og:image" content="https://калькулятор-судьбы.рф/img/og-image.jpg">
    <meta property="og:site_name" content="Карта Жизни">

    <link rel="icon" href="/icon/favicon.ico" type="image/x-icon"> 
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/icon180.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icon/icon32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icon/icon16.png">
    
    <!-- Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <!-- Основные стили -->
    <link rel="stylesheet" href="<?php echo ABS_PATH ?>assets/css/all-style.css">
    <link rel="stylesheet" href="<?php echo ABS_PATH ?>assets/css/life-chart.css">
    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "url": "https://калькулятор-судьбы.рф/",
      "name": "Карта Жизни — бесплатный нумерологический расчет по дате рождения",
      "description": "Рассчитайте свою Карту Жизни по дате рождения бесплатно. Узнайте периоды подъёма и спада энергии.",
      "isAccessibleForFree": "true"
    }
    </script>
</head>
<body>
    <!-- ШАПКА (как в примере) -->
    <?php include 'includes/header.php'; ?>
    
    <div class="landing">
        <!-- ===== ГЕРОЙ ===== -->
        <div class="hero">
            <div class="hero-content">
                <span class="hero-badge">✨ Нумерология судьбы</span>
                <h1>
                    <span>Карта Жизни</span><br>
                    узнайте свои ключевые циклы по дате рождения
                </h1>
                <p class="hero-text">
                    Каждый период жизни несёт уникальную энергию — подъёмы и спады, возможности и испытания. 
                    Рассчитайте свою Карту Жизни и действуйте в согласии с ритмом Вселенной.
                </p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">10</span>
                        <span class="stat-label">периодов жизни</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">60</span>
                        <span class="stat-label">лет прогноза</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">100%</span>
                        <span class="stat-label">бесплатно</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <img src="<?php ABS_PATH?>img-calc/life-chart.jpg" alt="Карта Жизни нумерология">
            </div>
        </div>

        <!-- ===== ФОРМА РАСЧЁТА ===== -->
        <div class="form-section" id="calculate">
            <form method="POST" action="" id="lifeForm">
                 <p class="error" style="display: none;"></p>
                <?php if($errMsg != ''): ?>
                    <p class="error">⚠️ <?php echo $errMsg; ?></p>
                <?php endif; ?>
                
                <div class="form-grid">
                    <div class="form-field">
                        <label>📅 ВАША ДАТА РОЖДЕНИЯ</label>
                        <input type="date" name="birthdate" class="date-input" 
                               value="<?php echo htmlspecialchars($birthDate); ?>" 
                               id="birthdate">
                        <small style="display: block; margin-top: 8px; color: #8b7a6b;">
                            После расчёта вы получите: график жизненной энергии, пики и спады, 
                            расшифровку каждого периода. Всё бесплатно, без регистрации
                        </small>
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
                        <button type="submit" name="FrLifeChart" class="calc-btn">
                            <span>🔮</span> Узнать свою Карту Жизни
                        </button>
                    </div>
                </div>
                
                <div class="privacy-note">
                    <i class="fas fa-shield-alt"></i> Ваши данные используются только для расчёта и не передаются третьим лицам
                </div>
            </form>
        </div>

        <!-- ===== ПРЕИМУЩЕСТВА ===== -->
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">📈</div>
                <h3>Планирование жизни</h3>
                <p>Узнайте, в какие периоды лучше стартовать проекты, а когда — завершать дела</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">❤️</div>
                <h3>Личная жизнь</h3>
                <p>Поймите, когда благоприятное время для знакомств и укрепления отношений</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3>Финансы</h3>
                <p>Определите периоды для крупных покупок, инвестиций и карьерных решений</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🧘</div>
                <h3>Духовный рост</h3>
                <p>Узнайте, когда лучше заниматься обучением, медитацией и саморазвитием</p>
            </div>
        </div>

        <!-- ===== КАК РАБОТАЕТ ===== -->
        <div class="how-it-works">
            <h2 class="section-title">
                <span>⚡</span> Как рассчитывается Карта Жизни
            </h2>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h4>Укажите дату рождения</h4>
                    <p>День, месяц и год — ваш личный нумерологический код</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h4>Автоматический расчёт</h4>
                    <p>Мы перемножаем цифры даты рождения и раскладываем на жизненные циклы</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h4>Получите Карту Жизни</h4>
                    <p>График энергии на 60 лет с расшифровкой каждого периода</p>
                </div>
            </div>
        </div>

        <!-- ===== ПРИМЕР ===== -->
        <div class="example">
            <h2 style="font-size: 32px; margin-bottom: 30px; color: white;">✨ Пример Карты Жизни</h2>
            <div class="example-grid">
                <div class="example-square">
                    <div class="square-grid">
                        <div class="square-cell">
                            15.06.1986
                            <span class="square-label">дата рождения</span>
                        </div>
                        <div style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 12px;">
                            <div style="font-size: 14px; opacity: 0.7;">жизненный код</div>
                            <div style="font-size: 28px; font-weight: 300; letter-spacing: 4px;">1 → 7 → 8 → 7 → 4 → 0</div>
                        </div>
                    </div>
                </div>
                <div class="example-desc">
                    <h3>Ключевые периоды жизни</h3>
                    <p>
                        <strong>Пик удачи (12 лет):</strong> энергия 8 — время для успеха и финансовых решений<br>
                        <strong>Спад (30 лет):</strong> энергия 0 — период трансформации и перезагрузки<br>
                        <strong>Восходящий тренд:</strong> после 36 лет энергия идёт вверх
                    </p>
                    <p style="font-size: 16px; opacity: 0.8; margin-top: 15px;">
                        * Пример для человека, рождённого 15 июня 1986 года
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
                        'id_calc' => 19 // ID для калькулятора месяца
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

        <!-- ===== ПРИЗЫВ ===== -->
        <div class="cta">
            <h3>Готовы узнать свою Карту Жизни?</h3>
            <p>1 минута — и вы получите персональный прогноз на 60 лет вперёд</p>
            <a href="#calculate" class="cta-btn">🔮 Начать расчёт</a>
        </div>

        <!-- ===== ФУТЕР ===== -->
        <div class="footer-pif">
            <p>© <?= date('Y') ?> Карта Жизни · Нумерологический портал</p>
            <p>Расчёты основаны на классической школе нумерологии</p>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="<?php echo ABS_PATH ?>assets/js/swipper.js"></script>
    
    <!-- <script src="assets/js/main.js"></script> -->
             <!-- Валидация формы -->
    <!-- <script src="<?=ABS_PATH?>assets/js/life-chart-valid.js"></script> -->
</body>
</html>
