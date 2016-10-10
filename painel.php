<?php
   if(!isset($_SESSION))
    session_start();

    $login_session = $_SESSION['loggedUser'];
    $id_user =  $_SESSION['idUser']; 

   if(!isset($_SESSION['loggedUser'])){
      header("location:index.php");
   }

include("login/Config.php");
?>
<html>   
   <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trabalho de Estatística</title>

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/toastr/toastr.min.css">
   </head>   
   <body>
    <div class="header">
        <div class="col-md-6">
            <h1>Olá, <?php echo $login_session; ?>!</h1> 
        </div>
        <div class="col-md-6">
            <h2><a href = "login/Logout.php"><i class="fa fa-sign-out" aria-hidden="true">Sair</i></a></h2>
        </div>  
    </div>
    <div>
            <form role="form" action="" method="get" class="registration-form">
            <button type="submit" name="link" value="2" class="btn">Tentativas</button>
            <button type="submit" name="link" value ="1" class="btn">Estatística</button>
            <button type="submit" name="link" value ="5" class="btn">#</button>
            <button type="submit" name="link" value ="5" class="btn">#</button>
            <button type="submit" name="link" value ="5" class="btn">#</button>
            <button type="submit" name="link" value ="5" class="btn">#</button>
		</form>    
    </div>

        <?php
            if(!isset($_GET['link'])){ 
                $link = 1; 
            } else { 
                $link = $_GET['link']; 
            }

            if ($link == 1) {
                include("statistic/Calculus.php");
            } elseif ($link == 2) {
                include("statistic/attempts.php");
            } else {
                echo "<p>Reservado :3</p>";
            } 
        ?>

        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   </body>   
</html>