<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">

                    <h2 class="card-title text-center fw-bold text-dark mb-4">
                        <i class="fas fa-edit me-2 text-secondary"></i>
                        Editar Classe
                    </h2>
                    
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" readonly name="id_classe" value="<?= $classes['id_classe'] ?? '' ?>">

                        <h5 class="mb-3 text-secondary border-bottom pb-1">Detalhes da Classe</h5>

                        <div class="row">

                            <div class="col-md-4 mb-4">
                                <label for="ano_turma" class="form-label small text-muted">Ano da Classe (YYYY)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="text" class="form-control" id="ano_turma" name="ano_turma" placeholder="Ex: 2025" value="<?= $classes['ano_turma'] ?? '' ?>" required>
                                </div>
                            </div>

                            <div class="col-md-8 mb-4">
                                <label for="img" class="form-label small text-muted d-block">Imagem da Classe (Atual: <span class="fw-bold"><?= $classes['img'] ?? 'N/A' ?></span>)</label>
                                <div class="d-flex align-items-center">
                                    <img src="img/<?= $classes['img'] ?? 'default.png' ?>" alt="Imagem Atual" class="form-preview-img me-3">
                                    <input type="file" class="form-control" id="img" name="img">
                                </div>
                                <small class="form-text text-muted">Selecione um novo arquivo para substituir a imagem atual.</small>
                            </div>
                        </div>

                        <h5 class="mb-3 mt-3 text-secondary border-bottom pb-1">Associação e Configuração</h5>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="id_turma" class="form-label small text-muted">Turma</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                    <select name="id_turma" class="form-select" id="id_turma" required>
                                        <option value="">Escolha uma Turma</option>
                                        <?php foreach ($turmas as $turma): ?>
                                            <option value="<?= $turma['id_turma'] ?>" <?= ($classes['id_turma'] ?? '') == $turma['id_turma'] ? 'selected' : '' ?>><?= $turma['nome_turma'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label for="id_escola" class="form-label small text-muted">Escola</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-school"></i></span>
                                    <select name="id_escola" class="form-select" id="id_escola" required>
                                        <option value="">Escolha sua escola</option>
                                        <?php foreach ($escolas as $escola): ?>
                                            <option value="<?= $escola['id_escola'] ?>" <?= ($classes['id_escola'] ?? '') == $escola['id_escola'] ? 'selected' : '' ?>><?= $escola['nome_escola'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label for="turno" class="form-label small text-muted">Turno</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    <select name="turno" class="form-select" id="turno" required>
                                        <option value="">Escolha um Turno</option>
                                        <option value="1" <?= ($classes['turno'] ?? '') == 1 ? 'selected' : '' ?>>Manhã</option>
                                        <option value="2" <?= ($classes['turno'] ?? '') == 2 ? 'selected' : '' ?>>Tarde</option>
                                        <option value="3" <?= ($classes['turno'] ?? '') == 3 ? 'selected' : '' ?>>Integral</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="ativo" class="form-label small text-muted">Status</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                    <select name="ativo" class="form-select" id="ativo" required>
                                        <option value="">Escolha um Status</option>
                                        <option value="1" <?= ($classes['ativo'] ?? '') == 1 ? 'selected' : '' ?>>Ativado</option>
                                        <option value="2" <?= ($classes['ativo'] ?? '') == 2 ? 'selected' : '' ?>>Desativado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-3">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="./listClasse" class="btn btn-secondary px-4">
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