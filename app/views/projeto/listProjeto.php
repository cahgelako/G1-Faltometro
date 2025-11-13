<div class="container my-5">
    <?php require 'app/core/auth.php'; ?>
    
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h2 class="fw-bold text-dark mb-0">
            <i class="fas fa-puzzle-piece me-2 text-secondary"></i> Painel das Turmas Extracurriculares
        </h2>
        <a href="./registerProjeto" class="btn btn-primary fw-bold shadow-sm">
            <i class="fas fa-plus me-1"></i> Nova Turma
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    
                    <?php
                        // Lógica de mapeamento de turno e status, usando classes Bootstrap para cores
                        function getTurnoBadge($turno) {
                            switch ($turno) {
                                case 1: return '<span class="badge bg-primary text-white">Manhã</span>'; // Azul
                                case 2: return '<span class="badge bg-success text-white">Tarde</span>';  // Verde
                                case 3: return '<span class="badge" style="background-color: #CC0F87; color: white;">Integral</span>'; // Roxo/Magenta
                                default: return '<span class="badge bg-warning text-dark">Indefinido</span>';
                            }
                        }

                        function getStatusBadge($status) {
                            return $status == 1 
                                ? '<span class="badge bg-danger text-white">Ativo</span>'     // Vermelho
                                : '<span class="badge bg-secondary text-white">Desativado</span>'; // Cinza
                        }
                    ?>

                    <div class="table-responsive">
                        <table id="idtabela" class="table table-striped table-hover align-middle" style="width:100%">
                            <thead>
                                <tr class="table-light">
                                    <th class="text-center small">ID</th>
                                    <th>Nome da Turma</th>
                                    <th class="text-center">Turno</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if (!empty($projetos)) {
                                        foreach ($projetos as $user): 
                                ?>
                                            <tr>
                                                <td class="text-center small text-muted"><?= $user['id_projeto'] ?></td>
                                                <td class="fw-medium"><?= $user['nome_projeto'] ?></td>
                                                <td class="text-center"><?= getTurnoBadge($user['turno']) ?></td>
                                                <td class="text-center"><?= getStatusBadge($user['status']) ?></td>
                                                
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="./editProjeto&id=<?= $user['id_projeto'] ?>" title="Editar" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                                        <a href="./deleteProjeto&id=<?= $user['id_projeto'] ?>" title="Excluir" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir esta turma?')"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                <?php 
                                        endforeach;
                                    } else {
                                        echo '<tr><td colspan="5" class="text-center text-muted">Nenhuma turma extracurricular cadastrada.</td></tr>';
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