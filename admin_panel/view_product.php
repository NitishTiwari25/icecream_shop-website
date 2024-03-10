<?php
include '../components/connect.php';

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


// delete product
if(isset($_POST['delete'])){
    $p_id=$_POST['product_id'];
    $p_id=filter_var($p_id,FILTER_SANITIZE_STRING);

    $delete_product="delete from products where id='$p_id'";
    // $execute=mysqli_query($con,$delete_product);


    // $sql = "DELETE FROM MyGuests WHERE id=3";

    if ($con->query($delete_product) === TRUE) {
      echo "Record deleted successfully";
    } else {
      echo "Error deleting record: " . $con->error;
    }


//    $num= mysqli_num_rows($execute);

    // $delete_product=$con->prepare("DELETE FROM products WHERE id=?");
    // $delete_product->execute([$p_id]);

    $success_msg[]='product deleted successfully';
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

<section class="show-post">
<div class="heading">
<h1>your products</h1>
<img src="../image/separator-img.png">
</div>
<div class="box-container">
<?php 
$select_products="select * from products where seller_id='$seller_id'";
          
$result=mysqli_query($con,$select_products);  // give output in only 1 or 0

// for checking that our data is fetching or not
if(mysqli_num_rows($result) > 0){
    // for fetching the data
    $fetch_products=mysqli_fetch_array($result);
    // $_SESSION['']=$userdata;
}else{
    $warning_msg[] = "not feching";
}


if(mysqli_num_rows($result)>0){  
    while($fetch_products=mysqli_fetch_array($result)){     
        // $select_products->fetch(PDO::FETCH_ASSOC)
?>
<form action="" method="post" class="box">
        <input type="hidden" name="product_id" value="<?=$fetch_products['id']; ?>">

        <!-- <input type="visible" name="product_id" value="<?=$fetch_products['id']; ?>"> -->
        <!-- <input type="visible" name="product_id" value="post_id=<?=$fetch_products['id'];?>"> -->
        
        <?php if($fetch_products['image']!=''){ ?>
            <img src="../uploaded_files/<?= $fetch_products['image']; ?>" class="image" >
    <?php
        } 
        ?>

        <div class="status" style="color: <?php if($fetch_products['status']=='active'){
            echo "limegreen";}else{echo "red";} ?>"><?= $fetch_products['status']; ?></div> 
            <div class="price">₹<?= $fetch_products['price']; ?>/-</div>

            <div class="content">
                <img src="../image/shape-19.png" class="shap">
                <div class="title"><?= $fetch_products['name']; ?></div>
                <div class="flex-btn">
                    <a href="edit_product.php?id=<?=$fetch_products['id'];?>" class="btn">edit</a>
                    <button type="submit" name="delete" class="btn" onclick="return confirm('delete this product');">delete</button>
                    <!-- for transfer id fromthis page to read_product page -->
                    <!-- lessCopy code// sending page 
// <a href="receivingpage.php?data=value">Link</a>  -->

<a href='read_product.php?post_id=<?=$fetch_products['id'];?>'class="btn" >read</a>
                    <!-- <a href="read_product.php?post_id=<?=$fetch_products['id'];?>" class="btn">read</a> -->
                    <!-- post_id -->
                </div>
            </div>
    </form>

<?php
}
}else{
    echo '</div>
    <div class="empty">
    <p>no products added yet!<br> <a href="add_product.php" class="btn" style="margin-top:1.5rem;">add products</a></p>
    </div>';
}
?>

</div>



</section>






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