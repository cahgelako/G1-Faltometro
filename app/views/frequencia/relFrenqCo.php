<div class="container my-5">
    <h2 class="mb-5 text-center fw-bold" style="color: #007bff;">
        <i class="bi bi-bar-chart-line-fill me-2"></i> Relatório de Frequência Nutricional
    </h2>

    <div class="card mb-5 shadow-sm border-0" style="border-left: 5px solid #007bff;">
        <div class="card-body">
            <form method="POST" action="">
                <div class="row g-3 align-items-center justify-content-center">
                    <div class="col-auto">
                        <label for="data_falta" class="col-form-label fw-semibold text-muted">Data do Relatório:</label>
                    </div>
                    <div class="col-auto">
                        <input type="date" id="data_falta" name="data_falta" class="form-control"
                            style="border-color: #ced4da;"
                            value="<?php echo isset($data_falta) ? $data_falta : date('Y-m-d'); ?>" required>
                    </div>
                    <div class="col-auto">
                        <select name="id_turma" id="id_turma">
                            <?php foreach ($turmas as $turma) { ?>
                                <option value="<?= $turma['id_turma'] ?>"><?= $turma['nro_turma'] ?>º ano do <?= $turma['tipo_ensino'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary shadow-sm">
                            <i class="bi bi-search"></i> Consultar
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <div class="card mb-5 shadow-lg border-0">
        <div class="card-header bg-white pt-3" style="border-bottom: 3px solid #007bff;">
            <h5 class="mb-0 fw-bold" style="color: #343a40;">
                <i class="bi bi-building me-2"></i> Frequência por Turma
            </h5>
            <small class="text-muted">Resumo da frequência por turma na data selecionada.</small>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #e9f1ff; color: #343a40;">
                        <tr>
                            <th class="py-3">Turma</th>
                            <th class="text-center py-3">Quantidade de Presentes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($relatorio)) : ?>
                            <?php foreach ($relatorio as $item) : ?>
                                <tr>
                                    <td class="align-middle"><?php echo htmlspecialchars($item['nro_turma'] . 'º do ' . $item['tipo_ensino']); ?></td>
                                    <td class="text-center align-middle fw-semibold text-primary"><?php echo htmlspecialchars($item['quantidade_presentes']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2" class="text-center text-muted py-4">Nenhum registro de frequência encontrado para esta data.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if (!empty($relatorio_es)) :
        var_dump($relatorio_es);
    ?>
        <div class="card mb-5 shadow-lg border-0">
            <div class="card-header bg-white pt-3" style="border-bottom: 3px solid #007bff;">
                <h5 class="mb-0 fw-bold" style="color: #343a40;">
                    <i class="bi bi-building me-2"></i> Frequência da Turma
                </h5>
                <small class="text-muted">Resumo da frequência por turma na data selecionada.</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #e9f1ff; color: #343a40;">
                            <tr>
                                <th class="py-3">Nome do Estudante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($relatorio_es as $item) : ?>
                                <tr>
                                    <td class="align-middle"><?php echo htmlspecialchars($item['nome_estudante']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2" class="text-center text-muted py-4">Nenhum registro de frequência encontrado para esta data.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>