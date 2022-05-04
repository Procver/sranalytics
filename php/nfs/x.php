<?php

$jsonCarrera = $_POST['jsonCarrera'];
// $jsoncarrera va a contener el json del archivo elegido
// 
$arr = '';
// use LDAP\Result;

require_once '../bd/bd.php';

// $fileName = $file;
// $location = "../../json/" . $fileName;

$sessionType = substr($fileName, -9, 4);
// if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {

    // $json = file_get_contents($location);
    $arr = json_decode($jsonCarrera, true);


    // Subiendo a BD

    // controlar esto, no discrimina weekends
    // require_once('insertaweekends.php');
    // insertaweekends ($pdo);

    // require_once('insertasessions.php');
    // insertasessions ($pdo, $arr);

    // require_once('insdriversmodelscars.php');
    // insdriversmodelscars($arr, $pdo);

    // require_once('insertaresults.php');
    // insertaresults($arr, $pdo);

    // require_once('insertalaps.php');
    // insertalaps($arr, $pdo);

    // require_once('insertaevents.php');
    // insertaevents($arr, $pdo);

// } else {
//     // echo "Error subiendo archivo.";
// }


// $json = file_get_contents($location);
// $arr = json_decode($json, true);
$arrtablac = json_decode($json, true); // usar esto en vez de $arr!!


if ($sessionType == "RACE") {

    for ($i = 0; $i < count($arr["Result"]); $i++) {
        try {
            if ($arr["Result"][$i]["TotalTime"] != 0) {

                // Posición
                $posicion = $i + 1;
                // echo $posicion . "\n";

                // Nombre
                $piloto = $arr['Result'][$i]['DriverName'];
                // echo $piloto . "\n";

                // Tiempo total (este y mejor vuelta podrían ir en una función)
                $milliseconds = floatval($arr["Result"][$i]["TotalTime"]);
                $seconds = floor($milliseconds / 1000);
                $minutes = floor($seconds / 60);
                $hours = floor($minutes / 60);
                $milliseconds = $milliseconds % 1000;
                $seconds = $seconds % 60;
                $minutes = $minutes % 60;
                $format = '%u:%02u:%02u.%03u';
                $time = sprintf($format, $hours, $minutes, $seconds, $milliseconds);
                $tiempoTotal = rtrim($time, '0');
                // echo $tiempoTotal . "\n";      

                // Mejor vuelta (va sin hora)
                $milliseconds = floatval($arr["Result"][$i]["BestLap"]);
                $seconds = floor($milliseconds / 1000);
                $minutes = floor($seconds / 60);
                $milliseconds = $milliseconds % 1000;
                $seconds = $seconds % 60;
                $minutes = $minutes % 60;
                $format = '%02u:%02u.%03u';
                $time = sprintf($format, $minutes, $seconds, $milliseconds);
                $mejorVuelta = rtrim($time, '0');
                // echo $mejorVuelta . "\n";            

                // Cantidad de vueltas           
                $vueltas = 0;
                $varianza = 0.0;
                $sumaTiempos = 0.0;
                for ($l = 0; $l < count($arr["Laps"]); $l++) {
                    try {
                        if ($arr['Laps'][$l]['DriverName'] == $piloto) {
                            $vueltas++;
                            $sumaTiempos += $arr['Laps'][$l]['LapTime'];
                            $promedio = $sumaTiempos / $vueltas;
                            $varianza += pow(($arr['Laps'][$l]['LapTime'] - $promedio), 2);
                        }
                    } catch (\Exception $e) {
                        // echo __FILE__." ".__FUNCTION__. " ".__LINE__."  ". $e->getMessage();
                    }
                }
                // echo $vueltas . "\n";

                // Consistencia (contando la primera vuelta)
                $vueltas--;
                $var_est = floatval(sqrt($varianza / $vueltas));
                $var_est = $var_est / 1000;
                $consistencia = substr(100 - $var_est, 0, 5);
                // echo $consistencia . "<br>";

                // Llenar array para datatables

                $arrCarrera[$i] = [strval($posicion), $piloto, $tiempoTotal, $mejorVuelta, strval($vueltas), $consistencia];
            }
        } catch (\Exception $e) {
            // echo __FILE__." ".__FUNCTION__. " ".__LINE__."  ". $e->getMessage();
        }
    }
} else {
    exit;
}


$jsonCarrera = json_encode(["data" => $arrCarrera]);
// echo $jsonCarrera;


