<?php 

include 'Classes.php';
// Verifica se há sessão aberta.
verificarSessao();

$func = new Usuario;

// echo '<pre>';
//     var_dump($_POST);
// echo '</pre>';

if(empty($_POST)){

    header('Location: ../index.php');
    exit();

} else {
    
    if(isset($_POST['senha_usuario'])) {

        $senha = strcmp($_POST['senha_usuario'], $_POST['confirma_senha_usuario']);

        if($senha == 0) {

            //Atualizar a Senha
            $senhaNova = trim(password_hash($_POST['confirma_senha_usuario'], PASSWORD_DEFAULT)); 
            $atualizaSenha = $func->atualizarSenhaUsuario($_POST['id'], $senhaNova);
            header('Location: ../perfil.php?insercao=sucesso]');

            // echo 'caiu';

        } else {

            header('Location: ../perfil.php?senha=diferente');
            die();
            // echo 'caiu';
        }


    } else {

        // Atualizar Nome e nível de acesso
        $atualizarUsuario = $func->atualizarUsuario($_POST['id'], 
                                                    $_POST['nome_usuario'], 
                                                    $_POST['tipo_usuario']);

        header('Location: ../perfil.php?insercao=sucesso]');
        

    }
    

}




?>