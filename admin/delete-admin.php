

<?php
    

    //get id of admin to be deleted
   include('../config/constants.php');
     $id=$_GET['id'];

    //create sql query to delete admin
    $sql ="DELETE FROM tbl_admin WHERE id=$id";

    //execute the query

    $res=mysqli_query($conn,$sql);
    //redirect to manage-admin page with message(success/fail)
    //check whetrher query executed successfully or not
    if($res==TRUE){
        //Query executed successfully
           // echo "Admin Deleted";
           //create session variable to display message 
           $_SESSION['delete']="<div class='success'>Admin deleted successfully</div>";
           //redirect to manage admin page
           header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        //Failed to delete admin
       // echo "failed to delete admin";
       $_SESSION['delete']="<div class='error'Failed to delete admin.Try Again later</div>";
           //redirect to manage admin page
           header('location:'.SITEURL.'admin/manage-admin.php');
    }

?>