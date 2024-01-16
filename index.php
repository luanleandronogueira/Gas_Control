<?php 

  //Permite o include de arquivos que não podem ser abertos no navegador
 // define('__INCLUDED_BY_OTHER_FILE__', true);

//   include "controladores/Classes.php";
include "controladores/Controller.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- <?php head()?> -->

  <style>
    body {

      background-color: #1a959b;

    }

  </style>

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">


              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <center><img src="assets/img/medical_control_vetor.png" width="300px" alt=""></center>
                    <p class="text-center small">Seu Sistema de Controle de Combustível</p>
                  </div>

                  <?php if(isset($_GET['erro']) == '1' or isset($_GET['erro']) == '2' or isset($_GET['erro']) == '3') { ?>

                  <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                        Login ou Senha Incorretos
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>

                  <?php }?> 

                  <form method="post" action="controladores/AutenticaUsuario.php" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">CPF:</label>
                      <div class="input-group has-validation">
                        <input type="text" id="cpf" name="nome_usuario" maxlength="14" class="form-control" required>
                        <div class="invalid-feedback">Insira o seu Login.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Senha:</label>
                      <input type="password" name="senha_usuario" class="form-control" required>
                      <div class="invalid-feedback">Insira a Senha.</div>
                    </div>

                  
                    <div class="col-12 mt-5">
                      <button class="btn w-100 text-white" name="enviar_requisicao" style="background-color: #1a959b;" type="submit">Entrar</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
  <!-- <script> 
        $(document).ready(function(){
            $('#cpf').mask('000.000.000-00');
        }); 
  </script> -->


</body>

</html>