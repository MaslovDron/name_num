<?php
include 'app/include/config.php';
include 'app/include/connect.php';
include 'app/include/functions-front.php';
include 'app/controllers/BlogController.php';

?>
 <!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
//     $seo_title = !empty($meta_title) ? $meta_title : $title;
//    $seo_title = $seo_title . ' | Блог нумеролога';
   if (!empty($meta_title))
        {
            $seo_title=$meta_title.' | калькулятор-судьбы.рф';
        }
    else
        {
            $seo_title=$title.' | калькулятор-судьбы.рф';
        }
   if(empty($meta_description)) {
       $seo_description = mb_substr(strip_tags($description), 0, 155);
   } else {
       $seo_description = $meta_description;
   }
   ?>
   
   <title><?php echo htmlspecialchars($seo_title); ?></title>
   <meta name="description" content="<?php echo htmlspecialchars($seo_description); ?>">
   <meta name="robots" content="index, follow">
   <link rel="canonical" href="<?php echo ABS_PATH . 'article/' . $slug; ?>" />
   
   <!-- Open Graph -->
   <meta property="og:title" content="<?php echo htmlspecialchars($seo_title); ?>" />
   <meta property="og:description" content="<?php echo htmlspecialchars($seo_description); ?>" />
   <meta property="og:type" content="article" />
   <meta property="og:url" content="<?php echo ABS_PATH . 'article/' . $slug; ?>" />
   <meta property="og:image" content="<?php echo ABS_PATH; ?>images/<?php echo $image; ?>" />
   <meta property="og:site_name" content="<?php echo $site_name ?? 'Нумерологический портал'; ?>" />
   <meta property="og:locale" content="ru_RU" />
   
   <!-- Twitter -->
   <meta name="twitter:card" content="summary_large_image" />
   <meta name="twitter:title" content="<?php echo htmlspecialchars($seo_title); ?>" />
   <meta name="twitter:description" content="<?php echo htmlspecialchars($seo_description); ?>" />
   <meta name="twitter:image" content="<?php echo ABS_PATH; ?>images/<?php echo $image; ?>" />
   
   <!-- Дополнительно -->
   <meta name="author" content="Нумеролог" />
   <meta property="article:published_time" content="<?php echo $created_at ?? date('Y-m-d'); ?>" />
    <!-- seo -->

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- font awesome cdn link  -->
   <!-- style-->
    <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/all-style.css">
   <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/article.css">
   <!-- style-->
</head>
<body>
<?php
include 'app/include/header-front.php';
?>
<section class="main">
  
   
    <div class="content">
        <div class="stat-img"><img src="<?php echo ABS_PATH ?>images/<?php echo $image?>" alt="<?php echo $title ?>" srcset=""></div>
         <div class="zagh1"><h1><?php echo $title ?></h1></div>
        <div class="txt"><?php echo $description; ?></div>
    </div>

    
</section>
<?php
 include 'app/include/FooterAll.php';
?>
</body>
</html>
