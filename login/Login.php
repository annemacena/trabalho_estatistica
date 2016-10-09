<?php
include("Config.php");

            $username = $_POST['username'];
			$password = $_POST['password']; 
            $attempts = $_POST['attempt'];

			$sql = "SELECT id_usuario, hasSimulated FROM tb_usuario WHERE username = '$username' and password = '$password'";
			$result = mysqli_query($db, $sql) or die(mysqli_error($db));
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
			$count = mysqli_num_rows($result);
					
			if($count == 1) {	
				$hasSimulated = $row['hasSimulated'];
					if($hasSimulated == 0){
						if($attempts == 14){
							if(!isset($_SESSION))
								session_start();	
								
							$_SESSION['loggedUser'] = $username;
							$_SESSION['idUser'] = $row['id_usuario'];					
							echo "201";
						} else {
							$attempts++;
							echo $attempts;
						}
					} else {
						if(!isset($_SESSION))
							session_start();	

						$_SESSION['loggedUser'] = $username;
						$_SESSION['idUser'] = $row['id_usuario'];					
						echo "200";
					}												               
			}else {
                echo "404";
				//echo "<script> window.onload = function(){showToastr('error', 'Dados Incorretos!');} </script>";
			}
?>