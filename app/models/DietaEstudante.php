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
        $sql = "SELECT t.nome_turma, e.nome_estudante, d.nome_dieta, cd.data_adicao_dieta,  e.registro_matricula_escola
        FROM dietas_especiais d
        JOIN cadastros_dietas_por_estudante cd ON cd.id_dieta = d.id_dieta
        JOIN estudantes e ON e.id_estudante = cd.id_estudante
        JOIN matriculas_classe_estudante m ON m.id_estudante = e.id_estudante
        JOIN classes c ON c.id_classe = m.id_classe
        JOIN turmas t ON t.id_turma = c.id_turma
        ORDER BY t.nome_turma";
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

    public function dietas_do_estudante($id_estudante) {
        $sql = "SELECT e.nome_estudante, d.nome_dieta FROM cadastros_dietas_por_estudante cd, estudantes e, dietas_especiais d
        WHERE cd.id_estudante = :id_estudante 
        AND cd.id_estudante = e.id_estudante
        AND cd.id_dieta = d.id_dieta";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudante', $id_estudante);
        $stmt->execute();
    }
}
