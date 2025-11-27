<div class="container my-5">
    <?php require 'app/core/auth.php'; ?>

    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h2 class="fw-bold text-dark mb-0">
            <i class="fas fa-address-card me-2 text-secondary"></i> Painel das Matrículas
        </h2>
        <a href="./registerMatricula" class="btn btn-primary fw-bold shadow-sm">
            <i class="fas fa-plus me-1"></i> Nova Matrícula
        </a>
    </div>


    <?php if (isset($msg)) { ?>
        <p class="text-dark"> <?php echo $msg; ?></p>
    <?php } ?>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <?php
                    // Lógica de mapeamento de turno e status, usando classes Bootstrap para cores
                    function getTurnoBadgeMatricula($turno)
                    {
                        switch ($turno) {
                            case 1:
                                return '<span class="badge bg-primary text-white ms-1">M</span>'; // Manhã (Azul)
                            case 2:
                                return '<span class="badge bg-success text-white ms-1">T</span>';  // Tarde (Verde)
                            case 3:
                                return '<span class="badge" style="background-color: #CC0F87; color: white; margin-left: 4px;">I</span>'; // Integral (Roxo/Magenta)
                            default:
                                return '';
                        }
                    }

                    function getStatusBadgeMatricula($ativo)
                    {
                        return $ativo == 1
                            ? '<span class="badge bg-success">Ativa</span>'     // Verde
                            : '<span class="badge bg-danger">Inativa</span>'; // Vermelho
                    }
                    ?>

                    <div class="table-responsive">
                        <table id="idtabela" class="table table-striped table-hover align-middle" style="width:100%">
                            <thead>
                                <tr class="table-light">
                                    <th class="text-center small">ID</th>
                                    <th>Classe (Turma/Ano/Turno)</th>
                                    <th>Estudante</th>
                                    <th>Data da Matrícula</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($matriculas)) {
                                    foreach ($matriculas as $user):
                                        // Converte a data para o formato brasileiro
                                        $data_formatada = date('d/m/Y', strtotime($user['data_matricula']));
                                ?>
                                        <tr>
                                            <td class="text-center small text-muted"><?= $user['id_matricula'] ?></td>
                                            <td>
                                                <span class="fw-medium"><?= $user['nome_turma'] ?> <?= $user['ano_turma'] ?></span>
                                                <?= getTurnoBadgeMatricula($user['turno']) ?>
                                            </td>
                                            <td><?= $user['nome_estudante'] ?></td>
                                            <td class="small text-muted"><?= $data_formatada ?></td>
                                            <td class="text-center"><?= getStatusBadgeMatricula($user['ativo']) ?></td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <?php if ($user['ativo'] == 1): ?>
                                                        <a href="./desativarMatricula&id=<?= $user['id_matricula'] ?>" title="Desativar" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja desativar esta matrícula?')"><i class="fa fa-ban"></i></a>
                                                    <?php else: ?>
                                                        <a href="./ativarMatricula&id=<?= $user['id_matricula'] ?>" title="Ativar" class="btn btn-sm btn-outline-success" onclick="return confirm('Tem certeza que deseja ativar esta matrícula?')"><i class="fa fa-check"></i></a>
                                                    <?php endif; ?>
                                                    <a href="./editMatricula&id=<?= $user['id_matricula'] ?>" title="Editar" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    endforeach;
                                } else {
                                    echo '<tr><td colspan="6" class="text-center text-muted">Nenhuma matrícula cadastrada.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>