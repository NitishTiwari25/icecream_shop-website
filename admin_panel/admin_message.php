<?php
include '../components/connect.php';

// if (isset($_COOKIE['seller_id'])) {

//     $seller_id=$_COOKIE['seller_id'];
// }else{
//     $seller_id='';
//     header('location:login.php');
// }

// it is open only when login page is successful

 if(!isset($_SESSION['userdata'])) {
    header("location:login.php");
}

$userdata=$_SESSION['userdata'];

if(isset($_SESSION['userdata'])){
    $seller_id=$_SESSION['userdata']['id'];
    // $status='<b style="color:red">Not Voted</b>';
}else{
    $seller_id='';
    header('location:login.php');
}

// delete message from database

if(isset($_POST['delete_msg'])){
    $delete_id=$_POST['delete_id'];
    $delete_id=filter_var($delete_id,FILTER_SANITIZE_STRING);

    $verify_delete="select * from message where id='$delete_id'";
    $verify_delete=mysqli_query($con,$verify_delete);

    if(mysqli_num_rows($verify_delete)>0){
        $delete_msg="delete from message where id='$delete_id'";
        $delete_msg=mysqli_query($con,$delete_msg);

        $success_msg[]='message deleted successfully';
    }
    else{
        $warning_msg[]='message already deleted';
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

    <title>Grren Sky Summer - seller registration page</title>

    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">

   <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    
</head>

<body>
    <div class="main-container">
<?php include '../components/admin_header.php'; ?>

<section class="message-container">
<div class="heading">
<h1>unread messages</h1>
<img src="../image/separator-img.png">
</div>

<div class="box-container">
<?php 
$select_message="select * from message";
$select_message=mysqli_query($con,$select_message);
if(mysqli_num_rows($select_message)>0){
    while($fetch_message=mysqli_fetch_assoc($select_message)){

?>

<div class="box">
<h3 class="name"><?= $fetch_message['name']; ?></h3>
<h4><?= $fetch_message['subject'];?></h4>
<p><?= $fetch_message['message']; ?></p>
<form action="" method="post">
<input type="hidden" name="delete_id" value="<?=$fetch_message['id']; ?>">
<input type="submit" name="delete_msg" value="delete message" class="btn" onclick="return conform('delete this message');>



</form>
</div>
       
<?php
                    }
                } else {
                    echo '</div>
<div class="empty">
<p>no unread message yet!</p>
</div>';
                }       
                ?>

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