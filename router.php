<?php
// Получаем чистый путь без /numerolog/ и слешей по краям
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim(str_replace('/numerolog/', '', $requestUri), '/');

// Если путь пустой (зашли на /numerolog/) — редиректим на /numerolog/home
if (empty($path)) {
    http_response_code(301);
    header('Location: /numerolog/home');
    exit;
}

// ========== ОБРАБОТКА БЛОГА С ПОСТРАНИЧНОЙ НАВИГАЦИЕЙ ==========
if (preg_match('#^blog(?:/page/(\d+))?/?$#i', $path, $matches)) {
    $page = isset($matches[1]) ? (int)$matches[1] : 1;
    if ($page < 1) $page = 1;
    $_GET['page'] = $page;
    require __DIR__ . '/blog.php';
    exit;
}

// ========== ОБРАБОТКА ОТДЕЛЬНОЙ СТАТЬИ ==========
// Обрабатывает: /article/slug-статьи, /article/slug-статьи/
if (preg_match('#^article/([a-z0-9\-]+)/?$#i', $path, $matches)) {
    $slug = $matches[1]; // Получаем slug статьи
    $_GET['slug'] = $slug; // Передаем в GET для совместимости
    
    // Подключаем файл для отображения статьи
    require __DIR__ . '/article.php'; // Создашь этот файл
    exit;
}

// ========== МАРШРУТИЗАЦИЯ ДЛЯ ОСТАЛЬНЫХ СТРАНИЦ ==========
switch ($path) {
    case ''://главная
    case 'home'://главная
        require __DIR__ . '/home.php';
        break;

    case 'calculation'://расчеты
        require __DIR__ . '/calculators.php';  
        break;
        /////таблица пифагора
    case 'pifagor-form'://матрица пифагора форма
        require __DIR__ . '/pifagor-form.php';  
        break;
    case 'pifagor'://матрица пифагора вывод резултата
        require __DIR__ . '/pifagor-result.php';  
        break;
        /////таблица пифагора
        /////имя
    case 'name-form'://имя форма
        require __DIR__ . '/name-form.php';  
        break;
    case 'name'://имя вывод резултата
        require __DIR__ . '/name-result.php';  
        break;
        /////имя
                /////совместимость имя
    case 'sovmest-form'://совместимость имя форма
        require __DIR__ . '/sovmest-form.php';  
        break;
    case 'sovmest'://совместимость имя вывод резултата
        require __DIR__ . '/sovmest-result.php';  
        break;
        /////совместимость имя
    

    default:
        http_response_code(404);
        echo '<h1>404: Страница не найдена</h1>';
        exit;
}

exit;
?>
