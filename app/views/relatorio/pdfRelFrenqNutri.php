<?php
// ======================
// Função auxiliar faltante
// ======================
if (!function_exists('formatarEnsino')) {
    function formatarEnsino($tipo)
    {
        switch ($tipo) {
            case 'ef1':
                return 'Ensino Fundamental I';
            case 'ef2':
                return 'Ensino Fundamental II';
            case 'em':
                return 'Ensino Médio';
            default:
                return 'Ensino Não Informado';
        }
    }
}
?>

<style>
    body {
        background: #ffffff;
        font-family: Arial, sans-serif;
        color: #333;
    }

    h2 {
        font-weight: bold;
        font-size: 22px;
        color: #1a73e8;
        text-align: center;
        letter-spacing: .5px;
        margin-bottom: 25px;
    }

    .card {
        background: #ffffff;
        border: 1px solid #cfd8e3 !important;
        border-radius: 8px !important;
        box-shadow: none !important;
        margin-bottom: 20px;
    }

    .card-header {
        background: #e8f0fe !important;
        color: #1a73e8 !important;
        font-weight: bold;
        border-bottom: 1px solid #b5c8e6 !important;
        padding: 10px 14px;
    }

    .card-body {
        padding: 15px;
    }

    label {
        font-size: 12px;
        font-weight: bold;
        color: #1a73e8;
    }

    .form-control,
    select {
        border: 1px solid #b5c8e6;
        border-radius: 5px;
        padding: 6px 10px;
        font-size: 14px;
    }

    .btn-filtrar {
        background: #1a73e8 !important;
        border-radius: 5px !important;
        border: none !important;
        color: white !important;
        padding: 7px 18px;
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 12px;
        font-size: 10pt;
    }

    th {
        background: #e8f0fe !important;
        color: #1a73e8 !important;
        text-align: center;
        padding: 6px;
        border: 1px solid #b5c8e6;
        font-weight: bold;
    }

    td {
        border: 1px solid #d6d6d6;
        padding: 6px;
    }

    tr:nth-child(even) td {
        background: #f7f9fc;
    }

    caption {
        font-size: 12px;
        color: #1a73e8;
        padding-bottom: 4px;
        text-align: left;
    }

    .card-turma {
        border-left: 4px solid #1a73e8 !important;
    }

    .badge {
        background: #e8f0fe;
        color: #1a73e8;
        padding: 4px 8px;
        border-radius: 4px;
        margin-right: 4px;
        font-size: 11px;
    }
</style>

<div class="container mt-4">

    <h2>Relatório de Frequência Nutricional</h2>

    <!-- FREQUÊNCIA POR TURMA -->
    <div class="card">
        <div class="card-header">Frequência por Turma</div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table caption-top">
                    <caption>Resumo da frequência por turma.</caption>

                    <thead>
                        <tr>
                            <th>Turma</th>
                            <th>Presentes</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($relatorio)) : ?>
                            <?php foreach ($relatorio as $item) : ?>
                                <tr>
                                    <td>
                                        <?= htmlspecialchars($item['nro_turma'] . 'º do ' . formatarEnsino($item['tipo_ensino'])); ?>
                                    </td>
                                    <td style="text-align:center; font-weight:bold;">
                                        <?= htmlspecialchars($item['quantidade_presentes']); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2" class="text-center">Nenhum registro encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>


    <!-- DIETA ESPECIAL -->
    <div class="card">
        <div class="card-header">
            Estudantes com Dieta Especial
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Turma</th>
                        <th>Dietas</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($agrupado as $aluno): ?>
                        <tr>
                            <td><?= htmlspecialchars($aluno['nome']) ?></td>
                            <td><?= htmlspecialchars($aluno['nro_turma']) . "º do " . formatarEnsino($aluno['tipo_ensino']) ?></td>
                            <td>
                                <?php foreach ($aluno['dietas'] as $d): ?>
                                    <span class="badge"><?= htmlspecialchars($d) ?></span>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>


    <!-- PROJETOS - AUSENTES -->
    <?php if (!empty($relatorio_proj)) : ?>
        <?php foreach ($relatorio_proj as $id_projeto => $lista) : ?>

            <div class="card card-turma">
                <div class="card-header">
                    <?php foreach ($lista_projetos as $projeto) {
                        if ($projeto['id_projeto'] == $id_projeto) {
                            switch ($projeto['turno']) {
                                case '1': $turno = 'Manhã'; break;
                                case '2': $turno = 'Tarde'; break;
                                case '3': $turno = 'Integral'; break;
                            }
                            echo $projeto['nome_projeto'] . ' - ' . $turno;
                        }
                    } ?>
                </div>

                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Estudantes Ausentes</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($lista)) : ?>
                                <?php foreach ($lista as $estudante) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($estudante['nome_estudante']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td class="text-center py-3">Nenhum estudante ausente.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>

</div>
