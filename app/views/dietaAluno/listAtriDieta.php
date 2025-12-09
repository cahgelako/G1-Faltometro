<div class="container my-5">
    <?php require 'app/core/auth.php'; ?>

    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h2 class="fw-bold text-dark mb-0">
          Dietas Atribuídas
        </h2>
        <a href="./registerAtriDieta" class="btn btn-primary fw-bold shadow-sm">
            <i class="fas fa-plus me-1"></i> Atribuir Nova Dieta
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
                    // --------------------------------------
                    // 📝 FUNÇÕES DE CORREÇÃO GRAMATICAL
                    // --------------------------------------

                    function formatarTexto($texto)
                    {
                        $texto = trim(preg_replace('/\s+/', ' ', $texto));
                        return mb_convert_case($texto, MB_CASE_TITLE, "UTF-8");
                    }

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


                    function formatarTurno($t)
                    {
                        return match (strtolower(trim($t))) {
                            'manha', 'manhã', 'm' => 'Manhã',
                            'tarde', 't' => 'Tarde',
                            'integral', 'i' => 'Integral',
                            default => mb_convert_case($t, MB_CASE_TITLE, "UTF-8")
                        };
                    }

                    // Badge de turno (mantido)
                    function getTurnoBadgeDieta($turno)
                    {
                        switch ($turno) {
                            case 1:
                                return '<span class="badge badge-manha ms-1">M</span>';
                            case 2:
                                return '<span class="badge badge-tarde ms-1">T</span>';
                            case 3:
                                return '<span class="badge badge-integral ms-1">I</span>';
                            default:
                                return '';
                        }
                    }
                    ?>

                    <div class="table-responsive">
                        <table id="idtabela" class="table table-striped table-hover align-middle" style="width:100%">
                            <thead>
                                <tr class="table-light">
                                    <th>Estudante</th>
                                    <th>Dieta Atribuída</th>
                                    <th class="text-center">Turma</th>
                                    <th class="text-center">Data da Atribuição</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($agrupado)) {
                                    foreach ($agrupado as $estudante) :

                                        $nome = formatarTexto($estudante['nome']);
                                        $ensino = formatarEnsino($estudante['tipo_ensino']);
                                        $turno = formatarTurno($estudante['turno']);
                                        $data_formatada = date('d/m/Y', strtotime($estudante['data_dieta']));
                                ?>
                                        <tr>
                                            <td class="fw-medium"><?= $nome ?></td>

                                            <td>
                                                <?php foreach ($estudante['dietas'] as $dieta) : ?>
                                                    <span class="badge" style="background-color: #a0c4ff; color: #333333; margin-right:3px;">
                                                        <?= formatarTexto($dieta) ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            </td>

                                            <td class="text-center">
                                                <span class="fw-normal">
                                                    <?= $estudante['nro_turma'] . 'º do ' . formatarEnsino($estudante['tipo_ensino']) . '/' . $estudante['ano_turma'] . '-' .  formatarTurno($estudante['turno'])?>

                                                </span>
                                            </td>

                                            <td class="small text-muted text-center">
                                                <?= $data_formatada ?>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="./editAtriDieta&id_estudante=<?= $estudante['id'] ?>" title="Editar" class="btn btn-sm btn-outline-secondary">
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

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>