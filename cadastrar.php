<?php 
require 'includes/header.php';
?>

<h1>Cadastrar Usuário</h1>

<form action="cadastrar_action.php" method="POST">
    <div class="item">
        <label> Nome: </label>
        <input type="text" name="nome">
    </div>
    
    <div class="item">
        <label>Email: </label>
        <input type="email" name="email">
    </div>
    
    <div class="item">
        <label for="telefone">Telefone</label>
        <input type="tel" name="telefone" required placeholder="(xx) xxxxx-xxxx">
    </div>

    <div class="item">
        <label>Senha: </label>
        <input type="password" name="senha">
    </div>
    
    <input type="submit" value="SALVAR">
</form>