<?php
$host = '127.0.0.1';
$port = 3306;
$user = 'root';
$password = 'root';
$dbname = 'sistema';

// Estabelecer conexão
$con = new mysqli($host, $user, $password, $dbname, $port);

// Verificar conexão
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>