<?php
class Student{

    private static $studentTable = "usuarios";

    private static function GetConnection(){
        $conn = new PDO("mysql:dbname=davoscrud;host=localhost", "root", "");   
        return $conn; 
    }

    public static function store($args = []){
        $sql = "INSERT INTO usuarios(nome, email, telefone, situacao, mensalidade, senha, observacao)  
                VALUES (:nome, :email, :telefone, :situacao, :mensalidade, :senha, :observacao)";

        $conn = self::getConnection();
        $stmt = $conn->prepare($sql);
        if($stmt){
            $stmt->bindParam(':nome', $args['nome']);
            $stmt->bindParam(':email', $args['email']);
            $stmt->bindParam(':telefone', $args['telefone']);
            $stmt->bindParam(':situacao', $args['situacao']);
            $stmt->bindParam(':mensalidade', $args['mensalidade']);
            $stmt->bindParam(':senha', $args['senha']);
            $stmt->bindParam(':observacao', $args['observacao']);
            $execution = $stmt->execute();
            if($execution){
                return "Aluno cadastrado";
            }else{
                return "O aluno não pôde ser cadastrado!";
            }
        }else{
            return "Dados inconsistentes";
        }
    }

    public static function all(){
        $sql = "SELECT * FROM usuarios";
        $conn = self::getConnection();
        $students = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $students;
    }

    public static function getStudent($id){
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $conn = self::getConnection();
        $student = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $student;
    }

    public static function updateStudent($id, $data = []){
        $student = self::getStudent($id);
        $sql = "UPDATE usuarios SET id = :id, 
                                    nome = :nome, 
                                    email = :email, 
                                    telefone = :telefone, 
                                    situacao = :situacao, 
                                    observacao = :observacao, 
                                    mensalidade = :mensalidade, 
                                    senha = :senha WHERE id = $id";
        $conn = self::getConnection();
        $stmt = $conn->prepare($sql);
        $data[':senha'] = $student[0]['senha'];
        $result = $stmt->execute($data);
        if(!$result){
            return "Erro ao editar dados";
        }
        return true;
    }
}