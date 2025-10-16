<?php
class ClasseController extends Controller {

    public function listar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Classe');
        $classes = $model->listar();
        $this->view('classe/listClasse', ['classes' => $classes]);
    }

    public function registrar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Classe');
        $modelTurma = $this->model('Turma');
        $modelEscola = $this->model('Escola');

        $turmas = $modelTurma->listar();
        $escolas = $modelEscola->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST);
            header('Location: ./listClasse');
        } else {
            $this->view('classe/registerClasse', ['turmas' => $turmas, 'escolas' => $escolas]);
        }
    }

    public function editar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Classe');
        $modelTurma = $this->model('Turma');
        $modelEscola = $this->model('Escola');

        $turmas = $modelTurma->listar();
        $escolas = $modelEscola->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->editar($_POST);
            header('Location: ./listClasse');
        } else if (isset($_GET['id'])){
            $classes = $model->classe_por_id($_GET['id']);
            //echo '<pre>'; print_r($classe); echo '</pre>';
            $this->view('classe/editClasse', ['turmas' => $turmas, 'escolas' => $escolas, 'classes' => $classes]);
        }
    }

    public function deletar() {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Classe');
            $model->deletar($_GET['id']);
        }
        header('Location: ./listClasse');
        exit;
    }
}