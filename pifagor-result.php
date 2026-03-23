<?php
session_start();
include '../app/include/config.php';
include '../app/include/functions-adm.php';
//include '../app/controllers/PifagorController.php';
// Проверяем, есть ли результаты в сессии
if(!isset($_SESSION['pythagoras_result'])) {
    header('Location: pythagoras-form.php');
    exit;
}

$result = $_SESSION['pythagoras_result'];
$matrix = $result['matrix'];
//tt($_SESSION['report_filename']);

// Подготовим данные для JavaScript
$js_result = json_encode($result);
$js_matrix = json_encode($matrix);
$js_birth_date = json_encode($result['birth_date']);
$js_birth_date_formatted = json_encode(str_replace('-', '', $result['birth_date']));
// tt($result);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Матрица Судьбы Пифагора - Результаты</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            padding: 30px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #3498db;
        }
        
        .header h1 {
            color: #2c3e50;
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .header .subtitle {
            color: #7f8c8d;
            font-size: 1.2em;
        }
        
        .date-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .date-item {
            text-align: center;
            flex: 1;
            min-width: 150px;
        }
        
        .date-value {
            font-size: 2em;
            font-weight: bold;
            color: #3498db;
        }
        
        .date-label {
            color: #7f8c8d;
            font-size: 0.9em;
            margin-top: 5px;
        }
        
        .working-numbers {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .number-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        
        .number-value {
            font-size: 3em;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .number-name {
            font-size: 1em;
            opacity: 0.9;
        }
        
        .matrix-section {
            margin: 40px 0;
        }
        
        .matrix-title {
            text-align: center;
            font-size: 1.8em;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        
        .matrix-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .matrix-cell {
            aspect-ratio: 1;
            background: white;
            border: 3px solid #3498db;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 1.8em;
            font-weight: bold;
            color: #2c3e50;
            position: relative;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.2);
            transition: transform 0.3s ease;
        }
        
        .matrix-cell:hover {
            transform: scale(1.05);
        }
        
        .cell-number {
            font-size: 2.5em;
        }
        
        .cell-count {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: #3498db;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8em;
        }
        
        .cell-label {
            position: absolute;
            top: 5px;
            left: 5px;
            font-size: 0.8em;
            color: #7f8c8d;
        }
        
        .interpretations {
            margin: 40px 0;
        }
        
        .section-title {
            background: #2c3e50;
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 1.4em;
        }
        
        .quality-card {
            background: white;
            border-left: 5px solid #3498db;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 0 10px 10px 0;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .quality-card:hover {
            transform: translateX(5px);
        }
        
        .lines-analysis {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        
        .line-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
        }
        
        .line-card h4 {
            color: #2c3e50;
            margin-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }
        /* анализ дополнительных чисел */
        .dop-num-analiz{
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            margin-top: 40px;

        }
        /* анализ дополнительных чисел */
        
        .additional-analysis {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            margin-top: 40px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .stat-value {
            font-size: 2.5em;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 10px;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1em;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }
        
        .btn-secondary {
            background: #95a5a6;
            color: white;
        }
        
        .btn-pdf {
            background: #a69f95;
            color: white;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(0,0,0,0.2);
        }
        
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #7f8c8d;
            font-size: 0.9em;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .header h1 {
                font-size: 1.8em;
            }
            
            .matrix-grid {
                gap: 10px;
            }
            
            .matrix-cell {
                font-size: 1.5em;
            }
            
            .date-info {
                flex-direction: column;
                align-items: center;
            }
        }
        
        /* Цвета для разных уровней характеристик */
        .level-weak { color: #e74c3c; }
        .level-medium { color: #f39c12; }
        .level-good { color: #2ecc71; }
        .level-strong { color: #3498db; }
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
            }
            
            .container {
                max-width: 100% !important;
                box-shadow: none !important;
                border: none !important;
                padding: 10px !important;
                margin: 0 !important;
            }
            
            .header h1 {
                color: black !important;
                font-size: 24px !important;
            }
            
            .matrix-cell {
                border: 2px solid black !important;
                box-shadow: none !important;
            }
            
            .number-card, 
            .quality-card, 
            .line-card, 
            .stat-card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
                margin-bottom: 15px !important;
                page-break-inside: avoid;
            }
            
            .date-info {
                border: 1px solid #ccc !important;
            }
            
            /* Улучшаем читаемость при печати */
            h1, h2, h3, h4 {
                color: black !important;
            }
            
            /* Убираем градиенты */
            .number-card {
                background: #f0f0f0 !important;
                color: black !important;
            }
            
            /* Делаем ссылки черными */
            a {
                color: black !important;
                text-decoration: underline !important;
            }
        }
        
        /* Стили для уведомлений */
        .loading-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(52, 152, 219, 0.95);
            color: white;
            padding: 25px 40px;
            border-radius: 15px;
            z-index: 99999;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            text-align: center;
            min-width: 300px;
            display: none;
        }
        
        .success-message {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #2ecc71;
            color: white;
            padding: 20px 25px;
            border-radius: 10px;
            z-index: 10000;
            font-size: 16px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease;
            display: none;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    ссылка: <a href="<?php echo ABS_PATH.'results/'.$_SESSION['report_filename'];?>" target="_blank">
        <?php echo ABS_PATH.'results/'.$_SESSION['report_filename'];?>
</a>
    <div class="container">
        <!-- Заголовок -->
        <div class="header">
            <?php
           // tt($result);
            //tt($Pifagor);
            ?>
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
                
                for($row = 0; $row < 3; $row++):
                    for($col = 0; $col < 3; $col++):
                        $number = $row * 3 + $col + 1;
                        $count = $matrix[$number];
                ?>
                <div class="matrix-cell">
                    <div class="cell-label"><?= $cellLabels[$number] ?></div>
                    <div class="cell-number"><?= $number ?></div>
                    <div class="cell-count"><?= $count ?></div>
                </div>
                <?php endfor; endfor; ?>
            </div>
        </div>
        
        <!-- Основные характеристики -->
        <div class="interpretations">
            <h2 class="section-title"><i class="fas fa-chart-bar"></i> Основные Характеристики Личности</h2>
            <?php foreach($result['interpretations'] as $interpretation): ?>
            <div class="quality-card">
                <?= $interpretation ?>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Анализ линий матрица -->
        <h2 class="section-title"><i class="fas fa-project-diagram"></i> Анализ Линий Матрицы</h2>
        <div class="lines-analysis">
            <?php foreach($result['lines_analysis'] as $line): ?>
            <div class="line-card">
                <?= $line ?>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- анализ дополнительных чисел -->
       
            <h2 class="section-title"  style="background: #29b791;"><i class="fa-solid fa-dungeon"></i>Анализ Дополнительных Чисел</h2>
                <div class="lines-analysis">
                    <!-- 1 рабочее число -->
                     <div class="line-card">
                        <?php 
                        //echo AnalDopNum1($firstNumber);
                        echo $result['DopAnal1']; 
                        ?>
                     </div>
                     <!-- 1 рабочее число -->
                     <!-- 2 рабочее число -->
                      <div class="line-card">
                        <?php 
                        //echo AnalDopNum1($firstNumber);
                        echo $result['DopAnal2']; 
                        ?>
                     </div>
                     <!-- 2 рабочее число -->
                      <!-- 3 рабочее число -->
                      <div class="line-card">
                        <?php 
                        //echo AnalDopNum1($firstNumber);
                        echo $result['DopAnal3']; 
                        ?>
                     </div>
                     <!-- 3 рабочее число -->
                      <!-- 4 рабочее число -->
                      <div class="line-card">
                        <?php 
                        //echo AnalDopNum1($firstNumber);
                        echo $result['DopAnal4']; 
                        ?>
                     </div>
                     <!-- 4 рабочее число -->
                </div>

         <!-- анализ дополнительных чисел -->
        
        <!-- Дополнительный анализ -->
        <?php if(isset($result['additional_analysis'])): ?>
        <div class="additional-analysis">
            <h2 class="section-title" style="background: #9b59b6;"><i class="fas fa-search-plus"></i> Дополнительный Анализ</h2>
            <div class="stats-grid">
                <?php foreach($result['additional_analysis'] as $item): ?>
                <div class="stat-card">
                    <?= $item ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Кнопки действий -->
        <div class="action-buttons">
            <a href="tabl-pif.php" class="btn btn-primary">
                <i class="fas fa-redo"></i> Новый расчет
            </a>
            <!-- <button onclick="window.print()" class="btn btn-secondary">
                <i class="fas fa-print"></i> Распечатать
            </button> -->
            <button onclick="saveAsPDF()" class="btn btn-pdf">
                <i class="fas fa-download"></i> Сохранить PDF
            </button>
            <button onclick="savePageAsHTML()" class="btn btn-pdf">
                <i class="fa-brands fa-html5"></i> Сохранить HTML
            </button>
        </div>
        <!-- Кнопки действий -->
        <!-- Футер -->
        <div class="footer">
            <p><i class="far fa-clock"></i> Расчет выполнен: <?= $result['calculated_at'] ?></p>
            <p>© <?= date('Y') ?> Матрица Судьбы Пифагора | Профессиональный нумерологический анализ</p>
        </div>
    </div>
    
    <!-- Элементы для уведомлений -->
    <div id="loading-message" class="loading-message"></div>
    <div id="success-message" class="success-message"></div>
    
    <script>
        ///////////////////////////сохраняем в пдф
        // Вспомогательные функции для уведомлений
        function showLoadingMessage(text = 'Подготовка документа...') {
            const loader = document.getElementById('loading-message');
            loader.innerHTML = `
                <div style="margin-bottom: 15px; font-size: 24px;">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <div>${text}</div>
            `;
            loader.style.display = 'block';
        }
        
        function hideLoadingMessage() {
            const loader = document.getElementById('loading-message');
            loader.style.display = 'none';
        }
        
        function showSuccessMessage(text) {
            const message = document.getElementById('success-message');
            message.innerHTML = `
                <i class="fas fa-check-circle" style="font-size: 20px;"></i>
                <div>${text}</div>
            `;
            message.style.display = 'flex';
            
            setTimeout(() => {
                message.style.opacity = '0';
                message.style.transition = 'opacity 0.5s';
                setTimeout(() => {
                    message.style.display = 'none';
                    message.style.opacity = '1';
                }, 500);
            }, 3000);
        }
        
        // Упрощенная функция сохранения в PDF
        function saveAsPDF() {
            showLoadingMessage('Подготовка к печати...');
            
            // Получаем данные из PHP
            const result = <?= $js_result ?>;
            const matrix = <?= $js_matrix ?>;
            
            // Создаем контент для печати
            const printContent = createPrintContent(result, matrix);
            
            // Открываем новое окно
            const printWindow = window.open('', '_blank');
            
            // Записываем контент в новое окно
            printWindow.document.open();
            printWindow.document.write(printContent);
            printWindow.document.close();
            
            // Ждем загрузки и запускаем печать
            printWindow.onload = function() {
                setTimeout(() => {
                    printWindow.print();
                    
                    // Закрываем уведомление
                    hideLoadingMessage();
                    showSuccessMessage('Откройте окно печати и выберите "Сохранить как PDF"');
                    
                    // Закрываем окно через некоторое время
                    setTimeout(() => {
                        printWindow.close();
                    }, 1000);
                }, 1000);
            };
        }
        
        // Функция создания контента для печати
        function createPrintContent(result, matrix) {
            // Создаем чистые текстовые версии интерпретаций
            const cleanInterpretations = result.interpretations.map(text => 
                text.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim()
            );
            
            const cleanLines = result.lines_analysis ? result.lines_analysis.map(text => 
                text.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim()
            ) : [];
            
            const cleanAdditional = result.additional_analysis ? result.additional_analysis.map(text => 
                text.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim()
            ) : [];
            
            const cellNames = {
                1: 'Характер', 2: 'Энергия', 3: 'Интерес',
                4: 'Здоровье', 5: 'Логика', 6: 'Труд',
                7: 'Удача', 8: 'Долг', 9: 'Память'
            };
            
            return `
                <!DOCTYPE html>
                <html lang="ru">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Матрица Пифагора</title>
                    <style>
                        @page {
                            size: A4;
                            margin: 15mm;
                        }
                        
                        body {
                            font-family: Arial, sans-serif;
                            line-height: 1.4;
                            color: #000;
                            background: #fff;
                            padding: 15mm;
                            margin: 0;
                            font-size: 12px;
                        }
                        
                        .print-container {
                            max-width: 100%;
                        }
                        
                        h1 {
                            text-align: center;
                            color: #000;
                            border-bottom: 2px solid #000;
                            padding-bottom: 10px;
                            margin-bottom: 20px;
                            font-size: 20px;
                        }
                        
                        h2 {
                            color: #000;
                            margin: 15px 0 10px 0;
                            font-size: 16px;
                        }
                        
                        .section {
                            margin: 15px 0;
                            page-break-inside: avoid;
                        }
                        
                        .section-title {
                            background: #f0f0f0;
                            color: #000;
                            padding: 8px 10px;
                            margin: 15px 0 8px 0;
                            border-radius: 3px;
                            border-left: 4px solid #3498db;
                            font-weight: bold;
                        }
                        
                        .date-info {
                            display: flex;
                            justify-content: space-around;
                            background: #f8f9fa;
                            padding: 10px;
                            border-radius: 5px;
                            margin: 15px 0;
                            border: 1px solid #ddd;
                        }
                        
                        .date-item {
                            text-align: center;
                        }
                        
                        .date-value {
                            font-size: 16px;
                            font-weight: bold;
                            color: #000;
                        }
                        
                        .working-numbers {
                            display: grid;
                            grid-template-columns: repeat(2, 1fr);
                            gap: 8px;
                            margin: 15px 0;
                        }
                        
                        .number-card {
                            background: #f0f0f0;
                            border: 1px solid #ccc;
                            padding: 10px;
                            border-radius: 5px;
                            text-align: center;
                        }
                        
                        .number-value {
                            font-size: 18px;
                            font-weight: bold;
                            color: #000;
                        }
                        
                        .matrix-grid {
                            display: grid;
                            grid-template-columns: repeat(3, 1fr);
                            gap: 8px;
                            max-width: 180px;
                            margin: 15px auto;
                        }
                        
                        .matrix-cell {
                            border: 2px solid #000;
                            aspect-ratio: 1;
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                            font-weight: bold;
                            font-size: 14px;
                        }
                        
                        .quality-item {
                            border-left: 3px solid #3498db;
                            padding: 8px 10px;
                            margin: 8px 0;
                            background: #f8f9fa;
                            border-radius: 0 3px 3px 0;
                        }
                        
                        .line-item {
                            border: 1px solid #ddd;
                            padding: 10px;
                            margin: 8px 0;
                            border-radius: 3px;
                            background: #fafafa;
                        }
                        
                        .footer {
                            margin-top: 25px;
                            padding-top: 10px;
                            border-top: 1px solid #ddd;
                            text-align: center;
                            font-size: 10px;
                            color: #666;
                        }
                        
                        .page-break {
                            page-break-after: always;
                        }
                        
                        @media print {
                            // body {
                            //     -webkit-print-color-adjust: exact;
                            //     print-color-adjust: exact;
                            //     font-size: 11px;
                            // }
                             @page {
    //     margin: 0 0 0 0;
    //     //padding: 1rem 0 1rem 0;
    // }
     size: A4;
    margin: 20mm 15mm; /* Отступы для ВСЕХ страниц */
    
    /* Убираем URL */
    @top-left { content: none; }
    @top-center { content: none; }
    @top-right { content: none; }
    @bottom-left { content: none; }
    @bottom-center { content: none; }
    @bottom-right { content: none; }
                }
    
    body {
        /* Убираем все системные заголовки браузера */
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    
    /* Прячем элементы, которые браузер может добавлять */
    header, footer, .page-title, .url-print {
        display: none !important;
    }
    
    /* Альтернативный способ */
    body::before,
    body::after {
        display: none !important;
        content: none !important;
    }
                        }
                    </style>
                </head>
                <body>
                    <div class="print-container">
                        <h1>Матрица Судьбы Пифагора</h1>
                        
                        <div class="section">
                            <div class="date-info">
                                <div class="date-item">
                                    <div class="date-value">${formatDate(result.birth_date)}</div>
                                    <div>Дата рождения</div>
                                </div>
                                <div class="date-item">
                                    <div class="date-value">${result.calculated_at}</div>
                                    <div>Дата расчета</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section">
                            <div class="section-title">Рабочие числа</div>
                            <div class="working-numbers">
                                <div class="number-card">
                                    <div class="number-value">${result.working_numbers.first}</div>
                                    <div>Первое число</div>
                                </div>
                                <div class="number-card">
                                    <div class="number-value">${result.working_numbers.second}</div>
                                    <div>Второе число</div>
                                </div>
                                <div class="number-card">
                                    <div class="number-value">${result.working_numbers.third}</div>
                                    <div>Третье число</div>
                                </div>
                                <div class="number-card">
                                    <div class="number-value">${result.working_numbers.fourth}</div>
                                    <div>Четвертое число</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section">
                            <div class="section-title">Матрица Пифагора</div>
                            <div class="matrix-grid">
                                ${Array.from({length: 9}, (_, i) => i + 1).map(num => `
                                    <div class="matrix-cell">
                                        <div>${num}</div>
                                        <small>${cellNames[num]}</small>
                                        <small>(${matrix[num]})</small>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                        
                        <div class="page-break"></div>
                        
                        <div class="section">
                            <div class="section-title">Основные характеристики</div>
                            ${cleanInterpretations.slice(0, 5).map(text => `
                                <div class="quality-item">${text}</div>
                            `).join('')}
                        </div>
                        
                        ${cleanInterpretations.length > 5 ? `
                            <div class="section">
                                <div class="section-title">Дополнительные характеристики</div>
                                ${cleanInterpretations.slice(5, 9).map(text => `
                                    <div class="quality-item">${text}</div>
                                `).join('')}
                            </div>
                        ` : ''}
                        
                        ${cleanLines.length > 0 ? `
                            <div class="section">
                                <div class="section-title">Анализ линий матрицы</div>
                                ${cleanLines.slice(0, 3).map(text => `
                                    <div class="line-item">${text}</div>
                                `).join('')}
                            </div>
                        ` : ''}
                        
                        ${cleanAdditional.length > 0 ? `
                            <div class="section">
                                <div class="section-title">Дополнительный анализ</div>
                                ${cleanAdditional.slice(0, 3).map(text => `
                                    <div class="line-item">${text}</div>
                                `).join('')}
                            </div>
                        ` : ''}
                        
                        <div class="footer">
                            <p>Расчет выполнен: ${result.calculated_at}</p>
                            <p>© Матрица Судьбы Пифагора</p>
                        </div>
                    </div>
                    
                    <script>
                        // Автоматическая печать при загрузке
                        window.onload = function() {
                            setTimeout(() => {
                                window.print();
                            }, 500);
                        };
                        
                        function formatDate(dateString) {
                            const date = new Date(dateString);
                            return date.toLocaleDateString('ru-RU');
                        }
                    <\/script>
                </body>
                </html>
            `;
        }
        
        // Форматирование даты
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('ru-RU');
        }
        
        // Плавная прокрутка при загрузке
        document.addEventListener('DOMContentLoaded', function() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        });
    ///////////////////////////сохраняем в пдф
    //////////////////////////////сохраняем в html
    function savePageAsHTML() {

      // Находим блок с кнопками
    const actionButtons = document.querySelector('.action-buttons');
    
    // Сохраняем исходный display стиль
    let originalDisplay = null;
    
    if (actionButtons) {
        originalDisplay = actionButtons.style.display;
        actionButtons.style.display = 'none'; // Скрываем
    }
    // Получаем весь HTML страницы
    const htmlContent = document.documentElement.outerHTML;
    
    // Создаем Blob (бинарный объект) с HTML
    const blob = new Blob([htmlContent], { type: 'text/html' });
    
    // Создаем временную ссылку для скачивания
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    
    // Формируем имя файла с датой
    const date = new Date().toISOString().split('T')[0];
    const filename = `нумерология_отчет_${date}.html`;
    
    // Настраиваем ссылку
    a.href = url;
    a.download = filename;
    
    // Эмулируем клик для скачивания
    document.body.appendChild(a);
    a.click();
    
    // Убираем ссылку из DOM
    document.body.removeChild(a);
    
    // Освобождаем память
    URL.revokeObjectURL(url);
    
    return filename;
}
    //////////////////////////////сохраняем в html

    </script>
    <?
    unset($_SESSION['pythagoras_result']);
    ?>
</body>
</html>
