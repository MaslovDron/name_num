
/**
 * ВСПОМОГАТЕЛЬНАЯ ФУНКЦИЯ 2: Описание базового числа для 3-го числа
 */
function vspom3_2($num) {
    $bases = [
        1 => 'ваши таланты ведут к лидерству — через развитие способностей вы станете первым',
        2 => 'ваши таланты ведут к гармонии — через способности вы обретете баланс',
        3 => 'ваши таланты ведут к творчеству — через самовыражение вы реализуете себя',
        4 => 'ваши таланты ведут к порядку — через дисциплину вы создадите фундамент',
        5 => 'ваши таланты ведут к свободе — через развитие вы обретете независимость',
        6 => 'ваши таланты ведут к заботе — через служение вы найдете счастье',
        7 => 'ваши таланты ведут к мудрости — через познание вы обретете истину',
        8 => 'ваши таланты ведут к изобилию — через управление вы достигнете успеха',
        9 => 'ваши таланты ведут к служению — через помощь другим вы завершите циклы'
    ];
    return $bases[$num] ?? 'уникальное предназначение ваших талантов';
}

//3 допчисло

//4 допчисло
function AnalDopNum4($value) {
    $analysis = "<div class='line-item'>";
    $analysis .= "<h4><i class='fas fa-road'></i> Четвертое дополнительное число: <span class='line-name'>Число реализации и поддержки</span></h4>";
    $analysis .= "<div class='line-formula'>Расчет: сумма цифр третьего числа = <strong>$value</strong></div>";
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
                $analysis .= "<span class='level-strong'>1 — РЕАЛИЗАЦИЯ ЧЕРЕЗ ЛИДЕРСТВО</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-crown'></i> КАК РЕАЛИЗОВАТЬ СЕБЯ</h5>";
                $analysis .= "<p><strong>Четвертое число 1</strong> говорит о том, что реализовать свои таланты вы сможете через самостоятельные проекты и лидерство.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Путь реализации:</strong> действуйте самостоятельно, берите инициативу</li>";
                $analysis .= "<li><strong>Лучшие сферы:</strong> бизнес, управление, спорт, политика</li>";
                $analysis .= "<li><strong>Как проявлять:</strong> не ждите указаний — начинайте сами</li>";
                $analysis .= "<li><strong>Что важно:</strong> учитесь делегировать, не берите всё на себя</li>";
                $analysis .= "<li><strong>Избегайте:</strong> одиночества и недоверия к другим</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> «Я делаю сам, но не один». Берите ответственность, но доверяйте людям.</div>";
                break;
                
            case 2: // ДВОЙКА
                $analysis .= "<span class='level-medium'>2 — РЕАЛИЗАЦИЯ ЧЕРЕЗ ПАРТНЕРСТВО</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-handshake'></i> КАК РЕАЛИЗОВАТЬ СЕБЯ</h5>";
                $analysis .= "<p><strong>Четвертое число 2</strong> говорит о том, что реализовать свои таланты вы сможете через партнерство и сотрудничество.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Путь реализации:</strong> работайте в команде, ищите партнеров</li>";
                $analysis .= "<li><strong>Лучшие сферы:</strong> психология, дипломатия, консультирование</li>";
                $analysis .= "<li><strong>Как проявлять:</strong> умейте слушать и договариваться</li>";
                $analysis .= "<li><strong>Что важно:</strong> не теряйте себя в отношениях</li>";
                $analysis .= "<li><strong>Избегайте:</strong> зависимости от чужого мнения</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> «Вместе мы сила, но и я личность». Сотрудничайте, сохраняя себя.</div>";
                break;
                
            case 3: // ТРОЙКА
                $analysis .= "<span class='level-good'>3 — РЕАЛИЗАЦИЯ ЧЕРЕЗ ТВОРЧЕСТВО</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-paint-brush'></i> КАК РЕАЛИЗОВАТЬ СЕБЯ</h5>";
                $analysis .= "<p><strong>Четвертое число 3</strong> говорит о том, что реализовать свои таланты вы сможете через творчество и самовыражение.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Путь реализации:</strong> ищите творческие проекты, выступайте публично</li>";
                $analysis .= "<li><strong>Лучшие сферы:</strong> искусство, медиа, преподавание, блогинг</li>";
                $analysis .= "<li><strong>Как проявлять:</strong> делитесь идеями, вдохновляйте</li>";
                $analysis .= "<li><strong>Что важно:</strong> доводите творчество до результата</li>";
                $analysis .= "<li><strong>Избегайте:</strong> поверхностности и пустых разговоров</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> «Творить — значит жить». Но за вдохновением должен следовать труд.</div>";
                break;
                
            case 4: // ЧЕТВЁРКА
                $analysis .= "<span class='level-strong'>4 — РЕАЛИЗАЦИЯ ЧЕРЕЗ ПОРЯДОК</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-building'></i> КАК РЕАЛИЗОВАТЬ СЕБЯ</h5>";
                $analysis .= "<p><strong>Четвертое число 4</strong> говорит о том, что реализовать свои таланты вы сможете через организацию и системный подход.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Путь реализации:</strong> создавайте структуры, наводите порядок</li>";
                $analysis .= "<li><strong>Лучшие сферы:</strong> строительство, бухгалтерия, администрирование</li>";
                $analysis .= "<li><strong>Как проявлять:</strong> будьте надежным и ответственным</li>";
                $analysis .= "<li><strong>Что важно:</strong> учитесь гибкости в рамках системы</li>";
                $analysis .= "<li><strong>Избегайте:</strong> бюрократизма и застоя</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> «Порядок — основа успеха». Но не дайте порядку задушить жизнь.</div>";
                break;
                
            case 5: // ПЯТЁРКА
                $analysis .= "<span class='level-good'>5 — РЕАЛИЗАЦИЯ ЧЕРЕЗ СВОБОДУ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-globe'></i> КАК РЕАЛИЗОВАТЬ СЕБЯ</h5>";
                $analysis .= "<p><strong>Четвертое число 5</strong> говорит о том, что реализовать свои таланты вы сможете через свободу и перемены.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Путь реализации:</strong> ищите новое, путешествуйте, меняйтесь</li>";
                $analysis .= "<li><strong>Лучшие сферы:</strong> туризм, торговля, инновации, спорт</li>";
                $analysis .= "<li><strong>Как проявлять:</strong> будьте открыты новому опыту</li>";
                $analysis .= "<li><strong>Что важно:</strong> сохраняйте фокус среди множества возможностей</li>";
                $analysis .= "<li><strong>Избегайте:</strong> хаоса и безответственности</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> «Свобода — это выбор». Выбирайте осознанно, не разменивайтесь на мелочи.</div>";
                break;
                
            case 6: // ШЕСТЁРКА
                $analysis .= "<span class='level-medium'>6 — РЕАЛИЗАЦИЯ ЧЕРЕЗ ЗАБОТУ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-heart'></i> КАК РЕАЛИЗОВАТЬ СЕБЯ</h5>";
                $analysis .= "<p><strong>Четвертое число 6</strong> говорит о том, что реализовать свои таланты вы сможете через заботу о других и создание гармонии.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Путь реализации:</strong> заботьтесь о близких, создавайте уют</li>";
                $analysis .= "<li><strong>Лучшие сферы:</strong> медицина, образование, семья, социальная работа</li>";
                $analysis .= "<li><strong>Как проявлять:</strong> будьте внимательны к потребностям других</li>";
                $analysis .= "<li><strong>Что важно:</strong> не забывайте о себе, заботясь о других</li>";
                $analysis .= "<li><strong>Избегайте:</strong> гиперопеки и жертвенности</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> «Забота сближает, но не должна растворять». Любите, но сохраняйте себя.</div>";
                break;
                
            case 7: // СЕМЁРКА
                $analysis .= "<span class='level-strong'>7 — РЕАЛИЗАЦИЯ ЧЕРЕЗ ЗНАНИЯ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-search'></i> КАК РЕАЛИЗОВАТЬ СЕБЯ</h5>";
                $analysis .= "<p><strong>Четвертое число 7</strong> говорит о том, что реализовать свои таланты вы сможете через знания и исследования.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Путь реализации:</strong> учитесь, исследуйте, анализируйте</li>";
                $analysis .= "<li><strong>Лучшие сферы:</strong> наука, IT, философия, аналитика</li>";
                $analysis .= "<li><strong>Как проявлять:</strong> углубляйтесь в тему, ищите истину</li>";
                $analysis .= "<li><strong>Что важно:</strong> делитесь знаниями, не замыкайтесь</li>";
                $analysis .= "<li><strong>Избегайте:</strong> отрыва от реальности и высокомерия</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> «Знание — сила». Но сила становится мудростью только когда служит людям.</div>";
                break;
                
            case 8: // ВОСЬМЁРКА
                $analysis .= "<span class='level-excellent'>8 — РЕАЛИЗАЦИЯ ЧЕРЕЗ ВЛАСТЬ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-chart-bar'></i> КАК РЕАЛИЗОВАТЬ СЕБЯ</h5>";
                $analysis .= "<p><strong>Четвертое число 8</strong> говорит о том, что реализовать свои таланты вы сможете через управление и финансы.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Путь реализации:</strong> управляйте ресурсами, создавайте материальные ценности</li>";
                $analysis .= "<li><strong>Лучшие сферы:</strong> бизнес, политика, банки, крупные проекты</li>";
                $analysis .= "<li><strong>Как проявлять:</strong> будьте справедливым и дальновидным</li>";
                $analysis .= "<li><strong>Что важно:</strong> используйте власть во благо</li>";
                $analysis .= "<li><strong>Избегайте:</strong> жадности и злоупотребления положением</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> «Истинная власть — в служении». Чем больше могущество, тем больше ответственность.</div>";
                break;
                
            case 9: // ДЕВЯТКА
                $analysis .= "<span class='level-good'>9 — РЕАЛИЗАЦИЯ ЧЕРЕЗ МУДРОСТЬ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-dove'></i> КАК РЕАЛИЗОВАТЬ СЕБЯ</h5>";
                $analysis .= "<p><strong>Четвертое число 9</strong> говорит о том, что реализовать свои таланты вы сможете через мудрость и наставничество.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Путь реализации:</strong> учите других, делитесь опытом, помогайте</li>";
                $analysis .= "<li><strong>Лучшие сферы:</strong> образование, коучинг, благотворительность</li>";
                $analysis .= "<li><strong>Как проявлять:</strong> будьте примером и наставником</li>";
                $analysis .= "<li><strong>Что важно:</strong> не навязывайте свою мудрость</li>";
                $analysis .= "<li><strong>Избегайте:</strong> фанатизма и поучений</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> «Мудрость приходит с опытом, но делится с любовью». Учите, но не поучайте.</div>";
                break;
        }
    }
    
    /***************************************************************************
     * РАЗДЕЛ 2: МАСТЕР-ЧИСЛА (11, 22)
     ***************************************************************************/
    elseif ($value == 11) {
        $analysis .= "<span class='level-excellent'>11 — МАСТЕР-ЧИСЛО РЕАЛИЗАЦИИ</span>";
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-crown'></i> <i class='fas fa-om'></i> РАЗБОР ЧИСЛА 11</h5>";
        $analysis .= "<p><strong>Четвертое число 11</strong> — мастер-число, указывающее на реализацию через высшее вдохновение.</p>";
        $analysis .= "<ul>";
        $analysis .= "<li><strong>Состав:</strong> 1 + 1 = 2 (реализация через гармонию)</li>";
        $analysis .= "<li><strong>Первая цифра (1):</strong> " . vspom4_1(1) . "</li>";
        $analysis .= "<li><strong>Вторая цифра (1):</strong> " . vspom4_1(1) . "</li>";
        $analysis .= "<li><strong>Базовая основа (2):</strong> " . vspom4_2(2) . "</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-star'></i> ПУТЬ РЕАЛИЗАЦИИ</h5>";
        $analysis .= "<ul>";
        $analysis .= "<li><strong>Как реализоваться:</strong> через духовное лидерство, интуицию, вдохновение</li>";
        $analysis .= "<li><strong>Ключ:</strong> доверяйте своей интуиции, она приведет</li>";
        $analysis .= "<li><strong>Сферы:</strong> эзотерика, психология, искусство, духовные практики</li>";
        $analysis .= "<li><strong>Важно:</strong> заземляйте свои идеи, не витайте в облаках</li>";
        $analysis .= "<li><strong>Предупреждение:</strong> берегите нервную систему, не перегружайтесь</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> «Вдохновение требует воплощения». Несите свет, но помните о земле.</div>";
    }
    
    elseif ($value == 22) {
        $analysis .= "<span class='level-excellent'>22 — МАСТЕР-ЧИСЛО РЕАЛИЗАЦИИ</span>";
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-crown'></i> <i class='fas fa-building'></i> РАЗБОР ЧИСЛА 22</h5>";
        $analysis .= "<p><strong>Четвертое число 22</strong> — мастер-число, указывающее на реализацию через масштабное созидание.</p>";
        $analysis .= "<ul>";
        $analysis .= "<li><strong>Состав:</strong> 2 + 2 = 4 (реализация через структуру)</li>";
        $analysis .= "<li><strong>Первая цифра (2):</strong> " . vspom4_1(2) . "</li>";
        $analysis .= "<li><strong>Вторая цифра (2):</strong> " . vspom4_1(2) . "</li>";
        $analysis .= "<li><strong>Базовая основа (4):</strong> " . vspom4_2(4) . "</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-star'></i> ПУТЬ РЕАЛИЗАЦИИ</h5>";
        $analysis .= "<ul>";
        $analysis .= "<li><strong>Как реализоваться:</strong> через масштабные проекты, созидание, управление</li>";
        $analysis .= "<li><strong>Ключ:</strong> стройте системы, которые будут служить многим</li>";
        $analysis .= "<li><strong>Сферы:</strong> архитектура, политика, крупный бизнес</li>";
        $analysis .= "<li><strong>Важно:</strong> не берите всё на себя, делегируйте</li>";
        $analysis .= "<li><strong>Предупреждение:</strong> избегайте выгорания</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш путь:</strong> «Великое строится по кирпичику». Помните о каждом шаге.</div>";
    }
    
    /***************************************************************************
     * РАЗДЕЛ 3: ДВУЗНАЧНЫЕ ЧИСЛА (10, 12-18, 20-31)
     ***************************************************************************/
    elseif ($value >= 10 && $value <= 31 && $value != 11 && $value != 22) {
        $analysis .= "<span class='level-strong'>$value — УПРАВЛЯЮЩИЙ ПУТЬ РЕАЛИЗАЦИИ</span>";
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-puzzle-piece'></i> РАЗБОР ЧИСЛА $value</h5>";
        $analysis .= "<p><strong>$value = $firstDigit + $secondDigit = " . ($firstDigit+$secondDigit) . " → $reducedValue</strong></p>";
        $analysis .= "<ul>";
        $analysis .= "<li><strong>Первая цифра ($firstDigit):</strong> " . vspom4_1($firstDigit) . "</li>";
        $analysis .= "<li><strong>Вторая цифра ($secondDigit):</strong> " . vspom4_1($secondDigit) . "</li>";
        $analysis .= "<li><strong>Базовая основа ($reducedValue):</strong> " . vspom4_2($reducedValue) . "</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-compass'></i> ВАШ ПУТЬ РЕАЛИЗАЦИИ</h5>";
        $analysis .= "<ul>";
        
        // Группировка по десяткам
        if ($value >= 10 && $value <= 19) {
            $analysis .= "<li><strong>Группа 10-19 (лидерская реализация):</strong> вы реализуетесь через лидерство, дополненное качеством " . vspom4_1($secondDigit) . "</li>";
        } elseif ($value >= 20 && $value <= 29) {
            $analysis .= "<li><strong>Группа 20-29 (партнерская реализация):</strong> вы реализуетесь через гармонию и сотрудничество, дополненные качеством " . vspom4_1($secondDigit) . "</li>";
        } elseif ($value >= 30 && $value <= 31) {
            $analysis .= "<li><strong>Группа 30-31 (творческая реализация):</strong> вы реализуетесь через творчество, дополненное качеством " . vspom4_1($secondDigit) . "</li>";
        }
        
        // Индивидуальные рекомендации
        switch($value) {
            case 10:
                $analysis .= "<li><strong>10:</strong> реализация через лидерство с удачей. Используйте шансы, которые дает судьба.</li>";
                break;
            case 12:
                $analysis .= "<li><strong>12:</strong> реализация через творческое лидерство. Вдохновляйте и ведите.</li>";
                break;
            case 13:
                $analysis .= "<li><strong>13:</strong> реализация через созидание. Стройте и создавайте.</li>";
                break;
            case 14:
                $analysis .= "<li><strong>14:</strong> реализация через свободу. Будьте первооткрывателем.</li>";
                break;
            case 15:
                $analysis .= "<li><strong>15:</strong> реализация через заботу. Ведите, оберегая.</li>";
                break;
            case 16:
                $analysis .= "<li><strong>16:</strong> реализация через мудрость. Действуйте осознанно.</li>";
                break;
            case 17:
                $analysis .= "<li><strong>17:</strong> реализация через успех. Достигайте и делитесь.</li>";
                break;
            case 18:
                $analysis .= "<li><strong>18:</strong> реализация через служение. Власть во благо.</li>";
                break;
            case 19:
                $analysis .= "<li><strong>19:</strong> кармическая реализация. Завершайте старое и начинайте новое.</li>";
                break;
            case 20:
                $analysis .= "<li><strong>20:</strong> реализация через гармонию с поддержкой судьбы.</li>";
                break;
            case 21:
                $analysis .= "<li><strong>21:</strong> реализация через гармоничное творчество.</li>";
                break;
            case 23:
                $analysis .= "<li><strong>23:</strong> реализация через свободную гармонию.</li>";
                break;
            case 24:
                $analysis .= "<li><strong>24:</strong> реализация через гармоничную заботу.</li>";
                break;
            case 25:
                $analysis .= "<li><strong>25:</strong> реализация через гармоничную мудрость.</li>";
                break;
            case 26:
                $analysis .= "<li><strong>26:</strong> реализация через гармоничную власть.</li>";
                break;
            case 27:
                $analysis .= "<li><strong>27:</strong> реализация через гармоничное служение.</li>";
                break;
            case 28:
                $analysis .= "<li><strong>28:</strong> реализация через гармоничное лидерство.</li>";
                break;
            case 29:
                $analysis .= "<li><strong>29:</strong> реализация через высшую гармонию.</li>";
                break;
            case 30:
                $analysis .= "<li><strong>30:</strong> реализация через творческий потенциал.</li>";
                break;
            case 31:
                $analysis .= "<li><strong>31:</strong> реализация через творческий порядок.</li>";
                break;
        }
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-tasks'></i> КОНКРЕТНЫЕ ШАГИ</h5>";
        $analysis .= "<ul>";
        $analysis .= "<li>Ищите возможности проявить качество <strong>цифры $firstDigit</strong> через качество <strong>цифры $secondDigit</strong></li>";
        $analysis .= "<li>Помните о базовой задаче: <strong>" . vspom4_2($reducedValue) . "</strong></li>";
        $analysis .= "<li>Соединяйте этот путь с вашими талантами (третье число)</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
    }
    
    /***************************************************************************
     * РАЗДЕЛ 4: ЧИСЛА БОЛЬШЕ 31
     ***************************************************************************/
    elseif ($value > 31) {
        $analysis .= "<span class='level-excellent'>$value — УНИКАЛЬНЫЙ ПУТЬ РЕАЛИЗАЦИИ</span>";
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-star'></i> РАЗБОР ЧИСЛА $value</h5>";
        $analysis .= "<p><strong>" . implode(' + ', str_split($value)) . " = " . array_sum(str_split($value)) . " → $reducedValue</strong></p>";
        $analysis .= "<ul>";
        $digits = str_split($value);
        foreach($digits as $index => $digit) {
            $analysis .= "<li><strong>Цифра " . ($index+1) . " ($digit):</strong> " . vspom4_1($digit) . "</li>";
        }
        $analysis .= "<li><strong>Базовая основа ($reducedValue):</strong> " . vspom4_2($reducedValue) . "</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-compass'></i> ОСОБЕННОСТИ РЕАЛИЗАЦИИ</h5>";
        $analysis .= "<ul>";
        $analysis .= "<li>У вас уникальный, редкий путь реализации</li>";
        $analysis .= "<li>Вам нужно сочетать все цифры числа</li>";
        $analysis .= "<li>Ищите свой неповторимый способ самовыражения</li>";
        $analysis .= "<li>Не ориентируйтесь на чужие шаблоны</li>";
        $analysis .= "<li>Рекомендуется индивидуальная консультация</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-note'>";
        $analysis .= "<i class='fas fa-feather'></i> ";
        $analysis .= "<strong>Ваш путь уникален.</strong> Доверяйте себе и ищите свои методы.";
        $analysis .= "</div>";
    }
    
    /***************************************************************************
     * ОБЩИЕ РЕКОМЕНДАЦИИ
     ***************************************************************************/
    $analysis .= "<div class='line-subsection'>";
    $analysis .= "<h5><i class='fas fa-link'></i> СВЯЗЬ С ДРУГИМИ ЧИСЛАМИ</h5>";
    $analysis .= "<ul>";
    $analysis .= "<li><strong>Четвертое число</strong> показывает КАК реализовать таланты (третье число)</li>";
    $analysis .= "<li><strong>Связь с первым числом:</strong> путь реализации должен вести к вашей цели</li>";
    $analysis .= "<li><strong>Связь со вторым числом:</strong> реализация должна соответствовать миссии</li>";
    $analysis .= "<li><strong>Связь с третьим числом:</strong> это инструмент для ваших талантов</li>";
    $analysis .= "</ul>";
    $analysis .= "</div>";
    
    $analysis .= "</div></div>";
    return $analysis;
}

/**
 * ВСПОМОГАТЕЛЬНАЯ ФУНКЦИЯ 1: Описание цифры для 4-го числа
 */
function vspom4_1($digit) {
    $descriptions = [
        1 => 'лидерство, самостоятельность, инициатива',
        2 => 'сотрудничество, дипломатичность, баланс',
        3 => 'творчество, самовыражение, оптимизм',
        4 => 'порядок, структура, надежность, дисциплина',
        5 => 'свобода, перемены, адаптивность, прогресс',
        6 => 'забота, ответственность, семья, гармония',
        7 => 'знания, анализ, интуиция, мудрость',
        8 => 'власть, успех, изобилие, управление',
        9 => 'служение, наставничество, завершение',
        0 => 'потенциал, удача, связь с высшим'
    ];
    return $descriptions[$digit] ?? 'особое качество';
}

/**
 * ВСПОМОГАТЕЛЬНАЯ ФУНКЦИЯ 2: Описание базового числа для 4-го числа
 */
function vspom4_2($num) {
    $bases = [
        1 => 'реализация через самостоятельные действия и лидерство',
        2 => 'реализация через партнерство и гармонию',
        3 => 'реализация через творчество и радость',
        4 => 'реализация через порядок и структуру',
        5 => 'реализация через свободу и перемены',
        6 => 'реализация через заботу и любовь',
        7 => 'реализация через знания и мудрость',
        8 => 'реализация через власть и изобилие',
        9 => 'реализация через служение и наставничество'
    ];
    return $bases[$num] ?? 'уникальный путь реализации';
}
//4 допчисло

/**
 * Вспомогательная функция для описания цифры
 */
function getDigitDescription($digit) {
    $descriptions = [
        1 => 'лидерство, воля, начало',
        2 => 'гармония, дипломатичность, чувствительность',
        3 => 'творчество, оптимизм, самовыражение',
        4 => 'порядок, труд, стабильность',
        5 => 'свобода, перемены, прогресс',
        6 => 'забота, семья, ответственность',
        7 => 'анализ, мудрость, интуиция',
        8 => 'власть, успех, материальность',
        9 => 'служение, мудрость, завершение'
    ];
    return $descriptions[$digit] ?? 'особое качество';
}

/**
 * Вспомогательная функция для описания базового числа
 */
function getBaseDescription($num) {
    $bases = [
        1 => 'лидерство и независимость',
        2 => 'сотрудничество и баланс',
        3 => 'творчество и радость',
        4 => 'порядок и дисциплина',
        5 => 'свобода и перемены',
        6 => 'гармония и забота',
        7 => 'духовность и познание',
        8 => 'изобилие и власть',
        9 => 'мудрость и служение'
    ];
    return $bases[$num] ?? 'основная энергия';
}
// 1 допчисло
///////////////
////////////////анализ дополнительных чисел

/**
 * Вспомогательная функция: рекомендации для развития каждого числа
 */
function getRecommendationForNumber($num) {
    $recommendations = [
        1 => "брать на себя ответственность, принимать решения, отстаивать своё мнение, заниматься спортом, развивать лидерские качества",
        2 => "заниматься энергетическими практиками (йога, цигун), больше общаться с позитивными людьми, избегать энерговампиров, полноценно отдыхать",
        3 => "читать научно-популярную литературу, решать логические задачи, изучать новые технологии, развивать curiosity",
        4 => "регулярные физические нагрузки, здоровое питание, закаливание, достаточный сон, профилактические осмотры у врача",
        5 => "решать головоломки, развивать интуицию (медитация, ведение дневника снов), изучать логику, играть в стратегические игры",
        6 => "заниматься рукоделием или ремонтом, работать в саду, осваивать ремесло, ценить физический труд, развивать мелкую моторику",
        7 => "благодарить за удачные моменты, развивать таланты, верить в себя, заниматься творчеством, помогать другим",
        8 => "выполнять обещания, брать на себя обязательства, развивать терпение, быть пунктуальным, уважать договорённости",
        9 => "читать книги, учить стихи или языки, играть в игры на память, постоянно учиться чему-то новому, расширять кругозор"
    ];
    
    return $recommendations[$num] ?? "развивать это качество через самонаблюдение и практику";
}
///////////////////для формирования файла(платный отчет);
////////////////анализ дополнительных чисел


// Функция для сохранения отчета в папку results
function saveNumerologyReport($result_data, $user_email = '') {
    // Путь к папке results
    //$results_dir = __DIR__ . '/results/';
    $results_dir =  '../results/';
    //$results_dir = ABS_PATH. 'results/';
    //tte($results_dir);
   
    
    // Создаем папку если ее нет
    if (!file_exists($results_dir)) {
        mkdir($results_dir, 0755, true);
    }
    
    // Генерируем уникальное имя файла
    $date = new DateTime($result_data['birth_date']);
    $date_str = $date->format('Y-m-d');
    $timestamp = time();
    $hash = substr(md5($date_str . $timestamp), 0, 8);
    $filename = "report_{$date_str}_{$hash}.html";
    $filepath = $results_dir . $filename;
    
    // Формируем полный HTML отчет
    $html = generateReportHTML($result_data);
    
    // Сохраняем файл
    if (file_put_contents($filepath, $html)) {
        // Логируем сохранение
        $log_entry = date('Y-m-d H:i:s') . " | {$result_data['birth_date']} | {$user_email} | {$filename}\n";
        file_put_contents($results_dir . 'reports.log', $log_entry, FILE_APPEND);
        
        return [
            'success' => true,
            'filename' => $filename,
            'filepath' => $filepath,
            'url' => "/results/{$filename}",
            'full_url' => (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . "/results/{$filename}",
            'size' => filesize($filepath)
        ];
    }
    
    return ['success' => false, 'error' => 'Не удалось сохранить файл'];
}

// Функция для генерации HTML отчета
function generateReportHTML($result_data) {
    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Нумерологический отчет <?= htmlspecialchars($result_data['birth_date']) ?></title>
        <!-- для пдф -->
         <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> -->
        <!-- для пдф -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
        font-family: 'Georgia', 'Times New Roman', serif;
            line-height: 1.6;
            color: #2c2c2c;
            background: linear-gradient(145deg, #fefaf4 0%, #f9f2ea 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 40px;
            box-shadow: 0 20px 40px rgba(139, 69, 19, 0.03);
            border: 1px solid #f0e4d6;
            overflow: hidden;
            padding: 40px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px 20px;
            background: linear-gradient(145deg, #fefaf4, #fff);
            border-radius: 30px 30px 30px 0;
            border-left: 12px solid #b38b5f;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        }
        
        .header h1 {
            color: #3b2b22;
            font-size: 42px;
            margin-bottom: 15px;
            font-weight: 400;
            letter-spacing: 1px;
        }
        
        .header .subtitle {
            color: #8a6e4b;
            font-size: 1.2em;
            font-style: italic;
        }
        
        .date-info {
            background: #fcf9f5;
            padding: 25px;
            border-radius: 30px;
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            border: 1px solid #f0e4d6;
        }
        
        .date-item {
            text-align: center;
            flex: 1;
            min-width: 150px;
            padding: 15px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
        }
        
        .date-value {
            font-size: 38px;
            font-weight: bold;
            color: #b38b5f;
            margin-bottom: 5px;
        }
        
        .date-label {
            color: #6a5a4c;
            font-size: 0.9em;
            margin-top: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .working-numbers {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .number-card {
            background: linear-gradient(135deg, #8a6e4b 0%, #b38b5f 100%);
            color: white;
            padding: 30px 20px;
            border-radius: 30px;
            text-align: center;
            box-shadow: 0 15px 30px rgba(139, 69, 19, 0.15);
            border-bottom: 5px solid #5e3e2b;
            transition: transform 0.3s ease;
        }
        
        .number-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(139, 69, 19, 0.2);
        }
        
        .number-value {
            font-size: 52px;
            font-weight: bold;
            margin-bottom: 5px;
            line-height: 1;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        
        .number-name {
            font-size: 1em;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .matrix-section {
            margin: 50px 0;
        }
        
        .matrix-title {
            text-align: center;
            font-size: 32px;
            color: #3b2b22;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            border-bottom: 3px solid #f0e4d6;
            padding-bottom: 15px;
        }
        
        .matrix-title i {
            color: #b38b5f;
            font-size: 28px;
            background: #f5efe8;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .matrix-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .matrix-cell {
            /* aspect-ratio: 1; */
            background: white;
            border: 2px solid #f0e4d6;
            border-radius: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 1.4em;
            font-weight: bold;
            color: #3b2b22;
            position: relative;
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
            transition: all 0.3s ease;
            padding: 5px;
        }
        
        .matrix-cell:hover {
            border-color: #b38b5f;
            transform: scale(1.02);
            box-shadow: 0 10px 25px rgba(179, 139, 95, 0.1);
        }
        
        .cell-number {
            font-size: 3.5em;
            line-height: 1;
            color: #b38b5f;
        }
        
        .cell-count {
            font-size: 1.2em;
            background: #f5efe8;
            color: #b38b5f;
            padding: 5px 15px;
            border-radius: 40px;
            margin-top: 5px;
            font-weight: 600;
        }
        
        .cell-label {
            font-size: 1.2em;
            color: #6a5a4c;
            margin-bottom: 5px;
            font-weight: normal;
        }
        
        .interpretations {
            margin: 50px 0;
        }
        
        .section-title {
            font-size: 32px;
            color: #3b2b22;
            margin: 40px 0 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 6px solid #b38b5f;
            padding-left: 20px;
        }
        
        .section-title i {
            color: #b38b5f;
        }
        
        .quality-card {
            background: white;
            border-left: 8px solid #b38b5f;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 30px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.02);
            transition: all 0.3s ease;
            font-size: 1.1em;
            line-height: 1.7;
            color: #4a3f38;
        }
        
        .quality-card:hover {
            box-shadow: 0 15px 30px rgba(179, 139, 95, 0.08);
            transform: translateX(5px);
        }
        
        .lines-analysis {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin: 40px 0;
        }
        
        .line-card {
            background: white;
            padding: 25px;
            border-radius: 30px;
            border: 1px solid #f0e4d6;
            transition: 0.2s;
        }
        
        .line-card:hover {
            border-color: #b38b5f;
        }
        
        .line-card h4 {
            color: #3b2b22;
            margin-bottom: 15px;
            border-bottom: 2px solid #f0e4d6;
            padding-bottom: 10px;
            font-size: 1.3em;
        }
        
        .additional-analysis {
            background: #fcf9f5;
            padding: 40px;
            border-radius: 40px;
            margin-top: 50px;
            border: 1px solid #f0e4d6;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 30px;
            border: 1px solid #f0e4d6;
            transition: 0.2s;
            text-align: center;
        }
        
        .stat-card:hover {
            border-color: #b38b5f;
        }
        
        .stat-value {
            font-size: 3em;
            font-weight: bold;
            color: #b38b5f;
            margin-bottom: 10px;
            line-height: 1;
        }
        
        .action-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 50px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 16px 35px;
            border: none;
            border-radius: 60px;
            font-size: 1.1em;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            border-bottom: 4px solid transparent;
        }
        
        .btn-primary {
            background: #8a6e4b;
            color: white;
            border-bottom-color: #5e3e2b;
        }
        
        .btn-primary:hover {
            background: #6f543a;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(139, 69, 19, 0.2);
        }
        
        .btn-secondary {
            background: #f0e4d6;
            color: #4a3f38;
            border-bottom-color: #b3a396;
        }
        
        .btn-secondary:hover {
            background: #e5d5c5;
            transform: translateY(-2px);
        }
        
        .btn-pdf {
            background: #a69f95;
            color: white;
            border-bottom-color: #6b5a4c;
        }
        
        .btn-pdf:hover {
            background: #8b7a6b;
            transform: translateY(-2px);
        }
        
        .footer {
            text-align: center;
            margin-top: 60px;
            padding-top: 30px;
            border-top: 2px solid #f0e4d6;
            color: #8b7a6b;
            font-size: 0.95em;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            
            .header h1 {
                font-size: 32px;
            }
            
            .matrix-grid {
                gap: 12px;
                max-width: 400px;
            }
            
            .matrix-cell {
                font-size: 1.2em;
            }
            
            .cell-number {
                font-size: 2.5em;
            }
            
            .date-info {
                flex-direction: column;
                align-items: stretch;
            }
            
            .date-item {
                min-width: auto;
            }
            
            .section-title {
                font-size: 26px;
            }
            
            .btn {
                width: 100%;
                text-align: center;
            }
        }
        
        @media (max-width: 480px) {
            .working-numbers {
                grid-template-columns: 1fr;
            }
            
            .matrix-grid {
                gap: 8px;
            }
            
            .matrix-cell {
                padding: 5px;
            }
            
            .cell-number {
                font-size: 2em;
            }
            
            .cell-count {
                font-size: 1em;
                padding: 3px 10px;
            }
            
            .cell-label {
                font-size: 0.9em;
            }
             .section-title {
                font-size: 20px;
            }
        }
