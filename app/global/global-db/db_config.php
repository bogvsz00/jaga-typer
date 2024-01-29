<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "jagatyper2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}
?>