<?php
class DietaEstudanteController extends Controller
{
    public function listar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('DietaEstudante');
        $dietas = $model->listar();
        $this->view('dietaestudante/listDietaEstudante', ['dietas' => $dietas]);
    }

    public function registrar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('DietaEstudante');
        $modelEstudante = $this->model('Estudante');
        $modelDieta = $this->model('DietaEspecial');

        $estudantes = $modelEstudante->listar();
        $dietas = $modelDieta->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST);
            header('Location: ./listDietaEstudante');
        } else {
            $this->view('dietaestudante/registerDietaEstudante', ['estudantes' => $estudantes, 'dietas' => $dietas]);
        }
    }

    public function editar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('DietaEstudante');
        $modelEstudante = $this->model('Estudante');
        $modelDieta = $this->model('DietaEspecial');

        $estudantes = $modelEstudante->listar();
        $dietas = $modelDieta->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST);
            header('Location: ./listDietaEstudante');
        } else if (isset($_GET['id_estudante']) && isset($_GET['id_dieta'])) {
            $dietaestudante = $model->dieta_estudante_por_id($_GET['id_estudante'], $_GET['id_dieta']);
            $this->view('dietaestudante/editDietaEstudante', ['estudantes' => $estudantes, 'dietas' => $dietas, 'dietaestudante' => $dietaestudante]);
        }
    }

    public function deletar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id_estudante']) && isset($_GET['id_dieta'])) {
            $model = $this->model('DietaEstudante');
            $model->deletar($_GET['id_estudante'], $_GET['id_dieta']);
        }
        header('Location: ./listDietaEstudante');
        exit;
    }
}
