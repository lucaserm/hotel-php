<?php session_start() ?>
<?php include('components/navbar.php'); ?>
<div class="container mt-3">
  <h1>Reservas</h1>
  <hr>
  <div class="row">
    <div class="col-md-8">
      <form action="#" method="POST">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="checkin_date">Data de check-in:</label>
            <input type="date" class="form-control" id="checkin_date" name="checkin_date" required>
          </div>
          <div class="form-group col-md-6">
            <label for="checkout_date">Data de check-out:</label>
            <input type="date" class="form-control" id="checkout_date" name="checkout_date" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="adults">Adultos:</label>
            <select class="form-control" id="adults" name="adults" required>
              <option value="">Selecione o número de adultos</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="children">Crianças:</label>
            <select class="form-control" id="children" name="children" required>
              <option value="">Selecione o número de crianças</option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Pesquisar disponibilidade</button>
      </form>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Informações</h5>
          <p class="card-text">Verifique a disponibilidade das nossas acomodações para a sua estadia e faça sua
            reserva agora mesmo.</p>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <h3>Disponibilidade de quartos</h3>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">Tipo de Quarto</th>
            <th scope="col">Disponibilidade</th>
            <th scope="col">Preço por noite</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Quarto Standard</td>
            <td>Sim</td>
            <td>R$ 200,00</td>
            <td><a href="cria_reserva.php" class="btn btn-primary"><i class="fas fa-plus"></i> Adicionar à
                reserva</a></td>
          </tr>
          <tr>
            <td>Suíte Luxo</td>
            <td>Não</td>
            <td>R$ 350,00</td>
            <td><button class="btn btn-secondary disabled"><i class="fas fa-times"></i> Indisponível</button></td>
          </tr>
          <tr>
            <td>Quarto Deluxe</td>
            <td>Sim</td>
            <td>R$ 300,00</td>
            <td><a href="cria_reserva.php" class="btn btn-primary"><i class="fas fa-plus"></i> Adicionar à
                reserva</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php include('components/footer.php'); ?>