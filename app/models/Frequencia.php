<?php
class Frequencia
{

    private $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    public function listar_por_turma_dia($id_turma)
    {
        $sql = "SELECT f.data_falta, fu.nome, t.nome_turma, t.ano_turma, t.turno, e.nome_estudante, e.registro_matricula_escola
        FROM turmas t
        RIGHT JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
        RIGHT JOIN estudantes e ON e.id_estudante = m.id_estudante
        RIGHT JOIN frequencia f ON f.id_matricula = m.id_matricula
        RIGHT JOIN funcionarios fu ON fu.id_funcionario = f.id_funcionario
        WHERE t.id_turma = :id_turma
        AND t.ativo = 'ativo'
        AND f.status_presenca = 'ausente'
        AND f.data_falta = CURDATE()";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $id_turma);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($dados)
    {
        // esse insert com on duplicate key update evita duplicidade de registros
        $sql = "INSERT INTO frequencia (data_falta, id_matricula, id_funcionario, status_presenca)
        VALUES (:data_falta, :id_matricula, :id_funcionario, :status_presenca)
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

    public function editar($dados)
    {
        $sql = "UPDATE frequencia SET status_presenca = :status_presenca WHERE data_falta = :data_falta AND id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status_presenca', $dados['status_presenca']);
        $stmt->bindParam(':data_falta', $dados['data_falta']);
        $stmt->bindParam(':id_matricula', $dados['id_matricula']);
        $stmt->execute();
    }

    // public function filtro_intervalo($dados)
    // {
    //     if ($dados['dta_inicial'] && $dados['dta_final'] && $dados['nome_estudante']) {
    //         $sql = "SELECT SELECT f.data_falta, fu.nome, t.nome_turma, t.ano_turma, e.nome_estudante
    //         FROM turmas t
    //         RIGHT JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
    //         RIGHT JOIN estudantes e ON e.id_estudante = m.id_estudante
    //         RIGHT JOIN frequencia f ON f.id_matricula = m.id_matricula
    //         RIGHT JOIN funcionarios fu ON fu.id_funcionario = f.id_funcionario
    //         WHERE t.id_turma = :id_turma
    //         AND t.ativo = 'ativo'
    //         AND f.status_presenca = 'ausente'
    //         AND f.data_falta BETWEEN :dta_inicial AND :dta_final
    //         AND e.nome_estudante LIKE '%:nome_estudante%'";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->bindParam(':id_turma', $dados['id_turma']);
    //         $stmt->bindParam(':dta_inicial', $dados['dta_inicial']);
    //         $stmt->bindParam(':dta_final', $dados['dta_final']);
    //         $stmt->bindParam(':nome_estudante', $dados['nome_estudante']);
    //         $stmt->execute();
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     } else if ($dados['dta_inicial'] && $dados['nome_estudante']) {
    //         $sql = "SELECT SELECT f.data_falta, fu.nome, t.nome_turma, t.ano_turma, e.nome_estudante
    //         FROM turmas t
    //         RIGHT JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
    //         RIGHT JOIN estudantes e ON e.id_estudante = m.id_estudante
    //         RIGHT JOIN frequencia f ON f.id_matricula = m.id_matricula
    //         RIGHT JOIN funcionarios fu ON fu.id_funcionario = f.id_funcionario
    //         WHERE t.id_turma = :id_turma
    //         AND t.ativo = 'ativo'
    //         AND f.status_presenca = 'ausente'
    //         AND f.data_falta = :dta_inicial 
    //         AND e.nome_estudante LIKE '%:nome_estudante%'";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->bindParam(':id_turma', $dados['id_turma']);
    //         $stmt->bindParam(':dta_inicial', $dados['dta_inicial']);
    //         $stmt->bindParam(':nome_estudante', $dados['nome_estudante']);
    //         $stmt->execute();
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     } else if ($dados['nome_estudante']) {
    //         $sql = "SELECT SELECT f.data_falta, fu.nome, t.nome_turma, t.ano_turma, e.nome_estudante
    //         FROM turmas t
    //         RIGHT JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
    //         RIGHT JOIN estudantes e ON e.id_estudante = m.id_estudante
    //         RIGHT JOIN frequencia f ON f.id_matricula = m.id_matricula
    //         RIGHT JOIN funcionarios fu ON fu.id_funcionario = f.id_funcionario
    //         WHERE t.id_turma = :id_turma
    //         AND t.ativo = 'ativo'
    //         AND f.status_presenca = 'ausente'
    //         AND e.nome_estudante LIKE '%:nome_estudante%'";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->bindParam(':id_turma', $dados['id_turma']);
    //         $stmt->bindParam(':nome_estudante', $dados['nome_estudante']);
    //         $stmt->execute();
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     }
    // }


    public function deletar($dados)
    {
        $sql = "DELETE FROM frequencia WHERE data_falta = :data_falta AND id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':data_falta', $dados['data_falta']);
        $stmt->bindParam(':id_matricula', $dados['id_matricula']);
        $stmt->execute();
    }


    public function estudantes_por_turma($id_turma)
    {
        $verificacao = "SELECT f.data_falta FROM frequencia f, matriculas_turma_estudante m
        WHERE f.id_matricula = m.id_matricula
        AND m.id_turma = :id_turma
        AND data_falta = CURDATE()
        LIMIT 1";
        $stmtVerificacao = $this->conn->prepare($verificacao);
        $stmtVerificacao->bindParam(':id_turma', $id_turma);
        $stmtVerificacao->execute();
        $data = $stmtVerificacao->fetch();
        if (!empty($data)) {
            // Já existem registros de frequência para esta turma na data atual
            $sql = "SELECT f.id_matricula, e.nome_estudante, status_presenca, data_falta FROM frequencia f, matriculas_turma_estudante m, estudantes e
            WHERE m.id_turma = :id_turma
            AND data_falta = CURDATE()
            AND m.id_matricula = f.id_matricula
            AND m.id_estudante = e.id_estudante ORDER BY e.nome_estudante";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_turma', $id_turma);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $sql = "SELECT m.id_matricula, e.nome_estudante
        FROM matriculas_turma_estudante m, estudantes e, turmas t
        WHERE m.id_turma = :id_turma
        AND t.id_turma = m.id_turma
        AND m.id_estudante = e.id_estudante ORDER BY e.nome_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $id_turma);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function list_relatorio_nutri_dia($data = null, $turno = null)
    {
        if ($data && $turno) {
            $sql = "SELECT nro_turma, tipo_ensino, count(f.id_matricula) as quantidade_presentes
            FROM turmas t 
            JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
            JOIN frequencia f ON f.id_matricula = m.id_matricula
            WHERE f.data_falta = :data_falta
            AND t.turno = :turno
            AND f.status_presenca = 'presente'
            GROUP BY t.id_turma";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':data_falta', $data);
            $stmt->bindParam(':turno', $turno);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else if ($data) {
            $sql = "SELECT nro_turma, tipo_ensino, count(f.id_matricula) as quantidade_presentes
            FROM turmas t 
            JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
            JOIN frequencia f ON f.id_matricula = m.id_matricula
            WHERE f.data_falta = :data_falta
            AND f.status_presenca = 'presente'
            GROUP BY t.id_turma";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':data_falta', $data);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT nro_turma, tipo_ensino, count(f.id_matricula) as quantidade_presentes
            FROM turmas t 
            JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
            JOIN frequencia f ON f.id_matricula = m.id_matricula
            WHERE f.data_falta = CURDATE()
            AND f.status_presenca = 'presente'
            GROUP BY t.id_turma";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function list_relatorio_nutri_dietas($data = null, $turno = null)
    {
        if ($data && $turno) {
            $sql = "SELECT nro_turma, tipo_ensino, d.nome_dieta, e.nome_estudante, e.id_estudante
            FROM dietas_especiais d
            JOIN cadastros_dietas_por_estudante de ON de.id_dieta = d.id_dieta
            JOIN estudantes e ON e.id_estudante = de.id_estudante
            JOIN matriculas_turma_estudante m ON m.id_estudante = e.id_estudante
            JOIN turmas t ON  t.id_turma = m.id_turma
            JOIN frequencia f ON f.id_matricula = m.id_matricula
            WHERE f.data_falta = :data_falta
            AND t.turno = :turno
            AND f.status_presenca = 'presente'
            ORDER BY t.tipo_ensino, t.nro_turma";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':data_falta', $data);
            $stmt->bindParam(':turno', $turno);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else if ($data) {
            $sql = "SELECT nro_turma, tipo_ensino, d.nome_dieta, e.nome_estudante, e.id_estudante
            FROM dietas_especiais d
            JOIN cadastros_dietas_por_estudante de ON de.id_dieta = d.id_dieta
            JOIN estudantes e ON e.id_estudante = de.id_estudante
            JOIN matriculas_turma_estudante m ON m.id_estudante = e.id_estudante
            JOIN turmas t ON  t.id_turma = m.id_turma
            JOIN frequencia f ON f.id_matricula = m.id_matricula
            WHERE f.data_falta = :data_falta
            AND f.status_presenca = 'presente'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':data_falta', $data);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT nro_turma, tipo_ensino, d.nome_dieta, e.nome_estudante, e.id_estudante
            FROM dietas_especiais d
            JOIN cadastros_dietas_por_estudante de ON de.id_dieta = d.id_dieta
            JOIN estudantes e ON e.id_estudante = de.id_estudante
            JOIN matriculas_turma_estudante m ON m.id_estudante = e.id_estudante
            JOIN turmas t ON  t.id_turma = m.id_turma
            JOIN frequencia f ON f.id_matricula = m.id_matricula
            WHERE f.data_falta = CURDATE()
            AND f.status_presenca = 'presente'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function list_relatorio_nutri_projeto($data = null, $projeto = null)
    {
        $sql_projeto = "SELECT id_projeto FROM projetos_extra WHERE status = 'ativo'";
        $stmt_proj = $this->conn->prepare($sql_projeto);
        $stmt_proj->execute();
        $ids_proj = $stmt_proj->fetchAll();
        if ($data && $projeto) {
            $projetos = [];
            $sql = "SELECT COUNT(m.id_matricula) AS qtd_estudantes
            FROM projetos_extra p
            JOIN matriculas_projetos m ON m.id_projeto = p.id_projeto 
            JOIN matriculas_turma_estudante me ON me.id_matricula = m.id_matricula
            JOIN estudantes e ON e.id_estudante = me.id_estudante
            JOIN turmas t ON t.id_turma = me.id_turma
            JOIN frequencia f ON f.id_matricula = m.id_matricula
            WHERE f.data_falta = :data_falta
            AND p.id_projeto = :id_projeto
            AND f.status_presenca = 'presente'
            GROUP BY p.id_projeto;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':data_falta', $data);
            $stmt->bindParam(':id_projeto', $projeto);
            $stmt->execute();
            $projetos[$projeto] = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $projetos;
        } else if ($data) {
            $projetos = [];
            foreach ($ids_proj as $projeto) {
                $id_projeto = $projeto['id_projeto'];
                $sql = "SELECT COUNT(m.id_matricula) AS qtd_estudantes
                FROM projetos_extra p
                JOIN matriculas_projetos m ON m.id_projeto = p.id_projeto 
                JOIN matriculas_turma_estudante me ON me.id_matricula = m.id_matricula
                JOIN estudantes e ON e.id_estudante = me.id_estudante
                JOIN turmas t ON t.id_turma = me.id_turma
                JOIN frequencia f ON f.id_matricula = m.id_matricula
                WHERE f.data_falta = :data_falta
                AND p.id_projeto = :id_projeto
                AND f.status_presenca = 'presente'
                GROUP BY p.id_projeto;";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':data_falta', $data);
                $stmt->bindParam(':id_projeto', $id_projeto);
                $stmt->execute();
                $projetos[$id_projeto] = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return $projetos;
        } else {
            $projetos = [];
            foreach ($ids_proj as $projeto) {
                $id_projeto = $projeto['id_projeto'];
                $sql = "SELECT COUNT(m.id_matricula) AS qtd_estudantes
                FROM projetos_extra p
                JOIN matriculas_projetos m ON m.id_projeto = p.id_projeto 
                JOIN matriculas_turma_estudante me ON me.id_matricula = m.id_matricula
                JOIN estudantes e ON e.id_estudante = me.id_estudante
                JOIN turmas t ON t.id_turma = me.id_turma
                JOIN frequencia f ON f.id_matricula = m.id_matricula
                WHERE f.data_falta = CURDATE()
                AND p.id_projeto = :id_projeto
                AND f.status_presenca = 'presente'
                GROUP BY p.id_projeto;";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id_projeto', $id_projeto);
                $stmt->execute();
                $projetos[$id_projeto] = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return $projetos;
        }
    }

    public function list_relatorio_coor_dia($data = null)
    {
        if ($data) {
            $sql = "SELECT nro_turma, tipo_ensino, count(f.id_matricula) as quantidade_presentes
            FROM turmas t 
            JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
            JOIN frequencia f ON f.id_matricula = m.id_matricula
            WHERE f.data_falta = :data_falta
            AND f.status_presenca = 'presente'
            GROUP BY t.id_turma";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':data_falta', $data);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT nro_turma, tipo_ensino, count(f.id_matricula) as quantidade_presentes
            FROM turmas t 
            JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
            JOIN frequencia f ON f.id_matricula = m.id_matricula
            WHERE f.data_falta = CURDATE()
            AND f.status_presenca = 'presente'
            GROUP BY t.id_turma";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function list_relatorio_coor_estudantes_dia($data = null, $id_turma = null)
    {
        $sql_turma = "SELECT id_turma FROM turmas WHERE ativo = 'ativo'";
        $stmt_turma = $this->conn->prepare($sql_turma);
        $stmt_turma->execute();
        $ids_tu = $stmt_turma->fetchAll();
        if ($data && $id_turma) {
             $estudantes = [];
            $sql = "SELECT e.nome_estudante
            FROM turmas t 
            JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
            JOIN estudantes e ON e.id_estudante = m.id_estudante
            JOIN frequencia f ON f.id_matricula = m.id_matricula
            WHERE f.data_falta = :data_falta
            AND t.id_turma = :id_turma
            AND f.status_presenca = 'ausente'
            ORDER BY t.nro_turma, t.tipo_ensino";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':data_falta', $data);
            $stmt->bindParam(':id_turma', $id_turma);
            $stmt->execute();
            $estudantes[$id_turma] = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return $estudantes;
        } else if ($data) {
            $estudantes = [];
            foreach ($ids_tu as $tu) {
                $id_turma = $tu['id_turma'];
                $sql = "SELECT e.nome_estudante
                FROM turmas t 
                JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
                JOIN estudantes e ON e.id_estudante = m.id_estudante
                JOIN frequencia f ON f.id_matricula = m.id_matricula
                WHERE f.data_falta = :data_falta
                AND f.status_presenca = 'ausente'
                AND t.id_turma = :id_turma
                ORDER BY t.nro_turma, t.tipo_ensino";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':data_falta', $data);
                $stmt->bindParam(':id_turma', $id_turma);
                $stmt->execute();
                $estudantes[$id_turma] = $stmt->fetchAll(PDO::FETCH_COLUMN);
            }
            return $estudantes;
        } else {
            $estudantes = [];
            foreach ($ids_tu as $tu) {
                $id_turma = $tu['id_turma'];
                $sql = "SELECT e.nome_estudante
                FROM turmas t 
                JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
                JOIN estudantes e ON e.id_estudante = m.id_estudante
                JOIN frequencia f ON f.id_matricula = m.id_matricula
                WHERE f.data_falta = CURDATE()
                AND f.status_presenca = 'ausente'
                AND t.id_turma = :id_turma
                ORDER BY t.nro_turma, t.tipo_ensino";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id_turma', $id_turma);
                $stmt->execute();
                $estudantes[$id_turma] = $stmt->fetchAll(PDO::FETCH_COLUMN);
            }
            return $estudantes;
        }
    }
}
