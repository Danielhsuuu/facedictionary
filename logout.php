<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='style.css' rel='stylesheet'>
    <?header('Refresh: 0; url=index.php');?>
</head>
<body>
    <h1>Logging Out...</h1>
    <?php
    //clear session and logout
    session_start();
    session_destroy();
    ?>
</body>
</html>