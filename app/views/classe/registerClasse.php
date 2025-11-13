<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    
                    <h2 class="card-title text-center fw-bold text-dark mb-4">
                        <i class="fas fa-plus me-2 text-secondary"></i> 
                        Cadastrar Classe
                    </h2>
                    
                    <form method="POST" enctype="multipart/form-data">
                        
                        <h5 class="mb-3 text-secondary border-bottom pb-1">Detalhes e Arquivos</h5>
                        
                        <div class="row">
                            
                            <div class="col-md-6 mb-4">
                                <label for="ano_turma" class="form-label small text-muted">Ano da Classe (YYYY)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="text" class="form-control" id="ano_turma" name="ano_turma" placeholder="Ex: 2025" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="img" class="form-label small text-muted">Imagem da Classe</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    <input type="file" class="form-control" id="img" name="img">
                                </div>
                                <small class="form-text text-muted">Opcional. Adicione uma imagem para representar a classe.</small>
                            </div>
                        </div>

                        <h5 class="mb-3 mt-3 text-secondary border-bottom pb-1">Associação e Configuração</h5>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="turma" class="form-label small text-muted">Turma</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                    <select name="id_turma" class="form-select" id="turma" required>
                                        <option value="">Escolha uma Turma</option>
                                        <?php foreach ($turmas as $turma): ?>
                                            <option value="<?= $turma['id_turma']?>"><?= $turma['nome_turma']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-4">
                                <label for="escola" class="form-label small text-muted">Escola</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-school"></i></span>
                                    <select name="id_escola" class="form-select" id="escola" required>
                                        <option value="">Escolha sua escola</option>
                                        <?php foreach ($escolas as $escola): ?>
                                            <option value="<?= $escola['id_escola']?>"><?= $escola['nome_escola']?></option>
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
                                        <option value="1">Manhã</option>
                                        <option value="2">Tarde</option>
                                        <option value="3">Integral</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="ativo" class="form-label small text-muted">Status (Ativação)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                    <select name="ativo" class="form-select" id="ativo" required>
                                        <option value="">Escolha um Status</option>
                                        <option value="1">Ativado</option>
                                        <option value="2">Desativado</option>
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
                                <i class="fas fa-save me-1"></i> <?= isset($edit) ? 'Atualizar' : 'Cadastrar'?>
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>