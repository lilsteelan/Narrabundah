<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Air Flight Mid - Stellan</title>
    <meta name="description" content="Stellan - Shop Winter season">
    <meta name="keywords" content="Air Flight Mid">
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
        setcookie('product', 'Nike_Air_Flight');

        //Retrieve image from database
        $db = 'online_shop';
        $username = 'stellan';
        $password = 'lindrud';
        $host = 'localhost';

        $conn = mysqli_connect($host,$username,$password,$db);
        $query = "SELECT * FROM products";
        $path = mysqli_query($conn,$query);
        foreach($path as $x){
            if($x['name'] == 'Nike_Air_Flight'){
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
            <h1>Air Flight <span style="text-decoration: underline; color:#E75480"><i>MAX</i></span> <br> Take <span style="color: rgba(208, 208, 0, 0.701);">flight</span></h1>
            <p>$190</p>

            <!-- HTML !-->
            <a href="checkout.php?item=Air+Flight+Mid&price=190&img=airflight.webp"><button class="buy" role="button">Buy Now!</button></a>
        </div>
        <div class="right">
            <img src="data:img/webp;charset=utf8;base64, <?php echo base64_encode($image_data)?>" alt="">
        </div>
    </section>

    <div class="end-text">
        <p>Copyright Stellan Inc ©2023</p>
    </div>

    <script src="script.js"></script>
    
</body>
</html>