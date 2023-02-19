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

<?php include('components/navbar.php'); ?>
<div class="container mt-4" style="min-height: 66vh;">
  <h1>Visualização de Reservas</h1>
  <hr>
  <!-- Tabela de Reservas -->
  <?php
    // Inclui a conexão com o banco de dados
    include_once("includes/conexao.php");

    //Recupera as reservas existentes
    $id_cliente = $usuario["id"];
    $sql = "SELECT reservas.id, nome, data_chegada, data_saida, numero, preco_total 
            FROM reservas, clientes, quartos 
            WHERE id_cliente = '$id_cliente' 
            AND id_quarto = quartos.id 
            AND id_cliente = clientes.id";
    $result = $conn->query($sql);

    //Exibe as reservas existentes em uma tabela
    if ($result -> num_rows > 0) {
      echo "<table class='table table-striped'>";
      echo "<thead>   
              <tr>
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
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["data_chegada"] . "</td>";
        echo "<td>" . $row["data_saida"] . "</td>";
        echo "<td>" . $row["numero"] . "</td>";
        echo "<td> R$" . $row["preco_total"] . "</td>";
        echo "<td><a href='cancelar_reserva.php?id=" . $row["id"] . "'>Cancelar</a></td>";
        echo "</tr>";
      }
      echo "</tbody>
            </table>";
    } else {
      echo "Você ainda não possui reservas. <a href='cria_reserva.php'>Cadastros</a>";
    }

    $conn->close();
    ?>
</div>
<?php include('components/footer.php'); ?>