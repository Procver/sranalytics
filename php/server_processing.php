<?php
// if ($_SERVER['REQUEST_METHOD'] != 'POST') {
//     exit;
// }
// switch ($_POST['file']) {
//     case '../ajax/arrays.json':
//     case '../ajax/arrays2.json':
//         break;
//     default:
//         exit;
// }
$str = file_get_contents($_POST['file']);
echo $str;