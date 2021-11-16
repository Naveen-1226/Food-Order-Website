<?php
//check whether user is logged in  or not (Authorization)

if(!isset($_SESSION['user'])){
    //user is not logged in
    //redirect to login page with message
    $_SESSION['no-login-message']="<div class='failure text-center'>please login to access admin panel.</div>";
    header('location:'.SITEURL.'admin/login.php');

}

?>