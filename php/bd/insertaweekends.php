<?php
function insertaweekends ($pdo){
    try {
        $tabla = "weekends";
        $date = new DateTime("now", new DateTimeZone('America/Argentina/Jujuy') );

        $sql = "INSERT INTO $tabla (UploadDate)";
        $sql .= "VALUES ('" . $date->format('YmdHis') . "')";

        $stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (\Exception $e) {
        echo __FILE__." ".__FUNCTION__. " ".__LINE__."  ". $e->getMessage();
    }
}
?>