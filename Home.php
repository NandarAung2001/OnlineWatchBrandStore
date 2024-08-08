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

// Include the wishlist and cart functionalities
include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   
   <!-- Include external CSS libraries -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.min.css">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   
   <!-- Include custom CSS file -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- Include the user header component -->
<?php include 'components/user_header.php'; ?>
	
<!-- Slider section -->
<div class="slider">
   <!-- Individual slide -->
	<div class="myslide fade">
		<div class="txt">
		</div>
		<img src="images/bun1.jpg" style="width: 100%; height: 90%;">
	</div>
   <!-- Additional slides -->
	<div class="myslide fade">
		<div class="txt"></div>
		<img src="https://content.rolex.com/dam/media/wallpapers/cosmograph-daytona/m116515ln-0018_1280x768.jpg" style="width: 100%; height: 90%;">
	</div>
	<div class="myslide fade">
		<div class="txt"></div>
		<img src="https://th.bing.com/th/id/R.c966475327bea8a3f1b4425f8c336ac7?rik=gqUDVmVVT9DF3A&riu=http%3a%2f%2fcdn.shopify.com%2fs%2ffiles%2f1%2f0031%2f6912%2f4401%2fcollections%2f1200x628_1200x1200.png%3fv%3d1660209780&ehk=EOAqdVhArJVUaUzzTGyiXwcfw5VS3tiMtzyg00TRxkw%3d&risl=&pid=ImgRaw&r=0" style="width: 100%; height: 90%;">
	</div>
	<div class="myslide fade">
		<div class="txt"></div>
		<img src="https://th.bing.com/th/id/R.4ec61eb060bbf702efd92012b06d4c44?rik=nYID1b7CANCi5g&riu=http%3a%2f%2fwallup.net%2fwp-content%2fuploads%2f2017%2f11%2f17%2f230769-luxury_watches-watch.jpg&ehk=wmxlUeDr%2bMv6xhv4pPDTnsPAN2L3D2EmzjVqvhbbyAQ%3d&risl=&pid=ImgRaw&r=0" style="width: 100%; height: 90%;">
	</div>
	<div class="myslide fade">
		<div class="txt"></div>
		<img src="https://www.swisstime1.sr/wp-content/uploads/images/technical-data/truth-unveiled-05.jpg" style="width: 100%; height: 100%;">
	</div>

	<!-- Navigation buttons for the slider -->
	<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  	<a class="next" onclick="plusSlides(1)">&#10095;</a>
	
	<!-- Dots for slide navigation -->
	<div class="dotsbox" style="text-align:center">
		<span class="dot" onclick="currentSlide(1)"></span>
		<span class="dot" onclick="currentSlide(2)"></span>
		<span class="dot" onclick="currentSlide(3)"></span>
		<span class="dot" onclick="currentSlide(4)"></span>
		<span class="dot" onclick="currentSlide(5)"></span>
	</div>
</div>

<!-- Banner section -->
<section class="banner">
<h1><span>Featured</span> Collections</h1>

    <div class="grid-banner">
        <!-- Individual banner item -->
        <div class="grid">
            <img src="https://i.pinimg.com/564x/bc/50/3c/bc503ce0ea2414374ae0a602b41fefe5.jpg" alt="">
            <div class="content">
                <span>Special Offer</span>
                <h3>Watch Collection</h3>
                <a href="shop.php" class="btn">order now</a>
            </div>
        </div>
        <div class="grid">
            <img src="https://i.pinimg.com/564x/39/00/5a/39005af2d87a8f09b5da292890232b8f.jpg" alt="">
            <div class="content center">
              <span>Special Offer</span>
                <h3>Watch Collection</h3>
                <a href="shop.php" class="btn">order now</a>
            </div>
        </div>
        <div class="grid">        
            <img src="https://i.pinimg.com/564x/3b/35/95/3b3595d43cff044a460c3053c22d6b27.jpg" alt="">
            <div class="content">
               <span>Special Offer</span>
                <h3>Watch Collection</h3>
                <a href="shop.php" class="btn">order now</a>
            </div>
        </div>
    </div>

</section>

<!-- New Arrival section -->
<section class="product">
<h1><span>New</span>Arrival</h1>
   <div class="box-container">

   <?php
   // Fetch new products from the database
     $select_products = $conn->prepare("SELECT * FROM `products`"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <!-- Product item -->
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="size" value="<?= $fetch_product['size']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="Add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">No products found!</p>';
   }
   ?>
   </div>

</section>
<br><br>

<!-- Call to Action section -->
<section class="cta">
		<div class="cta-text">
			<h6>Watches ON SALE</h6>
			<h4>Watch Brand<br> NEW ARRIVAL</h4>
			<a href="shop.php" class="btn">SHOP NOW</a>
		</div>
</section>

<!-- Best Sellers section -->
<section class="home-products">
<h1><span>Best</span>Sellers</h1>

   <div class="swiper products-slider">
   <div class="swiper-wrapper">

   <?php
   // Fetch best selling products from the database
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <!-- Product item -->
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="size" value="<?= $fetch_product['size']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="Add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">No products added yet!</p>';
   }
   ?>

   </div>
   <div class="swiper-pagination"></div>
   </div>
</section>

<!-- Include the blog section -->
<?php include 'blog.html'; ?>

<!-- Include the footer component -->
<?php include 'components/footer.php'; ?>

<!-- Include external JS libraries -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- Include custom JS file -->
<script src="js/script.js"></script>

<!-- JavaScript for the slider functionality -->
<script>
const myslide = document.querySelectorAll('.myslide'),
	  dot = document.querySelectorAll('.dot');
let counter = 1;
slidefun(counter);

let timer = setInterval(autoSlide, 8000);
function autoSlide() {
	counter += 1;
	slidefun(counter);
}
function plusSlides(n) {
	counter += n;
	slidefun(counter);
	resetTimer();
}
function currentSlide(n) {
	counter = n;
	slidefun(counter);
	resetTimer();
}
function resetTimer() {
	clearInterval(timer);
	timer = setInterval(autoSlide, 8000);
}

function slidefun(n) {
	let i;
	for(i = 0;i<myslide.length;i++){
		myslide[i].style.display = "none";
	}
	for(i = 0;i<dot.length;i++) {
		dot[i].className = dot[i].className.replace(' active', '');
	}
	if(n > myslide.length){
	   counter = 1;
	}
	if(n < 1){
	   counter = myslide.length;
	}
	myslide[counter - 1].style.display = "block";
	dot[counter - 1].className += " active";
}

// Swiper initialization for category slider
var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

// Swiper initialization for products slider
var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

// Swiper initialization for blogs slider
var swiper = new Swiper(".blogs-slider", {
  centeredSlides: true,
  loop:true,
  spaceBetween:20,
  autoplay: {
    delay: 9500,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1200: {
      slidesPerView: 3,
    },
  },
});
</script>

</body>
</html>
