<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    footer {
        margin-top: auto;
    }
</style>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">

                    <h2 class="card-title text-center fw-bold text-dark mb-4">
                        <i class="fas fa-user-plus me-2 text-secondary"></i>
                        <?= isset($edit) ? 'Editar Estudante' : 'Cadastrar Estudante' ?>
                    </h2>

                    <form method="POST">

                        <h5 class="mb-3 text-secondary border-bottom pb-1">Dados do Aluno</h5>

                        <div class="row">

                            <div class="col-md-7 mb-3">
                                <label for="nome_estudante" class="form-label small text-muted">Nome Completo</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="nome_estudante" name="nome_estudante" placeholder="Nome completo" value="<?= $estudantes['nome_estudante'] ?? '' ?>" required>
                                </div>
                            </div>

                            <hr class="mt-4 mb-3">

                            <div class="d-flex justify-content-end gap-2">
                                <a href="./listEstudante" class="btn btn-secondary px-4">
                                    <i class="fas fa-arrow-left me-1"></i> Voltar
                                </a>
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                    <i class="fas fa-save me-1"></i> <?= isset($edit) ? 'Atualizar Dados' : 'Cadastrar' ?>
                                </button>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>