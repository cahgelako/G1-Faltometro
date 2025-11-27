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


    // inutilizado
    // public function registrar()
    // {
    //     require_once 'app/core/auth.php';
    //     $model = $this->model('MatriculaProjeto');
    //     $modelMatriculas = $this->model('Matricula');
    //     // $modelProjetos = $this->model('Projeto');

    //     $matriculas = $modelMatriculas->listar();

    //     // var_dump($matriculas);
    //     // exit;

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $model->salvar($_POST);
    //         header('Location: ./listAtriExtras');
    //     } else {
    //         $this->view('projetoAluno/registerAtriExtras', ['matriculas' => $matriculas]);
    //     }
    // }

    public function editar()
    {
        require_once 'app/core/auth.php';
        
        $model = $this->model('MatriculaProjeto');
        $modelMatriculas = $this->model('Matricula');
        $modelProjetos = $this->model('Projeto');

        $matriculas = $modelMatriculas->listar();
        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // verificar as mudanças do array e passar as funções de cada situação
            // ainda está no array: nada acontece
            // estava no array e não está mais: excluir (deletar)
            // não estava antes e está agora: adicionar (salvar)

            $matprojetos = $model->matriculas_por_id_projeto($_POST['id_projeto']);
            $mat_form = $_POST['arr_mat_id'] ?? [];

            // verificando quais projetos foram atribuídas (não existem em projeto estudante e existe no formulário)
            $matriculados = array_diff($mat_form, $matprojetos); // 1º - array principal | 2º - array de comparação
            foreach ($matriculados as $id) {
                $model->salvar($_POST['id_projeto'], $id);
            }
            
            // verificando quais projetos foram excluídas (não existem no formulário e existe no projeto estudante)
            $excluidos = array_diff($matprojetos, $mat_form); // 1º - array principal | 2º - array de comparação
            foreach ($excluidos as $id) {
                $model->deletar($_POST['id_projeto'], $id);
            }
            
            $_SESSION['msg'] = 'Participantes editados com sucesso!';
            header('Location: ./listProjeto');
            exit;

        } else if (isset($_GET['id_projeto'])) {
            $estudantes = $model->matriculas_por_id_projeto($_GET['id_projeto']);
            $projeto = $modelProjetos->projeto_por_id($_GET['id_projeto']);
            $this->view('projeto/editAlunoProjeto', ['matriculas' => $matriculas, 'estudantes' => $estudantes, 'projeto' => $projeto]);
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
