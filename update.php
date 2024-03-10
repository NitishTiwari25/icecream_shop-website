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
    $select_user = "select * from users where id='$user_id' LIMIT 1";
    $select_user = mysqli_query($con, $select_user);
    $fetch_user = mysqli_fetch_array($select_user);

    $prev_pass = $fetch_user['password'];
    $prev_image = $fetch_user['image'];

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    // update name
    if (!empty($name)) {
        $update_name = "update users set name='$name' where id='$user_id'";
        $update_name = mysqli_query($con, $update_name);
        $success_msg[] = 'username updated successfully';
    }

    // update email
    if (!empty($email)) {
        $select_email = "select * from users where id='$user_id' AND email='$email'";
        $select_email = mysqli_query($con, $select_email);

        if (mysqli_num_rows($select_email) > 0) {
            $warning_msg[] = "email already exist";
        } else {
            $update_email = "update users set email='$email' where id='$user_id'";
            $update_email = mysqli_query($con, $update_email);
            $success_msg[] = 'username updated successfully';
        }
    }


    //update image

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_files/' . $rename;


    if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = 'image size is too large';
        } else {
            $update_image = "update users set image='$rename' where id='$user_id'";
            $update_image = mysqli_query($con, $update_image);

            move_uploaded_file($image_tmp_name, $image_folder);

            if ($prev_image != '' and $prev_image != $rename) {
                unlink('uploaded_files/' . $prev_image);
            }
            $success_msg[] = "image updated";
        }
    }

    //update password

    $empty_pass = 'da39a3ee5e6b03255bfef95601890afd807091';

    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);

    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);

    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    if ($old_pass != $empty_pass) {
        if ($old_pass != $prev_pass) {
            $warning_msg[] = 'old password not matched';
        } elseif ($new_pass != $cpass) {
            $warning_msg[] = 'password not matched';
        } else {
            if ($new_pass != $empty_pass) {
                $update_pass = "update users set password='$cpass' where id='$user_id'";
                $update_pass = mysqli_query($con, $update_pass);
                $success_msg[] = 'password updated successfully';
            } else {
                $warning_msg[] = 'please enter a new password';
            }
        }
    }


}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - update profile page</title>

    <link rel="stylesheet" type="text/css" href="css/user_style.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


</head>

<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Update Profile</h1>
            <p>lorem is best</p>
            <span> <a href="home.php">home </a><i class="bx bx-right-arrow-alt"></i>Update profile</span>
        </div>
    </div>


    <section class="form-container">
        <div class="heading">
            <h1>update profile detail</h1>
            <img src="image/separator-img.png">
        </div>
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <div class="img-btn">

                <div class="profile">


                    <div class="heading">
                        <h1>profile detail</h1>
                        <img src="image/separator-img.png">
                    </div>
                    <div class="details">
                        <div class="user">


                            <?php
                            $select_profile = "select * from users where id='$user_id'";
                            $select_profile = mysqli_query($con, $select_profile);

                            if (mysqli_num_rows($select_profile) > 0) {
                                while ($fetch_profile = mysqli_fetch_assoc($select_profile)) {
                                    // $fetch_profile=mysqli_fetch_assoc($select_profile);
                                    ?>


                                    <img src="uploaded_files/<?= $fetch_profile['image']; ?>">
                                    <h3 style="margin-bottom: 1rem;">
                                        <?= $fetch_profile['name']; ?>
                                    </h3>

                                   



                        </div>
                    </div>

                            </div>
                            <!-- <h3>update profile</h3> -->
                            <div class="flex">
                                <div class="col">
                                    <div class="input-field">
                                        <p>your name<span>*</span></p>
                                        <input type="text" name="name" placeholder="<?= $fetch_profile['name'] ?>" class="box">
                                    </div>
                                    <div class="input-field">
                                        <p>your email<span>*</span></p>
                                        <input type="email" name="email" placeholder="<?= $fetch_profile['email'] ?>"
                                            class="box">
                                    </div>
                                    <div class="input-field">
                                        <p>select pic<span>*</span></p>
                                        <input type="file" name="image" accept="image/*" class="box">
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="input-field">
                                        <p>old password<span>*</span></p>
                                        <input type="password" name="old_pass" placeholder="enter your password" class="box">
                                    </div>
                                    <div class="input-field">
                                        <p>new password<span>*</span></p>
                                        <input type="password" name="new_pass" placeholder="enter your new password"
                                            class="box">
                                    </div>
                                    <div class="input-field">
                                        <p>confirm password<span>*</span></p>
                                        <input type="password" name="cpass" placeholder="confirm your new password" class="box">
                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="submit" value="update profile" class="btn">
                </form>

                <?php
                                    }
                                } ?>



        </div>

    </section>








    <?php include 'components/footer.php'; ?>



    <!-- sweetalert cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom  js link -->
    <script src="js/user_script.js"></script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let profile = document.querySelector('.profile-detail');
            let btn = document.querySelector('#user-btn');

            btn.addEventListener('click', function () {
                profile.classList.toggle('active');
            });
        });




        document.addEventListener('DOMContentLoaded', function () {
            let searchForm = document.querySelector('.header .flex .search-form');
            let profile = document.querySelector('.profile-detail');
            let btn = document.querySelector('#search-btn');

            btn.addEventListener('click', function () {
                searchForm.classList.toggle('active');
                //     profile.classList.remove('active');
                //   profile.classList.remove('active');
            });
        });


        document.addEventListener('DOMContentLoaded', function () {
            let navbar = document.querySelector('.navbar');
            let btn = document.querySelector('#menu-btn');


            btn.addEventListener('click', function () {
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