<?php
// Conecta ao banco de dados
include "includes/conexao.php";
include "Models/Usuario.php";

// Inicia a sessão
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    
    // Verifica se o nome tem dados
    if (!$nome) {
      $_SESSION["nome_error"] = "Insira seu nome.";
      header("Location: ../signin.php");
    }

    // Verifica se o telefone tem dados
    if (!$tel) {
      $_SESSION["tel_error"] = "Insira seu telefone.";
      header("Location: ../signin.php");
    }

    // Verifica se o email tem dados
    if (!$email) {
        $_SESSION["email_error"] = "Insira seu email.";
        header("Location: ../signin.php");
    } else {
      $id_usuario = $_SESSION["id_usuario"];
      $usuario = new Usuario();
      $usuario-> updateUsuario($id_usuario, $nome, $tel, $email, $conn);
    }
}
exit();

?>