<?php      
$media = ''; //média
$var = 0; //variância
$cv = 0; //coeficiente de variância
$cvD = '';//descrição coeficiente de variância

                     $sum = $sum/$totalAttempts;

                            foreach ($sumAttempts as $index) {
                                 $var += pow($index - $sum, 2);
                            }

                     $var = $var/$totalAttempts; 
                     $cv =  (sqrt($var)/$sum) * 100;

                     if($cv <= 15)
                        $cvD = '% (Baixa Dispersão)';
                     else if ($cv > 15 and $cv <= 30)
                        $cvD = '% (Média Dispersão)';
                     else
                         $cvD = '% (Alta Dispersão)';

                     $media .= "<tr><td>" .round($sum, 6)."</td>";
                     $media .= "<td>" .round($sumAttempts[7], 6)."</td>";
                     $media .= "<td>" .round($var,6)."</td>";
                     $media .= "<td>" .round(sqrt($var),6)."</td>";
                     $media .= "<td>" .round($cv,6).' '.$cvD."</td></tr>"; 
?>