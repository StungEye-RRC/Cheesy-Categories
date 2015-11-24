<?php
    require('db_connect.php');
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if (!isset($id) || !is_numeric($id)) {
        header('Location: index.php');
        exit;
    }

    $sql = "SELECT * FROM categories WHERE id = :id LIMIT 1";
    $statement = $db->prepare($sql);
    $statement->bindValue('id', $id);
    $statement->execute();

    if ($statement->rowCount() != 1) {
        // No rows were returned so this category does not exist.
        header('Location: index.php');
        exit;
    }

    $category_name = $statement->fetch()['name'];

    $sql = "SELECT * FROM cheeses WHERE category_id = :id";
    $statement = $db->prepare($sql);
    $statement->bindValue('id', $id);
    $statement->execute();
    $cheeses = $statement->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cheesy Categories</title>
</head>
<body>
    <h1><?= $category_name ?> Cheese</h1>
    <?php if (count($cheeses) > 0): ?>
        <ul>
            <?php foreach($cheeses as $cheese): ?>
                <li><?= $cheese['name'] ?></li>
            <?php endforeach ?>
        </ul>
    <?php else: ?>
        <p>There are no cheese categories in the database.</p>
    <?php endif ?>
    <p><a href="index.php">Back</a></p>
</body>
</html>