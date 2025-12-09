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
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">

                    <h2 class="card-title text-center fw-bold text-dark mb-4">
                        <i class="fas fa-puzzle-piece me-2 text-secondary"></i>
                        Edição Turma Extracurricular
                    </h2>

                    <form method="POST">
                        <input type="hidden" name="id_projeto" readonly value="<?= $projeto['id_projeto'] ?? '' ?>">

                        <h5 class="mb-3 text-secondary border-bottom pb-1">Detalhes do Projeto</h5>

                        <div class="row">

                            <div class="col-sm-12 mb-4">
                                <label for="nome_projeto" class="form-label small text-muted">Nome da Turma</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                    <input type="text" class="form-control" id="nome_projeto" name="nome_projeto"
                                        placeholder="Ex: Comitê Juventudes AntiMisoginia"
                                        value="<?= $projeto['nome_projeto'] ?? '' ?>" required>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-4">
                                <label for="turno" class="form-label small text-muted">Turno</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    <select name="turno" class="form-select" id="turno" required>
                                        <option value="0" <?= ($projeto['turno'] ?? '') == 0 ? 'selected' : '' ?>>Escolha um Turno</option>
                                        <option value="1" <?= ($projeto['turno'] ?? '') == 1 ? 'selected' : '' ?>>Manhã</option>
                                        <option value="2" <?= ($projeto['turno'] ?? '') == 2 ? 'selected' : '' ?>>Tarde</option>
                                        <option value="3" <?= ($projeto['turno'] ?? '') == 3 ? 'selected' : '' ?>>Integral</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-4">
                                <label for="status" class="form-label small text-muted">Status</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                    <select name="status" class="form-select" id="status" required>
                                        <option value="0" <?= ($projeto['status'] ?? '') == 0 ? 'selected' : '' ?>>Escolha um Status</option>
                                        <option value="1" <?= ($projeto['status'] ?? '') == 1 ? 'selected' : '' ?>>Ativado</option>
                                        <option value="2" <?= ($projeto['status'] ?? '') == 2 ? 'selected' : '' ?>>Desativado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-3">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="./listProjeto" class="btn btn-secondary px-4">
                                <i class="fas fa-arrow-left me-1"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                <i class="fas fa-sync-alt me-1"></i> Atualizar Dados
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>