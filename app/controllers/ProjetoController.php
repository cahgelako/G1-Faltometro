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
 }