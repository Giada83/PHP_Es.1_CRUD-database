<?php
// DATABASE CONNECTION
$host = 'localhost';
$db = 'db_users_test';
$user = 'root';
$pass = 'password';

// CON COMANDY MYSQL
// $db_connection = "mysql_connect($host, $user, $pass);
// mysql_select_db($db,$db_connection)";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $db_connection = new PDO("mysql:host=$host;dbname=$db", $user, $pass, $options);
    // echo "Connessione al db avvenuta";
} catch (PDOException $err) {
    echo "Si è verificato un problema tecnico: " . $err->getMessage();
    exit;
};
// il try/catch sostituisce queste due stringhe di codice:
// $connection = "mysql:host=$host;dbname=$db";
// $pdo = new PDO($connection, $user, $pass, $options);
