<?php
//connect to database
try {
    $conn = new PDO(
        "mysql:host=localhost;dbname=photo_sharing_app",
        "root",
        "Am03zw5jGnsdtElS"
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
