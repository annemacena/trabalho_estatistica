<?php
   if(!isset($_SESSION))
    session_start();

    $login_session = $_SESSION['loggedUser'];
    $id_user =  $_SESSION['idUser']; 

   if(!isset($_SESSION['loggedUser'])){
      header("location:index.php");
   }

include("login/Config.php");
include("statistic/Attempts.php");
include("statistic/Calculus.php");
include("statistic/Frequency.php");
include("statistic/Probability.php");
?>
<!--
 * Kestroke Boladão;
 *
 * 2016, Universidade Federal de Sergipe - UFS
 * Arianne, Jusley, Lawrence, Micael.
 *
 * Enjoy.
-->
<html>   
   <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="assets/img/icon.png" >
        <title>Trabalho de Estatística</title>

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/toastr/toastr.min.css">
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="assets/js/loader.js"></script>
        <script src="assets/js/scripts.js"></script>
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
            <button type="submit" name="link" value="1" class="btn">Tentativas</button>
            <button type="submit" name="link" value ="2" class="btn">Estatísticas Pessoais</button>            
            <button type="submit" name="link" value ="3" class="btn">Estatísticas Gerais</button>
            <button type="submit" name="link" value ="4" class="btn">Probabilidade</button>
		</form>    
    </div>

        <?php
            if(!isset($_GET['link'])){ 
                $link = 1; 
            } else { 
                $link = $_GET['link']; 
            }

            if ($link == 1) {
                       echo "<div>";
                       echo $saida;
            } elseif ($link == 2) {
                       echo "<p>* Resultados gerados à partir dos dados de todas as tentativas do <strong>usuário logado</strong>.</p><br>";
                       echo "<div class='table-responsive'><table class='table'><thead><tr>";
                       echo  "<th>Média</th>";                       
                       echo  "<th>Mediana</th>";
                       echo  "<th>Variância</th>";
                       echo  "<th>Desvio Padrão</th>";
                       echo  "<th>CV</th>";
                       echo  "</tr></thead><tbody>";
                       echo $media;
                       echo "</tbody></table>";
            } elseif ($link == 3) {  
                       echo "<p>* Tempo total de digitação da senha dentro das 15 tentativas de <strong>todos</strong> os usuários cadastrados.</p><br>";
                       echo "<div class='table-responsive'><table class='table'><thead><tr>";
                       echo  "<th>Tempo em segundos</th>";                       
                       echo  "<th>Fi</th>";
                       echo  "<th>Fac</th>";
                       echo  "<th>Fad</th>";
                       echo  "<th>Fi(%)</th>";
                       echo  "<th>Fac(%)</th>";
                       echo  "<th>Fad(%)</th>";
                       echo  "</tr></thead><tbody>";
                       echo $frequencia;
                       echo "</tbody></table>";
                       echo "<p><strong>Ponto médio: </strong>".round(((max($sumTotalUsers) + min($sumTotalUsers))/2),4);
                       echo "<strong style='margin-left: 5%;'>Amplitude: </strong>".round((max($sumTotalUsers) - min($sumTotalUsers)), 4)."</p>";

                       echo "<script>showQuartis();showPie()</script>";
                       echo "<div id='quartis' class='col-md-6'></div>";
                       echo "<div id='pie' class='col-md-6'></div>";    
            } else {
                echo  $saidaP;
            } 
        ?>

        <script src="assets/bootstrap/js/bootstrap.min.js"></script>         
   </body>   
</html>