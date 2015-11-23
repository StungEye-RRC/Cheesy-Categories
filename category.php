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
        header('Location: index.php');
        exit;
    }

    $category_name = $statement->fetch()['name']; 
    
    $sql = "SELECT * FROM cheeses WHERE category_id = :id";
    $statement = $db->prepare($sql);
    $statement->bindValue('id', $id);
    $statement->execute();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cheesy Categories</title>
</head>
<body>
    <h1><?= $category_name ?> Cheese</h1>
    <?php if ($statement->rowCount() > 0): ?>
        <ul>
            <?php while ($row = $statement->fetch()): ?>
                <li>
                    <a href="category.php?id=<?= $row['id'] ?>">
                        <?= $row['name'] ?>
                    </a>
                </li>
            <?php endwhile ?>
        </ul>
    <?php else: ?>
        <p>There are no cheese categories in the database.</p>
    <?php endif ?>
</body>
</html>