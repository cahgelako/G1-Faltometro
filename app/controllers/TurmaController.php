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
        $modelTurma = $this->model('Turma');
        $modelEscola = $this->model('Escola');

        $escolas = $modelEscola->listar();
        $data = ['escolas' => $escolas];
        if (isset($_SESSION['msg'])) {
            $data['msg'] = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;
            $dados['img'] = $_FILES['img'] ?? null;
            if ($modelTurma->salvar($dados)) {
                $_SESSION['msg'] = 'Turma cadastrada com sucesso!';
                header(header: 'Location: ./listTurma');
                exit;
            } else {
                $_SESSION['msg'] = 'Erro: Já existe uma turma para essa combinação de turma e escola.';
                header(header: 'Location: ./registerTurma');
                exit;
            }
        } else {
            $this->view('turma/registerTurma', $data);
        }
    }

    public function editar()
    {
        require_once 'app/core/auth.php';
        $modelTurma = $this->model('Turma');
        $modelEscola = $this->model('Escola');

        $escolas = $modelEscola->listar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;
            $dados['img'] = $_FILES['img'] ?? null;
            if ($modelTurma->editar($dados)) {
                $_SESSION['msg'] = 'Turma editada com sucesso!';
                header('Location: ./listTurma');
            } else {
                $turma = $modelTurma->turma_por_id($_POST['id_turma']);
                $data = ['escolas' => $escolas, 'turma' => $turma];
                if (isset($_SESSION['msg'])) {
                    $data['msg'] = $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                $_SESSION['msg'] = 'Erro: Já existe uma turma para essa combinação de turma e escola.';
                $this->view('turma/editTurma', $data);
            }
        } else if (isset($_GET['id'])) {
            $turma = $modelTurma->turma_por_id($_GET['id']);
            $this->view('turma/editTurma', ['turma' => $turma, 'escolas' => $escolas]);
        }
    }

    public function desativar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('turma');
            $model->desativar($_GET['id']);
        }
        $_SESSION['msg'] = 'Turma desativada com sucesso!';
        header('Location: ./listTurma');
        exit;
    }

    public function ativar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('turma');
            $model->ativar($_GET['id']);
        }
        $_SESSION['msg'] = 'Turma ativada com sucesso!';
        header('Location: ./listTurma');
        exit;
    }
}
