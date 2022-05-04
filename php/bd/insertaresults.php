<?php

function insertaresults($arr, $pdo) {
    for ($i = 0; $i < count($arr["Result"]); $i++) {
        try {

            // SACA SESSION_ID DE LA TABLA SESSIONS

            $sqlsessionid = "SELECT Session_id FROM sessions ORDER BY Session_id DESC LIMIT 1";
            $resultadosessionid = $pdo->prepare($sqlsessionid, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $resultadosessionid->execute();
            $rowsession = $resultadosessionid->fetch(pdo::FETCH_NUM);

            // TRAE EL AUTO

            $Guid = $arr["Result"][$i]["DriverGuid"];
            $Session_id = $rowsession[0];

            $sql = "SELECT Car_id FROM cars ";
            $sql .= "WHERE Guid = :Guid AND Session_id = :Session_id";

            $resultadocarid = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            
            $resultadocarid->bindParam(':Guid', $Guid, PDO::PARAM_INT, 17);     //PUEDE QUE SEA MUY GRANDE!
            $resultadocarid->bindParam(':Session_id', $Session_id, PDO::PARAM_INT, 11);

            $resultadocarid->execute();
            $rowcar = $resultadocarid->fetch(pdo::FETCH_NUM);

            // CARGA LOS RESULTADOS
                
            $Car_id = $rowcar[0];
            $BestLap = $arr["Result"][$i]["BestLap"];
            $TotalTime = $arr["Result"][$i]["TotalTime"];
            $BallastKG = $arr["Result"][$i]["BallastKG"];
            $Restrictor = $arr["Result"][$i]["Restrictor"];

            $sql = "INSERT INTO Results (Session_id, Car_id, BestLap, TotalTime, BallastKG, Restrictor) ";
            $sql .= "VALUES (:Session_id, :Car_id, :BestLap, :TotalTime, :BallastKG, :Restrictor)";

            $resultado = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            $resultado->bindParam(':Session_id', $Session_id, PDO::PARAM_INT, 11);
            $resultado->bindParam(':Car_id', $Car_id, PDO::PARAM_INT, 11);
            $resultado->bindParam(':BestLap', $BestLap, PDO::PARAM_INT, 10);
            $resultado->bindParam(':TotalTime', $TotalTime, PDO::PARAM_INT, 10);
            $resultado->bindParam(':BallastKG', $BallastKG, PDO::PARAM_INT, 3);
            $resultado->bindParam(':Restrictor', $Restrictor, PDO::PARAM_STR, 10);

            $resultado->execute();

        } catch (\Exception $e) {
            echo __FILE__." ".__FUNCTION__. " ".__LINE__."  ". $e->getMessage();
        }

    }

}
?>