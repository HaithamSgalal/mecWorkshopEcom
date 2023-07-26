<?php
session_start() ;

require 'assets/dp/conn.php';
$sql = "SELECT * FROM cart_items";
$result = $conn->query($sql);
$count_cart = $result-> num_rows;

?>


<nav class="navbar navbar-expand navbar-dark bg-dark sticky-top" >
    <div class="container">
        <a class="navbar-brand" href="index.php">AMAZON MISR</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class=" nav-link active" href="cart.php">CART<span
                                class="pe-2 badge bg-<?= $count_cart > 0 ?  "success":"danger" ?> ">
         <?= $count_cart ; ?>
        </span></a>
                </li>
                <?php if (! count($_SESSION) > 0 ) : ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="login.php">LOGIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="register.php">REGISTER</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" >welcome <?=$_SESSION['user_name'] ?> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active btn btn-outline-danger" aria-current="page" href="logout.php">Logout </a>
                    </li>
                <?php endif ?>


            </ul>
        </div>
    </div>
</nav>



