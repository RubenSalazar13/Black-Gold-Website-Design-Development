<?php
session_start();
//PULL THIS ONE!!!
include('navbar.php');
include('include/states.php');

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

?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <link href="css/style.css" type="text/css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <script src="js/name.js"></script>
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

     <?php
     /*if ($msg != "") echo $msg . "<br><br>"; */
     if(!isset($_GET['s']) || $_GET['s'] != "true") :?>

      <form action="?s=true" method="post">
        <h2 class="title">Please Create an Account</h2>
              <div class="input-div one">
                 <div class="i">
                    <i class="fas fa-user"></i>
                 </div>
                 <label>First Name :</label>
                  <input type="text" name="First_Name" required placeholder="Please Enter First Name"/><br><br>
                  <label>Last Name :</label>
                  <input type="text" name="Last_Name" required placeholder="Please Enter Last Name"/><br><br>
                  <label>Address :</label>
                  <input type="text" name="address" required placeholder="Please Enter Your Address"/><br><br>
                  <label>City :</label>
                  <input type="text" name="city" required placeholder="Please Enter Your City"/><br><br>
                  <label>State :</label>
                  <select id="state" name="state" class="your-select">
                      <option name="state" id="state" selected="selected">Choose Your State</option>
                    <?php

                    // Iterating through the product array
                    foreach($states as $key => $value)
                        {   

                            echo "<option value='$value'>$value</option>";
                        }
                    ?>
                  </select>
                  <label>Zip :</label>
                  <input type="text" name="zip" required placeholder="Please Enter Your Zip"/><br><br>
                 <div class="div">
                    <h5>email</h5>
                    <input type="text" name="email" class="input" required>
                 </div>
              </div>
              <div class="input-div pass">
                 <div class="i"> 
                    <i class="fas fa-lock"></i>
                 </div>
                 <div class="div">
                    <h5>Password</h5>
                    <input oninput="validate(this);" name="password" id="password" type="password" class="input" required="">
                   </div>
                </div>
                <input type="submit" id="sub-but" class="btn" value="Create Account" name="newlogin">
            </form>
          <?php else :
        if (isset($_POST['email']) && $_POST['email'] !="" && isset($_POST['password']))
        {
  $FirstName = strip_tags($_POST['First_Name']);
  $LastName  = strip_tags($_POST['Last_Name']);
  $Address   = strip_tags($_POST['address']);
  $City      = strip_tags($_POST['city']);
  $State     = strip_tags($_POST['state']);
  $Zip       = strip_tags($_POST['zip']);
  $email     = strip_tags($_POST['email']);
  $password  = strip_tags($_POST['password']);

  $FirstName = stripslashes($FirstName);
  $LastName = stripslashes($LastName);
  $Address = stripslashes($Address);
  $City = stripslashes($City);
  $State = stripslashes($State);
  $Zip = stripslashes($Zip);
  $email = stripslashes($email);
  $password = stripcslashes($password);

  $FirstName = mysqli_real_escape_string($con, $FirstName);
  $LastName = mysqli_real_escape_string($con, $LastName);
  $Address = mysqli_real_escape_string($con, $Address);
  $City = mysqli_real_escape_string($con, $City);
  $State = mysqli_real_escape_string($con, $State);
  $Zip = mysqli_real_escape_string($con, $Zip);
  $email = mysqli_real_escape_string($con, $email);
  $password = mysqli_real_escape_string($con, $password);

          $salt = "rumpel".$password."stiltskin";
         
          $hashed = hash('SHA512', $salt);

          $sql = "SELECT * FROM user WHERE email='$email'";
          $sql2 = "INSERT INTO user (First_Name, Last_Name, address, city, state, zip, email, password) VALUES ('$FirstName', '$LastName', '$Address', '$City', '$State', '$Zip', '$email', '$hashed');";
          $checkuser = mysqli_query($con,$sql);
         if (mysqli_num_rows($checkuser) > 0) {
          //header('location: create-account.php');\
          echo "<h2>User Name is Already in Use,Choose Another</h2>";
                  	?>
            <form action="create-account.php" method="post">      	
         	<div class="errorbutton"><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <input type="submit" class="btn" value="Retry" name="return">
                 </div>
              </div>
          </form>
         	<?php
         }else {
          mysqli_query($con,$sql2);
          header('location: login.php');
          }
        }
        
        endif;
        ?>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>