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
    //this file is the user's homepage, where their followers' posts will be displayed.
    require_once "connect.php";
    require_once "postandsessionstuff.php";

    //query for follower-followed relationships where the currently logged in user is the follower
    $Prepare = $conn->prepare(
        "SELECT `followedID` FROM `follow` WHERE `followerID` = ?"
    );
    $Prepare->bindParam(1, $ui);
    $Prepare->execute();

    //create an array that will then contain a list of people followed by the currently logged in user
    $followingppl = [];

    //the array will be filled in with the id of users followed by the currently logged in user
    while ($row = $Prepare->fetch()) {
        $followingppl[] = intval($row["followedID"]);
    }

    //create a string that will be used to search for posts that will be displayed in the homepage
    $followingpplsqlarr = implode(",", $followingppl);

    $followingpplsqlarr = "(" . "$followingpplsqlarr" . ")";

    echo "<h1>HomePage</h1>";

    echo "<a href = 'profilepage.php' class = 'toplinks'>Go Back to Your Profile Page</a>";
    $result = $conn->query(
        "SELECT * FROM posts WHERE posterID IN $followingpplsqlarr"
    );
    //show the posts that meet our requirement of being posted by users that are followed by the currently logged in user.
    require_once "showposts.php";
    ?>
</body>
</html>
