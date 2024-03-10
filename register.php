<?php
include 'components/connect.php';

// if (isset($_COOKIE['user_id'])) {
//     $user_id = $_COOKIE['user_id'];
// } else {
//     $user_id = '';
// }


// if (!isset($_SESSION['userdata'])) {
//     //header("location:login.php");
// }

// $userdata = $_SESSION['userdata'];

// if (isset($_SESSION['userdata'])) {
//     $user_id = $_SESSION['userdata']['id'];
//     // $status='<b style="color:red">Not Voted</b>';
// } else {
//     $user_id = '';
//    // header('location:login.php');
// }



if (isset($_POST['submit'])) {

    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id().'.'.$ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_files/'.$rename;

    // this 
    // $select_seller = $con->prepare("SELECT * FROM sellers WHERE email=?");
    // $select_seller->execute([$email]);

// or this 
    $query="select * from users where email='$email'";
          
    $result=mysqli_query($con,$query);  // give output in only 1 or 0
    
    # check already present or not
    $num=mysqli_num_rows($result);
    
    // this 
    // if ($select_seller->rowCount() > 0) {

        //or this 
        if($num==1){
        $warning_msg[] = "email already register";
    } else {
        if ($pass != $cpass) {
            $warning_msg[] = "confirm password not match";
        } else {
            $insert_seller = $con->prepare("INSERT INTO users (id,name,email,password,image) VALUES(?,?,?,?,?)");
            $insert_seller->execute([$id, $name, $email, $cpass, $rename]);
            move_uploaded_file($image_tmp_name, $image_folder);
            $success_msg[] = "new user registered ! please loging now";
        }
    }

}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - user registration page</title>

    <link rel="stylesheet" type="text/css" href="css/user_style.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


</head>
<body>
    
<?php include 'components/user_header.php'; ?>
<div class="banner">
    <div class="detail">
        <h1>register</h1>
        <p>lorem is best</p>
        <span> <a href="home.php">home </a><i class="bx bx-right-arrow-alt"></i>about us</span>
    </div>
</div>


<div class="form-container">
        <!-- enctype="multipart/form-data" -->
        <form action="" method="POST" enctype="multipart/form-data" class="register">
            <h3>Register Now</h3>
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>Your Name<span>*</span></p>
                        <input type="text" name="name" class="box" placeholder="Username" maxlength="50" required>
                    </div>
                    <div class="input-field">
                        <p>Your E-mail<span>*</span></p>
                        <input type="email" name="email" class="box" placeholder="Useremail" maxlength="50" required>
                    </div>
                </div>
                <div class="col">
                    <div class="input-field">
                        <p>Your Password<span>*</span></p>
                        <input type="password" name="pass" class="box" placeholder="Userpassword" maxlength="50" required>
                    </div>
                    <div class="input-field">
                        <p>Confirm Password<span>*</span></p>
                        <input type="password" name="cpass" class="box" placeholder="Confirm Password" maxlength="50" required>
                    </div>
                </div>
            </div>
            <div class="input-field">
                        <p>Your Profile<span>*</span></p>
                        <input type="file" name="image" class="box" accept="image/*" required>
                </div>
                <p class="link">already have an account? <a href="login.php"> Login now</a></p>
                <input type="submit" name="submit" value="register now" class="btn">
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