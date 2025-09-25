<?php
    class Escola {
        // Atributos
        private $conn;

        // Métodos
        public function __construct(){
            $this->conn = new Database();
        }

        public function salvar($nome_escola) {
            $sql = "INSERT INTO Escolas (nome_escola) VALUES (:nome_escola)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome_escola', $nome_escola);
            $stmt->execute();
        }

        public function listar(){
            $sql = "SELECT * FROM Escolas ORDER BY nome_escola";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function filtrar($id_escola) {
            $sql = "SELECT * FROM Escolas WHERE id_escola = :id_escola";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_escola', $id_escola);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function editar($dados){
            $sql = "UPDATE Escolas SET nome_escola = :nome_escola WHERE id_escola = :id_escola";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome_escola', $dados['nome_escola']);
            $stmt->bindParam(':id_escola', $dados['id_escola']);
            $stmt->execute();
        }
    }