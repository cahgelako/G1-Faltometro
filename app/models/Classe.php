<?php
class Classe
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
        $sql = "SELECT c.id_classe, e.nome_escola, t.nome_turma, c.ano_turma, c.turno, c.ativo, c.img 
        FROM escolas e
        JOIN classes c ON c.id_escola = e.id_escola
        JOIN turmas t ON t.id_turma = c.id_turma
        WHERE c.ativo = 1
        ORDER BY t.nome_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($dados)
    {
        $verificacao = "SELECT COUNT(*) FROM classes WHERE id_turma = :id_turma AND id_escola = :id_escola";
        $stmtVerificacao = $this->conn->prepare($verificacao);
        $stmtVerificacao->bindParam(':id_turma', $dados['id_turma']);
        $stmtVerificacao->bindParam(':id_escola', $dados['id_escola']);
        $stmtVerificacao->execute();
        $count = $stmtVerificacao->fetchColumn();

        if ($count > 0) {
            // Já existe uma classe para essa combinação de id_turma e id_escola
            return false;
        } else {
            $sql = "INSERT INTO classes (id_turma, id_escola, ano_turma, turno, ativo, img) VALUES (:id_turma, :id_escola, :ano_turma, :turno, :ativo, :img)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_turma', $dados['id_turma']);
            $stmt->bindParam(':id_escola', $dados['id_escola']);
            $stmt->bindParam(':ano_turma', $dados['ano_turma']);
            $stmt->bindParam(':turno', $dados['turno']);
            $stmt->bindParam(':ativo', $dados['ativo']);
            $stmt->bindParam(':img', $dados['img']);
            $stmt->execute();
        }
    }

    public function editar($dados)
    {
        $verificacao = "SELECT COUNT(*) FROM classes WHERE id_turma = :id_turma AND id_escola = :id_escola";
        $stmtVerificacao = $this->conn->prepare($verificacao);
        $stmtVerificacao->bindParam(':id_turma', $dados['id_turma']);
        $stmtVerificacao->bindParam(':id_escola', $dados['id_escola']);
        $stmtVerificacao->execute();
        $count = $stmtVerificacao->fetchColumn();

        if ($count > 0) {
            // Já existe uma classe para essa combinação de id_turma e id_escola
            return false;
        } else {
            $sql = "UPDATE classes SET id_turma = :id_turma, id_escola = :id_escola, ano_turma = :ano_turma, turno = :turno, ativo = :ativo, img = :img WHERE id_classe = :id_classe";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_turma', $dados['id_turma']);
            $stmt->bindParam(':id_escola', $dados['id_escola']);
            $stmt->bindParam(':ano_turma', $dados['ano_turma']);
            $stmt->bindParam(':turno', $dados['turno']);
            $stmt->bindParam(':ativo', $dados['ativo']);
            $stmt->bindParam(':img', $dados['img']);
            $stmt->bindParam(':id_classe', $dados['id_classe']);
            $stmt->execute();
        }
    }

    public function desativar($id)
    {
        $sql = "UPDATE classes SET ativo = 0 WHERE id_classe = :id_classe";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_classe', $id);
        $stmt->execute();
    }

    public function ativar($id)
    {
        $sql = "UPDATE classes SET ativo = 1 WHERE id_classe = :id_classe";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_classe', $id);
        $stmt->execute();
    }

    public function classe_por_id($id)
    {
        $sql = "SELECT cla.*, t.nome_turma 
            FROM turmas t, classes cla 
            where cla.id_classe = :id_classe 
            and cla.id_turma = t.id_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_classe', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
