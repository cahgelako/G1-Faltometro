<?php
class Turma {

    // Atributos
    private $conn;

    // Métodos
    public function __construct(){
        $this->conn = new Database();
    }

    public function salvar($dados) {
        $sql = "INSERT INTO Turmas (nome_turma, ano_turma, semestre_turma, grupo) VALUES (:nome_turma, :ano_turma, :semestre_turma, :grupo)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_turma', $dados['nome_turma']);
        $stmt->bindParam(':ano_turma', $dados['ano_turma']);
        $stmt->bindParam(':semestre_turma', $dados['semestre_turma']);
        $stmt->bindParam(':grupo', $dados['grupo']);
        $stmt->execute();
    }

    public function listar() {
        $sql = "SELECT * FROM Turmas ORDER BY nome_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function editar($dados){
        $sql = "UPDATE Turmas SET nome_turma = :nome_turma, ano_turma = :ano_turma, semestre_turma = :semestre_turma, grupo = :grupo WHERE id_turma = :id_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_turma', $dados['nome_turma']);
        $stmt->bindParam(':ano_turma', $dados['ano_turma']);
        $stmt->bindParam(':semestre_turma', $dados['semestre_turma']);
        $stmt->bindParam(':grupo', $dados['grupo']);
        $stmt->execute();
    }

    public function filtrar($id_turma) {
        $sql = "SELECT * FROM Turmas WHERE id_turma = :id_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $id_turma);
        $stmt->execute();
        return $stmt->fetch();
    }
}