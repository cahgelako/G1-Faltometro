<div class="container mt-3">
    <?php require 'app/core/auth.php'; ?>
    <h2 class="card-title mb-4">Painel das Turmas</h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="col-md-12 mb-3">
                        <a href="./registerTurma" class="btn btn-primary">Novo</a>
                    </div>
                    <div class="table-responsive">
                        <table id="idtabela" class="border border-bordered" cellpadding="5">
                            <thead>
                                <tr>
                                    <th class="text-center">Código da Turma</th>
                                    <th class="text-center">Nome</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($turmas as $turma) :

                                ?>
                                <tr>
                                    <td class="text-center"><?= $turma['id_turma']?></td>
                                    <td class="text-center"><?=$turma['nome_turma']?></td>
                                    <td class="d-flex justify-content-center gap-2">
                                        <a href="./editTurma&id=<?= $turma['id_turma'] ?>" title="Editar" class="btn btn-sm btn-warning"><i class="fa fa-edit text-"></i></a>
                                        <a href="./deleteTurma&id=<?= $turma['id_turma'] ?>"   title="Excluir" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="fa fa-trash"></i></a>

                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>