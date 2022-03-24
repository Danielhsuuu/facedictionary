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
    //this file works exactly the same as followedby.php it's just that the user is now the one following people. Go to that file for reference.
    require_once "connect.php";
    require_once "postandsessionstuff.php";

    $Prepare = $conn->prepare(
        "SELECT `followedID` FROM `follow` WHERE `followerID` = ?"
    );
    $Prepare->bindParam(1, $ui);
    $Prepare->execute();

    $followingppl = [];
    $t = 0;

    while ($row = $Prepare->fetch()) {
        $t = 1;
        $followingppl[] = intval($row["followedID"]);
    }

    if ($t == 0) {
        echo "<a href = 'profilepage.php' class = 'toplinks'>Go Back to Your Profile Page</a>";
        echo "<h1>You haven't followed anyone</h1>";
    } else {
        $followingpplsqlarr = implode(",", $followingppl);

        $followingpplsqlarr = "(" . "$followingpplsqlarr" . ")";

        echo "<br>";

        echo "<h1>Viewing your followings</h1>";

        echo "<a href = 'profilepage.php' class = 'toplinks'>Go Back to Your Profile Page</a>";
        $result = $conn->query(
            "SELECT * FROM users WHERE userID IN $followingpplsqlarr"
        );

        while ($row = $result->fetch()) {
            $sun = $row["username"];
            $sui = $row["userID"];
            $pfp = $row["profilepic"];
            $_SESSION["sui"] = $sui;
            if ($sui != $ui) { ?>
        <div class = "posts">
        <form action = "searchresult.php" method = "post">
                <img class = "pfp" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(
                    $pfp
                ); ?>" />
                <?php
                echo "<input type='hidden' id = 'sun' name='sun' value='$sun'>";
                echo "<input type='hidden' id = 'sui' name='sui' value='$sui'>";
                echo "<input type='submit' value = '$sun' class = 'searchpplname'>";
                echo "<br><br><br>";
                ?>
        </form>
        <form class = "formbutton" action = "" method = "post">
            <input type = "hidden" id = "followerID" name = "followerID" value = <?php echo "$ui"; ?>>
            <input type = "hidden" id = "followedID" name = "followedID" value = <?php echo "$sui"; ?>>
            <input type = 'submit' class = 'toplinks' value = 'Unfollow' name = "unfollowbutton">
        </form>
        </div>

        
    <?php }
        }
    }
    ?>

</body>
</html>

