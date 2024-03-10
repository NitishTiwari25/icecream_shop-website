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

if(isset($_POST['update'])){
    $product_id=$_POST['product_id'];
    $product_id=filter_var($product_id,FILTER_SANITIZE_STRING);

   
    $name=$_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);

    $stock=$_POST['stock'];
    $stock=filter_var($stock,FILTER_SANITIZE_STRING);

    $status=$_POST['status'];
    $status=filter_var($status,FILTER_SANITIZE_STRING);

$update_product="update products set name='$name',price='$price',product_detail='$description',stock='$stock',status='$status' where id='$product_id'";
$update_product=mysqli_query($con,$update_product);

$success_msg[]='product updated';

    $old_image=$_POST['old_image'];
    $image = $_FILES['image']['name'];
    // $image = filter_var($image, FILTER_SANITIZE_STRING);
    // $ext = pathinfo($image, PATHINFO_EXTENSION);
    // $rename = unique_id().'.'.$ext;

    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/'.$image;

    $select_image="select * from products where image='$image' AND seller_id='$seller_id'";
    $select_image=mysqli_query($con,$select_image);


    if(!empty($image)){
        if($image_size > 2000000){
            $warning_msg[]='image size is too large';
        }elseif( mysqli_num_rows($select_image)>0 AND $image != ''){
            $warning_msg[]='please rename your image';
        }else{
            $update_image="update products set image='$image' where id='$product_id'";
            $update_image=mysqli_query($con,$update_image);

            // $update_image=$con->prepare("UPDATE 'products' SET image=? ")

            move_uploaded_file($image_tmp_name,$image_folder);
            if($old_image != $image AND $old_image != ''){
                unlink('../uploaded_files/'.$old_image);
            }
            $success_msg[]="image updated";
        }
    }
}

if(isset($_POST['delete_image'])){
    $empty_image='';

    $product_id=$_POST['product_id'];
    $product_id=filter_var($product_id,FILTER_SANITIZE_STRING);

    $delete_image="select * from products where id='$product_id'";
    $delete_image=mysqli_query($con,$delete_image);
    $fetch_delete_image=mysqli_fetch_array($delete_image);

    if($fetch_delete_image['image']!=''){
        unlink('../uploaded_files/'.$fetch_delete_image['image']);
    }
    $unset_image="update products set image='$image' where id='$product_id'";
    $unset_image=mysqli_query($con,$unset_image);
    $success_msg[]='image deleted successfully';
}

// delete product

if(isset($_POST['delete_product'])){
    $product_id=$_POST['product_id'];
    $product_id=filter_var($product_id,FILTER_SANITIZE_STRING);

    $delete_image="select * from products where id='$product_id'";
    $delete_image=mysqli_query($con,$delete_image);
    $fetch_delete_image=mysqli_fetch_array($delete_image);

    if($fetch_delete_image['image']!=''){
        unlink('../uploaded_files/'.$fetch_delete_image['image']);
    }
    $delete_product="delete from products where id='$product_id'";
    $delete_product=mysqli_query($con,$delete_product);
    $success_msg[]='product deleted successfully';

    header('location:view_product.php');

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

        <section class="post-editor">
            <div class="heading">
                <h1>edit product</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="box-container">
                <?php
                $product_id = $_GET['id'];
                $select_product = "select *from products where id='$product_id' AND seller_id='$seller_id'";

                $result = mysqli_query($con, $select_product);  // give output in only 1 or 0
                
                // for checking that fetching is successful or not 
                // $row = array();
                if (mysqli_num_rows($result) > 0) {
                    while ($fetch_product = mysqli_fetch_array($result)) {
                        //  print_r($rows);
                
                        ?>
                        <div class="form-container">
                            <form action="" method="post" enctype="multipart/form-data" class="register">
                                <input type="hidden" name="old_image" value="<?=$fetch_product['image']; ?>">
                                <input type="hidden" name="product_id" value="<?=$fetch_product['id']; ?>">
                                <div class="input-field">
                                    <p>product status<span>*</span></p>
                                    <select name="status" class="box">
                                        <option value="<?=$fetch_product['status'];?>" selected><?=$fetch_product['status']; ?></option>
                                        <option value="active">active</option>
                                        <option value="deactive">deactive</option>

                                    </select>
                                </div>

                                <div class="input-field">
                                    <p>product name<span>*</span></p>
                                    <input type="text" name="name" value="<?=$fetch_product['name']; ?>" class="box">
                                </div>

                                <div class="input-field">
                                    <p>product price<span>*</span></p>
                                    <input type="number" name="price" value="<?=$fetch_product['price']; ?>" class="box">
                                </div>

                                <div class="input-field">
                                    <p>product description<span>*</span></p>
                                    <textarea name="description" class="box"><?=$fetch_product['product_detail']; ?></textarea>
                                </div>

                                <div class="input-field">
                                    <p>product stock<span>*</span></p>
                                    <input type="number" name="stock" value="<?=$fetch_product['stock']; ?>" class="box" min="0" max="999999999" maxlength="10">
                                </div>

                                <div class="input-field">
                                    <p>product image<span>*</span></p>
                                    <input type="file" name="image" accept="image/*" class="box">
                                    <?php if($fetch_product['image']!=''){?>
                                            <img src="../uploaded_files/<?=$fetch_product['image']; ?>" class="image">
                                            <div class="flex-btn">
                                                <input type="submit" name="delete_image" class="btn" value="delete image">
                                                <a href="view_product.php" class="btn" style="width:49%; text-align: center; height: 3rem; margin-top:.7rem;"> 
                                                go back</a>
                                    </div>

                                   <?php } ?>
                                </div>
                                <br><br>
                                   <div class="flex-btn">
                                            <!-- <a href="view_product.php" class="btn">view product</a>
                                            <a href="add_product.php" class="btn">add product</a> -->
                                            <input type="submit" name="update" value="update product" class="btn">
                                            <input type="submit" name="delete_product" value="delete product" class="btn">
                                   </div>
                            </form>
                        </div>

                        <?php
                    }
                } else {
                    echo '</div>
<div class="empty">
<p>no products added yet!</p>
</div>';
               
                ?>

           
            <br><br>
                                   <div class="flex-btn">
                                            <a href="view_product.php" class="btn">view product</a>
                                            <a href="add_product.php" class="btn">add product</a>
                                   </div>

                                   <?php } ?>
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