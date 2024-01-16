<?php 

include_once 'Classes.php';

if (!empty($_POST)){

    $func = new Rotas;

    $SaidaRotaUPPER = strtoupper($_POST['local_saida_rota']);
    
    $inserirRotaSaida = $func->inserirRotaSaida($_POST['data_saida_rota'], $_POST['quilometragem_rota'],  $SaidaRotaUPPER, $_POST['veiculo_rota'], $_POST['usuario_rota']);

    header("Location: ../registrarRotas.php?cadastro=sucesso&&RegistrarRotas");


} else {


    header("Location: ../registrarRotas.php?cadastro=ArrayVazio&&RegistrarRotas");
    die();

}

// echo '<pre>';
//     print_r($_POST);
// echo '</pre>';


?>