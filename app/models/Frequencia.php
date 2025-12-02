<?php
class Frequencia {

    private $conn;

    public function __construct() {
        $this->conn = new Database();
    }

    public function listar_por_turma_dia($id_turma) {
        $sql = "SELECT f.data_falta, fu.nome, t.nome_turma, t.ano_turma, t.turno, e.nome_estudante, e.registro_matricula_escola
        FROM turmas t
        RIGHT JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
        RIGHT JOIN estudantes e ON e.id_estudante = m.id_estudante
        RIGHT JOIN frequencia f ON f.id_matricula = m.id_matricula
        RIGHT JOIN funcionarios fu ON fu.id_funcionario = f.id_funcionario
        WHERE t.id_turma = :id_turma
        AND t.ativo = 'ativo'
        AND f.status_presenca = 0
        AND f.data_falta = CURDATE()"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $id_turma);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function salvar($dados) {
        $sql = "INSERT INTO frequencia (data_falta, id_matricula, id_funcionario, hora, status_presenca)
        VALUES (:data_falta, :id_matricula, :id_funcionario, CURTIME(), :status_presenca)
        ON DUPLICATE KEY UPDATE
        status_presenca = VALUES(status_presenca),
        id_funcionario = VALUES(id_funcionario)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':data_falta', $dados['data_falta']);
        $stmt->bindParam(':id_matricula', $dados['id_matricula']);
        $stmt->bindParam(':id_funcionario', $dados['id_funcionario']);
        $stmt->bindParam(':status_presenca', $dados['status_presenca']);
        $stmt->execute();
    }

    public function editar($dados) {
        $sql = "UPDATE frequencia SET status_presenca = :status_presenca WHERE data_falta = :data_falta AND id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status_presenca', $dados['status_presenca']);
        $stmt->bindParam(':data_falta', $dados['data_falta']);
        $stmt->bindParam(':id_matricula', $dados['id_matricula']);
        $stmt->execute();
    }

    public function filtro_intervalo($dados){
        if($dados['dta_inicial'] && $dados['dta_final'] && $dados['nome_estudante']) {
            $sql = "SELECT SELECT f.data_falta, fu.nome, t.nome_turma, t.ano_turma, e.nome_estudante
            FROM turmas t
            RIGHT JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
            RIGHT JOIN estudantes e ON e.id_estudante = m.id_estudante
            RIGHT JOIN frequencia f ON f.id_matricula = m.id_matricula
            RIGHT JOIN funcionarios fu ON fu.id_funcionario = f.id_funcionario
            WHERE t.id_turma = :id_turma
            AND t.ativo = 'ativo'
            AND f.status_presenca = 0
            AND f.data_falta BETWEEN :dta_inicial AND :dta_final
            AND e.nome_estudante LIKE '%:nome_estudante%'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_turma', $dados['id_turma']);
            $stmt->bindParam(':dta_inicial', $dados['dta_inicial']);
            $stmt->bindParam(':dta_final', $dados['dta_final']);
            $stmt->bindParam(':nome_estudante', $dados['nome_estudante']);
            $stmt->execute();
            return $stmt->fetchAll();

        } else if ($dados['dta_inicial'] && $dados['nome_estudante']) {
            $sql = "SELECT SELECT f.data_falta, fu.nome, t.nome_turma, t.ano_turma, e.nome_estudante
            FROM turmas t
            RIGHT JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
            RIGHT JOIN estudantes e ON e.id_estudante = m.id_estudante
            RIGHT JOIN frequencia f ON f.id_matricula = m.id_matricula
            RIGHT JOIN funcionarios fu ON fu.id_funcionario = f.id_funcionario
            WHERE t.id_turma = :id_turma
            AND t.ativo = 'ativo'
            AND f.status_presenca = 0
            AND f.data_falta = :dta_inicial 
            AND e.nome_estudante LIKE '%:nome_estudante%'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_turma', $dados['id_turma']);
            $stmt->bindParam(':dta_inicial', $dados['dta_inicial']);
            $stmt->bindParam(':nome_estudante', $dados['nome_estudante']);
            $stmt->execute();
            return $stmt->fetchAll();

        } else if($dados['nome_estudante']) {
            $sql = "SELECT SELECT f.data_falta, fu.nome, t.nome_turma, t.ano_turma, e.nome_estudante
            FROM turmas t
            RIGHT JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
            RIGHT JOIN estudantes e ON e.id_estudante = m.id_estudante
            RIGHT JOIN frequencia f ON f.id_matricula = m.id_matricula
            RIGHT JOIN funcionarios fu ON fu.id_funcionario = f.id_funcionario
            WHERE t.id_turma = :id_turma
            AND t.ativo = 'ativo'
            AND f.status_presenca = 0
            AND e.nome_estudante LIKE '%:nome_estudante%'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_turma', $dados['id_turma']);
            $stmt->bindParam(':nome_estudante', $dados['nome_estudante']);
            $stmt->execute();
            return $stmt->fetchAll();
        } 
    }

    public function deletar($dados) {
        $sql = "DELETE FROM frequencia WHERE data_falta = :data_falta AND id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':data_falta', $dados['data_falta']);
        $stmt->bindParam(':id_matricula', $dados['id_matricula']);
        $stmt->execute();
    }

    
    public function estudantes_por_turma($id_turma) {
        $sql = "SELECT e.nome_estudante, m.id_matricula
        FROM matriculas_turma_estudante m, estudantes e, turmas t
        WHERE m.id_turma = :id_turma
        AND t.id_turma = m.id_turma
        AND m.id_estudante = e.id_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $id_turma);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
}