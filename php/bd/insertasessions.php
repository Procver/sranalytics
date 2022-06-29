<?php

function insertasessions ($pdo, $arr, $fecha, $RaceLaps){
  try {

      // SACA WEEKEND_ID DE LA TABLA WEEKENDS ---------- no está insertando session date

      
      $sql = "SELECT Weekend_id FROM weekends ORDER BY weekend_id DESC LIMIT 1";
      $resultadoweekendid = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $resultadoweekendid->execute();
      $row = $resultadoweekendid->fetch(pdo::FETCH_NUM);
      
      If ($row === false) {
        $Weekend_id = 1;
      } else {
        $Weekend_id = $row[0];
      }

      $sql = "INSERT INTO sessions (SessionDate, Weekend_id, TrackName, TrackConfig, Type, DurationSecs, RaceLaps) ";
      $sql .= "VALUES (:SessionDate, :Weekend_id, :TrackName, :TrackConfig, :Type, :DurationSecs, :RaceLaps)";

      $SessionDate = $fecha;
      $TrackName = $arr["TrackName"];
      $TrackConfig = $arr["TrackConfig"];
      $Type = $arr["Type"];
      $DurationSecs = $arr['Laps'][0]['LapTime'] + $arr['Laps'][count($arr["Laps"]) - 1]['Timestamp'] - $arr['Laps'][0]['Timestamp']; // La duración es desde que el primero salió de boxes hasta que el último girando terminó su última vuelta
    
      $stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      
      $stmt->bindParam(':SessionDate', $SessionDate, PDO::PARAM_INT, 12);
      $stmt->bindParam(':Weekend_id', $Weekend_id, PDO::PARAM_INT, 11);
      $stmt->bindParam(':TrackName', $TrackName, PDO::PARAM_STR, 50);
      $stmt->bindParam(':TrackConfig', $TrackConfig, PDO::PARAM_STR, 50);
      $stmt->bindParam(':Type', $Type, PDO::PARAM_STR, 10);
      $stmt->bindParam(':DurationSecs', $DurationSecs, PDO::PARAM_INT, 5);
      $stmt->bindParam(':RaceLaps', $RaceLaps, PDO::PARAM_INT, 5);

      $stmt->execute();

      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
  } catch (\Exception $e) {
    echo __FILE__." ".__FUNCTION__. " ".__LINE__."  ". $e->getMessage();
  }
}


?>