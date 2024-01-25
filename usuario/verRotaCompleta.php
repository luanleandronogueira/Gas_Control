<?php 
   include "../controladores/Controller.php";
   include "../controladores/Classes.php";
 
   // Verifica se há sessão aberta.
   verificarSessaoUsuario();

   if(empty($_GET)){

    header("Location: dashboardUsuario.php");
    die();

} else {
    
    $func = new Rotas;
    $chamaRotaEspecificaID = $func->chamaRotaEspecificaID($_GET['id']);


}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php head()?>
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
                <label><strong>Observações: </strong><?= $chamaRotaEspecificaID[0]['observacao_rota'] ?> </label></br>   
                </br>
                <a href="../registrarRotas.php" class="btn btn-block btn-secondary">Voltar</a>

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