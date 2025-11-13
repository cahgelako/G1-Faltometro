
<div class="container my-5">
    <?php require 'app/core/auth.php'; ?>
    
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h2 class="fw-bold text-dark mb-0">
            <i class="fas fa-list-alt me-2 text-secondary"></i> Painel de Classes
        </h2>
        <a href="./registerClasse" class="btn btn-primary fw-bold shadow-sm">
            <i class="fas fa-plus me-1"></i> Nova Classe
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
                                default: return '<span class="badge" style="background-color: #CC0F87; color: white;">Integral</span>'; // Roxo/Magenta
                            }
                        }

                        function getStatusBadge($ativo) {
                            return $ativo == 1 
                                ? '<span class="badge bg-danger text-white">Ativo</span>'     // Vermelho
                                : '<span class="badge bg-secondary text-white">Desativado</span>'; // Cinza
                        }
                    ?>

                    <div class="table-responsive">
                        <table id="idtabela" class="table table-striped table-hover align-middle" style="width:100%">
                            <thead>
                                <tr class="table-light">
                                    <th class="text-center small">ID</th>
                                    <th class="text-center">Imagem</th>
                                    <th>Turma</th>
                                    <th>Escola</th>
                                    <th class="text-center">Ano</th>
                                    <th class="text-center">Turno</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if (!empty($classes)) {
                                        foreach ($classes as $user): 
                                ?>
                                            <tr>
                                                <td class="text-center small text-muted"><?= $user['id_classe'] ?></td>
                                                <td class="text-center">
                                                    <img src="img/<?= $user['img'] ?>" alt="Imagem da Classe" class="table-img">
                                                </td>
                                                <td class="fw-medium"><?= $user['nome_turma'] ?></td>
                                                <td><?= $user['nome_escola'] ?></td>
                                                <td class="text-center"><?= $user['ano_turma'] ?></td>
                                                <td class="text-center"><?= getTurnoBadge($user['turno']) ?></td>
                                                <td class="text-center"><?= getStatusBadge($user['ativo']) ?></td>
                                                
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="./editClasse&id=<?= $user['id_classe'] ?>" title="Editar" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                                        <a href="./deleteClasse&id=<?= $user['id_classe'] ?>" title="Excluir" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir esta classe?')"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                <?php 
                                        endforeach;
                                    } else {
                                        echo '<tr><td colspan="8" class="text-center text-muted">Nenhuma classe cadastrada.</td></tr>';
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
<!-- 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
                </div>
            </div>
        </div>
    </div>
</div>

   <script src="https://code.jquery.com/jquery-3.7.1.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

