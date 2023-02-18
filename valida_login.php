<?php
session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém as informações de login do usuário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Conecta ao banco de dados
    include "conexao.php";

    // Consulta o banco de dados para verificar as informações de login
    $sql = "SELECT id, nome FROM clientes WHERE email = '$email' AND senha = '$senha'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        // As informações de login estão corretas, cria a sessão
        $row = $resultado->fetch_assoc();
        $_SESSION["id_usuario"] = $row["id"];
        $_SESSION["nome_usuario"] = $row["nome"];

        // Redireciona para a página de destino do sistema
        header("Location: index.php");
        exit();
    } else {
        // As informações de login estão incorretas, exibe mensagem de erro
        $erro = "Nome de usuário ou senha incorretos.";
    }

    $conn->close();
}
?>