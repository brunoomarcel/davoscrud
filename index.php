<?php
require 'includes/header.php';

// $pdo = new PDO("mysql:dbname=davoscrud;host=localhost", "root", "");

// $sql = $pdo->query('SELECT * FROM usuarios');

// $dados = $sql->fetchAll(pdo::FETCH_ASSOC);

// echo '<pre>';
// print_r($dados);

require 'config.php';
$lista = [];
$sql = $pdo->query("SELECT * FROM usuarios");
if($sql->rowCount() > 0){
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>

  <body>
    <h1>LISTA DE USUÁRIOS</h1>

    <table class="table">
    <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Telefone</th>
            <!-- <th scope="col">Mensalidade</th> -->
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($lista as $usuario): ?>
        <tr>
            <th scope="row"><?php echo $usuario['id']; ?></th>
            <td><?php echo $usuario['nome']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
            <td><?php echo $usuario['telefone']; ?></td>

            <td>
                <a href="editar.php?id=<?php echo $usuario['id']; ?>" class="btn btn-warning">Editar</a>
                <a href="excluir.php?id=<?php echo $usuario['id']; ?>" class="btn btn-danger">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    <a class="btn btn-primary" href="cadastrar.php">Cadastrar Usuário</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>
