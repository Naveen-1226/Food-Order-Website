<?php include('partials-front/menu.php'); ?>

<?php

//destroy session and redirect to login page

session_destroy();//unset $_SESSION['user]

header('location:'.SITEURL.'login-front.php');

?>