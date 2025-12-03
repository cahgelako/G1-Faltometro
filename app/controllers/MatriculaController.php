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
        $modelTurma = $this->model('Turma');
        $modelEstudante = $this->model('Estudante');

        $estudantes = $modelEstudante->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($model->salvar($_POST)) {
                $matestudantes = $model->dietas_do_estudante($_POST['id_estudante']);
                $mats_form = $_POST['arr_mat_id'] ?? [];

                $atribuidas = array_diff($mats_form, $matestudantes); // 1º - array principal | 2º - array de comparação
                foreach ($atribuidas as $id) {
                    $model->salvar([$_POST['id_clsse'], $id, $_POST['data_matricula'], $_POST['ativo']]);
                }

                $excluidas = array_diff($matestudantes, $mats_form); // 1º - array principal | 2º - array de comparação
                foreach ($excluidas as $id) {
                    $model->desativar($id);
                }
                $_SESSION['msg'] = 'Matrículas cadastradas com sucesso!';
                header('Location: ./listMatricula');
                exit;
            } else {
                $_SESSION['msg'] = 'Erro: Já existe uma matrícula para essa combinação de turma e estudante.';
                header('Location: ./listMatricula');
                exit;
            }
        } else if (isset($_GET['id'])) {
            $turma = $modelturma->turma_por_id($_GET['id']);
            $matriculas = $model->matricula_por_id_turma($_GET['id']);
            $this->view('turma/editAlunoturma', ['turma' => $turma, 'estudantes' => $estudantes, 'matriculas' => $matriculas]);
        }
    }

    public function editar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Matricula');
        $modelTurma = $this->model('Turma');
        $modelEstudante = $this->model('Estudante');

        $estudantes = $modelEstudante->listar();
        $erros_duplicidade = [];
        $resultado = true;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $matestudantes = $model->matricula_por_id_turma($_POST['id_turma']);
            $mats_form = $_POST['arr_mat_id'] ?? [];

            $atribuidas = array_diff($mats_form, $matestudantes); // 1º - array principal | 2º - array de comparação
            foreach ($atribuidas as $cod_estudante) {
                $resultado = $model->salvar(['id_turma' => $_POST['id_turma'], 'id_estudante' => $cod_estudante]);
                
                // Se a Model retornar FALSE, significa duplicidade (pois desativamos o INSERT no if)
                if ($resultado === false) {
                    $erros_duplicidade[] = htmlspecialchars($cod_estudante);
                }
            }

            if (!empty($erros_duplicidade)) {
                $lista_erros = implode(', ', $erros_duplicidade); //junta os elementos de um array em uma única string.
                $_SESSION['msg'] = 'Erro: Os estudantes com IDs (' . $lista_erros . ') já estão matriculados em outra turma ATIVA no ano letivo. A edição foi cancelada.';
                header('Location: ./listTurma');
                exit;
            }

            $id_turma = $_POST['id_turma'];
            $excluidas = array_diff($matestudantes, $mats_form); // 1º - array principal | 2º - array de comparação
            foreach ($excluidas as $idEstudante) {
                $model->desativar($id_turma, $idEstudante);
            }
            $_SESSION['msg'] = 'Matrículas editadas com sucesso!';
            header('Location: ./listTurma');
        } else if (isset($_GET['id'])) {
            $matriculas = $model->matricula_por_id_turma($_GET['id']);
            $turma = $modelTurma->turma_por_id($_GET['id']);
            $this->view('turma/editAlunoTurma', ['turma' => $turma, 'estudantes' => $estudantes, 'matriculas' => $matriculas]);
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
