<?php
 class FrequenciaController extends Controller {

    public function listar_turmas() {
        require_once 'app/core/auth.php';
        $modelTurma = $this->model('Turma');
        $turmas = $modelTurma->listar();
        $data = ['turmas' => $turmas];
        if (isset($_SESSION['msg'])) {
            $data['msg'] = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        $this->view('frequencia/listFrenqTu', $data);
    }

    public function registrar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Frequencia');
        $modelTurma = $this->model('Turma');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // pegar os dados do POST[], percorrer o array e inserir um por um
            // verificar quais foram checados. Se foi, status_presenca = 0, senão status_presenca = 1 
            $professor = $_SESSION['func_id_funcionario'];

            // cadastrando todos como presentes
            $todos = $model->estudantes_por_turma($_POST['id_turma']);
            $faltosos = $_POST['id_matricula'] ?? []; // evita erro se nenhum checkbox for marcado

            foreach ($todos as $t) {
                // verifica se esse $t['id'] está no array de id dos alunos que faltaram
                // se estiver, status = 0 (ausente), senão, status = 1 (presnte)  
                $status = in_array($t['id_matricula'], $faltosos) ? 'ausente' : 'presente';

                $model->salvar([
                    'data_falta' => $_POST['data_falta'],
                    'id_matricula' => $t['id_matricula'],
                    'status_presenca' => $status,
                    'id_funcionario' => $professor
                ]);
            }

            $_SESSION['msg'] = "Frequência registrada com sucesso!";
            header('Location: ./listFrenqTu');
        } else if (isset($_GET['id_turma'])) {
            $estudantes = $model->estudantes_por_turma($_GET['id_turma']);
            $this->view('frequencia/registerFrenqAluno', ['estudantes' => $estudantes]);
        }
    }

    public function filtro() {
        require_once 'app/core/auth.php';
        $model = $this->model('Frequencia');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $relatorio = $model->filtro_intervalo($_POST);
            if ($relatorio) {
                $this->view('relatorio/listRelFrenCo', ['relatorio' => $relatorio]);
            } else {
                $frequencia = $model->listar_por_turma_dia($_GET['id_turma']);
                $this->view('relatorio/listRelFrenCo', ['frequencia' => $frequencia]);
            }
        } else if (isset($_GET['id_turma'])) {
            $frequencia = $model->listar_por_turma_dia($_GET['id_turma']);
            $this->view('relatorio/listRelFrenCo', ['frequencia' => $frequencia]);
        }
    }

    public function relatorio_nutri() {
        require_once 'app/core/auth.php';
        $model = $this->model('Frequencia');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST['data_falta'];
            $relatorio = $model->list_relatorio_nutri_dia($data);
            $relatorio_dietas = $model->list_relatorio_nutri_dietas($data);
            $this->view('frequencia/relFrenqNutri', ['relatorio' => $relatorio, 'data_falta' => $data, 'relatorio_dietas' => $relatorio_dietas]);
        } else {
            $relatorio = $model->list_relatorio_nutri_dia();
            $relatorio_dietas = $model->list_relatorio_nutri_dietas();
            $this->view('frequencia/relFrenqNutri', ['relatorio' => $relatorio, 'relatorio_dietas' => $relatorio_dietas]);
        }
    }
    public function relatorio_coordenacao() {
        require_once 'app/core/auth.php';
        $model = $this->model('Frequencia');
        $modelTu = $this->model('Turma');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST['data_falta'];
            $id_turma = $_POST['id_turma'];
            $relatorio = $model->list_relatorio_coor_dia($data, $id_turma);
            $relatorio_es = $model->list_relatorio_coor_estudantes_dia($data, $id_turma);
            $turmas = $modelTu->listar();
            $this->view('frequencia/relFrenqCo', ['relatorio' => $relatorio, 'relatorio_es' => $relatorio_es, 'data_falta' => $data, 'turmas' => $turmas]);
        } else {
            $relatorio = $model->list_relatorio_coor_dia();
            $relatorio_es = $model->list_relatorio_coor_estudantes_dia();
            $turmas = $modelTu->listar();
            $this->view('frequencia/relFrenqCo', ['relatorio' => $relatorio, 'relatorio_es' => $relatorio_es, 'turmas' => $turmas]);
        }
    }
 }