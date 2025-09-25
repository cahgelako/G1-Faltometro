<?php
class EscolaController extends Controller {
    public function listar() {
        require "app/core/auth.php";
        $model = $this->model('Escola');
        $escolas = $model->listar();
        $this->view('escola/listEscola', ['escolas' => $escolas]);
    }
    
    public function registro() {
        require "app/core/auth.php";
        $model = $this->model('Escola');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST['nome_escola']);
            header("Location: ./listEscola");
        } else {
            $this->view('escola/registroEscola');
        }
    }
    
    public function editar() {
        require "app/core/auth.php";
        $model = $this->model('Escola');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->editar($_POST);
            header("Location: ./listEscola");
        } elseif (isset($_GET['id'])) {
            $escolas = $model->filtrar($_GET['id']);
            $this->view('escola/editEscola', ['escolas' => $escolas]);
        }
    }
}