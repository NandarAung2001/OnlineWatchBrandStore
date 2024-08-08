<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'Already sent message!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'Sent message successfully!';

   }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="banner-box1 f-slide-3">
        
        <div class="banner-text-container1">
        <div class="banner-text1">
            <span>Shoes Brand Summary</span>
            <strong>Contact us</strong>
        </div>
        </div>
    
    </div> 
<section class="contact">
   
<div class="row">

<div class="image">
<img src="images/mmm.jpg" alt="">
 </div>

   <form action="" method="post">
      <h3>contact us</h3>
      <input type="text" name="name" placeholder="Enter your name" required maxlength="20" class="box">
      <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
      <input type="number" name="number" min="0" max="9999999999" placeholder="Enter your number" required onkeypress="if(this.value.length == 10) return false;" class="box">
      <textarea name="msg" class="box" placeholder="Enter your message" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section>

<section class="faq">

   <h1 class="heading">frequently asked questions</h1>

   <div class="accordion-container">

      <div class="accordion active">
         <div class="accordion-heading">
            <h3>Will I receive the same product that I see in the picture?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
         We make every effort to provide our customers with products that look the same as the images displayed on our website pages.However please keep in mind that photographs have a difficult time showing exact colors and that the actual color of a product may vary slightly from what is shown in one of our website images.
         </p>
      </div>

      <div class="accordion">
         <div class="accordion-heading">
            <h3>Can I cancel my order?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
         You are entitled to cancel your order prior to the point at which you receive a notification that it is being shipped for delivery.
         </p>
      </div>

      <div class="accordion">
         <div class="accordion-heading">
            <h3>Can I change my delivery address?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
         We unfortunately can’t make changes to your delivery address once payment has been received and you have received your Payment Confirmation email.
         </p>
      </div>

      <div class="accordion">
         <div class="accordion-heading">
            <h3>What is a Pre-order?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
         Pre-orders allow you to place advance orders for products that have not yet been released. When you place the Pre-order, we then order the product in advance from our suppliers.
         </p>
      </div>

      <div class="accordion">
         <div class="accordion-heading">
            <h3>When do I get charged for a Pre-order?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
         Credit Card Pre-orders are charged immediately.If you’re paying via Bank Deposit, you’ll hear from us when the payment is due.
         </p>
      </div>

      <div class="accordion">
         <div class="accordion-heading">
            <h3>How do I cancel a Pre-order?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
         You are entitled to cancel your Pre-order prior to the point at which you receive a notification that it is being shipped for delivery. To cancel your Pre-order you can get in touch with us here on the contact form or email us.
         </p>
      </div>

      <div class="accordion">
         <div class="accordion-heading">
            <h3>What happens if the price of my Pre-order product changes?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
         If the price of a product you’ve already pre-ordered is dropped before the product is released, we will automatically adjust your Pre-order to the new lower price, and ensure you are charged for the new price.
         </p>
      </div>
      <div class="accordion">
         <div class="accordion-heading">
            <h3>Where can I ship my order?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
         Although we would love to receive your order, we currently cannot ship outside of the countries where our online shop is open. However, we are constantly expanding, and aim to reach even more countries in the future, for your full satisfaction!
         </p>
      </div>
   </div>

</section>


<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>
<script>
let accordion = document.querySelectorAll('.faq .accordion-container .accordion');

accordion.forEach(acco =>{
  acco.onclick = () =>{
    accordion.forEach(dion => dion.classList.remove('active'));
    acco.classList.toggle('active');
  };
});

document.querySelector('.load-more .btn').onclick = () =>{
  document.querySelectorAll('.courses .box-container .hide').forEach(show =>{
    show.style.display = 'block';
  });
  document.querySelector('.load-more .btn').style.display = 'none';
};
</script>
</body>
</html>