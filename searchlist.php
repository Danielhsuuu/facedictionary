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
    //the user will reach this page after they search for a username in seachppl.php. This page will show a list of usernames that match the input.
    $sun = $_POST["sun"];

    //connect to database
    require_once "connect.php";

    //refer to this file itself for what it does
    require_once "postandsessionstuff.php";

    //query for usernames that are similar to the input given by the user
    $Prepare = $conn->prepare("SELECT * FROM `users` WHERE `username` like ?");
    $sun = "%" . $sun . "%";
    $Prepare->bindParam(1, $sun);
    $Prepare->execute();
    $t = 0;
    $sui = 0;
    echo "<a href = 'searchother.php' class = 'toplinks'>Search More People</a>
              <a href = 'profilepage.php' class = 'toplinks'>Go Back to Your Profile Page</a>";

    //$t is whether or not there is at least one similar username
    while ($row = $Prepare->fetch()) {
        $t = 1;
    }

    //if there is no match, display so
    if ($t == 0) {
        echo "no match found!";
    } else {
        //if there is at least one match, display them.
        $Prepare = $conn->prepare(
            "SELECT * FROM `users` WHERE `username` like ?"
        );
        $Prepare->bindParam(1, $sun);
        $Prepare->execute();
        while ($row = $Prepare->fetch()) {
            $sun = $row["username"];
            $sui = $row["userID"];
            $pfp = $row["profilepic"];
            //the currently logged in user can not search for themself.
            if ($sui != $ui) { ?>
          <?php
                //click a username to go to its user's profile page
                ?>
            <form action = "searchresult.php" method = "post">
              <div class = "posts">
                <img class = "pfp" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(
                    $pfp
                ); ?>" />
                <?php
                echo "<input type='hidden' id = 'sun' name='sun' value='$sun'>";
                echo "<input type='hidden' id = 'sui' name='sui' value='$sui'>";
                echo "<input type='submit' value = '$sun' class = 'searchpplname'>";
                ?>
              </div>
            </form>
            <?php }
        }
    }
    ?>
    
</body>
</html>

