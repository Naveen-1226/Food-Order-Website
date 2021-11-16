<?php
    include('../config/constants.php');
    //echo "Deleted";
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        //process to delete
       // echo "Process to delete";
       //1.get id and image name
       $id=$_GET['id'];
       $image_name=$_GET['image_name'];
       
        //2.remove the image if available
        //check wherther image is available or not
       if($image_name!=""){
           //get the image path
            $path="../images/food/".$image_name;
            //remove image file from folder
            $remove=unlink($path);
            //check whether the image is removed or not
            if($remove==false){
                //failed to remove image
                $_SESSION['upload']="<div class='failure'>Failed to remove image</div>";
                //redirect to manage header
                header('location:'.SITEURL.'admin/manage-food.php');
                die();

            }
       }
        //3.delete food from database
        $sql="DELETE FROM tbl_food WHERE id=$id";
        $res=mysqli_query($conn,$sql);
        //check whether query is executed or not
        //redirect to manage food with session message
        if($res==true){
            //food deleted
            $_SESSION['delete']="<div class='success'>Food deleted Suucessfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');


        }
        else{
            //failed to delete food
            $_SESSION['delete']="<div class='failure'>Failed to delete food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }
        



    }
    else{
        //redirect to manage food page
        //echo "Redirect";
        $_SESSION['unauthorize']="<div class='failure'>Unauthorized access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

    }



?>