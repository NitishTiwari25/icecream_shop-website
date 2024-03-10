<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - contact us page</title>

    <link rel="stylesheet" type="text/css" href="css/user_style.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


</head>
<body>
    
<?php include 'components/user_header.php'; ?>
<div class="banner">
    <div class="detail">
        <h1>Contact us</h1>
        <p>lorem is best</p>
        <span> <a href="home.php">home </a><i class="bx bx-right-arrow-alt"></i>about us</span>
    </div>
</div>



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


    </body>

</html>