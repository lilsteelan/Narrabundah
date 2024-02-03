<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Built by Stellan Lindrud -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Narrabundah College</title>
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

        //Check if the user has already selected subjects
        $sql = "SELECT * from subjects WHERE subject_id='$tmpID'";
        $results = mysqli_query($conn,$sql);
        foreach($results as $x){ //Only one array gets returned because of the unique ID
            //print_r($x);
            if($x['subject1']){ //Check if one subject is selected because if one is they all are
                $s1 = $x['subject1'];
                $s2 = $x['subject2'];
                $s3 = $x['subject3'];

                $subjects = "
                    <ul>
                        <li>$s1</li>
                        <li>$s2</li>
                        <li>$s3</li>
                    </ul>
                ";
            }else{
                $subjects = "
                    No subjects currently selected
                ";
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
                        <li class="list active"><a href="#">
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

                        <li class="list last"><a href="shop.php">
                            <span class="icon"><ion-icon name="fast-food"></ion-icon></span>
                            <span class="title">Canteen</span>
                        </a></li>

                        <li class="list last"><a href="#">
                            <span class="icon"><ion-icon name="time"></ion-icon></span>
                            <?php $time = date('h:i'); date_default_timezone_set("Australia/Canberra"); ?>
                            <span class="title"><?php echo date("Y.m.d") ?></span>
                        </a></li>

                        <li class="list last"><a href="logout.php">
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
                    <h3 style="padding: 10px;">Welcome to Narrabundah! Don't forget to partake in subject selection</h3>
                </div>
                <div class="content-box">
                    <div class="sell-box box1">
                        <div class="details">
                            <h4>1. Location</h4>
                            <!-- <a href="">Go</a> -->
                            <br>
                            <p><?php echo "State: " . $state;?></p>
                            <p><?php echo 'Gender: ' . ' ' . $gender;?></p>
                        </div>
                    </div>
                    <div class="sell-box box2">
                        <div class="details">
                            <h4>2.Selected Subjects</h4>
                            <a href="subject_selection.php">Go</a>
                        </div>
                        <p><?php 
                        if(isset($subjects)){
                            echo $subjects;
                        }else{
                            echo "No subjects currently selected";
                        }
                        
                        ?></p>
                    </div>
                    <div class="sell-box box3">
                            <div class="details">
                                <h4>3. Submit an Inquiry to the admin</h4>
                                <ion-icon name="arrow-forward"></ion-icon>
                                <a href="">Go</a>
                            </div>
                            <p>Keep up with the latest news with the forum!</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </main>
    </div>




    <script script.js></script>
</body>
</html>