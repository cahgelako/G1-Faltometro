<div class="container mt-3">
    <?php require 'app/core/auth.php'; ?>
    <h2 class="card-title mb-4">Atribuição de Projetos</h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="col-md-12 mb-3">
                        <a href="./registerAtriExtras" class="btn btn-primary">Novo</a>
                    </div>
                    <div class="table-responsive">
                        <table id="idtabela" class="table table-bordered" cellpadding="5">
                            <thead>
                                <tr>
                                    <th class="text-center">RM</th>
                                    <th>Nome</th>
                                    <th class="text-center">Classe</th>
                                    <th class="text-center">Projeto Extracurricular</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $frequencia_id = array_count_values($ids_estudantes);
                                // var_dump($frequencia_id);
                                foreach ($matriculas as $projeto) :
                                  
                                         if ($projeto['turno'] == 1) {
                                            $perfil = "<span>Manhã</span>";
                                        } elseif ($projeto['turno'] == 2) {
                                        $perfil = "<span>Tarde</span>";  
                                        }else{
                                            $perfil = "<span>Integral</span>";
                                        }?>
                                <tr> 
                                    <!-- <?php 
                                    //foreach ($frequencia_id as $key => $value) {
                                        //if ($key[$value] > 1) { ?>
                                            rowspan="<?php //$key[$value] ?>"
                                            <?php // } 
                                    //}
                                    ?> -->
                                    <td class="text-center"><?= $projeto['registro_matricula_escola'] ?></td>
                                    <td><?= $projeto['nome_estudante'] ?></td>
                                    <td><?= $projeto['nome_turma']?> <?= $projeto['ano_turma']?> | <?=$perfil?></td>
                                    <td><?= $projeto['nome_projeto'] ?></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="./editAtriExtras&id_matricula=<?= $projeto['id_matricula'] ?>" title="Editar" class="btn btn-sm btn-warning"><i class="fa fa-edit text-"></i></a>
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

   

