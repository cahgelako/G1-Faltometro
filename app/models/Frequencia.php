<?php
class Frequencia {

    private $conn;

    public function __construct() {
        $this->conn = new Database();
    }

    public function listar_por_classe_dia($id_classe) {
        $sql = "SELECT f.data_falta, fu.nome, t.nome_turma, c.ano_turma, e.nome_estudante 
        FROM turmas t
        RIGHT JOIN classes c ON t.id_turma = c.id_turma
        RIGHT JOIN matriculas_classe_estudante m ON m.id_classe = c.id_classe
        RIGHT JOIN estudantes e ON e.id_estudante = m.id_estudante
        RIGHT JOIN frequencia f ON f.id_matricula = m.id_matricula
        RIGHT JOIN funcionarios fu ON fu.id_funcionario = f.id_funcionario
        WHERE c.id_classe = :id_classe
        AND c.ativo = 1
        AND f.data_falta = CURDATE()"; 
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
            $sql = "SELECT SELECT f.data_falta, fu.nome, t.nome_turma, c.ano_turma, e.nome_estudante
            FROM turmas t
            RIGHT JOIN classes c ON t.id_turma = c.id_turma
            RIGHT JOIN matriculas_classe_estudante m ON m.id_classe = c.id_classe
            RIGHT JOIN estudantes e ON e.id_estudante = m.id_estudante
            RIGHT JOIN frequencia f ON f.id_matricula = m.id_matricula
            RIGHT JOIN funcionarios fu ON fu.id_funcionario = f.id_funcionario
            WHERE c.id_classe = :id_classe
            AND c.ativo = 1
            AND f.data_falta BETWEEN :dta_inicial AND :dta_final
            AND e.nome_estudante LIKE '%:nome_estudante%'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_classe', $dados['id_classe']);
            $stmt->bindParam(':dta_inicial', $dados['dta_inicial']);
            $stmt->bindParam(':dta_final', $dados['dta_final']);
            $stmt->bindParam(':nome_estudante', $dados['nome_estudante']);
            $stmt->execute();
            return $stmt->fetchAll();

        } else if ($dados['dta_inicial'] && $dados['nome_estudante']) {
            $sql = "SELECT SELECT f.data_falta, fu.nome, t.nome_turma, c.ano_turma, e.nome_estudante
            FROM turmas t
            RIGHT JOIN classes c ON t.id_turma = c.id_turma
            RIGHT JOIN matriculas_classe_estudante m ON m.id_classe = c.id_classe
            RIGHT JOIN estudantes e ON e.id_estudante = m.id_estudante
            RIGHT JOIN frequencia f ON f.id_matricula = m.id_matricula
            RIGHT JOIN funcionarios fu ON fu.id_funcionario = f.id_funcionario
            WHERE c.id_classe = :id_classe
            AND c.ativo = 1
            AND f.data_falta = :dta_inicial 
            AND e.nome_estudante LIKE '%:nome_estudante%'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_classe', $dados['id_classe']);
            $stmt->bindParam(':dta_inicial', $dados['dta_inicial']);
            $stmt->bindParam(':nome_estudante', $dados['nome_estudante']);
            $stmt->execute();
            return $stmt->fetchAll();

        } else if($dados['nome_estudante']) {
            $sql = "SELECT SELECT f.data_falta, fu.nome, t.nome_turma, c.ano_turma, e.nome_estudante
            FROM turmas t
            RIGHT JOIN classes c ON t.id_turma = c.id_turma
            RIGHT JOIN matriculas_classe_estudante m ON m.id_classe = c.id_classe
            RIGHT JOIN estudantes e ON e.id_estudante = m.id_estudante
            RIGHT JOIN frequencia f ON f.id_matricula = m.id_matricula
            RIGHT JOIN funcionarios fu ON fu.id_funcionario = f.id_funcionario
            WHERE c.id_classe = :id_classe
            AND c.ativo = 1
            AND e.nome_estudante LIKE '%:nome_estudante%'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_classe', $dados['id_classe']);
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

    
    public function estudantes_por_classe($id_classe) {
        $sql = "SELECT e.nome_estudante, m.id_matricula
        FROM matriculas_classe_estudante m, estudantes e, classes c
        WHERE m.id_classe = :id_classe
        AND c.id_classe = m.id_classe
        AND m.id_estudante = e.id_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_classe', $id_classe);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    
}