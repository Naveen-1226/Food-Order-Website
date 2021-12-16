
<?php include('partials-front/menu.php'); ?>
<style>
.success{
    color:#2ed573;
}
.failure{
    color:#ff4757;
}
.text-center
{
text-align:center;
}

</style>

<?php
ob_start();
//check whether food id is set or not
if(isset($_GET['food_id']))
{
    //get the food id and details of the selected food
    $food_id=$_GET['food_id'];
    //get the deatils of selected food
    $sql="SELECT * FROM tbl_food WHERE id=$food_id";
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    //check whether the data is available or not
    if($count==1)
    {
        //we have data
        //get data from database
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $price=$row['price'];
        $image_name=$row['image_name'];


    }
    else
    {
        //food not avilable redirect to home page
        header('location:'.SITEURL);
    }

}
else
{
    //redirect to home page
    header('location:'.SITEURL);
}

?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            if($image_name=="")
                            {
                                echo "<div class='failure'>Image Not Available</div>";
                            }
                            else{
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php

                            }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <p class="food-price">$<?php echo $price; ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Naveen Kumar" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 8688xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. naveen@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                //check whether submit button clicked or not
                if(isset($_POST['submit']))
                {
                    //get all the details from the form
                    $food=$_POST['food'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];
                    $total=$price * $qty;//total =price*qty
                    $order_date=date("Y-m-d h:i:sa");//order date
                    $status="Ordered";//Ordered Ondelivery Delevered Cancelled
                    $customer_name=$_POST['full-name'];
                    $customer_contact=$_POST['contact'];
                    $customer_email=$_POST['email'];
                    $customer_address=$_POST['address'];
                    //save the order in database
                    //create sql query to save data
                    $sql2="INSERT INTO tbl_order SET
                    food='$food',
                    price=$price,
                    qty=$qty,
                    total=$total,
                    order_date='$order_date',
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                    ";
                    //echo $sql2;
                    //die();
                    $res2=mysqli_query($conn,$sql2);
                    //check whether quey executed successfully or not
                    ?>
                    <?php

                            $to=$customer_email;
                            $subject="Order Summary";
                            $html="<html><body>";
                            $html="<table class='tbl-30' border='1px'>";
                            $html.='<tr><th>Name</th><th>Email</th><th>Food</th><th>price</th><th>qty</th><th>total</th><th>Order_date</th></tr>';
                            $html.='<tr><td>'.$customer_name.'</td><td>'.$customer_email.'</td><td>'.$food.'</td><td>'.$price.'</td>
                            <td>'.$qty.'</td><td>'.$total.'</td><td>'.$order_date.'</td></tr>';
                             $html.='</table>';
                             $html.="</body></html>";
                            
                             
                             $to = $customer_email;
                             $headers = "From Naveen \r\n";
                             //$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
                             //$headers .= "CC: susan@example.com\r\n";
                             $headers .= 'MIME-Version: 1.0' . "\r\n";
                             $headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
                             $subject = 'Order Summary';
                            
                            if( mail($to, $subject, $html, $headers)){

                                $_SESSION['order']="<div class='success text-center'>Email sent Succesfully.</div>";
                                header('location:'.SITEURL);
                            }
                            else{
                                echo "failed ro semde";
                            }


                            ob_end_flush();?>

                
<?php

                   
                   

                    

                }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
