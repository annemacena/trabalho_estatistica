<?php
include("../login/Config.php");
// Estrutura básica do gráfico
$grafico = array(
    'dados' => array(
        'cols' => array(
            array('type' => 'string', 'label' => 'Tentativa'),
            array('type' => 'number', 'label' => 'Tempo'),
            array('type' => 'number', 'label' => 'Tempo'),
            array('type' => 'number', 'label' => 'Tempo'),
            array('type' => 'number', 'label' => 'Tempo')
        ),  
        'rows' => array()
    ),
    'config' => array(
        'title' => 'Tempo total em cada tentativa',
        'width' => 500,
        'height' => 500,
        'colors' => ['#19b9e7'],
        'backgroundColor' => '#fafafa'
    )
);

$array = array();

for($i = 1; $i < 16; $i++){
    $sql = "SELECT sum(tempo) as tempo FROM tb_tempo_digitacao as t JOIN tb_usuario as u ON";
    $sql .=" t.id_usuario = u.id_usuario WHERE id_tentativa = '$i' GROUP BY t.id_usuario";
    $result = mysqli_query($db, $sql) or die(mysqli_error($db));

    while($row = mysqli_fetch_array($result)) {  
         $tempo = $row['tempo'];
         $array[] = array('v' => $tempo);
   }

    sort($array);
    array_unshift($array, array('v' => 'Tentativa '.$i));
    $grafico['dados']['rows'][] = array('c' => $array
        ); 
    $array = array();
}

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($grafico);
exit(0);