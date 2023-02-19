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
    <div class="col-md-6">
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
              <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario['email']; ?>"
                readonly>
            </div>
            <div class="form-group">
              <label for="telefone">Telefone:</label>
              <input type="text" class="form-control" id="telefone" name="telefone"
                value="<?php echo $usuario['telefone']; ?>" readonly>
            </div>
            <!-- <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento"
                  value="<?php echo $usuario['data_nascimento']; ?>" readonly>
              </div> -->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('components/footer.php'); ?>