<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Openlab</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    integrity="sha512-3uDhfj3oM3Dud+ysN2+se+EYMHt3qJExTnIg9hej/KAHnbhxkEOlN8zjfZezm/vrYzFmHKTlkfejG9GP/gMkg=="
    crossorigin="anonymous" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Hotel Reservas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class='nav-item'><span class='nav-link'>I</span></li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class='nav-item'><span class='nav-link'>I</span></li>
        <li class="nav-item">
          <a class="nav-link" href="quartos_disponiveis.php">Quartos</a>
        </li>
        <li class='nav-item'><span class='nav-link'>I</span></li>
        <li class="nav-item">
          <a class="nav-link" href="busca_reserva.php">Minhas Reservas</a>
        </li>
        <li class='nav-item'><span class='nav-link'>I</span></li>
        <li class="nav-item">
          <a class="nav-link" href="cria_reserva.php">Reserve Aqui</a>
        </li>
      </ul>
      <?php
      // Inclui a conexão com o banco de dados
      include_once("./includes/conexao.php");

      // Verifica se o usuário está autenticado
      if (!isset($_SESSION["id_usuario"])) {
        echo "
        <ul class='navbar-nav'>
          <li class='nav-item'>
            <a class='nav-link' href='login.php'>Login</a>
          </li>
          <li class='nav-item'><span class='nav-link'>I</span></li>
          <li class='nav-item'>
            <a class='nav-link' href='signin.php'>Registrar</a>
          </li>
        </ul>
        ";
      } else {
        echo "
        <ul class='navbar-nav'>
          <li class='nav-item'>
            <a class='nav-link' href='perfil.php'>Perfil</a>
          </li>
          <li class='nav-item'><span class='nav-link'>I</span></li>
          <li class='nav-item'>
            <a class='nav-link' href='logout.php'>Logout</a>
          </li>
        </ul>
        ";
      }
      ?>
    </div>
  </nav>