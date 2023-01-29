<?php
require 'includes/header.php';

$cifrao = 'R$ ';

require 'config.php';
$lista = [];
$sql = $pdo->query("SELECT * FROM usuarios");
if($sql->rowCount() > 0){
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>

  <body>
    <main>
        <nav>
            <!-- <ul style="display:flex; justify-content:space-between; max-width: 500px;">
                <li>Cadastro</li>
                <li>Lista de Alunos</li>
            </ul> -->
        </nav>
    <h1>Lista de Alunos</h1>
        <div class="container-tabelas">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Situação</th>
                        <th scope="col">Mensalidade</th>
                        <th scope="col">Observação</th>

                        
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
                        <td><?php echo $usuario['situacao']; ?></td>
                        <td><?php echo $cifrao .$usuario['mensalidade']; ?></td>
                        <td><?php echo $usuario['observacao']; ?></td>
                        
                        <td>
                            <div class="grid-edit-delete">
                                <a href="editar.php?id=<?php echo $usuario['id']; ?>" class="btn btn-warning">Editar</a>
                                <a href="excluir.php?id=<?php echo $usuario['id']; ?>" class="btn btn-danger">Excluir</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a class="btn btn-primary" href="cadastrar.php">Cadastrar Usuário</a>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <?php
        require 'includes/footer.php';
    ?>

    </body>
</html>
