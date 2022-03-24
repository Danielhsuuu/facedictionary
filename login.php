<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='style.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
    <a href = "signup.php" class = "toplinks">Sign Up</a>
    <a href = "login.php" class = "toplinks">Logging In</a>
    <a href = "index.php" class = "toplinks">Read Intro</a>
    <?php
//log in page
?>
    <form action = "loginhandler.php" method = "post" class = "content" id = "loginc">

        <div class = "inputsmth">
            <label for = "username">Username</label>
            <input type = "text" name = "username" id = "username">
        </div>

        <div class = "inputsmth">
            <label for = "password">Password</label>
            <input type = "password" name = "password" id = "password">
        </div>
        <input type="submit" value = "Log In" class = "links">
        
    </form>
</body>
</html>