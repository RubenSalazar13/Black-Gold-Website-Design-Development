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
  <h1 class="appointment">Make an Appointment</h1>
  <div class="scedule">
</head>
<body>
  <center>
<form action="" method="post">
<label>First Name :</label>
<input type="text" name="First_Name" required placeholder="Please Enter First Name"/><br><br>
<label>Last Name :</label>
<input type="text" name="Last_Name" required placeholder="Please Enter Last Name"/><br><br>
<label>Email   :</label>
<input type="email" name="email" required placeholder="Email"/><br><br>
<label>Address :</label>
<input type="text" name="address" required placeholder="Please Enter Your City"/><br><br>

  <br>
    <input type="submit" value=" Submit Details " name="submit"/><br />
</form>
</div>
  </form>
</div>
        <footer>
        <?php include('footer.php'); ?>
        </footer>
    </body>
</html> 

<?php 
if(isset($_POST["submit"])){
include 'SQLConnect.php';

$sql = "INSERT INTO user (First_Name, Last_Name, email, address)
VALUES ('".$_POST["First_Name"]."','".$_POST["Last_Name"]."','".$_POST["email"]."','".$_POST["address"]."')";

if ($conn->query($sql) === TRUE) {
echo "
    <script type= 'text/javascript'>
        alert('New record created successfully');
    </script>";
} 
else 
{
    echo 
    "<script type= 'text/javascript'>
        alert('Error: " . $sql . "<br>" . $conn->error."');
    </script>";
}

$conn->close();
}
?>