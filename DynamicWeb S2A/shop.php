<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Built by Stellan Lindrud -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen - Narrabundah College</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="../static/style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- Importing of Modules -->
</head>
<body>
    <?php
        //Get user data
        $username = 'admin';
        $password = 'secret';
        $host = 'localhost';
        $db = 'narc';

        $conn = mysqli_connect($host,$username,$password,$db);
        if ($conn){
            // Continue on, we don't want to log it
        }else{
            echo "Failed to connect";
        }

        if($_COOKIE['id'] == 0){ //Special User
            $fname = 'Special';
            $lname = 'User';
            $tmpID = $_COOKIE['id'];
            $_COOKIE['fname'] = $fname;
            $_COOKIE['lname'] = $lname;
            $student_balance = 'NA';
            $state = 'NA';
            $gender = 'NA';
        }else{ //Student User
            $tmpID = $_COOKIE['id'];
            $sql = "SELECT * from students WHERE student_id=$tmpID";
            $result = mysqli_query($conn,$sql);
            foreach($result as $x){ //Only one array gets returned because of the unique ID
                //We set the values every time the page is loaded incase they
                //log in on a different account
                $state = $x['student_state'];
                $fname = $x['student_first_name'];
                $lname = $x['student_last_name'];
                $gender = $x['student_gender'];
                $_COOKIE['fname'] = $fname;
                $_COOKIE['lname'] = $lname;
                $student_balance = $x['student_balance'];
            }
        }

        
        //Check Shop
        $items = array();

        $itemShop = '<section class="card-container">';
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn,$sql);

        foreach($result as $x){
            $product_price = $x['product_price'];
            $product_name = $x['product_name'];
            $product_stock = $x['product_stock'];
            $product_img = $x['product_img'];

            $itemShop = $itemShop . "
                <div class='card'>
                    <h1> $product_name </h1>
                    <img src='img/$product_img' alt='' style='width: 100px; height: auto;border-radius: 10px;'>
                    <p>$ $product_price | $product_stock left</p>       
                </div>
            ";
        }
        $itemShop = $itemShop . '</section>';

        if(isset($_GET['buy'])){ //A purchase has been made

            if($tmpID == 0){ //Special User

            }
            else{
                //Get the users account balance
                $sql = "SELECT * FROM products";
                $result = mysqli_query($conn,$sql);

                foreach($result as $x){
                    //echo $x['product_name'];
                    if($_GET['buy'] == $x['product_name']){ //products match
                        //We need to change the users currency and the stock of items
                        if($student_balance <= 0 || $x['product_stock'] <= 0){
                            break; //
                        }

                        $student_balance = $student_balance - $x['product_price'];
                        $product_name = $x['product_name'];
                        $newStock = $x['product_stock']-1;
                        
                        //Update the stock
                        $sql = "UPDATE products SET product_stock='$newStock' WHERE product_name='$product_name'";
                        mysqli_query($conn, $sql);
                        
                        //Update the user balance                    
                        $sql = "UPDATE students SET student_balance='$student_balance' WHERE student_first_name='$fname'";
                        mysqli_query($conn, $sql);
                        header('Location: shop.php');
                    }
                }
            }
            
        }
        // echo <<< END
        //     sd
        // END;

    ?>

    <div class="container">
        <aside>
            <div class="navigation">
                <div class="top-list">
                    <div class="logo">
                        <a href="index.php"><img src="img/logo.png" alt="" href="index.php" style="z-index: 3; cursor: pointer;"></a>
                        <h2>Narrabundah</h2>
                    </div>
                    <div id="closeBtn">
                    <ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>


                <div class="sidebar">
                    <ul>
                        <li class="list"><a href="student_portal.php">
                            <span class="icon"><ion-icon name="home-outline"></ion-icon>></span>
                            <span class="title">Dashboard</span>
                        </a></li>

                        <li class="list"><a href="subject_selection.php">
                            <span class="icon"><ion-icon name="book"></ion-icon></span>
                            <span class="title">Subject Selection</span>
                        </a></li>

                        <li class="list last"><a href="admin_login.php">
                            <span class="icon"><ion-icon name="finger-print"></ion-icon></span>
                            <span class="title">Admin Logon</span>
                        </a></li>

                        <li class="list active"><a href="#">
                            <span class="icon"><ion-icon name="fast-food"></ion-icon></span>
                            <span class="title">Canteen</span>
                        </a></li>

                        <li class="list last"><a href="#">
                            <span class="icon"><ion-icon name="time"></ion-icon></span>
                            <?php $time = date('h:i'); date_default_timezone_set("Australia/Canberra"); ?>
                            <span class="title"><?php echo date("Y.m.d") ?></span>
                        </a></li>

                        <li class="list last"><a href="#">
                            <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                            <span class="title">Logout</span>
                        </a></li>
                    </ul>

                </div>
            </div>
        </aside>

        <main>
            <div class="topCenter">
                <div class="header-title">
                    <span><?php echo $fname;?></span>
                    <h1><?php echo $lname;?></h1>
                    <p><?php echo 'User ID: ' . ' ' . $_COOKIE['id'];?></p>
                </div>
                <div class="searchBox">
                    <ion-icon name="search"></ion-icon>
                    <input type="text" placeholder="Search">
                </div>
            </div>

            <div class="secondTopCenter">
                <div class="main-title">
                    <h3 style="padding: 10px;">Buy Items</h3>
                </div>
            </div>

            <?php
                echo $itemShop;
            ?>

            <!-- <section class="card-container">
                <div class="card">
                    <h1>Chicken Noodles</h1>
                    <img src="img/noodles.jpg" alt="" style="width: 100px; height: auto;">
                    <p>$2.55 | 5 left</p>       
                </div>

                <div class="card">
                    <h1>Card #2</h1>
                    <img src="img/noodles.jpg" alt="" style="width: 100px; height: auto;">
                    <p>This is the second card.</p>
                </div>

                <div class="card">
                    <h1>Card #3</h1>
                    <img src="img/noodles.jpg" alt="" style="width: 100px; height: auto;">
                    <p>This is the third card.</p>
                </div>

                <div class="card">                    
                    <h1>Card #4</h1>
                    <img src="img/noodles.jpg" alt="" style="width: 100px; height: auto;">
                    <p>This is the fourth card.</p>
                </div>

                <div class="card">   
                    <h1>Card #5</h1>
                    <img src="img/noodles.jpg" alt="" style="width: 100px; height: auto;">
                    <p>This is the fifth card.</p>
                </div>

                <div class="card">                 
                    <h1>Card #6</h1>
                    <img src="img/noodles.jpg" alt="" style="width: 100px; height: auto;">
                    <p>This is the sixth card.</p>
                </div>
            </section> -->

        </main>

        <!-- </div> -->
        <div class="right-side">
            <h1 style="margin-left: 100px;margin-top: 20px;"><?php echo '$' . $student_balance ?></h1>
            <div class="spacer-small"></div>
            <div class="ordered-items">
                <h3>Ordered Items: </h3>
                <ul>
                    <li>Spicy Asian Noodles</li>
                    <li>Fried Chicken</li>
                    <li>Curry Bowl</li>
                </ul>

                
                <form action="" style="margin-left: 25px;margin-top: 20px;">
                    <select name="buy" id="" method="get" style="padding: 10px;border-radius: 10px;">
                        <option value="Apple">Apple</option>
                        <option value="Garlic Bread">Garlic Bread</option>
                        <option value="Hashbrown">Hashbrown</option>
                        <option value="Chicken Burger">Chicken Burger</option>
                        <option value="Potato Chips">Potato Chips</option>
                        <option value="Coffee">Coffee</option>
                    </select>
                    <!-- <input type="number" name="quantity" style="width: 30px;height: 30px; border-radius: 5px;" min="1" max="5"> -->
                    <button type="Submit">Buy!</button>
                </form>
                
            </div>
            
    
        </div>
        
        
    </div>




    <script script.js></script>
</body>
</html>