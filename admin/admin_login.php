<?php

// Include the database connection script
include '../components/connect.php';

// Start a new session or resume the existing session
session_start();

// Check if the form is submitted
if(isset($_POST['submit'])){

   // Get the username from the form and sanitize it
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   
   // Get the password from the form, hash it with SHA-1, and sanitize it
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   // Prepare a SQL query to select an admin with the given username and password
   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   
   // Fetch the result as an associative array
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   // Check if any row is returned
   if($select_admin->rowCount() > 0){
      // If yes, store the admin's ID in the session and redirect to the dashboard
      $_SESSION['admin_id'] = $row['id'];
      header('location:dashboard.php');
   }else{
      // If no, add an error message to the $message array
      $message[] = 'incorrect username or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <!-- Link to Bootstrap CSS for styling -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
   <!-- Link to Font Awesome CSS for icons -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- Link to custom CSS for additional styles -->
   <link rel="stylesheet" href="../css/admin_style.css">
   
   <style>
      .input-group {
         position: relative;
      }
      .input-group .toggle-password {
         position: absolute;
         right: 10px;
         top: 50%;
         transform: translateY(-50%);
         cursor: pointer;
      }
   </style>
</head>
<body>

<?php
   // Display any messages if they exist
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

 <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                    <!-- Placeholder for side image -->
                    <img src="../images/.jpg" alt="">
                    <div class="text">
                        <!-- Optional text can be added here -->
                    </div>
                </div>
                <div class="col-md-6 right">
                     <div class="input-box">
                     <section class="form-containers">
                        <!-- Login form starts here -->
                        <form action="" method="post">
                           <h2>Welcome</h2>
                           <h3>login now</h3>
                           <!-- Input for username -->
                           <input type="text" name="name" required placeholder="Enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                           
                           <!-- Input group for password with toggle icon -->
                           <div class="input-group">
                              <input type="password" name="pass" id="password" required placeholder="Enter your password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                              <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
                           </div>
                           
                           <!-- Submit button -->
                           <input type="submit" value="login now" class="btn" name="submit">
                        </form>
                     </section>
                     </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
      // Function to toggle password visibility
      function togglePassword() {
         var passwordField = document.getElementById("password");
         var icon = document.querySelector(".toggle-password");
         
         // Toggle the password field type between text and password
         if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
         } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
         }
      }
   </script>
   
</body>
</html>
