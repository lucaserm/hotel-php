<?php
session_start();

if (isset($_SESSION['nome_error'])) {
  $nome_error = $_SESSION['nome_error'];
  unset($_SESSION['nome_error']);
}
if (isset($_SESSION['sobrenome_error'])) {
  $sobrenome_error = $_SESSION['sobrenome_error'];
  unset($_SESSION['sobrenome_error']);
}
if (isset($_SESSION['tel_error'])) {
  $tel_error = $_SESSION['tel_error'];
  unset($_SESSION['tel_error']);
}
if (isset($_SESSION['email_error'])) {
  $email_error = $_SESSION['email_error'];
  unset($_SESSION['email_error']);
}
if (isset($_SESSION['password_error'])) {
  $password_error = $_SESSION['password_error'];
  $confirm_password_error = $_SESSION['password_error'];
  unset($_SESSION['password_error']);
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Hotel X - Registro</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://kit.fontawesome.com/your_key_here.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php include('components/navbar.php'); ?>
  <div class="container">
    <h1 class="text-center">Registre-se no Hotel X</h1>
    <div class="card">
      <div class="card-body">
        <form method="POST" action="register.php">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nome">Nome:</label>
              <input type="text" class="form-control <?php echo !empty($nome_error) ? 'is-invalid' : ''; ?>" id="nome"
                name="nome" placeholder="Digite seu nome" value="<?php echo !empty($nome) ? $nome : ''; ?>">
              <?php if (!empty($nome_error)) { ?>
              <div class="invalid-feedback"><?php echo $nome_error; ?></div>
              <?php } ?>
            </div>
            <div class="form-group col-md-6">
              <label for="sobrenome">Sobrenome:</label>
              <input type="text" class="form-control <?php echo !empty($sobrenome_error) ? 'is-invalid' : ''; ?>"
                id="sobrenome" name="sobrenome" placeholder="Digite seu sobrenome"
                value="<?php echo !empty($sobrenome) ? $sobrenome : ''; ?>">
              <?php if (!empty($sobrenome_error)) { ?>
              <div class="invalid-feedback"><?php echo $sobrenome_error; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label for="email">Endereço de e-mail:</label>
            <input type="email" class="form-control <?php echo !empty($email_error) ? 'is-invalid' : ''; ?>" id="email"
              name="email" placeholder="Digite seu endereço de e-mail"
              value="<?php echo !empty($email) ? $email : ''; ?>">
            <?php if (!empty($email_error)) { ?>
            <div class="invalid-feedback"><?php echo $email_error; ?></div>
            <?php } ?>
          </div>
          <div class="form-group">
            <label for="tel">Telefone:</label>
            <input type="tel" class="form-control <?php echo !empty($tel_error) ? 'is-invalid' : ''; ?>" id="tel"
              name="tel" placeholder="Digite seu telefone" value="<?php echo !empty($tel) ? $tel : ''; ?>">
            <?php if (!empty($tel_error)) { ?>
            <div class="invalid-feedback"><?php echo $tel_error; ?></div>
            <?php } ?>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="senha">Senha:</label>
              <input type="password" class="form-control <?php echo !empty($password_error) ? 'is-invalid' : ''; ?>"
                id="senha" name="senha" placeholder="Digite sua senha">
              <?php if (!empty($password_error)) { ?>
              <div class="invalid-feedback"><?php echo $password_error; ?></div>
              <?php } ?>
            </div>
            <div class="form-group col-md-6">
              <label for="confirma_senha">Confirmar senha:</label>
              <input type="password"
                class="form-control <?php echo !empty($confirm_password_error) ? 'is-invalid' : ''; ?>"
                id="confirma_senha" name="confirma_senha" placeholder="Confirme sua senha">
              <?php if (!empty($confirm_password_error)) { ?>
              <div class="invalid-feedback"><?php echo $confirm_password_error; ?></div>
              <?php } ?>
            </div>
          </div>
          <p>Já tem uma conta? <a href="login.php">Faça login aqui</a>.</p>
          <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus"></i> Registrar</button>
        </form>
      </div>
    </div>
  </div><br>
</body>

</html>