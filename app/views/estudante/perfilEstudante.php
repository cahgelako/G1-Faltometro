<style>
html, body {
    height: 100%;
}

body {
    display: flex;
    flex-direction: column;
}

footer {
    margin-top: auto;
}

</style>

<?php 
 function formatarEnsino($tipo)
                    {
                        $tipo = strtolower(trim($tipo));

                        return match ($tipo) {
                            'ef1' => 'Ensino Fundamental I',
                            'ef2' => 'Ensino Fundamental II',
                            'em'  => 'Ensino Médio',
                            default => ucfirst($tipo)
                        };
                    }


                    function formatarTurno($t)
                    {
                        return match (strtolower(trim($t))) {
                            'manha', 'manhã', 'm' => 'Manhã',
                            'tarde', 't' => 'Tarde',
                            'integral', 'i' => 'Integral',
                            default => mb_convert_case($t, MB_CASE_TITLE, "UTF-8")
                        };
                    }
?>


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card border-0 rounded-3 shadow-sm bg-white card-minimalista">
                
                <div class="card-header bg-white text-center border-bottom border-2 p-3">
                    <h5 class="mb-0 text-dark fw-bold">
                        <i class="bi bi-mortarboard me-2 text-primary"></i> Perfil do Estudante: <?= $estudante['nome_estudante'] ?>
                    </h5>
                </div>   
                    <form class="row g-4" method="POST" action="seu_endpoint_de_edicao" novalidate>
                        <input type="hidden" name="id_estudante" readonly value="<?= $estudante['id_estudante'] ?? '' ?>">

                        <div class="col-12">
                            <label for="nome" class="form-label text-muted">Nome Completo</label>
                            <input type="text" class="form-control input-minimalista" readonly id="nome" name="nome" value="<?= $estudante['nome_estudante'] ?? '' ?>">
                        </div>

                        <div class="col-12 col-md-7">
                            <label for="turma" class="form-label text-muted">Turma</label>
                            <input type="turma" class="form-control input-minimalista" readonly id="email" name="email" 
                            value=" <?= $estudante['nro_turma'] . 'º do ' . formatarEnsino($estudante['tipo_ensino']) . '/' . $estudante['ano_turma'] . '-' .  formatarTurno($estudante['turno'])?>">
                        </div>
                        <!-- <div class="col-12 col-md-7">
                            <label for="qtd_faltas" class="form-label text-muted">Quantidade de faltas</label>
                            <input type="qtd_faltas" class="form-control input-minimalista" readonly id="qtd_faltas" name="qtd_faltas" value="<?= $estudante['email'] ?? '' ?>">
                        </div> -->
                        
                        <div class="col-12 mt-5 d-flex justify-content-end pt-3">
                            <a href="./listEstudante" class="btn btn-outline-secondary me-2 px-4 btn-minimalista-hover">
                                <i class="bi bi-x-lg me-1"></i> Voltar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  