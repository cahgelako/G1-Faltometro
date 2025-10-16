<div class="container mt-3">
    <?php require 'app/core/auth.php'; ?>
    <h2 class="card-title mb-4">Painel das Matrículas</h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="col-md-12 mb-3">
                        <a href="./registerMatricula" class="btn btn-primary">Novo</a>
                    </div>
                    <div class="table-responsive">
                        <table id="idtabela" class="table table-bordered" cellpadding="5">
                            <thead>
                                <tr>
                                    <th class="text-center">Chave da Matrícula</th>
                                    <th>Classe</th>
                                    <th>Estudante</th>
                                    <th>Data da Matrícula</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($matriculas as $user): 
                                         if ($user['turno'] == 1) {
                                            $perfil = "<span>Manhã</span>";
                                        } elseif ($user['turno'] == 2) {
                                        $perfil = "<span>Tarde</span>";  
                                        }else{
                                            $perfil = "<span>Integral</span>";
                                        }

                                        if ($user['ativo'] == 1) {
                                            $status = "<span style='color: red;'>Ativo</span>";
                                        } else{
                                            $status = "<span style='color: dimgray;'>Desativado</span>";
                                        }
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $user['id_matricula'] ?></td>
                                        <td><?= $user['nome_turma']?> <?= $user['ano_turma']?> | <?=$perfil?></td>
                                        <td><?= $user['nome_estudante'] ?></td>
                                        <td><?= date('d/m/y', strtotime($user['data_matricula']))  ?></td>
                                        <td class="text-center"><?= $status ?></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="./editMatricula&id=<?= $user['id_matricula'] ?>" title="Editar" class="btn btn-sm btn-warning"><i class="fa fa-edit text-"></i></a>
                                                <a href="./deleteMatricula&id=<?= $user['id_matricula'] ?>"   title="Excluir" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="fa fa-trash"></i></a>
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

