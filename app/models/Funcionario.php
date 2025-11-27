<?php
class Funcionario
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    public function login($dados)
    {

        $sql = "SELECT * FROM funcionarios WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $dados['email']);
        $stmt->execute();
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($funcionario && password_verify($dados['senha'], $funcionario['senha'])) {
            return true;
        }
        return false;
    }

    public function salvar($dados)
    {
        $verificacao = "SELECT COUNT(*) FROM funcionarios WHERE email = :email";
        $stmtVerificacao = $this->conn->prepare($verificacao);
        $stmtVerificacao->bindParam(':email', $dados['email']);
        $stmtVerificacao->execute();
        $count = $stmtVerificacao->fetchColumn();

        if ($count > 0) {
            // Já existe um funcionário com esse email
            return false;
        } else {
            $sql = "INSERT INTO funcionarios (nome, email, senha, tipo_acesso, ativo) VALUES (:nome, :email, :senha, :tipo_acesso, :ativo)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':email', $dados['email']);
            $senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':tipo_acesso', $dados['tipo_acesso']);
            $stmt->bindParam(':ativo', $dados['ativo']);
            $stmt->execute();
        }
    }

    public function listar()
    {
        $sql = "SELECT * FROM funcionarios ORDER BY nome";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function desativar($id)
    {
        $sql = "UPDATE funcionarios SET ativo = 0 WHERE id_funcionario = :id_funcionario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_funcionario', $id);
        $stmt->execute();
    }

    public function ativar($id)
    {
        $sql = "UPDATE funcionarios SET ativo = 1 WHERE id_funcionario = :id_funcionario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_funcionario', $id);
        $stmt->execute();
    }

    public function editar($dados)
    {
        // var_dump($dados);exit;
        if (!empty($dados['senha'])) {
            $sql = "UPDATE funcionarios SET nome = :nome, email = :email, 
            senha = :senha, tipo_acesso = :tipo_acesso WHERE id_funcionario = :id_funcionario";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':email', $dados['email']);
            $senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':tipo_acesso', $dados['tipo_acesso']);
            $stmt->bindParam(':id_funcionario', $dados['id_funcionario']);
            $stmt->execute();
        } else {
            $sql = "UPDATE funcionarios SET nome = :nome, email = :email, tipo_acesso = :tipo_acesso WHERE id_funcionario = :id_funcionario";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':tipo_acesso', $dados['tipo_acesso']);
            $stmt->bindParam(':id_funcionario', $dados['id_funcionario']);
            $stmt->execute();
        }
    }

    public function funcionario_por_email($email)
    {
        $sql = "SELECT id_funcionario, nome, email, tipo_acesso FROM funcionarios WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function funcionario_por_id($id)
    {
        $sql = "SELECT id_funcionario, nome, email, tipo_acesso FROM funcionarios WHERE id_funcionario = :id_funcionario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_funcionario', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function editar_perfil($dados)
    {
        if (!empty($dados['senha'])) {
            $sql = "UPDATE funcionarios SET nome = :nome, email = :email, 
            senha = :senha, tipo_acesso = :tipo_acesso WHERE id_funcionario = :id_funcionario";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':email', $dados['email']);
            $senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':tipo_acesso', $dados['tipo_acesso']);
            $stmt->bindParam(':id_funcionario', $dados['id_funcionario']);
            $stmt->execute();
        } else {
            $sql = "UPDATE funcionarios SET nome = :nome, email = :email, tipo_acesso = :tipo_acesso WHERE id_funcionario = :id_funcionario";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':tipo_acesso', $dados['tipo_acesso']);
            $stmt->bindParam(':id_funcionario', $dados['id_funcionario']);
            $stmt->execute();
        }
    }
}
