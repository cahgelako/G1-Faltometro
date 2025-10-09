<?php
class DietaEspecial {
    private $conn;

    public function __construct() {
        $this->conn = new Database();
    }

    public function salvar($dados) {
        $sql = "INSERT INTO dietas_especiais () VALUES ()";
    }

    public function listar() {
        $sql = "SELECT * FROM dietas_especiais ORDER BY nome_dieta";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function editar($dados) {

    }

    public function deletar($id) {

    }
}