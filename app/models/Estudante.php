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
        $verificacao = "SELECT COUNT(*) FROM estudantes WHERE nome_estudante = :nome_estudante AND registro_matricula_escola = :registro_matricula_escola";
        $stmtVerificacao = $this->conn->prepare($verificacao);
        $stmtVerificacao->bindParam(':nome_estudante', $dados['nome_estudante']);
        $stmtVerificacao->bindParam(':registro_matricula_escola', $dados['registro_matricula_escola']);
        $stmtVerificacao->execute();
        $count = $stmtVerificacao->fetchColumn();

        if ($count > 0) {
            // Já existe um estudante com esse nome
            return false;
        } else {
            $sql = "INSERT INTO estudantes (nome_estudante, registro_matricula_escola) VALUES (:nome_estudante, :registro_matricula_escola)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome_estudante', $dados['nome_estudante']);
            $stmt->bindParam(':registro_matricula_escola', $dados['registro_matricula_escola']);
            $stmt->execute();
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
        $verificacao = "SELECT COUNT(*) FROM estudantes WHERE registro_matricula_escola = :registro_matricula_escola";
        $stmtVerificacao = $this->conn->prepare($verificacao);
        $stmtVerificacao->bindParam(':registro_matricula_escola', $dados['registro_matricula_escola']);
        $stmtVerificacao->execute();
        $count = $stmtVerificacao->fetchColumn();

        if ($count > 0) {
            // Já existe um estudante com esse nome
            return false;
        } else {
            $sql = "UPDATE estudantes SET nome_estudante = :nome_estudante, registro_matricula_escola = :registro_matricula_escola WHERE id_estudante = :id_estudante";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome_estudante', $dados['nome_estudante']);
            $stmt->bindParam(':registro_matricula_escola', $dados['registro_matricula_escola']);
            $stmt->bindParam(':id_estudante', $dados['id_estudante']);
            $stmt->execute();
        }
    }

    public function deletar($id)
    {
        $sql = "DELETE FROM estudantes WHERE id_estudante = :id_estudante";
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
}
