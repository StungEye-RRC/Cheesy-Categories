<?php
    define('DB_DSN','mysql:host=localhost;dbname=cheesy-categories;charset=utf8');
    define('DB_USER','serveruser');
    define('DB_PASS','gorgonzola7!');

    // Create a PDO object called $db.
    try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        // Display a nice error page.
        // Send the project admin an email.
        die("Error: " . $e->getMessage());
    }
?>