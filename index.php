<?php
// Inclui a conexão com o banco de dados
include_once("conexao.php");

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
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reservas - Hotel XYZ</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    integrity="sha512-3uDhfj3oM3Dud+ysN2+se+EYMHt3qJExTnIg9hej/KAHnbhxkEOlN8zjfZezm/vrYzFmHKTlkfejG9GP/gMkg=="
    crossorigin="anonymous" />
</head>

<body>
  <?php include('components/navbar.php'); ?>
  <div class="container mt-4">
    <h1>Visualização de Reservas</h1>
    <hr>
    <!-- Tabela de Reservas -->
    <?php
    // Inclui a conexão com o banco de dados
    include_once("conexao.php");

    //Recupera as reservas existentes
    $id_cliente = $usuario["id"];
    $sql = "SELECT reservas.id, nome, data_chegada, data_saida, numero, preco_total 
            FROM reservas, clientes, quartos 
            WHERE id_cliente = '$id_cliente' 
            AND id_quarto = quartos.id ";
    $result = $conn->query($sql);

    //Exibe as reservas existentes em uma tabela
    if ($result -> num_rows > 0) {
      echo "<table class='table table-striped'>";
      echo "<thead>   
              <tr>
                <th>ID</th>
                <th>Nome do Hóspede</th>
                <th>Data de Entrada</th>
                <th>Data de Saída</th>
                <th>Número do Quarto</th>
                <th>Preço Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["data_chegada"] . "</td>";
        echo "<td>" . $row["data_saida"] . "</td>";
        echo "<td>" . $row["numero"] . "</td>";
        echo "<td>" . $row["preco_total"] . "</td>";
        echo "<td><a href='cancelar_reserva.php?id=" . $row["id"] . "'>Cancelar</a></td>";
        echo "</tr>";
      }
      echo "</tbody>
            </table>";
    } else {
      echo "Você ainda não possui reservas. <a href='processa_reserva.php'>Cadastros</a>";
    }

    $conn->close();
    ?>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>