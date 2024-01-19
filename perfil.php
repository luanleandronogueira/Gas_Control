<?php 
  include "controladores/Controller.php";
  include "controladores/Classes.php";

  // Verifica se há sessão aberta.
	verificarSessao();

  $nome = $_SESSION['nome_usuario'];
  $tipo = $_SESSION['tipo_usuario'];

  $func = new Usuario;
  $chamaUsuario = $func->chamaUsuario($_SESSION['id_usuario']);

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
       
      
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
              <h2><?= $chamaUsuario['nome_usuario']?></h2>
              <h3>Usuário</h3>
              <!-- <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div> -->
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">informações Pessoais</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar Informações</button>
                </li>


                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Alterar Senha</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

              <?php if(isset($_GET['insercao']) == 'sucesso') { ?>

              <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                    Feito com Sucesso!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

              <?php }?>

              <?php if(isset($_GET['senha']) == 'diferente') { ?>

              <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                    As senhas estão diferentes!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

              <?php }?>

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Meu Perfil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nome Completo:</div>
                    <div class="col-lg-9 col-md-8"><?= $chamaUsuario['nome_usuario']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">CPF:</div>
                    <div class="col-lg-9 col-md-8"><?= $chamaUsuario['cpf_usuario']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Login:</div>
                    <div class="col-lg-9 col-md-8"><?= $chamaUsuario['cpf_usuario']?></div>
                  </div>

                 

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Form -->
                  <form method="post" action="controladores/AlterarPerfil.php">
                    <div class="row mb-3">
                      <label  class="col-md-4 col-lg-3 col-form-label">Nome Completo</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nome_usuario" type="text" class="form-control" value="<?= $chamaUsuario['nome_usuario'] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-md-4 col-lg-3 col-form-label">CPF</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" class="form-control" readonly value="<?= $_SESSION['cpf_usuario']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-md-4 col-lg-3 col-form-label">Nível de Acesso</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-control" name="tipo_usuario">
                          <option value="a">Administrador</option>
                          <option value="u">Usuário</option>
                        </select>
                      </div>
                    </div>

                    <input type="hidden" name="id" value="<?= $_SESSION['id_usuario'] ?>">

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Salvar Mudanças</button>
                    </div>
                  </form><!-- End Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="controladores/AlterarPerfil.php" method="post">

                    <div class="row mb-3">
                      <label class="col-md-4 col-lg-3 col-form-label">Nova Senha:</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="senha_usuario" type="password" class="form-control">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Confirme Nova Senha:</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="confirma_senha_usuario" type="password" class="form-control">
                      </div>
                    </div>

                    <input type="hidden" name="id" value="<?=$chamaUsuario['id'] ?>">

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Salvar Informações</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>








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