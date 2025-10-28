<?php
class Projeto {

    // Atributos
    private $conn;


    // Métodos
    public function __construct() {
        $this->conn = new Database();
    }

    public function listar() {
        $sql = "SELECT * FROM projetos_extra ORDER BY nome_projeto";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function salvar($dados) {
        $sql = "INSERT INTO projetos_extra (nome_projeto, turno, status) VALUE (:nome_projeto, :turno, :status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_projeto', $dados['nome_projeto']);
        $stmt->bindParam(':turno', $dados['turno']);
        $stmt->bindParam(':status', $dados['status']);
        $stmt->execute();
    }

    public function editar($dados) {
        $sql = "UPDATE projetos_extra SET nome_projeto = :nome_projeto, turno = :turno, status = :status WHERE id_projeto = :id_projeto";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_projeto', $dados['nome_projeto']);
        $stmt->bindParam(':turno', $dados['turno']);
        $stmt->bindParam(':status', $dados['status']);
        $stmt->bindParam(':id_projeto', $dados['id_projeto']);
        $stmt->execute();
    }

    public function deletar($id) {
        $sql = "DELETE FROM projetos_extra WHERE id_projeto = :id_projeto";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_projeto', $id);
        $stmt->execute();
    }

    public function projeto_por_id($id) {
        $sql = "SELECT * FROM projetos_extra WHERE id_projeto = :id_projeto";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_projeto', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}