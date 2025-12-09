<?php
class DietaEstudanteController extends Controller
{
    public function listar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('DietaEstudante');
        $dietas = $model->listar();
        $agrupado = [];
        foreach ($dietas as $item) {
            $id = $item['id_estudante'];

            if (!isset($agrupado[$id])) {
                $agrupado[$id] = [
                    "nome" => $item["nome_estudante"],
                    "id" => $id,
                    "nro_turma" => $item["nro_turma"],
                    "tipo_ensino" => $item["tipo_ensino"], 
                    "ano_turma" => $item['ano_turma'],
                    "turno" => $item['turno'],
                    "data_dieta" => $item["data_adicao_dieta"],
                    "dietas" => []
                ];
            }

            // adiciona o array de dietas no array de agrupados
            $agrupado[$id]["dietas"][] = $item["nome_dieta"];
        }

        // organiza o array por ordem alfabética dos nomes dos estudantes, sem mudar o agrupamento
        usort($agrupado, function ($a, $b) {
            return strcasecmp($a['nome'], $b['nome']);
        });

        $data = ['agrupado' => $agrupado];
        if (isset($_SESSION['msg'])) {
            $data['msg'] = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        $this->view('dietaAluno/listAtriDieta', $data);
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
            $_SESSION['msg'] = "Dieta atribuída ao estudante com sucesso!";
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
            // verificar as mudanças do array e passaras funções de cada situação
            // ainda está no array: nada acontece
            // estava no array e não está mais: excluir (deletar)
            // não estava antes e está agora: adicionar (salvar)

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

            $_SESSION['msg'] = "Atribuições de dieta atualizadas com sucesso!";
            header('Location: ./listAtriDieta');
        } else if (isset($_GET['id_estudante'])) {
            $estudante = $modelEstudante->estudante_por_id($_GET['id_estudante']);
            $dietaestudante = $model->dietas_do_estudante($_GET['id_estudante']);


            $this->view('dietaAluno/editAtriDieta', [
                'estudante' => $estudante,
                'dietas' => $dietas,
                'dietaestudante' => $dietaestudante
            ]);
        }
    }

    public function desativar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id_estudante']) && isset($_GET['id_dieta'])) {
            $model = $this->model('DietaEstudante');
            $model->desativar($_GET['id_estudante'], $_GET['id_dieta']);
        }
        $_SESSION['msg'] = 'Atribuições de dieta deletadas com sucesso!';
        header('Location: ./listAtriDieta');
        exit;
    }

    public function ativar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id_estudante']) && isset($_GET['id_dieta'])) {
            $model = $this->model('DietaEstudante');
            $model->ativar($_GET['id_estudante'], $_GET['id_dieta']);
        }
        $_SESSION['msg'] = 'Atribuições de dieta deletadas com sucesso!';
        header('Location: ./listAtriDieta');
        exit;
    }
}
