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

      <a href="../admin/dashboard.php" class="logo">Admin</a>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

   </section>


<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
         <h3>@JADE</h3> 
   </div>


<nav class="navbar">
      <a href="../admin/dashboard.php"><i class="fas fa-home"></i><span>Home</span></a>
      <a href="../admin/products.php"><i class="fa-solid fa-bars-staggered"></i><span>Product</span></a>
      <a href="../admin/placed_orders.php"><i class="fa-solid fa-bag-shopping"></i><span>Order</span></a>
      <a href="../admin/users_accounts.php"><i class="fa-regular fa-user"></i><span>User</span></a>
      <a href="../admin/admin_accounts.php"><i class="fa-solid fa-user-tie"></i><span>Admin</span></a>
      <a href="../admin/messages.php"><i class="fas fa-comment"></i><span>Message</span></a>
      <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
   </nav>

   </header>
