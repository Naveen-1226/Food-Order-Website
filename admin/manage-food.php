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
                <h1>Manage Food</h1><br><br>
                <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['unauthorize'])){
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }
        if(isset($_SESSION['remove-failed'])){
            echo $_SESSION['remove-failed'];
            unset($_SESSION['remove-failed']);
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br>
        <a href="<?php echo SITEURL ; ?>admin/add-food.php" class="btn-primary">Add Food</a>

        <br><br>

      
                <table class="tbl-full" style="width:100%">
        <tr>

        <th>S.No</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Faetured</th>
        <th>Active</th>
        <th>Actions</th>
    </tr>
        <?php
        //create sql query to get all the food
        $sql="SELECT * FROM tbl_food";
        //execute the query
        $res=mysqli_query($conn,$sql);
        //count rows
        $count=mysqli_num_rows($res);
        $sn=1;
        if($count>0){
            //we have food in databse
            //get the foods from database
            while($row=mysqli_fetch_assoc($res)){
                //get the value from individual columns
                $id=$row['id'];
                $title=$row['title'];
                $price=$row['price'];
                $image_name=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];
                ?>

                    <tr>

                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $title; ?></td>
                    <td>$<?php echo $price; ?></td>
                    <td>
                    <?php 
                    //check whether we have image or not
                    if($image_name==""){
                        //display error message
                        echo "<div class='failure'>Image not added</div>";
                    }
                    else{
                        //we have image,display image

                        ?>
                        <img src="<?php echo SITEURL ;?>images/food/<?php echo $image_name; ?>" width="100px">
                        <?php
                    }
                    
                    
                    ?>
                    </td>
                    <td><?php echo $featured; ?></td>
                    <td><?php echo $active; ?></td>
                    <td>
                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                    
                    </td>
                    </tr>
                <?php
            }

        }
        else{
            //food not added in database
            echo "<tr><td colspan='7' class='failure'>Food Not added yet</td></tr>";

        }

        ?>
        
    
    </table>
            </div>
            </div>
        <!-- Main content Section Ends-->


        <?php include('partials/footer.php');?>