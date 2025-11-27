<?php
class TurmaController extends Controller
{

    public function listar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Turma');
        $turmas = $model->listar();
        $data = ['turmas' => $turmas];
        if (isset($_SESSION['msg'])) {
            $data['msg'] = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        $this->view('turma/listTurma', $data);
    }

    public function registrar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Turma');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($model->salvar($_POST)) {
                $_SESSION['msg'] = "Turma cadastrada com sucesso!";
                header("Location: ./listTurma");
                exit;
            } else {
                $_SESSION['msg'] = "Erro: Já existe uma turma com esse nome.";
                header("Location: ./listTurma");
                exit;
            }
        } else {
            $this->view('turma/registerTurma');
        }
    }

    public function editar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Turma');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->editar($_POST);
            $_SESSION['msg'] = "Turma editada com sucesso!";
            header("Location: ./listTurma");
        } else if (isset($_GET['id'])) {
            $turmas = $model->filtrar($_GET['id']);
            $this->view('turma/editTurma', ['turmas' => $turmas]);
        }
    }

    public function deletar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Turma');
            $model->deletar($_GET['id']);
        }
        $_SESSION['msg'] = "Turma deletada com sucesso!";
        header('Location: ./listTurma');
        exit;
    }
}
