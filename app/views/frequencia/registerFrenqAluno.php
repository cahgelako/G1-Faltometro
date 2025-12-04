<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4 p-md-5">
                    <h2 class="card-title text-center text-dark mb-4 pb-2 border-bottom">
                        <i class="fas fa-user-times me-2"></i>
                        Registro de Faltas (Chamada)
                    </h2>

                    <?php
                    /* // Se a variável $nome_classe estiver disponível:
                    if (isset($nome_classe)) { ?>
                        <p class="text-center lead mb-4 text-muted">Classe: <strong><?= htmlspecialchars($nome_classe) ?></strong></p>
                    <?php } 
                    */
                    ?>

                    <form method="POST">
                        <input type="hidden" name="id_turma" value="<?= htmlspecialchars($_GET['id_turma']) ?>">

                        <div class="row mb-4">
                            <div class="col-md-6 offset-md-3">
                                <label for="data_falta" class="form-label fw-bold text-danger">
                                    <i class="fas fa-calendar-alt me-1"></i> Data do Registro
                                </label>
                                <input type="date" name="data_falta" id="data_falta" class="form-control form-control-lg" required>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-dark">
                                <i class="fas fa-list-check me-1"></i> Marque os alunos **AUSENTES**:
                            </h5>

                            <div class="p-3 border rounded-3 bg-light" style="max-height: 300px; overflow-y: auto;">

                                <?php if (!empty($estudantes)): ?>
                                    <div class="list-group list-group-flush">
                                        <?php foreach ($estudantes as $estudante): ?>
                                            <?php
                                            // A chave 'status_presenca' só existe se a frequência já foi registrada para hoje.
                                            // Sua controller usa 0 para Ausente e 1 para Presente.
                                            $registro_existe = isset($estudante['status_presenca']);
                                            $esta_ausente = $registro_existe && ($estudante['status_presenca'] == 'ausente');

                                            // Define o ID de matrícula para uso no HTML
                                            $matricula_id = htmlspecialchars($estudante['id_matricula']);

                                            // Define a classe CSS para destaque visual (Opcional: Destaca o aluno ausente/faltante)
                                            $classe_item = $esta_ausente ? 'list-group-item d-flex align-items-center bg-danger bg-opacity-25' : 'list-group-item d-flex align-items-center bg-light';
                                            ?>

                                            <div class="<?= $classe_item ?>">
                                                <input class="form-check-input me-3 mt-0" type="checkbox"
                                                    value="<?= $matricula_id ?>"
                                                    name="id_matricula[]"
                                                    id="matricula_<?= $matricula_id ?>"

                                                    <?php if ($esta_ausente): ?>
                                                    checked
                                                    <?php endif; ?>>

                                                <label class="form-check-label w-100 fw-medium"
                                                    for="matricula_<?= $matricula_id ?>">

                                                    <?= htmlspecialchars($estudante['nome_estudante']) ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-center text-muted m-0">Nenhum estudante encontrado nesta classe.</p>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                            <a href="./listFrenqTu" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-arrow-left me-1"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                <i class="fas fa-save me-1"></i>
                                <?= isset($edit) ? 'Atualizar Faltas' : 'Registrar Faltas' ?>
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