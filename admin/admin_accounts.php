<?php

// Include the database connection file
include '../components/connect.php';

// Start the session
session_start();

// Get the admin ID from the session
$admin_id = $_SESSION['admin_id'];

// Redirect to admin login if admin is not logged in
if(!isset($admin_id)){
   header('location:admin_login.php');
}

// Delete admin account if 'delete' parameter is set in the URL
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
   $delete_admins->execute([$delete_id]);
   header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin accounts</title>

   <!-- Font Awesome for icons -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<!-- Include the admin header component -->
<?php include '../components/admin_header.php'; ?>

<div class="banner-box5 f-slide-3">
   <div class="banner-text-container5">
      <div class="banner-text5">
         <!-- Banner text can be added here if needed -->
      </div>
   </div>
</div>

<!-- Admin Accounts Section -->
<section class="accounts1">

   <h1 class="heading">admin accounts</h1>

   <div class="box-container">

      <!-- Box for adding a new admin -->
      <div class="box">
         <p>Add New Admin</p>
         <a href="register_admin.php" class="option-btn">register admin</a>
      </div>

      <?php
         // Select all admin accounts from the database
         $select_accounts = $conn->prepare("SELECT * FROM `admins`");
         $select_accounts->execute();

         // Check if any admin accounts are found
         if($select_accounts->rowCount() > 0){
            // Fetch and display each admin account
            while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
      ?>
      <div class="box">
         <p> Admin ID : <span><?= $fetch_accounts['id']; ?></span> </p>
         <p> Admin Name : <span><?= $fetch_accounts['name']; ?></span> </p>
         <div class="flex-btn">
            <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('delete this account?')" class="delete-btn">delete</a>
         </div>
         <?php
               // Show update button if the fetched account is the currently logged-in admin
               if($fetch_accounts['id'] == $admin_id){
                  echo '<a href="update_profile.php" class="option-btn">update</a>';
               }
            ?>
      </div>
      <?php
            }
         }else{
            // Display message if no admin accounts are found
            echo '<p class="empty">No accounts available!</p>';
         }
      ?>

   </div>

</section>

<!-- Custom JS -->
<script src="../js/admin_script.js"></script>
   
</body>
</html>
