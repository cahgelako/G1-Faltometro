<?php
class MatriculaProjetoController extends Controller
{
    public function listar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('MatriculaProjeto');
        $matriculas = $model->listar();
        $this->view('matriculaprojeto/listMatProjeto', ['matriculas' => $matriculas]);
    }

    public function registrar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('MatriculaProjeto');
        $modelMatriculas = $this->model('Matricula');
        $modelProjetos = $this->model('Projeto');

        $matriculas = $modelMatriculas->listar();
        $projetos = $modelProjetos->listar();
        $participando = $model->projetos_por_estudante();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST);
            header('Location: ./listMatProjeto');
        } else {
            $this->view('matriculaprojeto/registerMatProjeto', ['matriculas' => $matriculas, 'projetos' => $projetos, 'participando' => $participando]);
        }
    }

    public function editar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('MatriculaProjeto');
        $modelMatriculas = $this->model('Matricula');
        $modelProjetos = $this->model('Projeto');

        $matriculas = $modelMatriculas->listar();
        $projetos = $modelProjetos->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST);
            header('Location: ./listMatProjeto');
        } else if (isset($_GET['id_projeto']) && isset($_GET['id_matricula'])) {
            $matprojetos = $model->matricula_proj_estudante_por_id($_GET['id_projeto'], $_GET['id_matricula']);
            $this->view('matriculaprojeto/editMatProjeto', ['matriculas' => $matriculas, 'projetos' => $projetos, 'matprojetos' => $matprojetos]);
        }
    }

    public function deletar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id_projeto']) && isset($_GET['id_matricula'])) {
            $model = $this->model('MatriculaProjeto');
            $model->deletar($_GET['id_projeto'], $_GET['id_matricula']);
        }
        header('Location: ./listMatProjeto');
        exit;
    }
}
