<?php
class DietaEspecialController extends Controller
{

    public function listar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('DietaEspecial');
        $dietas = $model->listar();
        $data = ['dietas' => $dietas];
        if (isset($_SESSION['msg'])) {
            $data['msg'] = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        $this->view('dieta/listDieta', $data);
    }

    public function registrar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('DietaEspecial');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($model->salvar($_POST)) {
                $_SESSION['msg'] = "Dieta especial registrada com sucesso!";
                header('Location: ./listDieta');
                exit;
            } else {
                $_SESSION['msg'] = "Erro: Já existe uma dieta especial com esse nome.";
                header('Location: ./listDieta');
                exit;
            }
        } else {
            $this->view('dieta/registerDieta');
        }
    }

    public function editar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('DietaEspecial');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->editar($_POST);
            $_SESSION['msg'] = "Dieta especial editada com sucesso!";
            header('Location: ./listDieta');
        } else if (isset($_GET['id'])) {
            $dietas = $model->dieta_por_id($_GET['id']);
            $this->view('dieta/editDieta', ['dietas' => $dietas]);
        }
    }

    public function deletar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('DietaEspecial');
            $model->deletar($_GET['id']);
        }
        $_SESSION['msg'] = "Dieta especial deletada com sucesso!";
        header('Location: ./listDieta');
        exit;
    }
}
