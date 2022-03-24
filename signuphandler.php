<html>
    <head>
        <link href='style.css' rel='stylesheet'>
        <?header('Refresh: 1.5; url=profilepage.php');?>
    </head>
    
    <body>
      <?php
      //this page is a handler for signup.php

      $username = $_POST["username"];
      $email = $_POST["email"];
      $password = $_POST["password"];

      //add slashes to make sure apostrophies don't cause any problem
      $username = addslashes($username);
      $email = addslashes($email);
      $password = addslashes($password);

      //hashing password
      $hashedpassword = password_hash($password, PASSWORD_BCRYPT);

      //connect to database
      require_once "connect.php";

      echo "<br>";

      //this query is used to check if there is a duplicate username
      $Prepare = $conn->prepare("SELECT * FROM users WHERE username = ?");
      $Prepare->bindParam(1, $username);
      $Prepare->execute();
      $t = 1;

      while ($row = $Prepare->fetch()) {
          $t = 0;
      }

      //if the inputted username has not been taken, let the user sign up
      if ($t == 1) {
          $sql = "INSERT INTO `users` (username, email, password) Values ('$username' , '$email', '$hashedpassword')";
          $conn->exec($sql);

          $Prepare = $conn->prepare("SELECT * FROM users WHERE username = ?");
          $Prepare->bindParam(1, $username);
          $Prepare->execute();
          $ui = "2";

          while ($row = $Prepare->fetch()) {
              $ui = $row["userID"];
          }

          echo "<form>";

          echo "Redirecting to Profile page......";

          echo "<br>";
          echo "<br>";
          echo "</form>";

          session_start();

          $_SESSION["username"] = "$username";
          $_SESSION["email"] = "$email";
          $_SESSION["userID"] = "$ui";

          echo $_SESSION["username"];
          echo $_SESSION["email"];

          echo "<br>";
      } else {
          //if the username is taken, display the following
          echo "<h2>Don't sign up multiple times! I'm trying to keep my database clean!</h2><br>";
          echo "<a class = 'links' href = signup.php>Sign Up Again</a>";
      }
      ?>



  </body>
</html>
