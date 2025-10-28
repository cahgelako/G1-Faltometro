<?php
class DietaEspecial {

    // Atributos
    private $conn;

    // Métodos
    public function __construct() {
        $this->conn = new Database();
    }

    public function salvar($dados) {
        $sql = "INSERT INTO dietas_especiais (nome_dieta, observacoes) VALUES (:nome_dieta, :observacoes)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_dieta', $dados['nome_dieta']);
        $stmt->bindParam(':observacoes', $dados['observacoes']);
        $stmt->execute();
    }

    public function listar() {
        $sql = "SELECT * FROM dietas_especiais ORDER BY nome_dieta";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function editar($dados) {
        $sql = "UPDATE dietas_especiais SET nome_dieta = :nome_dieta, observacoes = :observacoes WHERE id_dieta = :id_dieta";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_dieta', $dados['nome_dieta']);
        $stmt->bindParam(':observacoes', $dados['observacoes']);
        $stmt->bindParam(':id_dieta', $dados['id_dieta']);
        $stmt->execute();
    }

    public function deletar($id) {
        $sql = "DELETE FROM dietas_especiais WHERE id_dieta = :id_dieta";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_dieta', $id);
        $stmt->execute();
    }

    public function dieta_por_id($id) {
        $sql = "SELECT * FROM dietas_especiais WHERE id_dieta = :id_dieta";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_dieta', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}