function generateFioReportHTML($result_data, $email = '') {
    $numbers = $result_data['numbers'];
    $interpretations = $result_data['interpretations'];
    $total = $result_data['total'] ?? [];
    $spectrum = $result_data['spectrum'] ?? [];
    $subconscious = $result_data['subconscious'] ?? [];
    $dynamics = $result_data['dynamics'] ?? [];
    $corrections = $result_data['corrections'] ?? [];
    $destiny = $result_data['destiny'] ?? [];
    $hiddenPotential = $result_data['hidden_potential'] ?? [];
    $additional = $result_data['additional'] ?? [];
    $combination = $result_data['combination'] ?? null;
    $additionalCombinations = $result_data['additional_combinations'] ?? [];
    
    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Нумерологический отчет по ФИО - <?= htmlspecialchars($result_data['fullname'] ?? '') ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                line-height: 1.6;
                color: #333;
                background: #fff;
                padding: 20px;
            }
            .container {
                max-width: 1200px;
                margin: 0 auto;
                background: white;
                border-radius: 20px;
                padding: 30px;
                box-shadow: 0 0 20px rgba(0,0,0,0.1);
            }
            .header {
                text-align: center;
                margin-bottom: 40px;
                padding-bottom: 20px;
                border-bottom: 2px solid #9b59b6;
            }
            .header h1 { color: #2c3e50; font-size: 2em; margin-bottom: 10px; }
            .subtitle { color: #7f8c8d; font-size: 1.1em; }
            .date-info {
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 20px;
                background: #f8f9fa;
                padding: 20px;
                border-radius: 10px;
                margin-bottom: 30px;
            }
            .date-item { text-align: center; flex: 1; min-width: 150px; }
            .date-value { font-size: 1.8em; font-weight: bold; color: #9b59b6; }
            .date-label { color: #7f8c8d; font-size: 0.9em; margin-top: 5px; }
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
            .number-value { font-size: 2.5em; font-weight: bold; }
            .number-name { font-size: 1em; opacity: 0.9; margin-top: 5px; }
            .matrix-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
                max-width: 400px;
                margin: 20px auto;
            }
            .matrix-cell {
                border: 2px solid #9b59b6;
                border-radius: 10px;
                padding: 15px;
                text-align: center;
                background: white;
            }
            .matrix-cell .number { font-size: 2em; font-weight: bold; color: #9b59b6; }
            .section-title {
                background: #2c3e50;
                color: white;
                padding: 12px 20px;
                border-radius: 10px;
                margin: 30px 0 20px;
                font-size: 1.3em;
            }
            .section-title.purple { background: #9b59b6; }
            .quality-card {
                border-left: 4px solid #9b59b6;
                padding: 15px 20px;
                margin: 15px 0;
                background: #f8f9fa;
                border-radius: 0 10px 10px 0;
            }
            .quality-title { font-size: 1.2em; font-weight: bold; color: #2c3e50; margin-bottom: 8px; }
            .quality-text { color: #555; line-height: 1.5; }
            .additional-analysis {
                background: #f8f9fa;
                padding: 20px;
                border-radius: 15px;
                margin: 20px 0;
            }
            .stats-grid {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin: 15px 0;
                justify-content: center;
            }
            .stat-number {
                text-align: center;
                width: 55px;
                padding: 8px;
                background: white;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            }
            .stat-number .count { font-size: 1.5em; font-weight: bold; color: #9b59b6; }
            
            /* Кнопка PDF */
            .pdf-button {
                display: inline-block;
                background: #9b59b6;
                color: white;
                padding: 12px 25px;
                border-radius: 50px;
                text-decoration: none;
                font-size: 16px;
                font-weight: bold;
                margin: 20px auto;
                cursor: pointer;
                border: none;
                transition: 0.3s;
                font-family: inherit;
            }
            .pdf-button:hover {
                background: #8e44ad;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(155, 89, 182, 0.3);
            }
            .pdf-button i {
                margin-right: 8px;
            }
            
            .footer {
                text-align: center;
                margin-top: 40px;
                padding-top: 20px;
                border-top: 1px solid #e0e0e0;
                color: #7f8c8d;
                font-size: 0.85em;
            }
          /* для пдф */
        @media print {
             /*убираем колонтитулы в пдф*/
         @page {
        margin: .5cm; /* Увеличиваем поля, чтобы URL не влезал */
        size: A4;
       }
        
        /* Вариант 1: Пытаемся скрыть через пустой контент (работает не во всех браузерах) */
        @top-center {
            content: "";
        }
        
        @bottom-center {
            content: "";
        }
    }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1><i class="fas fa-font"></i> 🔮 Нумерологический отчет по ФИО</h1>
                <div class="subtitle">Детальный анализ личности по полному имени</div>
                <?php if($email): ?>
                <div style="margin-top: 10px; color: #666;">Отчет для: <?= htmlspecialchars($email) ?></div>
                <?php endif; ?>
            </div>
            
            <!-- Информация о ФИО -->
            <div class="date-info">
                <div class="date-item">
                    <div class="date-value"><?= htmlspecialchars($result_data['famely'] ?? '') ?></div>
                    <div class="date-label">Фамилия</div>
                </div>
                <div class="date-item">
                    <div class="date-value"><?= htmlspecialchars($result_data['firstname'] ?? '') ?></div>
                    <div class="date-label">Имя</div>
                </div>
                <div class="date-item">
                    <div class="date-value"><?= htmlspecialchars($result_data['lastname'] ?? '') ?></div>
                    <div class="date-label">Отчество</div>
                </div>
                <div class="date-item">
                    <div class="date-value"><?= htmlspecialchars($result_data['fullname'] ?? '') ?></div>
                    <div class="date-label">Полное имя</div>
                </div>
            </div>
            
            <!-- Ключевые числа -->
            <div class="working-numbers">
                <div class="number-card">
                    <div class="number-value"><?= $numbers['name'] ?></div>
                    <div class="number-name">Число имени</div>
                    <div class="number-desc" style="font-size: 0.8em; opacity: 0.8;">Характер, таланты</div>
                </div>
                <div class="number-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <div class="number-value"><?= $numbers['soul'] ?></div>
                    <div class="number-name">Число души</div>
                    <div class="number-desc" style="font-size: 0.8em; opacity: 0.8;">Желания, мотивация</div>
                </div>
                <div class="number-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <div class="number-value"><?= $numbers['personality'] ?></div>
                    <div class="number-name">Число личности</div>
                    <div class="number-desc" style="font-size: 0.8em; opacity: 0.8;">Как видят другие</div>
                </div>
                <div class="number-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                    <div class="number-value"><?= $numbers['karmic'] ?></div>
                    <div class="number-name">Кармическое число</div>
                    <div class="number-desc" style="font-size: 0.8em; opacity: 0.8;">Задачи души</div>
                </div>
            </div>
            
            <!-- Нумерологический код -->
            <div class="matrix-grid">
                <div class="matrix-cell"><div class="number"><?= $numbers['name'] ?></div><div>Число имени</div></div>
                <div class="matrix-cell"><div class="number"><?= $numbers['soul'] ?></div><div>Число души</div></div>
                <div class="matrix-cell"><div class="number"><?= $numbers['personality'] ?></div><div>Число личности</div></div>
                <div class="matrix-cell"><div class="number"><?= $numbers['karmic'] ?></div><div>Кармическое число</div></div>
            </div>
            
            <!-- Усиленный архетип -->
            <?php if($combination): ?>
            <div class="additional-analysis">
                <h2 class="section-title purple">✨ Усиленный архетип</h2>
                <div class="quality-card">
                    <div class="quality-title"><?= htmlspecialchars($combination['title']) ?></div>
                    <div class="quality-text"><?= nl2br(htmlspecialchars($combination['description'] ?? '')) ?></div>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Совпадения чисел -->
            <?php if(!empty($additionalCombinations)): ?>
            <div class="additional-analysis">
                <h2 class="section-title purple">🤝 Совпадения чисел</h2>
                <?php foreach($additionalCombinations as $comb): ?>
                <div class="quality-card">
                    <div class="quality-title"><?= htmlspecialchars($comb['type']) ?></div>
                    <div class="quality-text"><?= nl2br(htmlspecialchars($comb['text'])) ?></div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <!-- Число имени -->
            <div class="quality-card">
                <div class="quality-title">Число имени (<?= $numbers['name'] ?>) — <?= htmlspecialchars($interpretations['name']['title'] ?? '') ?></div>
                <div class="quality-text"><?= nl2br(htmlspecialchars($interpretations['name']['essence'] ?? '')) ?></div>
                <?php if(!empty($interpretations['name']['strengths'])): ?>
                <div class="quality-text" style="margin-top: 10px;"><strong>💪 Сильные стороны:</strong> <?= nl2br(htmlspecialchars($interpretations['name']['strengths'])) ?></div>
                <?php endif; ?>
                <?php if(!empty($interpretations['name']['weaknesses'])): ?>
                <div class="quality-text"><strong>⚠️ Слабые стороны:</strong> <?= nl2br(htmlspecialchars($interpretations['name']['weaknesses'])) ?></div>
                <?php endif; ?>
                <?php if(!empty($interpretations['name']['mission'])): ?>
                <div class="quality-text"><strong>🎯 Миссия:</strong> <?= nl2br(htmlspecialchars($interpretations['name']['mission'])) ?></div>
                <?php endif; ?>
            </div>
            
            <!-- Число души -->
            <div class="quality-card">
                <div class="quality-title">Число души (<?= $numbers['soul'] ?>) — <?= htmlspecialchars($interpretations['soul']['title'] ?? '') ?></div>
                <div class="quality-text"><?= nl2br(htmlspecialchars($interpretations['soul']['essence'] ?? '')) ?></div>
                <?php if(!empty($interpretations['soul']['desires'])): ?>
                <div class="quality-text"><strong>💭 Желания:</strong> <?= nl2br(htmlspecialchars($interpretations['soul']['desires'])) ?></div>
                <?php endif; ?>
                <?php if(!empty($interpretations['soul']['fears'])): ?>
                <div class="quality-text"><strong>😟 Страхи:</strong> <?= nl2br(htmlspecialchars($interpretations['soul']['fears'])) ?></div>
                <?php endif; ?>
            </div>
            
            <!-- Число личности -->
            <div class="quality-card">
                <div class="quality-title">Число личности (<?= $numbers['personality'] ?>) — <?= htmlspecialchars($interpretations['personality']['title'] ?? '') ?></div>
                <div class="quality-text"><?= nl2br(htmlspecialchars($interpretations['personality']['essence'] ?? '')) ?></div>
                <?php if(!empty($interpretations['personality']['image'])): ?>
                <div class="quality-text"><strong>🎭 Образ:</strong> <?= nl2br(htmlspecialchars($interpretations['personality']['image'])) ?></div>
                <?php endif; ?>
            </div>
            
            <!-- Кармическое число -->
            <div class="quality-card">
                <div class="quality-title">Кармическое число (<?= $numbers['karmic'] ?>) — <?= htmlspecialchars($interpretations['karmic']['title'] ?? '') ?></div>
                <div class="quality-text"><?= nl2br(htmlspecialchars($interpretations['karmic']['essence'] ?? '')) ?></div>
                <?php if(!empty($interpretations['karmic']['tasks'])): ?>
                <div class="quality-text"><strong>📜 Задачи:</strong>
                    <ul style="margin-top: 5px; margin-left: 20px;">
                        <?php foreach($interpretations['karmic']['tasks'] as $task): ?>
                        <li><?= nl2br(htmlspecialchars($task)) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php if(!empty($interpretations['karmic']['lesson'])): ?>
                <div class="quality-text"><strong>📖 Главный урок:</strong> <?= nl2br(htmlspecialchars($interpretations['karmic']['lesson'])) ?></div>
                <?php endif; ?>
            </div>
            
            <!-- Общий потенциал -->
            <?php if(!empty($total)): ?>
            <div class="additional-analysis">
                <h2 class="section-title purple">⭐ Общий энергетический потенциал</h2>
                <div class="quality-card">
                    <div class="quality-title">Число <?= $total['value'] ?> — <?= htmlspecialchars($total['title'] ?? '') ?></div>
                    <div class="quality-text"><?= nl2br(htmlspecialchars($total['short'] ?? '')) ?></div>
                    <div class="quality-text"><?= nl2br(htmlspecialchars($total['full'] ?? '')) ?></div>
                    <?php if(!empty($total['advice'])): ?>
                    <div class="quality-text"><strong>💡 Совет:</strong> <?= nl2br(htmlspecialchars($total['advice'])) ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Спектр имени -->
            <?php if(!empty($spectrum)): ?>
            <div class="additional-analysis">
                <h2 class="section-title purple">📊 Спектр имени</h2>
                <div class="stats-grid">
                    <?php for($i = 1; $i <= 9; $i++): ?>
                    <div class="stat-number">
                        <div class="count"><?= $spectrum['counts'][$i] ?? 0 ?></div>
                        <div>число <?= $i ?></div>
                    </div>
                    <?php endfor; ?>
                </div>
                <div class="quality-text"><?= htmlspecialchars($spectrum['dominant_text'] ?? '') ?></div>
                <div class="quality-text"><?= htmlspecialchars($spectrum['missing_text'] ?? '') ?></div>
                <div class="quality-text"><?= htmlspecialchars($spectrum['balance'] ?? '') ?></div>
            </div>
            <?php endif; ?>
            
            <!-- Число подсознания -->
            <?php if(!empty($subconscious)): ?>
            <div class="additional-analysis">
                <h2 class="section-title purple">🧠 Число подсознания</h2>
                <div class="quality-card">
                    <div class="quality-title">Число <?= $subconscious['number'] ?></div>
                    <div class="quality-text"><?= nl2br(htmlspecialchars($subconscious['meaning'] ?? '')) ?></div>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Динамика имени -->
            <?php if(!empty($dynamics['analysis'])): ?>
            <div class="additional-analysis">
                <h2 class="section-title purple">📈 Динамика имени</h2>
                <div class="quality-card">
                    <div class="quality-text"><strong>Последовательность чисел:</strong> <?= implode(' → ', $dynamics['sequence'] ?? []) ?></div>
                    <?php foreach($dynamics['analysis'] as $item): ?>
                    <div class="quality-text">📌 <?= htmlspecialchars($item) ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Коррекция имени -->
            <?php if(!empty($corrections)): ?>
            <div class="additional-analysis">
                <h2 class="section-title purple">✍️ Коррекция имени</h2>
                <div class="quality-card">
                    <?php foreach($corrections as $correction): ?>
                    <div class="quality-text">✍️ <?= nl2br(htmlspecialchars($correction)) ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Число судьбы -->
            <?php if(!empty($destiny)): ?>
            <div class="additional-analysis">
                <h2 class="section-title purple">🛣️ Число судьбы</h2>
                <div class="quality-card">
                    <div class="quality-title">Число <?= $destiny['number'] ?></div>
                    <div class="quality-text"><?= nl2br(htmlspecialchars($destiny['meaning'] ?? '')) ?></div>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Скрытый потенциал -->
            <?php if(!empty($hiddenPotential)): ?>
            <div class="additional-analysis">
                <h2 class="section-title purple">💎 Скрытый потенциал</h2>
                <div class="quality-card">
                    <div class="quality-title">Число <?= $hiddenPotential['number'] ?></div>
                    <div class="quality-text"><?= nl2br(htmlspecialchars($hiddenPotential['meaning'] ?? '')) ?></div>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Дополнительный анализ -->
            <?php if(!empty($additional)): ?>
            <div class="additional-analysis">
                <h2 class="section-title purple">📌 Дополнительный анализ</h2>
                <div class="quality-card">
                    <?php foreach($additional as $item): ?>
                    <div class="quality-text">📌 <?= nl2br(htmlspecialchars($item)) ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Кнопка для сохранения в PDF -->
            <div style="text-align: center; margin: 30px 0;">
                <button onclick="window.print();" class="pdf-button">
                    <i class="fas fa-file-pdf"></i> Сохранить как PDF
                </button>
            </div>
            
            <div class="footer">
                <p><i class="far fa-clock"></i> Расчет выполнен: <?= $result_data['calculated_at'] ?? date('d.m.Y H:i:s') ?></p>
                <p>© <?= date('Y') ?> Нумерология ФИО | Профессиональный нумерологический анализ</p>
                <p>Отчет сгенерирован автоматически</p>
            </div>
        </div>
        
        <script>
            // Добавляем обработку перед печатью
            window.onbeforeprint = function() {
                // Можно добавить любые действия перед печатью, если нужно
                console.log('Подготовка к печати...');
            };
        </script>
    </body>
    </html>
    <?php
    return ob_get_clean();

}
