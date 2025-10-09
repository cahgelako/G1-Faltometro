<?php
class Estudante {
    private $conn;

    public function __construct() {
        $this->conn = new Database();
    }

    public function salvar($dados) {
        $sql = "INSERT INTO estudantes (nome_estudante, telefone_responsavel, registro_matricula_escola) VALUES (:nome_estudante, :telefone_responsavel, :registro_matricula_escola)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_estudante', $dados['nome_estudante']);
        $stmt->bindParam(':telefone_responsavel', $dados['telefone_responsavel']);
        $stmt->bindParam(':registro_matricula_escola', $dados['registro_matricula_escola']);
        $stmt->execute();
    }

    public function listar() {
        $sql = "SELECT * FROM estudantes ORDER BY nome_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function editar($dados) {
        $sql = "UPDATE estudantes SET nome_estudante = :nome_estudante, telefone_responsavel = :telefone_responsavel, registro_matricula_escola = :registro_matricula_escola WHERE id_estudante = :id_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_estudante', $dados['nome_estudante']);
        $stmt->bindParam(':telefone_responsavel', $dados['telefone_responsavel']);
        $stmt->bindParam(':registro_matricula_escola', $dados['registro_matricula_escola']);
        $stmt->bindParam(':id_estudante', $dados['id_estudante']);
        $stmt->execute();
    }

    public function deletar($id) {
        $sql = "DELETE FROM estudantes WHERE id_estudante = :id_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudante', $id);
        $stmt->execute();
    }

    public function estudante_por_id($id) {
        $sql = "SELECT * FROM estudantes WHERE id_estudante = :id_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudante', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function estudante_por_nome($nome) {
        $sql = "SELECT * FROM estudantes WHERE nome_estudante LIKE '%:nome_estudante%'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_estudante', $nome);
        $stmt->execute();
        return $stmt->fetch();
    }
}