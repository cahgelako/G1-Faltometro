<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Realizar Matrícula</h2>
                    <form method="POST">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="data_matricula" class="form-label">Data da Matrícula</label>
                                <input type="date" class="form-control" id="data_matricula" name="data_matricula" placeholder="YYYY" required>
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="id_classe" class="form-label">Classe</label>
                                <select name="id_classe" class="form-control" id="id_classe" required>
                                    <option value="">Escolha uma Turma</option>
                                    <?php foreach ($classes as $classe): 
                                        if ($classe['turno'] == 1) {
                                            $perfil = "<span>Manhã</span>";
                                        } elseif ($classe['turno'] == 2) {
                                        $perfil = "<span>Tarde</span>";  
                                        }else{
                                            $perfil = "<span>Integral</span>";
                                        }
                                        ?>
                                        <?php if (isset($classe['ativo']) && $classe['ativo'] == 1) { ?>
                                            <option value="<?= $classe['id_classe'] ?>"><?= $classe['nome_turma']?> | <?= $classe['ano_turma']?> | <?=$perfil?> </option>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="id_estudante" class="form-label">Estudante</label>
                                <select name="id_estudante" class="form-control" id="id_estudante" required>
                                    <option value="">Escolha um estudante</option>
                                    <?php foreach ($estudantes as $estudante): ?>
                                        <option value="<?= $estudante['id_estudante'] ?>"><?= $estudante['nome_estudante'] ?></option>
                                    <?php endforeach; ?>
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
                        <button type="submit" class="btn btn-primary"><?= isset($edit) ? 'Atualizar' : 'Cadastrar' ?></button>
                        <a href="./listClasse" class="btn btn-secondary">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>