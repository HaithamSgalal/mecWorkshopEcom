<?php

require 'dp/conn.php';

$alarm = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // check if the name is empty
    if (empty($_POST['YourName']) || !preg_match("/^[a-zA-Z-' ]*$/", $_POST['YourName'])) {
        $errors ['nameError'] = ' Name is not valid';
    }
    //check if e-mail is empty
    if (empty($_POST['YourEmail']) || !filter_var($_POST["YourEmail"], FILTER_VALIDATE_EMAIL)) {
        $errors ['emailError'] = 'E-Mail Is Not Valid';
    }



    //check if password is empty
    if (empty($_POST["Password"]) || strlen($_POST["Password"]) < 8 || !preg_match("/[0-9]/", $_POST["Password"])) {
        $errors ['passwordError'] = ' must include 8 characters and numbers';
    }

    //check on password
    if ($_POST['Password'] !== $_POST['re_password'] || $_POST['re_password'] == '') {
        $errors ['re_passwordError'] = 'password not matching';
    }

    if (count($errors) == 0) :

        $name = $_POST['YourName'];
        $email = $_POST['YourEmail'];
        $password = $_POST['Password'];

        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $name, $email, $password);
        $stmt->execute();
        $alarm = 'USER ADDED SUCCESSFULLY';

    endif;

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Cards</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
            href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Libre+Baskerville:ital@1&family=Playfair+Display:ital,wght@1,500&display=swap"
            rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">

</head>

<body>

<div class="h-75">
    <div class="w3-bar w3-white w3-card  h-100" id="myNavbar" style="font-family: 'Libre Baskerville', serif;">
        <a href="#home" class="w3-bar-item w3-button w3-wide">BUY ZONE</a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">
            <a href="../index.php" class="w3-bar-item w3-button">HOME PAGE</a>
            <a href="../assets/cart.php" class="w3-bar-item w3-button">CART</a>
            <a href="../assets/login.php" class="w3-bar-item w3-button">LOGIN</a>
            <a href="../assets/register.php" class="w3-bar-item w3-button">SIGN UP</a>
        </div>
    </div>
</div>


<?php if ($alarm != '') : ?>
    <div class="alert alert-success" role="alert">
        USER ADDED SUCCESSFULLY, MOVE TO LOGIN PAGE <a href="login.php">HERE</a>
    </div>
<?php endif; ?>


<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                <form class="mx-1 mx-md-4" method="POST"
                                      action="register.php">

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="form3Example1c" class="form-control"
                                                   name="YourName"/>
                                            <label class="form-label" for="form3Example1c">Your Name
                                                <span><?php if (isset($errors['nameError'])) echo $errors['nameError']; ?></span></label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" id="form3Example3c" class="form-control"
                                                   name="YourEmail"/>
                                            <label class="form-label" for="form3Example3c">Your
                                                Email<span><?php if (isset($errors['emailError'])) echo $errors['emailError']; ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="form3Example4c" class="form-control"
                                                   name="Password"/>
                                            <label class="form-label" for="form3Example4c">Password
                                                <span><?php if (isset($errors['passwordError'])) echo $errors['passwordError']; ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="form3Example4cd" class="form-control"
                                                   name="re_password"/>
                                            <label class=" form-label" for="form3Example4cd">Repeat your
                                                password
                                                <span><?php if (isset($errors['passwordError'])) {
                                                        echo $errors['passwordError'];
                                                    }
                                                    if (isset($_POST['re_passwordError'])) {
                                                        echo $errors['re_passwordError'];
                                                    } ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-primary btn-lg"
                                                name="register">Register
                                        </button>
                                    </div>

                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="imges/istockphoto-1315891458-612x612_auto_x2.jpg" class="img-fluid"
                                     alt="Sample image">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>

</html>