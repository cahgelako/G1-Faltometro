<div class="container mt-3">
    <?php require 'app/core/auth.php'; ?>
    <div class="row justify-content-center">
        <h2 class="card-title mb-4 text-center">Escolha a Turma</h2>
        <div class="col-md-12">
            <div class="row justify-content-center">

                <?php
                foreach ($turmas as $turma) {
                    if ($turma['turno'] == 1) {
                        $perfil = "A";
                    } elseif ($turma['turno'] == 2) {
                        $perfil = "B";
                    } else {
                        $perfil = "Integral";
                    }
                ?>

                    <div class="col-3 m-2">
                        <div class="card shadow-lg" style="width: 18rem;">
                            <img src="img/<?=$turma["img"]?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $turma["nome_turma"] ?>-<?= $perfil?></h5>
                                <p class="card-text"><?= $turma["ano_turma"] ?></p>
                                <a href="registerFrenqAluno?id_classe=<?= $turma["id_classe"]?>" class="btn btn-primary">Acessar Turma</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>