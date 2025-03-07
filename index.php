<?php

require_once './backend/models/productmodels.php';

$product_model = new ProductModels();

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UA Campus Store | Homepage</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/utility-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
</head>
<body>>
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="hamburger-menu">
                <i class="fas fa-bars"></i>
            </a>
            <a href="index.php" class="logo">
                <img src="images/logo.png" alt="UA Campus Store Logo">
            </a>
            <div class="nav-links">
                <a href="search.php"><i class="fas fa-search"></i></a>
                <a href="#"><i class="fas fa-user"></i></a>
            </div>
        </div>
    </nav>

    <!-- The hero section is designed to immediately capture the user's attention with a large, visually appealing image. 
         This helps to create a strong first impression and encourages users to explore the site further. -->
    <img src="images/hero.jpg" alt="Featured Products" class="hero-image">

    <!-- The featured products section showcases popular items to entice users to make a purchase. 
         By displaying product images, names, prices, and ratings, users can quickly see what is available and make informed decisions. -->
    <section class="featured-products">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <?php 
                $products = $product_model->getProductObjects();
                foreach ($products as $product):
            ?>
                <?php
                        $product_id = $product->getProductProperty("id");
                        $image = $product_model->getVisualObject($product_id, "featured-image");
                ?>
                
                <div class="product-card">
                    <a href="product.php?id=<?php echo $product_id; ?>">
                        <?php echo $image->getHTML(); ?>
                        <p class="text-bold text-black"><?php echo $product->getProductProperty("name"); ?></p>
                    </a>
                    <p>$<?php echo number_format($product->getProductProperty("price"), 2); ?></p>
                    <div class="rating">
                        <?php echo $product->getRatingStars(); ?>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </section>

    <footer>
        <div class="footer-links">
            <a href="#">Terms of Use</a>
            <a href="#">Privacy Policy</a>
            <a href="#">About</a>
            <a href="#">Help Center</a>
        </div>
        <div class="footer-copyright">
            <p>© 2025 The University of Arizona Campus Store. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>