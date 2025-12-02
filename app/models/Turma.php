<?php
class turma
{

    // Atributos
    private $conn;


    // Métodos
    public function __construct()
    {
        $this->conn = new Database();
    }

    public function listar()
    {
        $sql = "SELECT e.nome_escola, t.*
        FROM escolas e, turmas t
        WHERE t.id_escola = e.id_escola
        ORDER BY t.nro_turma, t.tipo_ensino";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function salvar($dados)
    {
        $verificacao = "SELECT COUNT(*) FROM turmas 
        WHERE id_escola = :id_escola 
        AND nro_turma = :nro_turma 
        AND tipo_ensino = :tipo_ensino 
        AND turno = :turno
        AND ano_turma = :ano_turma";
        $stmtVerificacao = $this->conn->prepare($verificacao);
        $stmtVerificacao->bindParam(':id_escola', $dados['id_escola']);
        $stmtVerificacao->bindParam(':nro_turma', $dados['nro_turma']);
        $stmtVerificacao->bindParam(':tipo_ensino', $dados['tipo_ensino']);
        $stmtVerificacao->bindParam(':turno', $dados['turno']);
        $stmtVerificacao->bindParam(':ano_turma', $dados['ano_turma']);
        $stmtVerificacao->execute();
        $count = $stmtVerificacao->fetchColumn();

        if ($count > 0) {
            // Já existe uma turma para essa combinação de id_turma e id_escola
            return false;
        } else {
            $sql = "INSERT INTO turmas (id_turma, id_escola, nro_turma, tipo_ensino, ano_turma, turno, ativo, img) VALUES (:id_turma, :id_escola, :nro_turma, :tipo_ensino, :ano_turma, :turno, :ativo, :img)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_turma', $dados['id_turma']);
            $stmt->bindParam(':id_escola', $dados['id_escola']);
            $stmt->bindParam(':nro_turma', $dados['nro_turma']);
            $stmt->bindParam(':tipo_ensino', $dados['tipo_ensino']);
            $stmt->bindParam(':ano_turma', $dados['ano_turma']);
            $stmt->bindParam(':turno', $dados['turno']);
            $stmt->bindParam(':ativo', $dados['ativo']);
            $stmt->bindParam(':img', $dados['img']);
            $stmt->execute();
            return true;
        }
    }

    public function editar($dados)
    {
        $verificacao = "SELECT COUNT(*) FROM turmas WHERE id_turma = :id_turma AND id_escola = :id_escola";
        $stmtVerificacao = $this->conn->prepare($verificacao);
        $stmtVerificacao->bindParam(':id_turma', $dados['id_turma']);
        $stmtVerificacao->bindParam(':id_escola', $dados['id_escola']);
        $stmtVerificacao->execute();
        $count = $stmtVerificacao->fetchColumn();

        if ($count > 0) {
            // Já existe uma turma para essa combinação de id_turma e id_escola
            return false;
        } else {
            $sql = "UPDATE turmas SET id_turma = :id_turma, id_escola = :id_escola, ano_turma = :ano_turma, turno = :turno, ativo = :ativo, img = :img WHERE id_turma = :id_turma";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_turma', $dados['id_turma']);
            $stmt->bindParam(':id_escola', $dados['id_escola']);
            $stmt->bindParam(':ano_turma', $dados['ano_turma']);
            $stmt->bindParam(':turno', $dados['turno']);
            $stmt->bindParam(':ativo', $dados['ativo']);
            $stmt->bindParam(':img', $dados['img']);
            $stmt->bindParam(':id_turma', $dados['id_turma']);
            $stmt->execute();
        }
    }

    public function desativar($id)
    {
        $sql = "UPDATE turmas SET ativo = 'inativo WHERE id_turma = :id_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $id);
        $stmt->execute();
    }

    public function ativar($id)
    {
        $sql = "UPDATE turmas SET ativo = 'ativo' WHERE id_turma = :id_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $id);
        $stmt->execute();
    }

    public function turma_por_id($id)
    {
        $sql = "SELECT * FROM turmas WHERE id_turma = :id_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_turma', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
