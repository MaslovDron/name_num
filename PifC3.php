                $analysis .= "</ul>";
            }
            elseif ($value >= 30 && $value <= 31) {
                $analysis .= "<p><strong>Группа 30-39 (творческая):</strong> энергия творчества (3) проявляется через качество числа $secondDigit</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Ваша задача:</strong> творить и выражать себя через " . getDigitDescription($secondDigit) . "</li>";
                $analysis .= "<li><strong>Стиль:</strong> креативный, вдохновенный, артистичный</li>";
                $analysis .= "</ul>";
            }
            $analysis .= "</div>";
            
            // Дополнительная комбинаторная характеристика
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-star'></i> КОМБИНАЦИЯ ЭНЕРГИЙ</h5>";
            $analysis .= "<ul>";
            $analysis .= "<li><strong>Высший уровень:</strong> энергия $firstDigit (главный ресурс)</li>";
            $analysis .= "<li><strong>Средний уровень:</strong> энергия $secondDigit (инструмент реализации)</li>";
            $analysis .= "<li><strong>Базовый уровень:</strong> энергия $reducedValue (глубинная цель)</li>";
            $analysis .= "</ul>";
            $analysis .= "<p>Вам нужно научиться использовать энергию $firstDigit для достижения целей через качество $secondDigit, помня о глубинной задаче числа $reducedValue.</p>";
            $analysis .= "</div>";
            
            // Персональный совет по числу
            $analysis .= "<div class='line-note'>";
            $analysis .= "<i class='fas fa-feather'></i> ";
            $analysis .= "<strong>Ваш индивидуальный совет:</strong> ";
            
            if ($value == 10) {
                $analysis .= "10 = 1+0. Вы лидер с огромным потенциалом (0). Удача на вашей стороне, но не полагайтесь только на неё.";
            } elseif ($value == 12) {
                $analysis .= "12 = 1+2+3. Лидерство через творчество и гармонию. Учитесь вдохновлять словом.";
            } elseif ($value == 15) {
                $analysis .= "15 = 1+5+6. Лидерство через свободу и заботу. Не бойтесь перемен, но помните о близких.";
            } elseif ($value == 17) {
                $analysis .= "17 = 1+7+8. Лидерство через мудрость и власть. Познание ведёт к успеху.";
            } elseif ($value == 18) {
                $analysis .= "18 = 1+8+9. Лидерство через власть и служение. Истинная власть в помощи другим.";
            } elseif ($value == 20) {
                $analysis .= "20 = 2+0. Гармония и потенциал. Вы можете достичь баланса во всём.";
            } elseif ($value == 21) {
                $analysis .= "21 = 2+1+3. Гармония через лидерство и творчество. Объединяйте людей вокруг идей.";
            } elseif ($value == 23) {
                $analysis .= "23 = 2+3+5. Гармония через творчество и свободу. Ваша дипломатия открывает двери.";
            } elseif ($value == 24) {
                $analysis .= "24 = 2+4+6. Гармония через порядок и заботу. Стройте отношения на надёжности.";
            } elseif ($value == 25) {
                $analysis .= "25 = 2+5+7. Гармония через свободу и мудрость. Учитесь гибкости и познанию.";
            } elseif ($value == 26) {
                $analysis .= "26 = 2+6+8. Гармония через заботу и власть. Забота о других ведёт к процветанию.";
            } elseif ($value == 27) {
                $analysis .= "27 = 2+7+9. Гармония через мудрость и служение. Вы можете исцелять словом.";
            } elseif ($value == 28) {
                $analysis .= "28 = 2+8+10/1. Гармония через власть и лидерство. Управляйте с душой.";
            } elseif ($value == 29) {
                $analysis .= "29 = 2+9+11/2. Гармония через служение. Высокая духовная миссия.";
            } elseif ($value == 30) {
                $analysis .= "30 = 3+0. Творческий потенциал. Ваши идеи могут изменить мир.";
            } elseif ($value == 31) {
                $analysis .= "31 = 3+1+4. Творчество через лидерство и порядок. Созидайте структуры.";
            }
            $analysis .= "</div>";
        }
    }
    
    /***************************************************************************
     * РАЗДЕЛ 3: ЧИСЛА БОЛЬШЕ 31 (РЕДКИЕ СЛУЧАИ)
     ***************************************************************************/
    else {
        $analysis .= "<span class='level-excellent'>$value — РЕДКОЕ ЧИСЛО</span>";
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-star'></i> РАЗБОР ЧИСЛА $value</h5>";
        $analysis .= "<p><strong>" . implode(' + ', str_split($value)) . " = " . array_sum(str_split($value)) . " → $reducedValue</strong></p>";
        $analysis .= "<ul>";
        foreach(str_split($value) as $index => $digit) {
            $analysis .= "<li><strong>Цифра " . ($index+1) . " ($digit):</strong> " . getDigitDescription($digit) . "</li>";
        }
        $analysis .= "<li><strong>Базовая основа ($reducedValue):</strong> " . getBaseDescription($reducedValue) . "</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-tasks'></i> РЕКОМЕНДАЦИИ</h5>";
        $analysis .= "<ul>";
        $analysis .= "<li>У вас очень сильная и редкая энергетика</li>";
        $analysis .= "<li>Вам нужен индивидуальный анализ всех цифр в комплексе</li>";
        $analysis .= "<li>Обратите внимание на сочетание всех цифр числа</li>";
        $analysis .= "<li>Ваш путь уникален — не сравнивайте себя с другими</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
    }
    
    $analysis .= "</div></div>";
    return $analysis;
}
// 1 допчисло
//2 допчисло
function AnalDopNum2($value) {
    $analysis = "<div class='line-item'>";
    $analysis .= "<h4><i class='fas fa-star'></i> Второе дополнительное число: <span class='line-name'>Число миссии и ведущего качества</span></h4>";
    $analysis .= "<div class='line-formula'>Расчет: сумма цифр первого числа = <strong>$value</strong></div>";
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
                $analysis .= "<span class='level-strong'>1 — МИССИЯ ЛИДЕРА</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-crown'></i> ВАША ГЛАВНАЯ МИССИЯ</h5>";
                $analysis .= "<p><strong>Второе число 1</strong> говорит о том, что ваша главная жизненная миссия — стать лидером, первопроходцем, примером для других.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основная задача:</strong> научиться быть самостоятельным и вести за собой</li>";
                $analysis .= "<li><strong>Ключевое качество:</strong> воля, решительность, независимость</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> вы здесь, чтобы начинать новое, прокладывать пути</li>";
                $analysis .= "<li><strong>В чем реализоваться:</strong> там, где нужно проявлять инициативу</li>";
                $analysis .= "<li><strong>Опасность:</strong> стать эгоцентричным диктатором</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваша миссия:</strong> «Я первый, но не единственный». Ведите, но не подавляйте.</div>";
                break;
                
            case 2: // ДВОЙКА
                $analysis .= "<span class='level-medium'>2 — МИССИЯ МИРОТВОРЦА</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-handshake'></i> ВАША ГЛАВНАЯ МИССИЯ</h5>";
                $analysis .= "<p><strong>Второе число 2</strong> говорит о том, что ваша главная жизненная миссия — создавать гармонию, быть дипломатом, объединять людей.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основная задача:</strong> научиться сотрудничать, искать компромиссы</li>";
                $analysis .= "<li><strong>Ключевое качество:</strong> дипломатичность, терпение, тактичность</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> вы здесь, чтобы сглаживать конфликты, мирить</li>";
                $analysis .= "<li><strong>В чем реализоваться:</strong> в партнерстве, командной работе</li>";
                $analysis .= "<li><strong>Опасность:</strong> потеря себя в угоду другим</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваша миссия:</strong> «Мир в себе — мир вокруг». Помните и о своих интересах.</div>";
                break;
                
            case 3: // ТРОЙКА
                $analysis .= "<span class='level-good'>3 — МИССИЯ ТВОРЦА</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-paint-brush'></i> ВАША ГЛАВНАЯ МИССИЯ</h5>";
                $analysis .= "<p><strong>Второе число 3</strong> говорит о том, что ваша главная жизненная миссия — приносить радость, вдохновлять, творить.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основная задача:</strong> развивать творческие способности, радоваться жизни</li>";
                $analysis .= "<li><strong>Ключевое качество:</strong> креативность, оптимизм, самовыражение</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> вы здесь, чтобы вдохновлять словом и делом</li>";
                $analysis .= "<li><strong>В чем реализоваться:</strong> в искусстве, общении, творчестве</li>";
                $analysis .= "<li><strong>Опасность:</strong> поверхностность, разбросанность</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваша миссия:</strong> «Радость — это серьезно». Творите, но доводите до результата.</div>";
                break;
                
            case 4: // ЧЕТВЁРКА
                $analysis .= "<span class='level-strong'>4 — МИССИЯ СТРОИТЕЛЯ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-building'></i> ВАША ГЛАВНАЯ МИССИЯ</h5>";
                $analysis .= "<p><strong>Второе число 4</strong> говорит о том, что ваша главная жизненная миссия — создавать порядок, структуру, надежность.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основная задача:</strong> создать прочный фундамент, дисциплинировать себя</li>";
                $analysis .= "<li><strong>Ключевое качество:</strong> трудолюбие, ответственность, системность</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> вы здесь, чтобы организовать, структурировать</li>";
                $analysis .= "<li><strong>В чем реализоваться:</strong> в строительстве, администрировании</li>";
                $analysis .= "<li><strong>Опасность:</strong> закоснелость, упрямство</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваша миссия:</strong> «Порядок — основа, но не клетка». Учитесь гибкости.</div>";
                break;
                
            case 5: // ПЯТЁРКА
                $analysis .= "<span class='level-good'>5 — МИССИЯ СВОБОДНОГО СТРАННИКА</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-globe'></i> ВАША ГЛАВНАЯ МИССИЯ</h5>";
                $analysis .= "<p><strong>Второе число 5</strong> говорит о том, что ваша главная жизненная миссия — принимать изменения, быть проводником перемен.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основная задача:</strong> научиться гибкости, адаптивности</li>";
                $analysis .= "<li><strong>Ключевое качество:</strong> свобода, прогрессивность, любознательность</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> вы здесь, чтобы ломать стереотипы</li>";
                $analysis .= "<li><strong>В чем реализоваться:</strong> в путешествиях, торговле, инновациях</li>";
                $analysis .= "<li><strong>Опасность:</strong> хаотичность, безответственность</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваша миссия:</strong> «Свобода — это осознанная необходимость». Меняйтесь, но имейте стержень.</div>";
                break;
                
            case 6: // ШЕСТЁРКА
                $analysis .= "<span class='level-medium'>6 — МИССИЯ ЗАБОТЛИВОГО СЕРДЦА</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-heart'></i> ВАША ГЛАВНАЯ МИССИЯ</h5>";
                $analysis .= "<p><strong>Второе число 6</strong> говорит о том, что ваша главная жизненная миссия — научиться любить и заботиться без потери себя.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основная задача:</strong> создать гармоничные отношения, семью</li>";
                $analysis .= "<li><strong>Ключевое качество:</strong> забота, ответственность, понимание</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> вы здесь, чтобы оберегать и поддерживать</li>";
                $analysis .= "<li><strong>В чем реализоваться:</strong> в семье, медицине, образовании</li>";
                $analysis .= "<li><strong>Опасность:</strong> гиперопека, жертвенность</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваша миссия:</strong> «Любовь начинается с себя». Заботясь о других, не забывайте о себе.</div>";
                break;
                
            case 7: // СЕМЁРКА
                $analysis .= "<span class='level-strong'>7 — МИССИЯ ИСКАТЕЛЯ ИСТИНЫ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-search'></i> ВАША ГЛАВНАЯ МИССИЯ</h5>";
                $analysis .= "<p><strong>Второе число 7</strong> говорит о том, что ваша главная жизненная миссия — познать истину, развить интуицию, обрести мудрость.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основная задача:</strong> углубляться в знания, исследовать</li>";
                $analysis .= "<li><strong>Ключевое качество:</strong> аналитический ум, интуиция, духовность</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> вы здесь, чтобы задавать вопросы и находить ответы</li>";
                $analysis .= "<li><strong>В чем реализоваться:</strong> в науке, философии, эзотерике</li>";
                $analysis .= "<li><strong>Опасность:</strong> замкнутость, высокомерие</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваша миссия:</strong> «Познание — свет, но не ослепляющий». Делитесь мудростью с миром.</div>";
                break;
                
            case 8: // ВОСЬМЁРКА
                $analysis .= "<span class='level-excellent'>8 — МИССИЯ ВЛАСТЕЛИНА</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-chart-bar'></i> ВАША ГЛАВНАЯ МИССИЯ</h5>";
                $analysis .= "<p><strong>Второе число 8</strong> говорит о том, что ваша главная жизненная миссия — обрести баланс между духовным и материальным, достичь успеха и научиться управлять.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основная задача:</strong> научиться управлять ресурсами и властью</li>";
                $analysis .= "<li><strong>Ключевое качество:</strong> деловая хватка, справедливость</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> вы здесь, чтобы создавать системы изобилия</li>";
                $analysis .= "<li><strong>В чем реализоваться:</strong> в бизнесе, финансах, управлении</li>";
                $analysis .= "<li><strong>Опасность:</strong> жадность, властолюбие</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваша миссия:</strong> «Истинная власть — в служении». Будьте справедливы.</div>";
                break;
                
            case 9: // ДЕВЯТКА
                $analysis .= "<span class='level-good'>9 — МИССИЯ МУДРЕЦА</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-dove'></i> ВАША ГЛАВНАЯ МИССИЯ</h5>";
                $analysis .= "<p><strong>Второе число 9</strong> говорит о том, что ваша главная жизненная миссия — служить людям с мудростью и состраданием.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основная задача:</strong> отдавать, прощать, быть примером</li>";
                $analysis .= "<li><strong>Ключевое качество:</strong> мудрость, альтруизм, понимание</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> вы здесь, чтобы завершать старое и начинать новое</li>";
                $analysis .= "<li><strong>В чем реализоваться:</strong> в наставничестве, благотворительности</li>";
                $analysis .= "<li><strong>Опасность:</strong> фанатизм, отрыв от реальности</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваша миссия:</strong> «Служение — это путь к себе». Помогая другим, вы растете сами.</div>";
                break;
        }
    }
    
    /***************************************************************************
     * РАЗДЕЛ 2: ДВУЗНАЧНЫЕ ЧИСЛА (10-18)
     ***************************************************************************/
    elseif ($value >= 10 && $value <= 18) {
        
        // МАСТЕР-ЧИСЛО 11
        if ($value == 11) {
            $analysis .= "<span class='level-excellent'>11 — МАСТЕР-ЧИСЛО (ПРОСВЕТЛЕНИЕ)</span>";
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-crown'></i> <i class='fas fa-om'></i> РАЗБОР ЧИСЛА 11</h5>";
            $analysis .= "<p><strong>Второе число 11</strong> — это мастер-число, указывающее на высшую духовную миссию.</p>";
            $analysis .= "<ul>";
            $analysis .= "<li><strong>Состав:</strong> 1 + 1 = 2 (баланс через лидерство)</li>";
            $analysis .= "<li><strong>Первая цифра (1):</strong> " . vspom2_1(1) . "</li>";
            $analysis .= "<li><strong>Вторая цифра (1):</strong> " . vspom2_1(1) . "</li>";
            $analysis .= "<li><strong>Базовая основа (2):</strong> " . vspom2_2(2) . "</li>";
            $analysis .= "</ul>";
            $analysis .= "</div>";
            
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-star'></i> ВАША МИССИЯ</h5>";
            $analysis .= "<ul>";
            $analysis .= "<li><strong>Главная задача:</strong> нести свет, вдохновлять, быть духовным лидером</li>";
            $analysis .= "<li><strong>Ключевое качество:</strong> сверхинтуиция, способность к озарениям</li>";
            $analysis .= "<li><strong>Особая миссия:</strong> соединять небесное и земное</li>";
            $analysis .= "<li><strong>Предназначение:</strong> учить, исцелять, просветлять</li>";
            $analysis .= "<li><strong>Предупреждение:</strong> берегите нервную систему</li>";
            $analysis .= "</ul>";
            $analysis .= "</div>";
            $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваша миссия:</strong> «Я есть свет». Но не забывайте о земных делах.</div>";
        }
        
        // МАСТЕР-ЧИСЛО 22
        elseif ($value == 22) {
            $analysis .= "<span class='level-excellent'>22 — МАСТЕР-ЧИСЛО (СОЗИДАНИЕ)</span>";
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-crown'></i> <i class='fas fa-building'></i> РАЗБОР ЧИСЛА 22</h5>";
            $analysis .= "<p><strong>Второе число 22</strong> — это мастер-число, указывающее на миссию великого созидания.</p>";
            $analysis .= "<ul>";
            $analysis .= "<li><strong>Состав:</strong> 2 + 2 = 4 (созидание через гармонию)</li>";
            $analysis .= "<li><strong>Первая цифра (2):</strong> " . vspom2_1(2) . "</li>";
            $analysis .= "<li><strong>Вторая цифра (2):</strong> " . vspom2_1(2) . "</li>";
            $analysis .= "<li><strong>Базовая основа (4):</strong> " . vspom2_2(4) . "</li>";
            $analysis .= "</ul>";
            $analysis .= "</div>";
            
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-star'></i> ВАША МИССИЯ</h5>";
            $analysis .= "<ul>";
            $analysis .= "<li><strong>Главная задача:</strong> воплощать масштабные проекты, строить для многих</li>";
            $analysis .= "<li><strong>Ключевое качество:</strong> организаторский гений, практичность</li>";
            $analysis .= "<li><strong>Особая миссия:</strong> создавать системы, меняющие мир</li>";
            $analysis .= "<li><strong>Предназначение:</strong> строить, управлять, созидать</li>";
            $analysis .= "<li><strong>Предупреждение:</strong> не берите всё на себя</li>";
            $analysis .= "</ul>";
            $analysis .= "</div>";
            $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваша миссия:</strong> «Я строю будущее». Но помните о настоящем.</div>";
        }
        
        // ОСТАЛЬНЫЕ ДВУЗНАЧНЫЕ (10,12-18)
        else {
            $analysis .= "<span class='level-strong'>$value — УПРАВЛЯЮЩАЯ МИССИЯ</span>";
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-puzzle-piece'></i> РАЗБОР ЧИСЛА $value</h5>";
            $analysis .= "<p><strong>$value = $firstDigit + $secondDigit = " . ($firstDigit+$secondDigit) . " → $reducedValue</strong></p>";
            $analysis .= "<ul>";
            $analysis .= "<li><strong>Первая цифра ($firstDigit):</strong> " . vspom2_1($firstDigit) . "</li>";
            $analysis .= "<li><strong>Вторая цифра ($secondDigit):</strong> " . vspom2_1($secondDigit) . "</li>";
            $analysis .= "<li><strong>Сумма цифр (" . ($firstDigit+$secondDigit) . "):</strong> ваша осознанная задача</li>";
            $analysis .= "<li><strong>Базовая основа ($reducedValue):</strong> " . vspom2_2($reducedValue) . "</li>";
            $analysis .= "</ul>";
            $analysis .= "</div>";
            
            $analysis .= "<div class='line-subsection'>";
            $analysis .= "<h5><i class='fas fa-compass'></i> ВАША МИССИЯ</h5>";
            
            // Специфика для каждого числа
            switch($value) {
                case 10:
                    $analysis .= "<p><strong>10:</strong> 1 + 0 = 1 → 1</p>";
                    $analysis .= "<ul>";
                    $analysis .= "<li><strong>Миссия:</strong> лидерство с высшим потенциалом</li>";
                    $analysis .= "<li><strong>Ключ:</strong> используйте удачу (0) для лидерства (1)</li>";
                    $analysis .= "<li><strong>Задача:</strong> стать лидером, которому помогает судьба</li>";
                    $analysis .= "<li><strong>Предупреждение:</strong> не полагайтесь только на везение</li>";
                    $analysis .= "</ul>";
                    break;
                    
                case 12:
                    $analysis .= "<p><strong>12:</strong> 1 + 2 = 3</p>";
                    $analysis .= "<ul>";
                    $analysis .= "<li><strong>Миссия:</strong> творческое лидерство</li>";
                    $analysis .= "<li><strong>Ключ:</strong> объединяйте волю (1) с дипломатией (2)</li>";
                    $analysis .= "<li><strong>Задача:</strong> вдохновлять и вести через творчество</li>";
                    $analysis .= "<li><strong>Предназначение:</strong> быть лидером-вдохновителем</li>";
                    $analysis .= "</ul>";
                    break;
                    
                case 13:
                    $analysis .= "<p><strong>13:</strong> 1 + 3 = 4</p>";
                    $analysis .= "<ul>";
                    $analysis .= "<li><strong>Миссия:</strong> лидерство через созидание</li>";
                    $analysis .= "<li><strong>Ключ:</strong> соединяйте инициативу (1) с творчеством (3)</li>";
                    $analysis .= "<li><strong>Задача:</strong> строить и создавать, вдохновляя примером</li>";
                    $analysis .= "<li><strong>Предназначение:</strong> быть лидером-строителем</li>";
                    $analysis .= "</ul>";
                    break;
                    
                case 14:
                    $analysis .= "<p><strong>14:</strong> 1 + 4 = 5</p>";
                    $analysis .= "<ul>";
                    $analysis .= "<li><strong>Миссия:</strong> лидерство через свободу</li>";
                    $analysis .= "<li><strong>Ключ:</strong> соединяйте волю (1) с порядком (4)</li>";
                    $analysis .= "<li><strong>Задача:</strong> вести других к новым горизонтам</li>";
                    $analysis .= "<li><strong>Предназначение:</strong> быть лидером-первопроходцем</li>";
                    $analysis .= "</ul>";
                    break;
                    
                case 15:
                    $analysis .= "<p><strong>15:</strong> 1 + 5 = 6</p>";
                    $analysis .= "<ul>";
                    $analysis .= "<li><strong>Миссия:</strong> лидерство через заботу</li>";
                    $analysis .= "<li><strong>Ключ:</strong> соединяйте силу (1) с ответственностью (5)</li>";
                    $analysis .= "<li><strong>Задача:</strong> заботиться о тех, кто идёт за вами</li>";
                    $analysis .= "<li><strong>Предназначение:</strong> быть лидером-защитником</li>";
                    $analysis .= "</ul>";
                    break;
                    
                case 16:
                    $analysis .= "<p><strong>16:</strong> 1 + 6 = 7</p>";
                    $analysis .= "<ul>";
                    $analysis .= "<li><strong>Миссия:</strong> лидерство через мудрость</li>";
                    $analysis .= "<li><strong>Ключ:</strong> соединяйте действие (1) с анализом (6)</li>";
                    $analysis .= "<li><strong>Задача:</strong> вести, понимая глубинные процессы</li>";
                    $analysis .= "<li><strong>Предназначение:</strong> быть лидером-мыслителем</li>";
                    $analysis .= "</ul>";
                    break;
                    
                case 17:
                    $analysis .= "<p><strong>17:</strong> 1 + 7 = 8</p>";
                    $analysis .= "<ul>";
                    $analysis .= "<li><strong>Миссия:</strong> лидерство через успех</li>";
                    $analysis .= "<li><strong>Ключ:</strong> соединяйте инициативу (1) с властью (7)</li>";
                    $analysis .= "<li><strong>Задача:</strong> достигать вершин и делиться успехом</li>";
                    $analysis .= "<li><strong>Предназначение:</strong> быть лидером-магнатом</li>";
                    $analysis .= "</ul>";
                    break;
                    
                case 18:
                    $analysis .= "<p><strong>18:</strong> 1 + 8 = 9</p>";
                    $analysis .= "<ul>";
                    $analysis .= "<li><strong>Миссия:</strong> лидерство через служение</li>";
                    $analysis .= "<li><strong>Ключ:</strong> соединяйте волю (1) с мудростью (8)</li>";
                    $analysis .= "<li><strong>Задача:</strong> использовать власть для помощи другим</li>";
                    $analysis .= "<li><strong>Предназначение:</strong> быть лидером-благодетелем</li>";
                    $analysis .= "</ul>";
                    break;
            }
            $analysis .= "</div>";
        }
    }
    
    /***************************************************************************
     * РАЗДЕЛ 3: ЧИСЛА 19-31 (РЕДКО ВСТРЕЧАЮТСЯ КАК ВТОРЫЕ)
     ***************************************************************************/
    elseif ($value >= 19 && $value <= 31) {
        $analysis .= "<span class='level-strong'>$value — УСИЛЕННАЯ МИССИЯ</span>";
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-puzzle-piece'></i> РАЗБОР ЧИСЛА $value</h5>";
        $analysis .= "<p><strong>$value = $firstDigit + $secondDigit = " . ($firstDigit+$secondDigit) . " → $reducedValue</strong></p>";
        $analysis .= "<ul>";
        $analysis .= "<li><strong>Первая цифра ($firstDigit):</strong> " . vspom2_1($firstDigit) . "</li>";
        $analysis .= "<li><strong>Вторая цифра ($secondDigit):</strong> " . vspom2_1($secondDigit) . "</li>";
        $analysis .= "<li><strong>Базовая основа ($reducedValue):</strong> " . vspom2_2($reducedValue) . "</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-star'></i> ХАРАКТЕРИСТИКА МИССИИ</h5>";
        $analysis .= "<ul>";
        
        if ($value == 19) {
            $analysis .= "<li><strong>19 (1+9=10→1):</strong> кармическое лидерство</li>";
            $analysis .= "<li><strong>Особенность:</strong> высокая миссия, связанная с завершением старого и началом нового</li>";
            $analysis .= "<li><strong>Задача:</strong> не злоупотреблять властью</li>";
        } elseif ($value == 20) {
            $analysis .= "<li><strong>20 (2+0=2):</strong> гармония с высшим потенциалом</li>";
            $analysis .= "<li><strong>Особенность:</strong> миссия миротворца с поддержкой судьбы</li>";
            $analysis .= "<li><strong>Задача:</strong> использовать дипломатию для великих целей</li>";
        } elseif ($value == 21) {
            $analysis .= "<li><strong>21 (2+1=3):</strong> гармоничное творчество</li>";
            $analysis .= "<li><strong>Особенность:</strong> миссия объединять людей через искусство</li>";
            $analysis .= "<li><strong>Задача:</strong> творить в сотрудничестве</li>";
        } elseif ($value == 23) {
            $analysis .= "<li><strong>23 (2+3=5):</strong> свободная гармония</li>";
            $analysis .= "<li><strong>Особенность:</strong> миссия соединять людей через перемены</li>";
            $analysis .= "<li><strong>Задача:</strong> быть дипломатом в мире свободы</li>";
        } elseif ($value == 24) {
            $analysis .= "<li><strong>24 (2+4=6):</strong> гармоничная забота</li>";
            $analysis .= "<li><strong>Особенность:</strong> миссия создавать гармонию через порядок</li>";
            $analysis .= "<li><strong>Задача:</strong> заботиться, сохраняя баланс</li>";
        } elseif ($value == 25) {
            $analysis .= "<li><strong>25 (2+5=7):</strong> гармоничная мудрость</li>";
            $analysis .= "<li><strong>Особенность:</strong> миссия познания через отношения</li>";
            $analysis .= "<li><strong>Задача:</strong> учиться у людей и учить их</li>";
        } elseif ($value == 26) {
            $analysis .= "<li><strong>26 (2+6=8):</strong> гармоничная власть</li>";
            $analysis .= "<li><strong>Особенность:</strong> миссия управлять через заботу</li>";
            $analysis .= "<li><strong>Задача:</strong> быть справедливым лидером</li>";
        } elseif ($value == 27) {
            $analysis .= "<li><strong>27 (2+7=9):</strong> гармоничное служение</li>";
            $analysis .= "<li><strong>Особенность:</strong> миссия помогать через мудрость</li>";
            $analysis .= "<li><strong>Задача:</strong> служить, сохраняя гармонию</li>";
        } elseif ($value == 28) {
            $analysis .= "<li><strong>28 (2+8=10→1):</strong> гармоничное лидерство</li>";
            $analysis .= "<li><strong>Особенность:</strong> миссия вести через дипломатию</li>";
            $analysis .= "<li><strong>Задача:</strong> быть лидером-миротворцем</li>";
        } elseif ($value == 29) {
            $analysis .= "<li><strong>29 (2+9=11→2):</strong> мастер-гармония</li>";
            $analysis .= "<li><strong>Особенность:</strong> приближение к мастер-числу</li>";
            $analysis .= "<li><strong>Задача:</strong> развивать высшую дипломатию</li>";
        } elseif ($value == 30) {
            $analysis .= "<li><strong>30 (3+0=3):</strong> творческий потенциал</li>";
            $analysis .= "<li><strong>Особенность:</strong> миссия творить с поддержкой свыше</li>";
            $analysis .= "<li><strong>Задача:</strong> реализовать творческий дар</li>";
        } elseif ($value == 31) {
            $analysis .= "<li><strong>31 (3+1=4):</strong> творческий порядок</li>";
            $analysis .= "<li><strong>Особенность:</strong> миссия структурировать творчество</li>";
            $analysis .= "<li><strong>Задача:</strong> придавать идеям форму</li>";
        }
        
        $analysis .= "</ul>";
        $analysis .= "</div>";
    }
    
    /***************************************************************************
     * РАЗДЕЛ 4: ЧИСЛА БОЛЬШЕ 31 (РЕДЧАЙШИЕ СЛУЧАИ)
     ***************************************************************************/
    elseif ($value > 31) {
        $analysis .= "<span class='level-excellent'>$value — РЕДЧАЙШАЯ МИССИЯ</span>";
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-star'></i> РАЗБОР ЧИСЛА $value</h5>";
        $analysis .= "<p><strong>" . implode(' + ', str_split($value)) . " = " . array_sum(str_split($value)) . " → $reducedValue</strong></p>";
        $analysis .= "<ul>";
        $digits = str_split($value);
        foreach($digits as $index => $digit) {
            $analysis .= "<li><strong>Цифра " . ($index+1) . " ($digit):</strong> " . vspom2_1($digit) . "</li>";
        }
        $analysis .= "<li><strong>Базовая основа ($reducedValue):</strong> " . vspom2_2($reducedValue) . "</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-compass'></i> ОСОБЕННОСТИ МИССИИ</h5>";
        $analysis .= "<ul>";
        $analysis .= "<li>У вас очень редкая и сильная миссия</li>";
        $analysis .= "<li>Число $value встречается крайне редко</li>";
        $analysis .= "<li>Вам нужно анализировать все цифры в комплексе</li>";
        $analysis .= "<li>Ваш путь уникален — ищите свои методы реализации</li>";
        $analysis .= "<li>Рекомендуется глубокий индивидуальный разбор</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-note'>";
        $analysis .= "<i class='fas fa-feather'></i> ";
        $analysis .= "<strong>Ваша миссия уникальна.</strong> Не сравнивайте себя с другими, ищите свой путь.";
        $analysis .= "</div>";
    }
    
    /***************************************************************************
     * ОБЩИЕ РЕКОМЕНДАЦИИ ДЛЯ ВСЕХ ЧИСЕЛ
     ***************************************************************************/
    $analysis .= "<div class='line-subsection'>";
    $analysis .= "<h5><i class='fas fa-tasks'></i> КАК РЕАЛИЗОВАТЬ СВОЮ МИССИЮ</h5>";
    $analysis .= "<ul>";
    $analysis .= "<li><strong>Осознайте:</strong> ваше второе число — это не приговор, а компас</li>";
    $analysis .= "<li><strong>Развивайте:</strong> качества, соответствующие вашему числу</li>";
    $analysis .= "<li><strong>Избегайте:</strong> крайностей и негативных проявлений</li>";
    $analysis .= "<li><strong>Помните:</strong> миссия раскрывается постепенно, с опытом</li>";
    $analysis .= "<li><strong>Соединяйте:</strong> второе число с первым (цель) и третьим (таланты)</li>";
    $analysis .= "</ul>";
    $analysis .= "</div>";
    
    $analysis .= "</div></div>";
    return $analysis;
}

/**
 * ВСПОМОГАТЕЛЬНАЯ ФУНКЦИЯ 1: Описание цифры (десятки и единицы)
 */
function vspom2_1($digit) {
    $descriptions = [
        1 => 'лидерство, воля, начало, инициатива',
        2 => 'гармония, дипломатичность, чувствительность, баланс',
        3 => 'творчество, оптимизм, самовыражение, радость',
        4 => 'порядок, труд, стабильность, дисциплина, надежность',
        5 => 'свобода, перемены, прогресс, приключения, адаптивность',
        6 => 'забота, семья, ответственность, любовь, служение',
        7 => 'анализ, мудрость, интуиция, познание, духовность',
        8 => 'власть, успех, материальность, изобилие, справедливость',
        9 => 'служение, мудрость, завершение, сострадание, идеализм',
        0 => 'потенциал, бесконечность, связь с высшим, удача'
    ];
    return $descriptions[$digit] ?? 'особое качество, требующее раскрытия';
}

/**
 * ВСПОМОГАТЕЛЬНАЯ ФУНКЦИЯ 2: Описание базового числа (редуцированная основа)
 */
function vspom2_2($num) {
    $bases = [
        1 => 'независимость и лидерство — вам нужно научиться полагаться на себя и вести других',
        2 => 'гармония и сотрудничество — ваша основа в умении договариваться',
        3 => 'творчество и самовыражение — через радость и вдохновение вы реализуете себя',
        4 => 'порядок и стабильность — создавайте прочные структуры',
        5 => 'свобода и перемены — будьте проводником изменений',
        6 => 'любовь и забота — через служение близким вы растете',
        7 => 'мудрость и познание — ищите истину и делитесь ею',
        8 => 'власть и изобилие — учитесь управлять ресурсами во благо',
        9 => 'служение и завершение — отдавайте и завершайте циклы'
    ];
    return $bases[$num] ?? 'глубокая внутренняя задача, требующая осознания';
}
        
//2 допчисло
//3 допчисло
function AnalDopNum3($value) {
    $analysis = "<div class='line-item'>";
    $analysis .= "<h4><i class='fas fa-gift'></i> Третье дополнительное число: <span class='line-name'>Число талантов и врожденных способностей</span></h4>";
    $analysis .= "<div class='line-formula'>Расчет: первое число минус удвоенная первая цифра даты = <strong>$value</strong></div>";
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
                $analysis .= "<span class='level-strong'>1 — ТАЛАНТ ЛИДЕРА</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-crown'></i> ВРОЖДЕННЫЕ СПОСОБНОСТИ</h5>";
                $analysis .= "<p><strong>Третье число 1</strong> говорит о том, что от рождения вы наделены талантом лидера, организатора, первопроходца.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основной талант:</strong> умение начинать новое, вести за собой</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> инициативность, смелость, независимость</li>";
                $analysis .= "<li><strong>В чем блещете:</strong> там, где нужно действовать быстро и решительно</li>";
                $analysis .= "<li><strong>Как развивать:</strong> берите ответственность, не бойтесь быть первым</li>";
                $analysis .= "<li><strong>Теневая сторона:</strong> склонность к диктату, неумение слушать</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш дар:</strong> вы умеете зажигать других. Но помните — лидер без команды не лидер.</div>";
                break;
                
            case 2: // ДВОЙКА
                $analysis .= "<span class='level-medium'>2 — ТАЛАНТ ДИПЛОМАТА</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-handshake'></i> ВРОЖДЕННЫЕ СПОСОБНОСТИ</h5>";
                $analysis .= "<p><strong>Третье число 2</strong> говорит о том, что от рождения вы наделены талантом миротворца, дипломата, переговорщика.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основной талант:</strong> умение сглаживать конфликты, находить компромиссы</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> чуткость, тактичность, умение слушать</li>";
                $analysis .= "<li><strong>В чем блещете:</strong> в работе с людьми, в командных проектах</li>";
                $analysis .= "<li><strong>Как развивать:</strong> учитесь отстаивать и свои интересы тоже</li>";
                $analysis .= "<li><strong>Теневая сторона:</strong> зависимость от чужого мнения, нерешительность</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш дар:</strong> вы чувствуете людей. Но не теряйте себя в угоду другим.</div>";
                break;
                
            case 3: // ТРОЙКА
                $analysis .= "<span class='level-good'>3 — ТАЛАНТ ТВОРЦА</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-paint-brush'></i> ВРОЖДЕННЫЕ СПОСОБНОСТИ</h5>";
                $analysis .= "<p><strong>Третье число 3</strong> говорит о том, что от рождения вы наделены творческими способностями, артистизмом, даром слова.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основной талант:</strong> самовыражение, творчество, вдохновение</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> креативность, оптимизм, общительность</li>";
                $analysis .= "<li><strong>В чем блещете:</strong> в искусстве, публичных выступлениях, литературе</li>";
                $analysis .= "<li><strong>Как развивать:</strong> ищите выход для творчества, но доводите до конца</li>";
                $analysis .= "<li><strong>Теневая сторона:</strong> поверхностность, разбросанность</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш дар:</strong> вы можете вдохновлять словом. Но слово должно вести к делу.</div>";
                break;
                
            case 4: // ЧЕТВЁРКА
                $analysis .= "<span class='level-strong'>4 — ТАЛАНТ СТРОИТЕЛЯ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-building'></i> ВРОЖДЕННЫЕ СПОСОБНОСТИ</h5>";
                $analysis .= "<p><strong>Третье число 4</strong> говорит о том, что от рождения вы наделены талантом организатора, строителя, хранителя порядка.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основной талант:</strong> создавать структуры, наводить порядок, систематизировать</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> надежность, ответственность, трудолюбие</li>";
                $analysis .= "<li><strong>В чем блещете:</strong> в работе, требующей дисциплины и системы</li>";
                $analysis .= "<li><strong>Как развивать:</strong> учитесь гибкости в рамках системы</li>";
                $analysis .= "<li><strong>Теневая сторона:</strong> застревание в мелочах, упрямство</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш дар:</strong> вы создаете опору. Но не дайте порядку задушить жизнь.</div>";
                break;
                
            case 5: // ПЯТЁРКА
                $analysis .= "<span class='level-good'>5 — ТАЛАНТ СВОБОДНОГО СТРАННИКА</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-globe'></i> ВРОЖДЕННЫЕ СПОСОБНОСТИ</h5>";
                $analysis .= "<p><strong>Третье число 5</strong> говорит о том, что от рождения вы наделены талантом адаптации, свободы, перемен.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основной талант:</strong> легко приспосабливаться, находить выход из любых ситуаций</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> гибкость, любознательность, обаяние</li>";
                $analysis .= "<li><strong>В чем блещете:</strong> в путешествиях, торговле, инновациях</li>";
                $analysis .= "<li><strong>Как развивать:</strong> учитесь фокусу среди множества возможностей</li>";
                $analysis .= "<li><strong>Теневая сторона:</strong> хаотичность, безответственность</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш дар:</strong> вы умеете меняться. Но перемены должны вести к цели.</div>";
                break;
                
            case 6: // ШЕСТЁРКА
                $analysis .= "<span class='level-medium'>6 — ТАЛАНТ ЗАБОТЛИВОГО СЕРДЦА</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-heart'></i> ВРОЖДЕННЫЕ СПОСОБНОСТИ</h5>";
                $analysis .= "<p><strong>Третье число 6</strong> говорит о том, что от рождения вы наделены талантом заботы, любви, создания гармонии.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основной талант:</strong> заботиться о других, создавать уют, исцелять</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> доброта, понимание, ответственность</li>";
                $analysis .= "<li><strong>В чем блещете:</strong> в семье, медицине, педагогике</li>";
                $analysis .= "<li><strong>Как развивать:</strong> учитесь заботиться и о себе тоже</li>";
                $analysis .= "<li><strong>Теневая сторона:</strong> гиперопека, жертвенность</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш дар:</strong> вы умеете любить. Но любовь начинается с любви к себе.</div>";
                break;
                
            case 7: // СЕМЁРКА
                $analysis .= "<span class='level-strong'>7 — ТАЛАНТ ИСКАТЕЛЯ ИСТИНЫ</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-search'></i> ВРОЖДЕННЫЕ СПОСОБНОСТИ</h5>";
                $analysis .= "<p><strong>Третье число 7</strong> говорит о том, что от рождения вы наделены талантом аналитика, исследователя, мыслителя.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основной талант:</strong> глубокий анализ, интуиция, понимание скрытого</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> проницательность, мудрость, способность к исследованиям</li>";
                $analysis .= "<li><strong>В чем блещете:</strong> в науке, философии, эзотерике</li>";
                $analysis .= "<li><strong>Как развивать:</strong> делитесь знаниями, не замыкайтесь</li>";
                $analysis .= "<li><strong>Теневая сторона:</strong> замкнутость, высокомерие</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш дар:</strong> вы видите глубже других. Но знание должно служить жизни.</div>";
                break;
                
            case 8: // ВОСЬМЁРКА
                $analysis .= "<span class='level-excellent'>8 — ТАЛАНТ ВЛАСТЕЛИНА</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-chart-bar'></i> ВРОЖДЕННЫЕ СПОСОБНОСТИ</h5>";
                $analysis .= "<p><strong>Третье число 8</strong> говорит о том, что от рождения вы наделены талантом управленца, финансиста, лидера.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основной талант:</strong> управлять ресурсами, достигать успеха, организовывать</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> деловая хватка, стратегическое мышление</li>";
                $analysis .= "<li><strong>В чем блещете:</strong> в бизнесе, финансах, управлении</li>";
                $analysis .= "<li><strong>Как развивать:</strong> используйте власть во благо</li>";
                $analysis .= "<li><strong>Теневая сторона:</strong> жадность, властолюбие</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш дар:</strong> вы можете достичь вершин. Но помните — чем выше, тем ответственнее.</div>";
                break;
                
            case 9: // ДЕВЯТКА
                $analysis .= "<span class='level-good'>9 — ТАЛАНТ МУДРЕЦА</span>";
                $analysis .= "<div class='line-subsection'>";
                $analysis .= "<h5><i class='fas fa-dove'></i> ВРОЖДЕННЫЕ СПОСОБНОСТИ</h5>";
                $analysis .= "<p><strong>Третье число 9</strong> говорит о том, что от рождения вы наделены талантом мудреца, наставника, целителя душ.</p>";
                $analysis .= "<ul>";
                $analysis .= "<li><strong>Основной талант:</strong> понимать людей, прощать, наставлять</li>";
                $analysis .= "<li><strong>Как проявляется:</strong> мудрость, сострадание, идеализм</li>";
                $analysis .= "<li><strong>В чем блещете:</strong> в наставничестве, благотворительности, искусстве</li>";
                $analysis .= "<li><strong>Как развивать:</strong> учитесь видеть реальность, а не только идеалы</li>";
                $analysis .= "<li><strong>Теневая сторона:</strong> фанатизм, отрыв от реальности</li>";
                $analysis .= "</ul>";
                $analysis .= "</div>";
                $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш дар:</strong> вы несете мудрость. Но мудрость должна быть практичной.</div>";
                break;
        }
    }
    
    /***************************************************************************
     * РАЗДЕЛ 2: МАСТЕР-ЧИСЛА (11, 22)
     ***************************************************************************/
    elseif ($value == 11) {
        $analysis .= "<span class='level-excellent'>11 — МАСТЕР-ЧИСЛО ТАЛАНТОВ</span>";
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-crown'></i> <i class='fas fa-om'></i> РАЗБОР ЧИСЛА 11</h5>";
        $analysis .= "<p><strong>Третье число 11</strong> — мастер-число, указывающее на врожденные способности высшего порядка.</p>";
        $analysis .= "<ul>";
        $analysis .= "<li><strong>Состав:</strong> 1 + 1 = 2 (таланты, ведущие к гармонии)</li>";
        $analysis .= "<li><strong>Первая цифра (1):</strong> " . vspom3_1(1) . "</li>";
        $analysis .= "<li><strong>Вторая цифра (1):</strong> " . vspom3_1(1) . " (усилено)</li>";
        $analysis .= "<li><strong>Базовая основа (2):</strong> " . vspom3_2(2) . "</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-star'></i> ОСОБЫЕ ТАЛАНТЫ</h5>";
        $analysis .= "<ul>";
        $analysis .= "<li><strong>Сверхспособности:</strong> интуиция, ясновидение, вдохновение</li>";
        $analysis .= "<li><strong>Дар:</strong> чувствовать то, что скрыто от других</li>";
        $analysis .= "<li><strong>Миссия таланта:</strong> нести свет, вдохновлять, исцелять словом</li>";
        $analysis .= "<li><strong>Как развивать:</strong> доверяйте интуиции, но проверяйте реальностью</li>";
        $analysis .= "<li><strong>Предупреждение:</strong> берегите нервную систему, заземляйтесь</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш дар:</strong> вы проводник высших энергий. Но не забывайте о земных делах.</div>";
    }
    
    elseif ($value == 22) {
        $analysis .= "<span class='level-excellent'>22 — МАСТЕР-ЧИСЛО ТАЛАНТОВ</span>";
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-crown'></i> <i class='fas fa-building'></i> РАЗБОР ЧИСЛА 22</h5>";
        $analysis .= "<p><strong>Третье число 22</strong> — мастер-число, указывающее на таланты масштабного созидания.</p>";
        $analysis .= "<ul>";
        $analysis .= "<li><strong>Состав:</strong> 2 + 2 = 4 (таланты, ведущие к созиданию)</li>";
        $analysis .= "<li><strong>Первая цифра (2):</strong> " . vspom3_1(2) . "</li>";
        $analysis .= "<li><strong>Вторая цифра (2):</strong> " . vspom3_1(2) . " (усилено)</li>";
        $analysis .= "<li><strong>Базовая основа (4):</strong> " . vspom3_2(4) . "</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-star'></i> ОСОБЫЕ ТАЛАНТЫ</h5>";
        $analysis .= "<ul>";
        $analysis .= "<li><strong>Сверхспособности:</strong> масштабное мышление, организаторский гений</li>";
        $analysis .= "<li><strong>Дар:</strong> воплощать идеи в реальность, строить системы</li>";
        $analysis .= "<li><strong>Миссия таланта:</strong> создавать структуры, меняющие мир</li>";
        $analysis .= "<li><strong>Как развивать:</strong> мыслите глобально, действуйте локально</li>";
        $analysis .= "<li><strong>Предупреждение:</strong> не берите всё на себя</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        $analysis .= "<div class='line-note'><i class='fas fa-lightbulb'></i> <strong>Ваш дар:</strong> вы можете строить великое. Но начинайте с малого.</div>";
    }
    
    /***************************************************************************
     * РАЗДЕЛ 3: ДВУЗНАЧНЫЕ ЧИСЛА (10, 12-19, 20-31)
     ***************************************************************************/
    elseif ($value >= 10 && $value <= 31 && $value != 11 && $value != 22) {
        $analysis .= "<span class='level-strong'>$value — СОСТАВНОЙ ТАЛАНТ</span>";
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-puzzle-piece'></i> РАЗБОР ЧИСЛА $value</h5>";
        $analysis .= "<p><strong>$value = $firstDigit + $secondDigit = " . ($firstDigit+$secondDigit) . " → $reducedValue</strong></p>";
        $analysis .= "<ul>";
        $analysis .= "<li><strong>Первая цифра ($firstDigit):</strong> " . vspom3_1($firstDigit) . "</li>";
        $analysis .= "<li><strong>Вторая цифра ($secondDigit):</strong> " . vspom3_1($secondDigit) . "</li>";
        $analysis .= "<li><strong>Сумма цифр (" . ($firstDigit+$secondDigit) . "):</strong> промежуточное проявление таланта</li>";
        $analysis .= "<li><strong>Базовая основа ($reducedValue):</strong> " . vspom3_2($reducedValue) . "</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-star'></i> КОМБИНАЦИЯ ТАЛАНТОВ</h5>";
        $analysis .= "<ul>";
        
        // Группировка по десяткам
        if ($value >= 10 && $value <= 19) {
            $analysis .= "<li><strong>Группа 10-19 (лидерские таланты):</strong> лидерство ($firstDigit) дополнено качеством " . vspom3_1($secondDigit) . "</li>";
            $analysis .= "<li>Вы прирожденный лидер, но ваш стиль лидерства окрашен энергией числа $secondDigit</li>";
        } elseif ($value >= 20 && $value <= 29) {
            $analysis .= "<li><strong>Группа 20-29 (дипломатические таланты):</strong> гармония ($firstDigit) дополнена качеством " . vspom3_1($secondDigit) . "</li>";
            $analysis .= "<li>Вы прирожденный дипломат, но ваш стиль общения окрашен энергией числа $secondDigit</li>";
        } elseif ($value >= 30 && $value <= 31) {
            $analysis .= "<li><strong>Группа 30-31 (творческие таланты):</strong> творчество ($firstDigit) дополнено качеством " . vspom3_1($secondDigit) . "</li>";
            $analysis .= "<li>Вы прирожденный творец, но ваш стиль творчества окрашен энергией числа $secondDigit</li>";
        }
        
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-compass'></i> ИНДИВИДУАЛЬНАЯ ХАРАКТЕРИСТИКА</h5>";
        $analysis .= "<ul>";
        
        // Специфика для каждого числа
        switch($value) {
            case 10:
                $analysis .= "<li><strong>10:</strong> лидерский талант с удачей. Вы умеете оказываться в нужное время в нужном месте.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> доверяйте интуиции, но полагайтесь и на расчет.</li>";
                break;
            case 12:
                $analysis .= "<li><strong>12:</strong> лидерство через творчество и дипломатию. Вы вдохновляете словом.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> объединяйте людей вокруг идей.</li>";
                break;
            case 13:
                $analysis .= "<li><strong>13:</strong> лидерство через созидание. Вы умеете строить и создавать.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> беритесь за проекты, требующие упорства.</li>";
                break;
            case 14:
                $analysis .= "<li><strong>14:</strong> лидерство через свободу. Вы открываете новые горизонты.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> будьте первопроходцем в своей сфере.</li>";
                break;
            case 15:
                $analysis .= "<li><strong>15:</strong> лидерство через заботу. Вы ведете, оберегая.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> создавайте команды, где о людях заботятся.</li>";
                break;
            case 16:
                $analysis .= "<li><strong>16:</strong> лидерство через мудрость. Вы ведете, понимая глубинные процессы.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> анализируйте и действуйте осознанно.</li>";
                break;
            case 17:
                $analysis .= "<li><strong>17:</strong> лидерство через успех. Вы умеете достигать вершин.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> стройте карьеру, но не теряйте человечность.</li>";
                break;
            case 18:
                $analysis .= "<li><strong>18:</strong> лидерство через служение. Ваша власть служит другим.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> помогайте, ведя за собой.</li>";
                break;
            case 19:
                $analysis .= "<li><strong>19:</strong> кармический лидерский талант. Вы завершаете старое и начинаете новое.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> не бойтесь закрывать двери, чтобы открывать новые.</li>";
                break;
            case 20:
                $analysis .= "<li><strong>20:</strong> дипломатический талант с удачей. Вы чувствуете людей и ситуацию.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> доверяйте своей интуиции в отношениях.</li>";
                break;
            case 21:
                $analysis .= "<li><strong>21:</strong> гармония через творчество. Вы объединяете людей искусством.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> создавайте красоту вместе с другими.</li>";
                break;
            case 23:
                $analysis .= "<li><strong>23:</strong> гармония через свободу. Вы легко находите общий язык с разными людьми.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> будьте связующим звеном между разными мирами.</li>";
                break;
            case 24:
                $analysis .= "<li><strong>24:</strong> гармония через заботу. Вы создаете уют и порядок вокруг.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> стройте гармоничные отношения и пространства.</li>";
                break;
            case 25:
                $analysis .= "<li><strong>25:</strong> гармония через мудрость. Вы понимаете людей глубоко.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> будьте психологом, советчиком, наставником.</li>";
                break;
            case 26:
                $analysis .= "<li><strong>26:</strong> гармония через власть. Вы умеете управлять, сохраняя мир.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> стройте справедливые системы.</li>";
                break;
            case 27:
                $analysis .= "<li><strong>27:</strong> гармония через служение. Вы помогаете людям объединяться.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> создавайте сообщества, группы по интересам.</li>";
                break;
            case 28:
                $analysis .= "<li><strong>28:</strong> гармония через лидерство. Вы ведете, сохраняя баланс.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> будьте лидером, к которому прислушиваются.</li>";
                break;
            case 29:
                $analysis .= "<li><strong>29:</strong> гармония через служение на высоком уровне. Вы можете объединять людей идеей.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> развивайте духовный интеллект.</li>";
                break;
            case 30:
                $analysis .= "<li><strong>30:</strong> творческий талант с удачей. Идеи приходят легко и вовремя.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> записывайте и воплощайте свои идеи.</li>";
                break;
            case 31:
                $analysis .= "<li><strong>31:</strong> творчество через лидерство и порядок. Вы структурируете творчество.</li>";
                $analysis .= "<li><strong>Как использовать:</strong> создавайте системы в творческих проектах.</li>";
                break;
        }
        $analysis .= "</ul>";
        $analysis .= "</div>";
    }
    
    /***************************************************************************
     * РАЗДЕЛ 4: ЧИСЛА БОЛЬШЕ 31
     ***************************************************************************/
    elseif ($value > 31) {
        $analysis .= "<span class='level-excellent'>$value — РЕДКАЯ КОМБИНАЦИЯ ТАЛАНТОВ</span>";
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-star'></i> РАЗБОР ЧИСЛА $value</h5>";
        $analysis .= "<p><strong>" . implode(' + ', str_split($value)) . " = " . array_sum(str_split($value)) . " → $reducedValue</strong></p>";
        $analysis .= "<ul>";
        $digits = str_split($value);
        foreach($digits as $index => $digit) {
            $analysis .= "<li><strong>Цифра " . ($index+1) . " ($digit):</strong> " . vspom3_1($digit) . "</li>";
        }
        $analysis .= "<li><strong>Базовая основа ($reducedValue):</strong> " . vspom3_2($reducedValue) . "</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-subsection'>";
        $analysis .= "<h5><i class='fas fa-compass'></i> ОСОБЕННОСТИ ТАЛАНТОВ</h5>";
        $analysis .= "<ul>";
        $analysis .= "<li>У вас редкая, многогранная комбинация талантов</li>";
        $analysis .= "<li>Вы способны сочетать, казалось бы, несочетаемые качества</li>";
        $analysis .= "<li>Вам нужно найти свой уникальный способ самовыражения</li>";
        $analysis .= "<li>Не пытайтесь вписаться в чужие шаблоны</li>";
        $analysis .= "<li>Ищите сферы, где нужны разносторонние способности</li>";
        $analysis .= "</ul>";
        $analysis .= "</div>";
        
        $analysis .= "<div class='line-note'>";
        $analysis .= "<i class='fas fa-feather'></i> ";
        $analysis .= "<strong>Ваши таланты уникальны.</strong> Не сравнивайте себя с другими, ищите свой путь.";
        $analysis .= "</div>";
    }
    
    /***************************************************************************
     * РАЗДЕЛ 5: РЕКОМЕНДАЦИИ ПО РАЗВИТИЮ ТАЛАНТОВ
     ***************************************************************************/
    $analysis .= "<div class='line-subsection'>";
    $analysis .= "<h5><i class='fas fa-seedling'></i> КАК РАЗВИВАТЬ СВОИ ТАЛАНТЫ</h5>";
    $analysis .= "<ul>";
    $analysis .= "<li><strong>Примите:</strong> ваши таланты даны вам не случайно</li>";
    $analysis .= "<li><strong>Развивайте:</strong> ищите возможности применить свои способности</li>";
    $analysis .= "<li><strong>Балансируйте:</strong> у каждой сильной стороны есть тень</li>";
    $analysis .= "<li><strong>Соединяйте:</strong> третий талант с четвертым числом (реализация)</li>";
    $analysis .= "<li><strong>Помните:</strong> талант без развития — просто потенциал</li>";
    $analysis .= "</ul>";
    $analysis .= "</div>";
    
    $analysis .= "</div></div>";
    return $analysis;
}

/**
 * ВСПОМОГАТЕЛЬНАЯ ФУНКЦИЯ 1: Описание цифры для 3-го числа
 */
function vspom3_1($digit) {
    $descriptions = [
        1 => 'лидерство, воля, инициатива, самостоятельность',
        2 => 'дипломатичность, чувствительность, гармония, баланс',
        3 => 'творчество, оптимизм, самовыражение, вдохновение',
        4 => 'порядок, дисциплина, надежность, трудолюбие',
        5 => 'свобода, адаптивность, прогресс, перемены',
        6 => 'забота, ответственность, любовь, семья',
        7 => 'анализ, мудрость, интуиция, познание',
        8 => 'власть, успех, изобилие, управление',
        9 => 'служение, сострадание, мудрость, завершение',
            0 => 'потенциал, удача, связь с высшим, бесконечность'
    ];
    return $descriptions[$digit] ?? 'особое качество, требующее раскрытия';
}
