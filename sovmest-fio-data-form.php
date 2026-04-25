<?php
include '../app/include/config.php';
include '../app/include/connect.php';
include '../app/include/functions-adm.php';
include '../app/controllers/SovmestController.php';
// Проверяем, активна ли сессия вообще
if (empty($_SESSION['id_num'])) {
    header('Location: ' . ABS_PATH . 'supp/index.php');
    exit; // Важно добавить exit после header!
}
// Проверяем, активна ли сессия вообще
$id=$_SESSION['id_num'];
// if(!isset($id)){
//     header('location:index.php');
//     exit();
//  }
 ?>
  <!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Цифровой код имени</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- font awesome cdn link  -->
   <!-- style-->
   <link rel="stylesheet" href="<?=ABS_PATH?>assets/css/adm-style.css">
   <!-- style-->
</head>
<body>
<?php
//tt($_SESSION);
include '../app/include/admin-header.php';
?>
</body>
<section class="content">
    <div class="add-statii">
        <p>
            <?php
                echo $errMsg;
            ?>
        </p>
        <form action="" method="post">
            <div class="partn1">
                <h3 class="sovm">1-ый партнер</h3>
            <label for="imya1">Имя 1-го партнера</label>
            <input type="text" name="imya1" id="imya1" class="form-input" value="<?php echo $imya1;?>">
            <label for="otchestvo1">Отчество 1-го партнера</label>
            <input type="text" name="otchestvo1" id="otchestvo1" class="form-input" value="<?php echo $otchestvo1;?>">
            <label for="familia1">Фамилия 1-го партнера</label>
            <input type="text" name="familia1" id="familia1" class="form-input" value="<?php echo $familia1;?>">
            <label for="date1">Дата рождения 1-го партнера</label>
            <input type="date" name="date1" id="date1" class="form-input" value="<?php echo $date1;?>">
            </div>
            <div class="partn2">
                <h3 class="sovm">2-ой партнер</h3>
            <label for="imya2">Имя 2-го партнера</label>
            <input type="text" name="imya2" id="imya2" class="form-input" value="<?php echo $imya2;?>">
            <label for="otchestvo2">Отчество 2-го партнера</label>
            <input type="text" name="otchestvo2" id="otchestvo2" class="form-input" value="<?php echo $otchestvo2;?>">
            <label for="familia2">Фамилия 2-го партнера</label>
            <input type="text" name="familia2" id="familia2" class="form-input" value="<?php echo $familia2;?>">
            <label for="date2">Дата рождения 2-го партнера</label>
            <input type="date" name="date2" id="date2" class="form-input" value="<?php echo $date2;?>">    
        </div>
            
            <input type="submit" value="Рассчитать" name="submitSovmDataBack" class="btn1">
        </form>
    </div>
</section>
</body>
</html>
