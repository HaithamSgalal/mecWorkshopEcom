<?php

require 'assets/dp/conn.php' ;

$sql = "SELECT * FROM cart_items";
$result = $conn->query($sql);
$numberOfItems = $result->num_rows ;
echo $numberOfItems ;


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Cards</title>
    <link rel="stylesheet" href="assets/styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Libre+Baskerville:ital@1&family=Playfair+Display:ital,wght@1,500&display=swap"
          rel="stylesheet">




</head>

<div class="w3-top">
    <div class="w3-bar w3-white w3-card  w3-padding-10" id="myNavbar" style="font-family: 'Libre Baskerville', serif;">
        <a href="index.php" class="w3-bar-item w3-button w3-wide">BUY ZONE</a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">
            <a href="index.php" class="w3-bar-item w3-button">HOME PAGE</a>
            <a href="assets/cart.php" class="w3-bar-item w3-button">CART<span class="position-absolute top-10 end-10  translate-middle badge rounded-pill bg-danger"><?=$numberOfItems?></span></a>
            <a href="assets/login.php" class="w3-bar-item w3-button">LOGIN</a>
            <a href="assets/register.php" class="w3-bar-item w3-button">SIGN UP</a>
        </div>
    </div>
</div>
