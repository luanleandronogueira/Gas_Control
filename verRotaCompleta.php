<?php 
   include "controladores/Controller.php";
   include "controladores/Classes.php";
 
   // Verifica se há sessão aberta.
   verificarSessao();

   if(empty($_GET)){

    header("Location: registrarRotas.php");
    die();

} else {
    
    $func = new Rotas;
    $chamaRotaEspecificaID = $func->chamaRotaEspecificaID($_GET['id']);

    $quilometragem = $func->calcularQuilometragemRota($chamaRotaEspecificaID[0]['quilometragem_chegada_rota'], $chamaRotaEspecificaID[0]['quilometragem_saida_rota']);

}
    

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php head()?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
      #mapa { height: 400px; }
    </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <?php logoBar()?>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>


        <!-- Perfil -->
        <?php echo Perfil() ?>

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <?php echo sideBar()?>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <section class="section">
      <div class="row">

      <div class="card">
         <div class="card-body">
            <h5 class="card-title">Rota <em>(<?= $chamaRotaEspecificaID[0]['local_saida_rota'] ?>) à (<?= $chamaRotaEspecificaID[0]['local_chegada_rota'] ?>)</em>
            </h5>
         </div>
      </div> 

        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Saída: <em></em></h5>

                <label><strong>Data de Saída: </strong><?= date('d/m/Y H:i:s', strtotime($chamaRotaEspecificaID[0]['data_saida_rota'])) ?></label></br> 
                <label><strong>Quilometragem de Saída: </strong><?= $chamaRotaEspecificaID[0]['quilometragem_saida_rota'] ?></label></br>
                <label><strong>Local de Saída:</strong> <?= $chamaRotaEspecificaID[0]['local_saida_rota'] ?></label></br>
                <hr>
                <h5 class="card-title">Chegada: <em></em></h5>
                <label><strong>Data de Chegada: </strong> <?= date('d/m/Y H:i:s', strtotime($chamaRotaEspecificaID[0]['data_chegada_rota'])) ?></label></br>
                <label><strong>Quilometragem de Chegada: </strong><?= $chamaRotaEspecificaID[0]['quilometragem_chegada_rota'] ?> </label></br>
                <label><strong>Local de Chegada: </strong><?= $chamaRotaEspecificaID[0]['local_chegada_rota'] ?> </label>
                <hr>
                <h5 class="card-title">Informações adicionais: </h5>
                <label><strong>Carro Utilizado: </strong><?= $chamaRotaEspecificaID[0]['modelo_veiculo'] ?></label></br>
                <label><strong>Placa do Veículo: </strong><?= $chamaRotaEspecificaID[0]['placa_veiculo'] ?></label> </br>
                <label><strong>Motorista: </strong><?= $chamaRotaEspecificaID[0]['usuario_rota'] ?> </label></br>
                <label><strong>Observações: </strong><?= $chamaRotaEspecificaID[0]['observacao_rota'] ?> </label></br></br>   
                <label><strong>Perímetro percorrido: <span class=""><?= $quilometragem ?></span></strong> </label></br>  
                <div id="mapa"></div>

                </br>
                <a href="registrarRotas.php" class="btn btn-block btn-secondary">Voltar</a>

          <?php 
                $coordenadasSaida = [];
                $coordenadasChegada = [];

                // Verifica se as coordenadas foram definidas antes de acessá-las
                if (isset($chamaRotaEspecificaID[0]['latitude_longitude_saida_rota'])) {
                  // separando coordenadas de saida 
                  $coordenadasSaida = explode('/', $chamaRotaEspecificaID[0]['latitude_longitude_saida_rota']);
                }

                // Verifica se as coordenadas foram definidas antes de acessá-las
                if (isset($chamaRotaEspecificaID[0]['latitude_longitude_chegada_rota'])) {
                  // separação coordenadas de chegada
                  $coordenadasChegada = explode('/', $chamaRotaEspecificaID[0]['latitude_longitude_chegada_rota']);
                }

                
              ?>
              <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
            <script>

              var mapa;
              var coordsSaida = {
                latitude: <?= $coordenadasSaida[0] ?>,
                longitude: <?= $coordenadasSaida[1] ?>
              };

              var coordsChegada = {
                latitude: <?= $coordenadasChegada[0] ?>,
                longitude: <?= $coordenadasChegada[1] ?>
              };

              function iniciarMapa() {
                // Inicializa o mapa com uma visão específica e nível de zoom
                mapa = L.map('mapa').setView([coordsSaida.latitude, coordsSaida.longitude], 10);

                // Adiciona um provedor de mapas (por exemplo, OpenStreetMap)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  attribution: '© OpenStreetMap contributors'
                }).addTo(mapa);

                // Adiciona a linha ao mapa
                var polyline = L.polyline([
                  [coordsSaida.latitude, coordsSaida.longitude],
                  [coordsChegada.latitude, coordsChegada.longitude]
                ]).addTo(mapa);
              }

              // Chama iniciarMapa() quando o documento estiver pronto
              document.addEventListener('DOMContentLoaded', iniciarMapa);

            </script>
            </div>
        </div>  

            

      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span></span></strong> 
    </div>
    <div class="credits">
      
    </div>
  </footer><!-- End Footer -->


  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>