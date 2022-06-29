<?php
$json = $_POST['json'];
$arr = json_decode($json, true);

for ($i = 0; $i < count($arr["Result"]); $i++) {
    try {
        if ($arr["Result"][$i]["TotalTime"] != 0) {
            // Posición
            $posicion = $i + 1;

            // Nombre
            $idpiloto = $arr['Result'][$i]['DriverGuid'];

            // Diferencia
            $polePosition = $arr["Result"][0]["BestLap"];
            if ($arr["Result"][$i]["BestLap"] == $arr["Result"][0]["BestLap"]) {
                $Diferenciatmp = "0";
            } else {
                $Diferenciatmp = $arr["Result"][$i]["BestLap"] - $arr["Result"][0]["BestLap"];
            }
            $milliseconds = floatval($Diferenciatmp);
            $Diferencia = calculoTiempos($milliseconds);

            // Mejor vuelta (va sin hora)
            $milliseconds = floatval($arr["Result"][$i]["BestLap"]);
            $mejorVuelta = calculoTiempos($milliseconds);

            // Sectores
            for ($j = 0; $j < count($arr["Laps"]); $j++) {
                if ($arr["Laps"][$j]["LapTime"] == $arr["Result"][$i]["BestLap"]) {
                    $sector1tmp = $arr["Laps"][$j]["Sectors"][0];
                    $milliseconds = floatval($sector1tmp);
                    $sector1 = calculoTiempos($milliseconds);

                    $sector2tmp = $arr["Laps"][$j]["Sectors"][1];
                    $milliseconds = floatval($sector2tmp);
                    $sector2 = calculoTiempos($milliseconds);

                    $sector3tmp = $arr["Laps"][$j]["Sectors"][2];
                    $milliseconds = floatval($sector3tmp);
                    $sector3 = calculoTiempos($milliseconds);
                    break;
                }
            };
            // Armando array
            $arrPractica[$i] = ["Posicion" => strval($posicion), "Piloto" => $arr['Result'][$i]['DriverName'], "Diferencia" => $Diferencia, "MVuelta" => $mejorVuelta, "Sector1" => $sector1, "Sector2" => $sector2,"Sector3" => $sector3];
        }
    } catch (\Exception $e) {
    }
}
$jsonPractica = json_encode($arrPractica);
echo $jsonPractica;

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