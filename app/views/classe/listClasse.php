<div class="container mt-3">
    <?php require 'app/core/auth.php'; ?>
    <h2 class="card-title mb-4">Painel das Classes</h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="col-md-12 mb-3">
                        <a href="./registerClasse" class="btn btn-primary">Novo</a>
                    </div>
                    <div class="table-responsive">
                        <table id="idtabela" class="table table-bordered" cellpadding="5">
                            <thead>
                                <tr>
                                    <th class="text-center">Chave da Classe</th>
                                    <th class="text-center">Imagem</th>
                                    <th>Nome da turma</th>
                                    <th>Nome da escola</th>
                                    <th>Ano</th>
                                    <th class="text-center">Turno</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($classes as $user): 
                                        if ($user['turno'] == 1) {
                                            $perfil = "<span style='color: blue;'>Manhã</span>";
                                        } elseif ($user['turno'] == 2) {
                                        $perfil = "<span style='color: limegreen;'>Tarde</span>";  
                                        }else{
                                            $perfil = "<span style='color: #CC0F87;;'>Integral</span>";
                                        }

                                        if ($user['ativo'] == 1) {
                                            $status = "<span style='color: red;'>Ativo</span>";
                                        } else{
                                            $status = "<span style='color: dimgray;'>Desativado</span>";
                                        }
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $user['id_classe'] ?></td>
                                        <td><img src="img/<?= $user['img'] ?>" alt="" width="100px" height="100px"></td>
                                        <td><?= $user['nome_turma'] ?></td>
                                        <td><?= $user['nome_escola'] ?></td>
                                        <td><?= $user['ano_turma'] ?></td>
                                        <td class="text-center"><?= $perfil ?></td>
                                        <td class="text-center"><?= $status ?></td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="./editClasse&id=<?= $user['id_classe'] ?>" title="Editar" class="btn btn-sm btn-warning"><i class="fa fa-edit text-"></i></a>
                                                <a href="./deleteClasse&id=<?= $user['id_classe'] ?>"   title="Excluir" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="fa fa-trash"></i></a>
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

