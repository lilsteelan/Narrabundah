<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Stellan</title>
    <meta name="description" content="Stellan - Shop Winter season">
    <meta name="keywords" content="Admin">
    <!-- CSS-link -->
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <?php
        //Check if a customer has been selected and set that in cookies
        if(isset($_GET['customer'])){
            setcookie('customer', $_GET['customer']);
            $customer = $_COOKIE['customer'];
            Header('Location: login.php');
        }else{
            $customer = 'none';
        }
    ?>

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
        <div class="left" style="margin-top: -50px;">
            <h1 style="margin-left: -10px;">User Login</h1>
            <h3>Choose a person to log in as</h3>
            <!-- <p>Logged in as&nbsp;<?php //echo $customer;?></p> -->
            <form action="login.php" method="get">
                <!-- STYLED with bootstrap -->
                <label for="cars"><h3>📖</h3></label>
                <select name="customer" id="customer">
                    <optgroup label="Select User">
                        <option value="Kiran">Kiran</option>
                        <option value="Stellan">Stellan</option>
                        <option value="Jericho">Jericho</option>
                        <option value="Gabe">Gabe</option>
                    </optgroup>
                </select>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <!-- Remember me -->
                <!-- <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="right">
            <img src="image/EX89.webp" alt="">
        </div>
    </section>

    <div class="end-text">
        <p>Copyright Stellan Inc ©2023</p>
        <p><?php echo date("Y.m.d"); ?></p>
    </div>

    <script src="script.js"></script>
    
</body>
</html>