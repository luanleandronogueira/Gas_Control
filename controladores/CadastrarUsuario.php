<?php 

    //Permite o include de arquivos que não podem ser abertos no navegador
    define('__INCLUDED_BY_OTHER_FILE__', true);

    include 'Classes.php';
    $func = new Usuario;
    $cadastraUsuario = null;

    if (empty($_POST)) {

        header("Location: ../index.php?acesso=negado]");
        die();

    } else {


        if($_POST['cpf_usuario']){
            // consultar se já há o cpf cadastrado
            $cpf = filter_input(INPUT_POST, 'cpf_usuario', FILTER_SANITIZE_NUMBER_INT);

            $cpfNumeros = preg_replace('/[^0-9]/', '', $cpf);

            $consultaUsuario = $func->consultarUsuarioCadastrado($cpfNumeros);

            if($consultaUsuario['cpf_usuario'] === $cpfNumeros){

                header("Location: ../cadastrarUsuario.php?usuario=jacadastrado");
                die(); 

            } else {

                $nome = ucwords($_POST['nome_usuario']); 

                $senhaHash = password_hash($_POST['senha_usuario'], PASSWORD_DEFAULT); 
        
                $cadastraUsuario = $func->inserirUsuario($nome, $cpfNumeros, $senhaHash, $_POST['tipo_usuario']);

                header("Location: ../cadastrarUsuario.php?insercao=sucesso]");

            }

            //print_r($consultaUsuario);

        } else {

            header("Location: ../index.php?");
            
        }
        
    }

?>