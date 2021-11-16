<?php include('partials/menu.php');?>


<style>
    .tbl-30{
    width:30%;
}
.btn-secondary{
background-color: #7bed9f;
padding:1%;
color:black;
text-decoration:none;
font-weight:bold;
}
.btn-secondary:hover{
    background-color:#2ed573;
}
    </style>
<div class="main-content">
    <div class="wrapper">
        <h1> Add Admin</h1>
        <br>
        <br>
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        ?>
        <form action="" method="POST" >
            
        <table class="tbl-30">
            <tr>
                <td> Full Name </td>
                <td> <input type="text" name="full_name" placeholder="Enter Your Name"> </td>

        </tr>
        <tr>
                <td> User Name </td>
                <td> <input type="text" name="user_name" placeholder="your user name"> </td>

        </tr>
        <tr>
                <td>Password:</td>
                <td> <input type="password" name="password" placeholder="Your password"> </td>

        </tr>

        <tr>
            <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary">
            </td>
        </tr>
        </table>
    </form>
</div>
</div>


<?php include('partials/footer.php');?>

<?php

//process the value from form and save it in database

//check whether the submit button is clicked or not

if(isset($_POST['submit'])){

    //Button is clicked
   // echo "Button clicked";
   //Get data from form
    $full_name =$_POST['full_name'];
     $user_name=$_POST['user_name'];
    $password=md5($_POST['password']);//md5 is encrypting password
    //SQL QUERY TO SAVE DATA INTO DATABASE

    $sql="INSERT INTO tbl_admin SET 
        full_name='$full_name',
        user_name='$user_name',
        password='$password'
    ";
    
    //Execute Query and set data in database
   
    //Executing query and saving data into database
    $res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

    //check whwther the data is inserted or not and display message
    
    if($res==TRUE){
        //Data inserted
        //echo "Data Inserted";
        //create a session variable to display message
        $_SESSION['add']="<div class='success' >Admin Added Successfully</div>";
        //redirect your page to manage admmin
        header("location:".SITEURL.'admin/manage-admin.php ');
    }
    else{
        //Failed to insert data
       // echo "failed to insert data";
       $_SESSION['add']="Failed to add admin";
       //redirect your page to add admmin
       header("location:".SITEURL.'admin/add-admin.php ');
   
    }
}



?>