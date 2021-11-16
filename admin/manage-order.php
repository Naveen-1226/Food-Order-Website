<?php include('partials/menu.php');?>
    <style>
        .tbl-full{
    width: 100%;
}
.wrapper{
  
  padding: 1%;
  width:80%;
  margin:0 auto;
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
                <h1>Manage Order</h1>
        <br><br>
        <?php
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
       
        ?>
         <br><br>
                <table class="tbl-full" >
        <tr>

        <th>S.No</th>
        <th>Food</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Customer Name</th>
        <th>Customer Contact</th>
        <th>Email</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>
    <?php
    //get all orders from database
    $sql="SELECT * from tbl_order ORDER BY id DESC";
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    $sn=1;
    if($count>0)
    {
        //order avilable
        while($row=mysqli_fetch_assoc($res))
        {
            $id=$row['id'];
            $food=$row['food'];
            $price=$row['price'];
            $qty=$row['qty'];
            $total=$row['total'];
            $order_date=$row['order_date'];
            $status=$row['status'];
            $customer_name=$row['customer_name'];
            $customer_contact=$row['customer_contact'];
            $customer_email=$row['customer_email'];
            $customer_address=$row['customer_address'];

            ?>

                <tr>

                <td><?php echo $sn++; ?></td>
                <td><?php echo $food; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $qty; ?></td>
                <td><?php echo $total; ?></td>
                <td><?php echo $order_date; ?></td>
                <td><?php 
                
                    if($status=="Ordered"){
                        echo "<label>$status</label>";
                    }
                    else if($status=="On Delivery")
                    {
                        echo "<label style='color: orange'>$status</label>";
                    }
                    else if($status=="Delivered")
                    {
                        echo "<label style='color: green'>$status</label>";
                    }
                    else 
                    {
                        echo "<label style='color: red'>$status</label>";
                    }
                ?>
                </td>
                <td><?php echo $customer_name; ?></td>
                <td><?php echo $customer_contact; ?></td>
                <td><?php echo $customer_email; ?></td>
                <td><?php echo $customer_address; ?></td>
                <td>
                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                
                
                </td>
                </tr>

            <?php
        }
        
    }
    else
    {
        //order unavailable
        echo "<tr><td colspan='12' class='failure'>Orders Not Available</td></tr>";
    }

    ?>

    
    </table>
            </div>
            </div>
        <!-- Main content Section Ends-->


        <?php include('partials/footer.php');?>