<?php
// Inclui a conexão com o banco de dados
include_once("includes/conexao.php");

// Verifica se o usuário está autenticado
session_start();
if (!isset($_SESSION["id_usuario"])) {
  header("Location: login.php");
  exit();
}

// Obtém os dados do usuário a partir do seu ID
$id = $_SESSION["id_usuario"];
$sql = "SELECT * FROM clientes WHERE id = $id";
$resultado = $conn->query($sql);
if (!$resultado || $resultado->num_rows == 0) {
    echo "Erro ao obter dados do usuário";
    exit();
}
$usuario = $resultado->fetch_assoc();
?>

<?php include_once("components/navbar.php"); ?>

<div class="container mt-5" style="min-height: 66vh;">
  <div class="row justify-content-center">
    <div class="col-md-2.5">
      <div class="card">
        <div class="card-header">
          <h3 class="text-center">Opções</h3>
        </div>
        <div class="card-body">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-see-profile-tab" data-toggle="pill" href="#v-pills-see-profile"
              role="tab" aria-controls="v-pills-see-profile" aria-selected="true">Ver perfil</a>
            <a class="nav-link" id="v-pills-edit-profile-tab" data-toggle="pill" href="#v-pills-edit-profile" role="tab"
              aria-controls="v-pills-edit-profile" aria-selected="false">Editar perfil</a>
            <a class="nav-link" id="v-pills-edit-password-tab" data-toggle="pill" href="#v-pills-edit-password"
              role="tab" aria-controls="v-pills-edit-password" aria-selected="false">Editar senha</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab"
              aria-controls="v-pills-settings" aria-selected="false">Settings</a>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-content col-md-8" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-see-profile" role="tabpanel"
        aria-labelledby="v-pills-see-profile-tab">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Perfil do Usuário</h3>
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>"
                  readonly>
              </div>
              <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email"
                  value="<?php echo $usuario['email']; ?>" readonly>
              </div>
              <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone"
                  value="<?php echo $usuario['telefone']; ?>" readonly>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-edit-profile" role="tabpanel" aria-labelledby="v-pills-edit-profile-tab">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Editar perfil</h3>
          </div>
          <div class="card-body">
            <form action="atualiza_usuario.php" method="POST">
              <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>">
              </div>
              <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email"
                  value="<?php echo $usuario['email']; ?>">
              </div>
              <div class="form-group">
                <label for="tel">Telefone:</label>
                <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $usuario['telefone']; ?>">
              </div>
              <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-edit-password" role="tabpanel" aria-labelledby="v-pills-edit-password-tab">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Editar senha</h3>
          </div>
          <div class="card-body">
            <form action="atualiza_usuario.php" method="POST">
              <div class="form-group">
                <label for="prev_password">Senha Antiga:</label>
                <input type="text" class="form-control" id="prev_password" name="prev_password"
                  placeholder="Insira sua senha atual">
              </div>
              <div class=" form-group">
                <label for="new_password">Nova senha:</label>
                <input type="text" class="form-control" id="new_password" name="new_password"
                  placeholder="Insira sua nova senha">

              </div>
              <div class=" form-group">
                <label for="confirm_password">Confirma nova senha:</label>
                <input type="text" class="form-control" id="confirm_password" name="confirm_password"
                  placeholder="Confirme sua nova senha">
              </div>
              <button type=" submit" class="btn btn-primary">Atualizar</button>
            </form>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...
      </div>
    </div>

  </div>
</div>

<?php include('components/footer.php'); ?>