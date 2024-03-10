<header class="header">

    <section class="flex">
        <a href="home.php" class="logo"> <img src="image/logo.png" width="130px"></a>
        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="about-us.php">about us</a>
            <a href="menu.php">shop</a>
            <a href="order.php">order</a>
            <a href="contact.php">contact us</a>
        </nav>

        <form action="" method="post" class="search-form">
            <input type="text" name="search_product" placeholder="search product.." required maxlength="100">
            <button type="submit" class="bx bx-search-alt-2" id="search_product_btn"></button>

        </form>
        <div class="icons">
            <div class="bx bx-list-plus" id="menu-btn"></div>
            <div class="bx bx-search-alt-2" id="search-btn"></div>



            <?php

            $count_wishlist_items = "select * from wishlist where user_id='$user_id'";
            $count_wishlist_items = mysqli_query($con, $count_wishlist_items);
            $total_wishlist_items = mysqli_num_rows($count_wishlist_items);
            ?>


            <a href="wishlist.php"><i class="bx bx-heart"></i><sup>
                    <?= $total_wishlist_items; ?>
                </sup></a>

            <?php

            $count_cart_items = "select * from cart where user_id='$user_id'";
            $count_cart_items = mysqli_query($con, $count_cart_items);
            $total_cart_items = mysqli_num_rows($count_cart_items);
            ?>

            <a href="cart.php"><i class="bx bx-cart"></i><sup>
                    <?= $total_cart_items; ?>
                </sup></a>
            <div class="bx bxs-user" id="user-btn"></div>

        </div>

        <div class="profile-detail">

            <?php
            $select_profile = "select * from users where id='$user_id'";
            $select_profile = mysqli_query($con, $select_profile);

            // if (mysqli_num_rows($select_profile)>0) {
            //     // Output data of each row
            //     while($fetch_product = mysqli_fetch_array($select_profile)) {
            //         var_dump($row); // Output the fetched data
            
            //     }
            // }else{
            //     echo "0 result";
            // }
            


            if (mysqli_num_rows($select_profile) > 0) {
                while ($fetch_profile = mysqli_fetch_assoc($select_profile)) {
                    // $fetch_profile=mysqli_fetch_assoc($select_profile);
                    ?>


                    <!-- for checking that id is passing or not  -->
                    <!-- <form>
    <input type="visible" name="user_id" value="<?= $fetch_profile['id']; ?>">
                 <input type="visible" name="user_id" value="<?= $fetch_profile['id']; ?>">
                    </form> -->

                    <img src="uploaded_files/<?= $fetch_profile['image']; ?>">
                    <h3 style="margin-bottom: 1rem;">
                        <?= $fetch_profile['name']; ?>
                    </h3>
                    <div class="flex-btn">
                        <a href="profile.php" class="btn">view profile</a>
                        <a href="components/user_logout.php" onclick="return confirm('logout from this website');"
                            class="btn">logout</a>

                    </div>
                    <?php
                }
            } else { ?>

                <h3 style="margin-bottom:1rem;">please login or register</h3>
                <div class="flex-btn">
                    <a href="login.php" class="btn">login</a>
                    <a href="register.php" class="btn">register</a>

                    <!-- <form>
    <input type="visible" name="user_id" value="<?= $fetch_profile['id']; ?>">
                  <input type="visible" name="user_id" value="<?= $fetch_profile['id']; ?>"> 
                    </form> -->

                </div>
            <?php }
            ?>

        </div>
    </section>


</header>