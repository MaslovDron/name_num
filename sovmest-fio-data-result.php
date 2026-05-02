<?php
include '../app/include/config.php';
include '../app/include/connect.php';
include '../app/include/functions-adm.php';
include '../app/include/sovmest-function.php';
//tt($_SESSION);
// Проверяем, есть ли данные совместимости
if (!isset($_SESSION['sovmest_fio_data_result'])) {
    header('Location: sovmest-fio-data-form.php');
    exit;
}
$data = $_SESSION['sovmest_fio_data_result'];
$interpretation = $data['interpretation'];
$numbers1 = $data['numbers1'];
$numbers2 = $data['numbers2'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Совместимость по ФИО и дате рождения: <?= htmlspecialchars($data['imya1']) ?> и <?= htmlspecialchars($data['imya2']) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/all-style.css">
    <link rel="stylesheet" href="<?= ABS_PATH ?>assets/css/sovmest.css">
    <style>
        .date-badge {
            background: #f0e6d2;
            padding: 5px 15px;
            border-radius: 30px;
            font-size: 14px;
            margin-top: 8px;
            display: inline-block;
            color: #5a3a2a;
        }
        
        .final-number-block {
            background: linear-gradient(135deg, #b38b5f, #8b5a2b);
            border-radius: 20px;
            padding: 12px;
            text-align: center;
            min-width: 80px;
        }
        
        .final-number-block .num {
            font-size: 2em;
            font-weight: bold;
            color: white;
        }
        
        .final-number-block .label {
            font-size: 11px;
            color: rgba(255,255,255,0.8);
        }
        
        .number-item.date-item {
            background: #e8e0d0;
        }
        
        .strength-weakness {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 12px;
        }
        
        .strength-box {
            background: #d4edda;
            border-left: 4px solid #28a745;
            padding: 8px 12px;
            border-radius: 8px;
            flex: 1;
            font-size: 13px;
        }
        
        .weakness-box {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
            padding: 8px 12px;
            border-radius: 8px;
            flex: 1;
            font-size: 13px;
        }
        
        .dynamic-box {
            background: #e2e3e5;
            border-left: 4px solid #6c757d;
            padding: 8px 12px;
            border-radius: 8px;
            margin-top: 10px;
            font-size: 13px;
        }
        
        @media print {
            @page { margin: 0.5cm; size: A4; }
            @top-center, @bottom-center { content: ""; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>
<div class="landing">
    <div class="container">
        
        <!-- Заголовок -->
        <div class="header-pif">
        <a href="<?php echo ABS_PATH.'results/'.$data['filename'];?>" target="_blank"><?php echo ABS_PATH.'results/'.$data['filename'];?></a>
            <h1><i class="fas fa-heart"></i> Совместимость по ФИО и дате рождения</h1>
            <div class="subtitle">Детальный анализ на основе полных имён и дат рождения</div>
        </div>
        
        <!-- Информация о партнерах -->
        <div class="date-info" style="display: flex; justify-content: center; align-items: center; gap: 30px; flex-wrap: wrap;">
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($data['fio_disp1']) ?></div>
                <div class="date-label">Партнёр 1</div>
                <div class="date-badge"><i class="fas fa-calendar-alt"></i> <?= htmlspecialchars($data['date1']) ?></div>
            </div>
            <div style="font-size: 48px; font-weight: bold; color: #b38b5f;">+</div>
            <div class="date-item">
                <div class="date-value"><?= htmlspecialchars($data['fio_disp2']) ?></div>
                <div class="date-label">Партнёр 2</div>
                <div class="date-badge"><i class="fas fa-calendar-alt"></i> <?= htmlspecialchars($data['date2']) ?></div>
            </div>
        </div>
        
        <!-- Процент совместимости -->
        <div class="compatibility-score">
            <div class="score-circle">
                <div class="score-value"><?= $interpretation['percentage'] ?>%</div>
                <div class="score-label">совместимости</div>
            </div>
        </div>
        
        <!-- Ключевые числа -->
        <h2 class="matrix-title"><i class="fas fa-magic"></i> Ключевые числа</h2>
        <div class="pair-numbers">
            <div class="number-block">
                <h3><?= htmlspecialchars($data['imya1']) ?></h3>
                <div class="number-list">
                    <div class="number-item final-number-block">
                        <div class="num"><?= $data['final_number1'] ?></div>
                        <div class="label">итоговое</div>
                    </div>
                    <div class="number-item"><div class="num"><?= $numbers1['name'] ?></div><div class="label">имя</div></div>
                    <div class="number-item date-item"><div class="num"><?= $data['date_number1'] ?></div><div class="label">дата</div></div>
                    <div class="number-item"><div class="num"><?= $numbers1['soul'] ?></div><div class="label">душа</div></div>
                    <div class="number-item"><div class="num"><?= $numbers1['personality'] ?></div><div class="label">личность</div></div>
                    <div class="number-item"><div class="num"><?= $numbers1['karmic'] ?></div><div class="label">карма</div></div>
                </div>
            </div>
            <div class="heart-icon"><i class="fas fa-heart"></i></div>
            <div class="number-block">
                <h3><?= htmlspecialchars($data['imya2']) ?></h3>
                <div class="number-list">
                    <div class="number-item final-number-block">
                        <div class="num"><?= $data['final_number2'] ?></div>
                        <div class="label">итоговое</div>
                    </div>
                    <div class="number-item"><div class="num"><?= $numbers2['name'] ?></div><div class="label">имя</div></div>
                    <div class="number-item date-item"><div class="num"><?= $data['date_number2'] ?></div><div class="label">дата</div></div>
                    <div class="number-item"><div class="num"><?= $numbers2['soul'] ?></div><div class="label">душа</div></div>
                    <div class="number-item"><div class="num"><?= $numbers2['personality'] ?></div><div class="label">личность</div></div>
                    <div class="number-item"><div class="num"><?= $numbers2['karmic'] ?></div><div class="label">карма</div></div>
                </div>
            </div>
        </div>
        
        <!-- Детальный разбор -->
        <h2 class="matrix-title"><i class="fas fa-chart-bar"></i> Детальный разбор</h2>
        <div class="criteria-grid">
            
            <!-- 1. Итоговое число (ФИО + дата) -->
            <div class="criteria-card">
                <div class="criteria-title">⭐ Итоговое число (ФИО + дата)</div>
                <div class="criteria-numbers">
                    <span><?= $data['final_number1'] ?></span>
                    <span>→</span>
                    <span><?= $data['final_number2'] ?></span>
                </div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['final_interpretation']['title'] ?? 'Главная вибрация союза' ?></strong>
                    <p style="margin-top: 8px;"><?= $interpretation['final_interpretation']['full'] ?? 'Итоговое число объединяет энергию вашего полного имени и даты рождения.' ?></p>
                    
                    <p style="margin-top: 8px; color: #8b5a2b;"><strong>Число ФИО:</strong> <?= $numbers1['name'] ?> и <?= $numbers2['name'] ?> | <strong>Число даты:</strong> <?= $data['date_number1'] ?> и <?= $data['date_number2'] ?></p>
                    
                    <?php if(isset($interpretation['final_interpretation']['strength'])): ?>
                    <div class="strength-weakness">
                        <div class="strength-box">💪 <?= $interpretation['final_interpretation']['strength'] ?></div>
                        <div class="weakness-box">⚠️ <?= $interpretation['final_interpretation']['weakness'] ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(isset($interpretation['final_interpretation']['dynamic'])): ?>
                    <div class="dynamic-box">🔄 <?= $interpretation['final_interpretation']['dynamic'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- 2. Число имени -->
            <div class="criteria-card">
                <div class="criteria-title">🎭 Число имени</div>
                <div class="criteria-numbers">
                    <span><?= $numbers1['name'] ?></span>
                    <span>→</span>
                    <span><?= $numbers2['name'] ?></span>
                </div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['name_interpretation']['title'] ?? 'Анализ характеров' ?></strong>
                    <p style="margin-top: 8px;"><?= $interpretation['name_interpretation']['full'] ?? '' ?></p>
                    
                    <?php if(isset($interpretation['name_interpretation']['strength'])): ?>
                    <div class="strength-weakness">
                        <div class="strength-box">💪 <?= $interpretation['name_interpretation']['strength'] ?></div>
                        <div class="weakness-box">⚠️ <?= $interpretation['name_interpretation']['weakness'] ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(isset($interpretation['name_interpretation']['dynamic'])): ?>
                    <div class="dynamic-box">🔄 <?= $interpretation['name_interpretation']['dynamic'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- 3. Число даты рождения -->
            <div class="criteria-card">
                <div class="criteria-title">📅 Число даты рождения</div>
                <div class="criteria-numbers">
                    <span><?= $data['date_number1'] ?></span>
                    <span>→</span>
                    <span><?= $data['date_number2'] ?></span>
                </div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['date_interpretation']['title'] ?? 'Анализ жизненных ритмов' ?></strong>
                    <p style="margin-top: 8px;"><?= $interpretation['date_interpretation']['full'] ?? '' ?></p>
                    
                    <?php if(isset($interpretation['date_interpretation']['strength'])): ?>
                    <div class="strength-weakness">
                        <div class="strength-box">💪 <?= $interpretation['date_interpretation']['strength'] ?></div>
                        <div class="weakness-box">⚠️ <?= $interpretation['date_interpretation']['weakness'] ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(isset($interpretation['date_interpretation']['dynamic'])): ?>
                    <div class="dynamic-box">🔄 <?= $interpretation['date_interpretation']['dynamic'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- 4. Число души -->
            <div class="criteria-card">
                <div class="criteria-title">💖 Число души</div>
                <div class="criteria-numbers">
                    <span><?= $numbers1['soul'] ?></span>
                    <span>→</span>
                    <span><?= $numbers2['soul'] ?></span>
                </div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['soul_interpretation']['title'] ?? 'Эмоциональная связь' ?></strong>
                    <p style="margin-top: 8px;"><?= $interpretation['soul_interpretation']['full'] ?? '' ?></p>
                    
                    <?php if(isset($interpretation['soul_interpretation']['strength'])): ?>
                    <div class="strength-weakness">
                        <div class="strength-box">💪 <?= $interpretation['soul_interpretation']['strength'] ?></div>
                        <div class="weakness-box">⚠️ <?= $interpretation['soul_interpretation']['weakness'] ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(isset($interpretation['soul_interpretation']['dynamic'])): ?>
                    <div class="dynamic-box">🔄 <?= $interpretation['soul_interpretation']['dynamic'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- 5. Число личности -->
            <div class="criteria-card">
                <div class="criteria-title">👤 Число личности</div>
                <div class="criteria-numbers">
                    <span><?= $numbers1['personality'] ?></span>
                    <span>→</span>
                    <span><?= $numbers2['personality'] ?></span>
                </div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['personality_interpretation']['title'] ?? 'Социальный образ' ?></strong>
                    <p style="margin-top: 8px;"><?= $interpretation['personality_interpretation']['full'] ?? '' ?></p>
                    
                    <?php if(isset($interpretation['personality_interpretation']['strength'])): ?>
                    <div class="strength-weakness">
                        <div class="strength-box">💪 <?= $interpretation['personality_interpretation']['strength'] ?></div>
                        <div class="weakness-box">⚠️ <?= $interpretation['personality_interpretation']['weakness'] ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(isset($interpretation['personality_interpretation']['dynamic'])): ?>
                    <div class="dynamic-box">🔄 <?= $interpretation['personality_interpretation']['dynamic'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- 6. Кармическое число -->
            <div class="criteria-card">
                <div class="criteria-title">🌀 Кармическое число</div>
                <div class="criteria-numbers">
                    <span><?= $numbers1['karmic'] ?></span>
                    <span>→</span>
                    <span><?= $numbers2['karmic'] ?></span>
                </div>
                <div class="criteria-desc">
                    <strong><?= $interpretation['karmic_interpretation']['title'] ?? 'Кармическая задача' ?></strong>
                    <p style="margin-top: 8px;"><?= $interpretation['karmic_interpretation']['full'] ?? '' ?></p>
                    
                    <?php if(isset($interpretation['karmic_interpretation']['strength'])): ?>
                    <div class="strength-weakness">
                        <div class="strength-box">💪 <?= $interpretation['karmic_interpretation']['strength'] ?></div>
                        <div class="weakness-box">⚠️ <?= $interpretation['karmic_interpretation']['weakness'] ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(isset($interpretation['karmic_interpretation']['dynamic'])): ?>
                    <div class="dynamic-box">🔄 <?= $interpretation['karmic_interpretation']['dynamic'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
        
        <!-- Советы по укреплению (если есть) -->
        <?php if(!empty($interpretation['strengthening_advice'])): ?>
        <div class="advice-block">
            <h2><i class="fas fa-tools"></i> Как укрепить ваш союз?</h2>
            <ul class="strengthening-list">
                <?php foreach($interpretation['strengthening_advice'] as $advice): ?>
                <li><i class="fas fa-heart" style="color: #b38b5f;"></i> <span><?= $advice ?></span></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
        
        <!-- Общая рекомендация -->
        <div class="quality-card">
            <div class="quality-title">💫 Общая рекомендация</div>
            <div class="quality-text"><?= $interpretation['general_advice'] ?></div>
        </div>
        
        <!-- Краткое описание уровня -->
        <div class="quality-card">
            <div class="quality-title">✨ Общая оценка</div>
            <div class="quality-text"><?= $interpretation['short_description'] ?></div>
        </div>
        
        <!-- Полное описание -->
        <div class="quality-card">
            <div class="quality-title">📖 Подробный разбор</div>
            <div class="quality-text"><?= $interpretation['full_description'] ?></div>
        </div>
        
        <!-- Кнопки действий -->
        <div class="action-buttons no-print">
            <a href="sovmest-fio-data-form.php" class="btn btn-primary">
                <i class="fas fa-redo"></i> Новый расчёт
            </a>
            <button onclick="window.print()" class="btn btn-primary" style="background: #9b59b6;">
                <i class="fas fa-file-pdf"></i> Сохранить в PDF
            </button>
        </div>
        
        <!-- Футер -->
        <div class="footer-pif">
            <p><i class="far fa-clock"></i> Расчёт выполнен: <?= $data['calculated_at'] ?></p>
            <p>© <?= date('Y') ?> Совместимость по ФИО и дате рождения | Нумерологический анализ</p>
        </div>
        
    </div>
</div>
</body>
</html>
