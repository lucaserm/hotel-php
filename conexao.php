<?php
$servername = "localhost";
$username = "root";
$password = "!3zvLk2lCR8LNl-j";
$dbname = "hotel";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>