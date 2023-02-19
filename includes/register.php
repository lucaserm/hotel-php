<?php
// Conecta ao banco de dados
include "conexao.php";

session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém as informações de registro do usuário
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirma_senha = $_POST["confirma_senha"];
        
    if(!$nome){
        $_SESSION["nome_error"] = "Insira seu nome.";
        header("Location: ../signin.php");
    }
    
    if(!$sobrenome){
        $_SESSION["sobrenome_error"] = "Insira seu sobrenome.";
        header("Location: ../signin.php");
    }
    
    if(!$tel){
        $_SESSION["tel_error"] = "Insira seu telefone.";
        header("Location: ../signin.php");
    }
    
    if(!$senha){
        $_SESSION["password_error"] = "Insira sua senha.";
        header("Location: ../signin.php");
    }
    
    if(!$confirma_senha){
        $_SESSION["confirma_senha_error"] = "Insira a confirmação da sua senha.";
        header("Location: ../signin.php");
    }
    
    // Verifica se as senhas conferem
    if($senha != $confirma_senha) {
        $_SESSION["password_error"] = "As senha não conferem.";
        header("Location: ../signin.php");
    }

    // Remove caracteres não numéricos
    $tel = preg_replace('/[^0-9]/', '', $tel);
    // Formata o número de telefone
    $tel = '(' . substr($tel, 0, 2) . ') ' . substr($tel, 2, 4) . '-' . substr($tel, 6, 4);
    
    if(!$email){
        $_SESSION["email_error"] = "Insira seu email.";
        header("Location: ../signin.php");
    } else{
        // Verifica se há algum outro usuário com o mesmo email
        $sql = "SELECT id FROM clientes WHERE email = '$email'";
        $resultado = $conn->query($sql);
    }
    if($resultado->num_rows == 1){
        $_SESSION["email_error"] = "Este email já está sendo utilizado.";
        header("Location: ../signin.php");
    } else {
        if(!$email) return;
        $nome = $nome . " " . $sobrenome;
        // Inserindo novo cliente no banco
        $sql = "INSERT INTO clientes VALUES (default, '$nome', '$email', '$senha', '$tel')";
        $resultado = $conn->query($sql);
        // Consulta o banco de dados para verificar as informações de login
        $sql = "SELECT id, nome FROM clientes WHERE email = '$email' AND senha = '$senha'";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            // As informações de login estão corretas, cria a sessão
            $row = $resultado->fetch_assoc();
            $_SESSION["id_usuario"] = $row["id"];
            $_SESSION["nome_usuario"] = $row["nome"];

            // Redireciona para a página de destino do sistema
            header("Location: ../index.php");
            exit();
        }
    }
}
    exit();
?>