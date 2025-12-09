<style>
    /* * ESTILO ESSENCIAL PARA AS IMAGENS DA TABELA 
 * Isso garante que as imagens fiquem pequenas e não quebrem o layout.
 */
    .table-img {
        width: 50px;
        /* Largura da imagem */
        height: 50px;
        /* Altura da imagem */
        object-fit: cover;
        /* Garante que a imagem preencha o espaço sem distorcer (cortando as bordas se necessário) */
        border-radius: 8px;
        /* Borda arredondada (opcional) */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        /* Sombra suave para destaque (opcional) */
    }
</style>

<div class="container my-5">
    <?php require 'app/core/auth.php'; ?>

    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h2 class="fw-bold text-dark mb-0">
         Painel de Turmas
        </h2>
        <a href="./registerTurma" class="btn btn-primary fw-bold shadow-sm">
            <i class="fas fa-plus me-1"></i> Nova classe
        </a>
    </div>

    <?php if (isset($msg)) { ?>
        <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-info-circle me-2"></i> <b>Aviso:</b> <?php echo $msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    <?php } ?>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <?php
                    // Lógica de mapeamento de turno e status
                    function getTurnoBadge($turno)
                    {
                        switch ($turno) {
                            case 'manha':
                                return '<span class="badge bg-primary text-white">Manhã</span>';
                            case 'tarde':
                                return '<span class="badge bg-success text-white">Tarde</span>';
                            default:
                                return '<span class="badge" style="background-color: #CC0F87; color: white;">Integral</span>';
                        }
                    }

                    function getStatusBadge($ativo)
                    {
                        return $ativo == 'ativo'
                            ? '<span class="badge bg-danger text-white">Ativo</span>'
                            : '<span class="badge bg-secondary text-white">Desativado</span>';
                    }

                    //função de correção gramatical
                    function formatarEnsino($tipo)
                    {
                        $tipo = strtolower(trim($tipo));

                        return match ($tipo) {
                            'ef1' => 'Ensino Fundamental I',
                            'ef2' => 'Ensino Fundamental II',
                            'em'  => 'Ensino Médio',
                            default => ucfirst($tipo)
                        };
                    }


                    // Caminho da imagem de FALLBACK (MUITO IMPORTANTE!)
                    $fallback_image_path = "/img/default_turma.png"; // <-- Mude isso para o caminho da sua imagem padrão
                    ?>

                    <div class="table-responsive">
                        <table id="idtabela" class="table table-striped table-hover align-middle" style="width:100%">
                            <thead>
                                <tr class="table-light">
                                    <th class="text-center small">ID</th>
                                    <th class="text-center">Imagem</th>
                                    <th>Nome Turma</th>
                                    <th>Escola</th>
                                    <th class="text-center">Ano</th>
                                    <th class="text-center">Turno</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($turmas)) {
                                    foreach ($turmas as $turma):
                                ?>
                                        <tr>
                                            <td class="text-center small text-muted"><?= $turma['id_turma'] ?></td>
                                            <td class="text-center">
                                                <?php
                                                $image_file = $turma['img'] ?? '';
                                                $image_src = empty($image_file) ? $fallback_image_path : "img/{$image_file}";
                                                ?>
                                                <img src="<?= $image_src ?>"
                                                    alt="Imagem da classe"
                                                    class="table-img">
                                            </td>
                                            <td class="fw-medium">
                                                <?= $turma['nro_turma'] ?>º ano do <?= formatarEnsino($turma['tipo_ensino']) ?>
                                            </td>

                                            <td><?= $turma['nome_escola'] ?></td>
                                            <td class="text-center"><?= $turma['ano_turma'] ?></td>
                                            <td class="text-center"><?= getTurnoBadge($turma['turno']) ?></td>
                                            <td class="text-center"><?= getStatusBadge($turma['ativo']) ?></td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <?php if ($turma['ativo'] == 'ativo'): ?>
                                                        <a href="./desativarTurma&id=<?= $turma['id_turma'] ?>" title="Desativar" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja desativar esta classe?')"><i class="fa fa-ban"></i></a>
                                                    <?php else: ?>
                                                        <a href="./ativarTurma&id=<?= $turma['id_turma'] ?>" title="Ativar" class="btn btn-sm btn-outline-success" onclick="return confirm('Tem certeza que deseja ativar esta classe?')"><i class="fa fa-check"></i></a>
                                                    <?php endif; ?>
                                                    <a href="./editTurma&id=<?= $turma['id_turma'] ?>" title="Editar" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                                    <a href="./editAlunoTurma&id=<?= $turma['id_turma'] ?>" title="Editar Participantes" class="btn btn-sm btn-outline-warning"><i class="fa fa-users"></i></a>
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
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>