<?php
// Conecta ao banco de dados
include "conexao.php";
include '../Models/Usuario.php';

session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirma_senha = $_POST["confirma_senha"];
    
    // Verifica se o nome tem dados
    if (!$nome) {
      $_SESSION["nome_error"] = "Insira seu nome.";
      header("Location: ../signin.php");
    }
    
    // Verifica se o sobrenome tem dados
    if (!$sobrenome) {
      $_SESSION["sobrenome_error"] = "Insira seu sobrenome.";
      header("Location: ../signin.php");
    }

    // Verifica se o telefone tem dados
    if (!$tel) {
      $_SESSION["tel_error"] = "Insira seu telefone.";
      header("Location: ../signin.php");
    }

    // Verifica se a senha tem dados
    if (!$senha) {
      $_SESSION["password_error"] = "Insira sua senha.";
      header("Location: ../signin.php");
    }
    
    // Verifica se a confirmação de senha tem dados
    if (!$confirma_senha) {
      $_SESSION["confirma_senha_error"] = "Insira a confirmação da sua senha.";
      header("Location: ../signin.php");
    }

    // Verifica se as senhas conferem
    if ($senha != $confirma_senha) {
      $_SESSION["password_error"] = "As senha não conferem.";
      header("Location: ../signin.php");
    }

    // Verifica se o email tem dados
    if (!$email) {
        $_SESSION["email_error"] = "Insira seu email.";
        header("Location: ../signin.php");
    } else {
        // Se tem, verifica na base se existe
        $sql = "SELECT id FROM clientes WHERE email = '$email'";
        $resultado = $conn->query($sql);
        if ($resultado->num_rows == 1) {
            $_SESSION["email_error"] = "Este email já está sendo utilizado.";
            header("Location: ../signin.php");
        } else {
            $usuario = new Usuario();
            $usuario->setUsuario($nome, $sobrenome, $tel, $email, $senha, $conn);
        }
    }
}
exit();

?>