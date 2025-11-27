<?php
class EscolaController extends Controller
{
    public function listar()
    {
        require "app/core/auth.php";
        $model = $this->model('Escola');
        $escolas = $model->listar();
        $data = ['escolas' => $escolas];
        if (isset($_SESSION['msg'])) {
            $data['msg'] = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        $this->view('escola/listEscola', $data);
    }

    public function registrar()
    {
        require "app/core/auth.php";
        $model = $this->model('Escola');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($model->salvar($_POST['nome_escola'])) {
                $_SESSION['msg'] = "Escola registrada com sucesso!";
                header("Location: ./listEscola");
                exit;
            } else {
                $_SESSION['msg'] = "Erro: Escola já existe!";
                header("Location: ./listEscola");
                exit;
            }
        } else {
            $this->view('escola/registerEs');
        }
    }

    public function editar()
    {
        require "app/core/auth.php";
        $model = $this->model('Escola');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->editar($_POST);
            $_SESSION['msg'] = "Escola editada com sucesso!";
            header("Location: ./listEscola");
        } elseif (isset($_GET['id'])) {
            $escolas = $model->filtrar($_GET['id']);
            $this->view('escola/editEscola', ['escolas' => $escolas]);
        }
    }

    public function desativar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Escola');
            $model->desativar($_GET['id']);
        }
        $_SESSION['msg'] = 'Escola desativada com sucesso!';
        header('Location: ./listEscola');
        exit;
    }

    public function ativar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Escola');
            $model->ativar($_GET['id']);
        }
        $_SESSION['msg'] = 'Escola ativada com sucesso!';
        header('Location: ./listEscola');
        exit;
    }
}
