<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow-lg">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Cadastrar Classe</h2>
                <form method="POST">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="ano_turma" class="form-label">Ano da Classe</label>
                            <input type="text" class="form-control" id="ano_turma" name="ano_turma" placeholder="2025" required>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <label for="turma" class="form-label">Turma</label>
                            <select name="id_turma" class="form-control" id="turma" required>
                                <option value="">Escolha uma Turma</option>
                                <?php foreach ($turmas as $turma): ?>
                                <option value="<?= $turma['id_turma']?>"><?= $turma['nome_turma']?></option>
                                <?php endforeach; ?>
                                </select>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <label for="escola" class="form-label">Escola</label>
                            <select name="id_escola" class="form-control" id="escola" required>
                                <option value="">Escolha sua escola</option>
                                <?php foreach ($escolas as $escola): ?>
                                <option value="<?= $escola['id_escola']?>"><?= $escola['nome_escola']?></option>
                                <?php endforeach; ?>
                                </select>
                        </div>
                       <div class="col-sm-3 mb-3">
                            <label for="turno" class="form-label">Turno</label>
                            <select name="turno" class="form-control" id="turno" required>
                                <option value="0">Escolha um Turno</option>
                                <option value="1">Manhã</option>
                                <option value="2">Tarde</option>
                                <option value="3">Integral</option>
                                </select>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <label for="ativo" class="form-label">Status</label>
                            <select name="ativo" class="form-control" id="ativo" required>
                                <option value="0">Escolha um ativo</option>
                                <option value="1">Ativado</option>
                                <option value="2">Desativado</option>
                                </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><?= isset($edit) ? 'Atualizar' : 'Cadastrar'?></button>
                    <a href="./listClasse" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>