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

// lessCopy code// sending page 
// <a href="receivingpage.php?data=value">Link</a> 

// receiving page 
// $data = $_GET['data']; 

// $link = explode("=", $_SERVER['REQUEST_URI']);
// $post_id = array_pop($link);

// ye sahi h
$get_id = $_GET['post_id'];


// delete product
if (isset($_POST['delete'])) {
    $p_id = $_POST['product_id'];
    $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

    $delete_image = "select * from products where id='$p_id' AND seller_id='$seller_id'";
    // $execute=mysqli_query($con,$delete_product);
    // $sql = "DELETE FROM MyGuests WHERE id=3";

    $delete_image= mysqli_query($con,$delete_image);

    $fetch_delete_image= mysqli_fetch_array($delete_image);

    if($fetch_delete_image['']!=''){
        unlink('../uploaded_files/'.$fetch_delete_image['image']);
    }
    $delete_product="delete from products where seller_id='$seller_id' AND id='$p_id'";
    $delete_result= mysqli_query($con,$delete_product);
    header('location:view_product.php');



    // if ($con->query($delete_image) === TRUE) {
    //     echo "Record deleted successfully";
    // } else {
    //     echo "Error deleting record: " . $con->error;
    // }

    // $delete_product=$con->prepare("DELETE FROM products WHERE id=?");
    // $delete_product->execute([$p_id]);

    $success_msg[] = 'product deleted successfully';
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

    <title>Grren Sky Summer - show products page</title>

    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


</head>

<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>

        <section class="read-post">
            <div class="heading">
                <h1>product detail</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="box-container">
                <?php

                //   SELECT * FROM `products` WHERE seller_id='hC3zHxs5RumRghmb6Dui' AND id='yAHwAsFjK8xVnq7fhN6A';
                
                // $select_product = "select * from products where id='$get_id' AND seller_id='$seller_id'";
                $select_products = "select * from products where seller_id='$seller_id' AND id='$get_id'";

                $result = mysqli_query($con, $select_products);  // give output in only 1 or 0
                
           // for checking that fetching is successful or not 
                // $row = array();
                if (mysqli_num_rows($result) > 0) {
                while ($fetch_product = mysqli_fetch_array($result)){
                  //  print_r($rows);



                    ?>
                    <form action="" method="post" class="box">
                        <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">

                        <!-- for checking only -->
                        <!-- <input type="visible" name="product_id" value="<?= $get_id; ?>"> -->

                        <div class="status" style="color: <?php if ($fetch_product['status'] == 'active') {
                            echo "limegreen";
                        } else {
                            echo "red";
                        } ?>">
                            <?= $fetch_product['status']; ?>
                        </div>


                        <?php if ($fetch_product['image'] != '') { ?>
                            <img src="../uploaded_files/<?= $fetch_product['image']; ?>" class="image">

                            <div class="price">₹
                                <?= $fetch_product['price']; ?>/-
                            </div>
                            <div class="title">
                                <?= $fetch_product['name']; ?>
                            </div>
                            <div class="content">
                                <?= $fetch_product['product_detail']; ?>
                            </div>
                            <div class="flex-btn">
                                <a href="edit_product.php?id=<?= $fetch_product['id']; ?>" class="btn">edit</a>
                                <button type="submit" name="delete" class="btn"
                                    onclick="return confirm('delete this product');">delete</button>
                                <a href="view_product.php?post_id=<?= $fetch_product['id']; ?>" class="btn">go back</a>
                            </div>



                        <?php } ?>
                    </form>
                    <?php
                }
            } else {
                echo '</div>
<div class="empty">
<p>no products added yet!<br> <a href="add_product.php" class="btn" style="margin-top:1.5rem;">add products</a></p>
</div>';
            }
            ?>
        </div>

        </section>



        <!-- sweetalert cdn link  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <!-- custom  js link -->
        <script src="../js/admin_script.js"></script>

        <?php include '../components/alert.php'; ?>
</body>

</html>