<?php
//this file is required in many other files in this project. it sets variables to what we have in session or is submitted.
//this file is generally required in files that display posts and other information
@session_start();
//ui in this project stands for userID
$ui = $_SESSION["userID"];
//un is ui's associated username
$un = $_SESSION["username"];
//sui is used where we need a second userID different from ui
if (isset($_SESSION["sui"])) {
    $sui = $_SESSION["sui"];
}
//sun is sui's associated username
if (isset($_SESSION["sun"])) {
    $sun = $_SESSION["sun"];
}

//the following isset if statements are created to facilitate handling form submissions
if (isset($_POST["submit"])) {
    $postID = $_POST["postID"];
}

if (isset($_POST["unlikebutton"])) {
    $likerID = $ui;
    $postID = $_POST["postID"];
    $unlikepost = "DELETE FROM `likes` WHERE `likerID` = $ui AND `postID` = $postID;";
    $conn->exec($unlikepost);
}

if (isset($_POST["likebutton"])) {
    $likerID = $ui;
    $postID = $_POST["postID"];
    $likepost = "INSERT INTO `likes` (postID, likerID) Values ('$postID' , '$ui')";
    $conn->exec($likepost);
}

if (isset($_POST["commentsubmit"])) {
    $postID = $_POST["postID"];
    $commenttxt = $_POST["commenttxt"];

    $slashedcommenttxt = addslashes($commenttxt);

    $commentstuff = "INSERT INTO `comments` (postID, commenterID, comment) Values ('$postID' , '$ui', '$slashedcommenttxt')";
    $conn->exec($commentstuff);
}

if (isset($_POST["deletebutton"])) {
    $commentID = $_POST["commentID"];
    $postID = $_POST["postID"];
    $deletecomment = "DELETE FROM `comments` WHERE `commentID` = $commentID;";
    $conn->exec($deletecomment);
}

if (isset($_POST["editbutton"])) {
    $commentID = $_POST["commentID"];
    $editedcomment = $_POST["editedcomment"];
    $postID = $_POST["postID"];
    $editcomment = "UPDATE `comments` SET `comment` = '$editedcomment' WHERE `commentID` = '$commentID'";
    $conn->exec($editcomment);
}

if (isset($_POST["followbutton"])) {
    $followerID = $_POST["followerID"];
    $followedID = $_POST["followedID"];
    $followuser = "INSERT INTO `follow` (followerID, followedID) Values ('$ui' , '$sui')";
    $conn->exec($followuser);
}

if (isset($_POST["unfollowbutton"])) {
    $followerID = $_POST["followerID"];
    $followedID = $_POST["followedID"];
    $unfollowuser = "DELETE FROM follow WHERE followerID = $followerID AND followedID = $followedID;";
    $conn->exec($unfollowuser);
}
?>
