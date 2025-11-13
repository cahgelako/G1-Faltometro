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
        $sql = "SELECT e.registro_matricula_escola, e.nome_estudante, t.nome_turma, c.ano_turma, c.turno, e.id_estudante, p.nome_projeto, mp.id_matricula
        FROM turmas t
        JOIN classes c ON c.id_turma = t.id_turma
        JOIN matriculas_classe_estudante me ON me.id_classe = c.id_classe
        JOIN estudantes e ON e.id_estudante = me.id_estudante
        JOIN matriculas_projetos mp ON mp.id_matricula = me.id_matricula
        JOIN projetos_extra p ON p.id_projeto = mp.id_projeto
        ORDER BY c.id_classe";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function salvar($id_projeto, $id_matricula)
    {
        $sql = "INSERT INTO matriculas_projetos (id_projeto, id_matricula) VALUES (:id_projeto, :id_matricula)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_projeto', $id_projeto);
        $stmt->bindParam(':id_matricula', $id_matricula);
        $stmt->execute();
    }


    public function deletar($id_projeto, $id_matricula)
    {
        $sql = "DELETE FROM matriculas_projetos WHERE id_projeto = :id_projeto AND id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_projeto', $id_projeto);
        $stmt->bindParam(':id_matricula', $id_matricula);
        $stmt->execute();
    }

    //rever
    public function matricula_proj_estudante_por_id($id_matricula)
    {
        $sql = "SELECT id_projeto FROM matriculas_projetos mp
        WHERE id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_matricula', $id_matricula);
        $stmt->execute();
        $resultado = $stmt->fetchAll();

        // retorna um array com os ids dos projetos atribuidas
        $mat = [];
        foreach ($resultado as $m) {
            $mat[] = $m['id_projeto'];
        }

        return $mat;
    }

    public function estudantes_por_projeto($id_projeto) {
        $sql = "SELECT p.nome_projeto, e.nome_estudante 
        FROM projetos_extra p 
        RIGHT JOIN matriculas_projetos mp ON mp.id_projeto = p.id_projeto
        RIGHT JOIN matriculas_classe_estudante me ON me.id_matricula = mp.id_matricula
        RIGHT JOIN estudantes e ON e.id_estudante = me.id_estudante
        WHERE p.id_projeto = :id_projeto";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_projeto', $id_projeto);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function projetos_por_estudante($id_matricula) {
        $sql = "SELECT p.nome_projeto, e.nome_estudante, p.id_projeto 
        FROM projetos_extra p 
        LEFT JOIN matriculas_projetos mp ON mp.id_projeto = p.id_projeto
        LEFT JOIN matriculas_classe_estudante me ON me.id_matricula = mp.id_matricula
        LEFT JOIN estudantes e ON e.id_estudante = me.id_estudante
        WHERE me.id_matricula = :id_matricula";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_matricula', $id_matricula);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}