<?php
session_start();

include_once('function.php'); 

$granted = false;
$message = "";

if (isset($_SESSION['login']))
{ 
  $email = $_SESSION['email'];

if($_SESSION['email'] == $email)
  {
    $_SESSION['granted'] = true;
  }
  //if(!$granted) $message = '<h1 class="Warning">Access Denied</h1>';
}

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
        <?php endif; ?>
   </main>
  </div>
 </body>
</html>