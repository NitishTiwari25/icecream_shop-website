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

    <title>Grren Sky Summer - registered users page</title>

    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">

   <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    
</head>

<body>
    <div class="main-container">
<?php include '../components/admin_header.php'; ?>

<section class="user-container">
<div class="heading">
<h1>registered users</h1>
<img src="../image/separator-img.png">
</div>

<div class="box-container">
<?php

$select_users="select * from users";
$select_users=mysqli_query($con,$select_users);

if(mysqli_num_rows($select_users)>0){

    while($fetch_users=mysqli_fetch_assoc($select_users)){
        $user_id=$fetch_users['id'];
        ?>
        <div class="box">
            <img src="../uploaded_files/<?= $fetch_users['image']; ?>">
            <p>user id: <span><?= $user_id; ?></span></p>
            <p>user name:<span><?= $fetch_users['name']; ?> </span></p>
            <p>user email:<span><?= $fetch_users['email']; ?> </span></p>
        </div>
        <?php
    }
}else {
    echo '</div>
<div class="empty">
<p>no user registered yet!</p>
</div>';
}    
?>
</div>

</section>

</div>

    <!-- sweetalert cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom  js link -->
    <script src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>
</body>

</html>