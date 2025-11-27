<?php
class MatriculaController extends Controller
{

    public function listar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Matricula');
        $matriculas = $model->listar();
        $data = ['matriculas' => $matriculas];
        if (isset($_SESSION['msg'])) {
            $data['msg'] = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        $this->view('matricula/listMatricula', $data);
    }

    public function registrar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Matricula');
        $modelClasse = $this->model('Classe');
        $modelEstudante = $this->model('Estudante');

        $classes = $modelClasse->listar();
        $estudantes = $modelEstudante->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($model->salvar($_POST)) {
                $_SESSION['msg'] = 'Matrícula cadastrada com sucesso!';
                header('Location: ./listMatricula');
                exit;
            } else {
                $_SESSION['msg'] = 'Erro: Já existe uma matrícula para essa combinação de classe e estudante.';
                header('Location: ./listMatricula');
                exit;
            }
        } else {
            $this->view('matricula/registerMatricula', ['classes' => $classes, 'estudantes' => $estudantes]);
        }
    }
       

    public function editar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Matricula');
        $modelClasse = $this->model('Classe');
        $modelEstudante = $this->model('Estudante');

        $classes = $modelClasse->listar();
        $estudantes = $modelEstudante->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->editar($_POST);
            $_SESSION['msg'] = 'Matrícula editada com sucesso!';
            header('Location: ./listMatricula');
        } else if (isset($_GET['id'])) {
            $matricula = $model->matricula_por_id($_GET['id']);
            $this->view('matricula/editMatricula', ['classes' => $classes, 'estudantes' => $estudantes, 'matricula' => $matricula]);
        }
    }

    public function desativar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Matricula');
            $model->desativar($_GET['id']);
        }
        $_SESSION['msg'] = 'Matrícula desativada com sucesso!';
        header('Location: ./listMatricula');
        exit;
    }
    public function ativar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Matricula');
            $model->ativar($_GET['id']);
        }
        $_SESSION['msg'] = 'Matrícula ativada com sucesso!';
        header('Location: ./listMatricula');
        exit;
    }
}
