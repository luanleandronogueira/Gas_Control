<?php 
  include "../controladores/Controller.php";
  include "../controladores/Classes.php";

  // Verifica se há sessão aberta.
	verificarSessaoUsuario();

  $func = new Veiculo;
  $func2 = new Usuario;
  $func3 = new Rotas;

  $chamaVeiculo = $func->chamaVeiculo();
  $chamaRotas = $func3->chamaRotaUsuario($_SESSION['nome_usuario']);

  $calcularQuilometragemRota = null;

  $chamaUsuario = $func2->chamaUsuario($_SESSION['id_usuario']);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php head()?>

    <style>
  /* Adicione um estilo específico para telas menores, como celulares */
  @media (max-width: 767px) {
    /* Seletor para a tabela que você deseja adicionar o scroll horizontal */
    .sua-tabela {
      /* Defina a largura máxima da tabela para ativar o scroll horizontal quando necessário */
      max-width: 100%;
      /* Adicione um scroll horizontal quando o conteúdo excede a largura da tabela */
      overflow-x: auto;
      display: block; /* Adicione display: block para forçar a barra de rolagem horizontal */
    }
    /* Opcional: Remova as bordas da tabela para um visual mais limpo */
    .sua-tabela, .sua-tabela th, .sua-tabela td {
      border: none;
    }
  }
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
        <?php echo PerfilUsuario() ?>

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
            <center><h5 class="card-title">Bem Vindo, <?= $_SESSION['nome_usuario']?></h5></center>
       </div>

       <div class="card">
            <div class="card-body">
                <h5 class="card-title">Registrar Saída do Destino</h5>

                <?php if(isset($_GET['cadastro']) == 'sucesso') { ?>

                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                    Feito com Sucesso!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <?php }?>
                
                <form class="row g-3" action="../controladores/RegistrarRotas.php" method="post">

                        <label class="form-label">Data de Saída:</label>
                        <input type="datetime-local" name="data_saida_rota" required class="form-control">

                    <!-- <div class="col-12"> -->
                        <label class="form-label">Quilometragem de Saída:</label>
                        <input type="text" name="quilometragem_rota" maxlength="100" required class="form-control">
                        <label class="form-label">Local de Saída:</label>
                        <input type="text" name="local_saida_rota" maxlength="220" required class="form-control">

                        <label>Selecione o Veículo:</label>
                        <select class="form-control" required name="veiculo_rota" id="">
                            <?php foreach($chamaVeiculo as $veiculo) { ?>
                              <option value="<?= $veiculo['id_veiculo'] ?>"><?= $veiculo['modelo_veiculo'] . ' PLACA ' .  $veiculo['placa_veiculo']?></option>
                            <?php } ?>
                        </select>

                        <input type="hidden" name="usuario_rota" value="<?=$_SESSION['nome_usuario'] ?>">

        
                    <!-- <div class="text-center"> -->
                        <button type="submit" name="usuario_submit" class="btn btn-primary">Cadastrar</button>
                    <!-- </div> -->

                        

                </form>

                </br> 

              
            </div>
          </div>
          

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Veículos Cadastrados</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable sua-tabela">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Km Saída</th>
                    <th>Local de Saída</th>
                    <th>Km Chegada</th>
                    <th>Destino</th>
                    <th>Veículo</th>
                    <th>Km Percorrida</th>
                    
                  </tr>
                </thead>
                <tbody>

                <?php foreach ($chamaRotas as $Rotas) { 

                    if(empty($Rotas['quilometragem_chegada_rota'])){ ?>

                        <tr>
                            <td><strong><a href="verRotaCompleta.php?id=<?= $Rotas['id_rota']?>"><?= $Rotas['id_rota']?></a></strong></td>
                            <td><?= $Rotas['quilometragem_saida_rota'] ?></td>
                            <td><?= $Rotas['local_saida_rota']?></td>
                            <td><a href="cadastrarChegadaRota.php?id=<?=$Rotas['id_rota']?>"><strong>Cadastrar</strong></a></td>
                            <td><a href="cadastrarChegadaRota.php?id=<?=$Rotas['id_rota']?>"><strong>Cadastrar Destino</strong></a></td>
                            <td><?= $Rotas['modelo_veiculo']?></td>
                            <td></td>
                        </tr>

                    <?php } else { 
                      
                        // calculo perímetro percorrigo de acordo com a Quilometragem
                        $calcularQuilometragemRota = $func3->calcularQuilometragemRota($Rotas['quilometragem_chegada_rota'], $Rotas['quilometragem_saida_rota']);   
                      
                      
                    ?>

                        <tr>
                            <td><strong><a href="verRotaCompleta.php?id=<?= $Rotas['id_rota']?>"><?= $Rotas['id_rota']?></a></strong></td>
                            <td><?= $Rotas['quilometragem_saida_rota'] ?></td>
                            <td><?= $Rotas['local_saida_rota']?></td>
                            <td><em><?= $Rotas['quilometragem_chegada_rota']?></em></td>
                            <td><em><?= $Rotas['local_chegada_rota']?></em></td>
                            <td><?= $Rotas['modelo_veiculo']?></td>
                            <td><?=$calcularQuilometragemRota?>Km</td>
                        </tr>




                    <?php } ?>
                
                    
                  

                 <?php } ?> 

                </tbody>
              </table>

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