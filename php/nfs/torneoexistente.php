<?php
    require_once 'bd/bd.php';
    // $nombreTorneo = $_POST['existente'];
    // $sql = "select Name from tournaments where Name = :Name";
    $sql = "select Name from tournaments";
    $stmt = $pdo->prepare($sql);
    // $stmt->bindParam(':Name', $nombreTorneo, PDO::PARAM_STR, 50);
    $stmt->execute();
    $resultados = $stmt->fetchAll();

// if (isset($_POST['existente'])) {
//     require_once '../bd/bd.php';
//     $nombreTorneo = $_POST['existente'];
//     // $sql = "select Name from tournaments where Name = :Name";
//     $sql = "select Name from tournaments";

//     try {
//         $stmt = $pdo->prepare($sql);
//         // $stmt->bindParam(':Name', $nombreTorneo, PDO::PARAM_STR, 50);
//         $stmt->execute();
//         $resultados = $stmt->fetchAll();
//         if ($resultados != null) {
//             $response = "El nombre del torneo ya existe";
//             echo $response;
//         } else {
//             $response = "Nombre de torneo disponible";
//             echo $response;
//         };
//     } catch (Exception $ex) {
//         echo ($ex->getMessage());
//     }
// }
