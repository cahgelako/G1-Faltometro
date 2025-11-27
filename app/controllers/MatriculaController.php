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

        $estudantes = $modelEstudante->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($model->salvar($_POST)) {
                $matestudantes = $model->dietas_do_estudante($_POST['id_estudante']);
                $mats_form = $_POST['arr_mat_id'] ?? [];

                // verificando quais dietas foram atribuídas (não existem em dietas estudante e existe no formulário)
                $atribuidas = array_diff($mats_form, $matestudantes); // 1º - array principal | 2º - array de comparação
                foreach ($atribuidas as $id) {
                    $model->salvar([$_POST['id_clsse'], $id, $_POST['data_matricula'], $_POST['ativo']]);
                }

                // verificando quais dietas foram excluídas (não existem no formulário e existe no dieta estudante)
                $excluidas = array_diff($matestudantes, $mats_form); // 1º - array principal | 2º - array de comparação
                foreach ($excluidas as $id) {
                    $model->desativar($id);
                }
                $_SESSION['msg'] = 'Matrículas cadastradas com sucesso!';
                header('Location: ./listMatricula');
                exit;
            } else {
                $_SESSION['msg'] = 'Erro: Já existe uma matrícula para essa combinação de classe e estudante.';
                header('Location: ./listMatricula');
                exit;
            }
        } else if (isset($_GET['id'])) {
            $classe = $modelClasse->classe_por_id($_GET['id']);
            $matriculas = $model->matricula_por_id_classe($_GET['id']);
            $this->view('classe/editAlunoClasse', ['classe' => $classe, 'estudantes' => $estudantes, 'matriculas' => $matriculas]);
        }
    }

    public function editar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Matricula');
        $modelClasse = $this->model('Classe');
        $modelEstudante = $this->model('Estudante');

        // $classes = $modelClasse->listar();
        $estudantes = $modelEstudante->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $matestudantes = $model->matricula_por_id_classe($_POST['id_classe']);
            $mats_form = $_POST['arr_mat_id'] ?? [];

            // verificando quais dietas foram atribuídas (não existem em dietas estudante e existe no formulário)
            $atribuidas = array_diff($mats_form, $matestudantes); // 1º - array principal | 2º - array de comparação
            foreach ($atribuidas as $cod_estudante) {
                //var_dump($cod_estudante); exit;
                // echo $_POST['id_classe'];
                $model->salvar(['id_classe' => $_POST['id_classe'], 'id_estudante' => $cod_estudante]);
            }

            // Se a Model retornar FALSE, significa duplicidade (pois desativamos o INSERT no if)
            if ($resultado === false) {
                $erros_duplicidade[] = htmlspecialchars($cod_estudante);
            }


            if (!empty($erros_duplicidade)) {
                $lista_erros = implode(', ', $erros_duplicidade); //junta os elementos de um array em uma única string.
                $_SESSION['msg'] = 'Erro: Os estudantes com IDs (' . $lista_erros . ') já estão matriculados em outra turma ATIVA no ano letivo. A edição foi cancelada.';
                header('Location: ./listMatricula');
                exit;
            }

            $id_classe = $_POST['id_classe'];
            // verificando quais dietas foram excluídas (não existem no formulário e existe no dieta estudante)
            $excluidas = array_diff($matestudantes, $mats_form); // 1º - array principal | 2º - array de comparação
            foreach ($excluidas as $idEstudante) {
                $model->desativar($id_classe, $idEstudante);
            }
            $_SESSION['msg'] = 'Matrículas editadas com sucesso!';
            header('Location: ./listMatricula');
        } else if (isset($_GET['id'])) {
            $matriculas = $model->matricula_por_id_classe($_GET['id']);
            $classe = $modelClasse->classe_por_id($_GET['id']);
            //echo "<pre>"; var_dump($classe); echo "</pre>"; exit;
            $this->view('classe/editAlunoClasse', ['classe' => $classe, 'estudantes' => $estudantes, 'matriculas' => $matriculas]);
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
