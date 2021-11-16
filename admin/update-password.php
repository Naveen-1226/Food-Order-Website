<?php include('partials/menu.php'); ?>
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
        <h1>Change Password</h1><br><br>
        <?php 
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="current password">

                    </td>
                </tr>
                <tr>
                    <td>
                        New password:
                    </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>
                       Confirm password:
                    </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>

                <td colspan="2">
                <input type="hidden" name="id" value="<?php  echo $id; ?>">
                    <input type="submit" name="submit" value="change password" class="btn-secondary">
                </td>
                </tr>
            </table>
        </form>
        
    </div>
</div>


<?php

if(isset($_POST['submit'])){
    //echo "clicked";
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);
    $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    $res=mysqli_query($conn,$sql);
    if($res==TRUE){
        $count=mysqli_num_rows($res);
        if($count==1){
            //echo "User Found";
            //check whether new and confirm password match or not
            if($new_password==$confirm_password){
                    //update password
                    //echo "password match";
                    $sql2="UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id=$id
                    ";
                    $res2=mysqli_query($conn,$sql2);
                    if($res2==TRUE){
                        $_SESSION['change-pwd']="<div class='success'>Password changed successfully.</div>";
   
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else{
                        $_SESSION['change-pwd']="<div class='failure'>FAIL.</div>";
   
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
            }
            else{
                //redirect to manageadmin
                $_SESSION['pwd-not-match']="<div class='failure'>password did not match.</div>";
   
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
    }
    else{
        $_SESSION['user-not-found']="<div class='failure'>User Not Found.</div>";
   
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    }
}


?>
<?php include('partials/footer.php'); ?>