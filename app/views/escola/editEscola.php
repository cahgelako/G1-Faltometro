<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Editar Escola</h2>
                    <form method="POST">

                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <input type="hidden" class="form-control" name="id_escola" value="<?= $escolas['id_escola'];?>" readonly>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="nome" class="form-label">Nome da Instituição de Ensino</label>
                                <input type="text" class="form-control" id="nome_escola" name="nome_escola" placeholder="ex: Escola SESI de Santo Anastácio" value="<?= $escolas['nome_escola'] ?? ''?>" required>
                            </div>
                        
                        </div>

                        <button type="submit" class="btn btn-warning">Editar</button>
                        <a href="./listEscola" class="btn btn-success"> Voltar</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>