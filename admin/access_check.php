<?php
SESSION_START();
if(isset($_POST['accesscheck'])){
    include 'connect.php';
    $pin = $_POST['pwd'];
    if ($pin == "2024") {
        $_SESSION["access"] = "dbtcmi";
        header("Location:dashboard.php");
      } else {
        header("Location:index.php");
      } 
}
else {
    $_SESSION = array();
    session_destroy();
    header("Location:index.php");
    exit;
}
?>