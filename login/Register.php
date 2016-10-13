<?php  
include("Config.php");
		   	
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sex = $_POST['sex'];

			$sql = "SELECT id_usuario FROM tb_usuario WHERE username = '$username'";
			$result = mysqli_query($db, $sql) or die(mysqli_error($db));			
			$count = mysqli_num_rows($result);
					
			if($count == 1) {
			   echo "400";               
			}else {			
				$sql = "INSERT INTO tb_usuario (username, password, sex, hasSimulated, failedLogin) VALUES 
				('$username', '$password', '$sex' , 0, null)";
				mysqli_query($db,$sql) or die(mysqli_error($db));
			}    
 ?>