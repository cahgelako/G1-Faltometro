<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6"> 
            <div class="card shadow-lg">
                <h5 class="card-header bg-info text-white text-center">Perfil do Usuário</h5>
                
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Olá <?= $funcionario['nome'] ?>, seja bem-vindo ao seu Perfil!</h5>
                    
                    <form class="row g-3" method="POST" action="seu_endpoint_de_edicao"> <input type="hidden" name="id_funcionario" readonly value="<?= $funcionario['id_funcionario'] ?? '' ?>">

                        <div class="col-12">
                            <label for="nome" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo" value="<?= $funcionario['nome'] ?? '' ?>" required>
                        </div>

                        <div class="col-12 col-md-7">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?= $funcionario['email'] ?? '' ?>" required>
                        </div>
                        
                        <div class="col-12 col-md-5">
                            <label for="tipo_acesso" class="form-label">Perfil de Acesso</label>
                            <select name="tipo_acesso" class="form-control" id="tipo_acesso" required>
                                <option value="0" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 0 ? 'selected' : '' ?>>Escolha um nível de acesso</option>
                                <option value="1" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 1 ? 'selected' : '' ?>>Professor(a)</option>
                                <option value="2" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 2 ? 'selected' : '' ?>>Nutricionista</option>
                                <option value="3" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 3 ? 'selected' : '' ?>>Coordenação</option>
                                <option value="4" <?= isset($funcionario['tipo_acesso']) && $funcionario['tipo_acesso'] == 4 ? 'selected' : '' ?>>Administrador</option>
                            </select>
                        </div>
                        
                        <div class="col-12 mt-4 d-flex justify-content-end"> <a href="./listFunc" class="btn btn-secondary me-2">Voltar</a>
                            <button type="submit" class="btn btn-info" style="color: whitesmoke;">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>