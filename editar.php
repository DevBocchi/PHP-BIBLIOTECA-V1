<?php
require 'database.php';

$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = $_POST['ano'];

    $query = "UPDATE livros 
              SET titulo = :titulo, autor = :autor, ano = :ano
              WHERE id = :id";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'titulo' => $titulo,
        'autor' => $autor,
        'ano' => $ano,
        'id' => $id
    ]);

    header('Location: t3.php?atualizado=' . $id);
    exit;
}

$query = "SELECT * FROM livros 
          WHERE id = :id;
         ";
$stmt = $pdo->prepare($query);
$stmt->execute([
    'id' => $id
]);
$livros = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar livros t3</title>
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
<h1>Editar Livros</h1>

<div class="card">
<form method="POST" class="form">

    <input type="hidden" name="id" value="<?= $livros['id']?>">

    <label>Titulo:</label>
    <input type="text" name="titulo" value="<?= $livros['titulo'] ?>">
    <br>

    <label>Autor:</label>
    <input type="text" name="autor" value="<?= $livros['autor'] ?>">
    <br>

    <label>Ano:</label>
    <input type="text" name="ano" value="<?= $livros['ano']?>">
    <br>

    <button type="submit" class="btn">Atualizar</button>
</form>
</div>

<?php
?>
</body>
</html>

