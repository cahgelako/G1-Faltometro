<?php
class Projeto
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
        $sql = "SELECT * FROM projetos_extra ORDER BY nome_projeto";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function salvar($dados)
    {
        $verificacao = "SELECT COUNT(*) FROM projetos_extra WHERE nome_projeto = :nome_projeto AND turno = :turno";
        $stmtVerificacao = $this->conn->prepare($verificacao);
        $stmtVerificacao->bindParam(':nome_projeto', $dados['nome_projeto']);
        $stmtVerificacao->bindParam(':turno', $dados['turno']);
        $stmtVerificacao->execute();
        $count = $stmtVerificacao->fetchColumn();

        if ($count > 0) {
            // Já existe um funcionário com esse email
            return false;
        } else {
            $sql = "INSERT INTO projetos_extra (nome_projeto, turno, status) VALUE (:nome_projeto, :turno, :status)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome_projeto', $dados['nome_projeto']);
            $stmt->bindParam(':turno', $dados['turno']);
            $stmt->bindParam(':status', $dados['status']);
            $stmt->execute();
            return true;
        }
    }

    public function editar($dados)
    {
        $sql = "UPDATE projetos_extra SET nome_projeto = :nome_projeto, turno = :turno, status = :status WHERE id_projeto = :id_projeto";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_projeto', $dados['nome_projeto']);
        $stmt->bindParam(':turno', $dados['turno']);
        $stmt->bindParam(':status', $dados['status']);
        $stmt->bindParam(':id_projeto', $dados['id_projeto']);
        $stmt->execute();
    }
    // public function editarAluno($dados) {
    //     $sql = "UPDATE projetos_extra SET nome_projeto = :nome_projeto, turno = :turno, status = :status WHERE id_projeto = :id_projeto";
    //     $estudantes = "SELECT m.id_matricula, e.nome_estudante FROM matriculas_projetos mp JOIN matriculas m ON mp.id_matricula = m.id_matricula JOIN estudantes e ON m.id_estudante = e.id_estudante WHERE mp.id_projeto = :id_projeto";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':nome_projeto', $dados['nome_projeto']);
    //     $stmt->bindParam(':turno', $dados['turno']);
    //     $stmt->bindParam(':status', $dados['status']);
    //     $stmt->bindParam(':id_projeto', $dados['id_projeto']);
    //     $stmt->bindParam(':id_projeto', $estudantes);
    //     $stmt->execute();
    // }

    public function desativar($id)
    {
        $sql = "UPDATE projetos_extra SET status = 0  WHERE id_projeto = :id_projeto";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_projeto', $id);
        $stmt->execute();
    }
    public function ativar($id)
    {
        $sql = "UPDATE projetos_extra SET status = 1  WHERE id_projeto = :id_projeto";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_projeto', $id);
        $stmt->execute();
    }

    public function projeto_por_id($id)
    {
        $sql = "SELECT * FROM projetos_extra WHERE id_projeto = :id_projeto";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_projeto', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
