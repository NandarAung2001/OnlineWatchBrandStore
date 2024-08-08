<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
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
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>
<div class="banner-box2 f-slide-3">
        <div class="banner-text-container2">
        <div class="banner-text2">
            <span>"Time to unlock your digital world ⌚️🔑"
            </span>
            <!-- <strong>Login</strong> -->
        </div>
        </div>
    
    </div>
<section class="form-container1">
<div class="row">

<div class="image">
<!-- <img src="https://i.pinimg.com/474x/a3/92/70/a39270ebdb215ddaaa2122378afb7ff0.jpg" alt=""> -->
<img src="https://i.pinimg.com/564x/23/f0/7a/23f07ae377765d0a2af37e200358f575.jpg" alt="" width="300" height="640">
 </div>
   <form action="" method="post">
      <h2>Hey!</h2>
      <h3>Login now</h3>
      <input type="email" name="email" required placeholder="Enter your email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" class="btn" name="submit">
      <p>Don't have an account?</p>
      <div class="social-icons">
            <a href="https://www.facebook.com/"><img src="images/fb.png"/></a>
            <a href="https://twitter.com/i/flow/login"><img src="images/twitter.png"/></a>
            <a href="https://accounts.google.com/v3/signin/identifier?dsh=S704704954%3A1673878382527462&authuser=0&continue=https%3A%2F%2Fmyaccount.google.com%2F%3Futm_source%3Dsign_in_no_continue%26pli%3D1&ec=GAlAwAE&hl=en_GB&service=accountsettings&flowName=GlifWebSignIn&flowEntry=AddSession"><img src="images/google.png"/></a>
        </div>
      <a href="user_register.php" class="option-btn">register now</a>
   </form>
</div>
</section>



<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>