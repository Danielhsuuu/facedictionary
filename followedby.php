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
    require_once "connect.php";
    require_once "postandsessionstuff.php";

    //make a query for users that follow the currently logged in user
    $Prepare = $conn->prepare(
        "SELECT `followerID` FROM `follow` WHERE `followedID` = ?"
    );
    $Prepare->bindParam(1, $ui);
    $Prepare->execute();

    //create an array that is going to contain users that follow the currently logged in user. t stands for whether or not there is at least one follower
    $followingppl = [];
    $t = 0;

    while ($row = $Prepare->fetch()) {
        $followingppl[] = intval($row["followerID"]);
        $t = 1;
    }

    //if there is no follower, say there is no follower
    if ($t == 0) {
        echo "<a href = 'profilepage.php' class = 'toplinks'>Go Back to Your Profile Page</a>";
        echo "<h1>No Follower</h1>";
    } else {
        //if there is at least one follower, display them

        //followingpplsqlarr is the array we are going to use in sql code to fetch for users that follow currently logged in user
        $followingpplsqlarr = implode(",", $followingppl);

        $followingpplsqlarr = "(" . "$followingpplsqlarr" . ")";

        echo "<br>";

        echo "<h1>Viewing your followers</h1>";

        echo "<a href = 'profilepage.php' class = 'toplinks'>Go Back to Your Profile Page</a>";
        //query for users who are in our list
        $result = $conn->query(
            "SELECT * FROM users WHERE userID IN $followingpplsqlarr"
        );

        while ($row = $result->fetch()) {
            //get variables from the database
            $un = $row["username"];
            $sui = $row["userID"];
            $pfp = $row["profilepic"];
            $_SESSION["sui"] = $sui;
            if ($sui != $ui) { ?>
        <div class = 'posts'>
            <?php
                //this works similarly to the search function, so they share the same file. basically the user would visit the person following them by clicking on this follower's name
                ?>
        <form action = "searchresult.php" method = "post">
                
                <img class = "pfp" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(
                    $pfp
                ); ?>" />
                <?php
                echo "<input type='hidden' id = 'un' name='un' value='$un'>";
                echo "<input type='hidden' id = 'ui' name='ui' value='$sui'>";
                echo "<input type='submit' value = '$un' class = 'searchpplname'>";
                echo "<br><br><br>";
                ?>
            
        </form>
        
            <?php
                //the user can make this person unfollow them
                ?>
        <form class = "formbutton" action = "" method = "post">
            <input type = "hidden" id = "followerID" name = "followerID" value = <?php echo "$sui"; ?>>
            <input type = "hidden" id = "followedID" name = "followedID" value = <?php echo "$ui"; ?>>
            <input class = "postbutton" type = "submit" value = "make this person unfollow me" id = "unfollow" name = "unfollowbutton">
          </form>
        </div>
            
    <?php }
        }
    }
    ?>
    
</body>
</html>

