<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='style.css' rel='stylesheet'>
    <title>FaceDictionary</title>
</head>
<body>
    <?php
    // logged in
    session_start();

    if (isset($_SESSION["username"])) {
        echo "<a href ='index.php' class = 'toplinks'>Reading Intro</a>Logout...button...";
    } else {
        echo "
        <a href = 'signup.php' class = 'toplinks'>Sign Up</a>
        <a href = 'login.php' class = 'toplinks'>Log In</a>
        <a href = 'index.php' class = 'toplinks'>Reading Intro</a>
        ";
    }

// not logged in
?>
    <div class = "content">
        <h1>FaceDictionary</h1>
        
        <h2>FaceDictionary is founded upon the ideal of </h2>
        <h2>collecting every single individual's information</h2>
        <h2>and make them available for the public.</h2>
        <h2>We envision to achieve our goal by 2050.</h2>
        <h2>Join us to emancipate humanity!</h2>
        <br>
        <br>
        <a href = "signup.php" class = "links">Join Us</a>

        <a href = "login.php" id = "login" class = "links">Return to the Cult</a>
    </div>


</body>
</html>
