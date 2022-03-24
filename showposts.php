<?php
//this file is required where we want to show posts. The file takes any sql query of posts called "$result" and display the posts that match the query

//this is the number of comments
$ncomments = 0;
while ($row = $result->fetch()) {

    //get and store information about the post
    $posterID = $row["posterID"];
    $postID = $row["postID"];
    $postpic = $row["postpic"];

    //this query gets information about the poster of the post
    $result2 = $conn->query("SELECT * FROM users WHERE userID = $posterID");
    $postername = " ";
    while ($row2 = $result2->fetch()) {
        $postername = $row2["username"];
        $pfp = $row2["profilepic"];
    }

    //this query is used to determine whether the currently logged in user has liked this post before
    $result3 = $conn->query(
        "SELECT * FROM `likes` where `postID` = $postID AND `likerID` = $ui"
    );
    $liked = 0;
    while ($row2 = $result3->fetch()) {
        $liked = 1;
    }

    //this query is used to set the number of comments of a post
    $result4 = $conn->query(
        "SELECT COUNT(commentID) as n FROM `comments` where `postID` = $postID"
    );
    $ncomments = $result4->fetchColumn();
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
    //if the currently logged in user has not liked this post, display the like button. Otherwise, display the unlike button
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
              <?php }
    //the user can comment here by typing the comment and clicking submit
    ?>      
              <form class = "formbutton" action = "" method = "post">
                    <input class = "postbutton" type = "text" id = "commenttxt" name = "commenttxt" placeholder = "comment here!">
                    <input type = "hidden" id = "postID" name = "postID" value = <?php echo "$postID"; ?>>
                    <input class = "postbutton" type = "submit" value = "comment" name = "commentsubmit" id = "commentsubmit">
              </form>
              
              <?php
    //the user can click on the block that shows the number of comments to go to the post's individual page
    ?>
              <form class = "formbutton" action = "postpage.php" method = "post">
                <input type = "hidden" id = "postID" name = "postID" value = <?php echo "$postID"; ?>>

             <br>
             <br>

              <input name = "submit" class = "postbutton" type = "submit" value = '<?php
              $myString = $ncomments . " Comments";
              echo $myString;
              ?>'>
</form>
              

            </div>
          <?php
} ?>
