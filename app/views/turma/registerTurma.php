<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-xl-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    
                    <h2 class="card-title text-center fw-bold text-dark mb-4">
                        <i class="fas fa-plus me-2 text-secondary"></i> 
                        Cadastrar Turma
                    </h2>
                    
                    <form method="POST">
                        
                        <h5 class="mb-3 text-secondary border-bottom pb-1">Detalhes da Turma</h5>
                        
                        <div class="row">
                            <div class="col-sm-12 mb-4">
                                <label for="nome_turma" class="form-label small text-muted">Nome da Turma</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                    <input type="text" class="form-control" id="nome_turma" name="nome_turma" 
                                           placeholder="ex: 3º ano do Ensino Médio" 
                                           value="<?= $turmas['nome_turma'] ?? '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-3">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="./listTurma" class="btn btn-secondary px-4">
                                <i class="fas fa-arrow-left me-1"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                <i class="fas fa-save me-1"></i> <?= isset($edit) ? 'Atualizar' : 'Cadastrar' ?>
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