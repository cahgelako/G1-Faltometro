<?php
class Matricula
{

    // Atributos
    private $conn;


    // Métodos
    public function __construct()
    {
        $this->conn = new Database();
    }

    /* public function salvar($dados)
    {
        $verificacao = "SELECT COUNT(*) FROM matriculas_classe_estudante WHERE id_classe = :id_classe AND id_estudante = :id_estudante";
        $stmtVerificacao = $this->conn->prepare($verificacao);
        $stmtVerificacao->bindParam(':id_classe', $dados['id_classe']);
        $stmtVerificacao->bindParam(':id_estudante', $dados['id_estudante']);
        $stmtVerificacao->execute();
        $count = $stmtVerificacao->fetchColumn();
        
        if (!empty($count)) {
            $sql_ano_verificacao = "SELECT ano_turma FROM classes WHERE id_classe = :id_classe";
            $stmtAno = $this->conn->prepare($sql_ano_verificacao);
            $stmtAno->bindParam(':id_classe', $dados['id_classe']);
            $stmtAno->execute();
            $ano_atual_verificacao = $stmtAno->fetch();

            if ($ano_atual_verificacao === false) {
                $verificacao_ano = "SELECT COUNT(*) FROM matriculas_classe_estudante 
                WHERE id_estudante = :id_estudante 
                AND YEAR(data_matricula) = :ano_atual_verificacao
                AND id_classe != :id_classe_atual";
                $stmtVerificacaoAno = $this->conn->prepare($verificacao_ano);
                $stmtVerificacaoAno->bindParam(':id_estudante', $dados['id_estudante']);
                $stmtVerificacaoAno->bindParam(':ano_atual_verificacao', $ano_atual_verificacao);
                $stmtVerificacaoAno->bindParam(':id_classe_atual', $dados['id_classe']);
                $stmtVerificacaoAno->execute();
                $countAno = $stmtVerificacaoAno->fetchColumn();
                
                $sql = "INSERT INTO matriculas_classe_estudante (id_classe, id_estudante, data_matricula, ativo) VALUES (:id_classe, :id_estudante, CURDATE(), 1)";
                //echo "<pre>"; var_dump($sql); echo "</pre>"; exit;
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id_classe', $dados['id_classe']);
                $stmt->bindParam(':id_estudante', $dados['id_estudante']);
                $stmt->execute();
            }
        }
    } */


    public function salvar($dados)
    {

        $matriculas_duplas = $this->verificaMatriculaDuplicadaNoAno($dados['id_estudante'], $dados['id_classe']);

        if ($matriculas_duplas > 0) {
            // Se a contagem for maior que zero, significa que ele já está em outra turma ATIVA no ano.
            // Retorne FALSE para sinalizar o erro no Controller.
            return false;
        }
        $sql = "INSERT INTO matriculas_classe_estudante (id_classe, id_estudante, data_matricula, ativo) 
        VALUES (:id_classe, :id_estudante, CURDATE(), 1)";
        $stmt = $this->conn->prepare($sql);
        $id_classe_int = (int)$dados['id_classe'];
        $id_estudante_int = (int)$dados['id_estudante'];
        $stmt->bindParam(':id_classe', $id_classe_int);
        $stmt->bindParam(':id_estudante', $id_estudante_int);
        $stmt->execute();
    }

    // Model/Matricula.php

    public function verificaMatriculaDuplicadaNoAno($id_estudante, $id_classe)
    {
        // 1. Encontra o ano letivo da classe atual. Assumimos que o ano está na tabela 'classes'.
        $sql_ano = "SELECT ano_turma FROM classes WHERE id_classe = :id_classe";
        $stmt_ano = $this->conn->prepare($sql_ano);
        $stmt_ano->bindParam(':id_classe', $id_classe, PDO::PARAM_INT);
        $stmt_ano->execute();
        $classe_info = $stmt_ano->fetch(PDO::FETCH_ASSOC);

        if (empty($classe_info) || !isset($classe_info['ano_turma'])) {
            // Se a classe não for encontrada ou o ano não estiver definido, você pode retornar TRUE 
            // para bloquear ou lançar um erro, dependendo da sua regra. 
            // Vamos assumir que é um erro e retornar 1 para bloquear a inserção.
            return 1;
        }

        $ano_turma_atual = $classe_info['ano_turma'];

        // 2. Conta quantas matrículas ATIVAS este estudante possui em OUTRAS classes (id_classe !=)
        //    no MESMO ano letivo (ano_turma).
        $sql_verificacao = "SELECT COUNT(*)
                        FROM matriculas_classe_estudante m
                        JOIN classes c ON m.id_classe = c.id_classe
                        WHERE m.id_estudante = :id_estudante
                        AND m.ativo = 1 
                        AND c.ano_turma = :ano_turma_atual
                        AND m.id_classe != :id_classe"; // 🛑 Excluir a própria classe (caso seja uma edição)

        $stmt_verificacao = $this->conn->prepare($sql_verificacao);

        // Vincula os parâmetros
        $stmt_verificacao->bindParam(':id_estudante', $id_estudante, PDO::PARAM_INT);
        $stmt_verificacao->bindParam(':ano_turma_atual', $ano_turma_atual); // O ano pode ser INT ou STRING
        $stmt_verificacao->bindParam(':id_classe', $id_classe, PDO::PARAM_INT);

        $stmt_verificacao->execute();

        // Retorna a contagem de matrículas duplas encontradas
        return $stmt_verificacao->fetchColumn();
    }

    public function listar()
    {
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

    public function editar($dados)
    {
        $sql = "UPDATE matriculas_classe_estudante SET id_classe = :id_classe, id_estudante = :id_estudante, data_matricula = :data_matricula, ativo = :ativo WHERE id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_classe', $dados['id_classe']);
        $stmt->bindParam(':id_estudante', $dados['id_estudante']);
        $stmt->bindParam(':data_matricula', $dados['data_matricula']);
        $stmt->bindParam(':ativo', $dados['ativo']);
        $stmt->bindParam(':id_matricula', $dados['id_matricula']);
        $stmt->execute();
    }

    public function desativar($id_classe, $id_estudante)
    {
        $sql = "UPDATE matriculas_classe_estudante SET ativo = 0  WHERE id_classe = :id_classe AND id_estudante = :id_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_classe', $id_classe);
        $stmt->bindParam(':id_estudante', $id_estudante);
        $stmt->execute();
    }

    public function ativar($id)
    {
        $sql = "UPDATE matriculas_classe_estudante SET ativo = 1  WHERE id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_matricula', $id);
        $stmt->execute();
    }

    public function matricula_por_nome_estudante($nome)
    { // arrumar se necessário
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

    public function matricula_por_id($id)
    {
        $sql = "SELECT m.* FROM matriculas_classe_estudante m, classes c, estudantes e
        WHERE m.id_matricula = :id_matricula
        AND m.id_classe = c.id_classe
        AND m.id_estudante = e.id_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_matricula', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function matricula_por_id_classe($id)
    {
        $sql = "SELECT m.id_estudante 
            FROM matriculas_classe_estudante m
            WHERE m.id_classe = :id_classe
            AND m.ativo = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_classe', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }
}
