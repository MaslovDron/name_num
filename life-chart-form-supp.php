<?php
include '../app/include/config.php';
include '../app/include/connect.php';
include '../app/include/functions-adm.php';
include '../app/controllers/LifeController.php';
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
   <title>Линия жизни</title>

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
<section class="content">
    <div class="add-statii">
        <p><?php
                echo $errMsg;
            ?></p>
        <form action="" method="post">
            <label for="daterozd">Дата рождения</label>
            <input type="date" name="daterozd" id="daterozd" class="form-input" value="<?= $birthDate; ?>">
            <!-- <input type="month" name="intMon" id="intMon" class="form-input" value="<?= $targetMonth; ?>"> -->
             <select name="period" id="period" class="form-input">
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
                 <option value="5">5</option>
                 <option value="6">6</option>
             </select>
            
            <input type="submit" value="Рассчитать" name="BackLifeCalc" class="btn1">
        </form>
    </div>
</section>
</body>
</html>
