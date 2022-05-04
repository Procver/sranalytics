<?php
$json = $_POST['json'];
$arr = json_decode($json, true);

for ($i = 0; $i < count($arr["Result"]); $i++) {
    try {
        if ($arr["Result"][$i]["TotalTime"] != 0) {
            // Posición
            $posicion = $i+1;

            // Nombre
            $piloto = $arr['Result'][$i]['DriverName'];

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
            $tiempoTotal = $time;

            // Mejor vuelta (va sin hora)
            $milliseconds = floatval($arr["Result"][$i]["BestLap"]);
            $seconds = floor($milliseconds / 1000);
            $minutes = floor($seconds / 60);
            $milliseconds = $milliseconds % 1000;
            $seconds = $seconds % 60;
            $minutes = $minutes % 60;
            $format = '%02u:%02u.%03u';
            $time = sprintf($format, $minutes, $seconds, $milliseconds);
            $mejorVuelta = $time;       

            // Cantidad de vueltas           
            $vueltas = 0;
            $varianza = 0.0;
            $sumaTiempos = 0.0;
            for ($l= 0; $l < count($arr["Laps"]); $l++) {
                try {
                    if ($arr['Laps'][$l]['DriverName'] == $piloto) {
                        $vueltas++;
                        $sumaTiempos += $arr['Laps'][$l]['LapTime'];
                        $promedio = $sumaTiempos/$vueltas;
                        $varianza += pow(($arr['Laps'][$l]['LapTime'] - $promedio), 2);
                    }
                } catch (\Exception $e) {}
            }            

            // Consistencia (contando la primera vuelta)
            $vueltas--;
            $var_est = floatval(sqrt($varianza/$vueltas));            
            $var_est = $var_est/1000;
            $consistencia = substr(100 - $var_est,0,5); 

            $arrCarrera[$i] = ["Posicion" => strval($posicion), "Piloto" => $piloto, "TTotal" => $tiempoTotal, "MVuelta" => $mejorVuelta, "CVueltas" => strval($vueltas), "Consistencia" => $consistencia];
        }

    } catch (\Exception $e) {}
}
$jsonCarrera = json_encode($arrCarrera);
echo $jsonCarrera;