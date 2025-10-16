<?php
class Classe {

    private $conn;

    public function __construct() {
        $this->conn = new Database();
    }

    public function listar() {
        $sql = "SELECT c.id_classe, e.nome_escola, t.nome_turma, c.ano_turma, c.turno, c.ativo  FROM escolas e
        JOIN classes c ON c.id_escola = e.id_escola
        JOIN turmas t ON t.id_turma = c.id_turma
        ORDER BY e.nome_escola";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function salvar($dados) {
        $sql = "INSERT INTO classes (id_turma, id_escola, ano_turma, turno, ativo) VALUES (:id_turma, :id_escola, :ano_turma, :turno, :ativo)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $dados['id_turma']);
        $stmt->bindParam(':id_escola', $dados['id_escola']);
        $stmt->bindParam(':ano_turma', $dados['ano_turma']);
        $stmt->bindParam(':turno', $dados['turno']);
        $stmt->bindParam(':ativo', $dados['ativo']);
        $stmt->execute();
    }

    public function editar($dados) {
        $sql = "UPDATE classes SET id_turma = :id_turma, id_escola = :id_escola, ano_turma = :ano_turma, turno = :turno, ativo = :ativo WHERE id_classe = :id_classe";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $dados['id_turma']);
        $stmt->bindParam(':id_escola', $dados['id_escola']);
        $stmt->bindParam(':ano_turma', $dados['ano_turma']);
        $stmt->bindParam(':turno', $dados['turno']);
        $stmt->bindParam(':ativo', $dados['ativo']);
        $stmt->bindParam(':id_classe', $dados['id_classe']);
        $stmt->execute();
    }

    public function deletar($id) {
        $sql = "DELETE FROM classes WHERE id_classe = :id_classe";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_classe', $id);
        $stmt->execute();
    }

    public function classe_por_id($id) {
        //echo '<pre>'; print_r($id); echo '</pre>'; exit;
        $sql = "SELECT cla.*, t.nome_turma 
            FROM escolas e, turmas t, classes cla 
            where cla.id_classe = :id_classe 
            and cla.id_turma = t.id_turma 
            and cla.id_escola = e.id_escola";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_classe', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}