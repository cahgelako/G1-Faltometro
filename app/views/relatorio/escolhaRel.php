<div class="container py-5">
    <?php require 'app/core/auth.php'; ?>
    <div class="row">
        <h2 class="display-5 fw-bold mb-5 text-center text-dark"> Escolha o relatório</h2>
        
        <div class="row justify-content-center g-4">
            <?php
            foreach ($turmas as $turma) {
                if ($turma['turno'] == 1) {
                    $perfil = "Manhã"; // Nome de turno mais completo
                } elseif ($turma['turno'] == 2) {
                    $perfil = "Tarde";
                } else {
                    $perfil = "Integral";
                }
            ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    
                    <div class="card h-100 shadow-lg border-0 rounded-4 overflow-hidden">
                        
                        <img src="img/<?= $turma["img"] ?>" class="card-img-top object-fit-cover" 
                             alt="Imagem da Turma">
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate mb-1 text-dark fw-bold">
                                <?= $turma["nome_turma"] ?>
                            </h5>
                            <p class="card-subtitle text-muted mb-3 small">
                                Turno: **<?= $perfil ?>**
                            </p>

                            <p class="card-text mb-4 text-secondary">
                                Ano Letivo: **<?= $turma["ano_turma"] ?>**
                            </p>
                            
                            <a href="listRelFrenqCo?id_classe=<?= $turma["id_classe"]?>" 
                               class="btn btn-primary mt-auto w-100">
                                Acessar Relatório
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    
                    <div class="card h-100 shadow-lg border-0 rounded-4 overflow-hidden">
                        
                        <img src="./img/nutricionista" class="card-img-top object-fit-cover" 
                             alt="Imagem da Turma">
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate mb-1 text-dark fw-bold">
                               Nutricionista
                            </h5>
                            <a href="listRelFrenqCo?id_classe=<?= $turma["id_classe"]?>" 
                               class="btn btn-primary mt-auto w-100">
                                Acessar Relatório
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>