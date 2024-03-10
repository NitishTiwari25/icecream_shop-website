<?php
include 'components/connect.php';

// if (isset($_COOKIE['user_id'])) {
//     $user_id = $_COOKIE['user_id'];
// } else {
//     $user_id = '';
//  }


if (!isset($_SESSION['userdata'])) {
    //header("location:login.php");
}

$userdata = $_SESSION['userdata'];

if (isset($_SESSION['userdata'])) {
    $user_id = $_SESSION['userdata']['id'];
    // $status='<b style="color:red">Not Voted</b>';
} else {
    $user_id = '';
   // header('location:login.php');
}




if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);


// or this 
    $query="select * from users where email='$email' AND password='$pass'";
          
    $result=mysqli_query($con,$query);  // give output in only 1 or 0
    
    
if(mysqli_num_rows($result)>0){
    // for fetching the data
    $userdata=mysqli_fetch_array($result);
    header('location:home.php');
    $_SESSION['userdata']=$userdata;
}else{
    $warning_msg[] = "incorrect email or password";
}

    

}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - user login page</title>

    <link rel="stylesheet" type="text/css" href="css/user_style.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


</head>
<body>
    
<?php include 'components/user_header.php'; ?>
<div class="banner">
    <div class="detail">
        <h1>Login</h1>
        <p>lorem is best</p>
        <span> <a href="home.php">home </a><i class="bx bx-right-arrow-alt"></i>about us</span>
    </div>
</div>


<div class="form-container">
        <!-- enctype="multipart/form-data" -->
        <form action="" method="POST" enctype="multipart/form-data" class="login">
            <h3>login Now</h3>
            <div class="input-field">
                        <p>Your E-mail<span>*</span></p>
                        <input type="email" name="email" class="box" placeholder="Useremail" maxlength="50" required>
                    </div>
                    <div class="input-field">
                        <p>Your Password<span>*</span></p>
                        <input type="password" name="pass" class="box" placeholder="Userpassword" maxlength="50" required>
                    </div>
                <p class="link">do not have an account? <a href="register.php"> Register now</a></p>
                <input type="submit" name="submit" value="login now" class="btn">
        </form>
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