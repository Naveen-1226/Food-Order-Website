<?php include('partials/menu.php'); ?>

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
        <h1>Add Category</h1><br><br>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr >
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">YES
                            <input type="radio" name="featured" value="No">NO
                        </td>
                    </tr>

                    <tr>
                    <td>Active:</td>
                    <td>
                            <input type="radio" name="active" value="Yes">YES
                            <input type="radio" name="active" value="No">NO
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>

        </form>

        <?php
            //check whetther submit button is clicked or not
            if(isset($_POST['submit'])){
                //echo "clicked";
                //get value from the form 
                $title=$_POST['title'];
                 //for radio input type we need to check whether the button is selected or not 
                 if(isset($_POST['featured'])){
                     //get the value from form 
                     $featured =$_POST['featured'];
                 }
                 else{
                     //set the default value from form
                   $featured="No";
                 }
                 if(isset($_POST['active'])){
                     $active=$_POST['active'];
                 }
                 else{
                     $active="No";
                 }
                 //check whether image is selected or not
                 //print_r($_FILES['image']);

                 //die();
                 if(isset($_FILES['image']['name']))
                 {
                     //upload the image
                     //To upload image we need image name and source path and destination path
                     $image_name=$_FILES['image']['name'];
                            //Upload the image only if the image is selecetd
                            if($image_name!=""){

                            
                        //Auto rename our image
                        //get the extension of our image
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
                            header('location:'.SITEURL.'admin/add-category.php');
                            die();
                        }
                    }

                 }
                 else{
                     //dont upload the image and set the image name value as blank
                     $image_name="";
                 }


                 //create sql query to insert category into database
                 $sql="INSERT INTO tbl_category SET
                 title='$title',
                 image_name='$image_name',
                 featured='$featured',
                 active='$active'
                 
                 ";

                 //execute the query and save in database
                 $res=mysqli_query($conn,$sql);
                 //check whether query executed or not 
                 if($res==TRUE){
                     //query executed and category added
                     $_SESSION['add']="<div class='success'>category added successfully.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                 }
                 else{
                     //Failed to add category
                     $_SESSION['add']="<div class='failure'>Failed to add category.</div>";
                     //redirect to manage category page
                     header('location:'.SITEURL.'admin/add-category.php');
                 }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>




