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
//this file is for uploading profile pictures
?>
    <a href = "poststuff.php" class = "toplinks">Posting</a>
    <a href = "profilepage.php" class = "toplinks">Go to Profile</a>
    <form action = "postpfphandler.php" method = "post" class = "content" id = "loginc" enctype="multipart/form-data">

        <div class = "inputsmth">
            <label for = "image">Post a Profile Picture</label>
            <input type = "file" name = "image" id = "image">
        </div>
        
        <input type="submit" value = "Post" class = "links">
        
    </form>
</body>
</html>