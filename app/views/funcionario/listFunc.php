<div class="container my-5">
    <?php require 'app/core/auth.php'; ?>
    
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h2 class="fw-bold text-dark mb-0">
            <i class="fas fa-users-cog me-2 text-secondary"></i> Painel de Funcionários
        </h2>
        <a href="./registrarFunc" class="btn btn-primary fw-bold shadow-sm">
            <i class="fas fa-plus me-1"></i> Novo Funcionário
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm card-login border-0">
                <div class="card-body p-4">
                    
                    <div class="table-responsive">
                        <table id="idtabela" class="table table-striped table-hover align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center small">ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th class="text-center">Perfil de Acesso</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($funcionarios as $user):
                                    // Definição das classes de texto do Bootstrap para os perfis
                                    $perfil = '';
                                    switch ($user['tipo_acesso']) {
                                        case 1:
                                            $perfil = '<span class="fw-medium text-info">Professor(a)</span>';
                                            break;
                                        case 2:
                                            $perfil = '<span class="fw-medium text-success">Nutricionista</span>';
                                            break;
                                        case 3:
                                            $perfil = '<span class="fw-medium text-warning">Coordenação</span>';
                                            break;
                                        case 4:
                                            $perfil = '<span class="fw-bold text-danger">Administrador</span>';
                                            break;
                                        default:
                                            $perfil = '<span class="fw-medium text-secondary">Não Definido</span>';
                                            break;
                                    }
                                ?>
                                    <tr>
                                        <td class="text-center small text-muted"><?= $user['id_funcionario'] ?></td>
                                        <td class="fw-medium"><?= $user['nome'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td class="text-center"><?= $perfil ?></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="./editFunc&id=<?= $user['id_funcionario'] ?>" title="Editar" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                                <a href="./deleteFunc&id=<?= $user['id_funcionario'] ?>" title="Excluir" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="fa fa-trash"></i></a>
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

<script src="index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.2/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.2/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>