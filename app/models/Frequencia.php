<?php
class Frequencia {

    private $conn;

    public function __construct() {
        $this->conn = new Database();
    }

    public function listar_por_classe_dia($id_classe) {
        $sql = "SELECT f.data_falta, fu.nome, t.nome_turma, c.ano_turma, 
        FROM turmas t
        RIGHT JOIN classes c ON t.id_turma = c.id_turma
        RIGHT JOIN matriculas_classe_estudante m ON m.id_classe = c.id_classe
        RIGHT JOIN estudantes e ON e.id_estudante = m.id_estudante
        RIGHT JOIN frequencia f ON f.id_matricula = m.id_matricula
        RIGHT JOIN funcionarios fu ON fu.id_funcionario = f.id_funcionario
        WHERE c.id_classe = :id_classe
        AND c.ativo = 1
        AND f.data_falta = GETDATE()"; // revisar essa função getdate()
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_classe', $id_classe);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function salvar($dados) {
        $sql = "INSERT INTO frequencia (data_falta, id_matricula, id_funcionario, hora, status_presenca) VALUES (CURDATE(), :id_matricula, :id_funcionario, CURTIME(), :status_presenca)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_matricula', $dados['id_matricula']);
        $stmt->bindParam(':id_funcionario', $dados['id_funcionario']);
        $stmt->bindParam(':status_presenca', $dados['status_presenca']);
        $stmt->execute();
    }

    public function editar() {

    }

    
}