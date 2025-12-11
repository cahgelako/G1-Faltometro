<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso - Faltômetro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
    /* ------------------------------------------- */
    /* Cores e Fundo (Tons de Azul) */
    /* ------------------------------------------- */
    :root {
        /* Azul Institucional (Antigo: #ADD8E6, Novo, mais profissional: #8ECDDD) */
        --bs-primary-custom: #8ECDDD;
        /* Azul Claro Sutil para Fundo e Destaque */
        --bs-secondary-custom: #C5E9F6;
        /* Texto Escuro/Preto */
        --bs-dark-custom: #333333;
    }

    /* Ocupa a altura total e centraliza o conteúdo */
    body.login-body {
        /* Degradê sutil de azul/cinza como fundo de tela cheia */
        background: linear-gradient(135deg, #f0f2f5 0%, var(--bs-secondary-custom) 100%);
        min-height: 100vh;
        display: flex;
        align-items: center; /* Centraliza Verticalmente */
        justify-content: center; /* Centraliza Horizontalmente */
        margin: 0;
        padding: 20px; /* Adiciona um pequeno padding para telas menores */
    }
    
    /* ------------------------------------------- */
    /* Card de Login */
    /* ------------------------------------------- */
    .card-login {
        border-radius: 1rem; /* Borda mais arredondada */
        border: none; /* Remove a borda padrão para um visual mais limpo */
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); /* Sombra mais destacada e profissional */
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card-login:hover {
        transform: translateY(-3px); /* Efeito sutil ao passar o mouse */
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    /* ------------------------------------------- */
    /* Botão Principal */
    /* ------------------------------------------- */
    .btn-primary {
        background-color: var(--bs-primary-custom);
        border-color: var(--bs-primary-custom);
        color: white; /* Cor do texto branca para alto contraste */
        width: 100%; 
        font-size: 1.1rem;
        padding: 0.75rem 0; /* Maior preenchimento */
        transition: background-color 0.2s, border-color 0.2s, color 0.2s;
    }
    .btn-primary:hover {
        background-color: #6EB4D4; /* Azul ligeiramente mais escuro no hover */
        border-color: #6EB4D4;
        color: white;
    }
    .btn-primary:active {
        background-color: #5AA1C0 !important; 
        border-color: #5AA1C0 !important;
    }

    /* ------------------------------------------- */
    /* Campos de Input */
    /* ------------------------------------------- */
    .input-group-text {
        background-color: #f8f9fa; /* Fundo do ícone mais claro */
        border-right: none;
        color: var(--bs-primary-custom); /* Ícone no tom de azul */
        border-color: #dee2e6;
    }
    .form-control {
        border-left: none;
    }
    .form-control:focus {
        border-color: var(--bs-primary-custom);
        box-shadow: 0 0 0 0.25rem rgba(142, 205, 221, 0.25); /* Sombra sutil ao focar */
    }
</style>
</head>

<body class="login-body">
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-sm-10 col-md-7 col-lg-5 col-xl-4">
                <div class="card card-login">
                    <div class="card-body p-4 p-md-5">
                        
                        <div class="text-center">
                            <img src="img/logo_faltometro2.png" alt="Logo Faltômetro" class="img-fluid" style="max-height: 100px;">
                        </div>
                        
                        <h2 class="card-title text-center fw-bolder mb-4 text-dark">Acesso ao Sistema</h2>
                        
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger text-center small" role="alert">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            
                            <div class="mb-3">
                                <label for="email" class="form-label small text-muted">E-mail</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user fa-fw"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="nome@empresa.com" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="senha" class="form-label small text-muted">Senha</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock fa-fw"></i></span>
                                    <input type="password" class="form-control" id="senha" name="senha" placeholder="••••••••" required>
                                </div>
                                <small class="form-text d-flex justify-content-end mt-2">
                                    <a href="./recuperarSenha" class="text-decoration-none text-muted small fw-medium">Esqueceu a senha?</a>
                                </small>
                            </div>
                            
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary fw-bold">ENTRAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>