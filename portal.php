<?php
//get the user id from the session
session_start();

//`Vehicle_Make`, `Vehicle_Year`, `Vehicle_Model`, `Sub_Model`, `Fuel_Type`, `Truck_Number`, `VIN`, `Engine`, `Oil_Change`, `Oil_Type`, `Oil_Capacity`, `Oil_FilterNumber`, `Air_Filter`, `Fuel_Filter`, `Water_Seperator`, `Cabin_Air_Filter`, `Wiper_Blade`, `Grease_Service`, `Comments`

include_once('function.php'); 


$id = $_SESSION['Customer_ID'];
$granted = false;
$message = "";

//Connect to the database
require_once 'dblogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$sql = "select * from user where Customer_ID='$id'";

$vehicle_sql = "select * from vehicle where Customer_ID='$id'";

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

$result2 = $conn->query($vehicle_sql);
if(!$result2) die($conn->error);

// increment this ++i
if($result2->num_rows > 0){
    //$row = $result2->fetch_assoc();
    foreach ($result2 as $row) {
        echo $row['Vehicle_Make']."<br />\n";
        echo $row['Vehicle_Year']."<br />\n";
    }
    // Vehicle info
//    $Vehicle_Make  = $row['Vehicle_Make'];
//    $Vehicle_Year  = $row['Vehicle_Year'];
//    $Vehicle_Model = $row['Vehicle_Model'];
//    $Sub_Model     = $row['Sub_Model'];
//    $Fuel_Type     = $row['Fuel_Type'];
//    $Truck_Number  = $row['Truck_Number'];

    $resulthtml = '';// //RESULT HEAD// //RESULT BODY
    $resulthtml .= '<table id="customers">';
    //RESULT ROWS
    foreach ($row as $key => $value) {
//        echo $key;
//        echo ' - $';
//        echo $value;
       foreach($row as $field => $value) { 
           $recNew[$field][] = $value;
       }
    }
    $i = 0;
    //forloop
//    $resulthtml .= '<tr>';
//    $resulthtml .= '<th>Make</th>';
//    $resulthtml .= '<th>Year</th>';
//    $resulthtml .= '<th>Model</th>';
//    $resulthtml .= '<th>Sub Model</th>';
//    $resulthtml .= '<th>Fuel Type</th>';
//    $resulthtml .= '<th>Number</th>';
//    $resulthtml .= '<th>Edit</th>';
//    $resulthtml .= '</tr>';
//    $resulthtml .= '<tr>';
//    $resulthtml .= '<td>'.$Vehicle_Make.'</td>';
//    $resulthtml .= '<td>'.$Vehicle_Year.'</td>';
//    $resulthtml .= '<td>'.$Vehicle_Model.'</td>';
//    $resulthtml .= '<td>'.$Sub_Model.'</td>';
//    $resulthtml .= '<td>'.$Fuel_Type.'</td>';
//    $resulthtml .= '<td>'.$Truck_Number.'</td>';
    $resulthtml .= '<td><button>Edit</button></td>';
    $resulthtml .= '</tr>';
    $resulthtml .= '</table>';
  //END ROW
  $i = $i + 1;
  }
  //EMD RESULT ROWS
  $resulthtml .= '</tbody>';
  $resulthtml .= '</table>';

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

//$change_vehicles_info;//

//<html>
//<form method='post'>
//    <label>Vehicle Make:
//        <input type='text' name='Vehicle_Make' value=$Vehicle_Make>
//    </label><br>
//    <label>Vehicle Year:
//        <input type='text' name='Vehicle_Year' value=$Vehicle_Year>
//    </label><br>
//    <label>Model:
//        <input type='text' name='Vehicle_Model' value=$Vehicle_Model>
//    </label><br>
//    <label>Sub-Model:
//        <input type='text' name='Sub_Model' value=$Sub_Model>
//    </label><br>
//    <label>Fuel_Type:
//        <input type='text' name='Fuel_Type' value=$Fuel_Type>
//    </label><br>
//    <label>Number:
//        <input type='text' name='Truck_Number' value=$Truck_Number>
//    </label><br>
//    <input type='submit' name='changed_vehicles_info' value='update'>
//</form>
//</html>
//This creates a new array composed/transposed with the field names as keys and
//the "rowed" values as sub-arrays.

echo "<table>\n";

foreach ($recNew as $key => $values) // For every field name (id, name, last_name, gender)
{
    echo "<tr>\n"; // start the row
    echo "\t<td>" . $key . "</td>\n" ; // create a table cell with the field name
        foreach ($values as $cell) // for every sub-array iterate through all values
        {
           echo "\t<td>" . $cell . "</td>\n"; // write cells next to each other
        }
    echo "</tr>\n"; // end row

}

echo "</table>";

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

table, th, td {
border:1px solid black;
}
#customers {
font-family: Arial, Helvetica, sans-serif;
border-collapse: collapse;
width: 100%;
}

#customers td, #customers th {
border: 1px solid #ddd;
padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
padding-top: 12px;
padding-bottom: 12px;
text-align: left;
background-color: black;
color: white;
}
button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
}
</style>
</head>
<body>
    <main>
        <?php if (!isset($_SESSION['granted'])) : ?>
        <?php include('navbar.php'); ?>
        <?php 
        header('Location: login.php?error=');
     ?>
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
        echo $resulthtml;
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

    }elseif(array_key_exists('changed_vehicles', $_POST)) 
    {
        echo "Update successful!";
        $updated_first_name = $_POST['firstName'];
        $updated_last_name = $_POST['lastName'];
        $updated_address = $_POST['address'];
        $updated_zip_code = $_POST['zip'];
        $updated_state = $_POST['state'];
        $updated_email_address = $_POST['email'];
        $update_query = "UPDATE `user` SET `First_Name`='$updated_first_name',`Last_Name`='$updated_last_name',`address`='$updated_address',`zip`='$updated_zip_code',`state`='$updated_state',`email`='$updated_email_address' WHERE `Customer_ID`='$id'";
        $result2 = $conn->query($update_query);
        if(!$result2) die($conn->error);
    }

?>