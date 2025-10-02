<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Cadastrar Turma</h2>
                    <form method="POST">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="nome_turma" class="form-label">Nome da Turma</label>
                                <input type="text" class="form-control" id="nome_turma" name="nome_turma" placeholder="ex: 3º ano do Ensino Médio" value="<?= $turmas['nome_turma'] ?? '' ?>" required>
                            </div>
                            
                            <div class="col-sm-3 mb-3">
                                <label for="grupo" class="form-label">Grupo (A / B)</label>
                                <select name="grupo" class="form-control" id="grupo">
                                    <option value="A"> Grupo A</option>
                                    <option value="B"> Grupo B</option>
                                    <option value="AB"> Grupo A e B</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><?= isset($edit) ? 'Atualizar' : 'Cadastrar' ?></button>
                        <a href="./listTurma" class="btn btn-success">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>