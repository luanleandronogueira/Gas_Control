<?php 

   include "controladores/Controller.php";
   include "controladores/Classes.php";
 
   // Verifica se há sessão aberta.
   verificarSessao();

   $func = new Veiculo;
   $func2 = new Rotas;

   $chamaVeiculo = $func->chamaVeiculo();
   $chamaRotas = $func2->chamaRotas();




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
    </nav>

  </header>

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <?php echo sideBar()?>

  </aside>

  <main id="main" class="main">
    <section class="section">
      <div class="row">
        
      <div class="row">
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
                
                <form class="row g-3" action="controladores/RegistrarRotas.php" method="post">

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
                                <option value="<?= $veiculo['id_veiculo'] ?>"><?= $veiculo['modelo_veiculo']?></option>
                            <?php } ?>
                        </select>

                        <input type="hidden" name="usuario_rota" value="<?=$_SESSION['nome_usuario'] ?>">

                        <!-- <div>
                            <label class="form-label">Obter Localização:</label>
                            <button class="btn btn-success">Localização</button>
                        </div>
                        <textarea class="form-control" name="" id="" cols="10" rows="3"></textarea>                         -->
                    <!-- </div> -->
        
                    <!-- <div class="text-center"> -->
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    <!-- </div> -->

                        

                </form>

                </br> 

              
            </div>
          </div>
       </div>

       <div class="card">
            <div class="card-body">
              <h5 class="card-title">Veículos Cadastrados</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Km Saída</th>
                    <th>Local de Saída</th>
                    <th>Km Chegada</th>
                    <th>Destino</th>
                    <th>Veículo</th>
                    <th></th>
                    
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



                    
                    
                    <?php } else { ?>

                        <tr>
                            <td><strong><a href="verRotaCompleta.php?id=<?= $Rotas['id_rota']?>"><?= $Rotas['id_rota']?></a></strong></td>
                            <td><?= $Rotas['quilometragem_saida_rota'] ?></td>
                            <td><?= $Rotas['local_saida_rota']?></td>
                            <td><em><?= $Rotas['quilometragem_chegada_rota']?></em></td>
                            <td><em><?= $Rotas['local_chegada_rota']?></em></td>
                            <td><?= $Rotas['modelo_veiculo']?></td>
                            <td></td>
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