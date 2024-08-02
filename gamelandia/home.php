<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title> Home </title>
</head>
<body>

    <!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>
    
    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./assets/img/carrossel/minecraft.webp" height="800"  alt="MINECRAFT" class="d-block" style="width:100%">
        <div class="carousel-caption">
          <h3>MINECRAFT</h3>
          <p> Neste universo realmente impressionante explorando cavernas, a procura de diamantes combinando itens, construindo casas de dia ou de noite fazendo minha jornada modificações aumentam a diversidade e fica ainda mais legal com os amigos de verdade </p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./assets/img/carrossel/overwatch.jpg" height="800" alt="" class="d-block" style="width:100%">
        <div class="carousel-caption">
          <h3>OVERWATCH</h3>
          <p> Além da jogabilidade dinâmica, Overwatch é conhecido por seu rico universo narrativo, com histórias e vídeos que exploram o fundo dos personagens e o mundo do jogo. </p>
        </div> 
      </div>
      <div class="carousel-item">
        <img src="./assets/img/carrossel/pokemon.jpg" height="800" alt="New York" class="d-block" style="width:100%">
        <div class="carousel-caption">
          <h3> POKÉMON </h3>
          <p> Você explora várias regiões, enfrenta líderes de ginásio para ganhar distintivos, e se defronta com a Elite dos Quatro e o Campeão da Liga Pokémon. </p>
        </div>  
      </div>
    </div>
    
    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
  
  <div class="container-fluid mt-3">
    <h3> Confira nossos produtos </h3>
    <hr>
  </div>

  <?php
    include("./listar_prod.php");
  ?>

</body>
</html>