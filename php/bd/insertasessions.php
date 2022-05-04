<?php

function insertasessions ($pdo, $arr){
  try {

      // SACA WEEKEND_ID DE LA TABLA WEEKENDS ---------- no está insertando session date

      
      $sql = "SELECT Weekend_id FROM weekends ORDER BY weekend_id DESC LIMIT 1";
      $resultadoweekendid = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $resultadoweekendid->execute();
      $row = $resultadoweekendid->fetch(pdo::FETCH_NUM);
      
      $Weekend_id = $row[0];

      $sql = "INSERT INTO sessions (Weekend_id, TrackName, TrackConfig, Type, DurationSecs, RaceLaps) ";
      $sql .= "VALUES (:Weekend_id, :TrackName, :TrackConfig, :Type, :DurationSecs, :RaceLaps)";

      $TrackName = $arr["TrackName"];
      $TrackConfig = $arr["TrackConfig"];
      $Type = $arr["Type"];
      $DurationSecs = $arr["DurationSecs"]; /*ver las comillas simples*/
      $RaceLaps = $arr["RaceLaps"]; /*ver las comillas simples*/
    
      $stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      
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