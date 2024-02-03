<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - Stellan</title>
    <!-- CSS-link -->
    <meta name="description" content="Succesfull Payment - Stellan">
    <meta name="keywords" content="Payment Succesful">
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php
session_start();
$customer = $_SESSION["name"];
$product = $_SESSION["product"];
$quantity = $_SESSION["quanity"];
$date = $_SESSION["date"];

?>
<link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>

    <header>
        <a href="index.php" class="logo"><img src="image/logo2.png" alt=""></a>

        <ul class="navmenu">
            <li><a href="index.php">home</a></li>
            <li><a href="#trending">shop</a></li>
        </ul>

        <div class="nav-icon">
            <a href="#"><i class='bx bx-user' ></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <section class="product">
        <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;height: 100vh;">
            
            <h1>Payment Successfull!</h1>
            <h3>Invoice Details:</h3>
            <h5>Bought Under: <?php echo $customer?></h5>
            <h5>Product: <?php echo $product?></h5>
            <h5>Quantity: <?php echo $quantity?></h5>
            <h5>Date: <?php echo $date?></h5>
            <hr>
            <h3><?php echo date("Y.m.d"); ?></h3>
            <a href="index.php"><button class="buy" role="button">Go Home</button></a>

        </div>
    </section>

    <div class="end-text">
        <p>Copyright Stellan Inc ©2023</p>
    </div>

    <script src="script.js"></script>
    
</body>
</html>