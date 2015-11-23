<?php
    require('db_connect.php');

    if ($_POST && isset($_POST['name']) && isset($_POST['category_id'])) {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);
        $sql = "INSERT INTO cheeses (name, category_id) VALUES (:name, :category_id)";
        $statement = $db->prepare($sql);
        $statement->bindValue('name', $name);
        $statement->bindValue('category_id', $category_id);
        $statement->execute();

        header('Location: index.php');
        exit;
    } else {
       $sql = "SELECT * FROM categories ORDER BY name";
       $statement = $db->prepare($sql);
       $statement->execute();
       $categories = $statement->fetchAll();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>New Cheese</title>
</head>
<body>
    <h1>New Cheese</h1>
    <form action="new_cheese.php" method="post">
        <label for="name">Name</label>
        <input id="name" name="name">
        <label for"category_id">Category</label>
        <select id="category_id" name="category_id">
            <?php foreach($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach ?>
        </select>
        <input type="submit" value="New Cheese">
    </form>
    <p><a href="index.php">Back</a></p>
</body>
</html>