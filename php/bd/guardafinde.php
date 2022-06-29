<?php

// FALTA LA OPCIÓN DE LIMPIAR INPUT POR SI SE EQUIVOCAN

require_once 'bd.php';

$torneo = $_POST['torneo'];
// require_once('insertatournaments.php');
// insertatournaments($pdo, $torneo);
require_once('insertaweekends.php');
insertaweekends($pdo, $torneo);

// Estos 3 if podrían ir dentro de insertaweekends - VER
if (isset($_POST['datep'])) {
    $date = explode('_',$_POST['datep']);
    $fecha = formatoFecha($date);
    $jsonq = $_POST['jsonp'];
    $arr = json_decode($jsonq, true);
    // En la qualy se cuentan todas las vueltas de todos los pilotos
    $RaceLaps = count($arr["Laps"]); 
    inserta($arr, $pdo, $fecha, $RaceLaps);
}

if (isset($_POST['dateq'])) {
    $date = explode('_',$_POST['dateq']);
    $fecha = formatoFecha($date);
    $jsonq = $_POST['jsonq'];
    $arr = json_decode($jsonq, true);
    // En la qualy se cuentan todas las vueltas de todos los pilotos
    $RaceLaps = count($arr["Laps"]); 
    inserta($arr, $pdo, $fecha, $RaceLaps);
}

if (isset($_POST['datec'])) {
    $date = explode('_',$_POST['datec']);
    $fecha = formatoFecha($date);
    $jsonc = $_POST['jsonc'];
    $arr = json_decode($jsonc, true);
    // En la carrera se cuentan cuantas vueltas dio el ganador
    $ganador = $arr['Result'][0]['DriverGuid'];
    $RaceLaps = array_count_values(array_column($arr['Laps'], 'DriverGuid'))[$ganador]; 
    inserta($arr, $pdo, $fecha, $RaceLaps);
}


function inserta($arr, $pdo, $fecha, $RaceLaps){
    // print_r($arr);
try {

    require_once('insertasessions.php');
    insertasessions($pdo, $arr, $fecha, $RaceLaps);

    require_once('insdriversmodelscars.php');
    insdriversmodelscars($arr, $pdo);

    require_once('insertaresults.php');
    insertaresults($arr, $pdo);

    require_once('insertalaps.php');
    insertalaps($arr, $pdo);

    require_once('insertaevents.php');
    insertaevents($arr, $pdo);
} catch (\Exception $e) {
}
}

function formatoFecha($date){
    $anio = $date[0];
    $mes = $date[1];
    $dia = $date[2];
    $hora = $date[3];
    $minuto = $date[4];
    $format = '%04u%02u%02u%02u%02u';
    $fecha = sprintf($format, $anio, $mes, $dia, $hora, $minuto);
    return $fecha;
}