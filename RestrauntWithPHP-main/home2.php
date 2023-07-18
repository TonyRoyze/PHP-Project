<?php
$total = 2.00;
$count = 0;
$title = "Dish 01";
$desc = "A delicacy of rich flavor and exquisite taste";
$price = 200.00;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signature Cuisine</title>
    <link rel="stylesheet" href="styles/common.css">
    <link rel="stylesheet" href="styles/homepage.css">

</head>

<body>
<header>
    <h2 class="logo">Signature Cuisine</h2>
    <nav class="navigation">
        <!--        <a href="home.php">Home</a>-->
        <span class="cart-icon">
            <ion-icon name="cart-outline"></ion-icon>
        </span>
        <span class="quantity"><?php echo $count?></span>
        <button class="btnLogout">Logout</button>

    </nav>

</header>
<div class="wrapper home">
    <div class="list">
        <div class="item">
            <img src="images/dish01.jpg" alt="products">
            <h3 class="title"><?php echo $title ?></h3>
            <small class="description"><?php echo $desc ?></small>
            <small class="price">Rs. <?php echo $price ?> .00 /=</small>
        </div>
        <div class="item">
            <img src="images/dish01.jpg" alt="products">
            <h3 class="title"><?php echo $title ?></h3>
            <small class="description"><?php echo $desc ?></small>
            <small class="price">Rs. <?php echo $price ?> .00 /=</small>
        </div>
        <div class="item">
            <img src="images/dish01.jpg" alt="products">
            <h3 class="title"><?php echo $title ?></h3>
            <small class="description"><?php echo $desc ?></small>
            <small class="price">Rs. <?php echo $price ?> .00 /=</small>
        </div>
        <div class="item">
            <img src="images/dish01.jpg" alt="products">
            <h3 class="title"><?php echo $title ?></h3>
            <small class="description"><?php echo $desc ?></small>
            <small class="price">Rs. <?php echo $price ?> .00 /=</small>
        </div>
        <div class="item">
            <img src="images/dish01.jpg" alt="products">
            <h3 class="title"><?php echo $title ?></h3>
            <small class="description"><?php echo $desc ?></small>
            <small class="price">Rs. <?php echo $price ?> .00 /=</small>
        </div>
        <div class="item">
            <img src="images/dish01.jpg" alt="products">
            <h3 class="title"><?php echo $title ?></h3>
            <small class="description"><?php echo $desc ?></small>
            <small class="price">Rs. <?php echo $price ?> .00 /=</small>
        </div>
        <div class="item">
            <img src="images/dish01.jpg" alt="products">
            <h3 class="title"><?php echo $title ?></h3>
            <small class="description"><?php echo $desc ?></small>
            <small class="price">Rs. <?php echo $price ?> .00 /=</small>
        </div>
        <div class="item">
            <img src="images/dish01.jpg" alt="products">
            <h3 class="title"><?php echo $title ?></h3>
            <small class="description"><?php echo $desc ?></small>
            <small class="price">Rs. <?php echo $price ?> .00 /=</small>
        </div>


        <div class="cart-box">
            <ul class="listCard"></ul>
            <div class="checkOut">
                <div class="total">Rs. <?php echo $total ?>.00</div>
                <div class="closeShopping">Close</div>
            </div>
            <img src="">
            <h4>Product <?php echo $title ?></h4>
            <small>description</small>
            <h1> Hello</h1>

        </div>
    </div>
</div>
<script src="user/home.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
