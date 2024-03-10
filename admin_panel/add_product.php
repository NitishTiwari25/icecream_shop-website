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

if(isset($_POST['publish'])){
    $id=unique_id();
    $name=$_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);

    $stock=$_POST['stock'];
    $stock=filter_var($stock,FILTER_SANITIZE_STRING);

    $status='active';

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    // $ext = pathinfo($image, PATHINFO_EXTENSION);
    // $rename = unique_id().'.'.$ext;

    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/'.$image;

    $select_image="select * from products where image='$image' AND id='$seller_id'";
          
    $result=mysqli_query($con,$select_image);  // give output in only 1 or 0
    
    # check already present or not
    // $num=mysqli_num_rows($result);

    if(isset($image)){
        if(mysqli_num_rows($result)>0){
            $warning_msg[] = "image name repeat";
        }
        elseif($image_size > 2000000){
            $warning_msg[] = "image size is too large";
        }
        else{
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    }else{
        $image='';
    }
    if((mysqli_num_rows($result)>0) AND ($image!='')){
        $warning_msg[] = "please rename your image";
    }
    else{
        $insert_product = $con->prepare("INSERT INTO products (id,seller_id,name,price,image,stock,product_detail,status) VALUES(?,?,?,?,?,?,?,?)");
        $insert_product->execute([$id,$seller_id, $name, $price, $image,$stock,$description,$status]);
        $success_msg[]="product inserted successfully";
    }
}


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

if(isset($_POST['draft'])){
    $id=unique_id();
    $name=$_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);

    $stock=$_POST['stock'];
    $stock=filter_var($stock,FILTER_SANITIZE_STRING);

    $status='deactive';

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    // $ext = pathinfo($image, PATHINFO_EXTENSION);
    // $rename = unique_id().'.'.$ext;

    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/'.$image;

    $select_image="select * from products where image='$image' AND id='$seller_id'";
          
    $result=mysqli_query($con,$select_image);  // give output in only 1 or 0
    
    # check already present or not
    // $num=mysqli_num_rows($result);

    if(isset($image)){
        if(mysqli_num_rows($result)>0){
            $warning_msg[] = "image name repeat";
        }
        elseif($image_size > 2000000){
            $warning_msg[] = "image size is too large";
        }
        else{
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    }else{
        $image='';
    }
    if((mysqli_num_rows($result)>0) AND ($image!='')){
        $warning_msg[] = "please rename your image";
    }
    else{
        $insert_product = $con->prepare("INSERT INTO products (id,seller_id,name,price,image,stock,product_detail,status) VALUES(?,?,?,?,?,?,?,?)");
        $insert_product->execute([$id,$seller_id, $name, $price, $image,$stock,$description,$status]);
        $success_msg[]="product saved as draft successfully";
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

    <title>Grren Sky Summer - Admin add products page</title>

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
                <h1>add product</h1>
                <img src="../image/separator-img.png">
            </div>

            <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <div class="input-field">
                <p>product name<span>*<span></p>
                <input type="text" name="name" maxlength="100" placeholder="add product name" required class="box">
                </div>
                <div class="input-field">
                <p>product price<span>*<span></p>
                <input type="number" name="price" maxlength="100" placeholder="add product price" required class="box">
                </div>
                <div class="input-field">
                <p>product detail<span>*<span></p>
               <textarea name="description" required maxlength="1000" placeholder="add product detail" class="box" ></textarea>
                </div>
                <div class="input-field">
                <p>product stock<span>*<span></p>
                <input type="number" name="stock" maxlength="10" min="0" max="999999999" placeholder="add product stock" required class="box">
                </div>
                <div class="input-field">
                <p>product image<span>*<span></p>
                <input type="file" name="image" accept="image/*" required class="box">
                </div>
                <div class="flex-btn">
                    <input type="submit" name="publish" value="add product" class="btn">
                    <input type="submit" name="draft" value="save as draft" class="btn">
                </div>    
            </form>
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