<?php
include("Config.php");
    
   if(!isset($_SESSION))
    session_start();

	$id_user =  $_SESSION['idUser']; 

	if(!isset($_SESSION['idUser'])){
      header("location:index.php");
   }

	$data = $_POST['dados'];
	$errors = $_POST['errors'];
	$things = '';
				$sql = "UPDATE tb_usuario SET hasSimulated = 1, failedLogin = '$errors' WHERE id_usuario = '$id_user';";
				mysqli_query($db,$sql) or die(mysqli_error($db));

				$sql = '';
				$i = 1;
				for ($row = 0; $row < 15; $row++) {
					for ($col = 0; $col < 5; $col++) {
						$time = $data[$row][$col];
						$sql .= "INSERT INTO tb_tempo_digitacao(tempo, id_tentativa, id_usuario) VALUES ('$time', '$i', '$id_user');";												
					}
					$i++;	
									
				}
				$result = mysqli_multi_query($db,$sql) or die(mysqli_error($db));

				if($result){
					echo mysqli_error($db);
				}	else {
					echo ":)";
				}	
?>
