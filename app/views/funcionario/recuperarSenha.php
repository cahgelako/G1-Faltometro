<style>
    body {
        background-color: #f5f7fb;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-card {
        width: 100%;
        max-width: 420px;
        border-radius: 16px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .auth-card h2 {
        font-weight: 700;
        color: #344767;
    }

    .auth-card .form-label {
        font-weight: 600;
        color: #495057;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px 12px;
    }

    .btn-auth {
        border-radius: 10px;
        font-weight: 600;
        padding: 10px;
        background-color: #a0c4ff;
        border: 1px solid #85a3e1;
        color: #344767;
    }

    .btn-auth:hover {
        background-color: #8db7ff;
    }
</style>

<div class="card auth-card p-4">
    <div class="card-body p-3">

        <div class="text-center mb-4">
            <i class="bi bi-key fs-1 text-primary"></i>
            <h2 class="mt-2">Recuperação de Senha</h2>
            <p class="text-muted mb-0">
                Informe seu e-mail para receber o código.
            </p>
        </div>

        <?php if (!empty($msg)) { ?>
            <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-info-circle me-2"></i><?= $msg ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php } ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control"
                    required
                >
            </div>

            <button type="submit" class="btn btn-auth w-100">
                Enviar código
            </button>
        </form>

    </div>
</div>
