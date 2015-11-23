<?php
    require('db_connect.php');

    if ($_POST && isset($_POST['name'])) {
        $name  = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sql_insert  = "INSERT INTO categories (name) VALUES (:name)";
        $statement   = $db->prepare($sql_insert);
        $statement->bindValue('name', $name);
        $statement->execute();

        header('Location: index.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>New Category</title>
</head>
<body>
    <h1>New Category</h1>
    <form action="new_category.php" method="post">
        <label for="name">Name</label>
        <input id="name" name="name">
        <input type="submit" value="New Category">
    </form>
    <p><a href="index.php">Back</a></p>
</body>
</html>