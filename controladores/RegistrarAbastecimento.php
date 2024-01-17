<?php 

    include_once 'Classes.php';

    if(!empty($_POST)){

        
        if (!empty($_FILES)){

            if ($_FILES['nota_abastecimento']['type'] == 'application/pdf' || 
                $_FILES['nota_abastecimento']['type'] == 'image/jpg' || 
                $_FILES['nota_abastecimento']['type'] == 'image/jpeg') 
            {

                echo '<pre>';
                print_r($_POST);
                echo '</pre>';

                echo '<pre>';
                    print_r($_FILES);
                echo '</pre>';


            
            
            } else {


                header("Location: ../registrarAbastecimento.php?erro=arquivoInvalido&&ResgistrarAbastecimento");
                die();


            }


        } else {







        
        }

    } else {


        header("Location: ../registrarAbastecimento.php?erro=ArrayVazio&&ResgistrarAbastecimento");
        die();


    }

  


?>