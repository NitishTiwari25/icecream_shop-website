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
    $user_id = 'location:login.php';
    // header('location:login.php');
}


include 'components/add_cart.php';

// remove items from wishlist
if(isset($_POST['delete_item'])){

    $wishlist_id=$_POST['wishlist_id'];
    $wishlist_id=filter_var($wishlist_id,FILTER_SANITIZE_STRING);

    // $verify_delete=$con->prepare("SELECT * FROM wishlist WHERE id=?");
    // $verify_delete->execute([$wishlist_id]);

    $verify_delete="select * from wishlist where product_id='$wishlist_id'";
    $verify_delete=mysqli_query($con,$verify_delete);

    if(mysqli_num_rows($verify_delete)>0){
       
       
    //    $delete_wishlist_id=$con->prepare("DELETE FROM wishlist WHERE id=?");
    //    $delete_wishlist_id->execute([$wishlist_id]);
       
        $delete_wishlist_id="delete from wishlist where product_id='$wishlist_id'";
        $delete_wishlist_id=mysqli_query($con,$delete_wishlist_id);
        $success_msg[]='itme removed from wishlist';
    }else{
        $warning_msg[]='item already removed';
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - my wishlist page</title>

    <link rel="stylesheet" type="text/css" href="css/user_style.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


</head>

<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>my wishlist</h1>
            <p>lorem is best</p>
            <span> <a href="home.php">home </a><i class="bx bx-right-arrow-alt"></i>our shop</span>
        </div>
    </div>




    <div class="products">
        <div class="heading">
            <h1>my wishlist</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
           <?php
           $grand_total=0;
           $select_wishlist="select * from wishlist where user_id='$user_id'";
           $select_wishlist=mysqli_query($con,$select_wishlist);

           if(mysqli_num_rows($select_wishlist)>0){
            while($fetch_wishlist=mysqli_fetch_assoc($select_wishlist)){
                $select_products="select * from products where id='$fetch_wishlist[product_id]'";
                $select_products=mysqli_query($con,$select_products);

                if(mysqli_num_rows($select_products)>0){
                    $fetch_products=mysqli_fetch_assoc($select_products);



                    ?>

                    <form action="" method="post" class="box <?php if($fetch_products['stock']==0){echo "disabeled"; }   ?>">
                    <input type="hidden" name="wishlist_id" value="<?=$fetch_products['id']; ?>">
                    <img src="uploaded_files/<?=$fetch_products['image']; ?>" class="image">
                    <?php if($fetch_products['stock']>9){ ?>
                            <span class="stock" style="color:green;" > in stock</span>


                  <?php  }else if($fetch_products['stock']==0){
                     ?>
                     <span class="stock" style="color:red;" >out of stock</span>


<?php }else{ ?>
    <span class="stock" style="color:red;" > Hurry, only <?=$fetch_products['stock']; ?> left</span>

    <?php } ?>

    <div class="content">
        <img src="image/shape-19.png" class="shap">
        <div class="button">
            <div><h3><?=$fetch_products['name']; ?> </h3></div>
            <div >
            <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
            
            <a href="view_page.php?pid=<?=$fetch_products['id']; ?> " class="bx bxs-show"></a>
            <button type="submit" name="delete_item"><i class="bx bx-x"></i></button>
            </div>
        </div>
        <input type="hidden" name="product-id" value="<?=$fetch_products['id']; ?>">
        <div class="flex">
            <p class="price">price ₹<?=$fetch_products['price']; ?>/-</p>
        </div>
        <div class="flex">
            <input type="hidden" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
            <a href="checkout.php?get_id=<?=$fetch_products['id']; ?>" class="btn">buy now</a>
        </div>
    </div>

                    </form>


                    <?php

                    $grand_total=$fetch_wishlist['price'];

                }
            }
           }else{
            echo '<div class="empty">
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