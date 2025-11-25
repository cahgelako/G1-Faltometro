<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                <?php
                    // Agrupar alunos pelo projeto (NÃO ALTERADO)
                    $projetos = [];

                    foreach ($estudantes as $item) {
                        $projetos[$item['nome_projeto']][] = [
                            'nome_estudante' => $item['nome_estudante'],
                            'id_matricula'   => $item['id_matricula']
                        ];
                    }
                ?>

                <form method="POST">

                    <h5 class="mb-3 text-secondary border-bottom pb-1">Alunos</h5>

                    <div class="row">

                        <div class="col-sm-12 mb-4">
                            
                            <?php if (!empty($projetos)): ?>
                                <select 
                                    class="form-select" 
                                    name="arr_mat_id[]" 
                                    id="select2-alunos" 
                                    multiple="multiple"
                                    style="width: 100%;"
                                >
                                
                                    <?php foreach ($projetos as $nomeProjeto => $alunos): ?>
                                        <optgroup label="<?= htmlspecialchars($nomeProjeto) ?>">

                                            <?php foreach ($alunos as $aluno): ?>
                                                <option 
                                                    value="<?= htmlspecialchars($aluno['id_matricula']) ?>"
                                                    selected 
                                                >
                                                    <?= htmlspecialchars($aluno['nome_estudante']) ?>
                                                </option>
                                            <?php endforeach; ?>

                                        </optgroup>
                                    <?php endforeach; ?>

                                </select>
                                <?php else: ?>

                                <p class="text-muted text-center">Nenhum estudante encontrado.</p>

                            <?php endif; ?>

                        </div>

                    </div>

                    <hr class="mt-4 mb-3">

                    <div class="d-flex justify-content-end gap-2">

                        <a href="./listProjeto" class="btn btn-secondary px-4">
                            <i class="fas fa-arrow-left me-1"></i> Voltar
                        </a>

                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fas fa-sync-alt me-1"></i> Atualizar Dados
                        </button>

                    </div>

                </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Inicializa o Select2 no elemento com id="select2-alunos"
        $('#select2-alunos').select2({
            placeholder: "Selecione um ou mais alunos", // Texto a ser exibido
            allowClear: true, // Permite limpar a seleção
            theme: "default" // Você pode usar "bootstrap" se estiver usando Select2 Bootstrap Theme
        });
    });
</script>