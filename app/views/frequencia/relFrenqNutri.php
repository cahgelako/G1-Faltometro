<div class="container mt-2 pt-5">

    <h2 class="mb-4 text-center" style="color: #000000;">Relatório de Frequência Nutricional</h2>



    <div class="card mb-4 shadow-sm" style="border-color: #a0c4ff;">

        <div class="card-body">

            <form method="POST" action="">

                <div class="row g-3 align-items-center">

                    <div class="col-auto">

                        <label for="data_falta" class="col-form-label fw-bold" style="color: #495057;">Selecione a Data:</label>

                    </div>

                    <div class="col-auto">

                        <input type="date" id="data_falta" name="data_falta" class="form-control"

                            value="<?php echo isset($data_falta) ? $data_falta : date('Y-m-d'); ?>" required>

                    </div>

                    <div class="col-auto">

                        <button type="submit" class="btn" style="background-color: #a0c4ff; color: #495057; border: 1px solid #85a3e1;">

                            <i class="bi bi-filter"></i> Filtrar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <div class="card mb-4 shadow-sm" style="border-color: #a0c4ff;">

        <div class="card-header bg-white" style="border-bottom: 2px solid #a0c4ff;">

            <h5 class="mb-0 fw-bold" style="color: #495057;">Frequência por Turma</h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-hover caption-top">

                    <caption>Resumo da frequência por turma na data selecionada.</caption>

                    <thead style="background-color: #dbeaff; color: #495057;">

                        <tr>

                            <th>Turma</th>

                            <th class="text-center">Quantidade de Presentes</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($relatorio)) : ?>

                            <?php foreach ($relatorio as $item) : ?>

                                <tr>

                                    <td><?php echo htmlspecialchars($item['nro_turma'] . 'º do ' . $item['tipo_ensino']); ?></td>

                                    <td class="text-center"><?php echo htmlspecialchars($item['quantidade_presentes']); ?></td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>

                                <td colspan="2" class="text-center">Nenhum registro encontrado para a data selecionada.</td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <div class="card mb-4 shadow-sm" style="border-color: #a0c4ff;">

        <div class="card-header bg-white" style="border-bottom: 2px solid #a0c4ff;">

            <h5 class="mb-0 fw-bold" style="color: #495057;">Estudantes com Dieta Especial</h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-hover caption-top">

                    <caption>Lista de estudantes com dietas especiais na data selecionada.</caption>

                    <thead style="background-color: #dbeaff; color: #495057;">

                        <tr>

                            <th>Nome do Estudante</th>

                            <th>Turma</th>

                            <th>Dieta Especial</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($relatorio_dietas)) : ?>

                            <?php foreach ($relatorio_dietas as $item) : ?>

                                <tr>

                                    <td><?php echo htmlspecialchars($item['nome_estudante']); ?></td>

                                    <td><?php echo htmlspecialchars($item['nro_turma'] . 'º do ' . $item['tipo_ensino']); ?></td>

                                    <td>

                                        <span class="badge" style="background-color: #a0c4ff; color: #333333;">

                                            <?php echo htmlspecialchars($item['nome_dieta']); ?>

                                        </span>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>

                                <td colspan="3" class="text-center">Nenhum estudante com dieta especial encontrado para a data selecionada.</td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>