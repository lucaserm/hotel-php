<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reservas - Hotel XYZ</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    integrity="sha512-3uDhfj3oM3Dud+ysN2+se+EYMHt3qJExTnIg9hej/KAHnbhxkEOlN8zjfZezm/vrYzFmHKTlkfejG9GP/gMkg=="
    crossorigin="anonymous" />
</head>

<body>
  <?php include('components/navbar.php'); ?>
  <div class="container">
    <h1 class="text-center">Hotel X</h1>
    <div class="card">
      <div class="card-body">
        <form action="valida_login.php" method="POST">
          <div class="form-group">
            <label for="username">Email:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder=" Digite seu nome de email"
              required>
          </div>
          <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
          </div>
          <p>Não tem uma conta? <a href="signin.php">Registre-se aqui</a>.</p>
          <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>