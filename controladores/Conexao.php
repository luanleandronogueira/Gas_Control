<?php 

class Conexao {

    private $host = "localhost";
    private $dbnome = "db_gas_control";
    private $usuariodb = "root";
    private $senha = "";

    public function Conectar(){

        try {
            $conexao = new PDO(

                "mysql:host=$this->host;dbname=$this->dbnome", 
                "$this->usuariodb", 
                "$this->senha"

            );
            return $conexao;
            
        } 
        catch (PDOException $e){

            echo '<p>' .$e->getMessage() . ' </p>';
            
        }
    }

}