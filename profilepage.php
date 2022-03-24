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
    //this file is the user's profile page.

    //connect to database
    require_once "connect.php";

    //refer to this file itself for what it does
    require_once "postandsessionstuff.php";

    echo "<h2>Welcome, $un</h2>";

    //get and store variables from the users table where userID matches the currently logged in user's userID
    $result = $conn->query("SELECT * FROM users where userID = $ui");
    ?>
    <?php while ($row = $result->fetch()) { ?> 
      <div>
        <img class = "pfp" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(
            $row["profilepic"]
        ); ?>" /> 
      </div>
    <?php } ?> 
    <?php
    echo "<br>";

    //get and store variables from the posts table where userID matches the currently logged in user's userID, in the order the they are posted
    $result = $conn->query(
        "SELECT * FROM posts where posterID = $ui order by postID DESC"
    );
    echo "<br>";

    //links to all basic functions of the site
    echo "<a href = 'homepage.php' class = 'toplinks'>Homepage</a>
          <a href = 'poststuff.php' class = 'toplinks'>Post Stuff</a>
          <a href = 'logout.php' class = 'toplinks'>Log Out</a>
          <a href = 'searchppl.php' class = 'toplinks'>Search People</a>
          <a href = 'postpfp.php' class = 'toplinks'>Upload a Profile Picture</a>
          <a href = 'following.php' class = 'toplinks'>Following</a>
          <a href = 'followedby.php' class = 'toplinks'>Followed By</a>
          <a href = 'seeliked.php' class = 'toplinks'>See Liked Posts</a></div>";
    ?>

    <?php //show the posts that we get from $result
    require_once "showposts.php"; ?>
</body>
</html>