<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

// if (isset($_COOKIE['seller_id'])) {

//     $seller_id=$_COOKIE['seller_id'];
// }else{
//     $seller_id='';
//     header('location:login.php');
// }




// if (!isset($_SESSION['userdata'])) {
//    //header("location:user_panel/login.php");
// }



// $userdata = $_SESSION['userdata'];

// if (isset($userdata)) {
//     $user_id = $_SESSION['userdata']['id'];
//     // $status='<b style="color:red">Not Voted</b>';
// } else {
//     $user_id = '';
// //    header('location:user_panel/login.php');
// }



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - about us page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


</head>

<body>
    <?php include 'components/user_header.php'; ?>


    <!-- slider section part -->
    <div class="banner">
        <div class="detail">
            <h1>about us</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi obcaecati dignissim</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>about us</span>
        </div>
    </div>

    <div class="chef">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>Nitish Tiwari</span>
                    <h1>MasterChef</h1>
                    <img src="image/separator-img.png">
                </div>
                <p>Abhishek is a Delhi PAstery chef who spent 10years in his city Delhi
                </p>
                <div class="flex-btn">
                    <a href="" class="btn">explore our menu</a>
                    <a href="menu.php" class="btn">visit our shop</a>
                </div>
            </div>
            <div class="box">
                <img src="image/ceaf.png" class="img">
            </div>
        </div>
    </div>


    <!-- chef section end  -->

    <div class="story">
        <div class="heading">
            <h1>our story</h1>
            <img src="image/separator-img.png">
        </div>
        <p>Lorem ipsum dolor sit amet consectetur, <br>
            adipisicing elit. Nulla facere itaque voluptates velit ipsam ratione <br>
            rem! Assumenda ad vitae accusamus quaerat autem sequi</p>
        <a href="menu.php" class="btn">our service</a>
    </div>

    <div class="container">
        <div class="box-container">
            <div class="img-box">
                <img src="image/about.png">
            </div>
            <div class="box">
                <div class="heading">
                    <h1>Taking ice cream to new heights</h1>
                    <img src="image/separator-img.png">
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo nostrum sunt at illum libero
                    corrupti. Soluta ipsum laboriosam provident itaque consequuntur, aliquam, laudantium dolor hic
                    blanditiis quo cumque eaque corporis!</p>
                <a href="" class="btn">learn more</a>
            </div>
        </div>
    </div>

    <!-- story end  -->

    <!-- team section start  -->

    <div class="team">
        <div class="heading">
            <span>our team</span>
            <h1>Quality & passion with our services</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/team-1.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Abhishek Singh</h2>
                    <p>Coffee Chef</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team-2.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" class="shap">
                    <h2>Aditi Singh</h2>
                    <p>Pastry Chef</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team-3.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Kuldeep Singh</h2>
                    <p>Cofee Chef</p>
                </div>
            </div>
        </div>
    </div>

    <!-- testimonial section end -->
    <div class="standers">
        <div class="setail">
            <div class="heading">
                <h1>our standerts</h1>
                <img src="image/separator-img.png">
            </div>
            <p>lorem dolar sit is inrfbcd </p>
            <i class="bx bxs-heart"></i>
            <p>lorem dolar sit is inrfbcd </p>
            <i class="bx bxs-heart"></i>
            <p>lorem dolar sit is inrfbcd </p>
            <i class="bx bxs-heart"></i>
            <p>lorem dolar sit is inrfbcd </p>
            <i class="bx bxs-heart"></i>
            <p>lorem dolar sit is inrfbcd </p>
            <i class="bx bxs-heart"></i>
        </div>
    </div>






    <!-- testimonial  -->

    <!-- <div class="testimonials">
        <div class="heading">
            <h1>testimonials</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="testimonial-container">
            <div class="slide-row" id="slide">
                <div class="slide-col">
                    <div class="user-text">
                        <p>lorem is beuatiful</p>
                        <h2>Abhishek</h2>
                        <p>author</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (1).jpg">
                    </div>
                </div>

                <div class="slide-col">
                    <div class="user-text">
                        <p>lorem is beuatiful</p>
                        <h2>Abhishek</h2>
                        <p>author</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (4).jpg">
                    </div>
                </div>
            </div>
            <div class="indicator">
                <span class="btn1 active"></span>
                <span class="btn1"></span>
                <span class="btn1"></span>
            </div>
        </div> -->

        <!-- testimonial end  -->

        <!-- <div class="mission">
            <div class="box-container">
                <div class="heading">
                    <h1>our misssion</h1>
                    <img src="image/separator-img.png">
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission.webp">
                    </div>
                    <div >
                        <h2>Abhishej choclate</h2>
                        <p>this is wonderful</p>
                    </div>
                </div>


                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission.webp">
                    </div>
                    <div >
                        <h2>Abhishej choclate</h2>
                        <p>this is wonderful</p>
                    </div>
                </div>


                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission.webp">
                    </div>
                    <div >
                        <h2>vanilla with honey</h2>
                        <p>this is wonderful</p>
                    </div>
                </div>

                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission2.webp">
                    </div>
                    <div >
                        <h2>pappermint chip</h2>
                        <p>this is wonderful</p>
                    </div>
                </div>
            </div>
            <div class="box">
                <img srcc="image/form.png" alt="" class="img">
            </div>
        </div>
         -->










        <?php include 'components/footer.php'; ?>



        <!-- sweetalert cdn link  -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> -->

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