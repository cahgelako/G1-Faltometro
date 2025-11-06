<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Contagem de Faltas</h2>
                    <form method="POST">
                        <div class="col-sm-3 mb-3">
                            <label for="id_estudante" class="form-label">Estudante</label>

                            <?php foreach ($estudantes as $estudante): 
                               
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="id_matricula">
                                    <label class="form-check-label" for="checkChecked">
                                        <?= $estudante['nome_estudante'] ?>
                                        <?= $estudante['id_matricula'] ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                            </select>
                        </div>
                </div>
                <button type="submit" class="btn btn-primary"><?= isset($edit) ? 'Atualizar' : 'Cadastrar' ?></button>
                <a href="./listFrenqTu" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>
</div>