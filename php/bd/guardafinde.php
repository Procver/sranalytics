<?php

use LDAP\Result;

    require_once 'bd.php';

    $fileName = $_FILES["file"]["name"];
    $location = "../../json/".$fileName;

    $sessionType = substr($fileName, -9,4);
    


    if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
        // echo "Archivo subido: " . $location;
        $json = file_get_contents($location);          
        $arr = json_decode($json, true);


        // Subiendo a BD

        // controlar esto, no discrimina weekends
        // require_once('insertaweekends.php');
        // insertaweekends ($pdo);

        // require_once('insertasessions.php');
        // insertasessions ($pdo, $arr);

        // require_once('insdriversmodelscars.php');
        // insdriversmodelscars($arr, $pdo);

        // require_once('insertaresults.php');
        // insertaresults($arr, $pdo);

        // require_once('insertalaps.php');
        // insertalaps($arr, $pdo);
        
        // require_once('insertaevents.php');
        // insertaevents($arr, $pdo);




    } else {
        echo "Error subiendo archivo.";
    }

?>