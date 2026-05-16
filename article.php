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
   <title><?php echo $meta_title ?></title>
   <?php
   if(empty($meta_description))
    {
        ?>
        <meta name="description" content="<?php echo $meta_description ?>" />
        <?php
    }
   ?>

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
</html>art
