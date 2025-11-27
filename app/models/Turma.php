<?php
class Turma
{

    // Atributos
    private $conn;

    // Métodos
    public function __construct()
    {
        $this->conn = new Database();
    }

    public function salvar($dados)
    {
        $verificacao = "SELECT COUNT(*) FROM turmas WHERE nome_turma = :nome_turma";
        $stmtVerificacao = $this->conn->prepare($verificacao);
        $stmtVerificacao->bindParam(':nome_turma', $dados['nome_turma']);
        $stmtVerificacao->execute();
        $count = $stmtVerificacao->fetchColumn();

        if ($count > 0) {
            // Já existe um funcionário com esse email
            return false;
        } else {
            $sql = "INSERT INTO turmas (nome_turma) VALUES (:nome_turma)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome_turma', $dados['nome_turma']);
            $stmt->execute();
        }
    }

    public function listar()
    {
        $sql = "SELECT * FROM turmas ORDER BY nome_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function editar($dados)
    {
        $sql = "UPDATE turmas SET nome_turma = :nome_turma WHERE id_turma = :id_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_turma', $dados['nome_turma']);
        $stmt->bindParam(':id_turma', $dados['id_turma']);
        $stmt->execute();
    }

    public function filtrar($id_turma)
    {
        $sql = "SELECT * FROM turmas WHERE id_turma = :id_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $id_turma);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function deletar($id)
    {
        $sql = "DELETE FROM turmas WHERE id_turma = :id_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $id);
        $stmt->execute();
    }
}
