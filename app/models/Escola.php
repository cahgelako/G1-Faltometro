<?php
class Escola
{
    // Atributos
    private $conn;

    // Métodos
    public function __construct()
    {
        $this->conn = new Database();
    }

    public function salvar($nome_escola)
    {
        $verificacao = "SELECT COUNT(*) FROM escolas WHERE nome_escola = :nome_escola";
        $stmtVerificacao = $this->conn->prepare($verificacao);
        $stmtVerificacao->bindParam(':nome_escola', $nome_escola);
        $stmtVerificacao->execute();
        $count = $stmtVerificacao->fetchColumn();

        if ($count > 0) {
            // Já existe um funcionário com esse email
            return false;
        } else {
            $sql = "INSERT INTO escolas (nome_escola) VALUES (:nome_escola)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome_escola', $nome_escola);
            $stmt->execute();
            return true;
        }
    }

    public function listar()
    {
        $sql = "SELECT * FROM escolas ORDER BY nome_escola";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filtrar($id_escola)
    {
        $sql = "SELECT * FROM escolas WHERE id_escola = :id_escola";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_escola', $id_escola);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function editar($dados)
    {
        $sql = "UPDATE escolas SET nome_escola = :nome_escola WHERE id_escola = :id_escola";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_escola', $dados['nome_escola']);
        $stmt->bindParam(':id_escola', $dados['id_escola']);
        $stmt->execute();
    }

    public function desativar($id)
    {
        $sql = "UPDATE escolas SET ativo = 'inativo' WHERE id_escola = :id_escola";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_escola', $id);
        $stmt->execute();
    }

    public function ativar($id)
    {
        $sql = "UPDATE escolas SET ativo = 'ativo' WHERE id_escola = :id_escola";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_escola', $id);
        $stmt->execute();
    }
}
