<?php 

include_once 'Classes.php';

if (!empty($_POST)){


    if(!isset($_POST['usuario_submit'])) {

        // echo '<pre>';
        //     print_r($_POST);
        // echo '</pre>';

        $func = new Rotas;

        $SaidaRotaUPPER = strtoupper($_POST['local_saida_rota']);
        $lat_long_saida = trim($_POST['latitude'].'/'. $_POST['longitude']);
        
        $inserirRotaSaida = $func->inserirRotaSaida($_POST['data_saida_rota'], $_POST['quilometragem_rota'],  $SaidaRotaUPPER, $_POST['veiculo_rota'], $_POST['usuario_rota'], $lat_long_saida);

        header("Location: ../registrarRotas.php?cadastro=sucesso&&RegistrarRotas");


     } else {
      
        $func = new Rotas;

        $SaidaRotaUPPER = strtoupper($_POST['local_saida_rota']);
        $lat_long_saida = trim($_POST['latitude'].'/'. $_POST['longitude']);
        
        $inserirRotaSaida = $func->inserirRotaSaida($_POST['data_saida_rota'], $_POST['quilometragem_rota'],  $SaidaRotaUPPER, $_POST['veiculo_rota'], $_POST['usuario_rota'], $lat_long_saida);

        header("Location: ../usuario/dashboardUsuario.php?cadastro=sucesso&&RegistrarRotas");

    }


} else {


    header("Location: ../registrarRotas.php?cadastro=ArrayVazio&&RegistrarRotas");
    die();

}




?>