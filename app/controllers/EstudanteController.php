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
            if ($model->editar($_POST)) {
                // $dietaestudante = $model->dietas_do_estudante($_POST['id_estudante']);
                // $dietas_form = $_POST['arr_dieta_id'] ?? [];

                // // verificando quais dietas foram atribuídas (não existem em dietas estudante e existe no formulário)
                // $atribuidas = array_diff($dietas_form, $dietaestudante); // 1º - array principal | 2º - array de comparação
                // foreach ($atribuidas as $id) {
                //     $model->salvar($_POST['id_estudante'], $id);
                // }

                // // verificando quais dietas foram excluídas (não existem no formulário e existe no dieta estudante)
                // $excluidas = array_diff($dietaestudante, $dietas_form); // 1º - array principal | 2º - array de comparação
                // foreach ($excluidas as $id) {
                //     $model->deletar($_POST['id_estudante'], $id);
                // }

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

    public function desativar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Estudante');
        $modelMatricula = $this->model('Matricula');
        $modelMatProj = $this->model('MatriculaProjeto');
        $modelDieta = $this->model('DietaEstudante');
        if (isset($_GET['id'])) {
            $id_estudante = $_GET['id'];

            // buscando o id_matricula através do id_estudante
            $id_mat = $model->matricula_por_id_estudante($id_estudante);

            // buscando quais os projetos em que o id_matricula faz parte e desativando as matrículas nos projetos
            $proj_estudante = $modelMatProj->matricula_proj_estudante_por_id($id_mat);
            foreach ($proj_estudante as $p) {
                $modelMatProj->desativar($p, $id_estudante);
            }

            // desativando a matrícula atual
            $modelMatricula->desativar($id_mat);

            // desativa as dietas vinculadas ao estudante
            $dietas_estudante = $modelDieta->dietas_do_estudante($id_estudante);
            if ($dietas_estudante !== []) {
                foreach ($dietas_estudante as $id) {
                    $modelDieta->desativar($id_estudante, $id);
                }
            }

            // desativa o estudante
            $model->desativar($id_estudante);
        }
        $_SESSION['msg'] = "Estudante desativado com sucesso!";
        header('Location: ./listEstudante');
        exit;
    }
    public function ativar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Estudante');
        if (isset($_GET['id'])) {
            $model->ativar($_GET['id']);
        }
        $_SESSION['msg'] = "Estudante ativado com sucesso!";
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
            $estudante = $model->estudante_por_id(isset($_GET['id']));
            $participando = $modelMatProjeto->projetos_por_estudante(isset($_GET['id']));
            $dietas = $modelDietasEs->dietas_do_estudante(isset($_GET['id']));
            $faltas_por_mes = $model->faltas_mes($_GET['id']);
            $faltas_ano = $model->faltas_ano($_GET['id']);

            $faltas_mes = [];
            foreach ($faltas_por_mes as $linha) {
                $faltas_mes[$linha['mes']] = $linha['total_faltas'];
            }

             //var_dump($faltas_ano); exit;

            $this->view('estudante/perfilEstudante', ['estudante' => $estudante, 'participando' => $participando, 'dietas' => $dietas, 'faltas_mes' => $faltas_mes, 'faltas_ano' => $faltas_ano]);
        } else {
            $this->view('estudante/listEstudante');
        }
    }
}
