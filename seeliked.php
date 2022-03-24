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
    //this page displays posts that the currently logged in user has liked

    //connect to database
    require_once "connect.php";

    //refer to this file itself for what it does
    require_once "postandsessionstuff.php";

    //get a list of likes that the user has clicked
    $Prepare = $conn->prepare("SELECT * FROM `likes` WHERE `likerID` = ?");
    $Prepare->bindParam(1, $ui);
    $Prepare->execute();

    //create an array that will contain postIDs of posts that the user liked
    $likedposts = [];

    //fill array with postIDs from the query above
    while ($row = $Prepare->fetch()) {
        $likedposts[] = intval($row["postID"]);
    }

    //this string is what we will use in an sql statement to look for posts that the user liked
    $likedpostssqlarr = implode(",", $likedposts);

    $likedpostssqlarr = "(" . "$likedpostssqlarr" . ")";

    echo "<h1>Viewing Posts You Liked</h1>";

    echo "<a href = 'profilepage.php' class = 'toplinks'>Go Back to Your Profile Page</a>";

    //get a list of posts where their postID can be found in $likedpostssqlarr
    $result = $conn->query(
        "SELECT * FROM posts WHERE postID IN $likedpostssqlarr"
    );

    //show posts
    require_once "showposts.php";
    ?>
    
</body>
</html>
