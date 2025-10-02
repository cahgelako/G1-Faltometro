<?php
class Funcionario
{
    private $conn;

    public function __construct()
    {
        $conn = new Database();
    }

    public function login($dados)
    {
        $sql = "SELECT * FROM Funcionarios WHERE email_funcionario = :email_funcionario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email_funcionario', $dados['email_funcionario']);
        $stmt->execute();
        $funcionario = $stmt->fetch();
        if ($funcionario && password_verify($dados['senha'], $funcionario['senha'])) {
            return true;
        } else {
            return false;
        }
    }

    public function salvar($dados)
    {
        $sql = "INSERT INTO Funcionarios (nome_funcionario, email_funcionario, senha, tipo_acesso) VALUES (:nome_funcionario, :email_funcionario, :senha, :tipo_acesso)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_funcionario', $dados['nome_funcionario']);
        $stmt->bindParam(':email_funcionario', $dados['email_funcionario']);
        $stmt->bindParam(':senha', password_hash($dados['email_funcionario'], PASSWORD_DEFAULT));
        $stmt->bindParam(':tipo_acesso', $dados['tipo_acesso']);
        $stmt->execute();
    }

    public function listar()
    {
        $sql = "SELECT * FROM Funcionarios ORDER BY nome_funcionario";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deletar($id)
    {
        $sql = "DELETE FROM Funcionarios WHERE id_funcionario = :id_funcionario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_funcionario', $id);
        $stmt->execute();
    }

    public function editar($dados)
    {
        if (!empty($dados['senha'])) {
            $sql = "UPDATE Funcionarios SET nome_funcionario = :nome_funcionario, email_funcionario = :email_funcionario, senha = :senha, tipo_acesso = :tipo_acesso";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome_funcionario', $dados['nome_funcionario']);
            $stmt->bindParam(':email_funcionario', $dados['email_funcionario']);
            $stmt->bindParam(':senha', password_hash($dados['senha'], PASSWORD_DEFAULT));
            $stmt->bindParam(':tipo_acesso', $dados['tipo_acesso']);
            $stmt->execute();
        } else {
            $sql = "UPDATE Funcionarios SET nome_funcionario = :nome_funcionario, email_funcionario = :email_funcionario, tipo_acesso = :tipo_acesso";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome_funcionario', $dados['nome_funcionario']);
            $stmt->bindParam(':email_funcionario', $dados['email_funcionario']);
            $stmt->bindParam(':tipo_acesso', $dados['tipo_acesso']);
            $stmt->execute();
        }
    }

    public function funcionario_por_email($email_funcionario) {
        $sql = "SELECT id_funcionario, nome_funcionario, email_funcionario, tipo_acesso FROM Funcionarios WHERE email_funcionario = :email_funcionario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email_funcionario', $email_funcionario);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function funcionario_por_id($id) {
        $sql = "SELECT id_funcionario, nome_funcionario, email_funcionario, tipo_acesso FROM Funcionarios WHERE id_funcionario = :id_funcionario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_funcionario', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
