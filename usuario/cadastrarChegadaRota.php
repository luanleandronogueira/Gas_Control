<?php 

   include "../controladores/Controller.php";
   include "../controladores/Classes.php";
 
   // Verifica se há sessão aberta.
   verificarSessaoUsuario();

   if(empty($_GET)){

    header("Location: registrarRotas.php");
    die();

} else {
    
    $func = new Rotas;
    $chamaRotaEspecifica = $func->chamaRotaEspecifica($_GET['id']);

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

    <?php echo sideBarUsuario()?>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <section class="section">

     <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Registrar Chegada do Destino</h5>

                <?php if(isset($_GET['cadastro']) == 'sucesso') { ?>

                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                    Feito com Sucesso!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <?php }?>
                
                <form class="row g-3" action="../controladores/RegistrarRotasChegada.php" method="post">

                        <label class="form-label">Data de Chegada:</label>
                        <input type="datetime-local" name="data_chegada_rota" required class="form-control">

                    <!-- <div class="col-12"> -->
                        <label class="form-label">Quilometragem de Chegada:</label>
                        <input type="text" name="quilometragem_chegada_rota" maxlength="100" required class="form-control">
                        <label class="form-label">Local de Chegada:</label>
                        <input type="text" name="local_chegada_rota" maxlength="220" required class="form-control">

                        <label class="form-label">Inserir Observações:</label>
                        <textarea class="form-control" name="observacao_rota" id="" cols="10" rows="3"></textarea>      
                        <input type="hidden" name="id_rota" value="<?= $_GET['id'] ?>" >

                        <!-- Adicione campos ocultos para latitude e longitude -->
                        <input type="hidden" id="latitudeInput" name="latitude" value="">
                        <input type="hidden" id="longitudeInput" name="longitude" value="">         
                    <!-- <div class="text-center"> -->


                        <label class="form-label">Localização de Saída:</label>
                        <div id="mapa"></div>

                        <button type="submit" name="usuario_submit" class="btn btn-primary">Cadastrar</button>
                    <!-- </div> -->

                        

                </form>

                </br> 
            </div>
          </div>
       </div>
        
       <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
      <script>

        var mapa;
        var coords = {};

        function success(pos) {
          console.log(pos.coords.latitude, pos.coords.longitude);
          coords.latitude = pos.coords.latitude;
          coords.longitude = pos.coords.longitude;

          // Atualiza os valores nos campos de entrada ocultos
          document.getElementById("latitudeInput").value = coords.latitude;
          document.getElementById("longitudeInput").value = coords.longitude;

          // Inicializa o mapa apenas se não estiver inicializado
          if (!mapa) {
            iniciarMapa();
          }
        }

        function error(err) {
          console.log(err);
        }

        var watchID = navigator.geolocation.watchPosition(success, error, {
          enableHighAccuracy: true,
          // timeout: 5000
        });

        function iniciarMapa() {
          // Inicializa o mapa apenas se não estiver inicializado
          if (!mapa) {
            // Inicializa o mapa com uma visão específica e nível de zoom
            mapa = L.map('mapa').setView([coords.latitude, coords.longitude], 24);

            // Adiciona um provedor de mapas (por exemplo, OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '© OpenStreetMap contributors'
            }).addTo(mapa);

            var marker = L.marker([coords.latitude, coords.longitude]).addTo(mapa);
          }
        }

        // Chama iniciarMapa() caso as coordenadas já estejam disponíveis
        if (coords.latitude !== undefined && coords.longitude !== undefined) {
          iniciarMapa();
        }

      </script>
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