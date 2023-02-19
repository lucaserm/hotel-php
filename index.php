<?php
  session_start();
?>

<?php include('components/navbar.php'); ?>

<div class="container mt-5">
  <div class="jumbotron text-center">
    <h1 class="display-4">Reserve um Quarto Agora</h1>
    <p class="lead">Bem-vindo ao nosso sistema de reserva de quartos.</p>
    <hr class="my-4">
    <p>Aqui você pode encontrar a melhor acomodação para a sua estadia.</p>
    <a class="btn btn-primary btn-lg" href="#" role="button">Faça uma Reserva</a>
  </div>
</div>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Quartos Luxuosos</h5>
          <p class="card-text">Nossos quartos luxuosos são equipados com as melhores comodidades para uma estadia
            confortável e agradável.</p>
          <a href="#" class="btn btn-primary">Saiba Mais</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Serviço de Quarto 24 Horas</h5>
          <p class="card-text">Nosso serviço de quarto está disponível 24 horas por dia, 7 dias por semana, para
            atender todas as suas necessidades durante a sua estadia.</p>
          <a href="#" class="btn btn-primary">Saiba Mais</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Localização Perfeita</h5>
          <p class="card-text">Estamos localizados no coração da cidade, próximo aos principais pontos turísticos e de
            negócios.</p>
          <a href="#" class="btn btn-primary">Saiba Mais</a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
      <h2>Reservas Recentes</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Quarto Standard</h5>
          <p class="card-text">Data de Entrada: 25/08/2023</p>
          <p class="card-text">Data de Saída: 30/08/2023</p>
          <a href="#" class="btn btn-primary">Detalhes da Reserva</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Quarto Luxo</h5>
          <p class="card-text">Data de Entrada: 12/09/2023</p>
          <p class="card-text">Data de Saída: 18/09/2023</p>
          <a href="#" class="btn btn-primary">Detalhes da Reserva</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Suíte Presidencial</h5>
          <p class="card-text">Data de Entrada: 01/10/2023</p>
          <p class="card-text">Data de Saída: 10/10/2023</p>
          <a href="#" class="btn btn-primary">Detalhes da Reserva</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('components/footer.php'); ?>