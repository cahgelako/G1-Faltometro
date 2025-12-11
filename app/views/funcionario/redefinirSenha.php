<h2>Redefinir Senha</h2>

<?php if (!empty($sucesso)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
    <button>

        <a href="./login">Login</a>
    </button>
<?php endif; ?>


<form action="" method="POST">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token ?? '') ?>">

    <label>Nova Senha</label>
    <input type="password" name="senha" required>

    <button type="submit">Salvar nova senha</button>
</form>