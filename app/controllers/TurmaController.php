<?php
class TurmaController extends Controller {

    public function listar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Turma');
        $turmas = $model->listar();
        $this->view('turma/listTurma', ['turmas' => $turmas]);
    }

    public function registrar(){
        require_once 'app/core/auth.php';
        $model = $this->model('Turma');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST);
            header("Location: ./listTurma");
        } else {
            $this->view('turma/registerTurma');
        }
    }

    public function editar(){
        require_once 'app/core/auth.php';
        $model = $this->model('Turma');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->editar($_POST);
            header("Location: ./listTurma");
        } else if (isset($_GET['id'])) {
            $turmas = $model->filtrar($_GET['id']);
            $this->view('turma/editTurma', ['turmas' => $turmas]);
        }
        
    }

    public function deletar() {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Turma');
            $model->deletar($_GET['id']);
        }
        header('Location: ./listTurma');
        exit;
    }
}