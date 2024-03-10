<?php
include '../components/connect.php';

// if (isset($_COOKIE['seller_id'])) {

//     $seller_id=$_COOKIE['seller_id'];
// }else{
//     $seller_id='';
//     header('location:login.php');
// }

// it is open only when login page is successful

 if(!isset($_SESSION['userdata'])) {
    header("location:login.php");
}

$userdata=$_SESSION['userdata'];

if(isset($_SESSION['userdata'])){
    $seller_id=$_SESSION['userdata']['id'];
    // $status='<b style="color:red">Not Voted</b>';
}else{
    $seller_id='';
    header('location:login.php');
}

// update order from database

if(isset($_POST['update_order'])){
    $order_id=$_POST['order_id'];
    $order_id=filter_var($order_id,FILTER_SANITIZE_STRING);

    $update_payment=$_POST['update_payment'];
    $update_payment=filter_var($update_payment,FILTER_SANITIZE_STRING);

    $update_pay="update orders set payment_status='$update_payment' where id='$order_id'";
    $update_pay=mysqli_query($con,$update_pay);

    $success_msg[]='order paymen status updated';
}

// delete order from database

if(isset($_POST['delete_order'])){
    $delete_id=$_POST['order_id'];
    $delete_id=filter_var($delete_id,FILTER_SANITIZE_STRING);

    $verify_delete="select * from orders where id='$delete_id'";
    $verify_delete=mysqli_query($con,$verify_delete);

    if(mysqli_num_rows($verify_delete)>0){
        $delete_order="delete from orders where id='$delete_id'";
        $delete_order=mysqli_query($con,$delete_order);

        $success_msg[]='order deleted successfully';
    }
    else{
        $warning_msg[]='order already deleted';
    }
}




?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

    <title>Grren Sky Summer - seller registration page</title>

    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">

   <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    
</head>

<body>
    <div class="main-container">
<?php include '../components/admin_header.php'; ?>

<section class="order-container">
<div class="heading">
<h1>total orders placed</h1>
<img src="../image/separator-img.png">
</div>

<div class="box-container">
<?php
$select_order="select * from orders where seller_id='$seller_id'";
$select_order=mysqli_query($con,$select_order);

if(mysqli_num_rows($select_order)>0){

    while($fetch_order=mysqli_fetch_assoc($select_order)){

        ?>
        <div class="box">
        <div class="status" style="color: <?php if($fetch_order['status']=='in progress'){
            echo "limegreen" ; }else{echo "red";} ?>"><?= $fetch_order['status'] ; ?></div>
            <div class="detail">
            <p> user name:<span><?= $fetch_order['name'] ; ?></span></p>
            <p> user id:<span><?= $fetch_order['user_id'] ; ?></span></p>
            <p> placed on:<span><?= $fetch_order['date'] ; ?></span></p>
            <p> user number:<span><?= $fetch_order['number'] ; ?></span></p>
            <p> user email:<span><?= $fetch_order['email'] ; ?></span></p>
            <p> total price:<span><?= $fetch_order['price'] ; ?></span></p>
            <p> payment method:<span><?= $fetch_order['method'] ; ?></span></p>
            <p> user address:<span><?= $fetch_order['address'] ; ?></span></p>
        </div>
        <form action="" method="post">
            <input type="hidden" name="order_id" value="<?=$fetch_order['id']; ?>">
            <select name="update_payment" class="box" style="width:90%;">
            <option disabled selected><?=$fetch_order['payment_status']; ?></option>
            <option value="pending" > pending</option>
            <option value="complete">order delivered</option>
            </select>
            <div class="flex-btn">
                <input type="submit" name="update_order" value="update payment" class="btn">
                <input type="submit" name="delete_order" value="delete order" class="btn" onclick="return conform('delete this order');>
            </div>
        </form>
        </div>


        <?php

    }
}else {
    echo '</div>
<div class="empty">
<p>no order placed yet!</p>
</div>';
}     
?>
</div>

</section>

</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script> -->


    <!-- sweetalert cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom  js link -->
    <script src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>
</body>

</html>