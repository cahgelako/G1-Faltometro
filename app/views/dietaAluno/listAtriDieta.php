<div class="container mt-3">
    <?php require 'app/core/auth.php'; ?>
    <h2 class="card-title mb-4">Dietas Atribuidas</h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="col-md-12 mb-3">
                        <a href="./registerAtriDieta" class="btn btn-primary">Novo</a>
                    </div>
                    <div class="table-responsive">
                        <table id="idtabela" class="table table-bordered" cellpadding="5">
                            <thead>
                                <tr>
                                    <th class="text-center">RM</th>
                                    <th>Nome</th>
                                    <th>Dieta</th>
                                    <th class="text-center">Classe</th>
                                    <th class="text-center">Data da Atribuição</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dietas as $dieta) :
                                  
                                         if ($dieta['turno'] == 1) {
                                            $perfil = "<span>Manhã</span>";
                                        } elseif ($dieta['turno'] == 2) {
                                        $perfil = "<span>Tarde</span>";  
                                        }else{
                                            $perfil = "<span>Integral</span>";
                                        }?>
                                <tr>
                                    <td class="text-center"><?= $dieta['registro_matricula_escola'] ?></td>
                                    <td><?= $dieta['nome_estudante'] ?></td>
                                    <td><?= $dieta['nome_dieta'] ?></td>
                                    <td><?= $dieta['nome_turma']?> <?= $dieta['ano_turma']?> | <?=$perfil?></td>
                                     <td><?= date('d/m/y', strtotime($dieta['data_adicao_dieta']))  ?></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="./editAtriDieta&id_estudante=<?= $dieta['id_estudante'] ?>" title="Editar" class="btn btn-sm btn-warning"><i class="fa fa-edit text-"></i></a>
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

   

