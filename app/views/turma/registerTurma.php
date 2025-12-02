<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow-lg border-0 rounded-4"> 
                <div class="card-body p-4 p-md-5">

                    <h2 class="card-title text-center fw-bolder text-dark mb-5 border-bottom pb-3">
                        <i class="fas fa-plus me-3 text-secondary opacity-75"></i> 
                        Cadastro de Nova Turma
                    </h2>

                    <?php if (isset($msg)) { ?>
                        <div class="alert alert-info alert-dismissible fade show p-2 mb-4" role="alert">
                             <i class="fas fa-info-circle me-2"></i> <?php echo $msg; ?>
                            <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>

                    <form method="POST" enctype="multipart/form-data">

                        <fieldset class="mb-5 border p-3 rounded">
                            <legend class="float-none w-auto px-2 fs-6 fw-bold text-primary">Detalhes Básicos</legend>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="ano_turma" class="form-label fw-semibold">Ano da Classe (YYYY)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="text" class="form-control border-start-0" id="ano_turma" name="ano_turma" placeholder="Ex: 2025" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="img" class="form-label fw-semibold">Imagem da Classe</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-image"></i></span>
                                        <input type="file" class="form-control border-start-0" id="img" name="img">
                                    </div>
                                    <small class="form-text text-muted fst-italic">Opcional. Adicione uma imagem para representar a classe.</small>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="mb-5 border p-3 rounded">
                            <legend class="float-none w-auto px-2 fs-6 fw-bold text-primary">Associação e Configuração</legend>

                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="nro_turma" class="form-label fw-semibold">Ano Escolar</label>
                                    <select name="nro_turma" id="nro_turma" class="form-select" required>
                                        <option value="">Selecione o Ano</option>
                                        <?php for ($i = 1; $i <= 9; $i++) { echo "<option value='{$i}'>{$i}º</option>"; } ?>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="tipo_ensino" class="form-label fw-semibold">Tipo de Ensino</label>
                                    <select name="tipo_ensino" id="tipo_ensino" class="form-select" required>
                                        <option value="">Selecione o Nível</option>
                                        <option value="ef1">Ensino Fundamental 1</option>
                                        <option value="ef2">Ensino Fundamental 2</option>
                                        <option value="em">Ensino Médio</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-4 mb-4">
                                    <label for="turno" class="form-label fw-semibold">Turno</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-clock"></i></span>
                                        <select name="turno" class="form-select border-start-0" id="turno" required>
                                            <option value="">Selecione um Turno</option>
                                            <option value="manha">Manhã</option>
                                            <option value="tarde">Tarde</option>
                                            <option value="integral">Integral</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="mb-5 border p-3 rounded">
                            <legend class="float-none w-auto px-2 fs-6 fw-bold text-primary">Associação e Status</legend>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="escola" class="form-label fw-semibold">Escola Associada</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-school"></i></span>
                                        <select name="id_escola" class="form-select border-start-0" id="escola" required>
                                            <option value="">Escolha sua escola</option>
                                            <?php foreach ($escolas as $escola): ?>
                                                <option value="<?= $escola['id_escola'] ?>"><?= $escola['nome_escola'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="ativo" class="form-label fw-semibold">Status de Ativação</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-toggle-on"></i></span>
                                        <select name="ativo" class="form-select border-start-0" id="ativo" required>
                                            <option value="">Escolha um Status</option>
                                            <option value="ativo">✅ Ativado</option>
                                            <option value="inativo">❌ Desativado</option>
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
                                <i class="fas fa-save me-2"></i> <?= isset($edit) ? 'Atualizar' : 'Cadastrar' ?>
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