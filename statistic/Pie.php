<?php
include("../login/Config.php");
include("Frequency.php");
// Estrutura básica do gráfico
$grafico = array(
    'dados' => array(
        'cols' => array(
            array('type' => 'string', 'label' => 'Intervalo'),
            array('type' => 'number', 'label' => 'Frequência')
        ),  
        'rows' => array()
    ),
    'config' => array(
        'title' => 'Frequência de intervalos',
        'width' => 500,
        'height' => 500,
        'colors' => ['#19b9e7', '#5eceee', '#1986e7', '#083a48', '#71888f'],
        'is3D' => true,
        'backgroundColor' => '#fafafa'
    )
);

$intervals = array('0 - 1','1 - 1.5','1.5 - 2','2 - 2.5','2.5 - 3');
$array = array();
$idx = 0;


    foreach($qtdIntervalo as $index){  

        $array[] = array('v' => $intervals[$idx]);      
        $array[] = array('v' => $index);

        $grafico['dados']['rows'][] = array('c' => $array
        ); 

        $array = array();
        $idx++;
    }    

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($grafico);
exit(0);