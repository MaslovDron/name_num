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
        // ДОБАВЛЯЕМ НЕДОСТАЮЩИЕ ПОЛЯ ДЛЯ ДУШИ
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
        // ДОБАВЛЯЕМ НЕДОСТАЮЩИЕ ПОЛЯ ДЛЯ ЛИЧНОСТИ
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
        'tasks' => $karmicInterpretation['karmic']['tasks'] ?? $karmicInterpretation['karmic_tasks'] ?? ['Познание себя'],
        'lesson' => $karmicInterpretation['karmic']['lesson'] ?? $karmicInterpretation['karmic_lesson'] ?? 'Главный урок',
        'mythology' => $karmicInterpretation['mythology'] ?? '',
        'archetype' => $karmicInterpretation['archetype'] ?? '',
        // ДОБАВЛЯЕМ НЕДОСТАЮЩИЕ ПОЛЯ ДЛЯ КАРМИЧЕСКОГО
        'essence' => $karmicInterpretation['essence'] ?? $karmicInterpretation['name']['essence'] ?? '',
        'strengths' => $karmicInterpretation['strengths'] ?? '',
        'weaknesses' => $karmicInterpretation['weaknesses'] ?? '',
        'in_shadow' => $karmicInterpretation['in_shadow'] ?? '',
        'life' => $karmicInterpretation['life'] ?? [],
        'celebrities' => $karmicInterpretation['celebrities'] ?? '',
        'mission' => $karmicInterpretation['mission'] ?? '',
        'keywords' => $karmicInterpretation['keywords'] ?? '',
        'affirmations' => $karmicInterpretation['affirmations'] ?? []
    ],
    'personality' => [
        'title' => $personalityInterpretation['title'] ?? 'Индивидуальность',
        'essence' => $personalityInterpretation['essence'] ?? $personalityInterpretation['personality']['essence'] ?? 'Описание личности',
        'image' => $personalityInterpretation['image'] ?? $personalityInterpretation['personality']['image'] ?? 'Образ',
        'first_impression' => $personalityInterpretation['first_impression'] ?? $personalityInterpretation['personality']['first_impression'] ?? 'Первое впечатление',
        // ДОБАВЛЯЕМ ПОЛЯ ДЛЯ ЛИЧНОСТИ
        'mythology' => $personalityInterpretation['mythology'] ?? '',
        'archetype' => $personalityInterpretation['archetype'] ?? ''
    ],
    'karmic' => [
        'title' => $karmicInterpretation['title'] ?? 'Кармическая задача',
        'tasks' => $karmicInterpretation['karmic']['tasks'] ?? $karmicInterpretation['karmic_tasks'] ?? ['Познание себя'],
        'lesson' => $karmicInterpretation['karmic']['lesson'] ?? $karmicInterpretation['karmic_lesson'] ?? 'Главный урок',
        // ДОБАВЛЯЕМ ПОЛЯ ДЛЯ КАРМИЧЕСКОГО
        'mythology' => $karmicInterpretation['mythology'] ?? '',
        'archetype' => $karmicInterpretation['archetype'] ?? ''
    ]
],
    'additional' => $additional,
    'total' => [
        'value' => $totalNumber,
        'title' => $totalData['title'],
        'short' => $totalData['short'],
        'full' => $totalData['full'],
        'advice' => $totalData['advice']
    ],
    
    // ========== НОВЫЕ РАСШИРЕННЫЕ ПАРАМЕТРЫ ==========
    
    'spectrum' => [
        'all_numbers' => $allNameNumbers,
        'counts' => $spectrum,
        'dominant' => $dominantNumbers,
        'dominant_text' => $dominantText,
        'missing' => $missingNumbers,
        'missing_text' => $missingText,
        'balance' => $balanceText
    ],
    
    'subconscious' => [
        'number' => $subconsciousNumber,
        'meaning' => $subconsciousMeanings[$subconsciousNumber] ?? 'Ваше подсознание уникально. Доверяйте своей интуиции.'
    ],
    
    'dynamics' => [
        'sequence' => $allNameNumbers,
        'transitions' => $transitions,
        'analysis' => $dynamicAnalysis
    ],
    
    'corrections' => $corrections,
    
    'destiny' => [
        'number' => $destinyNumber,
        'meaning' => $destinyMeanings[$destinyNumber] ?? 'Познание себя и мира'
    ],
    
    'hidden_potential' => [
        'number' => $hiddenPotential,
        'meaning' => $potentialMeanings[$hiddenPotential] ?? 'Раскройте свою уникальность'
    ],
    
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
?>
