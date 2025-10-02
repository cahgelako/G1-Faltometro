<div class="container mt-3">
    <?php require 'app/core/auth.php'; ?>
    <h2 class="card-title mb-4">Painel do Funcionário</h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="col-md-12 mb-3">
                        <a href="./registrarFunc" class="btn btn-primary">Novo</a>
                    </div>
                    <div class="table-responsive">
                        <table id="idtabela" class="table table-bordered" cellpadding="5">
                            <thead>
                                <tr>
                                    <th class="text-center">Chave do Usuário</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Perfil de Acesso</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($funcionarios as $user): 
                                        if ($user['ativo'] == 0) {
                                            $status = "<span style='color: red;'>Inativo</span>";
                                        } elseif ($user['ativo'] == 1) {
                                            $status = "<span style='color: green;'>Ativo</span>";  
                                        }
                                        if ($user['tipo_acesso'] == 1) {
                                            $perfil = "<span style='color: blue;'>Professores(a)</span>";
                                        } elseif ($user['tipo_acesso'] == 2) {
                                        $perfil = "<span style='color: black;'>Nutricionista</span>";  
                                        }elseif($user['tipo_acesso'] == 3){
                                            $perfil = "<span style='color: orange;'>Coordenação</span>";  
                                        }else{
                                            $perfil = "<span style='color: #CC0F87;;'>Administrador</span>";
                                        }
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $user['id_funcionario'] ?></td>
                                        <td><?= $user['nome_funcionario'] ?></td>
                                        <td><?= $user['email_funcionario'] ?></td>
                                        <td class="text-center"><?= $status ?></td>
                                        <td class="text-center"><?= $perfil ?></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="./editFunc&id=<?= $user['id_funcionario'] ?>" title="Editar" class="btn btn-sm btn-warning"><i class="fa fa-edit text-"></i></a>
                                                <a href="./deleteFunc&id=<?= $user['id_funcionario'] ?>"   title="Excluir" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="fa fa-trash"></i></a>
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

   

