<?php
if (isset($_SESSION['id_usuario'])) {
    require ROOT . '/includes/conexao.php';
    $id = $_SESSION["id_usuario"];
    $resultado = $conn->query("SELECT * FROM clientes WHERE id = $id");
    if (!$resultado || $resultado->num_rows == 0) { echo "Erro ao obter dados do usuário"; exit(); }
    $usuario = $resultado->fetch_assoc();
}
?>
<?php require ROOT . '/components/navbar.php'; ?>

<div class="hero-banner">
  <div class="hero-content">
    <span class="eyebrow">Bem-vindo ao Openlab Hotel</span>
    <h1 class="display-4">Uma estadia<br>inesquecível</h1>
    <div class="gold-line"></div>
    <p class="lead mb-4">Conforto, elegância e hospitalidade em cada detalhe.</p>
    <a class="btn btn-primary btn-lg" href="<?= isset($_SESSION['id_usuario']) ? '/reservas/nova' : '/login' ?>">
      Faça uma Reserva
    </a>
  </div>
</div>

<div class="container">
  <div class="row" style="margin-bottom:5rem">
    <div class="col-md-4 fade-in" style="animation-delay:0.05s">
      <div class="card h-100">
        <div class="card-body">
          <div class="room-tag">Acomodação</div>
          <h5 class="card-title">Quartos Luxuosos</h5>
          <p class="card-text">Equipados com as melhores comodidades para uma estadia confortável e agradável.</p>
          <a href="/quartos" class="btn btn-primary btn-sm mt-2">Ver Quartos</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 fade-in" style="animation-delay:0.15s">
      <div class="card h-100">
        <div class="card-body">
          <div class="room-tag">Serviço</div>
          <h5 class="card-title">Atendimento 24h</h5>
          <p class="card-text">Serviço de quarto disponível 24 horas, 7 dias por semana para todas as suas necessidades.</p>
          <a href="#" class="btn btn-primary btn-sm mt-2">Saiba Mais</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 fade-in" style="animation-delay:0.25s">
      <div class="card h-100">
        <div class="card-body">
          <div class="room-tag">Localização</div>
          <h5 class="card-title">Localização Perfeita</h5>
          <p class="card-text">No coração da cidade, próximo aos principais pontos turísticos e de negócios.</p>
          <a href="#" class="btn btn-primary btn-sm mt-2">Como Chegar</a>
        </div>
      </div>
    </div>
  </div>

  <?php if (isset($_SESSION['id_usuario'])): ?>
  <div style="margin-bottom:5rem">
    <div class="section-heading"><h2>Suas Reservas Recentes</h2></div>
    <div class="row">
      <?php
        $id_cliente = $usuario['id'];
        $sql = "SELECT reservas.id, quartos.tipo_quarto, reservas.data_chegada, reservas.data_saida
                FROM reservas JOIN quartos ON reservas.id_quarto = quartos.id
                WHERE reservas.id_cliente = '$id_cliente'
                ORDER BY reservas.id DESC LIMIT 3";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0):
          while ($row = $result->fetch_assoc()):
      ?>
      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="card-body">
            <div class="room-tag"><?= ucfirst($row['tipo_quarto']) ?></div>
            <p class="card-text" style="margin-bottom:0.3rem">
              <span style="color:var(--cream-muted);font-size:0.68rem;letter-spacing:0.1em;text-transform:uppercase">Entrada</span><br>
              <?= $row['data_chegada'] ?>
            </p>
            <p class="card-text mt-2">
              <span style="color:var(--cream-muted);font-size:0.68rem;letter-spacing:0.1em;text-transform:uppercase">Saída</span><br>
              <?= $row['data_saida'] ?>
            </p>
            <a href="/reservas" class="btn btn-primary btn-sm mt-3">Ver Reservas</a>
          </div>
        </div>
      </div>
      <?php endwhile; else: ?>
      <div class="col-12">
        <p style="color:var(--cream-muted)">Você ainda não possui reservas. <a href="/reservas/nova">Faça uma agora</a>.</p>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>
</div>

<?php require ROOT . '/components/footer.php'; ?>
