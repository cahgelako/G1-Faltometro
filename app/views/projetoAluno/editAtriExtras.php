<head>
    <link href="assets/select2/select2.min.css" rel="stylesheet" />
    <link href="assets/select2-bootstrap.min.css" rel="stylesheet" />
</head>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Atribuir Projeto</h2>
                    <form method="POST">
                        <input type="hidden" readonly class="form-control" id="id_matricula" name="id_matricula" value="<?= $_GET['id_matricula'] ?>">

                        <div class="row">
                            <div class="col-sm-6 mb-3">
                            </div>
                            <p>Projetos Disponíveis</p>
                            <div class="mb-3">
                                <label for="projetos" class="form-label">Selecione os Projetos</label>
                                <select class="form-select" name="arr_projetos_id[]" id="projetos" multiple>
                                    <?php foreach ($projetos as $projeto) {
                                        $op_selected = in_array($projeto['id_projeto'], $matprojetos) ? 'selected' : '';
                                    ?>
                                        <option value="<?= $projeto['id_projeto'] ?>"
                                            <?= $op_selected ?>><?= htmlspecialchars($projeto['nome_projeto']) ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><?= isset($edit) ? 'Atualizar' : 'Cadastrar' ?></button>
                        <a href="./listAtriExtras" class="btn btn-secondary">Voltar</a>
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
            const $projetos = $('#projetos');

            $projetos.select2({
                placeholder: 'Digite para buscar projetos...'
            });

            // Confirmação ao tentar remover um projeto selecionado
            $projetos.on('select2:unselecting', function(e) {
                const projetosLabel = $(e.params.args.data.element).text();
                const confirmacao = confirm(`Tem certeza que deseja remover o projeto: "${projetosLabel}"?`);

                if (!confirmacao) {
                    // Cancela a remoção
                    e.preventDefault();
                }
            });
        });
</script>