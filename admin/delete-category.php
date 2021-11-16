 <?php
 //include constants file
 include('../config/constants.php');
    //echo "Delete Page:";
    //check whether the id and image name is set or not

    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        //get the value and delete
       // echo "Get value and delete";
       $id=$_GET['id'];
       $image_name=$_GET['image_name'];
       //remove the physiacl image file is available
       //Delete data from database
       //redirect to manage category page with message
       if($image_name!="")
       {
           //image is available then remove it
           $path="../images/category/".$image_name;
           //remove the image
           $remove=unlink($path);
           //if failed to remove image add an error message and stop the process

           if($remove==false){
                //set the session message and redirect to manage category page
                $_SESSION['remove']="<div class='failure'>Failed to remove category image</div>";

                header('location:'.SITEURL.'admin/manage-category.php');
                 

                die();
           }
       }
       //query to delete data from daata base

    $sql="DELETE FROM tbl_category WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    //check whether data is deleted fro database or not
    if($res==true){
        //set success message and redirect
        $_SESSION['delete']="<div class='success'>Category deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else{
        //set fail message and redirect
        $_SESSION['delete']="<div class='Failure'>Failed to delete Category</div>";
        header('location:'.SITEURL.'admin/manage-category.php');


    }
    }
    
    else{
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');

    }
    ?>