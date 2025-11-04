<?php
class EstudanteController extends Controller {

    public function listar(): void {
        require_once 'app/core/auth.php';
        $model = $this->model('Estudante');
        $estudantes = $model->listar();
        $this->view('estudante/listEstudante', ['estudantes' => $estudantes]);
    }

    public function registrar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Estudante');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST);
            header('Location: ./listEstudante');
        } else {
            $this->view('estudante/registerEstudantes');
        }
    }

    public function editar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Estudante');
        $modelDieta = $this->model('DietaEspecial');
        $modelDietaEs = $this->model('DietaEstudante');

        $dietas = $modelDieta->listar();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->editar($_POST);
            $modelDietaEs->salvar($_POST);
            header('Location: ./listEstudante');
        } else if (isset($_GET['id'])) {
            $estudantes = $model->estudante_por_id($_GET['id']);
            $this->view('estudante/editEstudante', ['estudantes' => $estudantes,'dietas' => $dietas]);
        }
    }

    public function deletar() {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Estudante');
            $model->deletar($_GET['id']);
        }
        header('Location: ./listEstudante');
        exit;
    }

    public function visualizar_estudante() {
       require_once 'app/core/auth.php';
        $model = $this->model('Estudante');
        $modelMatProjeto = $this->model('MatriculaProjeto');
        $modelDietasEs = $this->model('DietaEstudante');

        if (isset($_GET['id'])) {
            $estudantes = $model->estudante_por_id(isset($_GET['id']));
            $participando = $modelMatProjeto->projetos_por_estudante(isset($_GET['id']));
            $dietas = $modelDietasEs->dietas_do_estudante(isset($_GET['id']));
            $this->view('estudante/viewEstudante', ['estudantes' => $estudantes, 'participando' => $participando, 'dietas' => $dietas]); 
        } else {
            $this->view('estudante/listEstudante'); 
        }

    }
}