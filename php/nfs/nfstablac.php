<?php
$json = $_POST['json'];
$arr = json_decode($json, true);

for ($i = 0; $i < count($arr["Result"]); $i++) {
    try {
        if ($arr["Result"][$i]["TotalTime"] != 0) {
            // Posición
            $posicion = $i+1;

            // Id del piloto (no usa nombre por si hay nombres repetidos)
            $idpiloto = $arr['Result'][$i]['DriverGuid'];

            // Tiempo total (este y mejor vuelta podrían ir en una función)
            $milliseconds = floatval($arr["Result"][$i]["TotalTime"]);
            $tiempoTotal = calculoTiempos($milliseconds);

            // Mejor vuelta (va sin hora)
            $milliseconds = floatval($arr["Result"][$i]["BestLap"]);
            $mejorVuelta = calculoTiempos($milliseconds);      

            // Cantidad de vueltas           
            $vueltas = 0;
            $varianza = 0.0;
            $sumaTiempos = 0.0;
            for ($l= 0; $l < count($arr["Laps"]); $l++) {
                try {
                    if ($arr['Laps'][$l]['DriverGuid'] == $idpiloto) {
                        $vueltas++;
                        $sumaTiempos += $arr['Laps'][$l]['LapTime'];
                        $promedio = $sumaTiempos/$vueltas;
                        $varianza += pow(($arr['Laps'][$l]['LapTime'] - $promedio), 2);
                    }
                } catch (\Exception $e) {}
            }            

            // Consistencia (contando la primera vuelta)
            $var_est = floatval(sqrt($varianza/$vueltas));            
            $var_est = $var_est/1000;
            $consistencia = substr(100 - $var_est,0,5); 

            // Armando array
            $arrCarrera[$i] = ["Posicion" => strval($posicion), "Piloto" => $arr['Result'][$i]['DriverName'], "TTotal" => $tiempoTotal, "MVuelta" => $mejorVuelta, "CVueltas" => strval($vueltas), "Consistencia" => $consistencia];
        }

    } catch (\Exception $e) {}
}

$jsonCarrera = json_encode($arrCarrera);
echo $jsonCarrera;

function calculoTiempos ($milliseconds){
    $seconds = floor($milliseconds / 1000);
    $minutes = floor($seconds / 60);
    $milliseconds = $milliseconds % 1000;
    $seconds = $seconds % 60;
    $minutes = $minutes % 60;
    $format = '%02u:%02u.%03u';
    $time = sprintf($format, $minutes, $seconds, $milliseconds);
    return $time;
}