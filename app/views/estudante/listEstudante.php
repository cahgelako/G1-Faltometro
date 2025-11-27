<div class="container my-5">
    <?php require 'app/core/auth.php'; ?>
    
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h2 class="fw-bold text-dark mb-0">
            <i class="fas fa-user-graduate me-2 text-secondary"></i> Painel do Estudante
        </h2>
        <a href="./registerEstudantes" class="btn btn-primary fw-bold shadow-sm">
            <i class="fas fa-plus me-1"></i> Novo Estudante
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
                                    <th class="text-center small">ID</th>
                                    <th>Nome do Estudante</th>
                                    <th class="text-center">Matrícula</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($estudantes as $estudante) : ?>
                                <tr>
                                    <td class="text-center small text-muted"><?= $estudante['id_estudante'] ?></td>
                                    <td class="fw-medium"><?= $estudante['nome_estudante'] ?></td>
                                    <td class="text-center text-muted"><?= $estudante['registro_matricula_escola'] ?></td>
                                    
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="./editEstudante&id=<?= $estudante['id_estudante'] ?>" title="Editar" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                            <a href="./deleteEstudante&id=<?= $estudante['id_estudante'] ?>" title="Excluir" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir o estudante <?= $estudante['nome_estudante'] ?>?')"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>