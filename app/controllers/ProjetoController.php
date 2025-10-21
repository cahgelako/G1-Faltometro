<?php
 class ProjetoController extends Controller {

    public function listar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Projeto');
        $projetos = $model->listar();
        $this->view('projeto/listProjeto', ['projetos' => $projetos]);
    }

    public function registrar() {
        require "app/core/auth.php";
        $model = $this->model('Projeto');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST);
            header("Location: ./listProjeto");
        } else {
            $this->view('projeto/registerProjeto');
        }
    }

    public function editar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Projeto');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->editar($_POST);
            header('Location: ./listProjeto');
        } else if (isset($_GET['id'])) {
            $projeto = $model->projeto_por_id($_GET['id']);
            $this->view('projeto/editProjeto', ['projeto' => $projeto]);
        }
    }

    public function deletar() {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Projeto');
            $model->deletar($_GET['id']);
        }
        header('Location: ./listProjeto');
        exit;
    }

    public function visualizar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Projeto');
        $modelMatProjeto = $this->model('MatriculaProjeto');

        if (isset($_GET['id'])) {
            $projetos = $model->projeto_por_id();
            $estudantes_do_projeto = $modelMatProjeto->estudantes_por_projeto();
            $this->view('projeto/viewProjeto', ['projetos' => $projetos, 'estudantes_do_projeto' => $estudantes_do_projeto]);
        } else {
            $this->view('projeto/listProjeto');
        }
    }
 }