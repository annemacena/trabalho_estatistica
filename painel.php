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
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $login_session; ?></h1> 
      <h2><a href = "login/Logout.php">Sign Out</a></h2>

      <?php
      
      $sql = "SELECT id_tentativa, tempo FROM tb_tempo_digitacao WHERE id_usuario = '$id_user' ORDER BY id_tentativa";
			$result = mysqli_query($db, $sql) or die(mysqli_error($db));
			if (mysqli_num_rows($result) > 0) {
                 $i = 6;
                while($row = mysqli_fetch_assoc($result)) {
                    $attempt = $row["id_tentativa"];                   

                    if($i == 6){
                        $i = 1;
                       
                        echo "<h3>Tentativa ".$row["id_tentativa"]."</h3><br>";
                        echo "Tempo: " . $row["tempo"]."s <br>";
                        $i++;
                    } else {
                        echo "Tempo: " . $row["tempo"]."s <br>";
                        $i++;
                    }
                }
            } else {
                echo "0 results";
            }    

            mysqli_close($db);   
       ?>

   </body>
   
</html>