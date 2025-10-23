<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow-lg">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Cadastrar Estudante</h2>
                <form method="POST">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="nome_estudante" class="form-label">Nome completo</label>
                            <input type="text" class="form-control" id="nome_estudante" name="nome_estudante" placeholder="Nome completo" value="<?=$estudantes['nome_estudante'] ?? '' ?>" required>
                        </div>
                      <div class="col-sm-6 mb-3">
                            <label for="registro_matricula_escola" class="form-label">Registro de Matrícula</label>
                            <input type="text" class="form-control" id="registro_matricula_escola" name="registro_matricula_escola" placeholder="Registro de Matrícula" value="<?=$estudantes['registro_matricula_escola'] ?? '' ?>" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"><?= isset($edit) ? 'Atualizar' : 'Cadastrar'?></button>
                    <a href="./listUser" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>