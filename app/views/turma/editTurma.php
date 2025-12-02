<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow-lg border-0 rounded-4"> 
                <div class="card-body p-4 p-md-5">

                    <h2 class="card-title text-center fw-bolder text-dark mb-5 border-bottom pb-3">
                        <i class="fas fa-edit me-3 text-primary opacity-75"></i> 
                        Editar Dados da Turma
                    </h2>

                    <?php if (isset($msg)) { ?>
                        <div class="alert alert-info alert-dismissible fade show p-2 mb-4" role="alert">
                             <i class="fas fa-info-circle me-2"></i> <?php echo $msg; ?>
                            <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>

                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" readonly name="id_turma" value="<?= $turma['id_turma'] ?? '' ?>">

                        <fieldset class="mb-5 border p-3 rounded">
                            <legend class="float-none w-auto px-2 fs-6 fw-bold text-primary">Detalhes da Classe e Imagem</legend>

                            <div class="row">
                                <div class="col-md-5 mb-4">
                                    <label for="ano_turma" class="form-label fw-semibold">Ano da Classe (YYYY)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="text" class="form-control border-start-0" id="ano_turma" name="ano_turma" placeholder="Ex: 2025" value="<?= $turma['ano_turma'] ?? '' ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-7 mb-4">
                                    <label for="img" class="form-label fw-semibold">Imagem Atual</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-shrink-0">
                                            <img src="/img/<?= $turma['img'] ?? 'default.png' ?>" 
                                                 alt="Imagem Atual da Classe" 
                                                 class="form-preview-img-minimalist border shadow-sm">
                                        </div>
                                        
                                        <div class="input-group flex-grow-1">
                                            <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-image"></i></span>
                                            <input type="file" class="form-control border-start-0" id="img" name="img">
                                        </div>
                                    </div>
                                    <small class="form-text text-muted fst-italic mt-1">Deixe vazio para manter a imagem atual.</small>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="mb-5 border p-3 rounded">
                            <legend class="float-none w-auto px-2 fs-6 fw-bold text-primary">Associação e Configuração</legend>

                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="nro_turma" class="form-label fw-semibold">Ano Escolar</label>
                                    <select name="nro_turma" id="nro_turma" class="form-select" required>
                                        <?php for ($i = 1; $i <= 9; $i++): ?>
                                            <option value="<?= $i ?>" <?= ($turma['nro_turma'] ?? '') == $i ? 'selected' : '' ?>><?= $i ?>º</option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="tipo_ensino" class="form-label fw-semibold">Tipo de Ensino</label>
                                    <select name="tipo_ensino" id="tipo_ensino" class="form-select" required>
                                        <?php 
                                            $ensinos = ['ef1' => 'Ensino Fundamental 1', 'ef2' => 'Ensino Fundamental 2', 'em' => 'Ensino Médio'];
                                            $current_ensino = $turma['tipo_ensino'] ?? '';
                                            foreach ($ensinos as $value => $label): 
                                        ?>
                                            <option value="<?= $value ?>" <?= $current_ensino == $value ? 'selected' : '' ?>><?= $label ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="turno" class="form-label fw-semibold">Turno</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-clock"></i></span>
                                        <select name="turno" class="form-select border-start-0" id="turno" required>
                                            <option value="manha" <?= ($turma['turno'] ?? '') == 'manha' ? 'selected' : '' ?>>Manhã</option>
                                            <option value="tarde" <?= ($turma['turno'] ?? '') == 'tarde' ? 'selected' : '' ?>>Tarde</option>
                                            <option value="integral" <?= ($turma['turno'] ?? '') == 'integral' ? 'selected' : '' ?>>Integral</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6 mb-4">
                                    <label for="id_escola" class="form-label fw-semibold">Escola Associada</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-school"></i></span>
                                        <select name="id_escola" class="form-select border-start-0" id="id_escola" required>
                                            <option value="">Escolha sua escola</option>
                                            <?php foreach ($escolas as $escola): ?>
                                                <option value="<?= $escola['id_escola'] ?>" <?= ($turma['id_escola'] ?? '') == $escola['id_escola'] ? 'selected' : '' ?>><?= $escola['nome_escola'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="ativo" class="form-label fw-semibold">Status de Ativação</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-toggle-on"></i></span>
                                        <select name="ativo" class="form-select border-start-0" id="ativo" required>
                                            <option value="ativo" <?= ($turma['ativo'] ?? '') == 'ativo' ? 'selected' : '' ?>>✅ Ativado</option>
                                            <option value="inativo" <?= ($turma['ativo'] ?? '') == 'inativo' ? 'selected' : '' ?>>❌ Desativado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <hr class="mt-4 mb-4 opacity-25">

                        <div class="d-flex justify-content-end gap-3">
                            <a href="./listTurma" class="btn btn-outline-secondary px-4 fw-semibold rounded-pill">
                                <i class="fas fa-arrow-left me-2"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold rounded-pill shadow-sm">
                                <i class="fas fa-sync-alt me-2"></i> Atualizar Dados
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilo para a imagem de pré-visualização / imagem atual */
    .form-preview-img-minimalist {
        width: 60px; /* Tamanho discreto */
        height: 60px;
        object-fit: cover;
        border-radius: 8px; /* Cantos suaves */
    }
</style>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>