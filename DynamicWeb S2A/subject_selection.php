<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Built by Stellan Lindrud -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Selection - Narrabundah College</title>
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

                        <li class="list active"><a href="#">
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
                    <h2 style="padding: 10px;">Welcome to Subject Selection Portal</h2>
                </div>
                <div class="content-box">
                    <div class="sell-box box1">
                        <div class="details">
                            <h4>1. Physics</h4>
                            <ion-icon name="analytics-outline"></ion-icon>
                            <a href=""></a>                                                
                            <p>Physics is the most fundamental of the experimental sciences, as it seeks to explain the universe itself, from the very smallest particles, quarks to the vast distances between galaxies. </p>
                        </div>
                        <p>Upload qualification information</p>
                    </div>
                    <div class="sell-box box2">
                        <div class="details">
                            <h4>Core</h4>
                            <ion-icon name="calculator-outline"></ion-icon>
                            <a href=""></a>
                        </div>
                        <p>A tertiary course designed for students who are considering studying a university course that requires a high level of mathematics, such as Engineering, Actuarial Studies or Mathematics.</p>
                    </div>
                    <div class="sell-box box3">
                            <div class="details">
                                <h4>Chemistry</h4>
                                <ion-icon name="flask-outline"></ion-icon>
                                <a href=""></a>
                            </div>
                            <p>Chemistry is the essential science. Is at the heart of the processes that sustain our life and allow us to learn, work, keep warm, and travel. In fact Chemistry is vital to most of the activities in our lives.</p>
                    </div>

                    <div class="sell-box box2">
                            <div class="details">
                                <h4>Technology</h4>
                                <ion-icon name="code-slash-outline"></ion-icon>
                                <a href=""></a>
                            </div>
                            <p>Students studying technologies will learn about the design process and its application. Students will develop research skills, computational thinking and a range of communication skills. </p>
                    </div>

                    <div class="sell-box box3">
                            <div class="details">
                                <h4>Biology</h4>
                                <ion-icon name="leaf-outline"></ion-icon>
                                <a href=""></a>
                            </div>
                            <p>Biology is the study of living things- the range of organisms found on our planet, how they work, and how they interact with each other.</p>
                    </div>

                    <div class="sell-box box1">
                            <div class="details">
                                <h4>Exercise Science</h4>
                                <ion-icon name="accessibility-outline"></ion-icon>
                                <a href=""></a>
                            </div>
                            <p>In exercise science students will learn how the body functions and how it performs while undertaking specific actions</p>
                    </div>
                </div>
                <form action="subjects_selected.php" method="get">
                    <h1 style="margin-top: 10px;">Select subjects</h1>
                    
                    <ul>
                        <li><select name="subject1" id="" required>
                            <option value="Physics">Physics</option>
                            <option value="Core">Core</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Technology">Technology</option>
                            <option value="Biology">Biology</option>
                            <option value="Exercise Science">Exercise Science</option>
                        </select></li>

                        
                        <li><select name="subject2" id="" required>
                            <option value="Physics">Physics</option>
                            <option value="Core">Core</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Technology">Technology</option>
                            <option value="Biology">Biology</option>
                            <option value="Exercise Science">Exercise Science</option>
                        </select></li>

                        
                        <li><select name="subject3" id="" required>
                            <option value="Physics">Physics</option>
                            <option value="Core">Core</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Technology">Technology</option>
                            <option value="Biology">Biology</option>
                            <option value="Exercise Science">Exercise Science</option>
                        </select></li>
                    </ul>
                    <div> <!--Center the button -->
                        <button type='submit'>Submit</button>
                        <button type="reset" style="margin-bottom: 30px;">Reset</button>
                    </div>
                     
                </form>
                    
                </div>
                
            </div>
        </main>

    </div>




    <script script.js></script>
</body>
</html>