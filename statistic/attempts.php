<?php  
$saida='';
$sql = "SELECT id_tentativa, tempo FROM tb_tempo_digitacao WHERE id_usuario = '$id_user' ORDER BY id_tentativa";
            $result = mysqli_query($db, $sql) or die(mysqli_error($db));
                if (mysqli_num_rows($result) > 0) { 
                    $i = 6;
                    $j = 0;
                    $summ = 0;
                    while($row = mysqli_fetch_assoc($result)) {                      
                            if($i == 6){
                                if($j == 1) {
                                   $saida .= "<tr><th scope='row'>Total</th><td>" . $summ."</td></tr>"; 
                                   $saida .= "</tbody></table></div></div>";
                                }
                                $i = 1;
                                $j = 1;
                                $summ = 0;

                                $saida .= "<div class='col-md-3'>";
                                $saida .= "<div class='panel panel-default'>";
                                $saida .= "<div class='panel-heading'>Tentativa ".$row["id_tentativa"]."</div>";
                                $saida .= "<table class='table'><thead><tr>";
                                $saida .= "<th>Qtd.</th>";
                                $saida .= "<th>Tempo</th>";
                                $saida .= "</tr></thead><tbody>";
                            } else {
                                $saida .= "<tr><th scope='row'>$i</th><td>" . $row["tempo"]."</td></tr>";
                                $summ += $row["tempo"];
                            }  
                         $i++;                     
                    }
                } else {
                    echo "Ocorreu um erro.";
                }  

                        $saida .= "<tr><th scope='row'>Total</th><td>" . $summ."</td></tr>"; 
                        $saida .= "</tbody></table></div></div>";
                        echo "<div>";
                        echo $saida;
                    ?>
        