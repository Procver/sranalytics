<?php
function insertalaps($arr, $pdo){
    for ($i = 0; $i < count($arr["Laps"]); $i++) {
        try {
            
            
            // SACA SESSION_ID DE LA TABLA SESSIONS

            $sqlsessionid = "SELECT Session_id FROM sessions ORDER BY Session_id DESC LIMIT 1";
            $resultadosessionid = $pdo->prepare($sqlsessionid, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $resultadosessionid->execute();
            $rowsession = $resultadosessionid->fetch(pdo::FETCH_NUM);

            // TRAE EL AUTO

            $Guid = $arr["Laps"][$i]["DriverGuid"];
            $Session_id = $rowsession[0];

            $sql = "SELECT Car_id FROM cars ";
            $sql .= "WHERE Guid = :Guid AND Session_id = :Session_id";

            $resultadocarid = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            
            $resultadocarid->bindParam(':Guid', $Guid, PDO::PARAM_INT, 17);     //PUEDE QUE SEA MUY GRANDE!
            $resultadocarid->bindParam(':Session_id', $Session_id, PDO::PARAM_INT, 11);

            $resultadocarid->execute();
            $rowcar = $resultadocarid->fetch(pdo::FETCH_NUM);

            // CARGA LAS VUELTAS     

            $Car_id = $rowcar[0];
            $TimeStamp = $arr["Laps"][$i]["Timestamp"];
            $LapTime = $arr["Laps"][$i]["LapTime"];
            $Sector1 = $arr["Laps"][$i]["Sectors"][0];
            $Sector2 = $arr["Laps"][$i]["Sectors"][1];
            $Sector3 = $arr["Laps"][$i]["Sectors"][2];
            $Cuts = $arr["Laps"][$i]["Cuts"];
            $Tyre = $arr["Laps"][$i]["Tyre"];
            $BallastKG = $arr["Laps"][$i]["BallastKG"];
            $Restrictor = $arr["Laps"][$i]["Restrictor"];

            $sql = "INSERT INTO Laps (Session_id, Car_id, Timestamp, LapTime, Sector1, Sector2, Sector3, Cuts, Tyre, BallastKG, Restrictor) ";
            $sql .= "VALUES (:Session_id, :Car_id, :TimeStamp, :LapTime, :Sector1, :Sector2, :Sector3, :Cuts, :Tyre, :BallastKG, :Restrictor)";
            
            $stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            
            $stmt->bindParam(':Session_id', $Session_id, PDO::PARAM_INT, 11);
            $stmt->bindParam(':Car_id', $Car_id, PDO::PARAM_INT, 11);
            $stmt->bindParam(':TimeStamp', $TimeStamp, PDO::PARAM_INT, 10);
            $stmt->bindParam(':LapTime', $LapTime, PDO::PARAM_INT, 10);
            $stmt->bindParam(':Sector1', $Sector1, PDO::PARAM_INT, 10);
            $stmt->bindParam(':Sector2', $Sector2, PDO::PARAM_INT, 10);
            $stmt->bindParam(':Sector3', $Sector3, PDO::PARAM_INT, 10);
            $stmt->bindParam(':Cuts', $Cuts, PDO::PARAM_INT, 3);
            $stmt->bindParam(':Tyre', $Tyre, PDO::PARAM_STR, 50);
            $stmt->bindParam(':BallastKG', $BallastKG, PDO::PARAM_INT, 3);
            $stmt->bindParam(':Restrictor', $Restrictor, PDO::PARAM_STR, 10);

            $stmt->execute();  

        } catch (\Exception $e) {
            echo __FILE__." ".__FUNCTION__. " ".__LINE__."  ". $e->getMessage();
        }
    }
}
?>