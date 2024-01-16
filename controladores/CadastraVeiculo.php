<?php


include_once "Classes.php";

$func = new Veiculo;

if(!empty($_POST)){

    $contagem = strlen($_POST['modelo_veiculo']);
    $contagem2 = strlen($_POST['placa_veiculo']);
    
    if($contagem > 220 or $contagem2 > 10) {

        header("Location: ../cadastraVeiculo.php?erro=caracteres&&CadastraVeiculo");
        die();

    } else {

        $inserirVeiculo = $func->inserirVeiculo($_POST['modelo_veiculo'],
                                                $_POST['placa_veiculo']);
        
        header("Location: ../cadastraVeiculo.php?cadastro=sucesso&&CadastraVeiculo");

    }


} else {

    header("Location: ../cadastraVeiculo.php?erro=arrayVazio&&CadastraVeiculo");
    exit();

}






?>