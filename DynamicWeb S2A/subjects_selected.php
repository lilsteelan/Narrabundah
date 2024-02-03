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

        //Enter their selected subjects into the database
        //To do this we need to overwite our previous database connection

        $conn = mysqli_connect($host,$username,$password,$db);
        $tablename = 'subjects';

        if($conn){
            if(isset($_GET['subject1'])){
                $subject1 = $_GET['subject1'];
                $subject2 = $_GET['subject2'];
                $subject3 = $_GET['subject3'];

                $sql="INSERT into $tablename (subject_id, subject1, subject2, subject3) values ('$tmpID', '$subject1','$subject2','$subject3')";
                mysqli_query($conn,$sql);
            }else{ //There was no get request
                //Redirect back to subject selection
                echo "
                    <script>
                        window.location.href = \"index.php\";
                    </script>
                ";
            }
            
        }else{
            echo 'Connection failed';
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

                        <li class="list active"><a href="subject_selection.php">
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
                <div class="centered" style="height: 65vh; flex-direction: column;">
                    <h1>Your preferences have been submitted!</h1><br>
                    <h3><?php echo "Time submitted: " . date('H:i:s') ?></h3>
                    <h4 style="color: purple;"><?php echo $_GET['subject1']?></h4>
                    <h4 style="color: purple;"><?php echo $_GET['subject2']?></h4>
                    <h4 style="color: purple;"><?php echo $_GET['subject3']?></h4>
                </div>
            </div>
        </main>
    </div>




    <script script.js></script>
</body>
</html>