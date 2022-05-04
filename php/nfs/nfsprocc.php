<?php
// if (
//     $_SERVER['REQUEST_METHOD'] != 'POST'
//     || !array_key_exists('file', $_POST)
//     || !isset($_POST['file'])
// ) {
//     exit;
// }
$fileName = $_FILES["file"]["name"]; 
$location = "../../json/".$fileName;
$file = $_POST['file'];

// switch ($file) {
//     case 'datos.php':
//         break;
//     default:
//         exit;
// }
require_once ($file);
echo $jsonCarrera;
?>