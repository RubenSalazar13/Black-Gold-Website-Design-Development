<?php
// unset session/cookies

$cs = array_keys($_COOKIE);
for ($x=0;$x<count($cs);$x++) setcookie($cs[$x],"",time()-1);

unset($_SESSION['email']); // this is the key to unsetting your session.
session_destroy();
session_commit();
 header('location: index.php');
 ?>