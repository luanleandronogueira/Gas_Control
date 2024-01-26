<?php 

include_once 'Classes.php';
$func = new Veiculo;

if(!empty($_REQUEST)){

    
    //print_r($_REQUEST);


    $atualizarVeiculo = $func->atualizarVeiculo(strtoupper($_REQUEST['modelo_veiculo']), strtoupper($_REQUEST['placa_veiculo']), $_REQUEST['id_veiculo']);

    header("Location: ../cadastraVeiculo.php?cadastro=sucesso&&EditarVeiculo");





} else {

    header("Location: ../index.php?erro=arrayVazio&&EditarVeiculo");
    die();



}







?>