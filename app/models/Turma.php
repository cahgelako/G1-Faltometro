<?php
class Turma {

    // Atributos
    private $conn;

    // Métodos
    public function __construct(){
        $this->conn = new Database();
    }

    public function salvar($dados) {
        $sql = "INSERT INTO turmas (nome_turma, grupo) VALUES (:nome_turma, :grupo)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_turma', $dados['nome_turma']);
        $stmt->bindParam(':grupo', $dados['grupo']);
        $stmt->execute();
    }

    public function listar() {
        $sql = "SELECT * FROM turmas ORDER BY nome_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function editar($dados){
        $sql = "UPDATE turmas SET nome_turma = :nome_turma,  grupo = :grupo WHERE id_turma = :id_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_turma', $dados['nome_turma']);
        $stmt->bindParam(':grupo', $dados['grupo']);
        $stmt->bindParam(':id_turma', $dados['id_turma']);
        $stmt->execute();
    }

    public function filtrar($id_turma) {
        $sql = "SELECT * FROM turmas WHERE id_turma = :id_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $id_turma);
        $stmt->execute();
        return $stmt->fetch();
    }
}