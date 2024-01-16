<?php 
include_once 'Classes.php';

$atualizaRota = null;

if (!empty($_POST)){ 

    // echo '<pre>';
    //     print_r($_POST);
    // echo '</pre>';

    $func = new Rotas;
    $atualizaRota = $func->atualizaRota($_POST['data_chegada_rota'], $_POST['quilometragem_chegada_rota'], strtoupper($_POST['local_chegada_rota']),$_POST['observacao_rota'], $_POST['id_rota']);

    header("Location: ../registrarRotas.php?cadastro=sucesso&&RegistrarRotas");
    die();


} else {


    header("Location: ../registrarRotas.php?cadastro=ArrayVazio&&RegistrarRotas");
    die();

}
?>