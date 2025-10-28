<?php
class MatriculaProjetoController extends Controller
{
    public function listar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('MatriculaProjeto');
        // $modelEstudante = $this->model('Estudante');

        $matriculas = $model->listar();
        $ids_estudantes = [];

        foreach ($matriculas as $e) {
            $ids_estudantes[] = $e['id_estudante'];
        }

        $this->view('projetoAluno/listAtriExtras', ['matriculas' => $matriculas, 'ids_estudantes' => $ids_estudantes]);
    }

    public function registrar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('MatriculaProjeto');
        $modelMatriculas = $this->model('Matricula');
        // $modelProjetos = $this->model('Projeto');

        $matriculas = $modelMatriculas->listar();

        // var_dump($matriculas);
        // exit;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST);
            header('Location: ./listAtriExtras');
        } else {
            $this->view('projetoAluno/registerAtriExtras', ['matriculas' => $matriculas]);
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
            // verificar as mudanças do array e passaras funções de cada situação
            // ainda está no array: nada acontece
            // estava no array e não está mais: excluir (deletar)
            // não estava antes e está agora: adicionar (salvar)

            $matprojetos = $model->matricula_proj_estudante_por_id($_POST['id_matricula']);
            $proj_form = $_POST['arr_projetos_id'] ?? [];

            // verificando quais projetos foram atribuídas (não existem em projeto estudante e existe no formulário)
            $atribuidas = array_diff($proj_form, $matprojetos); // 1º - array principal | 2º - array de comparação
            foreach ($atribuidas as $id) {
                $model->salvar($id, $_POST['id_matricula']);
            }

            // verificando quais projetos foram excluídas (não existem no formulário e existe no projeto estudante)
            $excluidas = array_diff($matprojetos, $proj_form); // 1º - array principal | 2º - array de comparação
            foreach ($excluidas as $id) {
                $model->deletar($id, $_POST['id_matricula']);
            }
            header('Location: ./listAtriExtras');
        } else if (isset($_GET['id_matricula'])) {
            $matprojetos = $model->matricula_proj_estudante_por_id($_GET['id_matricula']);
            $this->view('projetoAluno/editAtriExtras', ['matriculas' => $matriculas, 'projetos' => $projetos, 'matprojetos' => $matprojetos]);
        }
    }

    public function deletar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id_projeto']) && isset($_GET['id_matricula'])) {
            $model = $this->model('MatriculaProjeto');
            $model->deletar($_GET['id_projeto'], $_GET['id_matricula']);
        }
        header('Location: ./listAtriExtras');
        exit;
    }
}
