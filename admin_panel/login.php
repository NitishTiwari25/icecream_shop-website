<?php
include '../components/connect.php';


if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    // this 
    // $select_seller = $con->prepare("SELECT * FROM sellers WHERE email=?");
    // $select_seller->execute([$email]);

// or this 
    $query="select * from sellers where email='$email' AND password='$pass'";
          
    $result=mysqli_query($con,$query);  // give output in only 1 or 0
    
    # check already present or not
    // $num=mysqli_num_rows($result);
    
    // this 
    // if ($select_seller->rowCount() > 0) {


//         $check=mysqli_query($con,"SELECT * FROM user WHERE email='$email' AND password='$password' AND role='$role'");
if(mysqli_num_rows($result)>0){
    // for fetching the data
    $userdata=mysqli_fetch_array($result);
    header('location:dashboard.php');
    $_SESSION['userdata']=$userdata;
}else{
    $warning_msg[] = "incorrect email or password";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Grren Sky Summer - seller registration page</title>

    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body>
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
                <p class="link">do not have an account? <a href="registration.php"> Register now</a></p>
                <input type="submit" name="submit" value="login now" class="btn">
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>


    <!-- sweetalert cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom  js link -->
    <script src="../js/script.js"></script>

    <?php include '../components/alert.php'; ?>
</body>

</html>