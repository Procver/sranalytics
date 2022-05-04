<?php
// credenciales de la base de datos

// define('DB_USER', 'Ayrton');
// define('DB_PASSWORD', 'DnArT*5.%n(BEYB');
// define('DB_HOST', 'localhost');
// define('DB_NAME', 'sranalyticsdb');

// $dsn = 'mysql:dbname='. DB_NAME .';host=' . DB_HOST;
// $user = DB_USER;
// $password = DB_PASSWORD;

// $conn = new PDO($dsn, $user, $password);


// if($conn->errorCode()) {
//     echo $conn->errorInfo();
// }
// echo $conn->ping();



define('USER', 'Ayrton');
define('PASSWORD', 'DnArT*5.%n(BEYB');
define('HOST', 'localhost');
define('DBNAME', 'sranalyticsdb');


class DB
{
    static public function connect()
    {
        try {
            $pdo = new PDO(
                'mysql:host=' . HOST . ';dbname=' . DBNAME,
                USER,
                PASSWORD,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $Exception) {
            // echo "Error conectando a la base de datos"
            //     . "<br>Message: " . $Exception->getMessage()
            //     . "<br>SQLSTATE error code: " . $Exception->getCode()
            //     . "<br>File: " . $Exception->getFile()
            //     . "<br>Line: " . $Exception->getLine();
            exit;
        }
        return $pdo;
    }
}
// echo $pdo;
$pdo = DB::connect();



?>