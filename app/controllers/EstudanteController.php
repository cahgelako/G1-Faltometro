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
                $_SESSION['msg'] = "Erro: Já existe um estudante com esse registro de matricula.";
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
            if ($model->editar($_POST)) {
                $dietaestudante = $model->dietas_do_estudante($_POST['id_estudante']);
                $dietas_form = $_POST['arr_dieta_id'] ?? [];

                // verificando quais dietas foram atribuídas (não existem em dietas estudante e existe no formulário)
                $atribuidas = array_diff($dietas_form, $dietaestudante); // 1º - array principal | 2º - array de comparação
                foreach ($atribuidas as $id) {
                    $model->salvar($_POST['id_estudante'], $id);
                }

                // verificando quais dietas foram excluídas (não existem no formulário e existe no dieta estudante)
                $excluidas = array_diff($dietaestudante, $dietas_form); // 1º - array principal | 2º - array de comparação
                foreach ($excluidas as $id) {
                    $model->deletar($_POST['id_estudante'], $id);
                }

                $_SESSION['msg'] = "Estudante editado com sucesso!";
                header('Location: ./listEstudante');
                exit;
            } else {
                $_SESSION['msg'] = "Erro: Já existe um estudante com esse registro de matricula.";
                header('Location: ./listEstudante');
                exit;
            }
        } else if (isset($_GET['id'])) {
            $estudantes = $model->estudante_por_id($_GET['id']);
            $dietasestudante = $modelDietaEs->dietas_do_estudante($_GET['id']);
            $this->view('estudante/editEstudante', ['estudantes' => $estudantes, 'dietas' => $dietas, 'dietasestudante' => $dietasestudante]);
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
