<?php
  session_start();
  if (isset($_SESSION['error'])) {
    $feedback_error = $_SESSION['error'];
    unset($_SESSION['error']);
  }
?>
<?php include('components/navbar.php'); ?>
<div class="container mt-3" style="min-height: 70vh;">
  <h1 class="text-center">Openlab Hotel</h1>
  <br>
  <div class="card">
    <div class="card-body">
      <form action="includes/valida_login.php" method="POST">
        <div class="form-group">
          <label for="username">Email:</label>
          <input type="text" class="form-control <?php echo !empty($feedback_error) ? 'is-invalid' : ''; ?>" id="email"
            name="email" placeholder=" Digite seu nome de email" required>
          <?php if (!empty($feedback_error)) { ?>
          <div class="invalid-feedback"><?php echo $feedback_error; ?></div>
          <?php } ?>
        </div>
        <div class="form-group">
          <label for="senha">Senha:</label>
          <input type="password" class="form-control <?php echo !empty($feedback_error) ? 'is-invalid' : ''; ?>"
            id="senha" name="senha" placeholder="Digite sua senha" required>
          <?php if (!empty($feedback_error)) { ?>
          <div class="invalid-feedback"><?php echo $feedback_error; ?></div>
          <?php } ?>
        </div>
        <p>Não tem uma conta? <a href="signin.php">Registre-se aqui</a>.</p>
        <button type="submit" class="btn btn-primary">Entrar</button>
      </form>
    </div>
  </div>
</div>
<?php include('components/footer.php'); ?>