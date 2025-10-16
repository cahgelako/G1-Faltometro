
<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-lg">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Login</h2>
            <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                    <small class="form-text text-muted d-flex justify-content-end"><a href="./listFunc.php">Esqueceu a senha?</a></small>
                </div>

                <button type="submit" class="btn btn-primary">Entrar</button>
                <button class="btn btn-outline-primary" src="">Manual de Uso</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>