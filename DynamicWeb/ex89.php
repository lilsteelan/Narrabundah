<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex89 - Stellan</title>
    <meta name="description" content="Stellan - Shop Winter season">
    <meta name="keywords" content="EX89">
    <!-- CSS-link -->
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <?php
        //Store is session cache for checkout
        setcookie('product', 'EX89');

        //Retrieve image from database
        $db = 'online_shop';
        $username = 'stellan';
        $password = 'lindrud';
        $host = 'localhost';

        $conn = mysqli_connect($host,$username,$password,$db);
        $query = "SELECT * FROM products";
        $path = mysqli_query($conn,$query);
        
        foreach($path as $x){
            if($x['name'] == 'EX89'){
                $path = $x['image'];
                $image_data = $x['image_data'];
            }
        }
    ?>
    <header>
        <a href="index.php" class="logo"><img src="image/logo2.png" alt=""></a>

        <ul class="navmenu">
            <li><a href="index.php">home</a></li>
            <li><a href="#trending">shop</a></li>
        </ul>

        <div class="nav-icon">
            <a href="login.php"><i class='bx bx-user' ></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <section class="product">
        <div class="left">
            <h5>Winter Collection</h5>
            <h1><span style="text-decoration: underline; color:#E75480"><i>EX</i></span> <span style="color: rgba(15, 191, 249, 0.701);">89</span></h1>
            <h2 style="margin-left: 10px;">Bring ideas to <span style="color: rgb(104, 173, 0);">life</span></h2>
            <p>$179.95</p>

            
            <a href="checkout.php?item=EX+89&price=179.95&img=EX89.webp"><button class="buy" role="button">Buy Now!</button></a>
        </div>
        <div class="right">
            <!-- <img src="image/<?php echo $path; ?>" alt=""> -->
            <img src="data:img/webp;charset=utf8;base64,<?php echo base64_encode($image_data)?>" alt="">
        </div>
    </section>

    <div class="end-text">
        <p>Copyright Stellan Inc ©2023</p>
        <p><?php echo date("Y.m.d"); ?></p>
    </div>

    <script src="script.js"></script>
    
</body>
</html>