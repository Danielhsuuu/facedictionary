<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='style.css' rel='stylesheet'>

</head>
<body>
    <?php
    //store the variables that are posted through login.php
    $username = $_POST["username"];
    $password = $_POST["password"];

    //add slashes so that apostrophies will not crash the program
    $username = addslashes($username);
    $password = addslashes($password);

    //connect to database
    require_once "connect.php";

    //query used to get the username that matches user input
    $Prepare = $conn->prepare("SELECT * FROM users WHERE username = ?");

    $Prepare->bindParam(1, $username);
    $Prepare->execute();

    session_start();
    //$ok is the boolean variable used to indicate whether there is a login-able account
    $ok = 0;
    while ($row = $Prepare->fetch()) {
        $un = $row["username"];
        $pw = $row["password"];
        $ui = $row["userID"];
        $email = $row["email"];
        if ($un == $username && password_verify($password, $pw)) {
            echo "<br><br><br>";
            echo "<a href = profilepage.php class = 'links'>Go To Your Profile Page</a>";

            $_SESSION["username"] = "$username";
            $_SESSION["email"] = "$email";
            $_SESSION["userID"] = "$ui";
            $ok = 1;
            break;
        }
    }
    //if there is no matching username to the inputted text, or the password is incorrect, display the following text
    if (!$ok) {
        echo "username or password is incorrect";
    }

