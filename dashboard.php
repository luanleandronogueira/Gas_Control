<?php
include "controladores/Controller.php";
include "controladores/Classes.php";

// Verifica se há sessão aberta.
verificarSessao();

$func2 = new Rotas;
$chamaRotasPersonalizadas = $func2->chamaRotasPersonalizadas();
$chamaRotas = $func2->chamaRotas();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php head() ?>

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

        <?php logoBar() ?>

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

        <?php echo sideBar() ?>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <section class="section">
            <div class="row">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">
                <center>Bem Vindo, <?= $_SESSION['nome_usuario']?></center>
                </h5>
              </div>
            </div>


                <div class="card-columns mt-4">
                    <?php foreach ($chamaRotasPersonalizadas as $Rota) { ?>
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://www.totvs.com/wp-content/uploads/2022/11/rota-de-entrega.jpg" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $Rota['local_saida_rota'] ?> <i class='bx bx-directions'></i> <?= $Rota['local_chegada_rota'] ?></h5>
                                        <p class="card-text"> Dia e horário de saída foi às <?= $Rota['data_saida_rota'] ?> </p>
                                        <p class="card-text">

                                            <?php if (empty($Rota['local_chegada_rota'])) {
                                                $Rota['local_chegada_rota'] = "Rota em percurso";
                                            } ?>

                                            <?= $Rota['local_chegada_rota'] ?>,
                                            <strong>
                                                <?= date('d/m/Y H:i:s', strtotime($Rota['data_chegada_rota'])) ?>
                                            </strong> <?= $Rota['observacao_rota'] ?></strong>

                                        </p>

                                        <a href="verRotaCompleta.php?id=<?=$Rota['id_rota']?>"><small class="badge bg-secondary">Ver detalhes</small></a></br>

                                        <p class="card-text">
                                            <small class="text-body-secondary">
                                                <?= date('d/m/Y H:i:s', strtotime($Rota['data_chegada_rota'])) ?>
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>

                <div class="card">
            <div class="card-body">
              <h5 class="card-title">Todas as Rotas</h5>

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
                        $calcularQuilometragemRota = $func2->calcularQuilometragemRota($Rotas['quilometragem_chegada_rota'], $Rotas['quilometragem_saida_rota']);   
                      
                      
                    ?>

                        <tr>
                            <td><strong><a href="verRotaCompleta.php?id=<?= $Rotas['id_rota']?>"><?= $Rotas['id_rota']?></a></strong></td>
                            <td><?= $Rotas['quilometragem_saida_rota'] ?></td>
                            <td><?= $Rotas['local_saida_rota']?></td>
                            <td><em><?= $Rotas['quilometragem_chegada_rota']?></em></td>
                            <td><em><?= $Rotas['local_chegada_rota']?></em></td>
                            <td><?= $Rotas['modelo_veiculo']?></td>
                            <td><?=$calcularQuilometragemRota?></td>
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
