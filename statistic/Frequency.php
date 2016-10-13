<?php
$frequencia = '';
$qtdIntervalo = array(0,0,0,0,0);
$fac = array();
$fad = array();
$fR = array();
$facR = array(); 
$fadR = array(); 
$totalSum = 0;
$sumTotalUsers = array();

function fac($intervals){
    $intervalo = 0;

    foreach($intervals as $index){
        $intervalo += $index;
        $fac[] = $intervalo;
    }
    return $fac;
}

function fad($intervals, $max){
    $intervalo = $max;

    foreach($intervals as $index){
      $fad[] = $intervalo;
      $intervalo -= $index;
   }
   return $fad;
}

for($i = 1; $i < 16; $i++){
    $sql = "SELECT sum(tempo) as tempo FROM tb_tempo_digitacao as t JOIN tb_usuario as u ON";
    $sql .=" t.id_usuario = u.id_usuario WHERE id_tentativa = '$i' GROUP BY t.id_usuario";
    $result = mysqli_query($db, $sql) or die(mysqli_error($db));

    while($row = mysqli_fetch_array($result)) {  
         $sumF = $row['tempo'];

         if($sumF >= 0 and $sumF <= 1){
                $qtdIntervalo[0]++;
         } elseif($sumF > 1 and $sumF <= 1.5){
                $qtdIntervalo[1]++;
         } else if($sumF > 1.5 and $sumF <= 2){
                $qtdIntervalo[2]++;
         } elseif($sumF > 2 and $sumF <= 2.5){
                $qtdIntervalo[3]++;
         } elseif($sumF > 3 and $sumF <= 3.5){
                $qtdIntervalo[4]++;
        }
        $sumTotalUsers[] = $sumF; 
    }
}
                    $fac = fac($qtdIntervalo);
                    $fad = fad($qtdIntervalo, $fac[4]);                    

                    foreach($qtdIntervalo as $index){                        
                        $fR[] = ($index/$fac[4]) * 100;
                    } 

                    $facR = fac($fR);
                    $fadR = fad($fR, $facR[4]);

                   $frequencia .= "<tr><th scope='row'>0 &nbsp;|&mdash;&mdash;|&nbsp; 1</th><td>" .$qtdIntervalo[0]."</td><td>".$fac[0]."</td>";
                   $frequencia .= "<td>".$fad[0]."</td><td>".round($fR[0],4)."</td><td>".round($facR[0],4)."</td><td>".round($fadR[0],4)."</td></tr>";
                   $frequencia .= "<th scope='row'>1 &nbsp;|&mdash;&mdash;|&nbsp; 2</th><td>" .$qtdIntervalo[1]."</td><td>".$fac[1]."</td>";
                   $frequencia .= "<td>".$fad[1]."</td><td>".round($fR[1],4)."</td><td>".round($facR[1],4)."</td><td>".round($fadR[1],4)."</td></tr>";
                   $frequencia .= "<th scope='row'>2 &nbsp;|&mdash;&mdash;|&nbsp; 3</th><td>" .$qtdIntervalo[2]."</td><td>".$fac[2]."</td>";
                   $frequencia .= "<td>".$fad[2]."</td><td>".round($fR[2],4)."</td><td>".round($facR[2],4)."</td><td>".round($fadR[2],4)."</td></tr>";
                   $frequencia .= "<th scope='row'>3 &nbsp;|&mdash;&mdash;|&nbsp; 4</th><td>" .$qtdIntervalo[3]."</td><td>".$fac[3]."</td>";
                   $frequencia .= "<td>".$fad[3]."</td><td>".round($fR[3],4)."</td><td>".round($facR[3],4)."</td><td>".round($fadR[3],4)."</td></tr>";
                   $frequencia .= "<th scope='row'>4 &nbsp;|&mdash;&mdash;|&nbsp;   5</th><td>" .$qtdIntervalo[4]."</td><td>".$fac[4]."</td>";
                   $frequencia .= "<td>".$fad[4]."</td><td>".round($fR[4],4)."</td><td>".round($facR[4],4)."</td><td>".round($fadR[4],4)."</td></tr>";

?>