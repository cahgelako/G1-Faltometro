<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    footer {
        margin-top: auto;
    }

    /* Estilo extra */
    .card {
        border-radius: 18px !important;
    }

    table input[type="number"] {
        max-width: 120px;
        margin: 0 auto;
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
        <div class="col-12 col-md-10 col-lg-8 mt-5">

            <div class="card border-0 rounded-4 shadow-lg bg-white">

                <!-- HEADER -->
                <div class="card-header bg-white text-center border-bottom border-2 p-3">
                    <h5 class="mb-0 text-dark fw-bold">
                        <i class="bi bi-mortarboard me-2 text-primary"></i>
                        Perfil do Estudante: <?= $estudante['nome_estudante'] ?>
                    </h5>
                </div>

                <div class="card-body p-4">

                    <!-- FORMULÁRIO ÚNICO -->
                    <form class="row g-4" method="POST" action="seu_endpoint_de_edicao" novalidate>
                        <!-- NOME -->
                        <div class="col-12">
                            <label class="form-label text-muted">Nome Completo</label>
                            <input type="text" class="form-control input-minimalista" readonly
                                value="<?= $estudante['nome_estudante'] ?>">
                        </div>

                        <!-- TURMA -->
                        <div class="col-12 col-md-7">
                            <label class="form-label text-muted">Turma</label>
                            <input type="text" class="form-control input-minimalista" readonly
                                value="<?= $estudante['nro_turma'] . 'º do ' . formatarEnsino($estudante['tipo_ensino']) . '/' . $estudante['ano_turma'] . '-' . formatarTurno($estudante['turno']) ?>">
                        </div>

                        <!-- TABELA DE FALTAS -->
                        <div class="col-12 mt-4">
                            <div class="card shadow-sm border-0 rounded-4">

                                <div class="card-header bg-primary text-white text-center py-3">
                                    <h4 class="fw-bold m-0">Registro de Faltas por Mês</h4>
                                </div>

                                <div class="card-body p-4">

                                    <div class="table-responsive mb-4">
                                        <table class="table table-bordered text-center align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Mês</th>
                                                    <th>Quantidade de Faltas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($faltas_mes as $mes => $qtd): ?>
                                                    <tr>
                                                        <td class="fw-semibold"><?= $mes ?></td>
                                                        <td>
                                                            <p> <?= $qtd ?></p>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                
                                                <tr class="table-primary fw-bold">
                                                    <td>Total no Ano</td>
                                                    <td><?= $faltas_ano['total_ano'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- BOTÕES -->
                        <div class="col-12 mt-4 d-flex justify-content-end">
                            <a href="./listEstudante" class="btn btn-primary px-4 fw-semibold">
                                Voltar
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