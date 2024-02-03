<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Stellan</title>
    <meta name="description" content="Stellan - Checkout">
    <meta name="keywords" content="Checkout, Pay">
    <!-- CSS-link -->
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>

    <?php
        // Obtain the get request to figure out which product they clicked on
        if(isset($_GET['item'])){
            $name = $_GET['item'];
            $price = $_GET['price'];
            $img = $_GET['img'];
        }else{  
            $name = 'undefined select a product';
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
        <div class="left" style="padding-top: 100px;">
            <h5><?php echo $name; ?></h5>
            <h1>Checkout</h1>
            <form action="checkpayment.php" method="get" style="width: 400px;">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Name</span>
                    <input type="text" class="form-control" placeholder="Name on Card" aria-label="Name On Card" aria-describedby="basic-addon1" name="name">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><ion-icon name="card-outline"></ion-icon></span>
                    <input type="text" class="form-control" placeholder="0000 0000 0000 0000" aria-label="0000 0000 0000 0000" aria-describedby="basic-addon1" name="card_number">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">CVV</span>
                    <input type="text" class="form-control" placeholder="333" aria-label="333" aria-describedby="basic-addon1" name="cvv">
                </div>

                <label for="start">Expiry Date:</label>

                <input type="date" id="expiry" name="expiry"
                    value="2018-07-22"
                    min="2018-01-01" max="2026-12-31">

                
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity"
                min="1" max="10">
                <button class="buy" role="button" type="submit" style="margin-top: 20px;">Confirm Payment!</button>
            </form>
            <p>$<?php echo $price; ?></p>

            
        </div>
        <div class="right">
            <img src="image/<?php echo $img; ?>" alt="">
        </div>
    </section>

    <div class="end-text">
        <p>Copyright Stellan Inc ©2023</p>
        
    </div>

    <script src="script.js"></script>
    
</body>
</html>