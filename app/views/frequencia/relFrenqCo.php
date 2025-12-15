<style>
    /* ===== ESTILO GERAL (MESMO DO PRIMEIRO) ===== */
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
        background: #ffffff !important;
        font-weight: bold;
        padding: 1rem 1.2rem;
        color: #495057;
    }

    .card:hover {
        transform: translateY(-3px);
        transition: 0.2s ease-in-out;
    }

    /* Botões */
    .btn-filtrar,
    .btn-primary,
    .btn-success {
        background-color: #a0c4ff !important;
        border: 1px solid #85a3e1 !important;
        color: #344767 !important;
        padding: 8px 18px !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
    }

    .btn-primary:hover,
    .btn-success:hover,
    .btn-filtrar:hover {
        background-color: #8db7ff !important;
    }

    /* Inputs */
    .form-control,
    .form-select {
        border-radius: 10px !important;
        background: #ffffff !important;
        border: 1px solid #d0d7e2 !important;
        box-shadow: none !important;
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

<?php 

        function formatarEnsino($tipo)
                    {
                        $tipo = strtolower(trim($tipo));

                        return match ($tipo) {
                            'ef1' => 'Ensino Fundamental I',
                            'ef2' => 'Ensino Fundamental II',
                            'em'  => 'Ensino Médio',
                            default => ucfirst($tipo)
                        };
                    }


                    function formatarTurno($t)
                    {
                        return match (strtolower(trim($t))) {
                            'manha', 'manhã', 'm' => 'Manhã',
                            'tarde', 't' => 'Tarde',
                            'integral', 'i' => 'Integral',
                            default => mb_convert_case($t, MB_CASE_TITLE, "UTF-8")
                        };
                    }
?>

<div class="container mt-4 pt-4">

    <!-- TÍTULO PRINCIPAL (padronizado) -->
    <h2 class="mb-4 text-center fw-bold">
        Relatório de Frequência – Coordenação
    </h2>

    <!-- FILTRO -->
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <form method="POST">
                <div class="row g-3 justify-content-center text-center align-items-center">

                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted">Data do Relatório:</label>
                        <input type="date" id="data_falta" name="data_falta"
                               class="form-control"
                               value="<?php echo isset($data_falta) ? $data_falta : date('Y-m-d'); ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-semibold text-muted">Turma:</label>
                        <select id="id_turma" name="id_turma" class="form-select">
                            <option value="">Selecione uma turma</option>
                            <?php foreach ($turmas as $turma) { ?>
                                <option value="<?= $turma['id_turma'] ?>">
                                    <?= $turma['nro_turma'] . 'º do ' . formatarEnsino($turma['tipo_ensino'])?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-center gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            Consultar
                        </button>

                        <a id="btnImprimir" href="#" target="_blank" class="btn btn-success w-100">
                            Imprimir
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- RESUMO DA FREQUÊNCIA -->
    <div class="card shadow-sm mb-5">
        <div class="card-header" style="border-bottom: 2px solid #a0c4ff;">
            Frequência por Turma
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
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
                                   <td><?= htmlspecialchars($item['nro_turma'] . 'º do ' . formatarEnsino($item['tipo_ensino'])); ?></td>

                                    <td class="text-center fw-bold"><?= htmlspecialchars($item['quantidade_presentes']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2" class="text-center text-muted py-3">Nenhum registro encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- ========================= -->
    <!--   ORGANIZAÇÃO DOS BLOCOS -->
    <!-- ========================= -->

    <?php
    if (!empty($relatorio_es)) :

        $ordemEnsino = ['ef1', 'ef2', 'em'];

        function getTurmaInfo($id, $turmas) {
            foreach ($turmas as $t) if ($t['id_turma'] == $id) return $t;
            return null;
        }

        uksort($relatorio_es, function($A, $B) use ($turmas, $ordemEnsino) {
            $a = getTurmaInfo($A, $turmas);
            $b = getTurmaInfo($B, $turmas);

            $ordA = array_search($a['tipo_ensino'], $ordemEnsino);
            $ordB = array_search($b['tipo_ensino'], $ordemEnsino);

            return $ordA === $ordB ? ($a['nro_turma'] <=> $b['nro_turma']) : ($ordA <=> $ordB);
        });

        $blocos = [
            'ef1' => ['titulo' => 'Ensino Fundamental I', 'cor' => '#6ea8fe'],
            'ef2' => ['titulo' => 'Ensino Fundamental II', 'cor' => '#85c88a'],
            'em'  => ['titulo' => 'Ensino Médio',         'cor' => '#ffda6a']
        ];


        $ultimo = null;
    ?>

    <?php foreach ($relatorio_es as $id_turma => $lista): ?>
        <?php
            $info = getTurmaInfo($id_turma, $turmas);
            $tipo = $info['tipo_ensino'];
        ?>

        <?php if ($ultimo !== $tipo): ?>
            <h4 class="titulo-bloco mt-5 mb-3" style="border-color: <?= $blocos[$tipo]['cor'] ?>;">
                <?= $blocos[$tipo]['titulo'] ?>
            </h4>
            <?php $ultimo = $tipo; ?>
        <?php endif; ?>

        <div class="card card-turma shadow-sm mb-4"
             style="border-left: 6px solid <?= $blocos[$tipo]['cor'] ?>;">
            <div class="card-header" style="border-bottom: 2px solid <?= $blocos[$tipo]['cor'] ?>;">
                <?= $info['nro_turma'] ?>º — <?= $blocos[$tipo]['titulo'] ?>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr><th>Estudantes Ausentes</th></tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($lista)): ?>
                            <?php foreach ($lista as $nome): ?>
                                <tr><td><?= htmlspecialchars($nome) ?></td></tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td class="text-center py-3 text-muted">Nenhum estudante ausente.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
    <?php endforeach; ?>
    <?php endif; ?>

</div>


<script>
document.getElementById('btnImprimir').addEventListener('click', function(event) {
    event.preventDefault();

    const data = document.getElementById('data_falta').value.trim();
    const turma = document.getElementById('id_turma').value.trim();

    if (!data) { alert('Por favor, selecione a data.'); return; }

    let params = new URLSearchParams();
    params.append('data_falta', data);
    if (turma) params.append('id_turma', turma);

    window.open('./pdfRelFrenqCo?' + params.toString(), '_blank');
});
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>