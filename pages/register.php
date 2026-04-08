<?php
if (isset($_SESSION['id_usuario'])) {
    header('Location: /');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require ROOT . '/includes/conexao.php';
    require ROOT . '/Models/Usuario.php';

    $nome          = $_POST['nome']          ?? '';
    $sobrenome     = $_POST['sobrenome']     ?? '';
    $tel           = $_POST['tel']           ?? '';
    $email         = $_POST['email']         ?? '';
    $senha         = $_POST['senha']         ?? '';
    $confirma      = $_POST['confirma_senha'] ?? '';

    if (!$nome)     { $_SESSION['nome_error']     = 'Insira seu nome.';     header('Location: /register'); exit(); }
    if (!$sobrenome){ $_SESSION['sobrenome_error'] = 'Insira seu sobrenome.'; header('Location: /register'); exit(); }
    if (!$tel)      { $_SESSION['tel_error']      = 'Insira seu telefone.'; header('Location: /register'); exit(); }
    if (!$senha)    { $_SESSION['password_error'] = 'Insira sua senha.';    header('Location: /register'); exit(); }
    if (!$confirma) { $_SESSION['password_error'] = 'Confirme sua senha.';  header('Location: /register'); exit(); }
    if ($senha !== $confirma) { $_SESSION['password_error'] = 'As senhas não conferem.'; header('Location: /register'); exit(); }
    if (!$email)    { $_SESSION['email_error']    = 'Insira seu email.';    header('Location: /register'); exit(); }

    $stmt = $conn->prepare('SELECT id FROM clientes WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['email_error'] = 'Este email já está sendo utilizado.';
        header('Location: /register');
        exit();
    }

    $usuario = new Usuario();
    $usuario->setUsuario($nome, $sobrenome, $tel, $email, $senha, $conn);
    exit();
}

$nome_error     = $_SESSION['nome_error']     ?? null; unset($_SESSION['nome_error']);
$sobrenome_error= $_SESSION['sobrenome_error']?? null; unset($_SESSION['sobrenome_error']);
$tel_error      = $_SESSION['tel_error']      ?? null; unset($_SESSION['tel_error']);
$email_error    = $_SESSION['email_error']    ?? null; unset($_SESSION['email_error']);
$password_error = $_SESSION['password_error'] ?? null; unset($_SESSION['password_error']);
?>
<?php require ROOT . '/components/navbar.php'; ?>

<div class="auth-wrapper" style="align-items:flex-start;padding-top:3rem">
  <div class="auth-card fade-in" style="max-width:560px">
    <div class="auth-logo">
      <h1>OPENLAB <span>HOTEL</span></h1>
      <span class="sub">Crie sua conta</span>
    </div>
    <div class="card">
      <div class="card-body" style="padding:2.5rem">
        <form method="POST" action="/register">
          <?php if ($password_error): ?>
          <div class="alert alert-danger mb-4"><i class="fas fa-exclamation-circle mr-2"></i><?= htmlspecialchars($password_error) ?></div>
          <?php endif; ?>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Nome</label>
              <input type="text" class="form-control <?= $nome_error ? 'is-invalid' : '' ?>" name="nome" placeholder="João">
              <?php if ($nome_error): ?><div class="invalid-feedback"><?= htmlspecialchars($nome_error) ?></div><?php endif; ?>
            </div>
            <div class="form-group col-md-6">
              <label>Sobrenome</label>
              <input type="text" class="form-control <?= $sobrenome_error ? 'is-invalid' : '' ?>" name="sobrenome" placeholder="Silva">
              <?php if ($sobrenome_error): ?><div class="invalid-feedback"><?= htmlspecialchars($sobrenome_error) ?></div><?php endif; ?>
            </div>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control <?= $email_error ? 'is-invalid' : '' ?>" name="email" placeholder="seu@email.com">
            <?php if ($email_error): ?><div class="invalid-feedback"><?= htmlspecialchars($email_error) ?></div><?php endif; ?>
          </div>
          <div class="form-group">
            <label>Telefone</label>
            <input type="tel" class="form-control <?= $tel_error ? 'is-invalid' : '' ?>" name="tel" placeholder="(11) 99999-9999" maxlength="11">
            <?php if ($tel_error): ?><div class="invalid-feedback"><?= htmlspecialchars($tel_error) ?></div><?php endif; ?>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Senha</label>
              <input type="password" class="form-control" name="senha" placeholder="••••••••">
            </div>
            <div class="form-group col-md-6">
              <label>Confirmar senha</label>
              <input type="password" class="form-control" name="confirma_senha" placeholder="••••••••">
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-lg w-100 mt-2">Criar Conta</button>
          <p style="text-align:center;margin-top:1.5rem;font-size:0.82rem;color:var(--cream-muted)">
            Já tem uma conta? <a href="/login">Faça login</a>
          </p>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require ROOT . '/components/footer.php'; ?>
