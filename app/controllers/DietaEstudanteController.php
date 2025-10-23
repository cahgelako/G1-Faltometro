<?php
class DietaEstudanteController extends Controller
{
    public function listar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('DietaEstudante');
        $dietas = $model->listar();
        $this->view('dietaAluno/listAtriDieta', ['dietas' => $dietas]);
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
            header('Location: ./listAtriDieta');
        } else {
            $this->view('dietaAluno/registerAtriDieta', ['estudantes' => $estudantes, 'dietas' => $dietas]);
        }
    }

    public function editar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('DietaEstudante');
        $modelEstudante = $this->model('Estudante');
        $modelDieta = $this->model('DietaEspecial');

        $dietas = $modelDieta->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // __meuDebug()->var_dump($_POST);
            $model->salvar($_POST);
            header('Location: ./listAtriDieta');
        } else if (isset($_GET['id_estudante'])) {
            $estudante = $modelEstudante->estudante_por_id($_GET['id_estudante']);
            $dietaestudante = $model->dietas_do_estudante($_GET['id_estudante']);

            // __meuDebug()->var_dump($dietaestudante);

            $this->view('dietaAluno/editAtriDieta', [
                'estudante' => $estudante,
                'dietas' => $dietas,
                'dietaestudante' => $dietaestudante
            ]);
        }
    }

    public function deletar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id_estudante']) && isset($_GET['id_dieta'])) {
            $model = $this->model('DietaEstudante');
            $model->deletar($_GET['id_estudante'], $_GET['id_dieta']);
        }
        header('Location: ./listAtriDieta');
        exit;
    }
}
