<?php

?>
<!DOCTYPE html>
<html>
<body>
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <link rel="stylesheet" href="css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@300&family=Playfair+Display&family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php include('navbar.php'); ?>

<div class="log-in">
    <h1 class="Fleet">Fleet Customers</h1>
        <h2 class="check">Check Status</h2>
    <form method="post" action="login.php" enctype="multipart/form-data">
    <label for="email"></label>
    <input type="email" id="email" name="email" placeholder="Email" required>
    <br>
    <label for="password"></label>
    <input type="password" name="password" placeholder="Password" id="password" required>
        <br>
    <input type="submit" value="Submit">
  </form>
</div>
        <footer>
         <?php include('footer.php'); ?>
        </footer>
    </body>
</html> 