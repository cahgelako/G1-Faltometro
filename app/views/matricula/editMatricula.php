<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">

                    <h2 class="card-title text-center fw-bold text-dark mb-4">
                        <i class="fas fa-edit me-2 text-secondary"></i>
                        Editar Matrícula
                    </h2>

                    <form method="POST">
                        <input type="hidden" readonly name="id_matricula" value="<?= $matricula['id_matricula'] ?? '' ?>">

                        <h5 class="mb-3 text-secondary border-bottom pb-1">Detalhes da Matrícula</h5>

                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label for="data_matricula" class="form-label small text-muted">Data da Matrícula</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" class="form-control" id="data_matricula" name="data_matricula"
                                        value="<?= $matricula['data_matricula'] ?? '' ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="ativo" class="form-label small text-muted">Status</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                    <select name="ativo" class="form-select" id="ativo" required>
                                        <option value="" <?= (isset($matricula['ativo']) && $matricula['ativo'] == '') ? 'selected' : '' ?>>Escolha um Status</option>
                                        <option value="1" <?= (isset($matricula['ativo']) && $matricula['ativo'] == 1) ? 'selected' : '' ?>>Ativado</option>
                                        <option value="0" <?= (isset($matricula['ativo']) && $matricula['ativo'] == 2) ? 'selected' : '' ?>>Desativado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-3 mt-3 text-secondary border-bottom pb-1">Associações</h5>

                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label for="id_classe" class="form-label small text-muted">Classe (Turma/Ano/Turno)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-school"></i></span>
                                    <select name="id_classe" class="form-select" id="id_classe" required>
                                        <option value="">Escolha uma Classe</option>
                                        <?php
                                        foreach ($classes as $classe):
                                            // Define o Badge e o valor de exibição do Turno
                                            if ($classe['turno'] == 1) {
                                                $turno_badge = "Manhã";
                                                $badge_class = "badge-manha";
                                            } elseif ($classe['turno'] == 2) {
                                                $turno_badge = "Tarde";
                                                $badge_class = "badge-tarde";
                                            } else {
                                                $turno_badge = "Integral";
                                                $badge_class = "badge-integral";
                                            }

                                            // Verifica se a classe está ativa
                                            $is_selected = (isset($matricula['id_classe']) && $classe['id_classe'] == $matricula['id_classe']) ? 'selected' : '';

                                            // Apenas exibe classes ativas no dropdown (ativo == 1)
                                            if (isset($classe['ativo']) && $classe['ativo'] == 1) { ?>
                                                <option value="<?= $classe['id_classe'] ?>" <?= $is_selected ?>>
                                                    <?= $classe['nome_turma'] ?> | <?= $classe['ano_turma'] ?> | <?= $turno_badge ?>
                                                </option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="id_estudante" class="form-label small text-muted">Estudante</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-graduate"></i></span>
                                    <select name="id_estudante" class="form-select" id="id_estudante" required>
                                        <option value="">Escolha um Estudante</option>
                                        <?php foreach ($estudantes as $estudante):
                                            // Verifica se este estudante é o atualmente selecionado na matrícula
                                            $is_selected = (isset($matricula['id_estudante']) && $estudante['id_estudante'] == $matricula['id_estudante']) ? 'selected' : '';
                                        ?>
                                            <option value="<?= $estudante['id_estudante'] ?>" <?= $is_selected ?>>
                                                <?= $estudante['nome_estudante'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-3">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="./listMatricula" class="btn btn-secondary px-4">
                                <i class="fas fa-arrow-left me-1"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                <i class="fas fa-sync-alt me-1"></i> Atualizar
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>