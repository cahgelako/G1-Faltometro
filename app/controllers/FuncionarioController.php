<?php

require_once 'app/libs/PHPMailer/src/PHPMailer.php';
require_once 'app/libs/PHPMailer/src/SMTP.php';
require_once 'app/libs/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class FuncionarioController extends Controller
{

    public function login()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modal = $this->model('Funcionario');

            if ($modal->login($_POST)) {

                $dados = $modal->funcionario_por_email($_POST['email']);

                if ($dados) {
                    $_SESSION['logged'] = true;
                    foreach ($dados as $chave => $valor) {
                        $_SESSION["func_$chave"] = $valor;
                    }
                    header('Location: ./inicio');
                    exit;
                } else {
                    $this->view('funcionario/login', ['error' => 'Usuário não encontrado'], false);
                }
            } else {
                $this->view('funcionario/login', ['error' => 'Login inválido'], false);
            }
        } else {
            $this->view('funcionario/login', [], false);
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
        $data = ['funcionarios' => $funcionarios];
        if (isset($_SESSION['msg'])) {
            $data['msg'] = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        $this->view('funcionario/listFunc', $data);
    }

    public function registrar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Funcionario');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($model->salvar($_POST)) {
                $_SESSION['msg'] = 'Funcionário cadastrado com sucesso!';
                header('Location: ./listFunc');
                exit;
            } else {
                $_SESSION['msg'] = 'Erro: Já existe um funcionário com esse email.';
                header('Location: ./listFunc');
                exit;
            }
        } else {
            $this->view('funcionario/registrarFunc');
        }
    }

    public function desativar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Funcionario');
            $model->desativar($_GET['id']);
        }
        $_SESSION['msg'] = 'Funcionário desativado com sucesso!';
        header('Location: ./listFunc');
        exit;
    }

    public function ativar()
    {
        require_once 'app/core/auth.php';
        if (isset($_GET['id'])) {
            $model = $this->model('Funcionario');
            $model->ativar($_GET['id']);
        }
        $_SESSION['msg'] = 'Funcionário ativado com sucesso!';
        header('Location: ./listFunc');
        exit;
    }

    public function editar()
    {
        require_once 'app/core/auth.php';
        $model = $this->model('Funcionario');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;
            if ($model->editar($dados)) {
                $_SESSION['msg'] = 'Funcionário editado com sucesso!';
                header('Location: ./listFunc');
                exit;
            } else {
                $_SESSION['msg'] = 'Erro: Já existe um funcionário com esse email.';
                header('Location: ./listFunc');
                exit;
            }
        } else {
            $funcionario = $model->funcionario_por_id($_GET['id']);
            $this->view('funcionario/editFunc', ['funcionario' => $funcionario]);
        }
    }

    public function perfil()
    {
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

    public function solicitar_recuperacao()
    {
        $model = $this->model('Funcionario');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];

            // 1. Verifica se email existe
            $funcionario = $model->funcionario_por_email($email);
            if (!$funcionario) {
                echo "E-mail não encontrado";
                return;
            }

            // 2. Gera token
            $token = bin2hex(random_bytes(32));

            // 3. Salva token
            $model->salvar_token_recuperacao($email, $token);

            // 4. Envia o email
            // O ip deste link se refere a máquina onde o site está hospedado na rede local. Ajustar conforme necessário.
            $link = "http://10.132.224.51/faltometro/redefinirSenha?token=" . $token;

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'bijudabia6@gmail.com';
                $mail->Password = 'osax vzzg bhsk jnyf';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('bijudabia6@gmail.com', 'Sistema');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = "Recuperação de senha";
                $mail->Body = "
                <p>Para recuperar sua senha clique no link abaixo:</p>
                <a href='$link'>$link</a>
            ";

                $mail->send();
            } catch (Exception $e) {
                echo "Erro ao enviar e-mail: " . $e->getMessage();
            }

            $this->view('funcionario/recuperarSenha', ['msg' => 'Um e-mail foi enviado com instruções para recuperar sua senha.'], false);
        } else {
            // $ola = 'funcionario/recuperarSenha';
            // var_dump($ola); exit;
            $this->view('funcionario/recuperarSenha', [], false);
        }
    }

    public function redefinir_senha()
    {
        $model = $this->model('Funcionario');

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Recebe o token via GET
            $token = $_GET['token'] ?? null;

            if (!$token) {
                echo "Token ausente!";
                return;
            }

            // Valida o token
            $reset = $model->validar_token_recuperacao($token);
            if (!$reset) {
                echo "Token inválido ou expirado!";
                return;
            }

            // Mostra a página de redefinir senha, envia token para o input hidden
            $this->view('funcionario/redefinirSenha', ['token' => $token], false);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recebe o token e a nova senha via POST
            $token = $_POST['token'] ?? null;
            $senha = $_POST['senha'] ?? null;

            if (!$token || !$senha) {
                echo "Token ou senha ausente!";
                return;
            }

            // Valida o token novamente
            $reset = $model->validar_token_recuperacao($token);
            if (!$reset) {
                echo "Token inválido ou expirado!";
                return;
            }

            $email = $reset['email'];
            $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

            // Atualiza a senha
            $model->atualizar_senha($email, $senha_hash);

            // Remove tokens antigos
            $model->remover_tokens($email);

            // Redireciona para login com mensagem
            $this->view('funcionario/redefinirSenha', [
                'sucesso' => "Senha alterada com sucesso! Faça login."
            ], false);
        }
    }

    public function validarToken()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $this->view('funcionario/validarToken');
        }

        // POST → valida token
        $token = $_POST['token'];
        $model = $this->model('Funcionario');

        $validacao = $model->validar_token_recuperacao($token);

        if (!$validacao) {
            $_SESSION['erro'] = "Código inválido ou expirado.";
            return $this->view('funcionario/validarToken');
        }

        $_SESSION['email_recuperacao'] = $validacao['email'];
        header("Location: /redefinirSenha");
        exit;
    }

    // Para testar o PHPMailer falta criar um gmail fictício, permitir a senha do app e mudar as validações do código
}
