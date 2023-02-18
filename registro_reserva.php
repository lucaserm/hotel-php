<!DOCTYPE html>
<html lang="pt-br">

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
              <td><button class="btn btn-primary"><i class="fas fa-plus"></i> Adicionar à reserva</button></td>
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
              <td><button class="btn btn-primary"><i class="fas fa-plus"></i> Adicionar à reserva</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popperjs.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZEZI5UksdQRVvoxMfooAo6" crossorigin="anonymous">
  </script>
</body>

</html>