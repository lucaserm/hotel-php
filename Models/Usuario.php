<?php

class Usuario
{
  private $nome;
  private $sobrenome;
  private $tel;
  private $email;
  private $senha;

  public function trataTel($tel)
  {
    // Remove caracteres não numéricos
    $tel = preg_replace('/[^0-9]/', '', $tel);
    // Formata o número de telefone
    return $tel = '(' . substr($tel, 0, 2) . ') ' . substr($tel, 2, 5) . '-' . substr($tel, 7, 4);
  }
  public function nomeCompleto($nome, $sobrenome)
  {
    return $nome = $nome . " " . $sobrenome;
  }

  public function setUsuario($nome, $sobrenome, $tel, $email, $senha, $conn)
  {
    $tel = $this->trataTel($tel);
    $nome = $this->nomeCompleto($nome, $sobrenome);

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
    }
  }

  public function getUsuario($email, $senha, $conn)
  {

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
    } else {
      // As informações de login estão incorretas, exibe mensagem de erro
      $_SESSION['error'] = "Nome de usuário ou senha incorretos.";
      header("Location: ../login.php");
    }
  }

  public function updateUsuario($id_usuario, $nome, $tel, $email, $conn)
  {
    $tel = $this->trataTel($tel);

    // Atualizando o cliente no banco
    $sql = "
      UPDATE clientes 
      SET nome = '$nome', email = '$email', telefone = '$tel'
      WHERE id = '$id_usuario'";
    $resultado = $conn->query($sql);

    if ($resultado) {
      // Redireciona para a página de destino do sistema
      header("Location: perfil.php");
    }
  }
}

?>