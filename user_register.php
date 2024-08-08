<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'Email already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
         $insert_user->execute([$name, $email, $cpass]);
         $message[] = 'Registered successfully, login now please!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">


</head>
<body>
   
<?php include 'components/user_header.php'; ?>
<div class="banner-box3 f-slide-3">
        <div class="banner-text-container3">
        <div class="banner-text3">
            <span>"Time to unlock ⌚️🔑"
</span>
            <!-- <strong>Register</strong> -->
        </div>
        </div>
    
    </div> 
<section class="form-container">
<div class="row">

<div class="image">
<img src="https://i.pinimg.com/736x/fe/0c/a4/fe0ca4ffb4e4bee3e92b467bcf715e93.jpg" alt="">
 </div>
   <form action="" method="post">
      <h2>HEy!!</h2>
      <h3>register now</h3>
      <input type="text" name="name" required placeholder="Enter your username" maxlength="20"  class="box">
      <input type="email" name="email" required placeholder="Enter your email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="Confirm your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" class="btn" name="submit">
      <p>Already have an account?</p>
      <div class="social-icons">
            <a href="https://www.facebook.com/"><img src="images/fb.png"/></a>
            <a href="https://twitter.com/i/flow/login"><img src="images/twitter.png"/></a>
            <a href="https://accounts.google.com/v3/signin/identifier?dsh=S704704954%3A1673878382527462&authuser=0&continue=https%3A%2F%2Fmyaccount.google.com%2F%3Futm_source%3Dsign_in_no_continue%26pli%3D1&ec=GAlAwAE&hl=en_GB&service=accountsettings&flowName=GlifWebSignIn&flowEntry=AddSession"><img src="images/google.png"/></a>
        </div>
      <a href="user_login.php" class="option-btn">login now</a>
   </form>
</div>
</section>





<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>