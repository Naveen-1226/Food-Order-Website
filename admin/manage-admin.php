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
                <h1>Manage Admin</h1><br>


                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];//display message
                        unset($_SESSION['add']);//removing session messaage
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];//display message
                        unset($_SESSION['delete']);//removing session messaage
                    }
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];//display message
                        unset($_SESSION['update']);//removing session messaage
                    }
                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];//display message
                        unset($_SESSION['user-not-found']);//removing session messaage
                    }
                    if(isset($_SESSION['pwd-not-match'])){
                        echo $_SESSION['pwd-not-match'];//display message
                        unset($_SESSION['pwd-not-match']);//removing session messaage
                    }
                    if(isset($_SESSION['change-pwd'])){
                        echo $_SESSION['change-pwd'];//display message
                        unset($_SESSION['change-pwd']);//removing session messaage
                    }
                ?>

                <br><br><br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br><br>
                <table class="tbl-full" style="width:100%">
        <tr>

        <th>S.No</th>
        <th>Full Name</th>
        <th>User Name</th>
        <th>Actions</th>
    </tr>
                    <?php
                        //query to get all admins
                        $sql="SELECT * FROM tbl_admin";
                        $res=mysqli_query($conn,$sql);
                        //check whether the query is executed or not
                        if($res==TRUE){
                           //count rows to check whether we have data in database
                            $count=mysqli_num_rows($res);//fun to get all the rows
                            //check no.of.rows 

                            $sn=1;//creating a counter variable
                            if($count>0){
                                    //we have data 
                                    while($rows=mysqli_fetch_assoc($res)){
                                        //using while loop to get all data from database
                                        //and while loop will run as long as we have data in database
                                        //get individual data
                                        $id=$rows['id'];
                                        $full_name=$rows['full_name'];
                                        $user_name=$rows['user_name'];

                                        //display values in table

                                        ?>
                                            <tr>

                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $user_name; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">change password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                                <a href="<?php echo SITEURL;  ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
   
                                            </td>
                                            </tr>
                                        <?php
                                    }
                            }
                            else{
                                    //we dont have data
                            }
                        
                        }
                    ?>
        
    </table>
            </div>
            </div>
        <!-- Main content Section Ends-->


        <?php include('partials/footer.php');?>