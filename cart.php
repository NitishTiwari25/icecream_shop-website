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





// update qty in cart


if(isset($_POST['update_cart'])){
    $cart_id=$_POST['cart_id'];
    $cart_id=filter_var($cart_id,FILTER_SANITIZE_STRING);

    $qty=$_POST['qty'];
    $qty=filter_var($qty,FILTER_SANITIZE_STRING);


    // $update_qty=$con->prepare("UPDATE cart SET qty=? WHERE id=?");
    // $update_qty->execute([$qty,$cart_id]);


    $update_qty="update cart set qty='$qty' where id='$cart_id'";
    $update_qty=mysqli_query($con,$update_qty);

    $success_msg[]='cart quantity updated successfully';

}



//delete products from cart
if(isset($_POST['delete_item'])){
    $cart_id=$_POST['cart_id'];
    $cart_id=filter_var($cart_id,FILTER_SANITIZE_STRING);

    $verify_delete_item="select * from cart where id='$cart_id'";
    $verify_delete_item=mysqli_query($con,$verify_delete_item);

    if(mysqli_num_rows($verify_delete_item)>0){
        $delete_cart="delete from cart where id='$cart_id'";
        $delete_cart=mysqli_query($con,$delete_cart);

        $success_msg[]='cart item delete successfully';
    }else{
        $warning_msg[]='cart item already deleted';
    }
}


//empty cart

if(isset($_POST['empty_cart'])){
   
    $verify_empty_item="select * from cart where user_id='$user_id'";
    $verify_empty_item=mysqli_query($con,$verify_empty_item);

    if(mysqli_num_rows($verify_empty_item)>0){

        $delete_cart_id="delete from cart where user_id='$user_id'";
        $delete_cart_id=mysqli_query($con,$delete_cart_id);

        $success_msg[]='empty cart successfully';
    }else{
        $warning_msg[]='your cart is already empty';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - user cart page</title>

    <link rel="stylesheet" type="text/css" href="css/user_style.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- font -awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


</head>
<body>
    
<?php include 'components/user_header.php'; ?>
<div class="banner">
    <div class="detail">
        <h1>cart</h1>
        <p>lorem is best</p>
        <span> <a href="home.php">home </a><i class="bx bx-right-arrow-alt"></i>about us</span>
    </div>
</div>


<div class="products">
    <div class="heading">
        <h1>my cart</h1>
        <img src="image/separator-img.png">
    </div>
    <div class="box-container">
        <?php

        $grand_total=0;
        $select_cart="select * from cart where user_id='$user_id'";
        $select_cart=mysqli_query($con,$select_cart);

        if(mysqli_num_rows($select_cart)>0){
            while($fetch_cart=mysqli_fetch_assoc($select_cart)){
                $select_products="select * from products where id='$fetch_cart[product_id]'";
                $select_products=mysqli_query($con,$select_products);

                if(mysqli_num_rows($select_products)>0){
                    $fetch_products=mysqli_fetch_assoc($select_products);
                    

                    ?>
                    <form action="" method="post" class="box <?php if($fetch_products['stock']==0){
                        echo 'disabeled' ; } ?>">
                        <!-- <input type="visible" name="cart_id" value="<?=$fetch_cart['id']; ?>"> -->


                        <input type="hidden" name="cart_id" value="<?=$fetch_cart['id']; ?>">
                        <img src="uploaded_files/<?=$fetch_products['image']; ?>" class="image">

                        <?php  if($fetch_products['stock']>9){   ?>
                            <span  class="stock" style="color:green;">In stock</span>

                        <?php } elseif($fetch_products['stock']==0){?>
                            <span  class="stock" style="color:red;">out of stock</span>
                            <?php } else{?>

                                <span  class="stock" style="color:red;">Hurry only <?=$fetch_products['stock']; ?>left </span>
                                <?php }?>

                                <div class="content">
                                    <img src="image/shape-19.png" class="shap">
                                    <h3 class="name"><?=$fetch_products['name']; ?></h3>
                                    <div class="flex-btn">
                                        <p class="price">price ₹ <?=$fetch_products['price']; ?> /- </p>
                                        <input type="number" name="qty" required min="1" value="<?=$fetch_cart['qty']; ?>" max="99" maxlength="2" class="box qty">
                                        <button type="submit" name="update_cart" class="bx bxs-edit fa-edit box"></button>
                                    </div>
                                    <div class="flex-btn">
                                        <p class="sub-total">sub total : <span><?=$sub_total= ($fetch_cart['qty'] *$fetch_cart['price']);  ?> </span></p>
                                        <button type="submit" name="delete_item" class="btn" onclick="return confirm ('remove from cart');" >delete</button>
                                    </div>
                                </div>
                </form>

                <?php
                    $grand_total+=$sub_total;
                            }else{
                                echo 
                                ' <div class="empty">
                                <p>no products was found!</p>
                                </div>';
                            }

                }
            }else {
                echo 
                                ' <div class="empty">
                                <p>no products added yet!</p>
                                </div>';

            
        }

        ?>

    </div>

    <?php if($grand_total!=0){ ?>
        <div class="cart-total">
            <p> total amount payable : <span> ₹ <?=$grand_total; ?> /- </span></p>
            <div class="button">
                <form action="" method="post">
                    <button type="submit" name="empty_cart" class="btn" onclick="return confirm ('are your sure to empty your cart'); ">empty cart</button>
                </form>
                <a href="checkout.php" class="btn" >proceed to checkout</a>
    </div>
        </div>
</div>
        <?php } ?>
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