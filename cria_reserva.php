<?php

// Inclui a conexão com o banco de dados
include_once("includes/conexao.php");

// Verifica se o usuário está autenticado
session_start();
if (!isset($_SESSION["id_usuario"])) {
  header("Location: login.php");
  exit();
}

if (isset($_SESSION["success"])){
  $success = $_SESSION["success"];
  unset($_SESSION["success"]);
}

if (isset($_SESSION["error"])){
  $error = $_SESSION["error"];
  unset($_SESSION["error"]);
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

//Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //Obtém os valores do formulário
  $data_chegada = $_POST["data_chegada"];
  $data_saida = $_POST["data_saida"];
  $num_hospedes = $_POST["num_hospedes"];
  $tipo_quarto = $_POST["tipo_quarto"];
  $numero_quarto = $_POST["numero_quarto"];

  //Verifica se o quarto está disponível
  $sql = "SELECT quartos.id, preco 
          FROM quartos, reservas
          WHERE numero = '$numero_quarto'
          AND id_quarto = quartos.id
          AND (
            (data_chegada <= '$data_chegada' AND data_saida >= '$data_chegada') 
            OR 
            (data_chegada <= '$data_saida' AND data_saida >= '$data_saida')
          )";

  $result = $conn->query($sql);
  if ($result -> num_rows > 0) {
    //Calcula o preço total da reserva
    $row = $result->fetch_assoc();
    $id_quarto = $row["id"];
    $preco_noite = $row["preco"];
    $data_chegada_obj = new DateTime($data_chegada);
    $data_saida_obj = new DateTime($data_saida);
    $intervalo = $data_chegada_obj->diff($data_saida_obj);
    $num_noites = $intervalo->format("%a");
    $preco_total = $num_noites * $preco_noite;

    //Insere a reserva no banco de dados
    $id_cliente = $usuario['id'];
    $sql = "INSERT INTO reservas (id, id_cliente, id_quarto, data_chegada, data_saida, num_hospedes, preco_total) VALUES
    (default, '$id_cliente', '$id_quarto', '$data_chegada', '$data_saida', '$num_hospedes', '$preco_total')";
    if ($conn->query($sql) === TRUE) {
      //Atualiza o status do quarto para "ocupado"
      $sql = "UPDATE reservas SET status = 'ocupado' WHERE id_quarto = '$id_quarto'";
      if ($conn->query($sql) === TRUE) {
      echo "Reserva efetuada com sucesso!";
      } else {
      echo "Erro ao atualizar o status do quarto: " . $conn->error;
      }
    } else {
    echo "Erro ao inserir a reserva: " . $conn->error;
    }
  } else {
    $_SESSION["error"] = "Quarto reservado ou ocupado nesta data.";
    header("Location: cria_reserva.php");
    exit();
  }
  $_SESSION["success"] = "Reserva feita com sucesso.";
  header("Location: cria_reserva.php");
  exit();
}
?>

<?php include('components/navbar.php'); ?>
<div class="container mt-3">
  <h1 class="text-center mb-5">Cadastro de Reservas</h1>
  <div class="card">
    <div class="card-body">
      <form action="cria_reserva.php" method="POST">
        <?php if (!empty($success)) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $success; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php } ?>
        <?php if (!empty($error)) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $error; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php } ?>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="data_entrada">Data de Entrada:</label>
            <input type="date" class="form-control" name="data_chegada" required>
          </div>

          <div class="form-group col-md-6">
            <label for="data_saida">Data de Saída:</label>
            <input type="date" class="form-control" name="data_saida" required>
          </div>
        </div>

        <div class="form-group">
          <label for="quarto">Número do quarto:</label>
          <input type="number" class="form-control" name="numero_quarto" required>
        </div>

        <div class="form-group">
          <label for="num_hospedes">Número de hóspedes:</label>
          <input class="form-control" type="number" id="num_hospedes" name="num_hospedes" min="1" max="4" required>
        </div>

        <div class="form-group">
          <label for="quarto">Tipo de Quarto:</label>
          <select class="form-control" id="tipo_quarto" name="tipo_quarto" required>
            <option value="standard">Standard</option>
            <option value="deluxe">Deluxe</option>
            <option value="suite">Suíte</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </form>
    </div>
  </div>
</div>
<?php include('components/footer.php'); ?>