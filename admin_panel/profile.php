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

$select_products="select * from products where seller_id='$seller_id'";
$select_products=mysqli_query($con,$select_products);
$total_products=mysqli_num_rows($select_products);

$select_orders="select * from products where seller_id='$seller_id'";
$select_orders=mysqli_query($con,$select_orders);
$total_orders=mysqli_num_rows($select_orders);



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

    <title>Grren Sky Summer - seller  profile page</title>

    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">

   <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    
</head>

<body>
    <div class="main-container">
<?php include '../components/admin_header.php'; ?>

<section class="seller-profile">
<div class="heading">
<h1>profile detail</h1>
<img src="../image/separator-img.png">
</div>

<div class="details">
<div class="seller">
<img src="../uploaded_files/<?=$fetch_profile['image']; ?>">
<h3 class="name"><?=$fetch_profile['name']; ?> </h3>
<span>seller</span>
<a href="update.php" class="btn">update profile</a>
</div>
<div class="flex">
    <div class="box">
        <span><?=$total_products; ?></span>
        <p>total products</p>
        <a href="view_product.php" class="btn">view product</a>
    </div>
    <div class="box">
        <span><?=$total_orders; ?></span>
        <p>total orders placed</p>
        <a href="admin_order.php" class="btn">view orders</a>
    </div>



</div>

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