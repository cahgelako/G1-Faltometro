<div class="container my-5">
    <?php require 'app/core/auth.php'; ?>

    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h2 class="fw-bold text-dark mb-0">
            <i class="fas fa-chalkboard me-2 text-secondary"></i> Painel das Turmas
        </h2>
        <a href="./registerTurma" class="btn btn-primary fw-bold shadow-sm">
            <i class="fas fa-plus me-1"></i> Nova Turma
        </a>
    </div>

    <?php if (isset($msg)) { ?>
        <p class="text-dark"> <?php echo $msg; ?></p>
    <?php } ?>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <div class="table-responsive">
                        <table id="idtabela" class="table table-striped table-hover align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center small">Código da Turma</th>
                                    <th class="text-start">Nome</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($turmas)) {
                                    foreach ($turmas as $turma) :
                                ?>
                                        <tr>
                                            <td class="text-center small text-muted"><?= $turma['id_turma'] ?></td>
                                            <td class="fw-medium text-start"><?= $turma['nome_turma'] ?></td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="./editTurma&id=<?= $turma['id_turma'] ?>" title="Editar" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                                    <a href="./deleteTurma&id=<?= $turma['id_turma'] ?>" title="Excluir" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir a turma <?= $turma['nome_turma'] ?>?')"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    endforeach;
                                } else {
                                    // Linha de mensagem se a lista de turmas estiver vazia (opcional)
                                    echo '<tr><td colspan="3" class="text-center text-muted">Nenhuma turma cadastrada.</td></tr>';
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
<script src="https://code.jquery.com/jquery-3.7.1.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>