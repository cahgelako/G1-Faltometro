<style>
.form-preview-img-minimalist {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
}
</style>

<div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-xl-8">

            
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">

                    <h2 class="card-title text-center fw-bold text-dark mb-4">
                        <i class="fas fa-edit me-2 text-secondary"></i>
                        Editar Turma
                    </h2>

                    <?php if (isset($msg)) { ?>
                        <div class="alert alert-info alert-dismissible fade show p-2 mb-4" role="alert">
                            <i class="fas fa-info-circle me-2"></i> <?= $msg ?>
                            <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>

                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" readonly name="id_turma" value="<?= $turma['id_turma'] ?? '' ?>">

                        <h5 class="mb-3 text-secondary border-bottom pb-1">Detalhes da Turma</h5>

                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="ano_turma" class="form-label small text-muted">Ano da Classe (YYYY)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="text" class="form-control" id="ano_turma" name="ano_turma"
                                           placeholder="Ex: 2025" value="<?= $turma['ano_turma'] ?? '' ?>" required>
                                </div>
                            </div>

                            <div class="col-md-7 mb-3">
                                <label for="img" class="form-label small text-muted">Imagem da Classe</label>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="flex-shrink-0">
                                        <img src="./img/<?= $turma['img'] ?? 'default.png' ?>"
                                             alt="Imagem Atual"
                                             class="form-preview-img-minimalist border">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                        <input type="file" class="form-control" id="img" name="img">
                                    </div>
                                </div>
                                <small class="form-text text-muted fst-italic">
                                    Deixe vazio para manter a imagem atual.
                                </small>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3 text-secondary border-bottom pb-1">Associação e Configurações</h5>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nro_turma" class="form-label small text-muted">Ano Escolar</label>
                                <select class="form-select" name="nro_turma" id="nro_turma" required>
                                    <?php for ($i = 1; $i <= 9; $i++): ?>
                                        <option value="<?= $i ?>" <?= ($turma['nro_turma'] ?? '') == $i ? 'selected' : '' ?>>
                                            <?= $i ?>º
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="tipo_ensino" class="form-label small text-muted">Tipo de Ensino</label>
                                <select class="form-select" name="tipo_ensino" id="tipo_ensino" required>
                                    <?php 
                                        $ensinos = ['ef1'=>'Ensino Fundamental 1','ef2'=>'Ensino Fundamental 2','em'=>'Ensino Médio'];
                                        $current_ensino = $turma['tipo_ensino'] ?? '';
                                        foreach ($ensinos as $value => $label):
                                    ?>
                                        <option value="<?= $value ?>" <?= $current_ensino == $value ? 'selected' : '' ?>>
                                            <?= $label ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="turno" class="form-label small text-muted">Turno</label>
                                <select class="form-select" name="turno" id="turno" required>
                                    <option value="manha" <?= ($turma['turno'] ?? '') == 'manha' ? 'selected' : '' ?>>Manhã</option>
                                    <option value="tarde" <?= ($turma['turno'] ?? '') == 'tarde' ? 'selected' : '' ?>>Tarde</option>
                                    <option value="integral" <?= ($turma['turno'] ?? '') == 'integral' ? 'selected' : '' ?>>Integral</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="id_escola" class="form-label small text-muted">Escola</label>
                                <select class="form-select" id="id_escola" name="id_escola" required>
                                    <option value="">Escolha sua escola</option>
                                    <?php foreach ($escolas as $escola): ?>
                                        <option value="<?= $escola['id_escola'] ?>" 
                                            <?= ($turma['id_escola'] ?? '') == $escola['id_escola'] ? 'selected' : '' ?>>
                                            <?= $escola['nome_escola'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="ativo" class="form-label small text-muted">Status</label>
                                <select class="form-select" name="ativo" id="ativo" required>
                                    <option value="ativo" <?= ($turma['ativo'] ?? '') == 'ativo' ? 'selected' : '' ?>>Ativado</option>
                                    <option value="inativo" <?= ($turma['ativo'] ?? '') == 'inativo' ? 'selected' : '' ?>>Inativo</option>
                                </select>
                            </div>
                        </div>

                        <hr class="mt-4 mb-3">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="./listTurma" class="btn btn-secondary px-4">
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
