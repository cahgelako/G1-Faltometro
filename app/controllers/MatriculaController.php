<?php
class MatriculaController extends Controller {

    public function listar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Matricula');
        $matriculas = $model->listar();
        $this->view('matricula/listMatricula', ['matriculas' => $matriculas]);    
    }

    public function registrar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Matricula');
        $modelClasse = $this->model('Classe');
        $modelEstudante = $this->model('Estudante');

        $classes = $modelClasse->listar();
        $estudantes = $modelEstudante->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST);
            header('Location: ./listMatricula');
        } else {
            $this->view('matricula/listMatricula', ['classes' => $classes, 'estudantes' => $estudantes]);
        }
    }

    public function editar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Matricula');
        $modelClasse = $this->model('Classe');
        $modelEstudante = $this->model('Estudante');

        $classes = $modelClasse->listar();
        $estudantes = $modelEstudante->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST);
            header('Location: ./listMatricula');
        } else if (isset($_GET['id'])){
            $matricula = $model->matricula_por_id($_GET['id']);
            $this->view('matricula/listMatricula', ['classes' => $classes, 'estudantes' => $estudantes, 'matricula' => $matricula]);
        }
    }

    public function deletar() {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Matricula');
            $model->deletar($_GET['id']);
        }
        header('Location: ./listMatricula');
        exit;
    }
}