<head>
    <link href="assets/select2/select2.min.css" rel="stylesheet" />
    <link href="assets/select2-bootstrap.min.css" rel="stylesheet" />
</head>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Atribuir Dieta</h2>
                    <form method="POST">
                        <input type="hidden" readonly class="form-control" id="id_estudante" name="id_estudante" value="<?= $_GET['id_estudante'] ?>">

                        <div class="row">
                            <div class="col-sm-6 mb-3">
                            </div>
                            <p>Dietas Disponíveis</p>
                            <div class="mb-3">
                                <label for="dietas" class="form-label">Selecione as Dietas</label>
                                <select class="form-select" name="arr_dieta_id[]" id="dietas" multiple>
                                    <?php foreach ($dietas as $dieta) {
                                        $op_selected = in_array($dieta['id_dieta'], $dietaestudante) ? 'selected' : '';
                                    ?>
                                        <option value="<?= $dieta['id_dieta'] ?>"
                                            <?= $op_selected ?>><?= htmlspecialchars($dieta['nome_dieta']) ?></option>
                                    <?php } ?>
                                </select>
                            </div>




                        </div>
                        <button type="submit" class="btn btn-primary"><?= isset($edit) ? 'Atualizar' : 'Cadastrar' ?></button>
                        <a href="./listAtriDieta" class="btn btn-secondary">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery + Select2 + Bootstrap -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script src="assets/jquery-3.7.1.min.js"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<!-- <script src="assets/select2/select2.full.min.js"></script> -->
<script>
    document.addEventListener("DOMContentLoaded",
        function() {
            const $dietas = $('#dietas');

            $dietas.select2({
                placeholder: 'Digite para buscar dietas...'
            });

            // Confirmação ao tentar remover uma dieta selecionada
            $dietas.on('select2:unselecting', function(e) {
                const dietaLabel = $(e.params.args.data.element).text();
                const confirmacao = confirm(`Tem certeza que deseja remover a dieta: "${dietaLabel}"?`);

                if (!confirmacao) {
                    // Cancela a remoção
                    e.preventDefault();
                }
            });
        });
</script>