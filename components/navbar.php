<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Hotel Reservas</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Quartos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="registro_reserva.php">Reservas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contato</a>
      </li>
    </ul>
    <?php
      // Inclui a conexão com o banco de dados
      include_once("conexao.php");

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