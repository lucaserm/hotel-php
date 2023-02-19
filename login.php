<?php include('components/navbar.php'); ?>
<div class="container mt-3" style="min-height: 70vh;">
  <h1 class="text-center">Openlab Hotel</h1>
  <div class="card">
    <div class="card-body">
      <form action="includes/valida_login.php" method="POST">
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
<?php include('components/footer.php'); ?>