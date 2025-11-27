<?php
class EstudanteController extends Controller
{

    public function listar(): void
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Estudante');
        $estudantes = $model->listar();
        $data = ['estudantes' => $estudantes];
        if (isset($_SESSION['msg'])) {
            $data['msg'] = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        $this->view('estudante/listEstudante', $data);
    }

    public function registrar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Estudante');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($model->salvar($_POST)) {
                $_SESSION['msg'] = "Estudante registrado com sucesso!";
                header('Location: ./listEstudante');
                exit;
            } else {
                $_SESSION['msg'] = "Erro: Já existe um estudante com esse nome.";
                header('Location: ./listEstudante');
                exit;
            }
        } else {
            $this->view('estudante/registerEstudantes');
        }
    }

    public function editar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Estudante');
        $modelDieta = $this->model('DietaEspecial');
        $modelDietaEs = $this->model('DietaEstudante');

        $dietas = $modelDieta->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->editar($_POST);
            $modelDietaEs->editar($_POST);
            $_SESSION['msg'] = "Estudante editado com sucesso!";
            header('Location: ./listEstudante');
        } else if (isset($_GET['id'])) {
            $estudantes = $model->estudante_por_id($_GET['id']);
            $this->view('estudante/editEstudante', ['estudantes' => $estudantes, 'dietas' => $dietas]);
        }
    }

    public function deletar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Estudante');
            $model->deletar($_GET['id']);
        }
        $_SESSION['msg'] = "Estudante deletado com sucesso!";
        header('Location: ./listEstudante');
        exit;
    }

    public function visualizar_estudante()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Estudante');
        $modelMatProjeto = $this->model('MatriculaProjeto');
        $modelDietasEs = $this->model('DietaEstudante');

        if (isset($_GET['id'])) {
            $estudantes = $model->estudante_por_id(isset($_GET['id']));
            $participando = $modelMatProjeto->projetos_por_estudante(isset($_GET['id']));
            $dietas = $modelDietasEs->dietas_do_estudante(isset($_GET['id']));
            $this->view('estudante/viewEstudante', ['estudantes' => $estudantes, 'participando' => $participando, 'dietas' => $dietas]);
        } else {
            $this->view('estudante/listEstudante');
        }
    }
}
