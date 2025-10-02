<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Editar Funcionário</h2>
                    <form method="POST">
                        <div class="row">
                            <input type="hidden" name="id_funcionario" readonly value="<?= $funcionario['id_funcionario'] ?? '' ?>">
                            <div class="col-sm-6 mb-3">
                            <label for="nome_funcionario" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nome_funcionario" name="nome_funcionario" placeholder="Nome completo" value="<?= $funcionario['nome_funcionario'] ?? '' ?>" required>
                        </div>

                            <div class="col-sm-3 mb-3">
                                <label for="senha" class="form-label">Status</label>
                                <select name="ativo" class="form-control" id="ativo" required>
                                    <option value="1" <?= isset($funcionario['ativo']) && $funcionario['ativo'] == 1 ? 'selected' : '' ?>>Ativo</option>
                                    <option value="0" <?= isset($funcionario['ativo']) && $funcionario['ativo'] == 0 ? 'selected' : '' ?>>Inativo</option>
                                </select>
                            </div>

                            <div class="col-sm-3 mb-3">
                                <label for="tipo_acesso" class="form-label">Perfil de Acesso</label>
                                <select name="tipo_acesso" class="form-control" id="tipo_acesso" required>
                                    <option value="0" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 0 ? 'selected' : '' ?>>Escolha um nível de acesso</option>
                                    <option value="1" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 1 ? 'selected' : '' ?>>Professor(a)</option>
                                    <option value="2" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 2 ? 'selected' : '' ?>>Nutricionista</option>
                                    <option value="3" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 3 ? 'selected' : '' ?>>Coordenação</option>
                                    <option value="4" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 4 ? 'selected' : '' ?>>Administrador</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-3 border border-dark p-2">
                            <p>DADOS DE LOGIN</p>
                            <div class="col-sm-6 mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email_funcionario" name="email_funcionario" placeholder="name@example.com" value="<?= $funcionario['email_funcionario'] ?? '' ?>" required>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="senha" class="form-label">Senha de Login</label>
                                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite nova senha (opcional)">
                                <small class="form-text text-muted fst-italic">Deixe em branco para manter a senha atual.</small>
                            </div>
                        </div>
                </div>
                <button type="submit" class="btn btn-primary"><?= isset($edit) ? 'Atualizar' : 'Cadastrar' ?></button>
                <a href="./listFunc" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>
</div>