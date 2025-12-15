<?php
class MatriculaProjeto {
    
    // Atributos
    private $conn;

    // Métodos
    public function __construct()
    {
        $this->conn = new Database();
    }

    // rever lógica
    public function listar()
    {
        $sql = "SELECT e.registro_matricula_escola, e.nome_estudante, t.nome_turma, t.ano_turma, t.turno, e.id_estudante, p.nome_projeto, mp.id_matricula
        FROM turmas t
        JOIN matriculas_turma_estudante me ON me.id_turma = t.id_turma
        JOIN estudantes e ON e.id_estudante = me.id_estudante
        JOIN matriculas_projetos mp ON mp.id_matricula = me.id_matricula
        JOIN projetos_extra p ON p.id_projeto = mp.id_projeto
        ORDER BY t.id_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($id_projeto, $id_matricula)
    {
        $sql = "INSERT INTO matriculas_projetos (id_projeto, id_matricula) VALUES (:id_projeto, :id_matricula)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_projeto', $id_projeto);
        $stmt->bindParam(':id_matricula', $id_matricula);
        $stmt->execute();
    }


    public function desativar($id_projeto, $id_matricula)
    {
        $sql = "UPDATE matriculas_projetos SET ativo = 'inativo' WHERE id_projeto = :id_projeto AND id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_projeto', $id_projeto);
        $stmt->bindParam(':id_matricula', $id_matricula);
        $stmt->execute();
    }

    public function ativar($id_projeto, $id_matricula)
    {
        $sql = "UPDATE matriculas_projetos SET ativo = 'ativo' WHERE id_projeto = :id_projeto AND id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_projeto', $id_projeto);
        $stmt->bindParam(':id_matricula', $id_matricula);
        $stmt->execute();
    }

    //rever
    public function matricula_proj_estudante_por_id($id_matricula)
    {
        $id_mat = $id_matricula['id_matricula'];
        // var_dump($id_matricula); exit;
        $sql = "SELECT id_projeto FROM matriculas_projetos mp
        WHERE id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_matricula', $id_mat);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // retorna um array com os ids dos projetos atribuidas
        $mat = [];
        foreach ($resultado as $m) {
            $mat[] = $m['id_projeto'];
        }

        return $mat;
    }

    // retorna somnt os ids das matriculas
    public function matriculas_por_id_projeto($id_projeto)
    {
        $sql = "SELECT id_matricula FROM matriculas_projetos mp
        WHERE id_projeto = :id_projeto";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_projeto', $id_projeto);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // retorna um array com os ids dos alunos matriculados
        $mat = [];
        foreach ($resultado as $m) {
            $mat[] = $m['id_matricula'];
        }

        return $mat;
    }

    public function estudantes_por_projeto($id_projeto) {
        $sql = "SELECT DISTINCT e.nome_estudante, mp.id_matricula
        FROM projetos_extra p 
        RIGHT JOIN matriculas_projetos mp ON mp.id_projeto = p.id_projeto
        RIGHT JOIN matriculas_turma_estudante me ON me.id_matricula = mp.id_matricula
        RIGHT JOIN estudantes e ON e.id_estudante = me.id_estudante
        WHERE p.id_projeto = :id_projeto";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_projeto', $id_projeto);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function projetos_por_estudante($id_matricula) {
        $sql = "SELECT p.nome_projeto, e.nome_estudante, p.id_projeto 
        FROM projetos_extra p 
        LEFT JOIN matriculas_projetos mp ON mp.id_projeto = p.id_projeto
        LEFT JOIN matriculas_turma_estudante me ON me.id_matricula = mp.id_matricula
        LEFT JOIN estudantes e ON e.id_estudante = me.id_estudante
        WHERE me.id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_matricula', $id_matricula);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}