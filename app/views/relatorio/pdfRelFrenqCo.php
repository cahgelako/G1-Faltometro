<?php
require_once 'app/core/auth.php';
$html = '
        <h1 style="text-align: center;">Relatório de Presenças</h1>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                <thead style="font-size: 12px;">
                    <tr>
                        <th>Nome da Turma</th>
                        <th>Quantidade de Presentes</th>
                    </tr>
                </thead>
                <tbody style="font-size: 12px;">';
foreach ($relatorio as $r) {

    switch ($r['tipo_ensino']) {
        case 'ef1':
            $nome_turma = $r['nro_turma'] . ' - Ensino Fundamental I';
            break;

        case 'ef2':
            $nome_turma = $r['nro_turma'] . ' - Ensino Fundamental II';
            break;

        case 'em':
            $nome_turma = $r['nro_turma'] . ' - Ensino Médio';
            break;
    }
    $html .= '<td style="text-align: center;">' . $r['quantidade_presentes'] . '</td>';
    $html .= '<td style="text-align: center;">' . $nome_turma . '</td></tr>';
}
$html .= '</tbody>
            </table>
        </div>';

/* ***************************************** */
require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
//$dompdf->setPaper('A4', 'landscape');    
$dompdf->render();
$nomeArq = "Relatorio_" . $dataHoje;
$dompdf->stream($nomeArq . ".pdf", array("Attachment" => false));
