<?php
 class FrequenciaController extends Controller {

    public function listar_turmas() {
        require_once 'app/core/auth.php';
        $modelClasse = $this->model('Classe');
        $turmas = $modelClasse->listar();
        $this->view('frequencia/listFrenqTu', ['turmas' => $turmas]);
    }

    public function registrar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Frequencia');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // pegar os dados do POST[], percorrer o array e inserir um por um
            // verificar quais foram checados. Se foi, status_presenca = 0, senão status_presenca = 1 
            $professor = $_SESSION['func_id_funcionario'];

            foreach ($_POST as $key) {
                echo $key;
            }

            $model->salvar($_POST);
            header('Location: ./listEstudante');
        } else if ($_GET['id_classe']) {
            $estudantes = $model->estudantes_por_classe($_GET['id_classe']);
            $this->view('frequencia/registerFrenqAluno', ['estudantes' => $estudantes]);
        }
    }

    public function editar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Frequencia');
    }

    public function filtro() {
        require_once 'app/core/auth.php';
        $model = $this->model('Frequencia');
    }

    public function deletar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Frequencia');

    }
 }