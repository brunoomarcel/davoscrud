<?php
class Student{

    private static $studentTable = "usuarios";

    private static function GetConnection(){
        $conn = new PDO("mysql:dbname=davoscrud;host=localhost", "root", "");   
        return $conn; 
    }

    public static function store($args = []){
        $sql = "INSERT INTO self::$studentTable(nome, email, telefone, situacao, mensalidade, senha, observacao)  
                VALUES (:nome, :email, :telefone, :situacao, :mensalidade, :senha, :observacao)";

        $conn = self::getConnection();

        if($conn->prepare($sql)){
            $conn->bindParam(':nome', $args['nome']);
            $conn->bindParam(':email', $args['email']);
            $conn->bindParam(':telefone', $args['telefone']);
            $conn->bindParam(':situacao', $args['situacao']);
            $conn->bindParam(':mensalidade', $args['mensalidade']);
            $conn->bindParam(':senha', $args['senha']);
            $conn->bindParam(':observacao', $args['observacao']);
            $execution = $conn->execute();
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