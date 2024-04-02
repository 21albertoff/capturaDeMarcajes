<?php

$env = parse_ini_file(__DIR__ . '/../.env');

$db_host = $env['DB_HOST'];
$db_name = $env['DB_NAME'];
$db_user = $env['DB_USER'];
$db_password = $env['DB_PASS'];

try {
    $conn = new PDO("sqlsrv:server=$db_host;database=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}




// try {
//     $nombre_usuario = comprobarUsuario($conn, "54142436E", "11915");
//     echo $nombre_usuario;
// } catch (Exception $e) {
//     echo $e->getMessage();
// }