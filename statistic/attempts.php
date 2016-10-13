<?php  
$sumParcial = 0; //variável auxiliar pra soma
$sumAttempts = array();  //array de soma de tentativas
$sum = 0;//total de somas
$totalAttempts = 15; //total de tentativas
$saida="<p>* Tempo de digitação de cada letra.</p><br>";
$sql = "SELECT id_tentativa, tempo FROM tb_tempo_digitacao WHERE id_usuario = '$id_user' ORDER BY id_tentativa";
            $result = mysqli_query($db, $sql) or die(mysqli_error($db));
                if (mysqli_num_rows($result) > 0) { 
                    $i = 6;
                    $j = 0;                    
                    while($row = mysqli_fetch_assoc($result)) {                      
                            if($i == 6){
                                if($j == 1) {
                                   $sum += $sumParcial;
                                   $sumAttempts[] = $sumParcial;
                                   $saida .= "<tr><th scope='row'>Total</th><td>" . round($sumParcial, 6)."</td></tr>"; 
                                   $saida .= "</tbody></table></div></div>";
                                }
                                $i = 1;
                                $j = 1;
                                $sumParcial = 0;

                                $saida .= "<div class='col-md-3'>";
                                $saida .= "<div class='panel panel-default'>";
                                $saida .= "<div class='panel-heading'>Tentativa ".$row["id_tentativa"]."</div>";
                                $saida .= "<table class='table'><thead><tr>";
                                $saida .= "<th>Qtd.</th>";
                                $saida .= "<th>Tempo</th>";
                                $saida .= "</tr></thead><tbody>";
                            } else {
                                $saida .= "<tr><th scope='row'>$i</th><td>" . round($row["tempo"], 6)."</td></tr>";
                                $sumParcial += $row["tempo"];
                            }  
                         $i++;                     
                    }
                } else {
                    echo "Ocorreu um erro.";
                }  

                        $sum += $sumParcial;
                        $sumAttempts[] = $sumParcial;
                        $saida .= "<tr><th scope='row'>Total</th><td>" . $sumParcial."</td></tr>"; 
                        $saida .= "</tbody></table></div></div>";
                    ?>
        