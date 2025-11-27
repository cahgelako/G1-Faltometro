<div class="container my-5">
    <?php require 'app/core/auth.php'; ?>

    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h2 class="fw-bold text-dark mb-0">
            <i class="fas fa-school me-2 text-secondary"></i> Painel das Escolas
        </h2>
        <a href="./registerEs" class="btn btn-primary fw-bold shadow-sm">
            <i class="fas fa-plus me-1"></i> Cadastrar Escola
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
                                    <th class="text-center small">Código</th>
                                    <th>Nome da Instituição</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($escolas)) {
                                    foreach ($escolas as $escola) {
                                ?>
                                        <tr>
                                            <td class="text-center small text-muted"><?= $escola['id_escola'] ?></td>
                                            <td class="fw-medium"><?= $escola['nome_escola'] ?></td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <?php switch ($escola['ativo']) {
                                                        case 1: ?>
                                                        <a href="./desativarEscola&id=<?= $escola['id_escola'] ?>" title="Desativar" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja desativar a escola <?= $escola['nome_escola'] ?>?')"><i class="fa fa-ban"></i></a>
                                                        <?php break;
                                                        
                                                        case 0: ?>
                                                            <a href="./ativarEscola&id=<?= $escola['id_escola'] ?>" title="Ativar" class="btn btn-sm btn-outline-success" onclick="return confirm('Tem certeza que deseja ativar a escola <?= $escola['nome_escola'] ?>?')"><i class="fa fa-check"></i></a>
                                                           <?php break;
                                                    }?>
                                                    <a href="./editEscola&id=<?= $escola['id_escola'] ?>" title="Editar" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    // Linha de mensagem se a lista de escolas estiver vazia (opcional)
                                    echo '<tr><td colspan="3" class="text-center text-muted">Nenhuma escola cadastrada.</td></tr>';
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