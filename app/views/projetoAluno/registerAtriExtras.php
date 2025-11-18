<head>
    <link href="assets/select2/select2.min.css" rel="stylesheet" />
    <link href="assets/select2-bootstrap.min.css" rel="stylesheet" />

    <style>
        /* Regras para o texto das opções na lista suspensa (Dropdown) */
        .select2-results__option {
            color: #000000 !important; /* Cor do texto das opções na lista */
        }
        
        /* NOVO ESTILO: Dietas Selecionadas (Tags/Pílulas) */
        .select2-container .select2-selection--multiple .select2-selection__choice {
            /* Fundo Verde Claro (pode usar #d1e7dd ou uma cor personalizada) */
            background-color: #5cb85c !important; 
            color: #ffffff !important; /* Texto Branco para contraste */
            border: 1px solid #4cae4c !important; /* Borda Verde Escuro */
            border-radius: 0.5rem !important; /* Mais arredondado */
            padding: 3px 10px 3px 10px !important; /* Aumenta o padding interno */
            margin-top: 5px !important; /* Pequeno ajuste de margem para melhor visualização */
        }

        /* NOVO ESTILO: Botão de remoção (o 'x') */
        .select2-container .select2-selection--multiple .select2-selection__choice__remove {
            color: #F5F5F4 !important; /* Cor do 'x' branco */
            background-color: #5cb85c;
            border:1px solid #5cb85c  ;
            margin-right: 5px !important;
        }

        /* Estilo ao passar o mouse sobre o botão de remoção */
        .select2-container .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #f8d7da !important; /* Cor mais clara ao passar o mouse */
        }
    </style>
</head>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8"> 
            <div class="card shadow-lg border-0 rounded-3"> 
                <div class="card-body p-4 p-md-5">
                    <h2 class="card-title text-center text-dark mb-4 pb-2 border-bottom">
                        <i class="fas fa-utensils me-2"></i> 
                        Atribuir Alunos ao Projeto
                    </h2>
                    
                    <?php if (isset($nome_projeto)) { ?>
                        <p class="text-center lead mb-4">Projeto: <strong><?= htmlspecialchars($nome_projeto) ?></strong></p>
                    <?php } ?>

                    <form method="POST">
                        <input type="hidden" readonly id="id_projeto" name="id_projeto" value="<?= htmlspecialchars($_GET['id_projeto']) ?>">

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <label for="dietas" class="form-label fw-bold text-muted">
                                        <i class="fas fa-list-check me-1"></i> Selecione os Alunos Disponíveis
                                    </label>
                                    <select class="form-select select2-custom" name="arr_mat_id[]" id="alunos" multiple data-placeholder="Digite para buscar e selecionar alunos...">
                                        <?php foreach ($matriculas as $aluno) {
                                            // Usar htmlspecialchars para evitar XSS no valor do atributo
                                            $aluno_id = htmlspecialchars($aluno['id_matricula']); 
                                            $aluno_nome = htmlspecialchars($aluno['nome_estudante']);
                                            $op_selected = in_array($aluno['id_matricula'], $matprojeto) ? 'selected' : '';
                                        ?>
                                            <option   value="<?= $aluno_id ?>" <?= $op_selected ?>><?= $aluno_nome ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                            <a href="./listAtriExtras" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-arrow-left me-1"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                <i class="fas fa-save me-1"></i> 
                                <?= isset($edit) ? 'Atualizar Atribuição' : 'Atribuir Dietas' ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded",
        function() {
            // Verifica se jQuery e Select2 estão disponíveis
            if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
                const $alunos = $('#matriculas');

                // Inicializa o Select2, usando o atributo data-placeholder
                $alunos.select2({
                    // Adiciona o tema Bootstrap
                    theme: "bootstrap", 
                    // Tenta usar o placeholder do data-attribute
                    placeholder: $alunos.attr('data-placeholder') || 'Digite para buscar os alunos...',
                    allowClear: true // Permite limpar a seleção se não for 'multiple' (boa prática)
                });

                // Confirmação mais amigável ao tentar remover uma dieta selecionada
                $alunos.on('select2:unselecting', function(e) {
                    const alunoLabel = $(e.params.args.data.element).text();
                    // Alerta mais moderno (embora o confirm nativo seja funcional)
                    if (!confirm(`Confirma a remoção? O aluno "${alunoLabel}" será desvinculada.`)) { 
                        e.preventDefault(); // Cancela a remoção
                    }
                });
            } else {
                console.error("jQuery ou Select2 não estão carregados. Verifique as tags <script>.");
            }
        });
</script>