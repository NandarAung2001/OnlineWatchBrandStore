<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

   <img src="images/ij.png" width="130px" height="60px" class="logo" alt="Logo">
   <nav class="navbar">

         <a href="home.php">Home</a>
         <a href="about.php">About</a>
         <a href="shop.php">Shop</a>
         <a href="orders.php">Order</a>
         <!-- <a href="about.php">About</a> -->
         <!-- <a href="search_page.php">About</a> -->

         <!-- <a href="blog1.html">Blog</a> -->

         <a href="contact.php">Contact</a>
      </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <!-- <a href="search_page.php"><i class="fas fa-search"></i></a> -->
         <a href="wishlist.php"class="wishlist"><i class="fas fa-heart"></i>
         <span><?php echo $total_wishlist_counts; ?></span></a>
         <a href="cart.php"class="cart"><i class="fas fa-shopping-cart"></i>
         <span><?php echo $total_cart_counts; ?></span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <a href="search_page.php"><i class="fas fa-search"></i></a>

      </div>


      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn">update profile</a>
         <a href="user_register.php" class="option-btn">register</a>
         <div class="flex-btn">

            <a href="user_login.php" class="option-btn">login</a>

         </div>
         <a href="user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a>   
         <!-- <a href="user_logout.php" id="logout-link" class="delete-btn">logout</a>  -->
<!-- 
<script>
document.getElementById('logout-link').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default action of following the link

    if (confirm('Are you sure you want to logout?')) {
        window.location.href = 'user_login.php'; // Redirect to logout script
    }
});



</script>  -->

         <?php
            }else{
         ?>
         <p>Please login or register first!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>