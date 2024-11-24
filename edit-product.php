<?php
require 'db.php';

// Verificar se um ID foi passado via GET
if (!isset($_GET['id'])) {
    die('ID do produto não especificado.');
}

$id = $_GET['id'];

// Buscar os dados do produto pelo ID
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar se o produto existe
if (!$product) {
    die('Produto não encontrado.');
}

// Atualizar os dados do produto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $sql = "UPDATE products SET name = ?, price = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $price, $id]);

    // Redirecionar para a página inicial
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Produto</h1>
        <img src="images/logo.png" alt="logo" class="top-right-image">

        <form action="" method="POST">
            <label for="name">Nome do Produto</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

            <label for="price">Preço</label>
            <input type="number" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>

            <button type="submit">Salvar Alterações</button>
            <a class="button" href="index.php">Cancelar</a>
        </form>
    </div>
</body>
</html>
