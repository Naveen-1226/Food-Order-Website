<?php include('partials/menu.php') ?>
<style>
     .tbl-30{
    width:30%;
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

        <h1> update admin </h1>
        <br><br>
        <?php

$id=$_GET['id'];
$sql="SELECT * FROM tbl_admin WHERE id=$id";
$res=mysqli_query($conn,$sql);
    if($res==TRUE){
        $count =mysqli_num_rows($res);
        if($count==1){
               // echo "Admin Available";
               $row=mysqli_fetch_assoc($res);
               $full_name=$row['full_name'];
               $user_name=$row['user_name'];
        }
        else{
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>
        <form action="" method="POST">

       
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td> <input type="text" name="full_name"  value="<?php echo$full_name; ?> "> </td>
            </tr>
            <tr>
                <td>User Name:</td>
                <td>

                <input type="text" name="user_name" value="<?php  echo $user_name; ?>">
            </td>
            
            <tr >
                <td colspan="2" >
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="update Admin" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>
    </div>

</div>


<?php
if(isset($_POST['submit'])){
    //echo "button clicked";
    $id=$_POST['id'];
    $full_name=$_POST['full_name'];
   $user_name=$_POST['user_name'];


    $sql="UPDATE tbl_admin SET 
    full_name='$full_name',
    user_name='$user_name'
    WHERE id='$id'
    ";
    $res=mysqli_query($conn,$sql);
    if($res==TRUE){
        $_SESSION['update']="<div class='success'>Admin Updated successfully</div>";
    
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    else{
      
        $_SESSION['update']="<div class='failure'>Failed to update admin</div>";
    
        header('location:'.SITEURL.'admin/manage-admin.php');
  
    }

}

?>



<?php include('partials/footer.php') ?>
