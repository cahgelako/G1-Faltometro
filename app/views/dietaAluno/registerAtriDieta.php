<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    footer {
        margin-top: auto;
    }
</style>

<head>
    <link href="assets/select2/select2.min.css" rel="stylesheet" />
    <link href="assets/select2-bootstrap.min.css" rel="stylesheet" />

    <style>
        .select-container {
            /* Força a largura para que o select fique legível com busca */
            min-width: 300px;
        }

        .select2-results__option {
            color: #000000 !important;
            /* Cor do texto das opções na lista */
        }
    </style>
</head>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4 p-md-5">
                    <h2 class="card-title text-center text-dark mb-4 pb-2 border-bottom">
                        <i class="fas fa-user-tag me-2"></i>
                        Atribuição de Dieta
                    </h2>

                    <p class="text-center text-muted mb-4">
                        Selecione o estudante para gerenciar suas dietas.
                    </p>

                    <form method="POST">
                        <div class="row justify-content-center">
                            <div class="col-sm-10 col-md-8 mb-4 select-container">
                                <label for="id_estudante" class="form-label fw-bold">
                                    <i class="fas fa-search me-1"></i> Estudante
                                </label>
                                <select class="form-select select2-custom" name="id_estudante" id="id_estudante" required data-placeholder="Digite o nome do estudante...">
                                    <option></option> <?php foreach ($estudantes as $aluno) { ?>
                                        <option value="<?= htmlspecialchars($aluno['id_estudante']) ?>">
                                            <?= htmlspecialchars($aluno['nome_estudante']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="text-center mt-4 pt-3 border-top">
                            <a href="#" id="linkDietas" class="btn btn-primary btn-lg disabled shadow">
                                <i class="fas fa-forward me-1"></i> Avançar para Dietas
                            </a>
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
            const $selectEstudante = $('#id_estudante');
            const linkDietas = document.getElementById('linkDietas');

            // 1. Inicializa o Select2 para permitir a busca
            if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
                $selectEstudante.select2({
                    theme: "bootstrap",
                    placeholder: $selectEstudante.attr('data-placeholder'),
                    allowClear: true // Permite desmarcar
                });
            } else {
                console.warn("Select2 não inicializado. Verifique a inclusão do jQuery e do Select2.");
            }

            // 2. Lógica para habilitar/desabilitar o botão de avançar
            // Usando o evento 'change' padrão (funciona mesmo sem Select2)
            $selectEstudante.on('change', function() {
                const id = $(this).val(); // Obter o valor via jQuery

                if (id) {
                    // Monta o link para o módulo de edição/atribuição
                    linkDietas.href = './editAtriDieta&id_estudante=' + encodeURIComponent(id);
                    linkDietas.classList.remove('disabled');
                    linkDietas.classList.add('btn-primary');
                    linkDietas.classList.remove('btn-secondary');
                } else {
                    linkDietas.href = '#';
                    linkDietas.classList.add('disabled');
                    linkDietas.classList.remove('btn-primary');
                    linkDietas.classList.add('btn-secondary');
                }
            }).trigger('change'); // Força a verificação inicial caso haja um valor pré-selecionado
        });
</script>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>