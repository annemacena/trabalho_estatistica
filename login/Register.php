<?php  
	   if(isset($_POST["register"])) {
		   	
			$username = mysqli_real_escape_string($db,$_POST['username']);
			$password = mysqli_real_escape_string($db,$_POST['password']); 

			$sql = "SELECT id_usuario FROM tb_usuario WHERE username = '$username'";
			$result = mysqli_query($db, $sql) or die(mysqli_error($db));
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
			$count = mysqli_num_rows($result);
					
			if($count == 1) {
			   echo "<script> window.onload = function(){toastr.error('Opa, usuário já cadastradx!');} </script>";               
			}else {			
				$sql = "INSERT INTO tb_usuario (username, password, hasSimulated) VALUES ('$username', '$password', 0)";
				$result = mysqli_query($db,$sql) or die(mysqli_error($db));
						
				if($result) {				
					echo "<script> window.onload = function(){toastr.success('Registradx com sucesso!');} </script>";
				}else {
					echo "<script> window.onload = function(){toastr.error('Ocorreu um erro.'); </script>";
				}
			}
    	}    
 ?>