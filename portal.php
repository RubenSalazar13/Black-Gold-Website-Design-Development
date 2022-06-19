<?php
//get the user id from the session
session_start();

include_once('function.php'); 

$id = $_SESSION['Customer_ID'];
$granted = false;
$message = "";

//Connect to the database
require_once 'dblogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$sql = "select * from user where Customer_ID='$id'";

$result = $conn->query($sql);
if(!$result) die($conn->error);

if($result->num_rows==1){
    $row = $result->fetch_assoc();
    $first_name = $row['First_Name'];
    $last_name = $row['Last_Name'];
    $address = $row['address'];
    $zip_code = $row['zip'];
    $state = $row['state'];
    $email_address = $row['email'];
}
// Check if the User is allowed
if (isset($_SESSION['login']))
{ 
  $email = $_SESSION['email'];

if($_SESSION['email'] == $email)
  {
    $_SESSION['granted'] = true;
  }
  //if(!$granted) $message = '<h1 class="Warning">Access Denied</h1>';
}

$show_personal_info = <<<END
<html>
Name: $first_name $last_name <br>
Address: $address <br>
Zip: $zip_code <br>
State: $state <br>
Email: $email_address 
<form method="post">
<input type="submit" name="update_personal_info"
        class="button" value="Update" />
</html>
END;

$change_personal_info = <<<END
<html>
<form method='post'>
    <label>First Name:
        <input type='text' name='firstName' value=$first_name>
    </label><br>
    <label>Last Name:
        <input type='text' name='lastName' value=$last_name>
    </label><br>
    <label>Address:
        <textarea rows="4" cols="50" name='address' >$address</textarea>
    </label><br>
    <label>Zip Code:
        <input type='text' name='zip' pattern='[0-9]*' value=$zip_code>
    </label><br>
    <label>State:
        <input type='text' name='state' value=$state>
    </label><br>
    <label>Email Address:
        <input type='email' name='email' value=$email_address>
    </label><br>
    <input type='submit' name='changed_personal_info' value='update'>
</form>
</html>
END;
?>
<!DOCTYPE html>
<html>
 <head>
 	<title>Black Oil Mobile</title>
<link rel="stylesheet" href="css/style.css">
<style>
    .Warning{
        background-color: red;
        color: white;
    }
</style>
</head>
<body>
    <main>
    	<?php if (!isset($_SESSION['granted'])) : ?>
        <?php include('navbar.php'); ?>
        <?php echo '<h1 class="Warning">Access Denied</h1>' ?>
           <br>
        <?php else : ?>
        <?php include('navbarLoggedIn.php');?>
        <h1>Welcome!</h1>
	    <form method="post">
        <input type="submit" name="personal_info"
                class="button" value="Personal Information" />
          
        <input type="submit" name="vehicles"
                class="button" value="Vehicles" />

        <input type="submit" name="appointments"
                class="button" value="Appointments" />
        <?php endif; ?>
    </form>
   </main>
  </div>
 </body>
</html>

<?php
    if(array_key_exists('personal_info', $_POST)) {
        echo "$show_personal_info";
    }
    else if(array_key_exists('vehicles', $_POST)) {
        vehicles();
    }
    else if(array_key_exists('appointments', $_POST)) {
        appointments();
    }

    if(array_key_exists('update_personal_info', $_POST)) {
        echo "$change_personal_info";
    }
    if(array_key_exists('changed_personal_info', $_POST)) {
        echo "Update successful!";
        $updated_first_name = $_POST['firstName'];
        $updated_last_name = $_POST['lastName'];
        $updated_address = $_POST['address'];
        $updated_zip_code = $_POST['zip'];
        $updated_state = $_POST['state'];
        $updated_email_address = $_POST['email'];
        $update_query = "UPDATE `user` SET `First_Name`='$updated_first_name',`Last_Name`='$updated_last_name',`address`='$updated_address',`zip`='$updated_zip_code',`state`='$updated_state',`email`='$updated_email_address' WHERE `Customer_ID`='$id'";
        $result = $conn->query($update_query);
        if(!$result) die($conn->error);
    }
?>
