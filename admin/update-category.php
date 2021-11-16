<?php include('partials/menu.php');?>
<style>
    .tbl-30{
    width:30%;

}
table tr td{
    padding:7px;
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
        <h1>Update category</h1>

        <br>
        <br>
        <?php

        if(isset($_GET['id'])){
            //get id and all other details
            //echo "getting data";
            $id=$_GET['id'];
            $sql="SELECT * FROM tbl_category WHERE id=$id";
            $res=mysqli_query($conn,$sql);
            //count rows to check whether the id is valid or not
            $count=mysqli_num_rows($res);
            if($count==1){
                //get all the data
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];

                
            }
            else{
                //redirect to manage category with session message
                $_SESSION['no-category-found']="<div class='failure'>Category not found</div>";
                header('location:'.SITEURL.'admin/manage-category.php');

            }
        }
        else{
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        ?>
        <form action="" enctype="multipart/form-data" method="post">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td>Current Image:</td>
                <td>
                   <?php
                    if($current_image!=""){
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image;?>" width="150px">
                            <?php
                    }
                    else{
                            echo "<div class='failure'>Image Not added</div>";
                    }
                   ?>
                </td>
            </tr>
            <tr>
                <td>
                    New Image:
                </td>
                <td>
                    <input type="file" name="image" >
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No</td>
            </tr>
            <tr>
                <td>Active:</td>
               <td> <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No</td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
        <?php
        if(isset($_POST['submit'])){
           // echo "clicked";
           //get all the values from our form
           $title=$_POST['title'];
           $id=$_POST['id'];
           $current_image=$_POST['current_image'];
          $featured=$_POST['featured'];
          $active=$_POST['active'];
          //2
          //check whether the image is selected or not
          if(isset($_FILES['image']['name'])){
              //get the image details
              $image_name=$_FILES['image']['name'];
              if($image_name!=""){
                    //image available
                    //upload new image
                    $ext=end(explode('.',$image_name));
                    //rename the image
                    $image_name="Food_category_".rand(000,999).'.'.$ext;
                    //e.g Food_Category_834.jpg

                $source_path=$_FILES['image']['tmp_name'];

                $destination_path="../images/category/".$image_name;
                //finally upload image
                $upload=move_uploaded_file($source_path,$destination_path);
                   //check whether image is uploaded or not
                   //if img is not uploaded we will stop the process and redirect with error message
                   if($upload==false){
                       $_SESSION['upload']="<div class='failure'>Failed to upload image.</div>";
                       //redirect to add category page
                       header('location:'.SITEURL.'admin/manage-category.php');
                       die();
                   }
                    //remove current image
                    if($current_image!="")
                    {
                        $remove_path="../images/category/".$current_image;
                        $remove=unlink($remove_path);
                        if($remove==false){
                            $_SESSION['failed-remove']="<div class='failure'>Failed to remove current Image</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();
    
                        }
                    }
                    
              }
              else{
                $image_name=$current_image;

              }
          }
          else{
              $image_name=$current_image;

          }
          //3
          $sql2="UPDATE tbl_category SET 
          title='$title',
          image_name='$image_name',
          featured='$featured',
          active='$active'
          WHERE id=$id
          ";

          //execute the query
          $res2=mysqli_query($conn,$sql2);

          //4
          if($res2==true){
              //category updated
              $_SESSION['update']="<div class='success'>Category updated successfully</div>";
              header('location:'.SITEURL.'admin/manage-category.php');

          }
          else{
              //failed to update category
              $_SESSION['update']="<div class='failure'>Failed to update category</div>";
              header('location:'.SITEURL.'admin/manage-category.php');
          }
        }

        ?>
    </div>
</div>
<?php include('partials/footer.php');?>
