<?php
session_start();
$_SESSION = array();
session_unset();
session_destroy();
$msg = "log-out_effettuato";
$msg = urlencode($msg);
header("location: out.php?msg=$msg");
exit();
?>
