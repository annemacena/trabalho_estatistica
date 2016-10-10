<?php      
$media = '';
$var = 0;
 for($i = 1; $i < 16; $i++){
        $sql = "SELECT tempo FROM tb_tempo_digitacao WHERE id_tentativa = '$i'";
            $result = mysqli_query($db, $sql) or die(mysqli_error($db));
                if (mysqli_num_rows($result) > 0) {
                    $sum = 0;
                   // $array = [];
                    $j = 0;
                    $j2 = 0;
                    while($row = mysqli_fetch_array($result)) {     

                        if($j == 5){
                           $j=0;

                           //array_push($array, $sum); //tamanho do array depende da qtd de users

                           $j++;

                           $j2++;
                        } else {
                            
                            $j++;                          
                        }  

                        $sum .= $row["tempo"];
                    }
                           // foreach ($array as $index) {
                           //      $var .= pow($index - $sum, 2);
                          //  }

                     $media .= "<tr><th scope='row'>$i</th><td>" .$sum."s</td></tr>";
                     //$media .= "<tr><th scope='row'>$i</th><td>" .($var/$j2)."s</td></tr>";

                } else {
                    echo "Ocorreu um erro.";
                }  
    } 
?>
<?php
             echo "<div><table class='table'><thead><tr>";
                       echo  "<th>Tentativas</th>";
                       echo  "<th>Média</th>";
                       echo  "<th>Variância</th>";
                       echo  "</tr></thead><tbody>";
                       echo $media;
                       echo "</tbody></table>";
        ?>