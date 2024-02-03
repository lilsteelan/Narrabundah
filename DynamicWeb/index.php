<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stellan - Shop better</title>
    <meta name="description" content="Stellan - Shop Winter season">
    <meta name="keywords" content="Shop, Clothes, Winter, Sale">
    <!-- CSS-link -->
    <link rel="stylesheet" href="styles/style.css">

    <!-- IMPORTS -->
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
</head>
<body>

    <header>
        <a href="#" class="logo"><img src="image/logo2.png" alt=""></a>

        <ul class="navmenu">
            <li><a href="#home">home</a></li>
            <li><a href="#trending">shop</a></li>
        </ul>

        <div class="nav-icon">
            <a href="login.php"><i class='bx bx-user' ></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <section class="main-home" id="home">
        <div class="main-text">
            <h5>Winter Collection</h5>
            <h1 class="animate__animated animate__fadeInDown">New <span style="text-decoration: underline; color:#E75480"><i>Season</i></span> <br> No <span style="color: rgba(208, 208, 0, 0.701);">Problem</span></h1>
            <p class="animate__animated animate__fadeIn animate__delay-1s">Shop winter with Stellan</p>

            <a href="#trending" class="main-btn animate__animated animate__fadeInLeft">Shop Now <i class='bx bx-right-arrow-alt' ></i></a>
        </div>

        <div class="down-arrow">
            <a href="#trending" class="down"><i class='bx bx-down-arrow-alt'></i></a>
        </div>
    </section>

    <!-- trending-products-section -->
    <section class="trending-product" id="trending">
        <div class="center-text">
            <h2>Trending <span>products</span></h2>
        </div>

        <div class="products">
            <div class="row">
                <a href="airflightmid.php"><img src="image/airflight.webp" alt=""></a>
                <div class="heart-icon">
                    <i class='bx bx-heart'></i>
                </div>
                <div class="ratting">
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                </div>

                <div class="price">
                    <h4>Nike Air Flight Lite Mid</h4>
                    <p>$190</p>
                </div>
            </div>

            <div class="row">
                <a href="acmeoops.php"><img src="image/acme-oops.webp" alt=""></a>
                <div class="product-text">
                    <h5>New</h5>
                </div>
                <div class="heart-icon">
                    <i class='bx bx-heart'></i>
                </div>
                <div class="ratting">
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                </div>

                <div class="price">
                    <h4>Acme Oops T-Shirt</h4>
                    <p>$59.95</p>
                </div>
            </div>

            <div class="row">
                <a href="essentialpuffer.php"><img src="image/essential-puffer-jacket.webp" alt=""></a>

                <div class="heart-icon">
                    <i class='bx bx-heart'></i>
                </div>
                <div class="ratting">
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star-half-outline" class="yellow"></ion-icon>
                    <ion-icon name="star-outline" class="yellow"></ion-icon>
                </div>

                <div class="price">
                    <h4>Essential Puffer Jacket</h4>
                    <p>$200</p>
                </div>
            </div>

            <div class="row">
                <a href="double-arch.php"><img src="image/double-arch.webp" alt=""></a>
                <div class="ratting">
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                </div>

                <div class="price">
                    <h4>Double Arch Oversized T-Shirt</h4>
                    <p>$69.95</p>
                </div>
            </div>

            <div class="row">
                <a href="script-hoodie.php"><img src="image/script-hoodie.webp" alt=""></a>

                <div class="heart-icon">
                    <i class='bx bx-heart'></i>
                </div>
                <div class="ratting">
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star-half-outline" class="yellow"></ion-icon>
                </div>

                <div class="price">
                    <h4>Script Hoodie</h4>
                    <p>$129.99</p>
                </div>
            </div>

            <div class="row">
                <a href="tactic-cargo.php"><img src="image/tactic-cargo.webp" alt=""></a>
                <div class="heart-icon">
                    <i class='bx bx-heart'></i>
                </div>
                <div class="ratting">
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                </div>

                <div class="price">
                    <h4>Tactic Cargo Jogger</h4>
                    <p>$109.95</p>
                </div>
            </div>

            <div class="row">
                <a href="revolution-baggy.php"><img src="image/revolution-baggy.webp" alt=""></a>
                <div class="heart-icon">
                    <i class='bx bx-heart'></i>
                </div>
                <div class="ratting">
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star-outline" class="yellow"></ion-icon>
                </div>

                <div class="price">
                    <h4>Revolution Baggy Sweatpants</h4>
                    <p>$109.95</p>
                </div>
            </div>

            <div class="row">
                <a href="ex89.php"><img src="image/EX89.webp" alt=""></a>
                <div class="heart-icon">
                    <i class='bx bx-heart'></i>
                </div>
                <div class="ratting">
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                    <ion-icon name="star" class="yellow"></ion-icon>
                </div>

                <div class="price">
                    <h4>EX89</h4>
                    <p>$179.95</p>
                </div>
            </div>
        </div>

    </section>

    <div class="end-text">
        <p>Copyright Stellan Inc ©2023</p>
        <p><?php echo date("Y.m.d"); ?></p>
    </div>

    <script src="script.js"></script>
    
</body>
</html>