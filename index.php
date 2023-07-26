<?php

require 'assets/dp/conn.php';

if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $discountPercentage = $_POST['discountPercentage'];
    $brand = $_POST['brand'];
    $thumbnail = $_POST['thumbnail'];
    $count = 1;


    $stmt_select = $conn->prepare("SELECT count FROM cart_items WHERE id = ?");
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $count = $row['count'] + 1;

        $stmt_update = $conn->prepare("UPDATE cart_items SET count = ? WHERE id = ?");
        $stmt_update->bind_param("ii", $count, $id);
        $stmt_update->execute();

    } else {

        $stmt_insert = $conn->prepare("INSERT INTO cart_items (id, title , price, discount, thumbnail, count) VALUES (?, ?, ?, ?, ? ,?)");
        $stmt_insert->bind_param("issssi", $id ,$title, $price, $discountPercentage, $thumbnail, $count);
        $stmt_insert->execute();
    }



//
//    $id = $_POST['id'];
//    $title = $_POST['title'];
//    $price = $_POST['price'];
//    $discountPercentage = $_POST['discountPercentage'];
//    $brand = $_POST['brand'];
//
//
//    $stmt = $conn->prepare("INSERT INTO cart_items (id, title, price , discountPercentage , brand) VALUES (?, ?, ? , ? , ? )");
//    $stmt->bind_param("issss", $id, $title, $price, $discountPercentage, $brand);
//    $stmt->execute();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Cards</title>
    <link rel="stylesheet" href="assets/styles/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Libre+Baskerville:ital@1&family=Playfair+Display:ital,wght@1,500&display=swap"
          rel="stylesheet">

    <style>

        * {
            margin: 0;
            padding: 0;
        }

        .header-photo {
            background-position: center;
            background-size: cover;
            width: 100%;
            background-image: url(assets/imges/istockphoto-1315891458-612x612_auto_x2.jpg);
            min-height: 707px;
        }
    </style>

</head>
<body>

<!--Nav Bar -->

<?php require 'header.php'?>

<div class="container-fluid header-photo mb-4">

</div>





<div class="container">
    <div class="d-flex justify-content-around flex-wrap" id="productContainer"></div>

</div>
<script src="assets/styles/bootstrap.min.js"></script>
<script src="script.js"></script>
</body>
</html>
