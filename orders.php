<?php

// Include the database connection file
include 'components/connect.php';

// Start the session
session_start();

// Check if the user is logged in and set the user ID
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Clients' Orders</title>
   
   <!-- Font Awesome for icons -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- Include the user header component -->
<?php include 'components/user_header.php'; ?>

<!-- Orders Section -->
<section class="orders">

   <h1 class="heading">Clients' Orders</h1>
   
   <!-- Image Section -->
   <div class="row">
      <div class="image">
         <center>
         <img src="https://i.pinimg.com/564x/ca/0e/fd/ca0efd8cd44e65963c07f7aaf9d87d6f.jpg" alt="Client Order Watch Photo" width="800" height="300">
         <center>
      </div>
   </div>

   <!-- Orders Box Container -->
   <div class="box-container">

   <?php
      // Check if the user is logged in
      if($user_id == ''){
         echo '<p class="empty">please login to see your orders</p>';
      }else{
         // Select orders from the database for the logged-in user
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         
         // Check if there are any orders
         if($select_orders->rowCount() > 0){
            // Fetch and display each order
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>Date: <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>Name : <span><?= $fetch_orders['name']; ?></span></p>
      <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>Number : <span><?= $fetch_orders['number']; ?></span></p>
      <p>Address : <span><?= $fetch_orders['address']; ?></span></p>
      <p>Payment method : <span><?= $fetch_orders['method']; ?></span></p>
      <p>Your orders : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>Total price : <span>$<?= $fetch_orders['total_price']; ?>/-</span></p>
      <p>Payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
   </div>
   <?php
            }
         }else{
            // Display message if no orders found
            echo '<p class="empty">no orders placed yet!</p>';
         }
      }
   ?>

   </div>

</section>

<!-- Include the footer component -->
<?php include 'components/footer.php'; ?>

<!-- Custom JS -->
<script src="js/script.js"></script>

</body>
</html>
