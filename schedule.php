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
    <form action="scedule.php">
      <select id="year" name="year">
        <option class="year" value="none">Select Year</option>
      <?php 
         for($i = 1950 ; $i < date('Y'); $i++){
            echo "<option>$i</option>";
         }
      ?>
      </select>
    <br>
    <select class="cars" name="cars" id="cars">
    <option value="none">Make</option>
    <option value="volvo">Ford</option>
    <option value="volvo">Volvo</option>
    <option value="saab">Saab</option>
    <option value="opel">Opel</option>
    <option value="audi">Audi</option>
  </select>
  <br>
    <input type="submit" value="Submit">
  </form>
</div>
        <footer>
        <?php include('footer.php'); ?>
        </footer>
    </body>
</html> 

<?php
//$years = array();    
//for ($y = 1980, $now = date('Y'); $y <= $now; ++$y) {
//    $years[$y] = array('value' => $y);
//}
?>