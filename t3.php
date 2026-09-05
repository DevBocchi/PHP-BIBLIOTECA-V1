<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if ($_POST['action'] === 'create'){

        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $ano = $_POST['ano'];

        $query = "INSERT INTO livros (titulo, autor, ano)
                  VALUES (:titulo, :autor, :ano);
                 ";

        $stmt = $pdo->prepare($query);
        $stmt->execute([
           'titulo' => $titulo,
           'autor' => $autor,
           'ano' => $ano,
        ]);

        header('Location: t3.php?adicionado=1');
        exit;
    }

    if ($_POST['action'] === 'delete'){
        $id = $_POST['id'];

        $query = "DELETE FROM livros
                  WHERE id = :id;
                 ";

        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'id' => $id,
        ]);

        header('Location: t3.php?deletado=' . $id);
        exit;
    }
}
$query = "SELECT * FROM livros";

$stmt = $pdo->prepare($query);
$stmt->execute();
$livros = $stmt->fetchALl();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Books T3</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form {
            background-color: #b296ff;
            padding: 16px;
            border-radius: 8px;
        }
        .form .btn {
            background-color: #b296ff;
            border: 1px solid #7a5cff;
        }
    </style>
</head>
<body>

<h1>Bocchi the Books</h1>

<?php if (isset($_GET['atualizado'])): ?>
    <p style="background-color: #b296ff; color: #1a1a1a; padding: 12px; border-radius: 8px; font-weight: bold;">
        Livro ID <?= htmlspecialchars($_GET['atualizado']) ?> foi atualizado com sucesso!
    </p>
<?php endif; ?>

<?php if (isset($_GET['adicionado'])): ?>
    <p style="background-color: #b296ff; color: #1a1a1a; padding: 12px; border-radius: 8px; font-weight: bold;">
        Livro adicionado com sucesso!
    </p>
<?php endif; ?>

<?php if (isset($_GET['deletado'])): ?>
    <p style="background-color: #b296ff; color: #1a1a1a; padding: 12px; border-radius: 8px; font-weight: bold;">
        Livro ID <?= htmlspecialchars($_GET['deletado']) ?> deletado com sucesso!
    </p>
<?php endif; ?>

<div class="card">
<form method="POST" class="form">
    <input type="hidden" name="action" value="create">

    <label>Titulo:</label>
    <input type="text" name="titulo" placeholder="Informe Titulo...">
    <br>

    <label>Autor</label>
    <input type="text" name="autor" placeholder="Informe Autor...">
    <br>

    <label>Ano</label>
    <input type="text" name="ano" placeholder="Informe Ano...">
    <br>

    <button type="submit" class="btn">Enviar</button>
</form>
</div>

<?php foreach($livros as $dados):?>

    <div class="card">
    <p class="book-meta"><?= $dados['id']?></p>
    <p class="book-meta"><strong>Titulo:</strong> <?= $dados['titulo']?></p>
    <p class="book-meta"><strong>Autor:</strong> <?= $dados['autor']?></p>
    <p class="book-meta"><strong>Ano:</strong> <?= $dados['ano']?></p>

    <form method="POST" class="card-actions">
        <input type="hidden" name="id" value="<?= $dados['id']?>">
        <input type="hidden" name="action" value="delete">
        <button type="submit" class="btn btn--ghost">Deletar</button>

        <a href="editar.php?id=<?=$dados['id']?>" class="btn">Editar</a>
    </form>
    </div>

<?php endforeach; ?>

</body>
</html>