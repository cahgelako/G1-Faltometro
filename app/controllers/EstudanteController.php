<?php
class EstudanteController extends Controller {

    public function listar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Estudante');
        $estudantes = $model->listar();
        $this->view('estudante/listEstudante', ['estudantes' => $estudantes]);
    }

    public function registar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Estudante');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($POST);
            header('Location: ./listEstudante');
        } else {
            $this->view('estudante/registerEstudante');
        }
    }

    public function editar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Estudante');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->editar($_POST);
            header('Location: ./listEstudante');
        } else if (isset($_GET['id'])) {
            $estudante = $model->estudante_por_id($_GET['id']);
            $this->view('estudante/editEstudante', ['estudantes' => $estudantes]);
        }
    }

}