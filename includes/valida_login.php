<?php

include '../Models/Usuario.php';

// Conecta ao banco de dados
include "conexao.php";

session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém as informações de login do usuário
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $usuario = new Usuario();
    $usuario->getUsuario($email, $senha, $conn);
}

exit();

?>