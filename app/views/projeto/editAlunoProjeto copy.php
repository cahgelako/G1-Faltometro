<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                <?php
                    // Agrupar alunos pelo projeto
                    $projetos = [];

                    foreach ($estudantes as $item) {
                        $projetos[$item['nome_projeto']][] = [
                            'nome_estudante' => $item['nome_estudante'],
                            'id_matricula'   => $item['id_matricula']
                        ];
                    }
                ?>

                <form method="POST">

                    <h5 class="mb-3 text-secondary border-bottom pb-1">Alunos</h5>

                    <div class="row">

                        <div class="col-sm-12 mb-4">

                            <?php if (!empty($projetos)): ?>

                                <?php foreach ($projetos as $nomeProjeto => $alunos): ?>

                                    <h4 class="fw-bold mt-3 mb-2 text-primary">
                                        <?= htmlspecialchars($nomeProjeto) ?>
                                    </h4>

                                    <div class="list-group list-group-flush">

                                        <?php foreach ($alunos as $aluno): ?>
                                            <div class="list-group-item d-flex align-items-center bg-light">

                                                <input 
                                                    class="form-check-input me-3 mt-0" 
                                                    type="checkbox"
                                                    value="<?= htmlspecialchars($aluno['id_matricula']) ?>" 
                                                    name="arr_mat_id[]" 
                                                    id="mat_<?= htmlspecialchars($aluno['id_matricula']) ?>"
                                                    checked
                                                >

                                                <label class="form-check-label w-100 fw-medium" 
                                                    for="mat_<?= htmlspecialchars($aluno['id_matricula']) ?>">
                                                    <?= htmlspecialchars($aluno['nome_estudante']) ?>
                                                </label>

                                            </div>
                                        <?php endforeach; ?>

                                    </div>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <p class="text-muted text-center">Nenhum estudante encontrado.</p>

                            <?php endif; ?>

                        </div>

                    </div>

                    <hr class="mt-4 mb-3">

                    <div class="d-flex justify-content-end gap-2">

                        <a href="./listProjeto" class="btn btn-secondary px-4">
                            <i class="fas fa-arrow-left me-1"></i> Voltar
                        </a>

                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fas fa-sync-alt me-1"></i> Atualizar Dados
                        </button>

                    </div>

                </form>

            </div>

            </div>
        </div>
    </div>
</div>