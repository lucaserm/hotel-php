<?php
if (!isset($_SESSION['id_usuario'])) { header('Location: /login'); exit(); }
require ROOT . '/includes/conexao.php';

$id = $_SESSION['id_usuario'];
$resultado = $conn->query("SELECT * FROM clientes WHERE id = $id");
if (!$resultado || $resultado->num_rows == 0) { echo 'Erro ao obter dados do usuário'; exit(); }
$usuario = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data_chegada = $_POST['data_chegada'];
    $data_saida   = $_POST['data_saida'];
    $num_hospedes = (int)$_POST['num_hospedes'];
    $id_quarto    = (int)$_POST['id_quarto'];

    $check = $conn->prepare(
        'SELECT id, preco FROM quartos
         WHERE id = ?
         AND id NOT IN (SELECT id_quarto FROM reservas WHERE data_chegada < ? AND data_saida > ?)'
    );
    $check->bind_param('iss', $id_quarto, $data_saida, $data_chegada);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows == 0) {
        $_SESSION['error'] = 'Este quarto não está mais disponível. Escolha outro.';
        header('Location: /reservas/nova'); exit();
    }

    $row         = $result->fetch_assoc();
    $num_noites  = (new DateTime($data_chegada))->diff(new DateTime($data_saida))->days;
    $preco_total = $num_noites * $row['preco'];
    $id_cliente  = $usuario['id'];

    $ins = $conn->prepare(
        'INSERT INTO reservas (id_cliente, id_quarto, data_chegada, data_saida, num_hospedes, preco_total)
         VALUES (?, ?, ?, ?, ?, ?)'
    );
    $ins->bind_param('iissid', $id_cliente, $id_quarto, $data_chegada, $data_saida, $num_hospedes, $preco_total);
    if ($ins->execute()) {
        $_SESSION['success'] = 'Reserva confirmada com sucesso!';
    } else {
        $_SESSION['error'] = 'Erro ao criar reserva. Tente novamente.';
    }
    header('Location: /reservas/nova'); exit();
}

$success = $_SESSION['success'] ?? null; unset($_SESSION['success']);
$error   = $_SESSION['error']   ?? null; unset($_SESSION['error']);
$conn->close();
?>
<?php require ROOT . '/components/navbar.php'; ?>

<div class="container" style="max-width:700px;padding-top:3rem;padding-bottom:4rem">
  <div class="page-header">
    <span class="sub">Reservas</span>
    <h1>Nova Reserva</h1>
  </div>

  <?php if ($success): ?>
  <div class="alert alert-success alert-dismissible fade show mb-4">
    <i class="fas fa-check-circle mr-2"></i><?= htmlspecialchars($success) ?>
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
  </div>
  <?php endif; ?>
  <?php if ($error): ?>
  <div class="alert alert-danger alert-dismissible fade show mb-4">
    <i class="fas fa-exclamation-circle mr-2"></i><?= htmlspecialchars($error) ?>
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
  </div>
  <?php endif; ?>

  <!-- Step 1 -->
  <div class="card fade-in mb-3">
    <div class="card-body" style="padding:2rem 2.5rem">
      <p class="step-label">Passo 1 — Escolha as datas</p>
      <div class="form-row">
        <div class="form-group col-md-5">
          <label>Check-in</label>
          <input type="date" class="form-control" id="data_chegada" required>
        </div>
        <div class="form-group col-md-5">
          <label>Check-out</label>
          <input type="date" class="form-control" id="data_saida" required>
        </div>
        <div class="form-group col-md-2">
          <label>Hóspedes</label>
          <select class="form-control" id="num_hospedes">
            <option>1</option><option selected>2</option><option>3</option><option>4</option>
          </select>
        </div>
      </div>
      <p id="date-error" style="display:none;color:#e07070;font-size:0.82rem;margin-top:-0.5rem;margin-bottom:1rem"></p>
      <button type="button" class="btn btn-primary" id="btn-buscar" disabled>
        <i class="fas fa-search mr-2"></i>Ver Quartos Disponíveis
      </button>
    </div>
  </div>

  <!-- Step 2 -->
  <div id="step-rooms" style="display:none">
    <div id="rooms-loading" style="text-align:center;padding:2.5rem;display:none">
      <div class="spinner"></div>
      <p style="color:var(--cream-muted);margin-top:1rem;font-size:0.85rem">Buscando quartos disponíveis...</p>
    </div>
    <div id="rooms-list"></div>
    <div id="no-rooms" style="display:none">
      <div class="card">
        <div class="card-body" style="text-align:center;padding:3rem">
          <i class="far fa-calendar-times" style="font-size:2rem;color:var(--cream-muted);margin-bottom:1rem;display:block"></i>
          <h3 style="font-size:1.1rem;margin-bottom:0.5rem">Nenhum quarto disponível</h3>
          <p style="color:var(--cream-muted)">Tente um período diferente.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Step 3 -->
  <form action="/reservas/nova" method="POST" id="form-reserva" style="display:none">
    <input type="hidden" name="data_chegada" id="f_chegada">
    <input type="hidden" name="data_saida"   id="f_saida">
    <input type="hidden" name="num_hospedes" id="f_hospedes">
    <input type="hidden" name="id_quarto"    id="f_quarto">
    <div class="card mt-3 fade-in">
      <div class="card-body" style="padding:1.75rem 2.5rem">
        <p class="step-label" style="margin-bottom:1rem">Passo 3 — Confirme sua reserva</p>
        <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap:1rem">
          <div>
            <p style="margin:0;font-size:0.75rem;color:var(--cream-muted);text-transform:uppercase;letter-spacing:0.08em">Quarto</p>
            <p style="margin:0;font-weight:600" id="summary-room"></p>
          </div>
          <div>
            <p style="margin:0;font-size:0.75rem;color:var(--cream-muted);text-transform:uppercase;letter-spacing:0.08em">Período</p>
            <p style="margin:0;font-weight:500;font-size:0.9rem" id="summary-dates"></p>
          </div>
          <div>
            <p style="margin:0;font-size:0.75rem;color:var(--cream-muted);text-transform:uppercase;letter-spacing:0.08em">Total</p>
            <p style="margin:0;font-size:1.4rem;font-weight:700;color:var(--gold);letter-spacing:-0.02em" id="summary-price"></p>
          </div>
          <button type="submit" class="btn btn-primary"><i class="fas fa-check mr-2"></i>Confirmar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<style>
.step-label{font-size:.68rem;font-weight:600;letter-spacing:.14em;text-transform:uppercase;color:var(--gold);margin-bottom:1.25rem}
.room-card{cursor:pointer;margin-bottom:.75rem;transition:border-color .2s,transform .2s,box-shadow .2s}
.room-card:hover{border-color:rgba(196,163,90,.5)!important;transform:translateY(-2px);box-shadow:0 12px 40px rgba(0,0,0,.3)}
.room-card.selected{border-color:var(--gold)!important;background:rgba(196,163,90,.06)!important}
.room-card .card-body{padding:1.5rem 2rem}
.room-indicator{width:20px;height:20px;border-radius:50%;border:2px solid var(--border);display:inline-flex;align-items:center;justify-content:center;transition:all .2s;flex-shrink:0}
.room-card.selected .room-indicator{border-color:var(--gold);background:var(--gold)}
.room-card.selected .room-indicator::after{content:'';width:6px;height:6px;border-radius:50%;background:var(--navy)}
.spinner{width:32px;height:32px;border:2px solid var(--border);border-top-color:var(--gold);border-radius:50%;animation:spin .7s linear infinite;margin:0 auto}
@keyframes spin{to{transform:rotate(360deg)}}
</style>

<script>
(function () {
  var chegadaEl = document.getElementById('data_chegada');
  var saidaEl   = document.getElementById('data_saida');
  var hospEl    = document.getElementById('num_hospedes');
  var btnBuscar = document.getElementById('btn-buscar');
  var dateError = document.getElementById('date-error');
  var stepRooms = document.getElementById('step-rooms');
  var roomsList = document.getElementById('rooms-list');
  var noRooms   = document.getElementById('no-rooms');
  var loading   = document.getElementById('rooms-loading');
  var formRes   = document.getElementById('form-reserva');

  var today = new Date().toISOString().split('T')[0];
  chegadaEl.min = saidaEl.min = today;

  function clearEl(el) { while (el.firstChild) el.removeChild(el.firstChild); }

  function validate() {
    var c = chegadaEl.value, s = saidaEl.value;
    if (!c || !s) { btnBuscar.disabled = true; dateError.style.display = 'none'; return; }
    if (s <= c) {
      dateError.textContent = 'A data de saída deve ser posterior à chegada.';
      dateError.style.display = 'block'; btnBuscar.disabled = true; return;
    }
    dateError.style.display = 'none'; btnBuscar.disabled = false;
  }

  chegadaEl.addEventListener('change', function () {
    if (this.value && (!saidaEl.value || saidaEl.value <= this.value)) {
      var d = new Date(this.value); d.setDate(d.getDate() + 1);
      saidaEl.value = d.toISOString().split('T')[0];
    }
    saidaEl.min = this.value; validate(); reset();
  });
  saidaEl.addEventListener('change', function () { validate(); reset(); });

  function reset() { stepRooms.style.display = formRes.style.display = 'none'; clearEl(roomsList); }

  function fmt(s) { var p = s.split('-'); return p[2]+'/'+p[1]+'/'+p[0]; }
  function brl(v) { return v.toLocaleString('pt-BR', {style:'currency',currency:'BRL'}); }

  function buildCard(q, nights) {
    var tipo = q.tipo_quarto.charAt(0).toUpperCase() + q.tipo_quarto.slice(1);
    var total = q.preco * nights;

    var card = document.createElement('div'); card.className = 'card room-card';
    var body = document.createElement('div'); body.className = 'card-body';
    var row  = document.createElement('div'); row.className = 'd-flex align-items-center justify-content-between';

    var left = document.createElement('div'); left.className = 'd-flex align-items-center'; left.style.gap = '1.25rem';
    var ind  = document.createElement('div'); ind.className = 'room-indicator';
    var info = document.createElement('div');
    var tag  = document.createElement('span'); tag.className = 'room-tag'; tag.style.marginBottom = '0.2rem'; tag.textContent = tipo;
    var name = document.createElement('p'); name.style.cssText = 'margin:0;font-weight:600;font-size:1rem'; name.textContent = 'Quarto ' + q.numero;
    info.appendChild(tag); info.appendChild(name); left.appendChild(ind); left.appendChild(info);

    var right = document.createElement('div'); right.style.textAlign = 'right';
    var pn = document.createElement('p'); pn.style.cssText = 'margin:0;font-size:.75rem;color:var(--cream-muted)'; pn.textContent = brl(q.preco) + '/noite';
    var tt = document.createElement('p'); tt.style.cssText = 'margin:0;font-size:1.25rem;font-weight:700;color:var(--gold);letter-spacing:-.02em'; tt.textContent = brl(total);
    var nt = document.createElement('p'); nt.style.cssText = 'margin:0;font-size:.72rem;color:var(--cream-muted)'; nt.textContent = nights + ' noite' + (nights > 1 ? 's' : '');
    right.appendChild(pn); right.appendChild(tt); right.appendChild(nt);

    row.appendChild(left); row.appendChild(right); body.appendChild(row); card.appendChild(body);
    card.addEventListener('click', function () { pick(card, q, nights, total); });
    return card;
  }

  function pick(card, q, nights, total) {
    document.querySelectorAll('.room-card').forEach(function (c) { c.classList.remove('selected'); });
    card.classList.add('selected');
    var tipo = q.tipo_quarto.charAt(0).toUpperCase() + q.tipo_quarto.slice(1);
    var c = chegadaEl.value, s = saidaEl.value;
    document.getElementById('f_chegada').value  = c;
    document.getElementById('f_saida').value    = s;
    document.getElementById('f_hospedes').value = hospEl.value;
    document.getElementById('f_quarto').value   = q.id;
    document.getElementById('summary-room').textContent  = tipo + ' \u2014 Quarto ' + q.numero;
    document.getElementById('summary-dates').textContent = fmt(c) + ' \u2192 ' + fmt(s) + ' (' + nights + ' noite' + (nights > 1 ? 's' : '') + ')';
    document.getElementById('summary-price').textContent = brl(total);
    formRes.style.display = 'block';
    formRes.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  btnBuscar.addEventListener('click', function () {
    var c = chegadaEl.value, s = saidaEl.value;
    stepRooms.style.display = 'block'; loading.style.display = 'block';
    noRooms.style.display = 'none'; clearEl(roomsList); formRes.style.display = 'none';

    fetch('/api/quartos?data_chegada=' + encodeURIComponent(c) + '&data_saida=' + encodeURIComponent(s))
      .then(function (r) { return r.json(); })
      .then(function (data) {
        loading.style.display = 'none';
        if (!data.quartos || !data.quartos.length) { noRooms.style.display = 'block'; return; }
        var nights = Math.round((new Date(s) - new Date(c)) / 86400000);
        data.quartos.forEach(function (q) { roomsList.appendChild(buildCard(q, nights)); });
      })
      .catch(function () {
        loading.style.display = 'none';
        var el = document.createElement('div'); el.className = 'alert alert-danger';
        el.textContent = 'Erro ao buscar quartos. Tente novamente.';
        roomsList.appendChild(el);
      });
  });
})();
</script>

<?php require ROOT . '/components/footer.php'; ?>
