<?php
require_once './backend/models/productmodels.php';

$product_model = new ProductModels();

$query =  isset($_GET['query']) ? $_GET['query'] : "";

$search_result = $product_model->searchProduct($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UA Campus Store | Products</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/search.css">
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
                <a href="search.php"><i class="fas fa-search search-button"></i></a>
                <a href="#"><i class="fas fa-user"></i></a>
            </div>
        </div>
    </nav>

    <?php if (empty($query) && empty($search_result)): ?>
    <section class="search-area">
        <h1>Search for Products</h1>
        <div class="search-container">
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Search for products...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>    
            
        </div>
    </section>
    <?php endif; ?>

    <?php if (empty($query)): ?>
    <?php elseif (empty($search_result)): ?>
        <div class="not-found">
            <h1>404 Not Found</h1>
            <p>The product you are looking for does not exist.</p>
            <a href="search.php">Return to Search Page</a>
        </div>
    <?php else: ?>
        <section class="search-results">
            <h2>Search Results for "<?php echo $query; ?>":</h2>
            <div class="results-grid">
                <?php 
                foreach ($search_result as $product):
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
    <?php endif; ?>

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