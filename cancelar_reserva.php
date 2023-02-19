<?php
// Inclui a conexão com o banco de dados
include_once("conexao.php");

// Verifica se o usuário está autenticado
session_start();
if (!isset($_SESSION["id_usuario"])) {
  header("Location: login.php");
  exit();
}

// Obtém os dados do usuário a partir do seu ID
$id = $_GET["id"];
$sql = "DELETE FROM reservas WHERE id = $id";
$resultado = $conn->query($sql);

header("Location: index.php");
exit();

?>