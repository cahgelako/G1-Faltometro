<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Atribuir Dieta</h2>
                    <form method="POST">
                        <div class="row">
                           <div class="col-sm-3 mb-3">
                                <label for="id_estudante" class="form-label">Estudante</label>
                                    <select class="form-select" name="id_aluno" id="aluno" required>
                                        <option value="">-- Selecione um aluno --</option>
                                        <?php foreach ($estudantes as $aluno) { ?>
                                            <option value="<?= $aluno['id_estudante'] ?>"><?= htmlspecialchars($aluno['nome_estudante']) ?></option>
                                            <?php } ?>
                                        </select>
                            </div>
                        </div>
                        <a href="./editAtriDieta&id_estudante=<?= $aluno['id_estudante'] ?>" class="btn btn-secondary">Avançar para Dietas</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>