<?php 
session_start();
//Connect to the database
//Has to be changed, this version is for my localhost
print_r($_POST);
require_once 'dblogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "select * from user where Email='$email' AND Password='$password'";

    $result = $conn->query($sql);
    if(!$result) die($conn->error);

    if($result->num_rows==1){
        echo 'You have successfully logged in';
        $row = $result->fetch_assoc();
        $cust_id = $row['Customer_ID'];
        // create a session, direct to the portal page
        $_SESSION['customerID'] = $cust_id;
        header('Location: portal.php');
        exit;
    }
    else{
        echo 'You have entered incorrect password';
        exit();
    }
}
?>
<html>
    <head>
        <title>Log In</title>
    </head>
    <body>
        <form method='POST' action='#'>
            <input name='email' type='email' placeholder='Enter your email'>
            <input name='password' type='password' placeholder='Enter your password'>
            <input name='submit' type='submit' value='LOG IN'>
        </form>
    </body>
</html>