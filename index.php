<?php
    require('db_connect.php');
    $sql = "SELECT * FROM categories ORDER BY name";
    $statement = $db->prepare($sql);
    $statement->execute();
    $categories = $statement->fetchAll();

    $sql = "SELECT categories.name AS category, cheeses.name AS cheese FROM cheeses " .
           "INNER JOIN categories ON categories.id = cheeses.category_id ORDER BY cheese";
    $statement = $db->prepare($sql);
    $statement->execute();
    $cheeses_with_categories = $statement->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Cheesy Categories</title>
</head>
<body>
    <h1>Cheesy Categories</h1>
    <ul>
        <?php foreach($categories as $category): ?>
            <li>
                <a href="category.php?id=<?= $category['id'] ?>">
                    <?= $category['name'] ?>
                </a>
            </li>
        <?php endforeach ?>
    </ul>
    <h2>Cheeses with Categories</h2>
    <ul>
        <?php foreach($cheeses_with_categories as $cheese): ?>
            <li><?= $cheese['cheese'] ?> (<?= $cheese['category'] ?>)</li>
        <?php endforeach ?>
    </ul>
    <h2>Add To Database</h2>
    <p>
        <a href="new_cheese.php">New Cheese</a> - <a href="new_category.php">New Category</a>
    </p>
</body>
</html>