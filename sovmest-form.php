<?php
include 'app/include/config.php';
include 'app/include/connect.php';
include 'app/include/functions-front.php';
include 'app/controllers/SovmestController.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
    <title>Совместимость имён — узнайте, насколько вы подходите друг другу</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- style-->
    <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/sovmest-form.css">
    <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/all-style.css">
    <!-- style-->
    <!-- <style>
        /* Стили для двух полей ввода */
        .double-input {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .partner-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4a4a4a;
            font-size: 14px;
        }
        @media (max-width: 600px) {
            .double-input {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }
    </style> -->
</head>
<body>
    <div class="landing">
        <!-- ===== ГЕРОЙ ===== -->
        <div class="hero">
            <div class="hero-content">
                <span class="hero-badge">✨ Нумерология отношений</span>
                <h1>
                    <span>Совместимость имён</span><br>
                    узнайте, насколько вы подходите друг другу
                </h1>
                <p class="hero-text">
                    Имена — это вибрационные коды. Узнайте, как ваши энергии сочетаются,
                    какие сильные стороны в вашей паре и где возможны сложности.
                </p>
                <div class="hero-stats">
                    <div>
                        <strong>100%</strong>
                        <span style="color: #6a5a4c;">анализ</span>
                    </div>
                    <div>
                        <strong>9</strong>
                        <span style="color: #6a5a4c;">критериев</span>
                    </div>
                    <div>
                        <strong>2</strong>
                        <span style="color: #6a5a4c;">минуты</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <img src="<?php echo ABS_PATH;?>img-calc/sovm-fio.jpg" alt="Совместимость имён" onerror="this.src='https://via.placeholder.com/500x400?text=❤️'">
            </div>
        </div>

        <!-- ===== ФОРМА ===== -->
        <div class="form-section" id="calculate">
            <form method="POST" id="compatibilityForm">
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
                    <!-- Два поля для имён -->
                    <div class="double-input">
                        <div class="form-field">
                            <label class="partner-label">👤 Имя партнёра 1</label>
                            <input type="text" name="name1" class="date-input" placeholder="Например: Александр" value="<?php echo htmlspecialchars($name1 ?? ''); ?>">
                        </div>
                        <div class="form-field">
                            <label class="partner-label">👤 Имя партнёра 2</label>
                            <input type="text" name="name2" class="date-input" placeholder="Например: Екатерина" value="<?php echo htmlspecialchars($name2 ?? ''); ?>">
                        </div>
                    </div>
                    
                    <!-- Чекбокс согласия -->
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
                    
                    <!-- Кнопка -->
                    <div class="form-button">
                        <button type="submit" name="SovmFr" class="calc-btn">
                            <span>🔮</span> Узнать совместимость
                        </button>
                    </div>
                </div>
                
                <div class="privacy-note">
                    <i class="fas fa-shield-alt"></i> Ваши имена используются только для расчета и не передаются третьим лицам
                </div>
            </form>
        </div>

        <!-- ===== ПРЕИМУЩЕСТВА ===== -->
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">💑</div>
                <h3>Совместимость характеров</h3>
                <p>Как дополняют друг друга ваши личностные качества</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">❤️</div>
                <h3>Эмоциональная связь</h3>
                <p>Насколько вы чувствуете друг друга на уровне души</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3>Общие цели</h3>
                <p>Совпадают ли ваши жизненные пути</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Динамика отношений</h3>
                <p>Как развиваются ваши отношения со временем</p>
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
                    <h4>Вводите имена</h4>
                    <p>Имена двух партнёров — коды ваших личностей</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h4>Анализ чисел</h4>
                    <p>Мы переводим буквы в числа и анализируем совместимость</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h4>Трактовка</h4>
                    <p>Вы получаете процент совместимости и подробный разбор</p>
                </div>
            </div>
        </div>

        <!-- ===== ПРИМЕР РАСШИФРОВКИ ===== -->
        <div class="example">
            <h2 style="font-size: 32px; margin-bottom: 30px; color: white;">✨ Пример совместимости</h2>
            <div class="example-grid">
                <div class="example-square">
                    <div style="text-align: center; padding: 20px;">
                        <div style="font-size: 48px; color: gold;">Александр</div>
                        <div style="font-size: 24px; margin: 10px 0;">+</div>
                        <div style="font-size: 48px; color: gold;">Екатерина</div>
                        <div style="margin-top: 20px; font-size: 36px; font-weight: bold;">87%</div>
                        <div style="margin-top: 5px;">совместимости</div>
                    </div>
                </div>
                <div class="example-desc">
                    <h3>Гармоничный союз лидера и хранительницы</h3>
                    <p>
                        У <strong>Александра (число 7)</strong> — глубокий ум, интерес к знаниям.<br>
                        У <strong>Екатерины (число 6)</strong> — забота, семейность, надёжность.<br>
                        Они идеально дополняют друг друга: один ищет глубину, другая создаёт уют.
                    </p>
                    <p style="font-size: 16px; opacity: 0.8;">
                        * Это реальный расчёт. Каждая пара получает свой уникальный профиль.
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
                    $otzivi = selectArticlesFiltered('otzivi', '', [
                        'is_active' => 1,
                        'id_calc' => 11 // ID вашего калькулятора совместимости в БД
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

        <!-- ===== ПРИЗЫВ К ПОЛНОМУ АНАЛИЗУ ===== -->
        <!-- <div class="cta" style="background: linear-gradient(145deg, #fef5e8, #fff); border: 2px solid #b38b5f;">
            <h3>Хотите более глубокий анализ?</h3>
            <p>Полный разбор по ФИО и дате рождения — узнайте всё о вашей совместимости</p>
            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; margin-top: 20px;">
                <a href="https://t.me/your_nickname" target="_blank" class="cta-btn" style="background: #0088cc; border-bottom-color: #006699;">
                    <i class="fab fa-telegram"></i> Telegram
                </a>
                <a href="https://wa.me/79001234567" target="_blank" class="cta-btn" style="background: #25D366; border-bottom-color: #1da851;">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                <a href="mailto:name@example.com" class="cta-btn" style="background: #b38b5f; border-bottom-color: #8a6e4b;">
                    <i class="far fa-envelope"></i> Написать
                </a>
            </div>
            <p style="margin-top: 20px; font-size: 18px;">Стоимость полного анализа — 399 ₽</p>
        </div> -->
        <div class="cta">
          <h3>Готовы узнать свою совместимость?</h3>
            <p>2 минуты — и вы увидите, насколько вы подходите друг другу</p>
            <a href="#calculate" class="cta-btn">🔮 Начать анализ</a>
        </div>

        <!-- ===== ФУТЕР ===== -->
        <div class="footer-pif">
            <p>© 2026 Совместимость имён · Нумерологический анализ пар</p>
            <p>Расчёты основаны на классической школе нумерологии</p>
        </div>
    </div>

    <?php include_once 'app/include/FooterAll.php'; ?>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="<?php echo ABS_PATH ?>assets/js/swipper.js"></script>
    <!-- Валидация формы -->
    <!-- <script src="<?php echo ABS_PATH ?>assets/js/sovmest-valid.js"></script> -->
    
    
</body>
</html>
