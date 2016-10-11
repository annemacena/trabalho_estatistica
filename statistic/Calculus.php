<?php      
$media = ''; //média
$var = 0; //variância
$sum = 0; //variável auxiliar pra soma total
$sumParcial = 0; //variável auxiliar pra soma
$sumAttempts = array(); //array de soma de tentativas
$j = 0; //variavel auxiliar
$cv = 0; //coeficiente de variância
$cvD = '';//descrição coeficiente de variância

 $sql = "SELECT tempo FROM tb_tempo_digitacao WHERE id_usuario = '$id_user';";
            $result = mysqli_query($db, $sql) or die(mysqli_error($db));
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_array($result)) {     

                        if($j == 5){
                           $j=0;
                           
                          $sumAttempts[] = $sumParcial;
                          $sumParcial = 0;

                           $j++;
                        } else {                            
                            $j++;                          
                        }  

                        $sumParcial += $row["tempo"];
                        $sum += $row["tempo"];
                    }

                    $sum = $sum/15;

                            foreach ($sumAttempts as $index) {
                                 $var += pow($index - $sum, 2);
                            }

                     $var = $var/15; 
                     $cv =  (sqrt($var)/$sum) * 100;

                     if($cv <= 15)
                        $cvD = '% (Baixa Dispersão)';
                     else if ($cv > 15 and $cv <= 30)
                        $cvD = '% (Média Dispersão)';
                     else
                         $cvD = '% (Alta Dispersão)';

                     $media .= "<tr><td>" .$sum."</td>";
                     $media .= "<td>" .$sumAttempts[6]."</td>";
                     $media .= "<td>" .$var."</td>";
                     $media .= "<td>" .sqrt($var)."</td>";
                     $media .= "<td>" .$cv.' '.$cvD."</td></tr>";

                } else {
                    echo mysqli_error($db);
                }  
?>
<?php
             echo "<div><table class='table'><thead><tr>";
                       echo  "<th>Média</th>";                       
                       echo  "<th>Mediana</th>";
                       echo  "<th>Variância</th>";
                       echo  "<th>Desvio Padrão</th>";
                       echo  "<th>CV</th>";
                       echo  "</tr></thead><tbody>";
                       echo $media;
                       echo "</tbody></table>";

                       print_r($sumAttempts);
        ?>