<style>
    /* Cor Institucional (Azul Claro, #ADD8E6) */
    :root {
        --bs-primary-custom: #ADD8E6;
        --bs-dark-custom: #333333;
    }
    .btn-primary {
        background-color: var(--bs-primary-custom);
        border-color: var(--bs-primary-custom);
        color: var(--bs-dark-custom); 
        width: 100%; /* Botão Entrar em largura total */
    }
    .btn-primary:hover {
        background-color: #9ac2d5; 
        border-color: #9ac2d5;
        color: var(--bs-dark-custom);
    }
    /* Estilo para o logo no topo do card */
    .logo-login {
        max-width: 80px; /* Tamanho do logo ajustado */
        margin-bottom: 10px;
        border: 2px solid #f8f9fa; /* Borda branca sutil */
        padding: 5px;
        border-radius: 50%;
        background-color: #C5E9F6;
    }
    .card-login {
        border-radius: 0.5rem; /* Borda arredondada no card */
        border: 1px solid #dee2e6; /* Borda cinza clara sutil */
    }
</style>

---

<div class="container my-5">
    <div class="row justify-content-center">
        
        <div class="col-sm-8 col-md-6 col-lg-4">
            <div class="card shadow card-login border-0">
                <div class="card-body p-4 p-md-5">
                   
                    <div class="text-center">
                        <img src="img/logo_faltometro2.png" alt="Logo Faltômetro" class=" logo-login img-fluid">
                    </div>
                    
                    <h2 class="card-title text-center fw-bold mb-4 text-dark">Acesso ao Faltômetro</h2>
                    
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        
                        <div class="mb-3">
                            <label for="email" class="form-label small text-secondary">E-mail</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope fa-fw"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="senha" class="form-label small text-secondary">Senha</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock fa-fw"></i></span>
                                <input type="password" class="form-control" id="senha" name="senha" placeholder="••••••••" required>
                            </div>
                            <small class="form-text d-flex justify-content-end mt-2">
                                <a href="./listFunc.php" class="text-decoration-none text-secondary small">Esqueceu a senha?</a>
                            </small>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary fw-bold py-2">ENTRAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>