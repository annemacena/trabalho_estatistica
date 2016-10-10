<?php      
$media = ''; //média
$var = 0; //variância
$sum = 0; //variável auxiliar pra soma
$sumAttempts = []; //array de soma de tentativas
$j = 0; //indice pra verificar quando muda de tentativa

 $sql = "SELECT tempo FROM tb_tempo_digitacao WHERE id_usuario = '$id_user';";
            $result = mysqli_query($db, $sql) or die(mysqli_error($db));
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_array($result)) {     

                        if($j == 5){
                           $j=0;

                          array_push($sumAttempts, $sum); //tamanho do array depende da qtd de tentativas

                           $j++;
                        } else {                            
                            $j++;                          
                        }  

                        $sum += $row["tempo"];
                    }

                    $sum = $sum/15;

                            foreach ($sumAttempts as $index) {
                                 $var += pow($index - $sum, 2);
                            }

                     $var = $var/15;    

                     $media .= "<tr><td>" .$sum."</td>";
                     $media .= "<td>" .$var."</td>";
                     $media .= "<td>" .sqrt($var)."</td></tr>";

                } else {
                    echo mysqli_error($db);
                }  
?>
<?php
             echo "<div><table class='table'><thead><tr>";
                       echo  "<th>Média</th>";
                       echo  "<th>Variância</th>";
                       echo  "<th>Desvio Padrão</th>";
                       echo  "</tr></thead><tbody>";
                       echo $media;
                       echo "</tbody></table>";
        ?>