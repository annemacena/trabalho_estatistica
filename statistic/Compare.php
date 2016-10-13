<?php

include("../login/Config.php");

   if(!isset($_SESSION))
    session_start();

	$id_user =  $_SESSION['idUser']; 

	if(!isset($_SESSION['idUser'])){
      header("location:index.php");
   }

include("Attempts.php");

$password = $_POST['password'];
$soma = $_POST['soma'];
  
$sql = "SELECT id_usuario FROM tb_usuario WHERE id_usuario = '$id_user' and password = '$password'";
			$result = mysqli_query($db, $sql) or die(mysqli_error($db));
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
			$count = mysqli_num_rows($result);
					
			if($count == 1) {					
				if($soma >= min($sumAttempts) and $soma <= max($sumAttempts)){
					echo "201";
				} else {
					echo "400";
				}

			}else {
                echo "404";
			}
?>