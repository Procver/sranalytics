<?php
$json = $_POST['json'];
// $json = file_get_contents("2018_2_15_23_18_QUALIFY.json");
$arr = json_decode($json, true);

for ($i = 0; $i < count($arr["Result"]); $i++) {
    try {
        if ($arr["Result"][$i]["TotalTime"] != 0) {
            // Posición
            $posicion = $i + 1;

            // Nombre
            $piloto = $arr['Result'][$i]['DriverName'];

            // Diferencia
            $polePosition = $arr["Result"][0]["BestLap"];
            if ($arr["Result"][$i]["BestLap"] == $arr["Result"][0]["BestLap"]) {
                $Diferenciatmp = "0";
            } else {
                $Diferenciatmp = $arr["Result"][$i]["BestLap"] - $arr["Result"][0]["BestLap"];
            }
            $milliseconds = floatval($Diferenciatmp);
            $seconds = floor($milliseconds / 1000);
            $minutes = floor($seconds / 60);
            $milliseconds = $milliseconds % 1000;
            $seconds = $seconds % 60;
            $minutes = $minutes % 60;
            $format = '%02u:%02u.%03u';
            $time = sprintf($format, $minutes, $seconds, $milliseconds);
            $Diferencia = $time;

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

            // Sectores
            for ($j = 0; $j < count($arr["Laps"]); $j++) {
                if ($arr["Laps"][$j]["LapTime"] == $arr["Result"][$i]["BestLap"]) {
                    $sector1tmp = $arr["Laps"][$j]["Sectors"][0];
                    $milliseconds = floatval($sector1tmp);
                    $seconds = floor($milliseconds / 1000);
                    $minutes = floor($seconds / 60);
                    $milliseconds = $milliseconds % 1000;
                    $seconds = $seconds % 60;
                    $minutes = $minutes % 60;
                    $format = '%02u:%02u.%03u';
                    $time = sprintf($format, $minutes, $seconds, $milliseconds);
                    $sector1 = $time;

                    $sector2tmp = $arr["Laps"][$j]["Sectors"][1];
                    $milliseconds = floatval($sector2tmp);
                    $seconds = floor($milliseconds / 1000);
                    $minutes = floor($seconds / 60);
                    $milliseconds = $milliseconds % 1000;
                    $seconds = $seconds % 60;
                    $minutes = $minutes % 60;
                    $format = '%02u:%02u.%03u';
                    $time = sprintf($format, $minutes, $seconds, $milliseconds);
                    $sector2 = $time;

                    $sector3tmp = $arr["Laps"][$j]["Sectors"][2];
                    $milliseconds = floatval($sector3tmp);
                    $seconds = floor($milliseconds / 1000);
                    $minutes = floor($seconds / 60);
                    $milliseconds = $milliseconds % 1000;
                    $seconds = $seconds % 60;
                    $minutes = $minutes % 60;
                    $format = '%02u:%02u.%03u';
                    $time = sprintf($format, $minutes, $seconds, $milliseconds);
                    $sector3 = $time;
                    break;
                }
            };
            // Armando array
            $arrQualy[$i] = ["Posicion" => strval($posicion), "Piloto" => $piloto, "Diferencia" => $Diferencia, "MVuelta" => $mejorVuelta, "Sector1" => $sector1, "Sector2" => $sector2,"Sector3" => $sector3];
        }
    } catch (\Exception $e) {
    }
}
$jsonQualy = json_encode($arrQualy);
echo $jsonQualy;