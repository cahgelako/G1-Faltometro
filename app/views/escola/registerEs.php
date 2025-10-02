<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Cadastrar Escola</h2>
                    <form method="POST">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="nome" class="form-label">Nome da Instituição de Ensino</label>
                                <input type="text" class="form-control" id="nome_escola" name="nome_escola" placeholder="Nome completo" value="<?= $escolas['es_nome'] ?? '' ?>" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success"><?= isset($edit) ? 'Atualizar' : 'Cadastrar'?></button>
                        <a href="./listEscola" class="btn btn-secondary">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>