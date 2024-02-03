<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Built by Stellan Lindrud -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Narrabundah College</title>
    <link rel="stylesheet" href="css/dashboard.css">
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
            }
        }
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

                        <li class="list active"><a href="#">
                            <span class="icon"><ion-icon name="finger-print"></ion-icon></span>
                            <span class="title">Admin Logon</span>
                        </a></li>

                        <li class="list"><a href="shop.php">
                            <span class="icon"><ion-icon name="fast-food"></ion-icon></span>
                            <span class="title">Canteen</span>
                        </a></li>

                        <li class="list"><a href="#">
                            <span class="icon"><ion-icon name="time"></ion-icon></span>
                            <?php $time = date('h:i'); date_default_timezone_set("Australia/Canberra"); ?>
                            <span class="title"><?php echo date("Y.m.d") ?></span>
                        </a></li>

                        <li class="list"><a href="logout.php">
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
                    <h3 style="padding: 10px;">Login to view and edit database</h3>
                </div>
                <div class="centered">
                    <div class="adminform" style="">
                        <h1>Admin Logon</h1>
                        <form action="admin_portal.php" method='post'>
                            <div class="spacer-small"></div>
                            <div class="searchBox" style="margin: 10px;"> <!--using searchbox class because im reusing inputs-->
                                <input type="text" placeholder="username" required name='username'>
                            </div>
                            <div class="spacer-small"></div>
                            <div class="searchBox" style="margin: 10px;">
                                <input type="password" placeholder="password" required name='password'>
                            </div>

                            <div class="spacer-small"></div>

                            <div class="centered"> <!--Center the button -->
                                <button type='submit'>Login</button>
                            </div>
                            
                            
                        </form>
                    </div>
                </div>

                
            </div>
        </main>
        <div class="right-side"><h1></h1></div>
    </div>




    <script script.js></script>
</body>
</html>