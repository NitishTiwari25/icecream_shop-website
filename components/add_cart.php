<?php

if(isset($_POST['add_to_cart'])){
    if($user_id!=''){
        $id=unique_id();
        $product_id=$_POST['product_id'];

        $qty=$_POST['qty'];
        $qty=filter_var($qty,FILTER_SANITIZE_STRING);

        $verify_cart="select * from cart where user_id='$user_id' and product_id='$product_id'";
        $verify_cart=mysqli_query($con,$verify_cart);

        $max_cart_items="select * from cart where user_id='$user_id'";
        $max_cart_items=mysqli_query($con,$max_cart_items);

        if(mysqli_num_rows($verify_cart)>0){
            $warning_msg[]='product already exist in your cart';
        }else if(mysqli_num_rows($max_cart_items)>20){
            $warning_msg[]='your cart is full';
        }else{
            $select_price="select * from products where id='$product_id' Limit 1";
            $select_price=mysqli_query($con,$select_price);
            $fetch_price=mysqli_fetch_assoc($select_price);

            $insert_cart = $con->prepare("INSERT INTO cart (id,user_id,product_id,price,qty) VALUES(?,?,?,?,?)");
    $insert_cart->execute([$id,$user_id, $product_id, $fetch_price['price'],$qty]);
    $success_msg[]="product added to your cart successfully";

        }
    }else{
        $warning_msg[]='please login first';
    }
}


?>