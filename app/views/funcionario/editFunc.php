<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    
                    <h2 class="card-title text-center fw-bold text-dark mb-4">
                        <i class="fas fa-user-edit me-2 text-secondary"></i> 
                        <?= isset($funcionario) ? 'Editar Funcionário' : 'Registrar Novo Funcionário' ?>
                    </h2>
                    
                    <form method="POST">
                        <input type="hidden" name="id_funcionario" readonly value="<?= $funcionario['id_funcionario'] ?? '' ?>">

                        <h5 class="mb-3 text-secondary border-bottom pb-1">Dados Pessoais</h5>
                        <div class="row">
                            
                            <div class="col-md-7 mb-3">
                                <label for="nome" class="form-label small text-muted">Nome Completo</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo" value="<?= $funcionario['nome'] ?? '' ?>" required>
                                </div>
                            </div>

                            <div class="col-md-5 mb-3">
                                <label for="tipo_acesso" class="form-label small text-muted">Perfil de Acesso</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <select name="tipo_acesso" class="form-select" id="tipo_acesso" required>
                                        <option value="" disabled <?= !isset($funcionario['tipo_acesso']) || $funcionario['tipo_acesso'] == 0 ? 'selected' : '' ?>>Escolha um nível de acesso</option>
                                        <option value="1" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 1 ? 'selected' : '' ?>>Professor(a)</option>
                                        <option value="2" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 2 ? 'selected' : '' ?>>Nutricionista</option>
                                        <option value="3" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 3 ? 'selected' : '' ?>>Coordenação</option>
                                        <option value="4" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 4 ? 'selected' : '' ?>>Administrador</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3 text-secondary border-bottom pb-1">Dados de Acesso (Login)</h5>
                        <div class="row">
                            
                            <div class="col-md-7 mb-3">
                                <label for="email" class="form-label small text-muted">E-mail</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" value="<?= $funcionario['email'] ?? '' ?>" required>
                                </div>
                            </div>

                            <div class="col-md-5 mb-3">
                                <label for="senha" class="form-label small text-muted">Senha de Login</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite nova senha (opcional)">
                                </div>
                                <small class="form-text text-muted fst-italic">Deixe em branco para manter a senha atual.</small>
                            </div>
                        </div>

                        <hr class="mt-4 mb-3">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="./listFunc" class="btn btn-secondary px-4">
                                <i class="fas fa-arrow-left me-1"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                <i class="fas fa-save me-1"></i> <?= isset($funcionario) ? 'Atualizar Dados' : 'Cadastrar' ?>
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>