<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Openlab Hotel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<?php
  require_once ROOT . '/includes/conexao.php';
  $current = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  function nav_active($path) {
    global $current;
    return $current === $path ? 'style="color:var(--cream)!important"' : '';
  }
?>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="/">OPENLAB <span>HOTEL</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="nav-link" href="/" <?= nav_active('/') ?>>Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/quartos" <?= nav_active('/quartos') ?>>Quartos</a></li>
        <li class="nav-item"><a class="nav-link" href="/reservas" <?= nav_active('/reservas') ?>>Minhas Reservas</a></li>
        <li class="nav-item"><a class="nav-link" href="/reservas/nova" <?= nav_active('/reservas/nova') ?>>Reserve</a></li>
      </ul>
      <?php if (!isset($_SESSION["id_usuario"])): ?>
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="/login">Entrar</a></li>
          <li class="nav-item ml-2"><a class="btn btn-primary btn-sm" href="/register">Registrar</a></li>
        </ul>
      <?php else: ?>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
              <i class="far fa-user-circle mr-1"></i> <?= htmlspecialchars($usuario["nome"] ?? '') ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="/perfil"><i class="far fa-user fa-fw mr-2"></i>Perfil</a>
              <a class="dropdown-item" href="/reservas"><i class="far fa-calendar fa-fw mr-2"></i>Reservas</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt fa-fw mr-2"></i>Sair</a>
            </div>
          </li>
        </ul>
      <?php endif; ?>
    </div>
  </nav>
