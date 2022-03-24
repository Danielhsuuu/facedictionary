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
    //this file is for individual post page.

    //connect to database
    require_once "connect.php";

    //refer to this file itself for what it does
    require_once "postandsessionstuff.php";

    echo "<a href = 'profilepage.php' class = 'toplinks'>Go Back to Your Profile Page</a>";

    //query for the post that matches the postID, which is already "posted" to this file and stored into a variable, see postandsessionstuff.php
    $result = $conn->query("SELECT * FROM posts WHERE postID = $postID");

    //the showpost.php file is not required here because this page needs slightly more functions than other pages that show posts do, such as showing who liked this post, and showing comments
    while ($row = $result->fetch()) {

        //store variables we get from the query
        $posterID = $row["posterID"];
        $postID = $row["postID"];
        $postpic = $row["postpic"];

        //this query is used to get the post's poster's username
        $result2 = $conn->query("SELECT * FROM users WHERE userID = $posterID");

        $postername = " ";
        while ($row2 = $result2->fetch()) {
            $postername = $row2["username"];
            $pfp = $row2["profilepic"];
        }

        //this query is used to get whether this post is liked by the currently logged in user.
        $result3 = $conn->query(
            "SELECT * FROM `likes` where `postID` = $postID AND `likerID` = $ui"
        );
        $liked = 0;
        while ($row2 = $result3->fetch()) {
            $liked = 1;
        }

        //this query is used to get comments to the post, more recent onces first
        $result4 = $conn->query(
            "SELECT * FROM `comments` where `postID` = $postID ORDER BY `commenttime` DESC"
        );

        //this query is used to get the likes to this post
        $result6 = $conn->query(
            "SELECT * FROM `likes` where `postID` = $postID"
        );

        //create an array that will contain userID of users that liked the post
        $likedppllist = [];

        //fill the array with the userIDs of people that liked the post
        while ($row6 = $result6->fetch()) {
            $likedppllist[] = intval($row6["likerID"]);
        }

        //$likedpplcount stands for the number of users that liked this post
        $likedpplcount = sizeof($likedppllist);

        //this string will be used in our query for users that liked the post
        $likedpplstring = implode(",", $likedppllist);
        $likedpplstring = "(" . "$likedpplstring" . ")";

        //if there is at least one user that liked the post, get those users from the users table
        if ($likedpplcount != 0) {
            $result7 = $conn->query(
                "SELECT * FROM `users` WHERE `userID` IN $likedpplstring"
            );
        }

        //the post itself
        ?>
        <div class = "posts">
            <h3><?php echo $postername; ?></h3>
            <img class = "pfppost" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(
                $pfp
            ); ?>" />
            <br>
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(
                $postpic
            ); ?>" /> 
            <p class = "descriptions"><?php echo $row["description"]; ?></p>
            
            <?php
        //if the currently logged in user has not liked this post before, show the like button. Otherwise, show the unlike button
        ?>
            <?php if ($liked == 0) { ?>
                <form class = "formbutton" action = "" method = "post">
                    <input type = "hidden" id = "postID" name = "postID" value = <?php echo "$postID"; ?>>
                    <input class = "postbutton" type = "submit" value = "like" id = "like" name = "likebutton">
                </form>
            <?php } else { ?>
                <form class = "formbutton" action = "" method = "post">
                    <input type = "hidden" id = "postID" name = "postID" value = <?php echo "$postID"; ?>>
                    <input class = "postbutton" type = "submit" value = "unlike" id = "unlike" name = "unlikebutton">
                </form>
            <?php } ?>
              
            <?php
        //the user can comment on the post here by typing their comment and clicking submit
        ?>
                <form class = "formbutton" action = "" method = "post">
                    <input class = "postbutton" type = "text" id = "commenttxt" name = "commenttxt" placeholder = "comment here!">
                    <input type = "hidden" id = "postID" name = "postID" value = <?php echo "$postID"; ?>>
                    <input class = "postbutton" type = "submit" value = "comment" name = "commentbutton">
                </form>

                <?php
        //if there is at least one user that liked the post, display them. Otherwise, say no one liked this post
        ?>
                <?php if ($likedpplcount != 0) { ?>
                    <p>liked by </p>
                    <?php while ($row7 = $result7->fetch()) { ?>
                        <p> <?php echo $row7["username"] . " "; ?> </p>
                    <?php }} else {echo "<p>no one liked this post</p>";} ?>


                <?php
                //display the comments
                echo "<h3>Comments</h3>";
                while ($row2 = $result4->fetch()) {

                    //store variables from the comments table
                    $commentID = $row2["commentID"];
                    $commenterID = $row2["commenterID"];
                    $comment = $row2["comment"];
                    $commenttime = $row2["commenttime"];

                    //query for the commenter's information
                    $result5 = $conn->query(
                        "SELECT * FROM `users` where `userID` = $commenterID"
                    );
                    $commenterun = "user";
                    while ($row3 = $result5->fetch()) {
                        $commenterun = $row3["username"];
                        $upfp = $row3["profilepic"];
                    }
                    ?> 
                        <img class = "pfppost" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(
                            $upfp
                        ); ?>" />
                        <h4 class = "commenter"><?php echo "$commenterun" .
                            " commented at " .
                            "$commenttime"; ?></h4>
                        <h4 class = "comment" ><?php echo "$comment"; ?></h4> 
                        <?php
                    //if the currently logged in user commented this comment, they will be allowed to edit or delete the comment
                    ?>
                        <?php if ($ui == $commenterID) { ?>
                                <form class = "formbutton" action = "" method = "post">
                                    <input type = "hidden" value = <?php echo "$commentID"; ?> name = "commentID" id = "commentID">
                                    <input type = "text" class = "descriptions" name = "editedcomment" id = "editedcomment">
                                    <input type = "hidden" value = <?php echo "$postID"; ?> name = "postID" id = "postID">
                                    <input class = "postbutton" type = "submit" value = "edit" name = "editbutton">
                                </form>
                                <form class = "formbutton" action = "" method = "post">
                                    <input type = "hidden" value = <?php echo "$commentID"; ?> name = "commentID" id = "commentID">
                                    <input type = "hidden" value = <?php echo "$postID"; ?> name = "postID" id = "postID">
                                    <input class = "postbutton" id = "unlike" type = "submit" value = "delete" name = "deletebutton">
                                </form>
                        <?php } ?>
                        <br>
                        <br>
                        <?php
                }
                ?>

            </div>
    <?php
    }
    ?>

</body>
</html>