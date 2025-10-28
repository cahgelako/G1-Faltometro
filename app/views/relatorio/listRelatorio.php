<div class="container mt-3">
    <?php require 'app/core/auth.php'; ?>
    <h2 class="card-title mb-4">Relatório </h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="idtabela" class="table table-bordered" cellpadding="5">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th class="text-center">Registro de Matrícula</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($estudantes as $estudante) : ?>
                                <tr>
                                    <td><?= $estudante['nome_estudante'] ?></td>
                                    <td><?= $estudante['registro_matricula_escola'] ?></td>
                                    
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="./perfilEstudante&id=<?= $estudante['id_estudante'] ?>" title="Vizualizar" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                                            <a href="./deleteEstudante&id=<?= $estudante['id_estudante'] ?>"   title="Excluir" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="fa fa-trash"></i></a>
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

   

