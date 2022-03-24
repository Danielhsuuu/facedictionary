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
//this file is for posting posts
?>
    <a href = "poststuff.php" class = "toplinks">Posting</a>
    <a href = "profilepage.php" class = "toplinks">Go to Profile</a>
    <form action = "posthandler.php" method = "post" class = "content" id = "loginc" enctype="multipart/form-data">

        <div class = "inputsmth">
            <label for = "image">Post an Image</label>
            <input type = "file" name = "image" id = "image">
        </div>

        <div class = "inputsmth">
            <label for = "des">Write Description</label>
            <input type = "text" name = "des" id = "des">
        </div>
        <input type="submit" value = "Post" class = "links">
        
    </form>
</body>
</html>