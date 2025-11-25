<div class="container py-5">
    <?php require 'app/core/auth.php'; ?>
    <div class="row">
        <h2 class="display-5 fw-bold mb-5 text-center text-dark title-turmas">
            Escolha a Turma
        </h2>
        
        <div class="row justify-content-center g-4">
            <?php
            foreach ($turmas as $turma) {
                // Configuração das variáveis de design baseadas no Turno
                $perfil = "Integral";
                $badge_class = "bg-dark"; // Padrão para Integral
                $card_color_code = "#212529"; // Cor de Destaque

                if ($turma['turno'] == 1) {
                    $perfil = "Manhã";
                    $badge_class = "bg-success"; // Verde para Manhã
                    $card_color_code = "#198754"; 
                } elseif ($turma['turno'] == 2) {
                    $perfil = "Tarde";
                    $badge_class = "bg-warning text-dark"; // Amarelo para Tarde
                    $card_color_code = "#ffc107";
                }
            ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    
                    <div class="card h-100 border-0 rounded-4 overflow-hidden card-turma-hover shadow-lg" 
                         style="border-top: 6px solid <?= $card_color_code ?>;">
                        
                        <div class="img-container">
                            <img src="img/<?= $turma["img"] ?>" class="card-img-top object-fit-cover img-turma" 
                                 alt="Imagem da Turma">
                        </div>
                        
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="card-title text-truncate mb-2 text-dark fw-bolder">
                                <?= $turma["nome_turma"] ?>
                            </h5>
                            
                            <p class="card-subtitle mb-3">
                                <span class="badge <?= $badge_class ?> rounded-pill py-2 px-3 fw-normal">
                                    <i class="bi bi-clock me-1"></i> Turno: <?= $perfil ?>
                                </span>
                            </p>

                            <p class="card-text mb-4 text-muted small">
                                Ano Letivo: <span class="fw-semibold text-dark"><?= $turma["ano_turma"] ?></span>
                            </p>
                            
                            <a href="registerFrenqAluno?id_classe=<?= $turma["id_classe"]?>" 
                               class="btn btn-primary mt-auto w-100 btn-acessar-turma">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Acessar Turma
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>



<style>
    /* CSS Customizado para Dinamismo e Estética */
    
    /* Título */
    .title-turmas { /* Azul Primário Bootstrap */
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    /* Efeito de Hover no Card */
    .card-turma-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }
    
    .card-turma-hover:hover {
        transform: translateY(-5px); /* Eleva o card sutilmente */
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important; /* Sombra mais intensa */
    }

    /* Imagem */
    .img-container {
        overflow: hidden;
    }

    .img-turma {
        transition: transform 0.3s ease;
        height: 100%; /* Garante que a imagem preencha o container */
    }
    
    /* Efeito de Zoom na Imagem ao passar o mouse no Card */
    .card-turma-hover:hover .img-turma {
        transform: scale(1.05);
    }

    /* Botão de Ação */
    .btn-acessar-turma {
        font-weight: 600;
        /* Usa o Azul Primário do Bootstrap */
    }
    
    .btn-acessar-turma:hover {
        opacity: 0.9;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>