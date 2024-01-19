<?php 

include_once 'Classes.php';

$func = new Usuario;

if(!empty($_POST)){

    // criptografa a senha
    $senhaHash = password_hash(trim($_POST['senha_usuario']), PASSWORD_DEFAULT);

    // atualiza a senha no banco de dados 
    $atualizarSenhaUsuario = $func->atualizarSenhaUsuario($_POST['id'], $senhaHash);


    // redirecionamento
    header("Location: ../cadastrarUsuario.php?insercao=sucesso");


} else {


    header("Location: ../cadastrarUsuario.php?erro=arrayVazio&&EditarUsuario");
    die();

}


?>