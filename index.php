<?php
require 'db.php';

// Buscar todos os produtos
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de compras</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>PRODUTOS</h1>
        <img src="images/logo.png" alt="logo" class="top-right-image">

        <form action="add-product.php" method="POST">
            <label for="name">Nome do Produto</label>
            <input type="text" id="name" name="name" placeholder="Nome do Produto" required>

            <label for="price">Preço</label>
            <input type="number" id="price" name="price" placeholder="Preço" required>

            <button type="submit">Adicionar Produto</button>
        </form>

        <h2>Lista de Produtos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['id']) ?></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['price']) ?></td>
                    <td>
                        <a class="button" href="edit-product.php?id=<?= $product['id'] ?>">Editar</a>
                        <a class="button delete" href="delete-product.php?id=<?= $product['id'] ?>">Deletar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
