<?php 
include_once 'Classes.php';

$atualizaRota = null;

if (!empty($_POST)){ 

    // echo '<pre>';
    //     print_r($_POST);
    // echo '</pre>';

    if(!isset($_POST['usuario_submit'])){

        $func = new Rotas;
        $lat_long_saida = trim($_POST['latitude'].'/'. $_POST['longitude']);
        $atualizaRota = $func->atualizaRota($_POST['data_chegada_rota'], $_POST['quilometragem_chegada_rota'], strtoupper($_POST['local_chegada_rota']),$_POST['observacao_rota'], $lat_long_saida, $_POST['id_rota']);

        header("Location: ../registrarRotas.php?cadastro=sucesso&&RegistrarRotas");

    } else {

        $func = new Rotas;
        $lat_long_saida = trim($_POST['latitude'].'/'. $_POST['longitude']);
        $atualizaRota = $func->atualizaRota($_POST['data_chegada_rota'], $_POST['quilometragem_chegada_rota'], strtoupper($_POST['local_chegada_rota']),$_POST['observacao_rota'], $lat_long_saida, $_POST['id_rota']);

    header("Location: ../usuario/dashboardUsuario.php?cadastro=sucesso&&RegistrarRotas");


    }



} else {


    header("Location: ../registrarRotas.php?cadastro=ArrayVazio&&RegistrarRotas");
    die();

}
?>