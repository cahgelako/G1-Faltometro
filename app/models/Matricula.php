<?php 
class Matricula {

    private $conn;

    public function __construct() {
        $this->conn = new Database();
    }

    public function salvar($dados) {
        $sql = "INSERT INTO matriculas_classe_estudante (id_classe, id_estudante, data_matricula, ativo) VALUES (:id_classe, :id_estudante, :data_matricula, :ativo)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_classe', $dados['id_classe']);
        $stmt->bindParam(':id_estudante', $dados['id_estudante']);
        $stmt->bindParam(':data_matricula', $dados['data_matricula']);
        $stmt->bindParam(':ativo', $dados['ativo']);
        $stmt->execute();
    }

    public function listar() {
        $sql = "SELECT m.id_matricula, m.ativo, t.nome_turma, c.turno, e.nome_estudante, m.data_matricula, c.ano_turma, es.nome_escola
        FROM turmas t
        JOIN classes c ON c.id_turma = t.id_turma
        JOIN escolas es ON es.id_escola = c.id_escola
        JOIN matriculas_classe_estudante m ON m.id_classe = c.id_classe
        JOIN estudantes e ON e.id_estudante = m.id_estudante
        ORDER BY es.nome_escola";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function editar($dados) {
        $sql = "UPDATE matriculas_classe_estudante SET id_classe = :id_classe, id_estudante = :id_estudante, data_matricula = :data_matricula, ativo = :ativo WHERE id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_classe', $dados['id_classe']);
        $stmt->bindParam(':id_estudante', $dados['id_estudante']);
        $stmt->bindParam(':data_matricula', $dados['data_matricula']);
        $stmt->bindParam(':ativo', $dados['ativo']);
        $stmt->bindParam(':id_matricula', $dados['id_matricula']);
        $stmt->execute();
    }

    public function deletar($id) {
        $sql = "DELETE FROM matriculas_classe_estudante WHERE id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_matricula', $id);
        $stmt->execute();
    }

    public function matricula_por_nome_estudante($nome) { // arrumar se necessário
        $sql = "SELECT t.nome_turma, c.turno, e.nome_estudante, m.data_matricula, c.ano_turma, es.nome_escola
        FROM turmas t
        JOIN classes c ON c.id_turma = t.id_turma
        JOIN escolas es ON es.id_escola = c.id_escola
        JOIN matriculas_classe_estudante m ON m.id_classe = c.id_classe
        JOIN estudantes e ON e.id_estudante = m.id_estudante
        WHERE e.nome_estudante LIKE '%:nome_estudante%'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_estudante', $nome);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function matricula_por_id($id) {
        $sql = "SELECT m.* FROM matriculas_classe_estudante m, classes c, estudantes e
        WHERE m.id_matricula = :id_matricula
        AND m.id_classe = c.id_classe
        AND m.id_estudante = e.id_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_matricula', $id);
        $stmt->execute();
        return $stmt->fetch();  
    }
}