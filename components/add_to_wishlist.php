<?php

if(isset($_POST['add_to_wishlist'])){
    if($user_id!=''){
        $id=unique_id();
        $product_id=$_POST['product_id'];

        $verify_wishlist= "select * from wishlist where user_id='$user_id' and product_id='$product_id'";
        $verify_wishlist=mysqli_query($con,$verify_wishlist);

        $cart_num="select * from cart where user_id='$user_id' and product_id='$product_id'";
        $cart_num=mysqli_query($con,$cart_num);

        if(mysqli_num_rows($verify_wishlist)>0)
{
    $warning_msg[]='product already exist in your wishlist';
}    else if(mysqli_num_rows($cart_num)>0){
    $warning_msg[]='product already exist in your cart';
}elseif ($user_id!='') {
    $select_price="select * from products where id='$product_id' Limit 1";
    $select_price=mysqli_query($con,$select_price);
    $fetch_price=mysqli_fetch_assoc($select_price);


    $insert_wishlist = $con->prepare("INSERT INTO wishlist (id,user_id,product_id,price) VALUES(?,?,?,?)");
    $insert_wishlist->execute([$id,$user_id, $product_id, $fetch_price['price']]);
    $success_msg[]="product added to your wishlist successfully";

}
}else{
    $warning_msg[]='please login first';
}
}

?>