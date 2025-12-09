<?php
class FrequenciaController extends Controller
{

    public function listar_turmas()
    {
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

    public function registrar()
    {
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


    // reajustar para não ignorar o filtro de turno
    public function relatorio_nutri()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Frequencia');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST['data_falta'];
            $turno = $_POST['turno'] ?? '';
            $relatorio = $model->list_relatorio_nutri_dia($data, $turno);
            $relatorio_dietas = $model->list_relatorio_nutri_dietas($data, $turno);
            $agrupado = [];

            // ordena por id do estudante
            foreach ($relatorio_dietas as $item) {
                $id = $item['id_estudante'];

                if (!isset($agrupado[$id])) {
                    $agrupado[$id] = [
                        "nome" => $item["nome_estudante"],
                        "turma" => $item["nro_turma"] . "º do " . $item["tipo_ensino"],
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

            $this->view('frequencia/relFrenqNutri', ['relatorio' => $relatorio, 'data_falta' => $data, 'relatorio_dietas' => $relatorio_dietas, 'agrupado' => $agrupado]);

        } else {
            $relatorio = $model->list_relatorio_nutri_dia();
            $relatorio_dietas = $model->list_relatorio_nutri_dietas();
            $agrupado = [];

            // ordena por id do estudante
            foreach ($relatorio_dietas as $item) {
                $id = $item['id_estudante'];

                if (!isset($agrupado[$id])) {
                    $agrupado[$id] = [
                        "nome" => $item["nome_estudante"],
                        "turma" => $item["nro_turma"] . "º do " . $item["tipo_ensino"],
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

            $this->view('frequencia/relFrenqNutri', ['relatorio' => $relatorio, 'relatorio_dietas' => $relatorio_dietas, 'agrupado' => $agrupado]);
        }
    }
    public function relatorio_coordenacao()
    {
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

    public function gerar_pdf_dia_coordenacao()
    {
        require_once 'app/core/auth.php';

        $modelFrequencia = $this->model('Frequencia');
        $modelTurma = $this->model('Turma');

        $dataFiltro = $_GET['data_falta'] ?? null;
        $id_turma = $_GET['id_turma'] ?? null;

        if (empty($dataFiltro)) {
            die('Parâmetro de data é obrigatório.');
        }

        $dataHoje = date('Y-m-d');

        $turmas = $modelTurma->listar();
        $relatorio = $modelFrequencia->list_relatorio_coor_dia($dataFiltro, $id_turma);
        $relatorio_es = $modelFrequencia->list_relatorio_coor_estudantes_dia($dataFiltro, $id_turma);

        // CAPTURA DA VIEW
        ob_start();
        require 'app/views/relatorio/pdfRelFrenqCo.php';
        $html = ob_get_clean();

        // DOMPDF CONFIGURADO PARA NÃO QUEBRAR PÁGINA
        require_once __DIR__ . '/../dompdf/autoload.inc.php';
        $dompdf = new \Dompdf\Dompdf();

        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->set_option('enable_css_float', true);
        $dompdf->set_option('defaultPaperSize', 'A4');

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $nomeArq = "Relatorio_" . $dataHoje;

        $dompdf->stream($nomeArq . ".pdf", ["Attachment" => false]);
        exit();
    }
}
