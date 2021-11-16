<?php include('partials/menu.php');?>
<style>
        .tbl-full{
    width: 100%;
}
table tr th{
    border-bottom: 1px solid black;
    padding:1%;
    text-align:left;
    
}
table tr td{
    padding:1%;
}
.btn-primary{
background-color: #1e90ff;
padding:1%;
color:white;
text-decoration:none;
font-weight:bold;
}
.btn-primary:hover{
    background-color:#3742fa;
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
.btn-danger{
background-color: #ff6b81;
padding:1%;
color:white;
text-decoration:none;
font-weight:bold;
}
.btn-danger:hover{
    background-color:#ff4757;
}
        </style>

        <!-- Main content Section Starts-->

        <div class="main-content">
        <div class="wrapper">
                <h1>Manage Category</h1><br><br>
                <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);

            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
                
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
                
            }
            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['faile-remove']);
                
            }
        ?>

        <br>
        <a href="<?php echo SITEURL ;?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br><br>
                <table class="tbl-full" style="width:100%">
        <tr>

        <th>S.No</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        
        <th>Actions</th>
    </tr>
            <?php
                $sql="SELECT * FROM tbl_category";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                $sn=1;
                if($count>0){
                    //we have data in database
                        while($row=mysqli_fetch_assoc($res)){
                            $id=$row['id'];
                            $title=$row['title'];
                            $image_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];
                            ?>
                            <tr>

                            <td><?php echo  $sn++; ?>.</td>
                                <td><?php  echo $title; ?></td>

                                <td>
                                    <?php

                                      if($image_name!=""){
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                           
                                           
                                           <?php

                                      }
                                      else{
                                          echo "<div class='failure'>Image not added </div>";
                                      }
                                      
                                      ?>
                                </td>

                                <td><?php  echo $featured; ?></td>
                                <td><?php  echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update category</a>
                                    <a href="<?php echo SITEURL ; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete category</a>
   
                                    </td>
                                </tr>

                            <?php
                        }

                }
                else{
                    //we dont have data in databse
                    //we will display the message inside table
                    ?>


                    <tr>
                        <td colspan="6">
                            <div class="failure">No category added</div>
                        </td>
                    </tr>


                    <?php
                }
            ?>
        
   
    </table>
            </div>
            </div>
        <!-- Main content Section Ends-->


        <?php include('partials/footer.php');?>