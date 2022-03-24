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
//the user search for other users with username here
?>
    <a href = "logout.php" class = "toplinks">Log Out</a>
    <a href = 'profilepage.php' class = 'toplinks'>Go Back to Your Profile Page</a>
    <form action = "searchlist.php" method = "post" class = "content" id = "loginc">

        <div class = "inputsmth">
            <label for = "sun">Look for People</label>
            <input type = "text" name = "sun" id = "sun">
        </div>

        <input type="submit" value = "Search" class = "links">
        
    </form>
</body>
</html>