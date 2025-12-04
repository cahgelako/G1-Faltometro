<?php
class Estudante
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    public function salvar($dados)
    {
        $verificacao = "SELECT COUNT(*) FROM estudantes WHERE nome_estudante = :nome_estudante";
        $stmtVerificacao = $this->conn->prepare($verificacao);
        $stmtVerificacao->bindParam(':nome_estudante', $dados['nome_estudante']);
        $stmtVerificacao->execute();
        $count = $stmtVerificacao->fetchColumn();

        if ($count > 0) {
            // Já existe um estudante com esse nome
            return false;
        } else {
            $sql = "INSERT INTO estudantes (nome_estudante, ativo) VALUES (:nome_estudante, 'ativo')";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome_estudante', $dados['nome_estudante']);
            $stmt->execute();
            return true;
        }
    }

    public function listar()
    {
        $sql = "SELECT * FROM estudantes ORDER BY nome_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function editar($dados)
    {
        $verificacao = "SELECT COUNT(*) FROM estudantes WHERE nome_estudante LIKE CONCAT('%', :nome_estudante, '%')";
        // o concat faz a concatenação das string
        $stmtVerificacao = $this->conn->prepare($verificacao);
        $stmtVerificacao->bindParam(':nome_estudante', $dados['nome_estudante']);
        $stmtVerificacao->execute();
        $count = $stmtVerificacao->fetchColumn();

        if ($count > 0) {
            // Já existe um estudante com esse nome
            return false;
        } else {
            $sql = "UPDATE estudantes SET nome_estudante = :nome_estudante WHERE id_estudante = :id_estudante";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome_estudante', $dados['nome_estudante']);
            $stmt->bindParam(':id_estudante', $dados['id_estudante']);
            $stmt->execute();
            return true;
        }
    }

    public function desativar($id)
    {
        $sql = "UPDATE estudantes SET ativo = 'inativo' WHERE id_estudante = :id_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudante', $id);
        $stmt->execute();
    }
    public function ativar($id)
    {
        $sql = "UPDATE estudantes SET ativo = 'ativo' WHERE id_estudante = :id_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudante', $id);
        $stmt->execute();
    }

    public function estudante_por_id($id)
    {
        $sql = "SELECT * FROM estudantes WHERE id_estudante = :id_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudante', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function estudante_por_nome($nome)
    {
        $sql = "SELECT * FROM estudantes WHERE nome_estudante LIKE '%:nome_estudante%'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_estudante', $nome);
        $stmt->execute();
        return $stmt->fetch();
    }

    // public function estudantes_da_turma_e_nao_matriculados_outra($id_turma)
    // {
    //     $sql = "SELECT e.id_estudante, e.nome_estudante
    //     FROM estudantes e
    //     WHERE e.id_estudante NOT IN (
    //         SELECT m.id_estudante
    //         FROM matriculas_turma_estudante m
    //         WHERE m.id_turma != :id_turma AND m.ativo = 'ativo'
    //     )";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':id_turma', $id_turma);
    //     $stmt->execute();
    //     return $stmt->fetchAll();
    // }

    public function matricula_por_id_estudante($id) {
        $sql = "SELECT id_matricula 
        FROM matriculas_turma_estudante m
        JOIN estudantes e ON e.id_estudante = m.id_estudante
        WHERE e.id_estudante = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
