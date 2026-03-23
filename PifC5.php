       
        /* Цвета для разных уровней характеристик */
        .level-weak { color: #e74c3c; }
        .level-medium { color: #f39c12; }
        .level-good { color: #2ecc71; }
        .level-strong { color: #b38b5f; }
        .level-excellent { color: #9b59b6; }
        
        /* Стили для печати */
        @media print {
            .action-buttons, 
            .btn, 
            .footer p:last-child {
                display: none !important;
            }
            
            body {
                background: white !important;
                color: black !important;
                font-family: Arial, sans-serif !important;
                padding: 0;
            }
            
            .container {
                max-width: 100% !important;
                box-shadow: none !important;
                border: none !important;
                padding: 10px !important;
                margin: 0 !important;
                border-radius: 0;
            }
            
            .header {
                border-left: none;
                background: none;
                box-shadow: none;
                padding: 10px;
            }
            
            .header h1 {
                color: black !important;
                font-size: 24px !important;
            }
            
            .matrix-cell {
                border: 2px solid black !important;
                box-shadow: none !important;
                border-radius: 10px;
            }
            
            .number-card, 
            .quality-card, 
            .line-card, 
            .stat-card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
                margin-bottom: 15px !important;
                page-break-inside: avoid;
                background: #f9f9f9 !important;
                color: black !important;
            }
            
            .date-info {
                border: 1px solid #ccc !important;
                background: #f9f9f9;
            }
            
            .date-item {
                background: white;
                border: 1px solid #eee;
            }
            
            .date-value {
                color: black !important;
            }
            
            /* Улучшаем читаемость при печати */
            h1, h2, h3, h4 {
                color: black !important;
            }
            
            /* Убираем градиенты */
            .number-card {
                background: #f0f0f0 !important;
                color: black !important;
                border-bottom: 2px solid #999;
            }
            
            .number-value {
                color: black !important;
                text-shadow: none;
            }
            
            /* Делаем ссылки черными */
            a {
                color: black !important;
                text-decoration: underline !important;
            }
            
            .matrix-title i {
                background: none;
                color: black;
            }
            
            .section-title {
                border-left: 4px solid black;
                padding-left: 10px;
            }
        }
        
        /* Стили для уведомлений */
        .loading-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(179, 139, 95, 0.95);
            color: white;
            padding: 25px 40px;
            border-radius: 60px;
            z-index: 99999;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            text-align: center;
            min-width: 320px;
            display: none;
            border-bottom: 5px solid #5e3e2b;
            font-family: 'Georgia', serif;
        }
        
        .success-message {
            position: fixed;
            top: 30px;
            right: 30px;
            background: #2ecc71;
            color: white;
            padding: 20px 30px;
            border-radius: 60px;
            z-index: 10000;
            font-size: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
            display: none;
            border-bottom: 4px solid #27ae60;
            font-family: 'Georgia', serif;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        /* для пдф */
        @media print {
             /*убираем колонтитулы в пдф*/
         @page {
        margin: .5cm; /* Увеличиваем поля, чтобы URL не влезал */
        size: A4;
        
        /* Вариант 1: Пытаемся скрыть через пустой контент (работает не во всех браузерах) */
        @top-center {
            content: "";
        }
        
        @bottom-center {
            content: "";
        }
        /*убираем колонтитулы в пдф*/
    .action-buttons, 
    .pdf-hint {
        display: none !important;
        
    }
    
    
    
    
    body {
        font-size: 12pt !important;
        line-height: 1.4 !important;
        color: #000 !important;
        background: #fff !important;
    }
    
    .container {
        max-width: 100% !important;
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    
    /* Улучшаем читаемость при печати */
    .number-card {
        break-inside: avoid;
    }
    
    .matrix-cell {
        border: 2px solid #000 !important;
    }
}
        /* для пдф */
    </style>
</head>
    </head>
    <body>
        <div class="container">
        <div class="header">
            <h1><i class="fas fa-calculator"></i> Матрица Судьбы Пифагора</h1>
            <div class="subtitle">Детальный анализ личности по дате рождения</div>
        </div>
            
            <!-- Вставляем все данные из $result_data -->
            <div class="date-info">
                <div class="date-item">
                    <div class="date-value"><?= $result_data['day'] ?></div>
                    <div class="date-label">День рождения</div>
                </div>
                <div class="date-item">
                    <div class="date-value"><?= $result_data['month'] ?></div>
                    <div class="date-label">Месяц рождения</div>
                </div>
                <div class="date-item">
                    <div class="date-value"><?= $result_data['year'] ?></div>
                    <div class="date-label">Год рождения</div>
                </div>
                <div class="date-item">
                    <div class="date-value"><?= date('d.m.Y', strtotime($result_data['birth_date'])) ?></div>
                    <div class="date-label">Полная дата</div>
                </div>
            </div>
            
            <!-- Рабочие числа -->
            <h2 class="matrix-title">Рабочие Числа</h2>
           
            <div class="working-numbers">
    <div class="number-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="number-value"><?= $result_data['working_numbers']['first'] ?></div>
        <div class="number-name">Первое рабочее число</div>
    </div>
    
    <div class="number-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
        <div class="number-value"><?= $result_data['working_numbers']['second'] ?></div>
        <div class="number-name">Второе рабочее число</div>
    </div>
    
    <div class="number-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
        <div class="number-value"><?= $result_data['working_numbers']['third'] ?></div>
        <div class="number-name">Третье рабочее число</div>
    </div>
    
    <div class="number-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
        <div class="number-value"><?= $result_data['working_numbers']['fourth'] ?></div>
        <div class="number-name">Четвёртое рабочее число</div>
    </div>
</div>
            
            <!-- Матрица -->
             <div class="matrix-section">
            <h2 class="matrix-title">Психоматрица Пифагора</h2>
            <div class="matrix-grid">
                <?php 
                $cellLabels = [
                    1 => 'Характер', 2 => 'Энергия', 3 => 'Интерес',
                    4 => 'Здоровье', 5 => 'Логика', 6 => 'Труд',
                    7 => 'Удача', 8 => 'Долг', 9 => 'Память'
                ];
                
                for($row = 0; $row < 3; $row++):
                    for($col = 0; $col < 3; $col++):
                        $number = $row * 3 + $col + 1;
                        $count = $result_data['matrix'][$number];
                ?>
                <div class="matrix-cell">
                    <div class="cell-label"><?= $cellLabels[$number] ?></div>
                    <div class="cell-number"><?= $number ?></div>
                    <div class="cell-count"><?= $count ?></div>
                </div>
                <?php endfor; endfor; ?>
            </div>
             </div>
            <!-- Интерпретации -->
            <h2 class="section-title">Основные Характеристики</h2>
            <?php foreach($result_data['interpretations'] as $interpretation): ?>
            <div class="quality-card">
                <?= strip_tags($interpretation, '<br><strong><span><em><i><b>') ?>
            </div>
            <?php endforeach; ?>
            
            <!-- Анализ линий -->
            <h2 class="section-title">Анализ Линий Матрицы</h2>
            <div class="lines-analysis">
            <?php foreach($result_data['lines_analysis'] as $line): ?>
            <div class="line-card">
                <?= strip_tags($line, '<div><h4><span><ul><li><strong><em><i>') ?>
            </div>
            <?php endforeach; ?>
            </div>
            <!-- анализ дополнительных чисел -->
         
            <h2 class="section-title">Анализ Дополнительных Чисел</h2>
            <div class="lines-analysis">
            <div class="line-card">
            <?php
            /* первое доп число */
                echo $result_data['DopAnal1'];
            ?>
            </div>
            <div class="line-card">
            <?php
            /* второе доп число */
                echo $result_data['DopAnal2'];
            ?>
            </div>
            <div class="line-card">
            <?php
            /* третье доп число */
                echo $result_data['DopAnal3'];
            ?>
            </div>
             <div class="line-card">
             <?php
            /* четвертое доп число */
                echo $result_data['DopAnal4'];
            ?>
            </div>
         </div>
         <!-- анализ дополнительных чисел -->
            <!-- Дополнительный анализ -->
<?php if(isset($result_data['additional_analysis']) && !empty($result_data['additional_analysis'])): ?>
<div class="additional-analysis">
    <h2 class="section-title"><i class="fas fa-search-plus">Дополнительный Анализ</h2>
    <div class="stats-grid">
        <?php foreach($result_data['additional_analysis'] as $item): ?>
        <div class="stat-card">
            <?php 
            echo $item;
            ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
<!-- ////////////////////////// -->
          <!-- скрипт для пдф -->
          <script>
            
function printToPDF() {
    // Скрываем кнопку перед печатью
    const buttons = document.querySelector('.action-buttons');
    if (buttons) buttons.style.display = 'none';
    
    // Запускаем печать
    window.print();
    
    // Возвращаем кнопку через секунду
    setTimeout(() => {
        if (buttons) buttons.style.display = 'flex';
    }, 1000);
}

// Добавляем инструкции
/*
document.addEventListener('DOMContentLoaded', function() {
    // Добавляем подсказку
    const container = document.querySelector('.container');
    if (container) {
        const hint = document.createElement('div');
        hint.innerHTML = `
            <div style="
                background: #f8f9fa;
                border: 2px dashed #3498db;
                border-radius: 10px;
                padding: 15px;
                margin: 20px 0;
                text-align: center;
                font-size: 14px;
                color: #2c3e50;
            ">
                <strong>💡 Как сохранить в PDF:</strong><br>
                1. Нажмите кнопку "Сохранить как PDF"<br>
                2. В диалоге печати выберите <strong>"Сохранить как PDF"</strong><br>
                3. Настройте поля страницы (10-15 мм)<br>
                4. Уберите верхние/нижние колонтитулы<br>
                5. Нажмите "Сохранить"
            </div>
        `;
        
        // Вставляем перед кнопками
        const actionButtons = document.querySelector('.action-buttons');
        if (actionButtons) {
            actionButtons.parentNode.insertBefore(hint, actionButtons);
        }
    }
});
*/

</script>
          <!-- скрипт для пдф -->
 <!-- //////////////////////// -->
<!-- Кнопки действий -->
        <div class="action-buttons">
            <!-- <a href="tabl-pif.php" class="btn btn-primary">
                <i class="fas fa-redo"></i> Новый расчет
            </a> -->
            <button onclick="printToPDF()" class="btn btn-pdf">
                <i class="fas fa-download"></i> Сохранить PDF
            </button>
        </div>
        <!-- Кнопки действий -->

            <!-- Футер -->
            <div class="footer">
                <p>Расчет выполнен: <?= $result_data['calculated_at'] ?></p>
                <p>© <?= date('Y') ?> Матрица Судьбы Пифагора</p>
            </div>
        </div>
    </body>
    </html>
    <?php
    return ob_get_clean();
}
///////////////////для формирования файла(платный отчет);

//////////////////////////////////////////////////////////
?>
