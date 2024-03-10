<?php
include("../API/connect.php");

// name of html code
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
$role = $_POST['role'];


if ($password == $confirmpassword) {
    $insert = mysqli_query($con, "INSERT INTO user (name,email,password,role,status,votes) VALUES ('$name','$email','$password','$role',0,0)");
    if ($insert) {
        echo '
            <script> 
            alert("registration successful");
            window.location="login.php";
            </script>
            ';
    } else {
        echo '
              <script> 
              alert("some error occured");
              window.location="registration.php";
              </script>
              ';
    }
} else {
    echo '
            <script> 
            alert("password and confirmpassword not match");
            window.location="registration.php";
            </script>
            ';
}
// for image
// $image=$_FILES['name']['photo'];
// $temp_name=$_FILES['temp_name']['photo'];


$query = "select * from user where email='$email' && password='$password'";

$result = mysqli_query($con, $query);  // give output in only 1 or 0

# check already present or not
$num = mysqli_num_rows($result);

if ($num == 1) {
    $_SESSION['useremail'] = $email;
    header('location:home.php');
} else {
    echo "<div class='alert alert-danger' role='alert'>
              Invalid Username/Password!
              </div>";
    header('location:login.php');
}

?>