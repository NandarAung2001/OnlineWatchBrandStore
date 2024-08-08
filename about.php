<?php

// Include the database connection file
include 'components/connect.php';

// Start a new session or resume the existing session
session_start();

// Check if user is logged in and set user_id
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
   <title>about</title>

   <!-- Include Swiper CSS for slider functionality -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- Include Font Awesome for icons -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- Include custom CSS file for styling -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php 
// Include the user header component
include 'components/user_header.php'; 
?>
<section class="about">

   <div class="row">

      <!-- Image section of the about page -->
      <div class="image">
         <img src="https://i.pinimg.com/564x/0f/68/63/0f686313ffb0d186bb076ff5197dc3aa.jpg" alt="Client Order Watch Photo" width="800" height="600">
      </div>

      <!-- Content section of the about page -->
      <div class="content">
         <h1><span>TIME TO UNLOCK </span> YOUR DIGITAL WORLD !!! </h1>
         <h3>Watch Brand Summary</h3>
         <p>Welcome to our world of timeless elegance and cutting-edge design!
         At Premier Timepieces, we understand that the best way to express yourself is through your watch. A watch is more than just a timekeeper; it's a statement. 
         It speaks volumes about who you are, where you've been, and where you're going. It's the ultimate accessory that adds a touch of sophistication to your everyday life. Whether you're making a grand entrance or enjoying a quiet moment, our collection of renowned brands is perfectly tailored to reflect your unique style.
         So, whatever defines you, we've got the perfect watch to complement your journey.
         </p>
                
         <!-- Services section -->
         <div class="about_services">

            <div class="s_1">
               <i class="fa-solid fa-gifts"></i>
               <a href="#">Famous Gift Card</a>
            </div>

            <div class="s_1">
               <i class="fa-brands fa-amazon-pay"></i>
               <a href="#">Pay Your Way</a>
            </div>

            <div class="s_1">
               <i class="fa-solid fa-truck"></i>
               <a href="#">Fast Delivery</a>
            </div>

         </div>
         <!-- Contact button -->
         <a href="contact.php" class="about_btn">Contact Now</a>
      </div>

   </div>

</section>

<!-- Gallery section -->
<section class="gallery" id="gallery">

<h1><span>Our Shop</span>Gallery</h1>

<div class="box-container">

    <div class="box" data-aos="fade-up">
        <img src="https://i.pinimg.com/564x/ae/b3/ff/aeb3ff0194b7b3fd98e59c0f82f9dffe.jpg" alt="">
        <h3>CARRERA</h3>
    </div>

    <div class="box" data-aos="fade-up">
        <img src="https://i.pinimg.com/564x/41/c7/1e/41c71e0e79b783d269652bd32e1f8b3e.jpg" alt="">
        <h3>ICE WATCH YELLOW</h3>
    </div>

    <div class="box" data-aos="fade-up">
        <img src="https://i.pinimg.com/564x/02/ef/fe/02effee6b1b2f33565133f50962b389a.jpg" alt="">
        <h3>LACOSTE</h3>
    </div>

    <div class="box" data-aos="fade-up">
        <img src="https://i.pinimg.com/564x/4b/ef/44/4bef44e1f279be0f11d14fff6a81d4f2.jpg" alt="">
        <h3>ARMANI EXCHANGE</h3>
    </div>

    <div class="box" data-aos="fade-up">
        <img src="https://i.pinimg.com/564x/63/8b/d1/638bd11b242c89d4c9255bdb99a4ba05.jpg" alt="">
        <h3>APPLE WATCH</h3>
    </div>

    <div class="box" data-aos="fade-up">
        <img src="https://i.pinimg.com/564x/35/b5/e7/35b5e7c7386392e384fa772c7cea6640.jpg" alt="">
        <h3>KID WATCH</h3>
    </div>
    <div class="box" data-aos="fade-up">
        <img src="https://i.pinimg.com/564x/88/a7/ed/88a7edeb40c911d3aa59783b16413007.jpg" alt="">
        <h3>FORGE&FOSTER</h3>
    </div>

    <div class="box" data-aos="fade-up">
        <img src="https://i.pinimg.com/564x/d2/18/60/d21860227c1d15c08fcbc6b033d5b584.jpg" alt="">
        <h3>ROLEX</h3>
    </div>

    <div class="box" data-aos="fade-up">
        <img src="https://i.pinimg.com/564x/de/9c/92/de9c92d2ae8d060f507a346a5c43c4f3.jpg" alt="">
        <h3>CK</h3>
    </div>
</div>

</section>

<!-- Reviews section -->
<section class="reviews" id="reviews">

   <h1 class="heading"> customer <span> Reviews</span> </h1>

   <div class="review_box">
      <!-- Review card 1 -->
      <div class="review_card">

         <div class="review_profile">
            <img src="https://assets.teenvogue.com/photos/6488a68e5d0a51ab9a6f77c8/1:1/w_3010,h_3010,c_limit/GettyImages-1432875246.jpg">
         </div>

         <div class="review_text">
            <h2 class="name">JENNIE</h2>

            <div class="review_icon">
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star-half-stroke"></i>
            </div>

            <div class="review_social">
               <i class="fa-brands fa-facebook-f"></i>
               <i class="fa-brands fa-instagram"></i>
               <i class="fa-brands fa-twitter"></i>
               <i class="fa-brands fa-linkedin-in"></i>
            </div>

            <p>
            I highly recommend Watches Brand Summary for anyone in search of a premium timepiece.
            Their website is user-friendly, the product selection is excellent, and the customer service is outstanding.
            My order arrived quickly and the quality of the watch exceeded my expectations. I'll definitely shop with them again!
            </p>

         </div>

      </div>

      <!-- Review card 2 -->
      <div class="review_card">

         <div class="review_profile">
            <img src="https://i.pinimg.com/736x/0a/85/30/0a8530f20cb032b95bff220b3d07ad96.jpg">
         </div>

         <div class="review_text">
            <h2 class="name">LISA</h2>

            <div class="review_icon">
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star-half-stroke"></i>
            </div>

            <div class="review_social">
               <i class="fa-brands fa-facebook-f"></i>
               <i class="fa-brands fa-instagram"></i>
               <i class="fa-brands fa-twitter"></i>
               <i class="fa-brands fa-linkedin-in"></i>
            </div>

            <p>
            I highly recommend Timepiece Haven for anyone looking to purchase a high-quality watch. 
            Their website is incredibly easy to navigate, they offer a fantastic selection, and their customer service is top-notch. My watch arrived quickly, and the quality far exceeded my expectations. 
            I will definitely be a returning customer!
            </p>

         </div>

      </div>

      <!-- Review card 3 -->
      <div class="review_card">

         <div class="review_profile">
            <img src="https://i.pinimg.com/564x/9e/be/22/9ebe22390cccacc50fd067104b5f9bbc.jpg">
         </div>

         <div class="review_text">
            <h2 class="name">D.O</h2>

            <div class="review_icon">
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star-half-stroke"></i>
            </div>

            <div class="review_social">
               <i class="fa-brands fa-facebook-f"></i>
               <i class="fa-brands fa-instagram"></i>
               <i class="fa-brands fa-twitter"></i>
               <i class="fa-brands fa-linkedin-in"></i>
            </div>

            <p>
            I highly recommend Premier Watch Co. for anyone in search of a high-quality timepiece. 
            The website is easy to navigate, the selection of watches is superb, and the customer service is excellent. My watch arrived quickly and exceeded my expectations in terms of quality and craftsmanship. 
            I will definitely be making more purchases from them in the future!
            </p>

         </div>

      </div>

      <!-- Review card 4 -->
      <div class="review_card">

         <div class="review_profile">
            <img src="https://i.pinimg.com/564x/67/f7/78/67f778570043b76df247ca7683b7d8e3.jpg">
         </div>

         <div class="review_text">
            <h2 class="name">R.M</h2>

            <div class="review_icon">
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star"></i>
               <i class="fa-solid fa-star-half-stroke"></i>
            </div>

            <div class="review_social">
               <i class="fa-brands fa-facebook-f"></i>
               <i class="fa-brands fa-instagram"></i>
               <i class="fa-brands fa-twitter"></i>
               <i class="fa-brands fa-linkedin-in"></i>
            </div>

            <p>
            I highly recommend Luxe Watches for anyone looking to buy a premium timepiece. 
            The website is intuitive and user-friendly, offering a fantastic range of watches. Their customer service is top-notch, and my watch arrived quickly, exceeding my quality expectations.
            I’ll definitely be returning for future purchases!
            </p>

         </div>

      </div>

   </div>

</section>

<?php 
// Include the footer component
include 'components/footer.php'; 
?>

<!-- Include Swiper JS for slider functionality -->
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- Include custom JavaScript file for additional functionality -->
<script src="js/script.js"></script>

<script>
// Initialize Swiper for the reviews slider
var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});
</script>

</body>
</html>
