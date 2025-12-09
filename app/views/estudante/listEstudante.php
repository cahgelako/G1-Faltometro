<div class="container my-5 mt-5">
    <?php require 'app/core/auth.php'; ?>
    
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h2 class="fw-bold text-dark mb-0">
             Painel do Estudante
        </h2>
        <a href="./registerEstudantes" class="btn btn-primary fw-bold shadow-sm">
            <i class="fas fa-plus me-1"></i> Novo Estudante
        </a>
    </div>
    
     <?php if (isset($msg)) { ?>
        <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-info-circle me-2"></i> <b>Aviso:</b> <?php echo $msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
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
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($estudantes as $estudante) : ?>
                                <tr>
                                    <td class="text-center small text-muted"><?= $estudante['id_estudante'] ?></td>
                                    <td class="fw-medium"><?= $estudante['nome_estudante'] ?></td>
                                    
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <?php
                                                    if ($estudante['ativo'] == 'ativo') { ?>
                                                        <a href="./desativarEstudante&id=<?= $estudante['id_estudante'] ?>" title="Desativar" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja desativar esse estudante?')"><i class="fa fa-ban"></i></a>
                                                    <?php } else if ($estudante['ativo'] == 'inativo') { ?>
                                                        <a href="./ativarEstudante&id=<?= $estudante['id_estudante'] ?>" title="Ativar" class="btn btn-sm btn-outline-success" onclick="return confirm('Tem certeza que deseja ativar esse estudante?')"><i class="fa fa-check"></i></a>
                                                    <?php } ?>
                                            <a href="./editEstudante&id=<?= $estudante['id_estudante'] ?>" title="Editar" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
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
<script src="https://code.jquery.com/jquery-3.7.1.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  