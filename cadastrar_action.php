<?php
require 'includes/header.php';
require 'config.php';

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$telefone = filter_input(INPUT_POST, 'telefone');
// $senha = filter_input(INPUT_POST, 'senha');

if($nome && $email && $telefone && $senha):
    
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $sql->bindValue(':email', $email);
    $sql->execute();

    if($sql->rowCount() === 0):
        $sql = $pdo->prepare("INSERT INTO usuarios(nome, email, telefone)  VALUES (:nome, :email, :telefone)");
        
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':telefone', $telefone);
        // $sql->bindValue(':senha', $senha);
        $sql->execute();
        
        header("Location: index.php");
        exit;
    else:
        header("Location: cadastrar.php");
    endif;

else:
    header("Location: cadastrar.php");
endif;
