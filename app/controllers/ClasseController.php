<?php
class ClasseController extends Controller
{

    public function listar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Classe');
        $classes = $model->listar();
        $data = ['classes' => $classes];
        if (isset($_SESSION['msg'])) {
            $data['msg'] = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        $this->view('classe/listClasse', $data);
    }

    public function registrar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Classe');
        $modelTurma = $this->model('Turma');
        $modelEscola = $this->model('Escola');

        $turmas = $modelTurma->listar();
        $escolas = $modelEscola->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($model->salvar($_POST)) {
                $_SESSION['msg'] = 'Classe cadastrada com sucesso!';
                header(header: 'Location: ./listClasse');
                exit;
            } else {
                $_SESSION['msg'] = 'Erro: Já existe uma classe para essa combinação de turma e escola.';
                header(header: 'Location: ./editClasse');
                exit;
            }
        } else {
            $this->view('classe/registerClasse', ['classes' => $classes, 'turmas' => $turmas, 'escolas' => $escolas, 'msg' => $msg ?? '']);
        }
    }

    public function editar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Classe');
        $modelTurma = $this->model('Turma');
        $modelEscola = $this->model('Escola');

        $turmas = $modelTurma->listar();
        $escolas = $modelEscola->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($model->editar($_POST)) {
                $_SESSION['msg'] = 'Classe editada com sucesso!';
                header('Location: ./listClasse');
            } else {
                $_SESSION['msg'] = 'Erro: Já existe uma classe para essa combinação de turma e escola.';
                $this->view('classe/editClasse', ['turmas' => $turmas, 'escolas' => $escolas, 'classes' => $_POST]);
            }
        } else if (isset($_GET['id'])) {
            $classes = $model->classe_por_id($_GET['id']);
            $this->view('classe/editClasse', ['turmas' => $turmas, 'escolas' => $escolas, 'classes' => $classes]);
        }
    }

    public function desativar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Classe');
            $model->desativar($_GET['id']);
        }
        $_SESSION['msg'] = 'Classe desativada com sucesso!';
        header('Location: ./listClasse');
        exit;
    }

    public function ativar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Classe');
            $model->ativar($_GET['id']);
        }
        $_SESSION['msg'] = 'Classe ativada com sucesso!';
        header('Location: ./listClasse');
        exit;
    }
}
