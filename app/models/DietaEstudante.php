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
        $sql = "SELECT t.nro_turma, t.tipo_ensino, e.nome_estudante, d.nome_dieta, cd.data_adicao_dieta, e.id_estudante, t.ano_turma, t.turno
        FROM dietas_especiais d
        JOIN cadastros_dietas_por_estudante cd ON cd.id_dieta = d.id_dieta
        JOIN estudantes e ON e.id_estudante = cd.id_estudante
        JOIN matriculas_turma_estudante m ON m.id_estudante = e.id_estudante
        JOIN turmas t ON t.id_turma = m.id_turma
        ORDER BY e.nome_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($id_estudante, $id_dieta)
    {
        $sql = "INSERT INTO cadastros_dietas_por_estudante (id_estudante, id_dieta, data_adicao_dieta) VALUES (:id_estudante, :id_dieta, CURDATE())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudante', $id_estudante);
        $stmt->bindParam(':id_dieta', $id_dieta);
        $stmt->execute();
    }

    // revisar
    // public function editar($dados)
    // {
    //     $sql = "UPDATE cadastros_dietas_por_estudante SET data_adicao_dieta = :data_adicao_dieta, ativo = :ativo WHERE id_estudante = :id_estudante AND id_dieta = :id_dieta";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':data_adicao_dieta', $dados['data_adicao_dieta']);
    //     $stmt->bindParam(':ativo', $dados['ativo']);
    //     $stmt->bindParam(':id_estudante', $dados['id_estudante']);
    //     $stmt->bindParam(':id_dieta', $dados['id_dieta']);
    //     $stmt->execute();
    // }



    public function deletar($id_estudante, $id_dieta)
    {
        $sql = "DELETE FROM cadastros_dietas_por_estudante WHERE id_estudante = :id_estudante AND id_dieta = :id_dieta";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudante', $id_estudante);
        $stmt->bindParam(':id_dieta', $id_dieta);
        $stmt->execute();
    }

    public function dietas_do_estudante($id_estudante)
    {
        $sql = "SELECT id_dieta FROM cadastros_dietas_por_estudante 
        WHERE id_estudante = :id_estudante";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudante', $id_estudante);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // retorna um array com os ids das dietas atribuidas
        $dietas = [];
        foreach ($resultado as $d) {
            $dietas[] = $d['id_dieta'];
        }

        return $dietas;
    }
}
