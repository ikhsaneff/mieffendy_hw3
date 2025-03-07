<?php
require_once './backend/models/productmodels.php';

$product_model = new ProductModels();

$product_id =  $_GET['id'];

$product = $product_model->getProductObjects($product_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UA Campus Store | Products</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/store.css">
    <link rel="stylesheet" href="css/utility-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
</head>
<body>
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

    <?php 
    if ($product == false):
        echo $product_model->notFound();
    else:
        $image = $product_model->getVisualObject($product_id, "main-image");
    ?>

    <!-- Product detail section uses a two-column layout (images and info) for optimal viewing
         on desktop screens while maintaining readability and easy scanning of product information.
         This follows e-commerce best practices for product pages. -->
    <main class="product-detail">
        <div>
            <?php echo $image->getHTML(); ?>
        </div>

        <div class="product-info">
            <h1><?php echo $product->getProductProperty("name")?></h1>
            <div>
                <?php echo $product->getRatingStars()?>
                <span>(<?php echo $product->getProductProperty("num_reviews")?> reviews)</span>
            </div>
            <p class="price">$<?php echo number_format($product->getProductProperty("price"), 2)?></p>
            <div class="description">
                <h2>Product Description</h2>
                <?php echo $product->getProductProperty("description")?>
            </div>
        </div>
    </main>

    <!-- Related products section uses a grid layout to display multiple items efficiently.
         Limited to 6 items to avoid overwhelming the user while providing enough options
         to encourage additional purchases and browsing. -->
    <section class="other-products">
        <h2>Other Products You Might Like:</h2>
        <div class="other-product-grid">
            <?php
            $other_product_ids = [];
            $allproducts = $product_model->getProductObjects();
            while (count($other_product_ids) < 6) {
                $random_id = rand(1, count($allproducts));
                if ($random_id != $product_id && !in_array($random_id, $other_product_ids)) {
                    $other_product_ids[] = $random_id;
                }
            }
            ?>
            <?php foreach ($other_product_ids as $id):
                $other_product = $product_model->getProductObjects($id);
                $other_product_image = $product_model->getVisualObject($id, "other-image");
            ?>

            <div class="other-product-card">  
                <a href="product.php?id=<?php echo $id?>">
                    <?php echo $other_product_image->getHTML()?>
                    <p class="text-small text-black text-center"><?php echo $other_product->getProductProperty("name")?></p>
                </a>
            </div>

            <?php endforeach; endif; ?>
            
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