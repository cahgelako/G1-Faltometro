<style>
    /* ===== ESTILO GERAL ===== */
    body {
        background: #f5f7fb;
    }

    h2, h4, h5 {
        color: #495057;
    }

    .card {
        border-radius: 16px !important;
        border: none !important;
        overflow: hidden;
    }

    .card-header {
        font-weight: bold;
        padding: 1rem 1.2rem;
        background: #ffffff !important;
    }

    .card:hover {
        transform: translateY(-3px);
        transition: 0.2s ease-in-out;
    }

    /* Botão */
    .btn-filtrar {
        background-color: #a0c4ff !important;
        border: 1px solid #85a3e1 !important;
        color: #344767 !important;
        padding: 8px 18px !important;
        border-radius: 10px !important;
        font-weight: 600;
    }

    .btn-filtrar:hover {
        background-color: #8db7ff !important;
    }

    /* Tabelas */
    table {
        border-radius: 12px !important;
        overflow: hidden !important;
    }

    thead {
        background-color: #dbeaff !important;
        color: #495057 !important;
    }

    tbody tr:hover td {
        background-color: #f0f4ff !important;
    }

    caption {
        font-size: 0.95rem;
        padding: 6px 0;
        color: #495057 !important;
    }

    /* Cards por turma */
    .card-turma {
        border-radius: 14px !important;
        border: none !important;
    }

    .card-turma .card-header {
        font-size: 1.1rem;
    }

    .titulo-bloco {
        font-size: 1.4rem;
        font-weight: bold;
        padding-left: 4px;
        border-left: 8px solid;
    }
</style>


<div class="container mt-3 pt-5">

    <h2 class="mb-4 text-center fw-bold">Relatório de Frequência Nutricional</h2>

    <!-- FILTRO -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="POST">
                <div class="row g-3 align-items-center justify-content-center">
                    <div class="col-auto">
                        <label for="data_falta" class="fw-bold">Selecione a Data:</label>
                    </div>

                    <div class="col-auto">
                        <input type="date" id="data_falta" name="data_falta" class="form-control"
                               value="<?php echo isset($data_falta) ? $data_falta : date('Y-m-d'); ?>" required>
                    </div>

                    <div class="col-auto">
                        <select name="turno" id="turno">
                            <option value="">Escolha um turno</option>
                            <option value="manha">Manhã</option>
                            <option value="tarde">Tarde</option>
                            <option value="integral">Integral</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-filtrar">
                            <i class="bi bi-filter"></i> Filtrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- FREQUÊNCIA POR TURMA -->
    <div class="card shadow-sm mb-4">
        <div class="card-header" style="border-bottom: 2px solid #a0c4ff;">Frequência por Turma</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover caption-top">
                    <caption>Resumo da frequência por turma na data selecionada.</caption>

                    <thead>
                        <tr>
                            <th>Turma</th>
                            <th class="text-center">Presentes</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($relatorio)) : ?>
                            <?php foreach ($relatorio as $item) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['nro_turma'] . 'º do ' . $item['tipo_ensino']) ?></td>
                                    <td class="text-center fw-bold"><?= htmlspecialchars($item['quantidade_presentes']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr><td colspan="2" class="text-center">Nenhum registro encontrado.</td></tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>


    <!-- === ORDENAÇÃO E LISTA DOS AUSENTES === -->

    <?php
    $ordemEnsino = ['ef1', 'ef2', 'em'];

    function getTurmaInfo($id, $turmas) {
        foreach ($turmas as $t) {
            if ($t['id_turma'] == $id) return $t;
        }
        return null;
    }

    if (!empty($relatorio_es)) {
        uksort($relatorio_es, function($A, $B) use ($turmas, $ordemEnsino) {
            $tA = getTurmaInfo($A, $turmas);
            $tB = getTurmaInfo($B, $turmas);

            $oA = array_search($tA['tipo_ensino'], $ordemEnsino);
            $oB = array_search($tB['tipo_ensino'], $ordemEnsino);

            return $oA === $oB
                ? ($tA['nro_turma'] <=> $tB['nro_turma'])
                : ($oA <=> $oB);
        });
    }

    $blocos = [
        'ef1' => ['titulo' => 'Ensino Fundamental I', 'cor' => '#6ea8fe'],
        'ef2' => ['titulo' => 'Ensino Fundamental II', 'cor' => '#85c88a'],
        'em'  => ['titulo' => 'Ensino Médio',         'cor' => '#ffda6a']
    ];

    $ultimo = null;
    ?>


    <?php if (!empty($relatorio_es)) : ?>
        <?php foreach ($relatorio_es as $id_turma => $lista) : ?>
            <?php $info = getTurmaInfo($id_turma, $turmas); ?>
            <?php $tipo = $info['tipo_ensino']; ?>

            <!-- TÍTULO DO BLOCO -->
            <?php if ($ultimo !== $tipo): ?>
                <h4 class="titulo-bloco mt-5 mb-3" style="border-color: <?= $blocos[$tipo]['cor'] ?>;">
                    <?= $blocos[$tipo]['titulo'] ?>
                </h4>
                <?php $ultimo = $tipo; ?>
            <?php endif; ?>

            <!-- CARD DA TURMA -->
            <div class="card card-turma shadow-sm mb-4" style="border-left: 6px solid <?= $blocos[$tipo]['cor'] ?>;">
                <div class="card-header" style="border-bottom: 2px solid <?= $blocos[$tipo]['cor'] ?>;">
                    <?= $info['nro_turma'] ?>º — <?= $blocos[$tipo]['titulo'] ?>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr><th>Estudantes Ausentes</th></tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($lista)) : ?>
                                <?php foreach ($lista as $nome) : ?>
                                    <tr><td><?= htmlspecialchars($nome) ?></td></tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td class="text-center py-3 text-muted">Nenhum estudante ausente.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>


    <!-- DIETA ESPECIAL -->
    <div class="card shadow-sm mb-4">
        <div class="card-header" style="border-bottom: 2px solid #a0c4ff;">
            Estudantes com Dieta Especial
        </div>

        <div class="card-body">
            <table class="table table-striped table-hover">
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
                            <td><?= htmlspecialchars($aluno['turma']) ?></td>
                            <td>
                                <?php foreach ($aluno['dietas'] as $d): ?>
                                    <span class="badge" style="background: #a0c4ff; color: #333;">
                                        <?= htmlspecialchars($d) ?>
                                    </span>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>

</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
