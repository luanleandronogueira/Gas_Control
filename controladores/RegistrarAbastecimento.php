<?php 

    include_once 'Classes.php';

    $func = new Abastecimento;

    if(!empty($_POST)){

        
        if (!empty($_FILES)){

            if ($_FILES['nota_abastecimento']['type'] == 'application/pdf' || 
                $_FILES['nota_abastecimento']['type'] == 'image/jpg' || 
                $_FILES['nota_abastecimento']['type'] == 'image/jpeg') 
            {

                $_FILES['nota_abastecimento']['name'] = $_POST['veiculo_abastecimento'] ."-" . date('dmyHis');
                
                $nome_comprovante = $_FILES['nota_abastecimento']['type'];
                $nome_comprovante_separado = explode('/', $nome_comprovante);

                $endereco_pasta = $_FILES['nota_abastecimento']['name'] . ".". $nome_comprovante_separado[1];

                $endereco_pasta = $_FILES['nota_abastecimento']['name'] . ".". $nome_comprovante_separado[1];
                $endereco_salva = "../assets/comprovantes";

                move_uploaded_file($_FILES['nota_abastecimento']['tmp_name'], "$endereco_salva/$endereco_pasta");
                
                $calculaAbastecimento = $func->calculaPrecoCombustivel($_POST['valor_nota_abastecimento'], $_POST['litro_abastecimento']);

                extract($_POST);

                $inserirAbastecimento = $func->inserirAbastecimento($data_abastecimento, $veiculo_abastecimento, $quilometragem_abastecimento, $litro_abastecimento, $valor_nota_abastecimento, $observacoes_abastecimento, $endereco_salva, $calculaAbastecimento, $usuario_abastecimento);

                header("Location: ../registrarAbastecimento.php?inserir=Sucesso&&ResgistrarAbastecimento");

            } else {

                header("Location: ../registrarAbastecimento.php?erro=arquivoInvalido&&ResgistrarAbastecimento");
                die();

            }


        } else {

            header("Location: ../registrarAbastecimento.php?erro=arquivoInvalido&&ResgistrarAbastecimento");
            die();

        }

    } else {

        header("Location: ../registrarAbastecimento.php?erro=ArrayVazio&&ResgistrarAbastecimento");
        die();

    }

?>