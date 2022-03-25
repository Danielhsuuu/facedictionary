<?php
//connect to database
try {
    $conn = new PDO(
        "mysql:host=us-cdbr-east-05.cleardb.net;dbname=heroku_f0db736d53d1f30",
        "bc613a7128a228",
        "c11e1770"
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
