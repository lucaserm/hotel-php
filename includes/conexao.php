<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "hotel";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>