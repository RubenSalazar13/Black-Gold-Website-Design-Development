<?php 
//get the user id from the session
session_start();
$id = $_SESSION['customerID'];

//Connect to the database
require_once 'dblogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$sql = "select * from customer where customerID='$id'";

$result = $conn->query($sql);
if(!$result) die($conn->error);

if($result->num_rows==1){
    $row = $result->fetch_assoc();
    $first_name = $row['FirstName'];
    $last_name = $row['LastName'];
    $address = $row['Address'];
    $zip_code = $row['ZIP'];
    $phone_number = $row['Phone'];
    $email_address = $row['Email'];
}

html =.    '<form id='personal_info' action='update.php'>';
html =.    '<label>First Name:';
html =.    '<input type='text' id='firstName' name='firstName' value=<?=$first_name?>>';
html =.    '</label>';
html =.    '<label>Last Name:';
html =.     '<input type='text' id='lastName' name='lastName' value=<?=$last_name?>>';
html =.      '</label>';
html =.     '<label>Address:';
html =.      '<input type='text' id='address' name='address' value=<?=$address?>>';
html =.      '</label>;'
html =.       '<label>Zip Code:';
html =.        '<input type='text' id='zip' name='zip' pattern='[0-9]*' value=<?=$zip_code?>>';
html =.  '</label>';
html =.   '<label>Phone Number:';
html =.    '<input type='text' id='phone' name='phone' pattern='[0-9]*' value=<?=$phone_number?>>';
html =.   '</label>';
html =.   '<label>Email Address:';
html =.    '<input type='email' id='email' name='email' value=<?=$email_address?>>';
html =.    '</label>';
html =.   '</form>';
?>
<!-- <html>
    <body>
        <!-- Personal Info 
        <h2>Personal Information</h2>
        <form id='personal_info' action='update.php'>
            <label>First Name:
                <input type='text' id='firstName' name='firstName' value=<?=$first_name?>>
            </label>
            <label>Last Name:
                <input type='text' id='lastName' name='lastName' value=<?=$last_name?>>
            </label>
            <label>Address:
                <input type='text' id='address' name='address' value=<?=$address?>>
            </label>
            <label>Zip Code:
                <input type='text' id='zip' name='zip' pattern='[0-9]*' value=<?=$zip_code?>>
            </label>
            <label>Phone Number:
                <input type='text' id='phone' name='phone' pattern='[0-9]*' value=<?=$phone_number?>>
            </label>
            <label>Email Address:
                <input type='email' id='email' name='email' value=<?=$email_address?>>
            </label>
<!-- </form> --> -->
        <!-- Vehicle Info -->
        <h2>Vehicle Information</h2>
        <!-- Appointment Info -->
        <h2>Appointment Information</h2>
    </body>
</html>