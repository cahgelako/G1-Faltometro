<div class="container my-5">
    <?php require 'app/core/auth.php'; ?>
    
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h2 class="fw-bold text-dark mb-0">
            <i class="fas fa-utensils me-2 text-secondary"></i> Dietas Atribuídas
        </h2>
        <a href="./registerAtriDieta" class="btn btn-primary fw-bold shadow-sm">
            <i class="fas fa-plus me-1"></i> Atribuir Nova Dieta
        </a>
    </div>

    <?php if (isset($msg)) { ?>
        <p class="text-dark"> <?php echo $msg; ?></p>
    <?php } ?>
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    
                    <?php
                        // Função para gerar o badge de Turno
                        function getTurnoBadgeDieta($turno) {
                            switch ($turno) {
                                case 1: return '<span class="badge badge-manha ms-1">M</span>'; // Manhã
                                case 2: return '<span class="badge badge-tarde ms-1">T</span>';  // Tarde
                                case 3: return '<span class="badge badge-integral ms-1">I</span>'; // Integral
                                default: return '';
                            }
                        }
                    ?>

                    <div class="table-responsive">
                        <table id="idtabela" class="table table-striped table-hover align-middle" style="width:100%">
                            <thead>
                                <tr class="table-light">
                                    <th class="text-center small">RM</th>
                                    <th>Estudante</th>
                                    <th>Dieta Atribuída</th>
                                    <th class="text-center">Classe</th>
                                    <th class="text-center">Data da Atribuição</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if (!empty($dietas)) {
                                        foreach ($dietas as $dieta) : 
                                            // Converte a data para o formato brasileiro
                                            $data_formatada = date('d/m/Y', strtotime($dieta['data_adicao_dieta']));
                                ?>
                                            <tr>
                                                <td class="text-center small text-muted"><?= $dieta['registro_matricula_escola'] ?></td>
                                                <td class="fw-medium"><?= $dieta['nome_estudante'] ?></td>
                                                <td><?= $dieta['nome_dieta'] ?></td>
                                                <td>
                                                    <span class="fw-normal"><?= $dieta['nome_turma']?> <?= $dieta['ano_turma']?></span>
                                                    <?= getTurnoBadgeDieta($dieta['turno']) ?>
                                                </td>
                                                <td class="small text-muted"><?= $data_formatada ?></td>
                                                
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="./editAtriDieta&id_estudante=<?= $dieta['id_estudante'] ?>" title="Editar" class="btn btn-sm btn-outline-secondary">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        </div>
                                                </td>
                                            </tr>
                                <?php 
                                        endforeach;
                                    } else {
                                        echo '<tr><td colspan="6" class="text-center text-muted">Nenhuma dieta atribuída encontrada.</td></tr>';
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