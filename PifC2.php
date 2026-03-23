        $analysis .= "<li>Финансовая грамотность на высоком уровне</li>";
        $analysis .= "<li>Часто несколько источников дохода</li>";
        $analysis .= "<li>Умение приумножать деньги</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> стратегическое планирование инвестиций</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 8) {
        $analysis .= "<span class='level-strong'>ОЧЕНЬ ХОРОШИЙ (7-8 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Высокий уровень дохода</li>";
        $analysis .= "<li>Талант к зарабатыванию денег</li>";
        $analysis .= "<li>Успешные инвестиции и бизнес</li>";
        $analysis .= "<li>Финансовая независимость</li>";
        $analysis .= "<li>Возможность помогать другим финансово</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> социальная ответственность, благотворительность</li>";
        $analysis .= "</ul>";
    } else {
        $analysis .= "<span class='level-excellent'>ОТЛИЧНЫЙ (9+ баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Потенциал стать очень богатым</li>";
        $analysis .= "<li>Деньги приходят легко и в больших количествах</li>";
        $analysis .= "<li>Гениальные бизнес-идеи</li>";
        $analysis .= "<li>Может быть финансовым гением</li>";
        $analysis .= "<li>Важно использовать богатство во благо</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> не забывать о духовных ценностях</li>";
        $analysis .= "</ul>";
    }
    
    $analysis .= "</div></div>";
    return $analysis;
}

/**
 * Столбец 3-6-9: ТВОРЧЕСКИЙ ПОТЕНЦИАЛ И ТАЛАНТЫ
 * Формула: сумма значений ячеек 3 + 6 + 9
 * Отвечает за: творческие способности, креативность, реализацию талантов
 */
function getColumn3Analysis($value) {
    $analysis = "<div class='line-item'>";
    $analysis .= "<h4><i class='fas fa-palette'></i> Столбец 3-6-9: <span class='line-name'>Творческий потенциал и таланты</span></h4>";
    $analysis .= "<div class='line-formula'>Формула: [3] + [6] + [9] = <strong>$value</strong> баллов</div>";
    $analysis .= "<div class='line-description'>";
    
    if ($value == 0) {
        $analysis .= "<span class='level-critical'>ОТСУТСТВУЕТ (0 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Практически нет творческих способностей</li>";
        $analysis .= "<li>Предпочитает шаблонные решения</li>";
        $analysis .= "<li>Не любит перемены и новшества</li>";
        $analysis .= "<li>Творчество даётся с большим трудом</li>";
        $analysis .= "<li>Не видит красоты в искусстве</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> начинать с простых творческих задач</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 2) {
        $analysis .= "<span class='level-weak'>НИЗКИЙ (1-2 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Творчество проявляется редко и неохотно</li>";
        $analysis .= "<li>Нужен внешний толчок для творческой деятельности</li>";
        $analysis .= "<li>Предпочитает следовать инструкциям</li>";
        $analysis .= "<li>Таланты требуют развития и поддержки</li>";
        $analysis .= "<li>Креативность в бытовых вопросах</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> посещение мастер-классов, курсов</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 4) {
        $analysis .= "<span class='level-medium'>СРЕДНИЙ (3-4 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Хорошие творческие способности</li>";
        $analysis .= "<li>Может создавать что-то новое при вдохновении</li>";
        $analysis .= "<li>Развитый художественный вкус</li>";
        $analysis .= "<li>Талант проявляется в определённых сферах</li>";
        $analysis .= "<li>Умеет ценить искусство</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> найти свою творческую нишу</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 6) {
        $analysis .= "<span class='level-good'>ВЫСОКИЙ (5-6 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Яркий творческий потенциал</li>";
        $analysis .= "<li>Множество талантов в разных областях</li>";
        $analysis .= "<li>Создаёт уникальные вещи и идеи</li>";
        $analysis .= "<li>Постоянно ищет новые формы самовыражения</li>";
        $analysis .= "<li>Часто работает в творческих профессиях</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> не распыляться, выбрать главное направление</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 8) {
        $analysis .= "<span class='level-strong'>ОЧЕНЬ ВЫСОКИЙ (7-8 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Выдающиеся творческие способности</li>";
        $analysis .= "<li>Может стать известным художником, музыкантом, писателем</li>";
        $analysis .= "<li>Оригинальное, нестандартное мышление</li>";
        $analysis .= "<li>Творчество — способ жизни</li>";
        $analysis .= "<li>Вдохновляет других своим творчеством</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> найти баланс между творчеством и практичностью</li>";
        $analysis .= "</ul>";
    } else {
        $analysis .= "<span class='level-excellent'>ГЕНИАЛЬНЫЙ (9+ баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Гениальные творческие способности</li>";
        $analysis .= "<li>Может создавать шедевры</li>";
        $analysis .= "<li>Творчество на грани мистики</li>";
        $analysis .= "<li>Часто опережает своё время</li>";
        $analysis .= "<li>Творческая энергия требует постоянного выхода</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> оставить творческое наследие</li>";
        $analysis .= "</ul>";
    }
    
    $analysis .= "</div></div>";
    return $analysis;
}

/**
 * Строка 1-2-3: ЦЕЛЕУСТРЕМЛЁННОСТЬ И АКТИВНОСТЬ
 * Формула: сумма значений ячеек 1 + 2 + 3
 * Отвечает за: целеполагание, настойчивость, активную жизненную позицию
 */
function getLine1Analysis($value) {
    $analysis = "<div class='line-item'>";
    $analysis .= "<h4><i class='fas fa-bullseye'></i> Строка 1-2-3: <span class='line-name'>Целеустремлённость и активность</span></h4>";
    $analysis .= "<div class='line-formula'>Формула: [1] + [2] + [3] = <strong>$value</strong> баллов</div>";
    $analysis .= "<div class='line-description'>";
    
    if ($value == 0) {
        $analysis .= "<span class='level-critical'>ОТСУТСТВУЕТ (0 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Полное отсутствие целей в жизни</li>";
        $analysis .= "<li>Плывёт по течению без направления</li>";
        $analysis .= "<li>Пассивный, инертный образ жизни</li>";
        $analysis .= "<li>Ждёт, когда что-то само произойдёт</li>";
        $analysis .= "<li>Нет амбиций и стремлений</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> начать с постановки маленьких целей</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 2) {
        $analysis .= "<span class='level-weak'>СЛАБАЯ (1-2 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Есть цели, но нет упорства их достигать</li>";
        $analysis .= "<li>Часто бросает начатое на полпути</li>";
        $analysis .= "<li>Нужна постоянная внешняя мотивация</li>";
        $analysis .= "<li>Достигает только самых лёгких целей</li>";
        $analysis .= "<li>Быстро теряет интерес</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> система поощрений за достижения</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 4) {
        $analysis .= "<span class='level-medium'>НОРМАЛЬНАЯ (3-4 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Ставит и достигает реалистичные цели</li>";
        $analysis .= "<li>Упорный, но не фанатичный</li>";
        $analysis .= "<li>Идёт к цели последовательно и планомерно</li>";
        $analysis .= "<li>Может корректировать цели при изменении обстоятельств</li>";
        $analysis .= "<li>Баланс между упорством и гибкостью</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> долгосрочное планирование</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 6) {
        $analysis .= "<span class='level-good'>ВЫСОКАЯ (5-6 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Очень целеустремлённый человек</li>";
        $analysis .= "<li>Достигает даже сложных и долгосрочных целей</li>";
        $analysis .= "<li>Не сдаётся при трудностях и препятствиях</li>";
        $analysis .= "<li>Умеет расставлять приоритеты</li>";
        $analysis .= "<li>Часто становится успешным в карьере и бизнесе</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> ставить более глобальные цели</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 8) {
        $analysis .= "<span class='level-strong'>ОЧЕНЬ ВЫСОКАЯ (7-8 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Фанатичная целеустремлённость</li>";
        $analysis .= "<li>Может идти к цели, невзирая на препятствия</li>";
        $analysis .= "<li>Ставит амбициозные, грандиозные цели</li>";
        $analysis .= "<li>Достигает вершин в выбранной сфере</li>";
        $analysis .= "<li>Может быть трудоголиком</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> не забывать об отдыхе и личной жизни</li>";
        $analysis .= "</ul>";
    } else {
        $analysis .= "<span class='level-excellent'>ЭКСТРЕМАЛЬНАЯ (9+ баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Целеустремлённость как образ жизни</li>";
        $analysis .= "<li>Может жертвовать всем ради цели</li>";
        $analysis .= "<li>Риск идти «по головам»</li>";
        $analysis .= "<li>Потенциал великих достижений</li>";
        $analysis .= "<li>Важно сохранять человечность</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> альтруизм, помощь другим</li>";
        $analysis .= "</ul>";
    }
    
    $analysis .= "</div></div>";
    return $analysis;
}

/**
 * Строка 4-5-6: СЕМЕЙНОСТЬ И БЫТОВАЯ СТАБИЛЬНОСТЬ
 * Формула: сумма значений ячеек 4 + 5 + 6
 * Отвечает за: семейные ценности, отношения, домашний уют
 */
function getLine2Analysis($value) {
    $analysis = "<div class='line-item'>";
    $analysis .= "<h4><i class='fas fa-home'></i> Строка 4-5-6: <span class='line-name'>Семейность и бытовая стабильность</span></h4>";
    $analysis .= "<div class='line-formula'>Формула: [4] + [5] + [6] = <strong>$value</strong> баллов</div>";
    $analysis .= "<div class='line-description'>";
    
    if ($value == 0) {
        $analysis .= "<span class='level-critical'>ОТСУТСТВУЕТ (0 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Не семейный человек по своей природе</li>";
        $analysis .= "<li>Домашние хлопоты в тягость</li>";
        $analysis .= "<li>Предпочитает одиночество или свободу от обязательств</li>";
        $analysis .= "<li>Серьёзные сложности в создании и поддержании семьи</li>";
        $analysis .= "<li>Не чувствует потребности в семейном очаге</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> осознать, нужно ли вообще создавать семью</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 2) {
        $analysis .= "<span class='level-weak'>СЛАБАЯ (1-2 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Семья не является главным приоритетом</li>";
        $analysis .= "<li>Домашние дела воспринимаются как обязанность</li>";
        $analysis .= "<li>Нуждается в большом личном пространстве</li>";
        $analysis .= "<li>Создаёт семью поздно или после долгих раздумий</li>";
        $analysis .= "<li>Может быть хорошим партнёром, но не семьянином</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> искать партнёра с похожими взглядами</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 4) {
        $analysis .= "<span class='level-medium'>НОРМАЛЬНАЯ (3-4 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Хороший семьянин, ценит домашний уют</li>";
        $analysis .= "<li>Баланс между семьёй и личными интересами</li>";
        $analysis .= "<li>Заботится о близких, создаёт комфорт</li>";
        $analysis .= "<li>Ответственно подходит к семейным обязанностям</li>";
        $analysis .= "<li>Семья важна, но не единственное в жизни</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> уделять качественное время семье</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 6) {
        $analysis .= "<span class='level-good'>ВЫСОКАЯ (5-6 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Очень семейный человек</li>";
        $analysis .= "<li>Семья — главная ценность и опора</li>";
        $analysis .= "<li>Отличный хозяин/хозяйка, создаёт уют</li>";
        $analysis .= "<li>Часто имеет большую и дружную семью</li>";
        $analysis .= "<li>Жертвует личными интересами ради семьи</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> не забывать о собственных потребностях</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 8) {
        $analysis .= "<span class='level-strong'>ОЧЕНЬ ВЫСОКАЯ (7-8 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Живёт ради семьи, полностью посвящает себя близким</li>";
        $analysis .= "<li>Может быть гиперопекающим родителем/партнёром</li>";
        $analysis .= "<li>Семья как смысл жизни</li>";
        $analysis .= "<li>Часто многодетный родитель или глава большого рода</li>";
        $analysis .= "<li>Создаёт семейные традиции и династии</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> давать близким свободу и самостоятельность</li>";
        $analysis .= "</ul>";
    } else {
        $analysis .= "<span class='level-excellent'>ПРЕДЕЛЬНАЯ (9+ баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Семейность как кармическая задача</li>";
        $analysis .= "<li>Может жертвовать всем ради семьи</li>";
        $analysis .= "<li>Создаёт род как наследие</li>";
        $analysis .= "<li>Сильная родовая карма</li>";
        $analysis .= "<li>Важно сохранять здоровые границы</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> семейная терапия, работа с родовыми программами</li>";
        $analysis .= "</ul>";
    }
    
    $analysis .= "</div></div>";
    return $analysis;
}

/**
 * Строка 7-8-9: ДУХОВНОСТЬ И ИНТЕЛЛЕКТУАЛЬНОЕ РАЗВИТИЕ
 * Формула: сумма значений ячеек 7 + 8 + 9
 * Отвечает за: духовный рост, интеллект, саморазвитие
 */
function getLine3Analysis($value) {
    $analysis = "<div class='line-item'>";
    $analysis .= "<h4><i class='fas fa-brain'></i> Строка 7-8-9: <span class='line-name'>Духовность и интеллектуальное развитие</span></h4>";
    $analysis .= "<div class='line-formula'>Формула: [7] + [8] + [9] = <strong>$value</strong> баллов</div>";
    $analysis .= "<div class='line-description'>";
    
    if ($value == 0) {
        $analysis .= "<span class='level-critical'>ОТСУТСТВУЕТ (0 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Сугубо материалистический взгляд на мир</li>";
        $analysis .= "<li>Не интересуется духовными вопросами</li>";
        $analysis .= "<li>Очень узкий кругозор и интересы</li>";
        $analysis .= "<li>Не видит смысла в саморазвитии</li>";
        $analysis .= "<li>Ограниченное мышление</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> начинать с популярной науки, документальных фильмов</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 2) {
        $analysis .= "<span class='level-weak'>НИЗКИЙ (1-2 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Интересуется духовностью поверхностно</li>";
        $analysis .= "<li>Есть базовые интеллектуальные интересы</li>";
        $analysis .= "<li>Развивается в основном в практических сферах</li>";
        $analysis .= "<li>Духовность не является приоритетом</li>";
        $analysis .= "<li>Читает развлекательную литературу</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> введение в философию, психологию</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 4) {
        $analysis .= "<span class='level-medium'>НОРМАЛЬНЫЙ (3-4 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Гармоничное развитие ума и духа</li>";
        $analysis .= "<li>Интересуется разными сферами знаний</li>";
        $analysis .= "<li>Есть духовные поиски и размышления</li>";
        $analysis .= "<li>Регулярно занимается саморазвитием</li>";
        $analysis .= "<li>Баланс между материальным и духовным</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> углубление в выбранные направления</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 6) {
        $analysis .= "<span class='level-good'>ВЫСОКИЙ (5-6 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Высокая степень духовности</li>";
        $analysis .= "<li>Широкий кругозор и эрудиция</li>";
        $analysis .= "<li>Глубокие интеллектуальные интересы</li>";
        $analysis .= "<li>Постоянный процесс саморазвития</li>";
        $analysis .= "<li>Часто занимается исследовательской деятельностью</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> делиться знаниями, преподавать</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 8) {
        $analysis .= "<span class='level-strong'>ОЧЕНЬ ВЫСОКИЙ (7-8 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Глубокая духовность, возможно призвание</li>";
        $analysis .= "<li>Энциклопедические знания в нескольких областях</li>";
        $analysis .= "<li>Может быть философом, учёным, духовным учителем</li>";
        $analysis .= "<li>Постоянный поиск истины и смысла</li>";
        $analysis .= "<li>Вдохновляет других на развитие</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> писать книги, создавать учение</li>";
        $analysis .= "</ul>";
    } else {
        $analysis .= "<span class='level-excellent'>ВЫДАЮЩИЙСЯ (9+ баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Мудрец, возможно просветлённая личность</li>";
        $analysis .= "<li>Знания на грани откровения</li>";
        $analysis .= "<li>Может совершить духовное или научное открытие</li>";
        $analysis .= "<li>Сильная кармическая связь с знанием</li>";
        $analysis .= "<li>Важно передать знания следующим поколениям</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> ученики, последователи, наследие</li>";
        $analysis .= "</ul>";
    }
    
    $analysis .= "</div></div>";
    return $analysis;
}
function getDiag1Analysis($value) {
    $analysis = "<div class='line-item'>";
    $analysis .= "<h4><i class='fas fa-balance-scale'></i> Диагональ 1-5-9: <span class='line-name'>Духовная стабильность и темперамент</span></h4>";
    $analysis .= "<div class='line-formula'>Формула: [1] + [5] + [9] = <strong>$value</strong> баллов</div>";
    $analysis .= "<div class='line-description'>";
    
    if ($value == 0) {
        $analysis .= "<span class='level-critical'>КРИТИЧЕСКИ НИЗКАЯ (0 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Крайне нестабильная психика и эмоциональный фон</li>";
        $analysis .= "<li>Частые и резкие перепады настроения без видимых причин</li>";
        $analysis .= "<li>Отсутствие внутреннего стержня и опоры</li>";
        $analysis .= "<li>Полная зависимость от внешних обстоятельств и мнения других</li>";
        $analysis .= "<li>Склонность к неврозам, паническим атакам, депрессивным состояниям</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> обязательная работа с психологом/психотерапевтом, медитация, дыхательные практики</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 2) {
        $analysis .= "<span class='level-weak'>НИЗКАЯ (1-2 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Эмоциональная неустойчивость, подверженность стрессам</li>";
        $analysis .= "<li>Настроение сильно зависит от обстоятельств и окружения</li>";
        $analysis .= "<li>Трудно сохранять спокойствие в сложных ситуациях</li>";
        $analysis .= "<li>Склонность к импульсивным решениям под влиянием эмоций</li>";
        $analysis .= "<li>Внутренний дискомфорт при необходимости принимать важные решения</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> практики эмоционального интеллекта, йога, ведение дневника эмоций</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 4) {
        $analysis .= "<span class='level-medium'>НОРМАЛЬНАЯ (3-4 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Уравновешенный темперамент в обычных условиях</li>";
        $analysis .= "<li>Способен сохранять самообладание в большинстве ситуаций</li>";
        $analysis .= "<li>Есть внутренний стержень, но он может «прогибаться» под сильным давлением</li>";
        $analysis .= "<li>Эмоциональные реакции адекватны ситуации</li>";
        $analysis .= "<li>Может переживать стресс, но обычно находит способы восстановления</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> укрепление нервной системы, здоровый сон, режим дня</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 6) {
        $analysis .= "<span class='level-good'>ВЫСОКАЯ (5-6 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Стабильная психика, устойчивая нервная система</li>";
        $analysis .= "<li>Спокойствие и самообладание даже в критических ситуациях</li>";
        $analysis .= "<li>Сильный внутренний стержень, независимость от внешних влияний</li>";
        $analysis .= "<li>Редкие и контролируемые эмоциональные всплески</li>";
        $analysis .= "<li>Быстрое восстановление после стрессовых событий</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> развивать лидерские качества, так как эта стабильность может вести за собой других</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 8) {
        $analysis .= "<span class='level-strong'>ОЧЕНЬ ВЫСОКАЯ (7-8 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>«Железные» нервы, исключительная эмоциональная устойчивость</li>";
        $analysis .= "<li>Невероятное самообладание в любых, даже экстремальных ситуациях</li>";
        $analysis .= "<li>Внутренняя гармония и баланс, которые трудно нарушить</li>";
        $analysis .= "<li>Часто обладает философским складом ума, принимает жизнь как есть</li>";
        $analysis .= "<li>Может быть опорой и поддержкой для других в трудные времена</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> важно не стать эмоционально «толстокожим», сохранять эмпатию</li>";
        $analysis .= "</ul>";
    } else {
        $analysis .= "<span class='level-excellent'>ИСКЛЮЧИТЕЛЬНАЯ (9+ баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Феноменальная духовная стабильность, почти недостижимая для обычных людей</li>";
        $analysis .= "<li>Возможно, результат кармических наработок или высокого уровня духовного развития</li>";
        $analysis .= "<li>Практически полный контроль над своими эмоциями и психическими процессами</li>";
        $analysis .= "<li>Такие люди часто становятся духовными учителями, мудрецами, великими полководцами или политиками</li>";
        $analysis .= "<li>Риск оторваться от обычных человеческих переживаний и стать «не от мира сего»</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> использовать стабильность для помощи другим, а не для изоляции</li>";
        $analysis .= "</ul>";
    }
    
    $analysis .= "</div></div>";
    return $analysis;
}

/**
 * Диагональ 3-5-7: СЕКСУАЛЬНОСТЬ, ЧУВСТВЕННОСТЬ И ТЕМПЕРАМЕНТ
 * Формула: сумма значений ячеек 3 + 5 + 7
 * Отвечает за: сексуальную энергию, чувственность, страсть, темперамент в отношениях
 */
function getDiag2Analysis($value) {
    $analysis = "<div class='line-item'>";
    $analysis .= "<h4><i class='fas fa-heart'></i> Диагональ 3-5-7: <span class='line-name'>Сексуальность, чувственность и страсть</span></h4>";
    $analysis .= "<div class='line-formula'>Формула: [3] + [5] + [7] = <strong>$value</strong> баллов</div>";
    $analysis .= "<div class='line-description'>";
    
    if ($value == 0) {
        $analysis .= "<span class='level-critical'>ОТСУТСТВУЕТ (0 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Очень низкая или подавленная сексуальная энергия</li>";
        $analysis .= "<li>Возможное безразличие к интимной стороне жизни</li>";
        $analysis .= "<li>Трудности в проявлении чувственности и нежности</li>";
        $analysis .= "<li>Секс может восприниматься как обязанность, а не удовольствие</li>";
        $analysis .= "<li>Возможны психологические блоки или травмы в этой сфере</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> консультация сексолога, работа с телесными практиками, танцы</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 2) {
        $analysis .= "<span class='level-weak'>НИЗКАЯ (1-2 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Умеренный интерес к сексуальной жизни</li>";
        $analysis .= "<li>Чувственность проявляется редко и с близким партнёром</li>";
        $analysis .= "<li>Не склонен к экспериментированию в интимной сфере</li>";
        $analysis .= "<li>Секс — часть жизни, но не главная её составляющая</li>";
        $analysis .= "<li>Может быть скованным или зажатым в проявлении страсти</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> развитие чувствительности через массаж, ароматерапию, чувственные практики</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 4) {
        $analysis .= "<span class='level-medium'>НОРМАЛЬНАЯ (3-4 балла)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Гармоничная, здоровая сексуальность</li>";
        $analysis .= "<li>Способен наслаждаться интимной жизнью и дарить наслаждение партнёру</li>";
        $analysis .= "<li>Чувственность и страсть проявляются в отношениях</li>";
        $analysis .= "<li>Открыт к умеренному экспериментированию с доверенным партнёром</li>";
        $analysis .= "<li>Баланс между духовным и физическим в отношениях</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> поддерживать романтику и новизну в длительных отношениях</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 6) {
        $analysis .= "<span class='level-good'>ВЫСОКАЯ (5-6 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Сильная сексуальная энергия, яркая чувственность</li>";
        $analysis .= "<li>Страсть и темпераментность в отношениях</li>";
        $analysis .= "<li>Привлекательность для противоположного пола, природный магнетизм</li>";
        $analysis .= "<li>Открытость к экспериментам и новым ощущениям в интимной сфере</li>";
        $analysis .= "<li>Секс — важная и яркая часть жизни</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> направлять эту энергию также в творчество, чтобы не было перекоса</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 8) {
        $analysis .= "<span class='level-strong'>ОЧЕНЬ ВЫСОКАЯ (7-8 баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Мощная, иногда бурная сексуальная энергия</li>";
        $analysis .= "<li>Сильная страсть, которая может доминировать в жизни</li>";
        $analysis .= "<li>Яркий темперамент, который трудно контролировать</li>";
        $analysis .= "<li>Притягательность, которая может граничить с магнетизмом или даже вампиризмом</li>";
        $analysis .= "<li>Риск становиться зависимым от страсти или делать её главным смыслом</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> учиться управлять этой энергией, сублимировать её в творчество, спорт, духовные практики</li>";
        $analysis .= "</ul>";
    } else {
        $analysis .= "<span class='level-excellent'>ЭКСТРЕМАЛЬНАЯ (9+ баллов)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Огромная, почти неконтролируемая сексуальная энергия</li>";
        $analysis .= "<li>Страсть, которая может разрушать, если не направлена в конструктивное русло</li>";
        $analysis .= "<li>Возможны комплексы, связанные с этой силой, или, наоборот, злоупотребление ею</li>";
        $analysis .= "<li>Такие люди часто становятся объектами сильного влечения, роковыми соблазнителями/соблазнительницами</li>";
        $analysis .= "<li>Кармические задачи, связанные с контролем над низшими энергиями и их трансформацией</li>";
        $analysis .= "<li><strong>Рекомендация:</strong> обязательная работа с этой энергией через тантрические практики, серьёзную духовную дисциплину, возможно, целительство</li>";
        $analysis .= "</ul>";
    }
    
    $analysis .= "</div></div>";
    return $analysis;
}

/**
 * ДОПОЛНИТЕЛЬНЫЙ АНАЛИЗ: ПУСТЫЕ ЯЧЕЙКИ
 * Анализирует количество неразвитых качеств в матрице
 */
function getEmptyCellsAnalysis($value, $total_cells = 9) {
    $analysis = "<div class='additional-item'>";
    $analysis .= "<h4><i class='fas fa-chart-pie'></i> Анализ баланса качеств</h4>";
    $analysis .= "<div class='additional-formula'>Пустых ячеек: <strong>$value</strong> из $total_cells</div>";
    $analysis .= "<div class='additional-description'>";
    
    $filled_cells = $total_cells - $value;
    $percentage_filled = round(($filled_cells / $total_cells) * 100);
    
    if ($value == 0) {
        $analysis .= "<span class='level-excellent'>ИДЕАЛЬНЫЙ БАЛАНС (100% заполнено)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Все 9 качеств личности в той или иной степени развиты</li>";
        $analysis .= "<li>Гармоничная, универсальная личность</li>";
        $analysis .= "<li>Может адаптироваться к разным ситуациям и сферам жизни</li>";
        $analysis .= "<li>Редкий и ценный баланс</li>";
        $analysis .= "<li><strong>Вывод:</strong> ваша задача — поддерживать этот баланс и развивать сильные стороны</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 2) {
        $analysis .= "<span class='level-good'>ХОРОШИЙ БАЛАНС ($percentage_filled% заполнено)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Большинство качеств (7-8 из 9) присутствуют в матрице</li>";
        $analysis .= "<li>Есть несколько слабых мест, но они не критичны</li>";
        $analysis .= "<li>Личность достаточно целостная и разносторонняя</li>";
        $analysis .= "<li>Можно успешно реализоваться в разных сферах</li>";
        $analysis .= "<li><strong>Вывод:</strong> работайте над 1-2 слабыми качествами для полной гармонии</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 4) {
        $analysis .= "<span class='level-medium'>УМЕРЕННЫЙ ДИСБАЛАНС ($percentage_filled% заполнено)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Примерно половина качеств развита, половина — отсутствует или слаба</li>";
        $analysis .= "<li>Есть явные сильные и слабые стороны</li>";
        $analysis .= "<li>Возможны проблемы в сферах, связанных с отсутствующими качествами</li>";
        $analysis .= "<li>Нужно осознанно развивать недостающие аспекты личности</li>";
        $analysis .= "<li><strong>Вывод:</strong> сконцентрируйтесь на развитии 3-4 самых важных для вас отсутствующих качеств</li>";
        $analysis .= "</ul>";
    } elseif ($value <= 6) {
        $analysis .= "<span class='level-weak'>ЗНАЧИТЕЛЬНЫЙ ДИСБАЛАНС ($percentage_filled% заполнено)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Только 3-5 качеств из 9 присутствуют в матрице</li>";
        $analysis .= "<li>Много «слепых зон» и неразвитых аспектов личности</li>";
        $analysis .= "<li>Возможны кармические задачи, связанные с развитием недостающих качеств</li>";
        $analysis .= "<li>Жизнь может постоянно «бить» по слабым местам</li>";
        $analysis .= "<li><strong>Вывод:</strong> необходима систематическая работа над собой, возможно, с помощью коуча или психолога</li>";
        $analysis .= "</ul>";
    } else {
        $analysis .= "<span class='level-critical'>КРИТИЧЕСКИЙ ДИСБАЛАНС ($percentage_filled% заполнено)</span>";
        $analysis .= "<ul>";
        $analysis .= "<li>Только 1-2 качества развиты, остальные 7-8 отсутствуют</li>";
        $analysis .= "<li>Сильнейший перекос в развитии личности</li>";
        $analysis .= "<li>Высока вероятность серьёзных жизненных кризисов и проблем</li>";
        $analysis .= "<li>Кармические уроки, требующие срочной проработки</li>";
        $analysis .= "<li><strong>Вывод:</strong> это знак для глубокой внутренней работы. Возможно, в прошлых жизнях вы развивали только узкие аспекты, теперь пришло время баланса</li>";
        $analysis .= "</ul>";
    }
    
    $analysis .= "</div></div>";
    return $analysis;
}

/**
 * ДОПОЛНИТЕЛЬНЫЙ АНАЛИЗ: САМЫЕ СИЛЬНЫЕ ЧИСЛА
 * Показывает наиболее развитые качества личности
 */
function getStrongNumbersAnalysis($numbers, $max_value) {
    $analysis = "<div class='additional-item'>";
    $analysis .= "<h4><i class='fas fa-crown'></i> Самые сильные качества</h4>";
    
    if (empty($numbers)) {
        $analysis .= "<div class='additional-description'>";
        $analysis .= "<span class='level-weak'>Нет явно выраженных сильных качеств</span>";
        $analysis .= "<p>Все качества развиты примерно одинаково или отсутствуют.</p>";
        $analysis .= "</div>";
        $analysis .= "</div>";
        return $analysis;
    }
    
    $qualities = [
        1 => "Характер и воля",
        2 => "Энергия и эмоции", 
        3 => "Интеллект и наука",
        4 => "Здоровье и сила",
        5 => "Логика и интуиция",
        6 => "Труд и мастерство",
        7 => "Удача и таланты",
        8 => "Ответственность и долг",
        9 => "Память и ум"
    ];
    
    $numbers_list = implode(', ', $numbers);
    $quality_names = [];
    foreach($numbers as $num) {
        $quality_names[] = $qualities[$num];
    }
    $qualities_list = implode(', ', $quality_names);
    
    $analysis .= "<div class='additional-formula'>Числа: <strong>$numbers_list</strong> (по $max_value единиц)</div>";
    $analysis .= "<div class='additional-description'>";
    
    if ($max_value == 1) {
        $analysis .= "<span class='level-medium'>УМЕРЕННО РАЗВИТЫ</span>";
        $analysis .= "<p>Качества <strong>$qualities_list</strong> являются вашими относительными сильными сторонами, но требуют дальнейшего развития.</p>";
        $analysis .= "<p>Эти качества вы можете использовать как опору в жизни.</p>";
    } elseif ($max_value == 2) {
        $analysis .= "<span class='level-good'>ХОРОШО РАЗВИТЫ</span>";
        $analysis .= "<p>Качества <strong>$qualities_list</strong> — это ваши явные сильные стороны.</p>";
        $analysis .= "<p>Именно на них стоит опираться при выборе профессии, жизненного пути и решении сложных задач.</p>";
    } elseif ($max_value == 3) {
        $analysis .= "<span class='level-strong'>ОЧЕНЬ СИЛЬНО РАЗВИТЫ</span>";
        $analysis .= "<p>Качества <strong>$qualities_list</strong> — ваши суперсилы!</p>";
        $analysis .= "<p>Они могут быть вашим главным преимуществом в жизни. Возможно, именно в этих сферах вы можете достичь мастерства или даже гениальности.</p>";
    } else {
        $analysis .= "<span class='level-excellent'>ЧРЕЗВЫЧАЙНО РАЗВИТЫ</span>";
        $analysis .= "<p>Качества <strong>$qualities_list</strong> развиты на экстремальном уровне.</p>";
        $analysis .= "<p>Это может быть как огромным даром, так и вызовом (например, слишком сильный характер может мешать в отношениях). Учитесь управлять этими силами.</p>";
    }
    
    $analysis .= "</div></div>";
    return $analysis;
}

/**
 * ДОПОЛНИТЕЛЬНЫЙ АНАЛИЗ: САМЫЕ СЛАБЫЕ ЧИСЛА
 * Показывает наименее развитые качества личности
 */
function getWeakNumbersAnalysis($numbers) {
    $analysis = "<div class='additional-item'>";
    $analysis .= "<h4><i class='fas fa-exclamation-triangle'></i> Слабые места для развития</h4>";
    
    if (empty($numbers)) {
        $analysis .= "<div class='additional-description'>";
        $analysis .= "<span class='level-excellent'>Нет слабых мест!</span>";
        $analysis .= "<p>Все качества в матрице присутствуют. Это редкий и замечательный показатель гармоничной личности.</p>";
        $analysis .= "</div>";
        $analysis .= "</div>";
        return $analysis;
    }
    
    $qualities = [
        1 => "Характер и воля",
        2 => "Энергия и эмоции", 
        3 => "Интеллект и наука",
        4 => "Здоровье и сила",
        5 => "Логика и интуиция",
        6 => "Труд и мастерство",
        7 => "Удача и таланты",
        8 => "Ответственность и долг",
        9 => "Память и ум"
    ];
    
    $numbers_list = implode(', ', $numbers);
    $quality_names = [];
    foreach($numbers as $num) {
        $quality_names[] = $qualities[$num];
    }
    $qualities_list = implode(', ', $quality_names);
    $count = count($numbers);
    
    $analysis .= "<div class='additional-formula'>Пустые числа: <strong>$numbers_list</strong> ($count из 9)</div>";
    $analysis .= "<div class='additional-description'>";
    
    if ($count == 1) {
        $analysis .= "<span class='level-medium'>НЕБОЛЬШОЙ ДИСБАЛАНС</span>";
        $analysis .= "<p>Качество <strong>$qualities_list</strong> отсутствует в вашей матрице.</p>";
        $analysis .= "<p>Это ваша зона роста. Уделите внимание развитию этого аспекта личности, и вы станете более гармоничным человеком.</p>";
    } elseif ($count <= 3) {
        $analysis .= "<span class='level-weak'>ЗОНЫ РОСТА</span>";
        $analysis .= "<p>Качества <strong>$qualities_list</strong> требуют особого внимания и развития.</p>";
        $analysis .= "<p>Именно в этих сферах вас могут ждать жизненные уроки и вызовы. Развитие этих качеств может значительно улучшить вашу жизнь.</p>";
    } elseif ($count <= 5) {
        $analysis .= "<span class='level-weak'>СЕРЬЁЗНЫЕ СЛАБЫЕ СТОРОНЫ</span>";
        $analysis .= "<p>Качества <strong>$qualities_list</strong> практически не развиты.</p>";
        $analysis .= "<p>Это указывает на возможные кармические задачи. Жизнь будет постоянно сталкивать вас с ситуациями, требующими развития именно этих качеств.</p>";
        $analysis .= "<p><strong>Совет:</strong> начните с развития 1-2 самых важных для вас качеств из этого списка.</p>";
    } else {
        $analysis .= "<span class='level-critical'>КРИТИЧЕСКИЕ СЛАБЫЕ СТОРОНЫ</span>";
        $analysis .= "<p>Качества <strong>$qualities_list</strong> полностью отсутствуют.</p>";
        $analysis .= "<p>Это указывает на сильный кармический дисбаланс. Вероятно, в прошлых жизнях вы игнорировали развитие этих аспектов.</p>";
        $analysis .= "<p><strong>Важно:</strong> не пытайтесь развивать всё сразу. Выберите 1-2 качества, которые наиболее важны для вашей текущей жизни, и сконцентрируйтесь на них.</p>";
    }
    
    // Добавим практические рекомендации для каждого слабого числа
    $analysis .= "<div class='recommendations'><strong>Практические рекомендации по развитию:</strong><ul>";
    
    foreach($numbers as $num) {
        $rec = getRecommendationForNumber($num);
        $analysis .= "<li><strong>{$qualities[$num]}:</strong> $rec</li>";
    }
    
    $analysis .= "</ul></div>";
    $analysis .= "</div></div>";
    return $analysis;
}
////////////////анализ дополнительных чисел
///////////////
// $firstNumber = sumDigits($day) + sumDigits($month) + sumDigits($year);//первое рабочее число
//      $secondNumber = sumDigits($firstNumber);//второе рабочее число
//      $firstDigitOfDay = (int)substr((string)$day, 0, 1);
//     $thirdNumber = $firstNumber - 2 * $firstDigitOfDay;//3-е рабочее число
//     if ($thirdNumber < 0) $thirdNumber = abs($thirdNumber);
//     $fourthNumber = sumDigits($thirdNumber);//4 рабочее число
// 1 допчисло
function AnalDopNum1($value) {
    $analysis = "<div class='line-item'>";
    $analysis .= "<h4><i class='fas fa-bullseye'></i> Первое дополнительное число: <span class='line-name'>Число цели и жизненной задачи</span></h4>";
    $analysis .= "<div class='line-formula'>Расчет: сумма всех цифр даты рождения = <strong>$value</strong></div>";
    $analysis .= "<div class='line-description'>";
    
    // Получаем цифры для анализа
    $firstDigit = floor($value / 10);
    $secondDigit = $value % 10;
    $reducedValue = $value;
    while($reducedValue > 9 && $reducedValue != 11 && $reducedValue != 22) {
        $reducedValue = array_sum(str_split((string)$reducedValue));
    }
    
    /***************************************************************************
     * РАЗДЕЛ 1: ОДНОЗНАЧНЫЕ ЧИСЛА (1-9)
     ***************************************************************************/
    if ($value >= 1 && $value <= 9) {
        switch($value) {
            case 1: // ЕДИНИЦА
                $analysis .= "<span class='level-strong'>1 — ЛИДЕР</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-crown'></i> ХАРАКТЕРИСТИКА</h5>";
                $analysis .= "<p><strong>Первое число 1</strong> говорит о том, что ваша главная цель — научиться быть лидером, проявлять инициативу и не бояться быть первым.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Цель жизни:</strong> стать самостоятельным, независимым человеком</li>";
                $analysis .= "<li><strong>Качества для развития:</strong> воля, решительность, смелость</li>";
                $analysis .= "<li><strong>Таланты от рождения:</strong> способность начинать новое, вести за собой</li>";
                $analysis .= "<li><strong>Слабости:</strong> эгоизм, желание подавлять, неумение слушать</li>";
                $analysis .= "<li><strong>Профессии:</strong> руководитель, предприниматель, военный</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> учитесь вести за собой, но не подавлять. Истинный лидер тот, за кем идут добровольно.</div>";
                break;
                
            case 2: // ДВОЙКА
                $analysis .= "<span class='level-medium'>2 — МИРОТВОРЕЦ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-handshake'></i> ХАРАКТЕРИСТИКА</h5>";
                $analysis .= "<p><strong>Первое число 2</strong> говорит о том, что ваша главная цель — научиться гармоничному взаимодействию с людьми.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Цель жизни:</strong> создавать баланс и гармонию в отношениях</li>";
                $analysis .= "<li><strong>Качества для развития:</strong> дипломатичность, терпение, тактичность</li>";
                $analysis .= "<li><strong>Таланты от рождения:</strong> чувствительность, умение сглаживать конфликты</li>";
                $analysis .= "<li><strong>Слабости:</strong> зависимость от чужого мнения, нерешительность</li>";
                $analysis .= "<li><strong>Профессии:</strong> психолог, дипломат, переговорщик</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> учитесь отстаивать свои интересы, не теряя дипломатичности.</div>";
                break;
                
            case 3: // ТРОЙКА
                $analysis .= "<span class='level-good'>3 — ТВОРЕЦ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-paint-brush'></i> ХАРАКТЕРИСТИКА</h5>";
                $analysis .= "<p><strong>Первое число 3</strong> говорит о том, что ваша главная цель — раскрыть творческий потенциал.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Цель жизни:</strong> научиться выражать себя, творить и радоваться</li>";
                $analysis .= "<li><strong>Качества для развития:</strong> оптимизм, вдохновение, креативность</li>";
                $analysis .= "<li><strong>Таланты от рождения:</strong> артистизм, легкость в общении</li>";
                $analysis .= "<li><strong>Слабости:</strong> поверхностность, разбросанность</li>";
                $analysis .= "<li><strong>Профессии:</strong> артист, писатель, дизайнер</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> творите, но доводите дела до конца.</div>";
                break;
                
            case 4: // ЧЕТВЁРКА
                $analysis .= "<span class='level-strong'>4 — СТРОИТЕЛЬ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-building'></i> ХАРАКТЕРИСТИКА</h5>";
                $analysis .= "<p><strong>Первое число 4</strong> говорит о том, что ваша главная цель — создать прочный фундамент в жизни.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Цель жизни:</strong> научиться порядку, дисциплине, стабильности</li>";
                $analysis .= "<li><strong>Качества для развития:</strong> трудолюбие, ответственность, системность</li>";
                $analysis .= "<li><strong>Таланты от рождения:</strong> надежность, практичность</li>";
                $analysis .= "<li><strong>Слабости:</strong> косность, упрямство, застревание в мелочах</li>";
                $analysis .= "<li><strong>Профессии:</strong> строитель, бухгалтер, администратор</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> стройте, но учитесь гибкости.</div>";
                break;
                
            case 5: // ПЯТЁРКА
                $analysis .= "<span class='level-good'>5 — СВОБОДНЫЙ СТРАННИК</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-globe'></i> ХАРАКТЕРИСТИКА</h5>";
                $analysis .= "<p><strong>Первое число 5</strong> говорит о том, что ваша главная цель — принять свободу и перемены.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Цель жизни:</strong> научиться адаптироваться, меняться, пробовать новое</li>";
                $analysis .= "<li><strong>Качества для развития:</strong> гибкость, любознательность, прогрессивность</li>";
                $analysis .= "<li><strong>Таланты от рождения:</strong> легкость на подъем, обаяние</li>";
                $analysis .= "<li><strong>Слабости:</strong> хаотичность, безответственность</li>";
                $analysis .= "<li><strong>Профессии:</strong> путешественник, журналист, предприниматель</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> меняйтесь, но не теряйте корней.</div>";
                break;
                
            case 6: // ШЕСТЁРКА
                $analysis .= "<span class='level-medium'>6 — ЗАБОТЛИВОЕ СЕРДЦЕ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-heart'></i> ХАРАКТЕРИСТИКА</h5>";
                $analysis .= "<p><strong>Первое число 6</strong> говорит о том, что ваша главная цель — научиться заботе и ответственности.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Цель жизни:</strong> создавать гармонию в отношениях, заботиться о близких</li>";
                $analysis .= "<li><strong>Качества для развития:</strong> доброта, понимание, семейственность</li>";
                $analysis .= "<li><strong>Таланты от рождения:</strong> умение создавать уют, заботливость</li>";
                $analysis .= "<li><strong>Слабости:</strong> гиперопека, жертвенность</li>";
                $analysis .= "<li><strong>Профессии:</strong> врач, учитель, социальный работник</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> заботьтесь, но не теряйте себя.</div>";
                break;
                
            case 7: // СЕМЁРКА
                $analysis .= "<span class='level-strong'>7 — ИСКАТЕЛЬ ИСТИНЫ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-search'></i> ХАРАКТЕРИСТИКА</h5>";
                $analysis .= "<p><strong>Первое число 7</strong> говорит о том, что ваша главная цель — познать истину.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Цель жизни:</strong> развить аналитический ум, интуицию, духовность</li>";
                $analysis .= "<li><strong>Качества для развития:</strong> мудрость, глубина, сосредоточенность</li>";
                $analysis .= "<li><strong>Таланты от рождения:</strong> аналитический склад ума, интуиция</li>";
                $analysis .= "<li><strong>Слабости:</strong> замкнутость, высокомерие</li>";
                $analysis .= "<li><strong>Профессии:</strong> ученый, философ, программист</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> познавайте, но не закрывайтесь от мира.</div>";
                break;
                
            case 8: // ВОСЬМЁРКА
                $analysis .= "<span class='level-excellent'>8 — ВЛАСТЕЛИН</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-chart-bar'></i> ХАРАКТЕРИСТИКА</h5>";
                $analysis .= "<p><strong>Первое число 8</strong> говорит о том, что ваша главная цель — достичь материального успеха и научиться управлять.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Цель жизни:</strong> научиться управлять ресурсами, достигать вершин</li>";
                $analysis .= "<li><strong>Качества для развития:</strong> деловая хватка, справедливость, власть</li>";
                $analysis .= "<li><strong>Таланты от рождения:</strong> организаторские способности, масштабное мышление</li>";
                $analysis .= "<li><strong>Слабости:</strong> жадность, властолюбие</li>";
                $analysis .= "<li><strong>Профессии:</strong> топ-менеджер, банкир, политик</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> стремитесь к изобилию, но будьте справедливы.</div>";
                break;
                
            case 9: // ДЕВЯТКА
                $analysis .= "<span class='level-good'>9 — МУДРЕЦ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-dove'></i> ХАРАКТЕРИСТИКА</h5>";
                $analysis .= "<p><strong>Первое число 9</strong> говорит о том, что ваша главная цель — служить людям и делиться мудростью.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Цель жизни:</strong> научиться состраданию, альтруизму, мудрости</li>";
                $analysis .= "<li><strong>Качества для развития:</strong> понимание, терпимость, щедрость</li>";
                $analysis .= "<li><strong>Таланты от рождения:</strong> глубокая мудрость, умение прощать</li>";
                $analysis .= "<li><strong>Слабости:</strong> фанатизм, отрыв от реальности</li>";
                $analysis .= "<li><strong>Профессии:</strong> учитель, священник, благотворитель</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> помогайте, но не забывайте о себе.</div>";
                break;
        }
    }
    
    /***************************************************************************
     * РАЗДЕЛ 2: ДВУЗНАЧНЫЕ ЧИСЛА (10-31) С РАЗБОРОМ ПО ДЕСЯТКАМ И ЕДИНИЦАМ
     ***************************************************************************/
    elseif ($value >= 10 && $value <= 31) {
        
        // ОСОБЫЕ СЛУЧАИ: МАСТЕР-ЧИСЛА
        if ($value == 11) {
            $analysis .= "<span class='level-excellent'>11 — МАСТЕР-ЧИСЛО (ПРОСВЕТЛЕННЫЙ)</span>";
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-crown'></i> <i class='fas fa-om'></i> РАЗБОР ЧИСЛА 11</h5>";
            $analysis .= "<p><strong>11 = 1 + 1</strong> — это удвоенная единица, число высшей духовности.</p>";
            $analysis .= "<ul>";
            $analysis .= "<li><strong>Первая цифра (1):</strong> лидерство, воля, начало</li>";
            $analysis .= "<li><strong>Вторая цифра (1):</strong> усиленное лидерство, удвоенная энергия</li>";
            $analysis .= "<li><strong>Сумма цифр (2):</strong> базовая основа — гармония и баланс</li>";
            $analysis .= "<li><strong>Особенность:</strong> МАСТЕР-ЧИСЛО — особая миссия</li>";
            $analysis .= "</ul>";
            $analysis .= "</div>";
            
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-star'></i> ХАРАКТЕРИСТИКА</h5>";
            $analysis .= "<ul>";
            $analysis .= "<li><strong>Цель:</strong> нести свет, вдохновлять, быть проводником высших истин</li>";
            $analysis .= "<li><strong>Сильные стороны:</strong> сверхинтуиция, духовность, харизма</li>";
            $analysis .= "<li><strong>Слабые стороны:</strong> нервное истощение, отрыв от реальности</li>";
            $analysis .= "<li><strong>Миссия:</strong> соединить небо и землю, духовное и материальное</li>";
            $analysis .= "</ul>";
            $analysis .= "</div>";
            $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> вы здесь, чтобы просветлять. Но не забывайте о земле.</div>";
        }
        
        elseif ($value == 22) {
            $analysis .= "<span class='level-excellent'>22 — МАСТЕР-ЧИСЛО (СТРОИТЕЛЬ)</span>";
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-crown'></i> <i class='fas fa-building'></i> РАЗБОР ЧИСЛА 22</h5>";
            $analysis .= "<p><strong>22 = 2 + 2</strong> — это удвоенная двойка, число великого созидания.</p>";
            $analysis .= "<ul>";
            $analysis .= "<li><strong>Первая цифра (2):</strong> гармония, дипломатичность, баланс</li>";
            $analysis .= "<li><strong>Вторая цифра (2):</strong> усиленная гармония, удвоенная чувствительность</li>";
            $analysis .= "<li><strong>Сумма цифр (4):</strong> базовая основа — порядок и созидание</li>";
            $analysis .= "<li><strong>Особенность:</strong> МАСТЕР-ЧИСЛО — способность к масштабным проектам</li>";
            $analysis .= "</ul>";
            $analysis .= "</div>";
            
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-star'></i> ХАРАКТЕРИСТИКА</h5>";
            $analysis .= "<ul>";
            $analysis .= "<li><strong>Цель:</strong> воплощать грандиозные идеи в реальность</li>";
            $analysis .= "<li><strong>Сильные стороны:</strong> масштабное мышление, практичность, сила воли</li>";
            $analysis .= "<li><strong>Слабые стороны:</strong> гиперответственность, выгорание</li>";
            $analysis .= "<li><strong>Миссия:</strong> строить будущее, создавать системы</li>";
            $analysis .= "</ul>";
            $analysis .= "</div>";
            $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> стройте великое, но помните о себе.</div>";
        }
        
        // КАРМИЧЕСКИЕ ЧИСЛА (13,14,16,19)
        elseif (in_array($value, [13,14,16,19])) {
            $analysis .= "<span class='level-strong'>$value — КАРМИЧЕСКОЕ ЧИСЛО</span>";
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-karma'></i> РАЗБОР ЧИСЛА $value</h5>";
            $analysis .= "<p><strong>$value = $firstDigit + $secondDigit = " . ($firstDigit+$secondDigit) . "</strong></p>";
            $analysis .= "<ul>";
            $analysis .= "<li><strong>Первая цифра ($firstDigit):</strong> " . getDigitDescription($firstDigit) . "</li>";
            $analysis .= "<li><strong>Вторая цифра ($secondDigit):</strong> " . getDigitDescription($secondDigit) . "</li>";
            $analysis .= "<li><strong>Базовая основа (" . ($firstDigit+$secondDigit) . "):</strong> " . getBaseDescription($firstDigit+$secondDigit) . "</li>";
            $analysis .= "</ul>";
            $analysis .= "</div>";
            
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-exclamation-triangle'></i> КАРМИЧЕСКАЯ ЗАДАЧА</h5>";
            switch($value) {
                case 13:
                    $analysis .= "<p><strong>Кармический долг 13:</strong> в прошлом вы избегали труда, ленились, перекладывали работу на других.</p>";
                    $analysis .= "<ul>";
                    $analysis .= "<li><strong>Задача:</strong> научиться трудиться с радостью и уважением</li>";
                    $analysis .= "<li><strong>Путь отработки:</strong> дисциплина, но не трудоголизм</li>";
                    $analysis .= "<li><strong>Избегайте:</strong> лени и перекладывания ответственности</li>";
                    $analysis .= "<li><strong>Развивайте:</strong> любовь к процессу, а не только к результату</li>";
                    $analysis .= "</ul>";
                    break;
                case 14:
                    $analysis .= "<p><strong>Кармический долг 14:</strong> в прошлом вы злоупотребляли свободой, вели хаотичный образ жизни.</p>";
                    $analysis .= "<ul>";
                    $analysis .= "<li><strong>Задача:</strong> найти баланс между свободой и ответственностью</li>";
                    $analysis .= "<li><strong>Путь отработки:</strong> умеренность, осознанный выбор</li>";
                    $analysis .= "<li><strong>Избегайте:</strong> крайностей и хаоса</li>";
                    $analysis .= "<li><strong>Развивайте:</strong> самодисциплину при сохранении свободы</li>";
                    $analysis .= "</ul>";
                    break;
                case 16:
                    $analysis .= "<p><strong>Кармический долг 16:</strong> в прошлом вы страдали от гордыни, разрушали отношения.</p>";
                    $analysis .= "<ul>";
                    $analysis .= "<li><strong>Задача:</strong> развить смирение и духовность</li>";
                    $analysis .= "<li><strong>Путь отработки:</strong> принятие, умение прощать</li>";
                    $analysis .= "<li><strong>Избегайте:</strong> высокомерия и эгоизма</li>";
                    $analysis .= "<li><strong>Развивайте:</strong> скромность и уважение к другим</li>";
                    $analysis .= "</ul>";
                    break;
                case 19:
                    $analysis .= "<p><strong>Кармический долг 19:</strong> в прошлом вы злоупотребляли властью.</p>";
                    $analysis .= "<ul>";
                    $analysis .= "<li><strong>Задача:</strong> использовать лидерство во благо других</li>";
                    $analysis .= "<li><strong>Путь отработки:</strong> служение, а не господство</li>";
                    $analysis .= "<li><strong>Избегайте:</strong> тирании и подавления</li>";
                    $analysis .= "<li><strong>Развивайте:</strong> ответственность за тех, кого ведёте</li>";
                    $analysis .= "</ul>";
                    break;
            }
            $analysis .= "</div>";
        }
        
        // ВСЕ ОСТАЛЬНЫЕ ДВУЗНАЧНЫЕ ЧИСЛА (10,12,15,17,18,20-31, кроме особых)
        else {
            $analysis .= "<span class='level-strong'>$value — УПРАВЛЯЮЩЕЕ ЧИСЛО</span>";
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-puzzle-piece'></i> РАЗБОР ЧИСЛА $value</h5>";
            $analysis .= "<p><strong>$value = $firstDigit + $secondDigit = " . ($firstDigit+$secondDigit) . " → $reducedValue</strong></p>";
            $analysis .= "<ul>";
            $analysis .= "<li><strong>Первая цифра ($firstDigit):</strong> " . getDigitDescription($firstDigit) . "</li>";
            $analysis .= "<li><strong>Вторая цифра ($secondDigit):</strong> " . getDigitDescription($secondDigit) . "</li>";
            $analysis .= "<li><strong>Сумма цифр (" . ($firstDigit+$secondDigit) . "):</strong> промежуточная энергия</li>";
            $analysis .= "<li><strong>Базовая основа ($reducedValue):</strong> " . getBaseDescription($reducedValue) . "</li>";
            $analysis .= "</ul>";
            $analysis .= "</div>";
            
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-compass'></i> КЛЮЧЕВАЯ ХАРАКТЕРИСТИКА</h5>";
            
            // Специальные комментарии для разных десятков
            if ($value >= 10 && $value <= 19) {
                $analysis .= "<p><strong>Группа 10-19 (лидерская):</strong> энергия лидерства (1) проявляется через качество числа $secondDigit</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Ваша задача:</strong> проявлять лидерство через " . getDigitDescription($secondDigit) . "</li>";
                $analysis .= "<li><strong>Стиль:</strong> активный, инициативный, прорывной</li>";
                $analysis .= "</ul>";
            }
            elseif ($value >= 20 && $value <= 29) {
                $analysis .= "<p><strong>Группа 20-29 (партнерская):</strong> энергия гармонии (2) проявляется через качество числа $secondDigit</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Ваша задача:</strong> строить гармоничные отношения через " . getDigitDescription($secondDigit) . "</li>";
                $analysis .= "<li><strong>Стиль:</strong> дипломатичный, чувствительный, тактичный</li>";
