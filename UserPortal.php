<?php
session_start();
include('function.php');
isAllowed();
?>
<!DOCTYPE html>
<html>
 <head>
 	<title>Black Oil Mobile</title>
<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<?php if ($granted) { 
       ?>
       <br>
<?php include('navbarLoggedIn.php');?>
<h1>Welcome!</h1>

<?php
}else{
include('navbar.php');
     echo '<h1>Please Log In</h1>';
}
?>
</div>
</body>
</html>