<?
include 'app/include/config.php';
include 'app/include/connect.php';
include 'app/include/functions-front.php';
//include 'app/controllers/BlogController.php';
//вытаскиваем количество записей из таблицы
$count=countArticles('articles', 1);
//tt($_GET);
//вытаскиваем количество записей из таблицы
//$ROWSINPAGE=1;
$page = $_GET['page'] ?? 0;
$page=(int)$page;
 $total_pages=ceil($count/$ROWSINPAGE);//считаем общее количество страниц
  if(!isset($page) or ($page<1))
 {
   $page=1;
 }
 $offset=$ROWSINPAGE*($page-1);
 $articles=selectArticlesPages('articles', 'ORDER BY created_at DESC', $ROWSINPAGE, $offset, 1);
 ////////////
 if ($page > $total_pages && $total_pages > 0) {
    //header('Location: ' . ABS_PATH . 'blog/page/' . $total_pages);
    echo 'Такой страницы нет. <a href="'.ABS_PATH.'">Перейти на главную</a>';
    exit;
}
 // Если запрошена страница > 1, но нет статей - редирект на первую страницу
if ($page > 1 && $count == 0) {
    //header('Location: ' . ABS_PATH . 'blog/');
    echo 'Такой страницы нет. <a href="'.ABS_PATH.'">Перейти на главную</a>';   
    exit;
}
if (empty($articles) && $page > 1) {
    //header('Location: ' . ABS_PATH . 'blog);
    echo 'Такой страницы нет. <a href="'.ABS_PATH.'">Перейти на главную</a>';
    exit;
}
 ////////////
 
 //tt($articles);
?>
 <!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- /////////////////////////////////////////////// -->
    <?php
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page_suffix = ($current_page > 1) ? ' - Страница ' . $current_page : '';

// Базовое название сайта (можно вынести в config.php)
$site_name = $site_url; // Замените на реальное

// --- Заголовок страницы (Title) ---
// Важно: уникальный для каждой страницы пагинации
$page_title = "Блог по нумерологии: статьи о матрице судьбы и психоматрице" . $page_suffix;
?>

<!-- Основные SEO мета-теги -->
<title><?php echo htmlspecialchars($page_title); ?></title>
<meta name="description" content="Полезные статьи о нумерологии, матрице судьбы, психоматрице Пифагора. Расшифровка чисел, анализ характера, совместимости и предназначения<?php echo ($current_page > 1 ? '. Страница ' . $current_page : ''); ?>">
<!-- Роботы: индексировать и следовать по ссылкам -->
<meta name="robots" content="index, follow">

<!-- Canonical ссылка (указывает основную страницу, чтобы избежать дублей при пагинации) -->
<link rel="canonical" href="<?php echo ABS_PATH . ($current_page > 1 ? 'blog/page/' . $current_page : 'blog'); ?>" />

<!-- Open Graph для соцсетей (Facebook, VK, Telegram) -->
<meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>" />
<meta property="og:description" content="Статьи о нумерологии, матрице судьбы и психоматрице Пифагора" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo ABS_PATH . ($current_page > 1 ? 'blog/page/' . $current_page : 'blog'); ?>" />
<meta property="og:image" content="<?php echo ABS_PATH; ?>assets/images/og-blog-image.jpg" /> <!-- Создайте такое изображение -->
<meta property="og:site_name" content="<?php echo $site_name; ?>" />
<meta property="og:locale" content="ru_RU" />

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?php echo htmlspecialchars($page_title); ?>" />
<meta name="twitter:description" content="Статьи о нумерологии, матрице судьбы и психоматрице Пифагора" />
<meta name="twitter:image" content="<?php echo ABS_PATH; ?>assets/images/og-blog-image.jpg" />

<!-- Дополнительный тег для автора -->
<meta name="author" content="Нумеролог" />
    <!-- ///////////////////////////////////////////// -->

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- font awesome cdn link  -->
   <!-- style-->
   <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/all-style.css">
   <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/blog.css">
   <!-- style-->
</head>
<body>
<?php
include 'app/include/header-front.php';
?>
<section class="main">
    <div class="zagh1"><h1>Блог</h1></div>
    <div class="statii-all">
      <?php
        foreach($articles as $article)
         {
          ?>
          <div class="article">
                        <div class="article-img">
                            <img src="<?php echo ABS_PATH; ?>images/<?php echo $article['image'];?>" alt="">
                        </div>
                        <div class="article-text">
                            <div class="article-zag">
                               <a href="<?php echo ABS_PATH.'article/'.$article['slug']?>"><?php echo $article['title'];?></a>
                            </div>
                            <div class="article-txt">
                                <?php echo Anons($article['content'], $length = 300, $ending = '...')?>
                                <!-- <?php echo $article['content']; ?> -->
                            </div>
                            <div class="article-href">
                               <a href="<?php echo ABS_PATH.'article/'.$article['slug']?>">Подробнее</a> 
                          </div>                          
                        </div>
                    </div>
    <?php
         }
      ?>
    </div>
    <!-- постраничка -->
    <div class="pagin">
   <ul>
    <?php
    $url=ABS_PATH.'blog/page/';
    //if(($page!=2) && ($page!=1))
    if(($page>1))

    {
        ?>
   <li class="page-item">
    <a class="page-link" href="<?php echo $url.($page-1);?>"><</a>
</li>
<?php
    }
    ?>


    <?php
    if($page>2)
{
    ?>
   <li class="page-item">
    <a class="page-link" href="<?php echo $url.($page-2);?>"><?=($page-2)?></a>
</li>
    <?php
}
?>
    <?php
    if($page>1)
{
    ?>
   <li class="page-item">
    <a class="page-link" href="<?php echo $url.($page-1);?>"><?=($page-1)?></a>
</li>
    <?php
}
?>

<li class="page-active" aria-current="page">
      <span class="page-link"><?=$page;?></span>
    </li>

    <?php
if($page<$total_pages)
{
    ?>
   <li class="page-item">
    <a class="page-link" href="<?php echo $url.($page+1);?>"><?=($page+1)?></a>
</li>
    <?php
}
?>

<?php
if($page<$total_pages-1)
{
    ?>
   <li class="page-item">
    <a class="page-link" href="<?php echo $url.($page+2);?>"><?=($page+2)?></a>
</li>
    <?php
}
?>

    <?php
    //if(($page!=$total_pages) && (($page+1)!=$total_pages) && (($page+2)!=$total_pages))
    if(($page)<$total_pages)
    {
        ?>
<li class="page-item">
<a class="page-link" href="<?php echo $url.($page+1);?>">></a>
</li>
<?php
    }
    ?>
</ul>
</div>
<!-- постраничка  -->
</section>
<?php
 include 'app/include/FooterAll.php';
?>
</body>
</html>
