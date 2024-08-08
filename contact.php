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

// Handle the form submission for sending a message
if(isset($_POST['send'])){

   // Sanitize the input data
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   // Check if a similar message already exists in the database
   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   // If message already exists, display a message
   if($select_message->rowCount() > 0){
      $message[] = 'Already sent message!';
   }else{
      // If message doesn't exist, insert the new message into the database
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
   <title>Contact</title>
  
   <!-- Font Awesome for icons -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- Include the user header component -->
<?php include 'components/user_header.php'; ?>

<!-- Banner Section -->
<div class="banner-box1 f-slide-3">
   <div class="banner-text-container1">
      <div class="banner-text1">
         <span>Time to Unlock</span>
         <strong>Contact us</strong>
      </div>
   </div>
</div> 

<!-- Contact Section -->
<section class="contact">
   
   <div class="row">

      <div class="image">
         <!-- Contact Image -->
         <img src="https://media.istockphoto.com/id/1168945108/photo/close-up-image-of-male-hands-using-smartphone-with-icon-telephone-email-mobile-phone-and.jpg?s=612x612&w=0&k=20&c=aVojLzP1n3XNxuRdy7Pqdzo6OyRAVanOWDUWjbu3R8Q=" alt="" width="204" height="590">
      </div>

      <!-- Contact Form -->
      <form action="" method="post">
         <h3>Contact us</h3>
         <input type="text" name="name" placeholder="Enter your name" required maxlength="20" class="box">
         <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
         <input type="number" name="number" min="0" max="9999999999" placeholder="Enter your number" required onkeypress="if(this.value.length == 10) return false;" class="box">
         <textarea name="msg" class="box" placeholder="Enter your message" cols="30" rows="10"></textarea>
         <input type="submit" value="Send message" name="send" class="btn">
      </form>

   </div>

</section>

<!-- FAQ Section -->
<section class="faq">

   <h1 class="heading">Frequently Asked Questions</h1>

   <div class="accordion-container">

      <!-- FAQ Item 1 -->
      <div class="accordion active">
         <div class="accordion-heading">
            <h3>Will I get the exact product shown in the picture?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
            We strive to ensure that the products you receive match the images on our website. 
            However, please be aware that photographs may not capture colors perfectly, and the actual color of the product might differ slightly from what is shown online.
         </p>
      </div>

      <!-- FAQ Item 2 -->
      <div class="accordion">
         <div class="accordion-heading">
            <h3>Can I cancel my order?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
            You can cancel your order any time before you receive a notification that it has been shipped for delivery.
         </p>
      </div>

      <!-- FAQ Item 3 -->
      <div class="accordion">
         <div class="accordion-heading">
            <h3>Can I change my delivery address?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
            Once payment has been received and you have received your Payment Confirmation email, we are unfortunately unable to make changes to your delivery address.
         </p>
      </div>

      <!-- FAQ Item 4 -->
      <div class="accordion">
         <div class="accordion-heading">
            <h3>What is a Pre-order?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
            Pre-orders allow you to place advance orders for products that have not yet been released. When you place the Pre-order, we then order the product in advance from our suppliers.
         </p>
      </div>

      <!-- FAQ Item 5 -->
      <div class="accordion">
         <div class="accordion-heading">
            <h3>When do I get charged for a Pre-order?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
            Credit Card Pre-orders are charged immediately. If you’re paying via Bank Deposit, you’ll hear from us when the payment is due.
         </p>
      </div>

      <!-- FAQ Item 6 -->
      <div class="accordion">
         <div class="accordion-heading">
            <h3>How do I cancel a Pre-order?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
            You are entitled to cancel your Pre-order prior to the point at which you receive a notification that it is being shipped for delivery. To cancel your Pre-order you can get in touch with us here on the contact form or email us.
         </p>
      </div>

      <!-- FAQ Item 7 -->
      <div class="accordion">
         <div class="accordion-heading">
            <h3>What happens if the price of my Pre-order product changes?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
            If the price of a product you’ve already pre-ordered is dropped before the product is released, we will automatically adjust your Pre-order to the new lower price, and ensure you are charged for the new price.
         </p>
      </div>

      <!-- FAQ Item 8 -->
      <div class="accordion">
         <div class="accordion-heading">
            <h3>Where can I ship my order?</h3>
            <i class="fas fa-angle-down"></i>
         </div>
         <p class="accordion-content">
            While we would be thrilled to fulfill your order, 
            we currently only ship to the countries where our online store is available. 
            However, we are continually expanding and aim to reach more countries in the future to better serve you.
         </p>
      </div>

   </div>

</section>

<!-- Include the footer component -->
<?php include 'components/footer.php'; ?>

<!-- Custom JS -->
<script src="js/script.js"></script>
<script>
// FAQ Accordion Script
let accordion = document.querySelectorAll('.faq .accordion-container .accordion');

accordion.forEach(acco =>{
   acco.onclick = () =>{
      accordion.forEach(dion => dion.classList.remove('active'));
      acco.classList.toggle('active');
   };
});

// Load More Script (if applicable)
document.querySelector('.load-more .btn').onclick = () =>{
   document.querySelectorAll('.courses .box-container .hide').forEach(show =>{
      show.style.display = 'block';
   });
   document.querySelector('.load-more .btn').style.display = 'none';
};
</script>
</body>
</html>
