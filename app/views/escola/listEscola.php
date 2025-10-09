<div class="container mt-3">
    <?php require 'app/core/auth.php';?>
    <h2 class="card-title mb-4">Painel das Escolas</h2>
    <div class="row justify-content-center">
        <div class="col md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="col-md-12 mb-3">
                        <a href="./registerEs" class="btn btn-primary">Cadastrar</a>
                    </div>
                    <div class="table-responsive">
                        <table id="idtabela" class="table table-bordered" cellpadding = '5'>
                            <thead>
                                <tr>
                                    <th>Código da Escola</th>
                                    <th>Nome da Instituição:</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($escolas as $escola) {
                                    
                                
                                ?>
                                <tr>
                                    <td class="text-center"><?= $escola['id_escola']?></td>
                                    <td><?= $escola['nome_escola']?></td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="./editEscola&id=<?= $escola['id_escola'] ?>" title="Editar" class="btn btn-sm btn-warning"><i class="fa fa-edit text-"></i></a>
                                        <a href="./deleteEscola&id=<?= $escola['id_escola'] ?>"   title="Excluir" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>