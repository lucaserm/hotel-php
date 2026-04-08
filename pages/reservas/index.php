<?php
if (!isset($_SESSION['id_usuario'])) { header('Location: /login'); exit(); }
require ROOT . '/includes/conexao.php';
$id = $_SESSION['id_usuario'];
$resultado = $conn->query("SELECT * FROM clientes WHERE id = $id");
if (!$resultado || $resultado->num_rows == 0) { echo 'Erro ao obter dados do usuário'; exit(); }
$usuario = $resultado->fetch_assoc();
?>
<?php require ROOT . '/components/navbar.php'; ?>

<div class="container" style="padding-top:3rem;padding-bottom:3rem">
  <div class="page-header">
    <span class="sub">Conta</span>
    <h1>Minhas Reservas</h1>
  </div>

  <?php
    $id_cliente = $usuario['id'];
    $sql = "SELECT reservas.id, clientes.nome, reservas.data_chegada, reservas.data_saida,
                   quartos.numero, quartos.tipo_quarto, reservas.preco_total
            FROM reservas
            JOIN clientes ON reservas.id_cliente = clientes.id
            JOIN quartos  ON reservas.id_quarto  = quartos.id
            WHERE reservas.id_cliente = '$id_cliente'
            ORDER BY reservas.id DESC";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0):
  ?>
  <div class="card fade-in">
    <div style="overflow-x:auto">
      <table class="table mb-0">
        <thead>
          <tr>
            <th>Hóspede</th><th>Tipo</th><th>Quarto</th>
            <th>Entrada</th><th>Saída</th><th>Total</th><th></th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['nome']) ?></td>
            <td><span class="room-tag" style="margin:0"><?= ucfirst($row['tipo_quarto']) ?></span></td>
            <td><?= $row['numero'] ?></td>
            <td><?= $row['data_chegada'] ?></td>
            <td><?= $row['data_saida'] ?></td>
            <td><span class="price-badge" style="font-size:1rem">R$ <?= number_format($row['preco_total'], 2, ',', '.') ?></span></td>
            <td>
              <form action="/reservas/cancelar" method="POST" onsubmit="return confirm('Confirmar cancelamento?')">
                <input type="hidden" name="id" value="<?= (int)$row['id'] ?>">
                <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
              </form>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php else: ?>
  <div class="card fade-in">
    <div class="card-body" style="text-align:center;padding:4rem 2rem">
      <i class="far fa-calendar-times" style="font-size:2.5rem;color:var(--cream-muted);margin-bottom:1.5rem;display:block"></i>
      <h3 style="font-size:1.2rem;margin-bottom:0.5rem">Nenhuma reserva encontrada</h3>
      <p style="color:var(--cream-muted);margin-bottom:2rem">Você ainda não possui reservas ativas.</p>
      <a href="/reservas/nova" class="btn btn-primary">Fazer uma Reserva</a>
    </div>
  </div>
  <?php endif; ?>
  <?php $conn->close(); ?>
</div>

<?php require ROOT . '/components/footer.php'; ?>
