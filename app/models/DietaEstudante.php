<?php
class DietaEstudante
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
        $sql = "SELECT t.nome_turma, e.nome_estudante, d.nome_dieta, cd.data_adicao_dieta, cd.ativo 
        FROM dietas_especiais d
        JOIN cadastros_dietas_por_estudante cd ON cd.id_dieta = d.id_dieta
        JOIN estudante e ON e.id_estudante = cd.id_estudante
        JOIN matriculas_classe_estudante m ON m.id_estudante = e.id_classe
        JOIN classes c ON c.id_turma = c.idturma
        JOIN turmas t ON d.id_dieta = cd.id_dieta
        ORDER BY t.nome_turma";

        // SELECT BASE PARA O DE CIMA
        // "SELECT t.nome_turma, e.nome_estudante, d.nome_dieta, cd.data_adicao_dieta, c.ativo 
        // FROM turmas t
        // JOIN classes c ON c.id_turma = c.idturma
        // JOIN matricula m ON m.id_classe = c.id_classe
        // JOIN estudante e ON e.id_estudante = m.id_estudante
        // JOIN cadastros_dietas_por_estudante cd ON cd.id_estudante = e.id_estudante
        // JOIN dietas_especiais d ON d.id_dieta = cd.id_dieta
        // ORDER BY t.nome_turma";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function salvar($dados)
    {
        $sql = "INSERT INTO cadastros_dietas_por_estudante (id_estudante, id_dieta, data_adicao_dieta) VALUES (:id_estudante, :id_dieta, CURDATE())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudante', $dados['id_estudante']);
        $stmt->bindParam(':id_dieta', $dados['id_dieta']);
        $stmt->execute();
    }

    public function editar($dados)
    {
        $sql = "UPDATE cadastros_dietas_por_estudante SET :data_adicao_dieta, :ativo WHERE id_estudante = :id_estudante AND id_dieta = :id_dieta";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':data_adicao_dieta', $dados['data_adicao_dieta']);
        $stmt->bindParam(':ativo', $dados['ativo']);
        $stmt->bindParam(':id_estudante', $dados['id_estudante']);
        $stmt->bindParam(':id_dieta', $dados['id_dieta']);
        $stmt->execute();
    }

    public function deletar($id_estudante, $id_dieta)
    {
        $sql = "DELETE FROM cadastros_dietas_por_estudante WHERE id_estudante = :id_estudante AND id_dieta = :id_dieta";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudante', $id_estudante);
        $stmt->bindParam(':id_dieta', $id_dieta);
        $stmt->execute();
    }

    public function dieta_estudante_por_id($id_estudante, $id_dieta)
    {
        $sql = "SELECT cd.* FROM cadastros_dietas_por_estudante cd, estudantes e, dietas_especiais d
        WHERE cd.id_estudante = :id_estudante AND cd.id_dieta = :id_dieta
        AND cd.id_estudante = e.id_estudante
        AND cd.id_dieta = d.id_dieta";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudante', $id_estudante);
        $stmt->bindParam(':id_dieta', $id_dieta);
        $stmt->execute();
    }
}
