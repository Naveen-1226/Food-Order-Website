<?php include('partials-front/menu.php'); ?>

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
        <link rel="stylesheet" href="BootStrap/CSS/bootstrap.css">
    <link rel="stylesheet" href="BootStrap/CSS/mdb.css">
      </head>
    <body>
        <div class="login text-cente">
            <h1>Register</h1><br><br>
            

            <br>
            <div class="card bg-primary">
                <div class="card-header p-2 bg-secondary text-white">
                    
                </div>
                <div class="card-body bg-warning">
                    <form action="" method="POST" class="text-cente form-group">
                    <input type="text" class="input-group p-2 my-3" name="full_name" placeholder="Enter fullname">
                        <input type="text" class="input-group p-2 my-3" name="user_name" placeholder="UserName">
                        <input type="password" class="input-group p-2 my-3" name="password" placeholder="Password">
                        <input type="submit"  name="register" value="register" class="btn btn-primary">  
                    </form>
                </div>
            </div>



        </div>
        <script src="BootStrap/JS/jquery-3.3.1.min.js"></script>
    <script src="BootStrap/JS/popper.min.js"></script>
    <script src="BootStrap/JS/bootstrap.js"></script>
    <script src="BootStrap/JS/mdb.js"></script>
    </body>
   
</html>
<?php
if(isset($_POST['register'])){
    
    $full_name =$_POST['full_name'];
    $user_name=$_POST['user_name'];
   $password=md5($_POST['password']);//md5 is encrypting password
   //SQL QUERY TO SAVE DATA INTO DATABASE

   $sql="INSERT INTO tbl_customers SET 
       full_name='$full_name',
       user_name='$user_name',
       password='$password'
   ";
   $res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

   //check whwther the data is inserted or not and display message
   
   if($res==TRUE){
       echo "hi";
       //Data inserted
       //echo "Data Inserted";
       //create a session variable to display message
       $_SESSION['add']="<div class='success' >Registration Succesfull</div>";
       //redirect your page to manage admmin
       header("location:".SITEURL."login-front.php");
   }
   else{
       //Failed to insert data
      // echo "failed to insert data";
      $_SESSION['add']="Failed to add admin";
      //redirect your page to add admmin
      header("location:".SITEURL);
  
   }
}
?>


<br>
<br>
<?php include('partials-front/footer.php'); ?>