<style>
    /* ===== ESTILO GERAL ===== */
    body {
        background: #f5f7fb;
    }

    h2,
    h4,
    h5 {
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

    select.form-select,
    input.form-control {
        border-radius: 8px !important;
        padding: 8px 12px !important;
        border: 1px solid #ced4da;
    }

    /* Botão Filtrar */
    .btn-filtrar {
        background-color: #6c63ff;
        color: #fff;
        border-radius: 8px;
        padding: 8px 18px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-filtrar:hover {
        background-color: #5249ff;
        color: #fff;
    }

    /* Botão Imprimir */
    #btnImprimir {
        border-radius: 8px !important;
        font-weight: 600;
        padding: 8px 18px;
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
?>



<div class="container mt-3 pt-5">

    <h2 class="mb-4 text-center fw-bold">Relatório de Frequência Nutricional</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="POST">
                <div class="row g-3 align-items-center justify-content-center">

                    <div class="col-auto">
                        <label for="data_falta" class="fw-bold">Selecione a Data:</label>
                    </div>

                    <div class="col-auto">
                        <input type="date" id="data_falta" name="data_falta"
                            class="form-control"
                            value="<?php echo isset($data_falta) ? $data_falta : date('Y-m-d'); ?>" required>
                    </div>
                    <div class="col-auto">
                        <label for="data_falta" class="fw-bold">Selecione o turno da turma:</label>
                    </div>
                    <div class="col-auto">
                        <select name="turno" id="turno" class="form-select">
                            <option value="">Escolha um turno</option>
                            <option value="manha" <?= isset($turno) && $turno == 'manha' ? 'selected' : '' ?>>Manhã</option>
                            <option value="tarde" <?= isset($turno) && $turno == 'tarde' ? 'selected' : '' ?>>Tarde</option>
                            <option value="integral" <?= isset($turno) && $turno == 'integral' ? 'selected' : '' ?>>Integral</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <label for="data_falta" class="fw-bold">Selecione o projeto:</label>
                    </div>

                    <div class="col-auto">
                        <select name="projeto" id="projeto" class="form-select">
                            <option value="">Escolha um projeto</option>
                            <?php foreach ($lista_projetos as $proj) { ?>
                                <option value="<?= $proj['id_projeto'] ?>"
                                    <?= isset($projeto) && $projeto == $proj['id_projeto'] ? 'selected' : '' ?>>
                                    <?= $proj['nome_projeto'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="row justify-content-center align-items-center">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-filtrar">
                                <i class="bi bi-filter"></i> Filtrar
                            </button>
                        </div>
    
                        <div class="col-12 col-md-2 mt-2">
                            <a id="btnImprimir" href="#" target="_blank" class="btn btn-success w-100">
                                Imprimir
                            </a>
                        </div>
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
                                    <td><?= htmlspecialchars($item['nro_turma'] . 'º do ' . formatarEnsino($item['tipo_ensino'])) ?></td>
                                    <td class="text-center fw-bold"><?= htmlspecialchars($item['quantidade_presentes']) ?></td>
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
    <div class="card shadow-sm mb-4">
        <div class="card-header" style="border-bottom: 2px solid #a0c4ff;">
            Estudantes com Dieta Especial Presentes
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
                            <td><?= htmlspecialchars($aluno['nro_turma']) . "º do " . formatarEnsino($item['tipo_ensino']) ?></td>
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

    <?php if (!empty($relatorio_proj)) : ?>
        <?php foreach ($relatorio_proj as $id_projeto => $lista) : ?>

            <!-- CARD DA TURMA -->
            <div class="card card-turma shadow-sm mb-4" style="border-left: 6px solid;">
                <div class="card-header" style="border-bottom: 2px solid;">
                    <?php foreach ($lista_projetos as $projeto) {
                        if ($projeto['id_projeto'] == $id_projeto) {
                            $turno;
                            switch ($projeto['turno']) {
                                case '1':
                                    $turno = 'Manhã';
                                    break;
                                case '2':
                                    $turno = 'Tarde';
                                    break;
                                case '3':
                                    $turno = 'Integral';
                                    break;
                            }
                    ?>
                            <?= $projeto['nome_projeto'] ?> - <?= $turno ?>
                    <?php }
                    } ?>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Estudantes Ausentes</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($lista)) :
                                foreach ($lista as $estudante) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($estudante['nome_estudante']) ?></td>
                                    </tr>
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

</div>
<script>
    document.getElementById('btnImprimir').addEventListener('click', function(event) {
        event.preventDefault();

        const data = document.getElementById('data_falta').value.trim();
        const turno = document.getElementById('turno').value.trim();
        const projeto = document.getElementById('projeto').value.trim();

        if (!data) {
            alert('Por favor, selecione a data.');
            return;
        }

        let params = new URLSearchParams();
        params.append('data_falta', data);

        if (turno) params.append('turno', turno);
        if (projeto) params.append('projeto', projeto);

        window.open('./pdfRelFrenqNutri?' + params.toString(), '_blank');
    });
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>