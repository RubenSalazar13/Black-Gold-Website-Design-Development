<?php
session_start();
include_once('function.php');
include('navbar.php');
//PULL THIS ONE!!!

//1 define constants
if ($_SERVER['HTTP_HOST'] == "localhost")
{
  define("HOST", "localhost");
  define("USER", "root");
  define("PASS", "");
  define("BASE", "user");
}
else
{
  define("HOST", "localhost");
  define("USER", "root");
  define("PASS", "");
  define("BASE", "blackoil");
}
//2 make a connection
  $con = mysqli_connect(HOST, USER, PASS, BASE);

if(isset($_POST['login'])) {
  $login = $_POST['login'];
  $email    = strip_tags($_POST['email']);
  $password = strip_tags($_POST['password']);

  $email = stripslashes($email);
  $password = stripcslashes($password);

  $email = mysqli_real_escape_string($con, $email);
  $password = mysqli_real_escape_string($con, $password);

  $salt = "rumpel".$password."stiltskin";
 
  $hashed = hash('SHA512', $salt);

  $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$hashed'";
  $query = mysqli_query($con, $sql);
//print_r($_POST);

if(mysqli_num_rows($query) > 0)

{
  //Records matched process further
  $_POST['email'] = $email;
  $_POST['password'] = $hashed;

  isAllowed($email);
  $_SESSION['login'] = $login;
  $_SESSION['email'] = $email;

  $row = $query->fetch_assoc();
  $cust_id = $row['Customer_ID'];
  // create a session, direct to the portal page
  $_SESSION['Customer_ID'] = $cust_id;
  header('location: portal.php');
  exit;
  
 } else {
    echo "<h1>You're Credentials Are Incorrect, Please Try Again...</h1>";
    }
  } 

// Display Error
if( isset($_GET['error'])) {
 echo "<span style='color:red;text-align:center;font-size:55px;''>Please, Log in!</span>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <style>
      .login-content{
        border: 5px solid #FFFF00;
        padding: 50px 0;
        text-align: center;
      }
      input[type=text][type=password]{
        width: 50%;
        text-align: left;
        }
  </style>
</head>
<body>
    <div class="login-content">
      <form method="POST" action="login.php" enctype="multipart/form-data">
        <h2 class="title">Welcome!</h2>
            <h2>Please, Log In</h2>
              <div class="input-div one">
                 <div class="div">
                    <h5>Email</h5>
                    <input type="text" name="email" class="input">
                 </div>
              </div>
              <div class="input-div pass">
                 <div class="i"> 
                    <i class="fas fa-lock"></i>
                 </div>
                 <div class="div">
                    <h5>Password</h5>
                    <input type="password" name="password" type="password" placeholder="" class="input">
                 </div>
              </div>
              <a href="create-account.php">Create Account</a>
              <br>
              <input type="submit" class="btn" value="login" name="login">
            </form>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
   <footer>
     <?php include('footer.php'); ?>
   </footer>	
</body>
</html>