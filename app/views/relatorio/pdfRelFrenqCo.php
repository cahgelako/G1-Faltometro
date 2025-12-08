<?php
date_default_timezone_set('America/Sao_Paulo');
$dataHoje = date('d/m/Y');

function get_nome_ensino($tipo_ensino) {
    switch ($tipo_ensino) {
        case 'ef1': return 'Ensino Fundamental I';
        case 'ef2': return 'Ensino Fundamental II';
        case 'em': return 'Ensino Médio';
        default: return '';
    }
}
?>

<style>
    @page {
        margin: 1cm;
    }

    body {
        font-family: Arial, sans-serif;
        font-size: 11pt;
        color: #333;
        margin: 0;
        padding: 0;
        line-height: 1.25;
    }

    /* CONTAINER ÚNICO PARA EVITAR QUEBRAS */
    .pagina-unica {
        page-break-inside: avoid !important;
        page-break-before: avoid !important;
        page-break-after: avoid !important;
        padding: 10px 15px;
        border: 1px solid #cbd3df;
        border-radius: 6px;
        background: #fdfdfd;
    }

    /* CABEÇALHO CORPORATIVO */
    .cabecalho {
        text-align: center;
        padding: 5px 0 10px 0;
        border-bottom: 2px solid #1a73e8;
        margin-bottom: 15px;
    }

    .cabecalho h1 {
        margin: 0;
        font-size: 18pt;
        color: #1a73e8;
        letter-spacing: 0.5px;
        font-weight: bold;
    }

    .cabecalho .data-relatorio {
        margin-top: 4px;
        font-size: 10pt;
        color: #4a4a4a;
    }

    /* SUBTÍTULOS */
    h2 {
        font-size: 13pt;
        color: #1a73e8;
        margin: 15px 0 8px 0;
        padding-bottom: 3px;
        border-bottom: 1px solid #1a73e8;
        page-break-inside: avoid !important;
    }

    h4 {
        margin: 10px 0 5px 0;
        font-size: 11pt;
        color: #444;
        font-weight: bold;
        page-break-inside: avoid !important;
    }

    /* TABELAS CORPORATIVAS */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 12px;
        font-size: 10pt;
        page-break-inside: avoid !important;
        break-inside: avoid !important;
    }

    th {
        background: #e8f0fe;
        color: #1a73e8;
        padding: 6px;
        border: 1px solid #b5c8e6;
        text-align: center;
        font-weight: bold;
    }

    td {
        padding: 6px;
        border: 1px solid #d6d6d6;
        text-align: left;
    }

    tr:nth-child(even) td {
        background: #f7f9fc;
    }

    /* MENSAGENS */
    .status-ausencia {
        font-size: 10pt;
        color: #1b5e20;
        margin: 0 0 10px 0;
        page-break-inside: avoid !important;
    }
</style>


<div class="pagina-unica">

<h1>Relatório de Frequência</h1>
<h4 style="text-align: center;">Data do Relatório: <?= htmlspecialchars($dataHoje); ?></h4>

<h2>Resumo de Presenças</h2>

<table>
    <thead>
        <tr>
            <th>Nome da Turma</th>
            <th>Quantidade de Presentes</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($relatorio)): ?>
            <?php foreach ($relatorio as $r): ?>
                <?php 
                    $tipo = get_nome_ensino($r['tipo_ensino']);
                    $nome_turma = $r['nro_turma'] . 'º - ' . $tipo;
                ?>
                <tr>
                    <td><?= htmlspecialchars($nome_turma); ?></td>
                    <td style="text-align:center;"><?= htmlspecialchars($r['quantidade_presentes']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="2">Nenhum registro encontrado.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<h2>Estudantes Ausentes por Turma</h2>

<?php if (!empty($relatorio_es)): ?>
    <?php foreach ($relatorio_es as $id_turma => $item): ?>
        
        <?php
            $nome_turma_completo = 'Turma Desconhecida';
            foreach ($turmas as $turma) {
                if ($turma['id_turma'] == $id_turma) {
                    $nome_turma_completo = $turma['nro_turma'] . 'º do ' . get_nome_ensino($turma['tipo_ensino']);
                    break;
                }
            }
        ?>

        <h4>Turma: <?= htmlspecialchars($nome_turma_completo); ?></h4>

        <?php if (!empty($item)): ?>
            <table>
                <thead>
                    <tr><th>Nome do Estudante</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($item as $nome_estudante): ?>
                        <tr><td><?= htmlspecialchars($nome_estudante); ?></td></tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="status-ausencia">Nenhum estudante ausente registrado.</p>
        <?php endif; ?>

    <?php endforeach; ?>
<?php endif; ?>

</div>
