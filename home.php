<?php
include 'components/connect.php';
// include 'login.php';

// if (isset($_COOKIE['user_id'])) {
//     $user_id = $_COOKIE['user_id'];
// } else {
//     $user_id = '';
// }


// if (!isset($_SESSION['userdata'])) {
//     header("location:login.php");
// }

// $userdata = $_SESSION['userdata'];

// if (isset($_SESSION['userdata'])) {
//     $seller_id = $_SESSION['userdata']['id'];
//     // $status='<b style="color:red">Not Voted</b>';
// } else {
//     $seller_id = '';
//     header('location:login.php');
// }


if (!isset($_SESSION['userdata'])) {
  // header("location:login.php");
}



$userdata = $_SESSION['userdata'];

if (isset($userdata)) {
    $user_id = $_SESSION['userdata']['id'];
    // $status='<b style="color:red">Not Voted</b>';
} else {
    $user_id = '';
//    header('location:user_panel/login.php');
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - home page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


</head>

<body>
    <?php include 'components/user_header.php'; ?>




    <!-- slider section part -->
    <!-- slider-container   slideBox   imgBox -->
    <div class="slider-container">
        <div class="slider">
            <div class="slideBox active">
                <div class="textBox">
                    <h1>we pride ourselfs on <br> exceptional flavors</h1>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
                <div class="imgBox">
                    <img src="image/slider.jpg">
                </div>

            </div>
            <div class="slideBox">
                <div class="textBox">
                    <h1>cold treats are my kind<br> of comfort food</h1>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
                <div class="imgBox">
                    <img src="image/slider0.jpg">
                </div>

            </div>
        </div>

        <!-- <ul class="controls"> -->
            <!-- onclick="prevSlide();" -->
            <!-- <li  class="next"> <i class="bx bx-right-arrow-alt"></i></li>
            <li  class="prev"><i class="bx bx-left-arrow-alt"></i></li>
        </ul> -->
    </div>


    <!-- slider section end -->



    <div class="service">
        <div class="box-container">
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>delivery</h4>
                    <span>100% secure</span>
                </div>
            </div>
            <!-- service item box -->

            <!-- service item box -->

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (2).png" class="img1">
                        <img src="image/services (3).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>payment</h4>
                    <span>100% secure</span>
                </div>
            </div>


            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (5).png" class="img1">
                        <img src="image/services (6).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>support</h4>
                    <span>24*7 hours</span>
                </div>
            </div>


            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/service.png" class="img1">
                        <img src="image/services (2).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>returns</h4>
                    <span>24*7 free returns</span>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (2).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>delivery</h4>
                    <span>100% secure</span>
                </div>
            </div>
        </div>
    </div>

    <!-- service section end -->

    <!-- catrgory section start -->
    <div class="categories">
        <div class="heading">
            <h1>categories features</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/categories.jpg">
                <a href="menu.php" class="btn">cocnuts</a>
            </div>

            <div class="box">
                <img src="image/categories0.jpg">
                <a href="menu.php" class="btn">choclate</a>
            </div>

            <div class="box">
                <img src="image/categories2.jpg">
                <a href="menu.php" class="btn">strawberry</a>
            </div>

            <div class="box">
                <img src="image/categories1.jpg">
                <a href="menu.php" class="btn">corn</a>
            </div>
        </div>
    </div>


    <!-- categories end -->

    <img src="image/menu-banner.jpg" class="menu-banner">

    <div class="taste">
        <div class="heading">
            <span>taste</span>
            <h1>buy an icecream @ get one free</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/taste.webp">
                <div class="detail">
                    <h2>natural sweetness</h2>
                    <h1>vanilla</h1>
                </div>
            </div>

            <div class="box">
                <img src="image/taste0.webp">
                <div class="detail">
                    <h2>natural sweetness</h2>
                    <h1>matcha</h1>
                </div>
            </div>

            <div class="box">
                <img src="image/taste1.webp">
                <div class="detail">
                    <h2>natural sweetness</h2>
                    <h1>blueberry</h1>
                </div>
            </div>

        </div>
    </div>


    <!-- taste end -->

    <div class="ice-container">
        <div class="overlay">
        </div>
        <div class="detail">
            <h1>Ice cream is cheaper than <br> therapy for stress</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas,
                reiciendis molestias molestiae accusamus nam facere iste iusto deserunt
                liquid repellendus temporibus! Vel nihil aperiam ipsam expedita consequuntur.
                Cumque, qui rerum?</p>
            <a href="menu.php" class="btn">shop now</a>
        </div>
    </div>


    <!-- container section end -->

    <div class="taste2">
        <div class="t-banner">
            <div class="overlay"></div>
            <div class="detail">
                <h1>find your taste of desserts</h1>
                <p>treat them to delicious treat and send them some luck 'o the irish tool</p>
                <a href="menu.php" class="btn">shop now</a>
            </div>
        </div>
        <div class="box-container">
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type4.jpg">
                <div class="box-details fadIn-bottom">
                    <h1>strawberry</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>

            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type.avif">
                <div class="box-details fadIn-bottom">
                    <h1>strawberry</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>

            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type1.png">
                <div class="box-details fadIn-bottom">
                    <h1>strawberry</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>

            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type2.png">
                <div class="box-details fadIn-bottom">
                    <h1>strawberry</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>


            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type0.avif">
                <div class="box-details fadIn-bottom">
                    <h1>strawberry</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>

            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type4.jpg">
                <div class="box-details fadIn-bottom">
                    <h1>strawberry</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
        </div>
    </div>

    <!-- taste2 end0 -->

    <div class="flavor">
        <div class="box-container">
            <img src="image/left-banner2.webp">
            <div class="detail">
                <h1>Hot Deal ! sale up to <span>20% off</span></h1>
                <p>expired</p>
                <a href="menu.php" class="btn">shop now</a>
            </div>
        </div>
    </div>

    <!-- flavor section end -->

    <div class="usage">
        <div class="heading">
            <h1> how it works</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="row">
            <div class="box-container">
                <div class="box">
                    <img src="image/icon.avif">
                    <div class="detail">
                        <h3>scoop ice-cream</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                            id blanditiis, aspernatur quis quod beatae dolores quidem placeat sapiente
                            magnam.
                        </p>
                    </div>
                </div>

                <div class="box">
                    <img src="image/icon0.avif">
                    <div class="detail">
                        <h3>scoop ice-cream</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                            id blanditiis, aspernatur quis quod beatae dolores quidem placeat sapiente
                            magnam.
                        </p>
                    </div>
                </div>

                <div class="box">
                    <img src="image/icon1.avif">
                    <div class="detail">
                        <h3>scoop ice-cream</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                            id blanditiis, aspernatur quis quod beatae dolores quidem placeat sapiente
                            magnam.
                        </p>
                    </div>
                </div>
            </div>

            <img src="image/sub-banner.png" class="divider">


            <div class="box-container">
                <div class="box">
                    <img src="image/icon2.avif">
                    <div class="detail">
                        <h3>scoop ice-cream</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                            id blanditiis, aspernatur quis quod beatae dolores quidem placeat sapiente
                            magnam.
                        </p>
                    </div>
                </div>

                <div class="box">
                    <img src="image/icon3.avif">
                    <div class="detail">
                        <h3>scoop ice-cream</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                            id blanditiis, aspernatur quis quod beatae dolores quidem placeat sapiente
                            magnam.
                        </p>
                    </div>
                </div>

                <div class="box">
                    <img src="image/icon4.avif">
                    <div class="detail">
                        <h3>scoop ice-cream</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                            id blanditiis, aspernatur quis quod beatae dolores quidem placeat sapiente
                            magnam.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

        <!-- usage section end  -->

        <div class="pride">
            <div class="detail">
                <h1>we pride oursselves on<br> exceptional flavors</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae pariatur exc
                </p>
                <a href="menu.php" class="btn">shop now</a>
            </div>
        </div>




        <!-- footer section start  -->

        <?php include 'components/footer.php'; ?>



        <!-- sweetalert cdn link  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


        <!-- C:\xamppp\htdocs\Icecream_shop\js\user_script.js -->
        <!-- custom  js link -->
        <!-- <script src="js/user_script.js"></script> -->

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