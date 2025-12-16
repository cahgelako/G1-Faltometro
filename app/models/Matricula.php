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

    public function salvar($dados)
    {
        $sql_ano_verificacao = "SELECT ano_turma FROM turmas WHERE id_turma = :id_turma";
        $stmtAno = $this->conn->prepare($sql_ano_verificacao);
        $stmtAno->bindParam(':id_turma', $dados['id_turma']);
        $stmtAno->execute();
        $ano_atual_verificacao = $stmtAno->fetchColumn();

        if ($ano_atual_verificacao === false) {
            return false;
        }

        $verificacao_ano = "SELECT COUNT(*) FROM matriculas_turma_estudante mt
        JOIN turmas t ON mt.id_turma = t.id_turma
        WHERE mt.id_estudante = :id_estudante 
        AND t.ano_turma = :ano_turma -- Usamos o ano da tabela turmas para consistência
        AND mt.ativo = 'ativo' -- Adicionar verificação de status ativo da matrícula
        AND mt.id_turma != :id_turma_atual";
        $stmtVerificacaoAno = $this->conn->prepare($verificacao_ano);
        $stmtVerificacaoAno->bindParam(':id_estudante', $dados['id_estudante']);
        $stmtVerificacaoAno->bindParam(':ano_turma', $ano_atual_verificacao);
        $stmtVerificacaoAno->bindParam(':id_turma_atual', $dados['id_turma']);
        $stmtVerificacaoAno->execute();
        $countAno = $stmtVerificacaoAno->fetchColumn();

        if ($countAno > 0) {
            // Já existe uma matrícula para essa combinação de id_turma e id_estudante no ano
            return false;
        }
        $sql = "INSERT INTO matriculas_turma_estudante (id_turma, id_estudante, data_matricula, ativo) VALUES (:id_turma, :id_estudante, CURDATE(), 'ativo')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $dados['id_turma']);
        $stmt->bindParam(':id_estudante', $dados['id_estudante']);
        $stmt->execute();
    }


    // public function salvar($dados)
    // {

    //     $matriculas_duplas = $this->verificaMatriculaDuplicadaNoAno($dados['id_estudante'], $dados['id_turma']);

    //     if ($matriculas_duplas > 0) {
    //         // Se a contagem for maior que zero, significa que ele já está em outra turma ATIVA no ano.
    //         // Retorne FALSE para sinalizar o erro no Controller.
    //         return false;
    //     }
    //     $sql = "INSERT INTO matriculas_turma_estudante (id_turma, id_estudante, data_matricula, ativo) 
    //     VALUES (:id_turma, :id_estudante, CURDATE(), 1)";
    //     $stmt = $this->conn->prepare($sql);
    //     $id_turma_int = (int)$dados['id_turma'];
    //     $id_estudante_int = (int)$dados['id_estudante'];
    //     $stmt->bindParam(':id_turma', $id_turma_int);
    //     $stmt->bindParam(':id_estudante', $id_estudante_int);
    //     $stmt->execute();
    // }

    // // Model/Matricula.php

    // public function verificaMatriculaDuplicadaNoAno($id_estudante, $id_turma)
    // {
    //     // 1. Encontra o ano letivo da turma atual. Assumimos que o ano está na tabela 'turmas'.
    //     $sql_ano = "SELECT ano_turma FROM turmas WHERE id_turma = :id_turma";
    //     $stmt_ano = $this->conn->prepare($sql_ano);
    //     $stmt_ano->bindParam(':id_turma', $id_turma, PDO::PARAM_INT);
    //     $stmt_ano->execute();
    //     $turma_info = $stmt_ano->fetch(PDO::FETCH_ASSOC);

    //     if (empty($turma_info) || !isset($turma_info['ano_turma'])) {
    //         // Se a turma não for encontrada ou o ano não estiver definido, você pode retornar TRUE 
    //         // para bloquear ou lançar um erro, dependendo da sua regra. 
    //         // Vamos assumir que é um erro e retornar 1 para bloquear a inserção.
    //         return 1;
    //     }

    //     $ano_turma_atual = $turma_info['ano_turma'];

    //     // 2. Conta quantas matrículas ATIVAS este estudante possui em OUTRAS turmas (id_turma !=)
    //     //    no MESMO ano letivo (ano_turma).
    //     $sql_verificacao = "SELECT COUNT(*)
    //                     FROM matriculas_turma_estudante m
    //                     JOIN turmas c ON m.id_turma = c.id_turma
    //                     WHERE m.id_estudante = :id_estudante
    //                     AND m.ativo = 1 
    //                     AND c.ano_turma = :ano_turma_atual
    //                     AND m.id_turma != :id_turma"; // 🛑 Excluir a própria turma (caso seja uma edição)

    //     $stmt_verificacao = $this->conn->prepare($sql_verificacao);

    //     // Vincula os parâmetros
    //     $stmt_verificacao->bindParam(':id_estudante', $id_estudante, PDO::PARAM_INT);
    //     $stmt_verificacao->bindParam(':ano_turma_atual', $ano_turma_atual); // O ano pode ser INT ou STRING
    //     $stmt_verificacao->bindParam(':id_turma', $id_turma, PDO::PARAM_INT);

    //     $stmt_verificacao->execute();

    //     // Retorna a contagem de matrículas duplas encontradas
    //     return $stmt_verificacao->fetchColumn();
    // }

    public function listar()
    {
        $sql = "SELECT m.id_matricula, m.ativo, t.nro_turma, t.tipo_ensino, t.turno, e.nome_estudante, m.data_matricula, t.ano_turma, es.nome_escola
        FROM turmas t
        JOIN escolas es ON es.id_escola = t.id_escola
        JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
        JOIN estudantes e ON e.id_estudante = m.id_estudante
        
        ORDER BY es.nome_escola";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editar($dados)
    {
        $sql = "UPDATE matriculas_turma_estudante SET id_turma = :id_turma, id_estudante = :id_estudante, data_matricula = :data_matricula, ativo = :ativo WHERE id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $dados['id_turma']);
        $stmt->bindParam(':id_estudante', $dados['id_estudante']);
        $stmt->bindParam(':data_matricula', $dados['data_matricula']);
        $stmt->bindParam(':ativo', $dados['ativo']);
        $stmt->bindParam(':id_matricula', $dados['id_matricula']);
        $stmt->execute();
    }

    public function desativar($id_matricula)
    {
        $id_mat = $id_matricula['id_matricula'];
        $sql = "UPDATE matriculas_turma_estudante SET ativo = 'inativo' WHERE id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_matricula', $id_mat);
        $stmt->execute();
    }
    
    public function ativar($id)
    {
        $id_mat = $id['id_matricula'];
        $sql = "UPDATE matriculas_turma_estudante SET ativo = 'ativo' WHERE id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_matricula', $id_mat);
        $stmt->execute();
    }

    public function matricula_por_nome_estudante($nome)
    { // arrumar se necessário
        $sql = "SELECT t.nome_turma, t.turno, e.nome_estudante, m.data_matricula, t.ano_turma, es.nome_escola
        FROM turmas t
        JOIN escolas es ON es.id_escola = t.id_escola
        JOIN matriculas_turma_estudante m ON m.id_turma = t.id_turma
        JOIN estudantes e ON e.id_estudante = m.id_estudante
        WHERE e.nome_estudante LIKE '%:nome_estudante%'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_estudante', $nome);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function matricula_por_id($id)
    {
        $sql = "SELECT m.* FROM matriculas_turma_estudante m, turmas t, estudantes e
        WHERE m.id_matricula = :id_matricula
        AND m.id_turma = t.id_turma
        AND m.id_estudante = e.id_estudante 
        AND m.ativo = 'ativo'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_matricula', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function matricula_por_id_turma($id)
    {
        $sql = "SELECT m.id_estudante 
            FROM matriculas_turma_estudante m, estudantes e
            WHERE m.id_turma = :id_turma
            AND m.id_estudante = e.id_estudante
            AND m.ativo = 'ativo'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $id);
        $stmt->execute();
        $resultado =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $matriculas = [];
        foreach ($resultado as $d) {
            $matriculas[] = $d['id_dieta'];
        }

        return $matriculas;
    }
}
