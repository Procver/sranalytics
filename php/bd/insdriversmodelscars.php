<?php

function insdriversmodelscars($arr, $pdo) {
  for ($i = 0; $i < count($arr["Cars"]); $i++) {

  try {

    $Guid = $arr["Cars"][$i]["Driver"]["Guid"];
    $Name = $arr["Cars"][$i]["Driver"]["Name"];
    $Team = $arr["Cars"][$i]["Driver"]["Team"];
    $Nation = $arr["Cars"][$i]["Driver"]["Nation"];

    checkdriver($pdo, $arr["Cars"][$i]["Driver"]["Guid"], $arr["Cars"][$i]["Driver"]["Name"], $arr["Cars"][$i]["Driver"]["Team"], $arr["Cars"][$i]["Driver"]["Nation"]);
    
    
    //LLENA TABLA MODELS ----------------------------------VER SI CONTROLA BIEN LOS MODELS REPETIDOS
    checkmodel($pdo, $arr["Cars"][$i]["Model"], $arr["Cars"][$i]["Skin"], $arr["Cars"][$i]["BallastKG"], strval($arr["Cars"][$i]["Restrictor"]) );
    
    // SACA SESSION_ID DE LA TABLA SESSIONS
    $sqlsessionid = "SELECT Session_id FROM sessions ORDER BY Session_id DESC LIMIT 1";
    $resultadosessionid = $pdo->prepare($sqlsessionid, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $resultadosessionid->execute();
    $rowsession = $resultadosessionid->fetch(pdo::FETCH_NUM);

    // SACA MODEL_ID DE LA TABLA MODELS
    $sqlmodelid = "SELECT Model_id FROM models ORDER BY Model_id DESC LIMIT 1";
    $resultadomodelid = $pdo->prepare($sqlmodelid, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $resultadomodelid->execute();
    $rowmodel = $resultadomodelid->fetch(pdo::FETCH_NUM);

    // LLENA TABLA CARS
    $Session_id = $rowsession[0];
    $Model_id = $rowmodel[0];

    $sql = "INSERT INTO cars (Session_id, Guid, Model_id) ";
    $sql .="VALUES (:Session_id, :Guid, :Model_id)"; 

    $stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

    $stmt->bindParam(':Session_id', $Session_id, PDO::PARAM_INT, 11);
    $stmt->bindParam(':Guid', $Guid, PDO::PARAM_INT, 17);
    $stmt->bindParam(':Model_id', $Model_id, PDO::PARAM_INT, 11);
    
    $stmt->execute();  

  } catch (\Exception $e) {
      echo __FILE__." ".__FUNCTION__. " ".__LINE__."  ". $e->getMessage();
  }

  }

  

}

function checkdriver($pdo, $Guid, $Name, $Team, $Nation) {
  $tabla = "drivers";

  $chkGuid = "SELECT COUNT(*) FROM {$tabla} where Guid = :Guid";

  $stmtchk = $pdo->prepare($chkGuid, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $stmtchk->bindParam(':Guid', $Guid, PDO::PARAM_INT, 17);
  $stmtchk->execute();

  $rsdriverexistente = $stmtchk->fetchColumn();

  
  if ($rsdriverexistente > 0) {
    // echo "Driver existente ";
  }
  else {
    $sql = "INSERT INTO {$tabla} (Guid, Name, Team, Nation) ";
    $sql .="VALUES (:Guid, :Name, :Team, :Nation)"; 

    $stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

    $stmt->bindParam(':Guid', $Guid, PDO::PARAM_INT, 17);
    $stmt->bindParam(':Name', $Name, PDO::PARAM_STR, 50);
    $stmt->bindParam(':Team', $Team, PDO::PARAM_STR, 50);
    $stmt->bindParam(':Nation', $Nation, PDO::PARAM_STR, 50);
    
    $stmt->execute();
    
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

  }
}


function checkmodel($pdo, $Model, $Skin, $BallastKG, $Restrictor) {

  $chkModel = "SELECT Model, Skin, BallastKG, Restrictor FROM models "; 
  $chkModel .= "WHERE Model= :Model AND Skin = :Skin AND BallastKG = :BallastKG AND Restrictor = :Restrictor";

  $stmtchk = $pdo->prepare($chkModel, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $stmtchk->bindParam(':Model', $Model, PDO::PARAM_STR, 50);
  $stmtchk->bindParam(':Skin', $Skin, PDO::PARAM_STR, 50);
  $stmtchk->bindParam(':BallastKG', $BallastKG, PDO::PARAM_INT, 3);
  $stmtchk->bindParam(':Restrictor', $Restrictor, PDO::PARAM_STR, 10);

  $stmtchk->execute();
  $rsmodelexistente = $stmtchk->fetchColumn();


  if($rsmodelexistente > 0) {
  } else {
      
      $sql = "INSERT INTO models (Model, Skin, BallastKG, Restrictor) ";
      $sql .="VALUES (:Model, :Skin, :BallastKG, :Restrictor)"; 

      $stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

      $stmt->bindParam(':Model', $Model, PDO::PARAM_STR, 50);
      $stmt->bindParam(':Skin', $Skin, PDO::PARAM_STR, 50);
      $stmt->bindParam(':BallastKG', $BallastKG, PDO::PARAM_INT, 3);
      $stmt->bindParam(':Restrictor', $Restrictor, PDO::PARAM_STR, 10);

      $stmt->execute();                                  
                                  
  } 
}

?>