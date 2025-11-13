<div class="container mt-3">
    <?php require 'app/core/auth.php'; ?>
    <h2 class="card-title mb-4">Relatório </h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <?php if (isset($erro)) {echo $erro;} else {echo '';} ?>
                <form action="" method="post">
                    <label for="dta_inicial">Data inicial</label>
                    <input type="date" name="dta_inicial" id="dta_inicial">

                    <label for="dta_final">Data inicial</label>
                    <input type="date" name="dta_final" id="dta_final">

                    <label for="nome_estudante">Data inicial</label>
                    <input type="date" name="nome_estudante" id="nome_estudante">

                    <button type="submit">Pequisar</button>
                </form>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="idtabela" class="table table-bordered" cellpadding="5">
                            <thead>
                                <tr>
                                    <th class="text-center">Registro de Matrícula</th>
                                    <th>Nome</th>
                                    <th>Data</th>
                                    <th>Funcionário Responsável</th>
                                    <th>Classe</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($frequencia as $f) :
                                    if ($f['turno']== 1) {
                                        $turno = 'Manhã';
                                    } else if ($f['turno']== 2) {
                                        $turno = 'Tarde';
                                    } else {
                                        $turno = 'Integral';
                                    }
                                ?>
                                <tr>
                                    <td><?= $f['registro_matricula_escola'] ?></td>
                                    <td><?= $f['nome_estudante'] ?></td>
                                    <td><?= $f['data_falta'] ?></td>
                                    <td><?= $f['nome'] ?></td>
                                    <td><?= $f['nome_turma']?>-<?= $turno ?>/<?= $f['ano_turma'] ?></td>
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

   

