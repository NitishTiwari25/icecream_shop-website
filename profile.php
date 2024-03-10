<?php
include 'components/connect.php';

// if (isset($_COOKIE['user_id'])) {
//     $user_id = $_COOKIE['user_id'];
// } else {
//     $user_id = 'location:login.php';
// }


// if (!isset($_SESSION['userdata'])) {
//     header("location:login.php");
// }

$userdata = $_SESSION['userdata'];

if (isset($_SESSION['userdata'])) {
    $user_id = $_SESSION['userdata']['id'];
    // $status='<b style="color:red">Not Voted</b>';
} else {
    $user_id = '';
    header('location:login.php');
}

$select_order = "select * from orders where user_id='$user_id'";
$select_order = mysqli_query($con, $select_order);
$total_orders = mysqli_num_rows($select_order);

$select_message = "select * from message where user_id='$user_id'";
$select_message = mysqli_query($con, $select_message);
$total_messages = mysqli_num_rows($select_message);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - user profile page</title>

    <link rel="stylesheet" type="text/css" href="css/user_style.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


</head>

<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Profile</h1>
            <p>lorem is best</p>
            <span> <a href="home.php">home </a><i class="bx bx-right-arrow-alt"></i>Profile</span>
        </div>
    </div>


    <section class="profile">
        <div class="heading">
            <h1>profile detail</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="details">
            <div class="user">


            <?php 
            $select_profile="select * from users where id='$user_id'";
            $select_profile=mysqli_query($con,$select_profile);

            if(mysqli_num_rows($select_profile)>0){
                while($fetch_profile=mysqli_fetch_assoc($select_profile)) {
                // $fetch_profile=mysqli_fetch_assoc($select_profile);
            ?>


            <img src="uploaded_files/<?= $fetch_profile['image']; ?>">
            <h3 style="margin-bottom: 1rem;"><?= $fetch_profile['name']; ?></h3>
           
            <?php
            }
        }?>






               
               
               
               <p>user</p>
                <a href="update.php" class="btn">update profile</a>
            </div>
            <div class="box-container">
                <div class="box">
                    <div class="flexx">
                        <i class="bx bxs-folder-minus"></i>
                        <h3>
                            <?= $total_orders; ?>
                        </h3>
                    </div>
                    <a href="order.php" class="btn"> view orders</a>
                </div>
                <div class="box">
                    <div class="flex">
                        <i class="bx bxs-chat"></i>
                        <h3>
                            <?= $total_messages; ?>
                        </h3>
                    </div>
                    <a href="message.php" class="btn">view message</a>
                </div>
            </div>
        </div>





        <?php include 'components/footer.php'; ?>



        <!-- sweetalert cdn link  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <!-- custom  js link -->
        <script src="js/user_script.js"></script>


        <script>
  document.addEventListener('DOMContentLoaded', function() {
    let profile = document.querySelector('.profile-detail');
    let btn = document.querySelector('#user-btn');

    btn.addEventListener('click', function() {
      profile.classList.toggle('active');
    });
  });




  document.addEventListener('DOMContentLoaded', function() {
    let searchForm=document.querySelector('.header .flex .search-form');
    let profile = document.querySelector('.profile-detail');
    let btn = document.querySelector('#search-btn');

    btn.addEventListener('click', function() {
        searchForm.classList.toggle('active');
//     profile.classList.remove('active');
    //   profile.classList.remove('active');
    });
  });


  document.addEventListener('DOMContentLoaded', function() {
    let navbar=document.querySelector('.navbar');
    let btn = document.querySelector('#menu-btn');


    btn.addEventListener('click', function() {
        navbar.classList.toggle('active');
    });
  });
  

    // // home slider

// const imgBox=document.querySelector('.slider-container');
// const slides=document.getElementsByClassName('slideBox');
// var i=0;
// function nextSlide(){
//     slides[i].classList.remove('active');
//     i=(i+1)% slides.length;
//     slides[i].classList.add('active');
// }

// function prevSlide(){
//     slides[i].classList.remove('active');
//     i=(i-1+slides.length)% slides.length;
//     slides[i].classList.add('active');
// }
</script>


        <?php include 'components/alert.php'; ?>

</body>

</html>