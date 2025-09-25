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
            $this->view('turma/registerTu');
        }
    }

    public function editar(){
        require_once 'app/core/auth.php';
        $model = $this->model('Turma');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->editar($_POST);
            header("Location: ./listTurma");
        } else if (isset($_GET['id'])) {
            $turmas = $model->filter($_GET['id']);
            $this->view('turma/editTurma', ['turmas' => $turmas]);
        }
        
    }
}