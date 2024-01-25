<?php
include "Classes.php";
include '../assets/lib/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$datas = $_POST;

if (!empty($datas)) {

    $func = new Rotas;
    $chamaRotas = $func->chamaRotaPorData($datas['data_inicial'], $datas['data_final']);

    $options = new Options();
    $dompdf = new Dompdf(['enable_remote' => true]);

    $html = "";
    $html .= "<!doctype html>";
    $html .= "<html lang='pt-br'>";
    $html .= "<head>";
    $html .= "<meta charset='utf-8'>";
    $html .= "<meta name='viewport' content='width=device-width, initial-scale=1'>";
    $html .= "<title>Relatório de Viagens</title>";
    $html .= "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>";
    $html .= "</head>";

    $html .= "<body>";
    $html .= "<center>";
    $html .= "<img width='200px' src='http://localhost/Gas_Control/assets/img/gas_logo.png'>";
    $html .= "<p class='text-center small'>Seu Sistema de Controle de Rotas e Abastecimento</p>";
   $html .= "</center>";

    // $html .= "<hr>";

    $html .= "<div>";
    $html .= "<h4>Relatório de Viagens</h4>";
    $html .= "<small><strong>Período " . date('d/m/Y', strtotime($datas['data_inicial'])) . " - " . date('d/m/Y', strtotime($datas['data_final'])) . "</strong></small>";
    $html .= "</div>";
    $html .= "</br>";

    $html .= "<table class='table'>";
    // Lógica PHP para listar corretamente
    $currentRota = null;

    foreach($chamaRotas as $Rotas) {

        if($currentRota !== $Rotas['id_rota']) {


            if ($currentRota !== null) {
                $html .= "</tbody></table>"; 
            }

            $html .= "<table class='table'>";
            $html .= "<thead>";
            $html .= "<tr>";
            $html .= "<th><small>Data de Saída</small></th>";
            $html .= "<th><small>Km Saída</small></th>";
            $html .= "<th><small>Local Saída</small></th>";
            $html .= "<th><small>Data de Chegada</small></th>";
            $html .= "<th><small>Km Chegada</small></th>";
            $html .= "<th><small>Local de Chegada</small></th>";
            // $html .= "<th><small>Veiculo Utilizado</small></th>";
            $html .= "<th><small>Motorista</small></th>";
            // $html .= "<th><small>Observações</small></th>";
            $html .= "</tr>";
            $html .= "</thead>";
            $html .= "<tbody>";

            $currentRota = $Rotas['id_rota'];
        }

        // Exibir os dados da tabela

        $html .= "<tr>";
            $html .= "<td><small>" . date('d/m/Y', strtotime($Rotas['data_saida_rota'])) . "</small></td>";
            $html .= "<td><small>" . $Rotas['quilometragem_saida_rota'] . "</small></td>";
            $html .= "<td><small>" . $Rotas['local_saida_rota'] . "</small></td>";
            $html .= "<td><small>" . date('d/m/Y', strtotime($Rotas['data_chegada_rota'])) . "</small></td>";
            $html .= "<td><small>" . $Rotas['quilometragem_chegada_rota'] . "</small></td>";
            $html .= "<td><small>" . $Rotas['local_chegada_rota'] . "</small></td>";
            // $html .= "<td><small>" . $Rotas['veiculo_rota'] . "</small></td>";
            $html .= "<td><small>" . $Rotas['usuario_rota'] . "</small></td>";
            // $html .= "<td><small>" . $Rotas['observacao_rota'] . "</small></td>";
        $html .="</tr>";

    }
    $html .= "</tbody></table> ";
    $html .= "</table> </br></br>";

    $html .= "</body>";
    $html .= "</html>";

    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    $dompdf->render();

    // Limpa o buffer de saída antes de enviar cabeçalhos HTTP
    ob_clean();

    $dompdf->stream("Relatório de Entrada data " . $datas['data_inicial'] . "-" . $datas['data_final']);
}

?>