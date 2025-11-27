<?php
// Função helper para gerar o badge do turno com cores Bootstrap
function getTurnoBadge($turno) {
    switch ($turno) {
        case 1: return '<span class="badge text-bg-primary">Manhã</span>'; // Azul
        case 2: return '<span class="badge text-bg-success">Tarde</span>';  // Verde
        default: return '<span class="badge text-bg-info">Integral</span>'; // Ciano
    }
}
?>

<div class="container my-5">
    <?php require 'app/core/auth.php'; ?>
    
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h2 class="fw-bold text-dark mb-0">
            <i class="fas fa-list-check me-20"></i> 
            Atribuição de Projetos Extracurriculares
        </h2>
        <a href="./editAtriExtras" class="btn btn-primary fw-bold shadow-sm">
            <i class="fas fa-plus me-1"></i> Nova Atribuição
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12"> 
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4">
                    
                    <div class="table-responsive">
                        <table id="idtabela" class="table table-striped table-hover align-middle" style="width:100%">
                            <thead>
                                <tr class="table-light"> <th class="text-center small">RM</th>
                                    <th>Nome do Estudante</th>
                                    <th class="text-center">Turma/Período</th>
                                    <th>Projeto Extracurricular</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            if (!empty($matriculas)) {
                                foreach ($matriculas as $projeto) :
                            ?>
                                <tr> 
                                    <td class="text-center small text-muted"><?= htmlspecialchars($projeto['registro_matricula_escola']) ?></td>
                                    <td class="fw-medium"><?= htmlspecialchars($projeto['nome_estudante']) ?></td>
                                    <td>
                                        <?= htmlspecialchars($projeto['nome_turma']) ?> <?= htmlspecialchars($projeto['ano_turma']) ?> 
                                        <br>
                                        <?= getTurnoBadge($projeto['turno']) ?>
                                    </td>
                                    <td class="fw-semibold text-dark"><?= htmlspecialchars($projeto['nome_projeto']) ?></td>
                                    <!-- <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="./editAtriExtras&id_projeto=<?= htmlspecialchars($projeto['id_matricula']) ?>" 
                                               title="Editar Atribuições" 
                                               class="btn btn-sm btn-primary shadow-sm">
                                                <i class="fa fa-edit"></i> Editar
                                            </a>
                                        </div>
                                    </td> -->
                                </tr>
                            <?php 
                                endforeach; 
                            } else {
                                echo '<tr><td colspan="5" class="text-center text-muted">Nenhuma atribuição de projeto encontrada.</td></tr>';
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