<?php
if (isset($_SESSION['id_usuario'])) {
    header('Location: /');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require ROOT . '/includes/conexao.php';
    require ROOT . '/Models/Usuario.php';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $usuario = new Usuario();
    $usuario->getUsuario($email, $senha, $conn);
    exit();
}

$feedback_error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>
<?php require ROOT . '/components/navbar.php'; ?>

<div class="auth-wrapper">
  <div class="auth-card fade-in">
    <div class="auth-logo">
      <h1>OPENLAB <span>HOTEL</span></h1>
      <span class="sub">Acesse sua conta</span>
    </div>
    <div class="card">
      <div class="card-body" style="padding:2.5rem">
        <form action="/login" method="POST">
          <?php if ($feedback_error): ?>
          <div class="alert alert-danger mb-4">
            <i class="fas fa-exclamation-circle mr-2"></i><?= htmlspecialchars($feedback_error) ?>
          </div>
          <?php endif; ?>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control <?= $feedback_error ? 'is-invalid' : '' ?>" name="email" placeholder="seu@email.com" required>
          </div>
          <div class="form-group" style="margin-bottom:2rem">
            <label>Senha</label>
            <input type="password" class="form-control <?= $feedback_error ? 'is-invalid' : '' ?>" name="senha" placeholder="••••••••" required>
          </div>
          <button type="submit" class="btn btn-primary btn-lg w-100">Entrar</button>
          <p style="text-align:center;margin-top:1.5rem;font-size:0.82rem;color:var(--cream-muted)">
            Não tem uma conta? <a href="/register">Registre-se</a>
          </p>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require ROOT . '/components/footer.php'; ?>
