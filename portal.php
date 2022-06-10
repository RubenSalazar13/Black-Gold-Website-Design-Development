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

$show_personal_info = <<<END
<html>
Name: $first_name $last_name <br>
Address: $address <br>
Zip: $zip_code <br>
Phone: $phone_number <br>
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
        <input type='text' id='firstName' name='firstName' value=$first_name>
    </label><br>
    <label>Last Name:
        <input type='text' id='lastName' name='lastName' value=$last_name>
    </label><br>
    <label>Address:
        <input type='textarea' id='address' name='address' value=$address>
    </label><br>
    <label>Zip Code:
        <input type='text' id='zip' name='zip' pattern='[0-9]*' value=$zip_code>
    </label><br>
    <label>Phone Number:
        <input type='text' id='phone' name='phone' pattern='[0-9]*' value=$phone_number>
    </label><br>
    <label>Email Address:
        <input type='email' id='email' name='email' value=$email_address>
    </label><br>
    <input type='submit' name='changed_personal_info' value='update'>
</form>
</html>
END;
        
// function personal_info() {
//     echo 'Name: '.$name_new;
// }
// function button2() {
//     echo "This is Button2 that is selected";
// }
?>
  
    <form method="post">
        <input type="submit" name="personal_info"
                class="button" value="Personal Information" />
          
        <input type="submit" name="vehicles"
                class="button" value="Vehicles" />

        <input type="submit" name="appointments"
                class="button" value="Appointments" />
    </form>
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
        $updated_phone_number = $_POST['phone'];
        $updated_email_address = $_POST['email'];
        $update_query = "UPDATE `customer` SET `FirstName`='$updated_first_name',`LastName`='$updated_last_name',`Address`='$updated_address',`ZIP`='$updated_zip_code',`Phone`='$updated_phone_number',`Email`='$updated_email_address' WHERE `customerID`='$id'";
        $result = $conn->query($update_query);
        if(!$result) die($conn->error);
    }
?>