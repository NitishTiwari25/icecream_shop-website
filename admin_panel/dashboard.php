<?php
include '../components/connect.php';

// if (isset($_COOKIE['seller_id'])) {

//     $seller_id=$_COOKIE['seller_id'];
// }else{
//     $seller_id='';
//     header('location:login.php');
// }

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

        <section class="dashboard">
            <div class="heading">
                <h1>dashboard</h1>
                <img src="../image/separator-img.png">
            </div>

            <div class="box-container">
                <div class="box">
                    <h3>welcome !</h3>
                    <p>
                        <?= $fetch_profile['name']; ?>
                    </p>
                    <a href="update.php" class="btn">update profile</a>

                </div>
                <div class="box">
                    <?php
                    // $select_message=$con->prepare("SELECT * FROM message");
                    // $select_message->execute();
                    // $number_of_message=$select_message->rowCount();
                    
                    // or
                    $select_message = "select * FROM message";
                    $result = mysqli_query($con, $select_message);  // give output in only 1 or 0
                    $number_of_message = mysqli_num_rows($result);

                    ?>
                    <h3>
                        <?= $number_of_message; ?>
                    </h3>
                    <p>unread message</p>
                    <a href="admin_message.php" class="btn">see message</a>
                </div>

                <div class="box">
                    <?php
                    $seller_product = "select * FROM products where seller_id='$seller_id'";
                    $result = mysqli_query($con, $seller_product);  // give output in only 1 or 0
                    $number_of_products = mysqli_num_rows($result);

                    ?>
                    <h3>
                        <?= $number_of_products; ?>
                    </h3>
                    <p>product added</p>
                    <a href="add_product.php" class="btn">add product</a>
                </div>


                <div class="box">
                    <?php
                    $seller_active_product = "select * FROM products where seller_id='$seller_id' AND status='active'";
                    $result = mysqli_query($con, $seller_active_product);  // give output in only 1 or 0
                    $number_of_active_products = mysqli_num_rows($result);

                    ?>
                    <h3>
                        <?= $number_of_active_products; ?>
                    </h3>
                    <p>total active products</p>
                    <a href="view_product.php" class="btn">active product</a>
                </div>

                <div class="box">
                    <?php
                    $seller_deactive_product = "select * FROM products where seller_id='$seller_id' AND status='deactive'";
                    $result = mysqli_query($con, $seller_deactive_product);  // give output in only 1 or 0
                    $number_of_deactive_products = mysqli_num_rows($result);

                    ?>
                    <h3>
                        <?= $number_of_deactive_products; ?>
                    </h3>
                    <p>total deactive products</p>
                    <a href="view_product.php" class="btn">deactive product</a>
                </div>

                <div class="box">
                    <?php
                    $select_users = "select * FROM message";
                    $result = mysqli_query($con, $select_users);  // give output in only 1 or 0
                    $number_of_users = mysqli_num_rows($result);

                    ?>
                    <h3>
                        <?= $number_of_users; ?>
                    </h3>
                    <p>users account</p>
                    <a href="user_account.php" class="btn">see users</a>
                </div>

                <div class="box">
                    <?php
                    $select_sellers = "select * FROM message";
                    $result = mysqli_query($con, $select_sellers);  // give output in only 1 or 0
                    $number_of_sellers = mysqli_num_rows($result);

                    ?>
                    <h3>
                        <?= $number_of_sellers; ?>
                    </h3>
                    <p>sellers account</p>
                    <a href="user_account.php" class="btn">see sellers</a>
                </div>

                <div class="box">
                    <?php
                    $select_orders = "select * FROM orders where id='$seller_id'";
                    $result = mysqli_query($con, $select_orders);  // give output in only 1 or 0
                    $number_of_orders = mysqli_num_rows($result);

                    ?>
                    <h3>
                        <?= $number_of_orders; ?>
                    </h3>
                    <p>order placed</p>
                    <a href="admin_order.php" class="btn">total orders</a>
                </div>

                <div class="box">
                    <?php
                    $select_confirm_orders = "select * FROM orders where id='$seller_id' AND status='in progress'";
                    $result = mysqli_query($con, $select_confirm_orders);  // give output in only 1 or 0
                    $number_of_confirm_orders = mysqli_num_rows($result);

                    ?>
                    <h3>
                        <?= $number_of_confirm_orders; ?>
                    </h3>
                    <p>total confirm orders</p>
                    <a href="admin_order.php" class="btn">confirm orders</a>
                </div>

                <div class="box">
                    <?php
                    $select_canceled_orders = "select * FROM orders where id='$seller_id' AND status='canceled'";
                    $result = mysqli_query($con, $select_canceled_orders);  // give output in only 1 or 0
                    $number_of_canceled_orders = mysqli_num_rows($result);

                    ?>
                    <h3>
                        <?= $number_of_canceled_orders; ?>
                    </h3>
                    <p>total canceled orders</p>
                    <a href="admin_order.php" class="btn">canceled orders</a>
                </div>

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