<?php
 class FrequenciaController extends Controller {

    public function listar_turmas() {
        require_once 'app/core/auth.php';
        $modelClasse = $this->model('Classe');
        $turmas = $modelClasse->listar();
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
        $modelTu = $this->model('Classe');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // pegar os dados do POST[], percorrer o array e inserir um por um
            // verificar quais foram checados. Se foi, status_presenca = 0, senão status_presenca = 1 
            $professor = $_SESSION['func_id_funcionario'];

            // cadastrando todos como presentes
            $todos = $model->estudantes_por_classe($_POST['id_classe']);
            $faltosos = $_POST['id_matricula'] ?? []; // evita erro se nenhum checkbox for marcado

            foreach ($todos as $t) {
                // verifica se esse $t['id'] está no array de id dos alunos que faltaram
                // se estiver, status = 0 (ausente), senão, status = 1 (presnte)  
                $status = in_array($t['id_matricula'], $faltosos) ? 0 : 1;

                $model->salvar([
                    'data_falta' => $_POST['data_falta'],
                    'id_matricula' => $t['id_matricula'],
                    'status_presenca' => $status,
                    'id_funcionario' => $professor
                ]);
            }

            $_SESSION['msg'] = "Frequência registrada com sucesso!";
            header('Location: ./listFrenqTu');
        } else if (isset($_GET['id_classe'])) {
            $estudantes = $model->estudantes_por_classe($_GET['id_classe']);
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
                $frequencia = $model->listar_por_classe_dia($_GET['id_classe']);
                $this->view('relatorio/listRelFrenCo', ['frequencia' => $frequencia]);
            }
        } else if (isset($_GET['id_classe'])) {
            $frequencia = $model->listar_por_classe_dia($_GET['id_classe']);
            $this->view('relatorio/listRelFrenCo', ['frequencia' => $frequencia]);
        }
    }
 }