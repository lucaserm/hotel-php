<?php
if (!isset($_SESSION['id_usuario'])) { header('Location: /login'); exit(); }
require ROOT . '/includes/conexao.php';
require ROOT . '/Models/Usuario.php';

$id = $_SESSION['id_usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = $_POST['nome']  ?? '';
    $tel   = $_POST['tel']   ?? '';
    $email = $_POST['email'] ?? '';
    if ($nome && $email) {
        $u = new Usuario();
        $u->updateUsuario($id, $nome, $tel, $email, $conn);
    }
    header('Location: /perfil');
    exit();
}

$resultado = $conn->query("SELECT * FROM clientes WHERE id = $id");
if (!$resultado || $resultado->num_rows == 0) { echo 'Erro ao obter dados do usuário'; exit(); }
$usuario = $resultado->fetch_assoc();
?>
<?php require ROOT . '/components/navbar.php'; ?>

<div class="container" style="padding-top:3rem;padding-bottom:3rem">
  <div class="page-header">
    <span class="sub">Conta</span>
    <h1>Meu Perfil</h1>
  </div>
  <div class="row">
    <div class="col-md-3 mb-4">
      <div class="card">
        <div class="card-body" style="padding:1.5rem 1rem">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
            <a class="nav-link active" data-toggle="pill" href="#tab-view"><i class="far fa-user fa-fw mr-2"></i>Ver Perfil</a>
            <a class="nav-link" data-toggle="pill" href="#tab-edit"><i class="fas fa-pen fa-fw mr-2"></i>Editar Perfil</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="tab-content fade-in">
        <div class="tab-pane fade show active" id="tab-view">
          <div class="card">
            <div class="card-header"><h3>Dados do Perfil</h3></div>
            <div class="card-body" style="padding:2.5rem">
              <div class="form-group">
                <label>Nome Completo</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($usuario['nome']) ?>" readonly>
              </div>
              <div class="form-group">
                <label>E-mail</label>
                <input type="email" class="form-control" value="<?= htmlspecialchars($usuario['email']) ?>" readonly>
              </div>
              <div class="form-group" style="margin-bottom:0">
                <label>Telefone</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($usuario['tel'] ?? '') ?>" readonly>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="tab-edit">
          <div class="card">
            <div class="card-header"><h3>Editar Perfil</h3></div>
            <div class="card-body" style="padding:2.5rem">
              <form action="/perfil" method="POST">
                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" class="form-control" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                </div>
                <div class="form-group">
                  <label>E-mail</label>
                  <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                </div>
                <div class="form-group" style="margin-bottom:2rem">
                  <label>Telefone</label>
                  <input type="text" class="form-control" name="tel" value="<?= htmlspecialchars($usuario['tel'] ?? '') ?>">
                </div>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require ROOT . '/components/footer.php'; ?>
