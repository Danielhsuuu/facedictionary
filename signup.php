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
    <?php
//the user signs up using this page
?>
    <a href = "signup.php" class = "toplinks">Signing Up</a>
    <a href = "login.php" class = "toplinks">Log In</a>
    <a href = "index.php" class = "toplinks">Read Intro</a>
    <form action = "signuphandler.php" method = "post" class = "content" id = "signinc">
        <?php
//the user inputs username
?>
        <div class = "inputsmth">
            <label for = "username">Username</label>
            <input type = "text" name = "username" id = "username">
        </div>
        
        <?php
//the user inputs email
?>
        <div class = "inputsmth">
            <label for = "email">Email</label>
            <input type = "email" name = "email" id = "email">
        </div>

        <?php
//the user inputs password
?>
        <div class = "inputsmth">
            <label for = "password">Password</label>
            <input type = "password" name = "password" id = "password">
        </div>
        
        <?php
//submit the form and sign up
?>
        <input type="submit" value = "Sign Up" class = "links">
        
    </form>

</body>
</html>

