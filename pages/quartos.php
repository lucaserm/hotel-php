<?php
if (isset($_SESSION['id_usuario'])) {
    require ROOT . '/includes/conexao.php';
    $id = $_SESSION["id_usuario"];
    $resultado = $conn->query("SELECT * FROM clientes WHERE id = $id");
    if ($resultado && $resultado->num_rows > 0) $usuario = $resultado->fetch_assoc();
}
?>
<?php require ROOT . '/components/navbar.php'; ?>

<div class="container" style="padding-top:3rem;padding-bottom:3rem">
  <div class="page-header">
    <span class="sub">Acomodações</span>
    <h1>Nossos Quartos</h1>
  </div>

  <div class="card fade-in mb-5">
    <div class="card-body" style="padding:2rem 2.5rem">
      <form action="#" method="POST">
        <div class="form-row align-items-end">
          <div class="form-group col-md-3">
            <label>Check-in</label>
            <input type="date" class="form-control" name="checkin_date">
          </div>
          <div class="form-group col-md-3">
            <label>Check-out</label>
            <input type="date" class="form-control" name="checkout_date">
          </div>
          <div class="form-group col-md-2">
            <label>Adultos</label>
            <select class="form-control" name="adults">
              <option>1</option><option selected>2</option><option>3</option><option>4</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label>Crianças</label>
            <select class="form-control" name="children">
              <option selected>0</option><option>1</option><option>2</option><option>3</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search mr-1"></i> Buscar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="section-heading"><h2>Disponibilidade</h2></div>

  <div class="row">
    <div class="col-md-4 mb-4 fade-in" style="animation-delay:0.05s">
      <div class="card h-100">
        <div class="card-body">
          <div class="room-tag">Standard</div>
          <h5 class="card-title">Quarto Standard</h5>
          <p class="card-text">Confortável e completo, ideal para estadias de trabalho ou lazer.</p>
          <div class="d-flex align-items-center justify-content-between mt-4">
            <span class="price-badge">R$ 200<small>/noite</small></span>
            <span class="badge-avail yes">Disponível</span>
          </div>
          <a href="/reservas/nova" class="btn btn-primary btn-sm w-100 mt-3">Reservar</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4 fade-in" style="animation-delay:0.15s">
      <div class="card h-100" style="border-color:rgba(196,163,90,0.35)">
        <div class="card-body">
          <div class="room-tag">Deluxe</div>
          <h5 class="card-title">Quarto Deluxe</h5>
          <p class="card-text">Amplo e sofisticado, com vista privilegiada e amenities premium.</p>
          <div class="d-flex align-items-center justify-content-between mt-4">
            <span class="price-badge">R$ 300<small>/noite</small></span>
            <span class="badge-avail yes">Disponível</span>
          </div>
          <a href="/reservas/nova" class="btn btn-primary btn-sm w-100 mt-3">Reservar</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4 fade-in" style="animation-delay:0.25s">
      <div class="card h-100">
        <div class="card-body">
          <div class="room-tag">Suíte</div>
          <h5 class="card-title">Suíte Luxo</h5>
          <p class="card-text">A experiência definitiva — espaço generoso, jacuzzi e serviço exclusivo.</p>
          <div class="d-flex align-items-center justify-content-between mt-4">
            <span class="price-badge">R$ 350<small>/noite</small></span>
            <span class="badge-avail no">Indisponível</span>
          </div>
          <button class="btn btn-secondary btn-sm w-100 mt-3" disabled>Indisponível</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require ROOT . '/components/footer.php'; ?>
