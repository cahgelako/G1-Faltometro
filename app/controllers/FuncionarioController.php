<?php
class FuncionarioController extends Controller
{

    public function login()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $modal = $this->model('Funcionario'); 
            
            if ($modal->login($_POST)) { 
           /*      echo "<pre>";
                echo var_dump($_POST);
                echo "</pre>"; */

                $dados = $modal->funcionario_por_email($_POST['email']);

                if ($dados) {
                    $_SESSION['logged'] = true;
                    foreach ($dados as $chave => $valor) {
                        $_SESSION["func_$chave"] = $valor;
                    }
                    header('Location: ./inicio');
                    exit;
                } else {
                    $this->view('funcionario/login', ['error' => 'Usuário não encontrado']);
                }
            } else {
                $this->view('funcionario/login', ['error' => 'Login inválido']);
            }
        } else {
            $this->view('funcionario/login');
        }
    }

    public function logout()
    {
        session_start();

        // remove todas as variáveis da sessão
        $_SESSION = [];

        // Remover os cookies da sessão
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 4200, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        // Destroi a sessão
        session_destroy();

        header('Location: ./login');
        exit;
    }

    public function listar()
    {
        require_once 'app/core/auth.php'; // verifica se a sessão existe
        $model = $this->model('Funcionario');
        $funcionarios = $model->listar();
        $this->view('funcionario/listFunc', ['funcionarios' => $funcionarios]);
    }

    public function registrar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Funcionario');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST);
            header('Location: ./listFunc');
        } else {
            $this->view('funcionario/registrarFunc');
        }
    }

    public function deletar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Funcionario');
            $model->deletar($_GET['id']);
        }
        header('Location: ./listFunc');
        exit;
    }

    public function editar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Funcionario');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;
            $model->editar($dados);
            header('Location: ./listFunc');
            exit;
        } else {
            $funcionario = $model->funcionario_por_id($_GET['id']);
            $this->view('funcionario/editFunc', ['funcionario' => $funcionario]);
        }
    }

    public function perfil() {
        require_once 'app/core/auth.php';
        $model = $this->model('Funcionario');
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;
            $model->editar($dados);
            header('Location: ./listFunc');
            exit;
        } else {
            $funcionario = $model->funcionario_por_id($_SESSION['func_id_funcionario']);
            $this->view('funcionario/conta', ['funcionario' => $funcionario]);
        }
    }
}
