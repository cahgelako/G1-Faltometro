<h2>Recuperação de Senha</h2>

<?php if (!empty($msg)) { ?>
    <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
        <i class="fas fa-info-circle me-2"></i><?php echo $msg; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
<?php } ?>

<form action="" method="POST">
    <label>E-mail</label>
    <input type="email" name="email" required>
    <button type="submit">Enviar código</button>
</form>