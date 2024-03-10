<?php
include '../components/connect.php';

// it is open only when login page is successful

if (!isset($_SESSION['userdata'])) {
    header("location:login.php");
}

$userdata = $_SESSION['userdata'];

if (isset($_SESSION['userdata'])) {
    $seller_id = $_SESSION['userdata']['id'];
    // $status='<b style="color:red">Not Voted</b>';
} else {
    $seller_id = '';
    header('location:login.php');
}

if (isset($_POST['submit'])) {
    $select_seller = "select * from sellers where id='$seller_id' LIMIT 1";
    $select_seller = mysqli_query($con, $select_seller);
    $fetch_seller = mysqli_fetch_array($select_seller);

    $prev_pass = $fetch_seller['password'];
    $prev_image = $fetch_seller['image'];

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    // update name
    if (!empty($name)) {
        $update_name = "update sellers set name='$name' where id='$seller_id'";
        $update_name = mysqli_query($con, $update_name);
        $success_msg[] = 'username updated successfully';
    }

    // update email
    if (!empty($email)) {
        $select_email = "select * from sellers where id='$seller_id' AND email='$email'";
        $select_email = mysqli_query($con, $select_email);

        if (mysqli_num_rows($select_email)>0) {
            $warning_msg[] = "email already exist";
        } else {
            $update_email = "update sellers set email='$email' where id='$seller_id'";
            $update_email = mysqli_query($con, $update_email);
            $success_msg[] = 'username updated successfully';
        }
    }


    //update image

    $image=$_FILES['image']['name'];
    $image=filter_var($image,FILTER_SANITIZE_STRING);
    $ext=pathinfo($image,PATHINFO_EXTENSION);
    $rename=unique_id().'.'.$ext;
    $image_size=$_FILES['image']['size'];
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_folder='../uploaded_files/'.$rename;


    if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = 'image size is too large';
        } else {
            $update_image = "update sellers set image='$rename' where id='$seller_id'";
            $update_image = mysqli_query($con, $update_image);

            move_uploaded_file($image_tmp_name, $image_folder);

            if ($prev_image != '' and $prev_image != $rename) {
                unlink('../uploaded_files/' . $prev_image);
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
                $update_pass = "update sellers set password='$cpass' where id='$seller_id'";
                $update_pass = mysqli_query($con, $update_pass);
                $success_msg[] = 'password updated successfully';
            } else {
                $warning_msg[] = 'please enter a new password';
            }
        }
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

    <title>Grren Sky Summer - update profile page</title>

    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


</head>

<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>

        <section class="form-container">
            <div class="heading">
                <h1>update profile detail</h1>
                <img src="../image/separator-img.png">
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <div class="img-btn">
                    <img src="../uploaded_files/<?= $fetch_profile['image']; ?>">

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
                            <input type="email" name="email" placeholder="<?= $fetch_profile['email'] ?>" class="box">
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
                            <input type="password" name="new_pass" placeholder="enter your new password" class="box">
                        </div>
                        <div class="input-field">
                            <p>confirm password<span>*</span></p>
                            <input type="password" name="cpass" placeholder="confirm your new password" class="box">
                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" value="update profile" class="btn">
            </form>



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