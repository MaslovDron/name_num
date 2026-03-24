interpretations['combinations'] = [
    '1_1' => [
        'title' => 'Усиленная Единица — Абсолютный Лидер',
        'description' => 'Когда число имени и души совпадают (оба 1), лидерские качества удваиваются. Человек — "лидер до мозга костей".'
    ],
    '2_2' => [
        'title' => 'Усиленная Двойка — Абсолютный Эмпат',
        'description' => 'Очень чувствительная, ранимая натура. Человек буквально "читает" других. Это дар и проклятие одновременно.'
    ],
    '3_3' => [
        'title' => 'Усиленная Тройка — Абсолютный Творец',
        'description' => 'Творческий гений. Человек не может не творить — это его дыхание, его способ существования.'
    ],
    '4_4' => [
        'title' => 'Усиленная Четвёрка — Абсолютный Созидатель',
        'description' => 'Человек-скала. Гипертрофированная надёжность, устойчивость, верность слову и делу.'
    ],
    '5_5' => [
        'title' => 'Усиленная Пятёрка — Абсолютный Странник',
        'description' => 'Вечный странник. Свобода — его воздух, его суть, его религия.'
    ],
    '6_6' => [
        'title' => 'Усиленная Шестёрка — Абсолютный Хранитель',
        'description' => 'Гиперзабота. Мать Тереза в квадрате. Человек готов раствориться в других.'
    ],
    '7_7' => [
        'title' => 'Усиленная Семёрка — Абсолютный Мыслитель',
        'description' => 'Умный до болезненности. Может уйти в полную изоляцию, в "башню из слоновой кости".'
    ],
    '8_8' => [
        'title' => 'Усиленная Восьмёрка — Абсолютный Магнат',
        'description' => 'Магнат, олигарх, империалист. Может сколотить огромное состояние, создать корпорацию.'
    ],
    '9_9' => [
        'title' => 'Усиленная Девятка — Абсолютный Учитель',
        'description' => 'Миссия становится судьбой. Человек не может жить без служения — это его дыхание, его предназначение.'
    ]
];

    // 3. Массив расшифровок суммарного числа (оставляем как есть)
    $totalMeanings = [
        1 => ['title' => 'Лидер', 'short' => 'Ваш главный ресурс — лидерство и самостоятельность.', 'full' => 'Вы пришли в этот мир, чтобы проявлять волю и вести за собой...', 'advice' => 'Создавайте собственные проекты...'],
        2 => ['title' => 'Дипломат', 'short' => 'Ваш дар — создавать гармонию и партнёрство.', 'full' => 'Вы пришли в этот мир, чтобы учить людей сотрудничеству и любви...', 'advice' => 'Развивайте дипломатические таланты...'],
        3 => ['title' => 'Творец', 'short' => 'Ваша сила — в творчестве и радости.', 'full' => 'Вы пришли в этот мир, чтобы приносить красоту и вдохновение...', 'advice' => 'Творите каждый день...'],
        4 => ['title' => 'Созидатель', 'short' => 'Ваша основа — надёжность и порядок.', 'full' => 'Вы пришли в этот мир, чтобы создавать устойчивые формы...', 'advice' => 'Стройте дом, создавайте порядок...'],
        5 => ['title' => 'Исследователь', 'short' => 'Ваша стихия — свобода и перемены.', 'full' => 'Вы пришли в этот мир, чтобы расширять границы...', 'advice' => 'Путешествуйте, познавайте новое...'],
        6 => ['title' => 'Хранитель', 'short' => 'Ваша миссия — любовь и забота.', 'full' => 'Вы пришли в этот мир, чтобы нести любовь...', 'advice' => 'Создавайте уют, заботьтесь о близких...'],
        7 => ['title' => 'Мыслитель', 'short' => 'Ваш путь — мудрость и познание.', 'full' => 'Вы пришли в этот мир, чтобы познавать истину...', 'advice' => 'Исследуйте глубины...'],
        8 => ['title' => 'Реализатор', 'short' => 'Ваш потенциал — успех и власть.', 'full' => 'Вы пришли в этот мир, чтобы воплощать идеи...', 'advice' => 'Стройте бизнес, управляйте проектами...'],
        9 => ['title' => 'Мудрец', 'short' => 'Ваше предназначение — служение и мудрость.', 'full' => 'Вы пришли в этот мир, чтобы завершать циклы...', 'advice' => 'Служите, но не жертвуйте собой...'],
        11 => ['title' => 'Проводник', 'short' => 'Ваш дар — интуиция и духовность.', 'full' => 'Вы пришли в этот мир, чтобы быть проводником высшего знания...', 'advice' => 'Медитируйте, защищайте свою энергетику...'],
        22 => ['title' => 'Мастер-Созидатель', 'short' => 'Ваша сила — масштабное созидание.', 'full' => 'Вы пришли в этот мир, чтобы строить империи...', 'advice' => 'Стройте на века...'],
        33 => ['title' => 'Учитель-Целитель', 'short' => 'Ваша суть — безусловная любовь.', 'full' => 'Вы пришли в этот мир, чтобы нести свет...', 'advice' => 'Любите безусловно, но защищайте себя...']
    ];
    // Расшифровка числа подсознания
$subconsciousMeanings = [
    1 => 'Ваше подсознание стремится к лидерству и самостоятельности. Вы интуитивно ищете пути, где можно проявить инициативу.',
    2 => 'Подсознательно вы ищете гармонию и партнёрство. Интуиция подсказывает, как избежать конфликтов.',
    3 => 'Ваше подсознание наполнено творческой энергией. Вы интуитивно чувствуете, как выразить себя.',
    4 => 'Подсознательно вы стремитесь к порядку и структуре. Интуиция работает через практичность.',
    5 => 'Ваше подсознание жаждет свободы и приключений. Интуитивно вы ищете перемены.',
    6 => 'Подсознательно вы ищете возможности заботиться о других. Интуиция подсказывает, кому нужна помощь.',
    7 => 'Ваше подсознание настроено на поиск истины. Интуиция проявляется через глубокие озарения.',
    8 => 'Подсознательно вы стремитесь к успеху и власти. Интуиция работает в бизнесе и финансах.',
    9 => 'Ваше подсознание настроено на служение. Интуиция подсказывает, как помочь миру.',
    11 => 'Ваше подсознание — проводник высшей мудрости. Интуиция достигает уровня ясновидения.',
    22 => 'Подсознательно вы чувствуете масштаб. Интуиция подсказывает, как строить империи.',
    33 => 'Ваше подсознание — чистая любовь. Интуиция проявляется как безусловное принятие.'
];
    // Расшифровка числа подсознания
    $potentialMeanings = [
    1 => 'Ваш скрытый потенциал — лидерство. В трудных ситуациях вы способны взять управление на себя.',
    2 => 'Ваш скрытый потенциал — дипломатия. Вы способны уладить любой конфликт.',
    3 => 'Ваш скрытый потенциал — творчество. В вас живёт нераскрытый талант.',
    4 => 'Ваш скрытый потенциал — надёжность. Вы способны создать устойчивую систему.',
    5 => 'Ваш скрытый потенциал — адаптивность. Вы выживете в любых обстоятельствах.',
    6 => 'Ваш скрытый потенциал — забота. Вы способны исцелять души.',
    7 => 'Ваш скрытый потенциал — мудрость. Вы способны видеть суть вещей.',
    8 => 'Ваш скрытый потенциал — управление. Вы способны создавать материальное из идей.',
    9 => 'Ваш скрытый потенциал — служение. Вы способны вдохновлять и вести за собой.',
    11 => 'Ваш скрытый потенциал — ясновидение. Развивайте интуицию.',
    22 => 'Ваш скрытый потенциал — созидание империй. Масштаб — ваша стихия.',
    33 => 'Ваш скрытый потенциал — безусловная любовь. Вы способны исцелять.'
];
$destinyMeanings = [
    1 => 'Судьба лидера. Ваш путь — проявлять инициативу, создавать новое, вести за собой.',
    2 => 'Судьба дипломата. Ваш путь — создавать гармонию, объединять людей, быть миротворцем.',
    3 => 'Судьба творца. Ваш путь — самовыражение, вдохновение, радость творчества.',
    4 => 'Судьба созидателя. Ваш путь — строить, создавать порядок, быть опорой.',
    5 => 'Судьба исследователя. Ваш путь — путешествовать, открывать новое, быть свободным.',
    6 => 'Судьба хранителя. Ваш путь — заботиться, любить, создавать семью.',
    7 => 'Судьба мыслителя. Ваш путь — познавать истину, искать глубину, делиться мудростью.',
    8 => 'Судьба реализатора. Ваш путь — достигать успеха, управлять, создавать материальные ценности.',
    9 => 'Судьба мудреца. Ваш путь — служить, завершать циклы, нести свет.',
    11 => 'Судьба проводника. Ваш путь — развивать интуицию, помогать людям на духовном пути.',
    22 => 'Судьба мастера. Ваш путь — строить масштабные проекты, оставлять след в истории.',
    33 => 'Судьба учителя. Ваш путь — нести любовь, исцелять, просвещать.'
];
    //////////////расшифровки
//////////////////////////////////переменные
////////////////////////////////функции
    // Функция редукции
    function reduceNumber($num) {
        if ($num == 11 || $num == 22 || $num == 33) {
            return $num;
        }
        while ($num > 9) {
            $num = array_sum(str_split((string)$num));
        }
        return $num;
    }
    
    // Функция подсчета суммы букв
    function sumLetters($name, $letterValues, $filter = null) {
        $sum = 0;
        $name = mb_strtolower($name);
        $length = mb_strlen($name);
        
        for ($i = 0; $i < $length; $i++) {
            $char = mb_substr($name, $i, 1);
            if ($filter !== null && !in_array($char, $filter)) {
                continue;
            }
            if (isset($letterValues[$char])) {
                $sum += $letterValues[$char];
            }
        }
        return $sum;
    }
    //////////////////////////функция сохранения файла
    /**
 * Сохраняет нумерологический отчет по ФИО на сервер
 * @param array $result_data Результаты расчета (сессия fio_result)
 * @param string $email Email пользователя (опционально)
 * @return array ['success' => bool, 'filename' => string, 'full_url' => string, 'error' => string]
 */
function saveNumerologyFioReport($result_data, $email = '') {
    // Создаем папку для отчетов, если её нет
    // $report_dir = $_SERVER['DOCUMENT_ROOT'] . '/reports/';
    $report_dir ='../reports/';
    if (!file_exists($report_dir)) {
        mkdir($report_dir, 0777, true);
    }
    
    // Генерируем имя файла: дата + имя + уникальный идентификатор
    $date = date('Y-m-d');
    $time = date('H-i-s');
    $name = preg_replace('/[^a-zA-Zа-яА-Я0-9]/u', '_', $result_data['firstname'] ?? 'unknown');
    $name = mb_substr($name, 0, 20);
    $filename = "fio_report_{$date}_{$time}_{$name}.html";
    $filepath = $report_dir . $filename;
    
    // Формируем HTML-контент отчета
    $html_content = generateFioReportHTML($result_data, $email);
    
    // Сохраняем файл
    $success = file_put_contents($filepath, $html_content);
    
    if ($success === false) {
        return [
            'success' => false,
            'error' => 'Не удалось сохранить файл'
        ];
    }
    
    // Формируем URL для доступа к файлу
    $full_url = 'https://' . $_SERVER['HTTP_HOST'] . '/reports/' . $filename;
    
    return [
        'success' => true,
        'filename' => $filename,
        'full_url' => $full_url,
        'filepath' => $filepath
    ];
}

/**
 * Генерирует HTML-код отчета для ФИО
 */
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
            .footer {
                text-align: center;
                margin-top: 40px;
                padding-top: 20px;
                border-top: 1px solid #e0e0e0;
                color: #7f8c8d;
                font-size: 0.85em;
            }
            @media print {
                body { background: white; padding: 0; }
                .container { box-shadow: none; padding: 10px; }
                .btn, .action-buttons { display: none; }
                @page { margin: 15mm; }
                @top-left { content: none; }
                @top-center { content: none; }
                @top-right { content: none; }
                @bottom-left { content: none; }
                @bottom-center { content: none; }
                @bottom-right { content: none; }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>🔮 Нумерологический отчет по ФИО</h1>
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
            
            <div class="footer">
                <p>Расчет выполнен: <?= $result_data['calculated_at'] ?? date('d.m.Y H:i:s') ?></p>
                <p>© <?= date('Y') ?> Нумерология ФИО | Профессиональный нумерологический анализ</p>
                <p>Отчет сгенерирован автоматически</p>
            </div>
        </div>
    </body>
    </html>
    <?php
    return ob_get_clean();
}
    //////////////////////////функция сохранения файла
    ////////////////////////////////функции
// выводим результат на фронте
if($_SERVER['REQUEST_METHOD']=='POST' && isset ($_POST['submitNameFr']))
{
    //tt($_POST);
    // $rawName = trim($_POST['firstname'] ?? '');
    $rawName = htmlspecialchars(trim($_POST['firstname'] ?? ''), ENT_QUOTES, 'UTF-8');
    // 3. Удаляем лишние пробелы внутри (оставляем один пробел между словами)
        $rawName = preg_replace('/\s+/', ' ', $rawName);
        // 4. Если есть пробел - берем только первое слово
        if (strpos($rawName, ' ') !== false) {
            $firstName = explode(' ', $rawName)[0];
        } else {
            $firstName = $rawName;
        }
        if(empty($firstName)) {
            $errMsg .= 'Пожалуйста, введите имя<br>';
        }
        elseif (mb_strlen($firstName) > 20) {
            $errMsg .= 'Имя не должно быть длиннее 20 символов<br>';
        }
        elseif(!preg_match('/^[а-яёА-ЯЁ]+$/u', $firstName)) {
             $errMsg .= 'Имя может содержать только русские буквы<br>';
        }
        elseif (mb_strlen($firstName) < 2) {
            $errMsg .= 'Имя должно содержать минимум 2 буквы<br>';
        }
        //если нет ошибок, выводим результат
        if(empty($errMsg))
        {
        ///////////////////////////////////////////////////////////////////////////////////
    // ВЫЧИСЛЯЕМ ЧИСЛА
    $nameSum = sumLetters($firstName, $letterValues);
    $nameNumber = reduceNumber($nameSum);
    
    $soulSum = sumLetters($firstName, $letterValues, $vowels);
    $soulNumber = reduceNumber($soulSum);
    
    $personalitySum = sumLetters($firstName, $letterValues, $consonants);
    $personalityNumber = reduceNumber($personalitySum);
    
    $karmicSum = $nameNumber + $soulNumber;
    $karmicNumber = reduceNumber($karmicSum);
    // Проверяем на совпадение чисел
if ($nameNumber == $soulNumber) {
    $combinationKey = $nameNumber . '_' . $soulNumber;
    if (isset($interpretations['combinations'][$combinationKey])) {
        $_SESSION['name_result']['combination'] = $interpretations['combinations'][$combinationKey];
    }
}
// Проверяем другие совпадения чисел
$combinations = [];

if ($nameNumber == $personalityNumber && $nameNumber != $soulNumber) {
    $combinations[] = [
        'type' => 'Имя = Личность',
        'text' => 'Ваши число имени и число личности совпадают. Вы живёте в гармонии с собой — ваше внутреннее и внешнее едины.'
    ];
}

if ($nameNumber == $karmicNumber && $nameNumber != $soulNumber) {
    $combinations[] = [
        'type' => 'Имя = Кармическое',
        'text' => 'Ваше число имени совпадает с кармическим числом. Ваша личность и кармические задачи идут рука об руку.'
    ];
}

if ($soulNumber == $personalityNumber && $soulNumber != $nameNumber) {
    $combinations[] = [
        'type' => 'Душа = Личность',
        'text' => 'Ваши число души и число личности совпадают. Вы искренни и открыты — внутреннее совпадает с внешним.'
    ];
}

if ($soulNumber == $karmicNumber && $soulNumber != $nameNumber) {
    $combinations[] = [
        'type' => 'Душа = Кармическое',
        'text' => 'Ваши число души и кармическое число совпадают. Ваши желания соответствуют вашим кармическим задачам.'
    ];
}

if ($personalityNumber == $karmicNumber && $personalityNumber != $nameNumber && $personalityNumber != $soulNumber) {
    $combinations[] = [
        'type' => 'Личность = Кармическое',
        'text' => 'Ваши число личности и кармическое число совпадают. То, как вас видят другие, соответствует вашим кармическим задачам.'
    ];
}

if (!empty($combinations)) {
    $_SESSION['name_result']['additional_combinations'] = $combinations;
}   
    // Получаем интерпретации для каждого числа
    $nameInterpretation = $interpretations[$nameNumber] ?? $interpretations[1];
    $soulInterpretation = $interpretations[$soulNumber] ?? $interpretations[1];
    $personalityInterpretation = $interpretations[$personalityNumber] ?? $interpretations[1];
    $karmicInterpretation = $interpretations[$karmicNumber] ?? $interpretations[1];
    
    // ==================== СОХРАНЯЕМ ВСЁ В СЕССИЮ ====================
 // 1. Сначала создаём и заполняем $additional
    $additional = [];
    
    // Анализ совпадений
    if ($nameNumber == $soulNumber) {
        $additional[] = 'Ваши число имени и число души совпадают. Вы живете в гармонии с собой.';
    }
    
    if ($nameNumber == $personalityNumber) {
        $additional[] = 'Ваше внутреннее и внешнее совпадают. Вы искренни и открыты.';
    }
    
    // Анализ четности/нечетности
    $evenCount = 0;
    $oddCount = 0;
    
    foreach ([$nameNumber, $soulNumber, $personalityNumber, $karmicNumber] as $num) {
        if ($num % 2 == 0) $evenCount++; else $oddCount++;
    }
    
    if ($evenCount > $oddCount) {
        $additional[] = 'У вас преобладают четные числа — вы практичны и уравновешены.';
    } elseif ($oddCount > $evenCount) {
        $additional[] = 'У вас преобладают нечетные числа — вы творческая и импульсивная личность.';
    }
    
    // 2. Суммарное число и его расшифровка
    $totalSum = $nameNumber + $soulNumber + $personalityNumber + $karmicNumber;
    $totalNumber = reduceNumber($totalSum);
    /////////////////////////////////
    // ==================== СПЕКТР ИМЕНИ ====================
// Получаем массив всех чисел имени
$allNameNumbers = [];
$nameLower = mb_strtolower($firstName);
$length = mb_strlen($nameLower);

for ($i = 0; $i < $length; $i++) {
    $char = mb_substr($nameLower, $i, 1);
    if (isset($letterValues[$char])) {
        $allNameNumbers[] = $letterValues[$char];
    }
}

// Подсчет количества каждого числа от 1 до 9
$spectrum = array_fill(1, 9, 0);
foreach ($allNameNumbers as $num) {
    if ($num >= 1 && $num <= 9) {
        $spectrum[$num]++;
    }
}

// Преобладающие числа
$dominantNumbers = array_keys($spectrum, max($spectrum));
$dominantText = '';
if (count($dominantNumbers) == 1) {
    $dominantText = "Преобладает число {$dominantNumbers[0]} — это ваш главный архетип.";
} else {
    $dominantText = "Преобладают числа " . implode(', ', $dominantNumbers) . " — многогранная личность.";
}

// Отсутствующие числа (зоны роста)
$missingNumbers = array_keys(array_filter($spectrum, function($count) { return $count == 0; }));
$missingText = empty($missingNumbers) ? "В вашем имени представлены все числа — гармоничная личность." 
    : "Отсутствуют числа: " . implode(', ', $missingNumbers) . " — это ваши зоны роста.";

// Баланс четных/нечетных
$evenSpectrum = 0;
$oddSpectrum = 0;
for ($i = 1; $i <= 9; $i++) {
    if ($i % 2 == 0) $evenSpectrum += $spectrum[$i];
    else $oddSpectrum += $spectrum[$i];
}
$balanceText = ($evenSpectrum > $oddSpectrum) ? "Преобладают четные числа — вы практичны и уравновешены."
    : (($oddSpectrum > $evenSpectrum) ? "Преобладают нечетные числа — вы творческая и импульсивная личность."
    : "Баланс четных и нечетных чисел — гармония.");

$_SESSION['name_result']['spectrum'] = [
    'all_numbers' => $allNameNumbers,
    'counts' => $spectrum,
    'dominant' => $dominantNumbers,
    'dominant_text' => $dominantText,
    'missing' => $missingNumbers,
    'missing_text' => $missingText,
    'balance' => $balanceText
];
// ==================== ЧИСЛО ПОДСОЗНАНИЯ ====================
// Суммируем все числа спектра, редуцируем до одной цифры
$subconsciousSum = array_sum($allNameNumbers);
$subconsciousNumber = reduceNumber($subconsciousSum);

$_SESSION['name_result']['subconscious'] = [
    'number' => $subconsciousNumber,
    'meaning' => $subconsciousMeanings[$subconsciousNumber] ?? 'Ваше подсознание уникально. Доверяйте своей интуиции.'
];
// ==================== ДИНАМИКА ИМЕНИ ====================
$transitions = [];
for ($i = 0; $i < count($allNameNumbers) - 1; $i++) {
    $from = $allNameNumbers[$i];
    $to = $allNameNumbers[$i + 1];
    $transitions[] = "$from → $to";
}

// Анализ ключевых переходов
$dynamicAnalysis = [];
if (count($transitions) > 0) {
    $firstToLast = $allNameNumbers[0] . ' → ' . end($allNameNumbers);
    $dynamicAnalysis[] = "Начало пути: число {$allNameNumbers[0]}, цель: число " . end($allNameNumbers);
    
    // Поиск повторяющихся переходов
    $transitionCounts = array_count_values($transitions);
    foreach ($transitionCounts as $transition => $count) {
        if ($count > 1) {
            $dynamicAnalysis[] = "Повторяющийся переход: $transition — важная тема в вашей жизни.";
        }
    }
}
$totalData = $totalMeanings[$totalNumber] ?? [
    'title' => 'Искатель',
    'short' => 'Ваш путь уникален.',
    'full' => 'Ваше суммарное число открывает особый путь познания себя и мира. Исследуйте, развивайтесь, доверяйте своей интуиции.',
    'advice' => 'Будьте внимательны к знакам судьбы и не бойтесь своего пути.'
];
// ==================== КОРРЕКЦИЯ ИМЕНИ ====================
$corrections = [];

// Анализируем "острые углы" характера
if ($nameNumber == 1 || $soulNumber == 1 || $personalityNumber == 1) {
    $corrections[] = "Уменьшительные формы смягчат жесткость Единицы, добавят мягкости в общение.";
}
if ($nameNumber == 3 || $soulNumber == 3 || $personalityNumber == 3) {
    $corrections[] = "Более сдержанные формы имени помогут сконцентрироваться и доводить дела до конца.";
}
if ($nameNumber == 4 || $soulNumber == 4 || $personalityNumber == 4) {
    $corrections[] = "Использование более мягких форм имени добавит гибкости и лёгкости.";
}
if ($nameNumber == 5 || $soulNumber == 5 || $personalityNumber == 5) {
    $corrections[] = "Более устойчивые формы имени помогут найти баланс между свободой и ответственностью.";
}
if ($nameNumber == 6 || $soulNumber == 6 || $personalityNumber == 6) {
    $corrections[] = "Использование полного имени поможет выстроить личные границы.";
}
if ($nameNumber == 7 || $soulNumber == 7 || $personalityNumber == 7) {
    $corrections[] = "Более тёплые, уменьшительные формы помогут открыться миру и людям.";
}
if ($nameNumber == 8 || $soulNumber == 8 || $personalityNumber == 8) {
    $corrections[] = "Мягкие, домашние формы имени смягчат властность и добавят человечности.";
}
if ($nameNumber == 9 || $soulNumber == 9 || $personalityNumber == 9) {
    $corrections[] = "Более приземлённые формы имени помогут сохранять связь с реальностью.";
}

// Общие рекомендации
if (in_array($nameNumber, $missingNumbers)) {
    $corrections[] = "Добавление в обращение имени, содержащего отсутствующее число, поможет развить недостающее качество.";
}
if (count($missingNumbers) > 2) {
    $corrections[] = "Попробуйте использовать разные формы имени (полное, уменьшительное, отчество) в разных сферах жизни для баланса энергий.";
}

// ==================== ЧИСЛО СУДЬБЫ ====================
$destinyNumber = reduceNumber($nameNumber + $soulNumber + $personalityNumber);
// ==================== ЧИСЛО СКРЫТОГО ПОТЕНЦИАЛА ====================
$hiddenPotential = reduceNumber($personalityNumber + $destinyNumber);

$_SESSION['name_result'] = [
    'firstname' => $firstName,
    'numbers' => [
        'name' => $nameNumber,
        'soul' => $soulNumber,
        'personality' => $personalityNumber,
        'karmic' => $karmicNumber
    ],
    
    // ==================== ОСНОВНЫЕ РАСШИФРОВКИ ====================
    'interpretations' => [
        'name' => [
            'title' => $nameInterpretation['title'] ?? 'Лидер',
            'essence' => $nameInterpretation['essence'] ?? $nameInterpretation['name']['essence'] ?? 'Описание характера',
            'strengths' => $nameInterpretation['strengths'] ?? $nameInterpretation['name']['strengths'] ?? 'Сильные стороны',
            'weaknesses' => $nameInterpretation['weaknesses'] ?? $nameInterpretation['name']['weaknesses'] ?? 'Слабые стороны',
            'in_shadow' => $nameInterpretation['in_shadow'] ?? $nameInterpretation['name']['in_shadow'] ?? 'Теневая сторона',
            'mythology' => $nameInterpretation['mythology'] ?? '',
            'archetype' => $nameInterpretation['archetype'] ?? '',
            'sacred' => $nameInterpretation['sacred'] ?? '',
            'life' => $nameInterpretation['life'] ?? [],
            'intensity' => $nameInterpretation['intensity'] ?? [],
            'ages' => $nameInterpretation['ages'] ?? [],
            'celebrities' => $nameInterpretation['celebrities'] ?? '',
            'compatibility_matrix' => $nameInterpretation['compatibility_matrix'] ?? [],
            'recommendations' => $nameInterpretation['recommendations'] ?? [],
            'mission' => $nameInterpretation['mission'] ?? '',
            'keywords' => $nameInterpretation['keywords'] ?? '',
            'affirmations' => $nameInterpretation['affirmations'] ?? []
        ],
        'soul' => [
            'title' => $soulInterpretation['title'] ?? 'Загадочная душа',
            'essence' => $soulInterpretation['essence'] ?? $soulInterpretation['soul']['essence'] ?? 'Описание души',
            'desires' => $soulInterpretation['desires'] ?? $soulInterpretation['soul']['desires'] ?? 'Желания',
            'fears' => $soulInterpretation['fears'] ?? $soulInterpretation['soul']['fears'] ?? 'Страхи',
            'mythology' => $soulInterpretation['mythology'] ?? '',
            'archetype' => $soulInterpretation['archetype'] ?? '',
            'sacred' => $soulInterpretation['sacred'] ?? '',
            'strengths' => $soulInterpretation['strengths'] ?? '',
            'weaknesses' => $soulInterpretation['weaknesses'] ?? '',
            'in_shadow' => $soulInterpretation['in_shadow'] ?? '',
            'life' => $soulInterpretation['life'] ?? [],
            'celebrities' => $soulInterpretation['celebrities'] ?? '',
            'mission' => $soulInterpretation['mission'] ?? '',
            'keywords' => $soulInterpretation['keywords'] ?? '',
            'affirmations' => $soulInterpretation['affirmations'] ?? []
        ],
        'personality' => [
            'title' => $personalityInterpretation['title'] ?? 'Индивидуальность',
            'essence' => $personalityInterpretation['essence'] ?? $personalityInterpretation['personality']['essence'] ?? 'Описание личности',
            'image' => $personalityInterpretation['image'] ?? $personalityInterpretation['personality']['image'] ?? 'Образ',
            'first_impression' => $personalityInterpretation['first_impression'] ?? $personalityInterpretation['personality']['first_impression'] ?? 'Первое впечатление',
            'mythology' => $personalityInterpretation['mythology'] ?? '',
            'archetype' => $personalityInterpretation['archetype'] ?? '',
            'strengths' => $personalityInterpretation['strengths'] ?? '',
            'weaknesses' => $personalityInterpretation['weaknesses'] ?? '',
            'in_shadow' => $personalityInterpretation['in_shadow'] ?? '',
            'life' => $personalityInterpretation['life'] ?? [],
            'celebrities' => $personalityInterpretation['celebrities'] ?? '',
            'mission' => $personalityInterpretation['mission'] ?? '',
            'keywords' => $personalityInterpretation['keywords'] ?? '',
            'affirmations' => $personalityInterpretation['affirmations'] ?? []
        ],
        'karmic' => [
            'title' => $karmicInterpretation['title'] ?? 'Кармическая задача',
            'essence' => $karmicInterpretation['essence'] ?? $karmicInterpretation['name']['essence'] ?? '',
            'tasks' => $karmicInterpretation['karmic']['tasks'] ?? $karmicInterpretation['karmic_tasks'] ?? ['Познание себя'],
            'lesson' => $karmicInterpretation['karmic']['lesson'] ?? $karmicInterpretation['karmic_lesson'] ?? 'Главный урок',
            'mythology' => $karmicInterpretation['mythology'] ?? '',
            'archetype' => $karmicInterpretation['archetype'] ?? '',
            'strengths' => $karmicInterpretation['strengths'] ?? '',
            'weaknesses' => $karmicInterpretation['weaknesses'] ?? '',
            'in_shadow' => $karmicInterpretation['in_shadow'] ?? '',
            'life' => $karmicInterpretation['life'] ?? [],
            'celebrities' => $karmicInterpretation['celebrities'] ?? '',
            'mission' => $karmicInterpretation['mission'] ?? '',
            'keywords' => $karmicInterpretation['keywords'] ?? '',
            'affirmations' => $karmicInterpretation['affirmations'] ?? []
        ]
    ],
    
    // ==================== ДОПОЛНИТЕЛЬНЫЙ АНАЛИЗ ====================
    'additional' => $additional,
    
    // ==================== СУММАРНОЕ ЧИСЛО ====================
    'total' => [
        'value' => $totalNumber,
        'title' => $totalData['title'],
        'short' => $totalData['short'],
        'full' => $totalData['full'],
        'advice' => $totalData['advice']
    ],
    
    // ==================== СПЕКТР ИМЕНИ ====================
    'spectrum' => [
        'all_numbers' => $allNameNumbers,
        'counts' => $spectrum,
        'dominant' => $dominantNumbers,
        'dominant_text' => $dominantText,
        'missing' => $missingNumbers,
        'missing_text' => $missingText,
        'balance' => $balanceText
    ],
    
    // ==================== ЧИСЛО ПОДСОЗНАНИЯ ====================
    'subconscious' => [
        'number' => $subconsciousNumber,
        'meaning' => $subconsciousMeanings[$subconsciousNumber] ?? 'Ваше подсознание уникально. Доверяйте своей интуиции.'
    ],
    
    // ==================== ДИНАМИКА ИМЕНИ ====================
    'dynamics' => [
        'sequence' => $allNameNumbers,
        'transitions' => $transitions,
        'analysis' => $dynamicAnalysis
    ],
    
    // ==================== КОРРЕКЦИЯ ИМЕНИ ====================
    'corrections' => $corrections,
    
    // ==================== ЧИСЛО СУДЬБЫ ====================
    'destiny' => [
        'number' => $destinyNumber,
        'meaning' => $destinyMeanings[$destinyNumber] ?? 'Познание себя и мира'
    ],
    
    // ==================== СКРЫТЫЙ ПОТЕНЦИАЛ ====================
    'hidden_potential' => [
        'number' => $hiddenPotential,
        'meaning' => $potentialMeanings[$hiddenPotential] ?? 'Раскройте свою уникальность'
    ],
    
    // ==================== ВРЕМЯ РАСЧЕТА ====================
    'calculated_at' => date('d.m.Y H:i:s')
];
    
    // 6. Редирект
    header('Location: ' . ABS_PATH . 'name');
    exit;
    
} else {
    // Если зашли напрямую без POST
    header('Location: ' . ABS_PATH . 'name-form');
    exit;
    }
}
// выводим результат на фронте
// выводим реультат на бэкенде
if($_SERVER['REQUEST_METHOD']=='POST' && isset ($_POST['submitNameBack']))
{
