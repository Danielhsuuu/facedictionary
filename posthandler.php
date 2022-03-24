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
    <a href = "poststuff.php" class = "toplinks">Posted</a>
    <a href = "profilepage.php" class = "toplinks">Go to Profile</a>
    <br>
    <br>
    <br>
<?php
//this file handles poststuff.php. That is, inserting posts, which contain an image, the username of its poster, and some descriptions
$des = $_POST["des"];

//start session and get the userID from it
session_start();

$ui = $_SESSION["userID"];

//connect to database
require_once "connect.php";
$status = $statusMsg = "";
$status = "error";
if (!empty($_FILES["image"]["name"])) {
    $fileName = basename($_FILES["image"]["name"]);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

    //the following datatypes will be allowed for the post's image.
    $allowTypes = ["jpg", "png", "jpeg", "gif"];
    if (in_array($fileType, $allowTypes)) {
        $image = $_FILES["image"]["tmp_name"];
        $imgContent = addslashes(file_get_contents($image));

        $insert = $conn->query(
            "INSERT into `posts` (`postpic`, `posterID`,`description`) VALUES ('$imgContent', '$ui','$des')"
        );

        //if the file is successfully uploaded, display so. Otherwise, prompt the user to try again
        if ($insert) {
            echo "File uploaded successfully.";
        } else {
            echo "File upload failed, please try again.";
        }
    } else {
        //if the file gets something other than the types included in $allowTypes , display the following text
        echo "I want an image";
    }
} else {
    //if the file gets nothing, display the following text
    echo "Upload something!";
}
?>
</body>
</html>


