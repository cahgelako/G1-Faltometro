<?php
class FuncionarioController extends Controller {

    public function login() {
        session_start(); //inicia a sessão
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // pergunta se o método de requisição é igual a post
            $model = $this->model('Funcionarios'); // chama a classe Funcionario
            if ($model->login($_POST)) { // manda os dados para o método login da classe Funcionario, que vai retonar se os dados do login bateram com os dados do banco
                // se for compatível
                $dados = $model->funcionario_por_email($_POST['email_funcionario']);
                if ($dados) {
                    $_SESSION['logged'] = true; // define como verdadeiro o login
                    foreach ($dados as $chave => $valor) {
                        $_SESSION[`func_$chave`] = $valor;
                    }
                    header('Location: ./inicio'); // vai para a tela de início
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

    public function logout() {
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
    
    public function listar() {
        require_once 'app/core/auth.php'; // verifica se a sessão existe
        $model = $this->model('Funcionario');
        $funcionarios = $model->listar();
        $this->view('funcionario/listFunc', ['funcionarios' => $funcionarios]);
    }

    public function registrar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Funcionario');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->salvar($_POST);
            header('Location: ./listFunc');
        } else {
            $this->view('funcionario/registrar');
        }
    }
    
    public function deletar() {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Funcionario');
            $model->delete($_GET['id']);
        }
        header('Location: ./listFunc');
        exit;
    }
    
    public function editar() {
        require_once 'app/core/auth.php';
        $model = $this->model('Funcionario');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->editar($_POST);
            header('Location: ./listFunc');
        } else if (isset($_GET['id'])) {
            $funcionario = $model->funcionario_por_id($_GET['id']);
            $this->view('funcionario/editFunc', ['funcionario' => $funcionario]);
        }
        
    }
}