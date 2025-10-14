<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow-lg">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Edição Turma Extracurricular</h2>
                <form method="POST">
                    <div class="row">
                         <input type="hidden" name="id_projeto" readonly value="<?= $projeto['id_projeto'] ?? '' ?>">
                        <div class="col-sm-6 mb-3">
                            <label for="nome_projeto" class="form-label">Nome da Turma</label>
                            <input type="text" class="form-control" id="nome_projeto" name="nome_projeto" placeholder="Comitê Juventudes AntiMisoginia" value="<?= $projeto['nome_projeto'] ?? '' ?>" required>
                        </div>

                        <div class="col-sm-3 mb-3">
                            <label for="turno" class="form-label">Turno</label>
                            <select name="turno" class="form-control" id="turno" required>
                                <option value="0" <?= isset($projeto['turno']) && $projeto['turno'] == 0 ? 'selected' : '' ?>>Escolha um Turno</option>
                                <option value="1" <?= isset($projeto['turno']) && $projeto['turno'] == 1 ? 'selected' : '' ?>>Manhã</option>
                                <option value="2" <?= isset($projeto['turno']) && $projeto['turno'] == 2 ? 'selected' : '' ?>>Tarde</option>
                                <option value="3" <?= isset($projeto['turno']) && $projeto['turno'] == 2 ? 'selected' : '' ?>>Integral</option>
                                </select>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control" id="status" required>
                                <option value="0" <?= isset($projeto['status']) && $projeto['status'] == 0 ? 'selected' : '' ?>>Escolha um Status</option>
                                <option value="1" <?= isset($projeto['status']) && $projeto['status'] == 1 ? 'selected' : '' ?>>Ativado</option>
                                <option value="2" <?= isset($projeto['status']) && $projeto['status'] == 2 ? 'selected' : '' ?>>Desativado</option>
                                </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><?= isset($edit) ? 'Atualizar' : 'Cadastrar'?></button>
                    <a href="./listProjeto" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>