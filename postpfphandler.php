<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='style.css' rel='stylesheet'>
    
</head>
<body>
    <?php
//this file handles postpfp.php
?>
    <a href = "poststuff.php" class = "toplinks">Posted</a>
    <a href = "profilepage.php" class = "toplinks">Go to Profile</a>
    <br>
    <br>
    <br>
<?php

//get the currently logged in user's userID
session_start();
$ui = $_SESSION["userID"];

//connect to database
require_once "connect.php";

$status = $statusMsg = "";
$status = "error";
if (!empty($_FILES["image"]["name"])) {
    $fileName = basename($_FILES["image"]["name"]);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowTypes = ["jpg", "png", "jpeg", "gif"];
    if (in_array($fileType, $allowTypes)) {
        $image = $_FILES["image"]["tmp_name"];
        $imgContent = addslashes(file_get_contents($image));

        $insert = $conn->query(
            "UPDATE `users` SET `profilepic` = '$imgContent' WHERE `userID` = '$ui'"
        );

        if ($insert) {
            //if the profile picture is uploaded successfully, display so
            echo "File uploaded successfully.";
        } else {
            //if the upload is unsuccessful, prompt the user to try again
            echo "File upload failed, please try again.";
        }
    } else {
        //if the profile picture does not meet any of the datatypes mentioned in $allowTypes, tell the user we want an image
        echo "I want an image";
    }
} else {
    //if nothing is uploaded, tell the user to upload something
    echo "Upload something!";
}
?>
</body>
</html>


