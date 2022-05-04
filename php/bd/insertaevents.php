<?php

function insertaevents($arr, $pdo){
    for ($i = 0; $i < count($arr["Events"]); $i++) {
        try {


            // SACA SESSION_ID DE LA TABLA SESSIONS

            $sqlsessionid = "SELECT Session_id FROM sessions ORDER BY Session_id DESC LIMIT 1";
            $resultadosessionid = $pdo->prepare($sqlsessionid, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $resultadosessionid->execute();
            $rowsession = $resultadosessionid->fetch(pdo::FETCH_NUM);

            // TRAE EL AUTO

            $Guid = $arr["Events"][$i]["Driver"]["Guid"];
            $Session_id = $rowsession[0];

            $sql = "SELECT Car_id FROM cars ";
            $sql .= "WHERE Guid = :Guid AND Session_id = :Session_id";

            $resultadocarid = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            
            $resultadocarid->bindParam(':Guid', $Guid, PDO::PARAM_INT, 17);     //PUEDE QUE SEA MUY GRANDE!
            $resultadocarid->bindParam(':Session_id', $Session_id, PDO::PARAM_INT, 11);

            $resultadocarid->execute();
            $rowcar = $resultadocarid->fetch(pdo::FETCH_NUM);

        
            // TRAE EL AUTO DEL OTRO PILOTO
            $Guid = $arr["Events"][$i]["OtherDriver"]["Guid"];
            $Session_id = $rowsession[0];

            $sql = "SELECT Car_id FROM cars ";
            $sql .= "WHERE Guid = :Guid AND Session_id = :Session_id";

            $resultadocarid = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            
            $resultadocarid->bindParam(':Guid', $Guid, PDO::PARAM_INT, 17);     //PUEDE QUE SEA MUY GRANDE!
            $resultadocarid->bindParam(':Session_id', $Session_id, PDO::PARAM_INT, 11);

            $resultadocarid->execute();


            $rowcar2 = $resultadocarid->fetch(pdo::FETCH_NUM);


            $Type = $arr["Events"][$i]["Type"];
            // echo $Type;
            $Car_id = $rowcar[0];

            // CHEQUEA SI ES IMPACTO CON AMBIENTE O CONTRA OTRO AUTO
            if ($Type == "COLLISION_WITH_ENV") {
                $OtherCar_id = "999";    
                // echo "\n IF \n";
            } Else {
                $OtherCar_id = $rowcar2[0];
                // echo "\n ELSE \n";
            }
            
            
            $ImpactSpeed = $arr["Events"][$i]["ImpactSpeed"];
            $WPX = $arr["Events"][$i]["WorldPosition"]["X"];
            $WPY = $arr["Events"][$i]["WorldPosition"]["Y"];
            $WPZ = $arr["Events"][$i]["WorldPosition"]["Z"];
            $RPX = $arr["Events"][$i]["RelPosition"]["X"];
            $RPY = $arr["Events"][$i]["RelPosition"]["Y"];
            $RPZ = $arr["Events"][$i]["RelPosition"]["Z"];

            $sqlevents = "INSERT INTO Events (Session_id, Type, Car_id, OtherCar_id, ImpactSpeed, WPX, WPY, WPZ, RPX, RPY, RPZ) ";
            $sqlevents .="VALUES (:Session_id, :Type, :Car_id, :OtherCar_id, :ImpactSpeed, :WPX, :WPY, :WPZ, :RPX, :RPY, :RPZ)";

            $resultado = $pdo->prepare($sqlevents, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            $resultado->bindParam(':Session_id', $Session_id, PDO::PARAM_INT, 11);
            $resultado->bindParam(':Type', $Type, PDO::PARAM_STR, 40);
            $resultado->bindParam(':Car_id', $Car_id, PDO::PARAM_INT, 11);
            $resultado->bindParam(':OtherCar_id', $OtherCar_id, PDO::PARAM_INT, 11);
            $resultado->bindParam(':ImpactSpeed', $ImpactSpeed, PDO::PARAM_INT, 10);
            $resultado->bindParam(':WPX', $WPX, PDO::PARAM_STR, 16);
            $resultado->bindParam(':WPY', $WPY, PDO::PARAM_STR, 16);
            $resultado->bindParam(':WPZ', $WPZ, PDO::PARAM_STR, 16);
            $resultado->bindParam(':RPX', $RPX, PDO::PARAM_STR, 16);
            $resultado->bindParam(':RPY', $RPY, PDO::PARAM_STR, 16);
            $resultado->bindParam(':RPZ', $RPZ, PDO::PARAM_STR, 16);

            $resultado->execute();


        } catch (\Exception $e) {
            // echo __FILE__." ".__FUNCTION__. " ".__LINE__."  ". $e->getMessage();
        }
        
    }

}
?>