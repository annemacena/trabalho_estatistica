<?php
include("Config.php");
    
   if(!isset($_SESSION))
    session_start();

	$id_user =  $_SESSION['idUser']; 

	if(!isset($_SESSION['idUser'])){
      header("location:index.php");
   }

	$data = $_POST['dados'];
	$things = '';
				$sql = "UPDATE tb_usuario SET hasSimulated = 1 WHERE id_usuario = '$id_user';";
				mysqli_query($db,$sql);

				$sql = '';
				for ($row = 1; $row < 15; $row++) {
					for ($col = 0; $col < 5; $col++) {
						$time = $data[$row][$col];
						$sql .= "INSERT INTO tb_tempo_digitacao(tempo, id_tentativa, id_usuario) VALUES ('$time', '$i', '$id_user');";												
					}
					$i++;	
									
				}
				mysqli_multi_query($db,$sql);
			
?>
