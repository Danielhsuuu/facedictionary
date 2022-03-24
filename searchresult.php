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
    //this file is another user's profile page. That is, any user that is not the currently logged in user.
    //get and set session variables for this other user
    $sun = $_POST["sun"];
    $sui = $_POST["sui"];
    session_start();
    $_SESSION["sun"] = $sun;
    $_SESSION["sui"] = $sui;

    //connect to databse
    require_once "connect.php";

    //refer to this file itself for what it does
    require_once "postandsessionstuff.php";

    //this query is used to determine whether the currently logged in user follows the owner of this profile page.
    $result2 = $conn->query(
        "SELECT * FROM `follow` where `followerID` = $ui AND `followedID` = $sui"
    );
    $f = 0;
    while ($row = $result2->fetch()) {
        $f = 1;
    }

    echo "<h1>Visiting $sun's Profile</h1><br>";

    //get this user's profile picture and posts posted by this user
    $pfpresult = $conn->query(
        "SELECT profilepic FROM users where userID = $sui"
    );

    $result = $conn->query("SELECT * FROM posts where posterID = $sui");
    ?>
        <?php while ($row = $pfpresult->fetch()) { ?> 
          <?php $pfp = $row["profilepic"]; ?>
          <div>
            <img class = "pfp" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(
                $pfp
            ); ?>" /> 
            
          </div>
        <?php } ?> 
        <?php
        echo "<br>";

        echo "<a href = 'searchother.php' class = 'toplinks'>Search More People</a>
              <a href = 'profilepage.php' class = 'toplinks'>Go Back to Your Profile Page</a>";

        //if the currently logged in user has not followed the owner of this profile page, display the follow button. Otherwise, display the unfollow button
        if ($f == 0) { ?>
          <form class = "formbutton" action = "" method = "post">
            <input type = "hidden" id = "followerID" name = "followerID" value = <?php echo "$ui"; ?>>
            <input type = "hidden" id = "followedID" name = "followedID" value = <?php echo "$sui"; ?>>
            <input class = "postbutton" type = "submit" value = "follow" id = "follow" name = "followbutton">
          </form>
        <?php } else { ?>
          <form class = "formbutton" action = "" method = "post">
            <input type = "hidden" id = "followerID" name = "followerID" value = <?php echo "$ui"; ?>>
            <input type = "hidden" id = "followedID" name = "followedID" value = <?php echo "$sui"; ?>>
            <input class = "postbutton" type = "submit" value = "unfollow" id = "unfollow" name = "unfollowbutton">
          </form>
        <?php }

        //show posts posted by this user
        require_once "showposts.php";
        ?>
        
</body>
</html>

