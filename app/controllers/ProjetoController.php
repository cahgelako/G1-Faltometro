<?php
 class ProjetoController extends Controller {

    public function listar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Projeto');
        $projetos = $model->listar();
        $data = ['projetos' => $projetos];
        if (isset($_SESSION['msg'])) {
            $data['msg'] = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        $this->view('projeto/listProjeto', $data);
    }
    
    public function registrar() {
        require "app/core/auth.php";
        $model = $this->model('Projeto');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($model->salvar($_POST)) {
                $_SESSION['msg'] = 'Turma extracurrilar cadastrada com sucesso!';
                header('Location: ./listProjeto');
                exit;
            } else {
                $_SESSION['msg'] = 'Erro: Já existe uma turma extracurrilar com esse nome e turno.';
                header('Location: ./listProjeto');
                exit;
            }
        } else {
            $this->view('projeto/registerProjeto');
        }
    }
    
    public function editar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Projeto');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->editar($_POST);
            $_SESSION['msg'] = 'Turma extracurrilar editada com sucesso!';
            header('Location: ./listProjeto');
        } else if (isset($_GET['id'])) {
            $projeto = $model->projeto_por_id($_GET['id']);
            $this->view('projeto/editProjeto', ['projeto' => $projeto]);
        }
    }
    
    public function desativar() {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Projeto');
            $model->desativar($_GET['id']);
        }
        $_SESSION['msg'] = 'Turma extracurrilar desativada com sucesso!';
        header('Location: ./listProjeto');
        exit;
    }
    
    public function ativar() {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Projeto');
            $model->ativar($_GET['id']);
        }
        $_SESSION['msg'] = 'Turma extracurrilar ativada com sucesso!';
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