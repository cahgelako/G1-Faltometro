<div class="container my-5">
    <?php require 'app/core/auth.php'; ?>
    
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h2 class="fw-bold text-dark mb-0">
            <i class="fas fa-utensils me-2 text-secondary"></i> Painel das Dietas
        </h2>
        <a href="./registerDieta" class="btn btn-primary fw-bold shadow-sm">
            <i class="fas fa-plus me-1"></i> Nova Dieta
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
                                <tr class="table-light">
                                    <th class="text-center small">Código</th>
                                    <th>Nome da Dieta</th>
                                    <th>Observações</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($dietas)) {
                                    foreach ($dietas as $dieta) :
                                ?>
                                <tr>
                                    <td class="text-center small text-muted"><?= $dieta['id_dieta']?></td>
                                    <td class="fw-medium"><?=$dieta['nome_dieta']?></td>
                                    <td><?=$dieta['observacoes']?></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="./editDieta&id=<?= $dieta['id_dieta'] ?>" title="Editar" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                            <a href="./deletedieta&id=<?= $dieta['id_dieta'] ?>" title="Excluir" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir a dieta <?=$dieta['nome_dieta']?>?')"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php 
                                    endforeach;
                                } else {
                                    // Linha de mensagem se a lista de dietas estiver vazia (opcional)
                                    echo '<tr><td colspan="4" class="text-center text-muted">Nenhuma dieta cadastrada.</td></tr>';
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