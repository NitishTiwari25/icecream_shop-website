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

include 'components/add_to_wishlist.php';

include 'components/add_cart.php';




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - our shop page</title>

    <link rel="stylesheet" type="text/css" href="css/user_style.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


</head>

<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>our shop</h1>
            <p>lorem is best</p>
            <span> <a href="home.php">home </a><i class="bx bx-right-arrow-alt"></i>our shop</span>
        </div>
    </div>




    <div class="products">
        <div class="heading">
            <h1>our latest flavours</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
            // $select_products = $con->prepare("SELECT * FROM 'products' WHERE status=?");
            // $select_products->execute(['active']);

            $select_products="select * from products where status='active'";
            $select_products=mysqli_query($con,$select_products);

          
            // $result=mysqli_query($con,$query);  // give output in only 1 or 0
            
            

            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {


                    ?>

                <form action="" method="post" class="box <?php if($fetch_products['stock']==0){
                    echo "disabeled";   } ?>">
                    <img src="uploaded_files/<?= $fetch_products['image']; ?>">

                    <?php if($fetch_products['stock']>9){
                        ?>
                        <span class="stock" style="color:green;">In stock</span>
                        <?php } elseif($fetch_products['stock']==0){ ?> 
                                <span class="stock" style="color:red;">out of stcok</span>
                        <?php }else{ ?>
                            <span class="stock" style="color:red;">Hurry only <?=$fetch_products['stock']; ?></span>
                            <?php    } ?>


                            <div class="content">
                                <img src="image/shape-19.png" alt="" class="shap">
                                <div class="button">
                                    <div> <h3 class="name"><?=$fetch_products['name']; ?></h3></div>
                                    <div >
                                        <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                                        <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                                        <a href="view_page.php?pid=<?=$fetch_products['id']; ?> " class="bx bxs-show"></a>
                                    </div>
                                </div>
                                    <p class="price">price ₹<?=$fetch_products['price'];?></p>
                                    <input type="hidden" name="product_id" value="<?=$fetch_products['id']; ?>">
                                    <div class="flex-btn">
                                        <a href="checkout.php?get_id=<?=$fetch_products['id']; ?>" class="btn">buy now</a>
                                        <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty box">
                                    </div>
                                </div>
                            
                </form>
                
                    <?php
                }
            } else {
                echo '
            <div class="empty">
               <p>no products added yet!</p>
            </div>';
            }
            ?>
        </div>
    </div>








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