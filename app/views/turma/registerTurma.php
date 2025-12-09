<style>
    /* Preview da imagem (igual ao estilo minimalista) */
    .form-preview-img-minimalist {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd;
    }
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">

                    <h2 class="card-title text-center fw-bold text-dark mb-4">
                        <i class="fas fa-plus me-2 text-secondary"></i>
                        Cadastro de Turma
                    </h2>

                    <?php if (isset($msg)) { ?>
                        <div class="alert alert-info alert-dismissible fade show p-2 mb-4" role="alert">
                            <i class="fas fa-info-circle me-2"></i> <?= $msg ?>
                            <button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
                        </div>
                    <?php } ?>

                    <form method="POST" enctype="multipart/form-data">

                        <!-- INFORMAÇÕES BÁSICAS -->
                        <h5 class="mb-3 text-secondary border-bottom pb-1">Informações da Turma</h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Ano da Classe (YYYY)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="text" class="form-control" id="ano_turma" name="ano_turma" placeholder="2025" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Imagem da Classe</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    <input type="file" class="form-control" id="img" name="img" accept="image/*">
                                </div>
                                <small class="text-muted fst-italic">Opcional, para representar a classe.</small>

                                <!-- Preview -->
                                <div class="mt-2">
                                    <img id="preview-img" class="form-preview-img-minimalist d-none">
                                </div>
                            </div>

                        </div>

                        <!-- ASSOCIAÇÃO -->
                        <h5 class="mt-4 mb-3 text-secondary border-bottom pb-1">Configurações</h5>

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label class="form-label small text-muted">Ano Escolar</label>
                                <select name="nro_turma" id="nro_turma" class="form-select" required>
                                    <option value="">Selecione</option>
                                    <?php for ($i = 1; $i <= 9; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?>º</option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label small text-muted">Tipo de Ensino</label>
                                <select name="tipo_ensino" id="tipo_ensino" class="form-select" required>
                                    <option value="">Selecione</option>
                                    <option value="ef1">Ensino Fundamental 1</option>
                                    <option value="ef2">Ensino Fundamental 2</option>
                                    <option value="em">Ensino Médio</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label small text-muted">Turno</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    <select name="turno" class="form-select" id="turno" required>
                                        <option value="">Selecione</option>
                                        <option value="manha">Manhã</option>
                                        <option value="tarde">Tarde</option>
                                        <option value="integral">Integral</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <!-- ESCOLA E STATUS -->
                        <h5 class="mt-4 mb-3 text-secondary border-bottom pb-1">Associação e Status</h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Escola</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-school"></i></span>
                                    <select name="id_escola" class="form-select" id="escola" required>
                                        <option value="">Selecione</option>
                                        <?php foreach ($escolas as $escola): ?>
                                            <option value="<?= $escola['id_escola'] ?>"><?= $escola['nome_escola'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Status</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                    <select name="ativo" class="form-select" id="ativo" required>
                                        <option value="">Selecione</option>
                                        <option value="ativo">Ativado</option>
                                        <option value="inativo">Inativo</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <hr class="mt-4 mb-3">

                        <!-- BOTÕES -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="./listTurma" class="btn btn-secondary px-4">
                                <i class="fas fa-arrow-left me-1"></i> Voltar
                            </a>
                            <button class="btn btn-primary px-4 shadow-sm">
                                <i class="fas fa-save me-1"></i> Cadastrar
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview da imagem
    document.getElementById("img").addEventListener("change", function(e){
        const file = e.target.files[0];
        const preview = document.getElementById("preview-img");

        if(file){
            preview.src = URL.createObjectURL(file);
            preview.classList.remove("d-none");
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
