<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card border-0 rounded-3 shadow-sm bg-white card-minimalista">
                
                <div class="card-header bg-white text-center border-bottom border-2 p-3">
                    <h5 class="mb-0 text-dark fw-bold">
                        <i class="bi bi-mortarboard me-2 text-primary"></i> Cadastro de Funcionário
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <h5 class="card-title text-center mb-5 text-secondary">
                        Olá, <span class="text-primary fw-bold"><?= $funcionario['nome'] ?></span>. Edite suas informações.
                    </h5>
                    
                    <form class="row g-4" method="POST" action="seu_endpoint_de_edicao" novalidate>
                        <input type="hidden" name="id_funcionario" readonly value="<?= $funcionario['id_funcionario'] ?? '' ?>">

                        <div class="col-12">
                            <label for="nome" class="form-label text-muted">Nome Completo</label>
                            <input type="text" class="form-control input-minimalista" id="nome" name="nome" placeholder="Nome completo" value="<?= $funcionario['nome'] ?? '' ?>" required>
                        </div>

                        <div class="col-12 col-md-7">
                            <label for="email" class="form-label text-muted">E-mail</label>
                            <input type="email" class="form-control input-minimalista" id="email" name="email" placeholder="name@example.com" value="<?= $funcionario['email'] ?? '' ?>" required>
                        </div>
                        
                        <div class="col-12 col-md-5">
                            <label for="tipo_acesso" class="form-label text-muted">Perfil de Acesso</label>
                            <select name="tipo_acesso" class="form-select input-minimalista" id="tipo_acesso" required>
                                <option value="" disabled <?= !isset($funcionario['tipo_acesso']) || $funcionario['tipo_acesso'] == 0 ? 'selected' : '' ?>>Escolha o nível</option>
                                <option value="1" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 1 ? 'selected' : '' ?>>Professor(a)</option>
                                <option value="2" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 2 ? 'selected' : '' ?>>Nutricionista</option>
                                <option value="3" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 3 ? 'selected' : '' ?>>Coordenação</option>
                                <option value="4" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 4 ? 'selected' : '' ?>>Administrador</option>
                            </select>
                        </div>
                        
                        <div class="col-12 mt-5 d-flex justify-content-end pt-3">
                            <a href="./listFunc" class="btn btn-outline-secondary me-2 px-4 btn-minimalista-hover">
                                <i class="bi bi-x-lg me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-4 btn-minimalista-submit">
                                <i class="bi bi-check-lg me-1"></i> Salvar Alterações
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">