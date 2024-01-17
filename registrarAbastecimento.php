<?php 
   include "controladores/Controller.php";
   include "controladores/Classes.php";
 
   // Verifica se há sessão aberta.
   verificarSessao();

   $func = new Veiculo;
   $chamaVeiculo = $func->chamaVeiculo();
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

    <?php echo sideBar()?>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <section class="section">
      <div class="row">

      <div class="card">
         <div class="card-body">
            <h5 class="card-title"><center>Registrar Abastecimento</center></em>
            </h5>
         </div>
      </div>

        <div class="card">
          <div class="card-body">

          <h5 class="card-title"><center>Informações Gerais:</center></em></h5>

          <form action="controladores/RegistrarAbastecimento.php" method="post" enctype="multipart/form-data">

            <label class="form-label">Data do Abastecimento:</label>
            <input type="datetime-local" name="data_abastecimento" required class="form-control"></br>

            <label>Selecione o Veículo:</label>
            <select class="form-control" required name="veiculo_abastecimento" id="">
                <?php foreach($chamaVeiculo as $veiculo) { ?>
                    <option value="<?= $veiculo['id_veiculo'] ?>"><?= $veiculo['modelo_veiculo']?></option>
                <?php } ?>
            </select></br>
            
            <label class="form-label">Quilometragem atual (antes do abastecimento):</label>
            <input type="text" name="quilometragem_abastecimento" required class="form-control"></br>

            <label class="form-label">Valor da Nota:</label>
            <input type="text" name="valor_nota_abastecimento" id="dinheiro" required class="form-control"></br>

            <label class="form-label">Observações:</label>
            <textarea class="form-control" maxlength="500" name="observacoes_abastecimento" id="" cols="10" rows="3"></textarea></br>

            <label class="form-label">Anexar Foto:</label>
            <input type="file" name="nota_abastecimento"></br></br>

            <input type="hidden" name="usuario_abastecimento" value="<?=$_SESSION['nome_usuario'] ?>">

            <button class="btn btn-secondary" type="submit">Registrar</button>

          </form>
            
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
  

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>