<?php 

include "Conexao.php";
$conexao = new Conexao();
date_default_timezone_set('America/Sao_Paulo');

class Veiculo {

    private $id;
    private $conexao;
    private $modelo_veiculo;
    private $placa_usuario;

    
    // Adicione um construtor para inicializar a conexão
    public function __construct() {
        $this->conexao = new Conexao();
    }

    // inserir um modelo de veículo
    public function inserirVeiculo($modelo_veiculo, $placa_veiculo){

        $query = "INSERT INTO tb_veiculo (modelo_veiculo, placa_veiculo) VALUES (:modelo_veiculo, :placa_veiculo)";
        
        $conn = $this->conexao->Conectar();
        $stmt = $conn->prepare($query);  
        $stmt->bindParam(':modelo_veiculo', $modelo_veiculo);
        $stmt->bindParam(':placa_veiculo', $placa_veiculo);

        $stmt->execute();

    }

    // chamar todos os modelos cadastrados no banco
    public function chamaVeiculo(){

        $query = "SELECT * FROM `tb_veiculo`";

        $conn = $this->conexao->Conectar();
        $stmt = $conn->prepare($query);

        $stmt->execute();

        $r = [];

        while($retorno = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $r[] = $retorno;

        } 

        return $r;

    }

    // chamar o veículo especifico
    public function chamaVeiculoEspecifico($id_veiculo){

        $query = "SELECT * FROM `tb_veiculo` WHERE id_veiculo = :id_veiculo";

        $conn = $this->conexao->Conectar();
        $stmt = $conn->prepare($query);
        $stmt->bindParam('id_veiculo', $id_veiculo);

        $stmt->execute();

        $r = $stmt->fetch(PDO::FETCH_ASSOC);

        return $r;

    }


}

class Rotas {


    private $id;
    private $conexao;
    private $data_saida_rota;
    private $quilometragem_saida_rota;
    private $local_saida_rota;
    private $data_chegada_rota;
    private $quilometragem_chegada_rota;
    private $local_chegada_rota;
    private $veiculo_rota;
    private $usuario_rota;
    private $observacao_rota;

    // Adicione um construtor para inicializar a conexão
    public function __construct() {
        $this->conexao = new Conexao();
    }

    public function inserirRotaSaida($data_saida_rota, $quilometragem_saida_rota, $local_saida_rota, $veiculo_rota, $usuario_rota){

        $query = "INSERT INTO tb_rota (data_saida_rota, quilometragem_saida_rota, local_saida_rota, veiculo_rota, usuario_rota) VALUES (:data_saida_rota, :quilometragem_saida_rota, :local_saida_rota, :veiculo_rota, :usuario_rota)";
        
        $conn = $this->conexao->Conectar();

        $stmt = $conn->prepare($query);  
        $stmt->bindParam(':data_saida_rota', $data_saida_rota);
        $stmt->bindParam(':quilometragem_saida_rota', $quilometragem_saida_rota);
        $stmt->bindParam(':local_saida_rota', $local_saida_rota);
        $stmt->bindParam(':veiculo_rota', $veiculo_rota);
        $stmt->bindParam(':usuario_rota', $usuario_rota);

        $stmt->execute();
    }

    public function chamaRotas(){

        $query = "SELECT
        tr.id_rota,
        tr.data_saida_rota,
        tr.quilometragem_saida_rota,
        tr.local_saida_rota,
        tr.data_chegada_rota,
        tr.quilometragem_chegada_rota,
        tr.local_chegada_rota,
        tr.veiculo_rota,
        tv.modelo_veiculo,
        tv.placa_veiculo,
        tr.usuario_rota,
        tr.observacao_rota
    FROM
        tb_rota tr
    JOIN
        tb_veiculo tv ON tr.veiculo_rota = tv.id_veiculo ORDER BY tr.id_rota DESC";


        $conn = $this->conexao->Conectar();
        $stmt = $conn->prepare($query);

        $stmt->execute();

        $r = [];

        while($retorno = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $r[] = $retorno;

        } 

        return $r;
    }

    public function atualizaRota($data_chegada_rota, $quilometragem_chegada_rota, $local_chegada_rota, $observacao_rota, $id_rota){

        $conn = $this->conexao->Conectar();

        $query = "UPDATE tb_rota SET data_chegada_rota = :data_chegada_rota, quilometragem_chegada_rota = :quilometragem_chegada_rota, local_chegada_rota = :local_chegada_rota, observacao_rota = :observacao_rota  WHERE id_rota = :id_rota";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':data_chegada_rota', $data_chegada_rota);
        $stmt->bindParam(':quilometragem_chegada_rota', $quilometragem_chegada_rota);
        $stmt->bindParam(':local_chegada_rota', $local_chegada_rota);
        $stmt->bindParam(':observacao_rota', $observacao_rota);
        $stmt->bindParam(':id_rota', $id_rota);

        $stmt->execute();
        
    }

    public function chamaRotaEspecifica($id){

        $query = "SELECT * FROM tb_rota WHERE id_rota = :id_rota LIMIT 1";

        $conn = $this->conexao->Conectar();
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id_rota', $id);

        $stmt->execute();

        $r = [];

        while($retorno = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $r[] = $retorno;

        } 

        return $r;

    }


}

class Usuario {

    private $id;
    private $conexao;
    private $nome_usuario;
    private $cpf_usuario;
    private $senha_usuario;
    private $tipo_usuario;


    // Adicione um construtor para inicializar a conexão
    public function __construct() {
        $this->conexao = new Conexao();
    }

    public function consultarUsuario($login, $senha){

        $query = "SELECT * FROM tb_usuario WHERE cpf_usuario = :login LIMIT 1";

        $conn = $this->conexao->Conectar();

        $stmt = $conn->prepare($query);  
        $stmt->bindParam(':login', $login);
        // $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        return $usuario;
    }

    public function consultarUsuarioCadastrado($cpf){

        $query = "SELECT cpf_usuario FROM tb_usuario WHERE cpf_usuario = :cpf LIMIT 1";

        $conn = $this->conexao->Conectar();

        $stmt = $conn->prepare($query);  
        $stmt->bindParam(':cpf', $cpf);
        // $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        return $usuario;
    }

    public function inserirUsuario($nome_usuario, $cpf_usuario, $senha_usuario, $tipo_usuario, $setor_usuario){

        $query = "INSERT INTO tb_usuario (nome_usuario, cpf_usuario, senha_usuario, tipo_usuario, setor_usuario) VALUES (:nome_usuario, :cpf_usuario, :senha_usuario, :tipo_usuario, :setor_usuario)";
        
        $conn = $this->conexao->Conectar();

        $stmt = $conn->prepare($query);  
        $stmt->bindParam(':nome_usuario', $nome_usuario);
        $stmt->bindParam(':cpf_usuario', $cpf_usuario);
        $stmt->bindParam(':senha_usuario', $senha_usuario);
        $stmt->bindParam(':tipo_usuario', $tipo_usuario);
        $stmt->bindParam(':setor_usuario', $setor_usuario);

        $stmt->execute();
    }

    public function atualizarUsuario($id, $nome_usuario, $tipo_usuario){

        $conn = $this->conexao->Conectar();

        $query = "UPDATE tb_usuario SET nome_usuario = :nome_usuario, tipo_usuario = :tipo_usuario WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':nome_usuario', "$nome_usuario");
        $stmt->bindValue(':tipo_usuario', "$tipo_usuario");
        $stmt->bindValue(':id', $id);
        
        $stmt->execute();


    }

    public function atualizarSenhaUsuario($id, $senha){

        $conn = $this->conexao->Conectar();

        $query = "UPDATE tb_usuario SET senha_usuario = :senha_usuario WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':senha_usuario', "$senha");
        $stmt->bindValue(':id', $id);
        
        $stmt->execute();


    }

    public function chamaUsuario($id){

        $conn = $this->conexao->Conectar();

        $query = "SELECT * FROM tb_usuario WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam('id', $id);

        $stmt->execute(); 

        $r = $stmt->fetch(PDO::FETCH_ASSOC);

        return $r;


    }

}

// Função para verificar se há uma sessão aberta
function verificarSessao() {
    session_start();
    // ob_start(); // Se necessário, descomente esta linha

    if($_SESSION['tipo_usuario'] === 'u'){

        header("Location: index.php?usuario=negado");
        exit(); // Importante para evitar execução adicional após o redirecionamento

    } else {

        if ((!isset($_SESSION['id_usuario'])) AND (!isset($_SESSION['nome_usuario']))) {
            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Necessário realizar o login para acessar a página! </p>";
            
        }


    }
    
}




?>