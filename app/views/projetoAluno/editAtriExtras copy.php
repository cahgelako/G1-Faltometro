<head>
    <link href="assets/select2/select2.min.css" rel="stylesheet" />
    <link href="assets/select2-bootstrap.min.css" rel="stylesheet" />
    
    <style>
        /* Opcional: Estilo de tags de seleção para maior destaque (ex: cor info/azul) */
        .select2-container .select2-selection--multiple .select2-selection__choice {
            background-color: #0d6efd !important; /* Cor Primária do Bootstrap (azul) */
            color: #ffffff !important; 
            border: 1px solid #0b5ed7 !important;
            border-radius: 0.3rem !important;
        }
        .select2-container .select2-selection--multiple .select2-selection__choice__remove {
            color: #ffffff !important; 
             background-color: #0d6efd;
            border:1px solid #0d6efd ;
            margin-right: 5px !important;
        }
        .select2-results__option {
            color: #000000 !important; /* Garante que as opções no dropdown sejam pretas */
        }
    </style>
</head>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8"> 
            <div class="card shadow-lg border-0 rounded-3"> 
                <div class="card-body p-4 p-md-5">
                    <h2 class="card-title text-center text-dark mb-4 pb-2 border-bottom">
                        <i class="fas fa-puzzle-piece me-2"></i> 
                        Atribuição de Projetos Extracurriculares
                    </h2>
<!--                     
                    <p class="text-center lead mb-4 text-muted">
                        Matrícula ID: <strong><?= htmlspecialchars($_GET['id_projeto']) ?></strong>
                    </p> -->

                    <form method="POST">
                        <input type="hidden" readonly id="id_projeto" name="id_projeto" value="<?= htmlspecialchars($_GET['id_projeto']) ?>">

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <label for="projetos" class="form-label fw-bold text-muted">
                                        <i class="fas fa-th-list me-1"></i> Selecione os Projetos
                                    </label>
                                    <select class="form-select select2-custom" name="arr_mat_id[]" id="projetos" multiple data-placeholder="Digite para buscar e selecionar os projetos...">
                                        <?php foreach ($projetos as $projeto) {
                                            $projeto_id = htmlspecialchars($projeto['id_projeto']);
                                            $projeto_nome = htmlspecialchars($projeto['nome_projeto']);
                                            $op_selected = in_array($projeto['id_projeto'], $matprojetos) ? 'selected' : '';
                                        ?>
                                            <option value="<?= $projeto_id ?>" <?= $op_selected ?>><?= $projeto_nome ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                            <a href="./listAtriExtras" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-arrow-left me-1"></i> Voltar
                            </a>
                              <a href="#" id="linkProjetos" class="btn btn-secondary disabled">Escolher Alunos</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded",
        function() {
            // Verifica se jQuery e Select2 estão disponíveis
            if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
                const $projetos = $('#projetos');

                $projetos.select2({
                    theme: "bootstrap", // Usa o tema Bootstrap
                    placeholder: $projetos.attr('data-placeholder') || 'Digite para buscar projetos...',
                    allowClear: true // Permite limpar a seleção
                });

                // Confirmação ao tentar remover um projeto selecionado
                $projetos.on('select2:unselecting', function(e) {
                    const projetosLabel = $(e.params.args.data.element).text();
                    // Mensagem de confirmação mais clara
                    const confirmacao = confirm(`Confirma a desvinculação? O projeto "${projetosLabel}" será removido desta matrícula.`);

                    if (!confirmacao) {
                        e.preventDefault(); // Cancela a remoção
                    }
                });
            } else {
                console.error("jQuery ou Select2 não estão carregados. Verifique as tags <script>.");
            }
        });
</script>
 <script>
                        document.getElementById('id_matricula').addEventListener('change', function() {
                            const id = this.value;
                            const link = document.getElementById('linkProjetos');

                            if (id) {
                                link.href = './registerAtriExtras&id_matricula=' + encodeURIComponent(id);
                                link.classList.remove('disabled');
                            } else {
                                link.href = '#';
                                link.classList.add('disabled');
                            }
                        });
                    </script>