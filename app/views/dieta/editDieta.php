<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Editar Dieta Especial</h2>
                    <form method="POST">
                        <div class="row">
                             <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <input type="hidden" readonly class="form-control" id="id_dieta" name="id_dieta" value="<?= $dietas['id_dieta'] ?? ''?>">
                                </div>
                             </div>
                             <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="nome_dieta" class="form-label">Nome da Dieta</label>
                                <input type="text" class="form-control" id="nome_dieta" name="nome_dieta" placeholder="ex: Intolerância a Lactose" value="<?= $dietas['nome_dieta'] ?? ''?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="observacoes" class="form-label">Observações</label>
                                <input type="text" class="form-control" id="observacoes" name="observacoes" placeholder="ex: Oferecer suco no lugar " value="<?= $dietas['observacoes'] ?? ''?>" >
                            </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><?= isset($edit) ? 'Atualizar' : 'Cadastrar' ?></button>
                        <a href="./listDieta" class="btn btn-success">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>