<?php
// ============================================================
// ULTIMATE РАСШИФРОВКА ПЕРСОНАЛЬНОГО ГОДА
// Платная версия — 15+ страниц A4 на клиента
// 9 чисел × 30 разделов = ~6000 строк
// ============================================================

$yearUltimateInterpretations = [
//расшифровка 1 числа
//расшифровка 2 числа
//расшифровка 3 числа
//расшифровка 4 числа
//расшифровка 5 числа
//расшифровка 6 числа
//расшифровка 7 числа
//расшифровка 8 числа
//расшифровка 9 числа
];
//и после этого массива вызываются функции
function getUltimateInterpretation($number) {
    global $yearUltimateInterpretations;
    $num = $number;
    if ($num == 11) $num = 2;
    if ($num == 22) $num = 4;
    if ($num == 33) $num = 6;
    return $yearUltimateInterpretations[$num] ?? $yearUltimateInterpretations[1];
}

function getUltimateTitle($n) { return getUltimateInterpretation($n)['title']; }
function getUltimateSubtitle($n) { return getUltimateInterpretation($n)['subtitle']; }
function getUltimateDeed($n) { return getUltimateInterpretation($n)['deed']; }
function getUltimateElement($n) { return getUltimateInterpretation($n)['element']; }
function getUltimatePlanet($n) { return getUltimateInterpretation($n)['planet']; }
function getUltimateArchetype($n) { return getUltimateInterpretation($n)['archetype']; }
function getUltimateMeaning($n) { return getUltimateInterpretation($n)['meaning']; }
function getUltimateTasks($n) { return getUltimateInterpretation($n)['tasks']; }
function getUltimateKarmicLesson($n) { return getUltimateInterpretation($n)['karmic_lesson']; }
function getUltimateChallenges($n) { return getUltimateInterpretation($n)['challenges']; }
function getUltimatePitfalls($n) { return getUltimateInterpretation($n)['pitfalls']; }
function getUltimateCareer($n) { return getUltimateInterpretation($n)['career']; }
function getUltimateBusiness($n) { return getUltimateInterpretation($n)['business']; }
function getUltimateMoney($n) { return getUltimateInterpretation($n)['money']; }
function getUltimateLove($n) { return getUltimateInterpretation($n)['love']; }
function getUltimateFamily($n) { return getUltimateInterpretation($n)['family']; }
function getUltimateFriends($n) { return getUltimateInterpretation($n)['friends']; }
function getUltimateHealth($n) { return getUltimateInterpretation($n)['health']; }
function getUltimateCreativity($n) { return getUltimateInterpretation($n)['creativity']; }
function getUltimateLearning($n) { return getUltimateInterpretation($n)['learning']; }
function getUltimateSpirituality($n) { return getUltimateInterpretation($n)['spirituality']; }
function getUltimateMonth($n, $m) { $data = getUltimateInterpretation($n); return $data['months'][$m] ?? ''; }
function getUltimateQuarter($n, $q) { $data = getUltimateInterpretation($n); return $data['quarters'][$q] ?? ''; }
function getUltimateGoodDays($n) { return getUltimateInterpretation($n)['good_days']; }
function getUltimateBadDays($n) { return getUltimateInterpretation($n)['bad_days']; }
function getUltimateAffirmations($n) { return getUltimateInterpretation($n)['affirmations']; }
function getUltimateRituals($n) { return getUltimateInterpretation($n)['rituals']; }
function getUltimateDailyPractice($n) { return getUltimateInterpretation($n)['daily_practice']; }
function getUltimateMeditation($n) { return getUltimateInterpretation($n)['meditation']; }
function getUltimateJournal($n) { return getUltimateInterpretation($n)['journal']; }
function getUltimateStones($n) { return getUltimateInterpretation($n)['stones']; }
function getUltimateMetals($n) { return getUltimateInterpretation($n)['metals']; }
function getUltimateColors($n) { return getUltimateInterpretation($n)['colors']; }
function getUltimateNumbers($n) { return getUltimateInterpretation($n)['numbers']; }
function getUltimatePlants($n) { return getUltimateInterpretation($n)['plants']; }
function getUltimateAnimals($n) { return getUltimateInterpretation($n)['animals']; }
function getUltimateScents($n) { return getUltimateInterpretation($n)['scents']; }
function getUltimatePartnership($n) { return getUltimateInterpretation($n)['partnership']; }
function getUltimateAvoidPartnership($n) { return getUltimateInterpretation($n)['avoid_partnership']; }
function getUltimateMovies($n) { return getUltimateInterpretation($n)['movies']; }
function getUltimateBooks($n) { return getUltimateInterpretation($n)['books']; }
function getUltimateTravelTips($n) { return getUltimateInterpretation($n)['travel_tips']; }
function getUltimateSummary($n) { return getUltimateInterpretation($n)['summary']; }
function getUltimateChecklist($n) { return getUltimateInterpretation($n)['checklist']; }
?>
function getUltimateMainLesson($n) { return getUltimateInterpretation($n)['main_lesson']; }
