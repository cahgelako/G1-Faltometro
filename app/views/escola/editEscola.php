<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-xl-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    
                    <h2 class="card-title text-center fw-bold text-dark mb-4">
                        <i class="fas fa-school me-2 text-secondary"></i> 
                        Editar Escola
                    </h2>
                    
                    <form method="POST">
                        <input type="hidden" name="id_escola" value="<?= $escolas['id_escola'] ?? '' ?>" readonly>
                        
                        <h5 class="mb-3 text-secondary border-bottom pb-1">Dados da Instituição</h5>
                        
                        <div class="row">
                            <div class="col-sm-12 mb-4">
                                <label for="nome_escola" class="form-label small text-muted">Nome da Instituição de Ensino</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                    <input type="text" class="form-control" id="nome_escola" name="nome_escola" 
                                           placeholder="ex: Escola SESI de Santo Anastácio" 
                                           value="<?= $escolas['nome_escola'] ?? ''?>" required>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-3">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="./listEscola" class="btn btn-secondary px-4">
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