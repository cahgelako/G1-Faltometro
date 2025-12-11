<h2>Redefinir Senha</h2>

<?php if (isset($msg)) { ?>
    <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
        <i class="fas fa-info-circle me-2"></i> <b>Aviso:</b> <?php echo $msg; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
<?php } ?>

<form action="/redefinir-senha" method="POST">
    <label>Nova Senha</label>
    <input type="password" name="senha" required>

    <button type="submit">Salvar nova senha</button>
</form>