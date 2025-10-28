<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Atribuir Projeto</h2>
                    <form method="POST">
                        <div class="row">
                            <div class="col-sm-3 mb-3">
                                <label for="id_matricula" class="form-label">Estudante</label>
                                <select class="form-select" name="id_matricula" id="id_matricula" required>
                                    <option value="">-- Selecione um aluno --</option>
                                    <?php foreach ($matriculas as $aluno) { ?>
                                        <option value="<?= $aluno['id_matricula'] ?>"> <?= htmlspecialchars($aluno['nome_estudante']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <a href="#" id="linkProjetos" class="btn btn-secondary disabled">Escolher Projetos</a>
                    </form>

                    <script>
                        document.getElementById('id_matricula').addEventListener('change', function() {
                            const id = this.value;
                            const link = document.getElementById('linkProjetos');

                            if (id) {
                                link.href = './editAtriExtras&id_matricula=' + encodeURIComponent(id);
                                link.classList.remove('disabled');
                            } else {
                                link.href = '#';
                                link.classList.add('disabled');
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>