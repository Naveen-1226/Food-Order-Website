<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Log in food order system</title>
        <style>

    .login{

    border-radius:10px;
    box-shadow:0 0 10px black;
    width:25%;
    margin:10% auto;
    
    }
    .text-cente{
        text-align:center;
    }
    .success{
    color:#2ed573;
}
.failure{
    color:#ff4757;
}

            </style>
    <link rel="stylesheet" href="../BootStrap/CSS/bootstrap.css">
    <link rel="stylesheet" href="../BootStrap/CSS/mdb.css">

    </head>
    <body>
        <div class="login text-cente ">
            
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }

            ?>

            <div class="card bg-primary">
                <div class="card-header p-2 bg-secondaey text-white">
                    <h2>Login Form</h2>
                </div>
                <div class="card-body bg-warning">
                    <form action="" method="POST" class="text-cente form-group">
                   
                        <input type="text" class="input-group p-2 my-3" name="user_name" placeholder="UserName">
                        <input type="password" class="input-group p-2 my-3" name="password" placeholder="Password">
                        <input type="submit"  name="submit" value="login" class="btn btn-primary">  
                    </form>
                </div>
            </div>



        </div>
    <script src="../BootStrap/JS/jquery-3.3.1.min.js"></script>
    <script src="../BootStrap/JS/popper.min.js"></script>
    <script src="../BootStrap/JS/bootstrap.js"></script>
    <script src="../BootStrap/JS/mdb.js"></script>


    </body>
</html>

<?php
//check whether the submit button is clicked or not

if(isset($_POST['submit'])){
     $user_name=mysqli_real_escape_string($conn,$_POST['user_name']);
    $password=mysqli_real_escape_string($conn,md5($_POST['password']));
    $sql="SELECT * FROM tbl_admin WHERE user_name='$user_name' AND password='$password'";
    $res=mysqli_query($conn,$sql);

    $count=mysqli_num_rows($res);
    if($count==1){
        $_SESSION['login']="<div class='success'>Login Successfull</div>";

        $_SESSION['user']=$user_name;//to check whether user is logged in or not and logout will unset it
        header('location:'.SITEURL.'admin/');

    }
    else{
        $_SESSION['login']="<div class='failure text-cente'>username or password didnot match.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
}
?>