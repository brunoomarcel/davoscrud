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
}