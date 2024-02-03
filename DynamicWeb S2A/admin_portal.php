<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Built by Stellan Lindrud -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Narrabundah College</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
    <!-- Importing of Modules -->
</head>

<!-- The most complicted script, involves admin security to prevent people to simply typing the link to logon
    and it also involves the use of various different post request to build the website entirely in php
-->
<body>
    <?php
        //Get user data
        $username = 'admin';
        $password = 'secret';
        $host = 'localhost';
        $db = 'narc';
        $time = date("Y.m.d");
        date_default_timezone_set("Australia/Canberra"); 
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
    ?>

    <?php
        $flag = false;
        $order = 'descending';
        if(isset($_POST['order'])){ //Check if they have modified the order
            $order = $_POST['order'];
            $flag = true; //set a flag so that they automically get access after deleting
        }else{
            $order = 'descending'; //fallback
            $flag = true; //set a flag so that they automically get access after deleting
        }
        if(isset($_POST['student_username'])){ //check if a request to delete a user was made
            //delete their account
            $student_id = $_POST['student_username'];
            $sql = "DELETE FROM students WHERE student_id = '$student_id'";
            mysqli_query($conn, $sql);

            //Delete their subject selection
            $student_id = $_POST['student_username'];
            $sql = "DELETE FROM students WHERE student_id = '$student_id'";
            mysqli_query($conn, $sql);

            $flag = true; //set a flag so that they automically get access after deleting
        }
        
        function displayAdminPanel(){
            global $order;
            $username = 'admin';
            $password = 'secret';
            $host = 'localhost';
            $db = 'narc';
            $time = date("Y.m.d");
            $conn = mysqli_connect($host,$username,$password,$db);
            // $studentdata = array();
            $studentable = "<table>
                <tr>
                    <td>&nbsp;&nbsp;ID</td>
                    <td>fname</td>
                    <td>lname</td>
                    <td>Year</td>
                    <td>Gender</td>
                    <td>Delete User</td>
                </tr>
            ";

            if($order == 'ascending'){
                $sql = 'SELECT * FROM students';
                $results = mysqli_query($conn,$sql);
                foreach($results as $x){
                    $id = $x['student_id'];
                    $fname = $x['student_first_name'];
                    $lname = $x['student_last_name'];
                    $email = $x['student_email'];
                    $gender = $x['student_gender'];
                    $year = $x['student_year'];
    
                    $studentable = $studentable . 
                    "
                        <tr>
                            <td>&nbsp;&nbsp;$id&nbsp;&nbsp;</td>
                            <td>$fname</td>
                            <td>$lname</td>
                            <td>Year $year</td>
                            <td>$gender</td>
                            <td style='width: 150px;'>
                                <form action='admin_portal.php' method='POST' >
                                    <div style='display: none'>
                                        <input type='text' name='student_username' value='$id'>
                                    </div>
                                    <button style='color: black; cursor: pointer;background-color: red;width: 140px;'>DELETE</button>
                                </form>
                            </td>
                        </tr>
                    ";
                }
            }
            else if($order == 'descending'){
                $sql = 'SELECT * FROM students ORDER BY student_id DESC';
                $results = mysqli_query($conn,$sql);
                foreach($results as $x){
                    $id = $x['student_id'];
                    $fname = $x['student_first_name'];
                    $lname = $x['student_last_name'];
                    $email = $x['student_email'];
                    $gender = $x['student_gender'];
                    $year = $x['student_year'];
    
                    $studentable = $studentable . 
                    "
                        <tr>
                            <td>&nbsp;&nbsp;$id&nbsp;&nbsp;</td>
                            <td>$fname</td>
                            <td>$lname</td>
                            <td>Year $year</td>
                            <td>$gender</td>
                            <td style='width: 150px;'>
                                <form action='admin_portal.php' method='POST' >
                                    <div style='display: none'>
                                        <input type='text' name='student_username' value='$id'>
                                    </div>
                                    <button style='color: black; cursor: pointer;background-color: red;width: 140px;'>DELETE</button>
                                </form>
                            </td>
                        </tr>
                    ";
                }
            }
            else if($order == 'ascending_last_name'){
                $sql = 'SELECT * FROM students ORDER BY student_last_name ASC';
                $results = mysqli_query($conn,$sql);
                foreach($results as $x){
                    $id = $x['student_id'];
                    $fname = $x['student_first_name'];
                    $lname = $x['student_last_name'];
                    $email = $x['student_email'];
                    $gender = $x['student_gender'];
                    $year = $x['student_year'];
    
                    $studentable = $studentable . 
                    "
                        <tr>
                            <td>&nbsp;&nbsp;$id&nbsp;&nbsp;</td>
                            <td>$fname</td>
                            <td>$lname</td>
                            <td>Year $year</td>
                            <td>$gender</td>
                            <td style='width: 150px;'>
                                <form action='admin_portal.php' method='POST' >
                                    <div style='display: none'>
                                        <input type='text' name='student_username' value='$id'>
                                    </div>
                                    <button style='color: black; cursor: pointer;background-color: red;width: 140px;'>DELETE</button>
                                </form>
                            </td>
                        </tr>
                    ";
                }
            }
            else if($order == 'descending_last_name'){
                $sql = 'SELECT * FROM students ORDER BY student_last_name DESC';
                $results = mysqli_query($conn,$sql);
                foreach($results as $x){
                    $id = $x['student_id'];
                    $fname = $x['student_first_name'];
                    $lname = $x['student_last_name'];
                    $email = $x['student_email'];
                    $gender = $x['student_gender'];
                    $year = $x['student_year'];
    
                    $studentable = $studentable . 
                    "
                        <tr>
                            <td>&nbsp;&nbsp;$id&nbsp;&nbsp;</td>
                            <td>$fname</td>
                            <td>$lname</td>
                            <td>Year $year</td>
                            <td>$gender</td>
                            <td style='width: 150px;'>
                                <form action='admin_portal.php' method='POST' >
                                    <div style='display: none'>
                                        <input type='text' name='student_username' value='$id'>
                                    </div>
                                    <button style='color: black; cursor: pointer;background-color: red;width: 140px;'>DELETE</button>
                                </form>
                            </td>
                        </tr>
                    ";
                }
            }
            $studentable . "</table>";
            $date = date("Y.m.d");
            echo <<< END
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
                                    <span class="title">$time</span>
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
                            <span>Greg</span>
                            <h1>Clarke</h1>
                            <p>Privilege authorised</p>
                        </div>
                        <form action="admin_portal.php" method="post">
                        <div class="input-elements">
                            <div class="searchBox">
                                <ion-icon name="search"></ion-icon>
                                <input type="text" name="search" placeholder="Search for Students"></input>
                                <input type="password" value="secret" required name='password' style="display: none;"></input>
                                <input type="password" value="admin" required name='username' style="display: none;"></input>
                            </div>
                            <button type="submit" style="margin-top: 10px;">Search!</button>
                        </div>
                        </form>
                    </div>
        
                    <div class="secondTopCenter">
                        <div class="main-title">
                            
                        </div>
                        <div class='centered' style='flex-direction: column;'>
                            <h1>LOGGED IN</h1>
                            $studentable
                            <table style='display:none'>
                            <th></th>
                            </table>
                        </div> 
                    </div>
                </main>
                <div class="right-side" style="padding: 10px;">
                    <h1 style="margin-top: 20px;">Sort by:</h1>
                    <form action="admin_portal.php" method="post">
                        <select style="padding: 8px; border-radius: 5px; margin-top: 10px" name="order">
                            <option value="ascending">Ascending ID</option>
                            <option value="descending">Descending ID</option>
                            <option value="descending_last_name">Descending Last Name</option>
                            <option value="ascending_last_name">Ascending Last Name</option>
                        </select>
                        <button type="submit" style="margin-top: 10px;">Sort!</button>
                        <h4>Order: $order</h4>
                    </form>
                </div>
            </div>
            END;
        }
        
        if(isset($_POST['search'])){//Check if a search was done
            $search = $_POST['search'];
            //$sql = 'SELECT student_first_name from students where tags LIKE $search';
            $sql = "SELECT * FROM students WHERE (student_first_name LIKE '%$search%' OR student_last_name LIKE '%$search%')";
            
            $studentable = '';
            $results = mysqli_query($conn, $sql);
            $studentable = "<table>
            <tr>
                <td>&nbsp;&nbsp;ID</td>
                <td>fname</td>
                <td>lname</td>
                <td>Year</td>
                <td>Gender</td>
                <td>Delete User</td>
            </tr>
            ";
            foreach($results as $x){
                $id = $x['student_id'];
                $fname = $x['student_first_name'];
                $lname = $x['student_last_name'];
                $email = $x['student_email'];
                $gender = $x['student_gender'];
                $year = $x['student_year'];

                $studentable = $studentable . 
                "
                    <tr>
                        <td>&nbsp;&nbsp;$id&nbsp;&nbsp;</td>
                        <td>$fname</td>
                        <td>$lname</td>
                        <td>Year $year</td>
                        <td>$gender</td>
                        <td>
                            <form action='admin_portal.php' method='POST'>
                                <div style='display: none'>
                                    <input type='text' name='student_username' value='$id'>
                                </div>
                                <button style='color: black; cursor: pointer;background-color: red;'>DELETE</button>
                            </form>
                        </td>
                    </tr>
                ";
            }

            $studentable . "</table>";
            $date = date("Y.m.d");
            echo <<< END
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
                                    <span class="title">$time</span>
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
                            <span>Greg</span>
                            <h1>Clarke</h1>
                            <p>Privilege authorised</p>
                        </div>
                        <form action="admin_portal.php" method="post">
                        <div class="input-elements">
                            <div class="searchBox">
                                <ion-icon name="search"></ion-icon>
                                <input type="text" name="search" placeholder="Search for Students"></input>
                                <input type="password" value="secret" required name='password' style="display: none;"></input>
                                <input type="password" value="admin" required name='username' style="display: none;"></input>
                            </div>
                            <button type="submit" style="margin-top: 10px;">Search!</button>
                        </div>
                        </form>
                    </div>
        
                    <div class="secondTopCenter">
                        <div class="main-title">
                            
                        </div>
                        <div class='centered' style='flex-direction: column;'>
                            <h1>LOGGED IN</h1>
                            $studentable
                            <table style='display:none'>
                            <th></th>
                            </table>
                        </div> 
                    </div>
                </main>
                <div class="right-side" style="padding: 10px;">
                    <h1 style="margin-top: 20px;">Sort by:</h1>
                    <form action="admin_portal.php" method="post">
                        <select style="padding: 8px; border-radius: 5px; margin-top: 10px" name="order">
                            <option value="ascending">Ascending ID</option>
                            <option value="descending">Descending ID</option>
                            <option value="descending_last_name">Descending Last Name</option>
                            <option value="ascending_last_name">Ascending Last Name</option>
                        </select>
                        <button type="submit" style="margin-top: 10px;">Sort!</button>
                        <h4>Order: $order</h4>
                    </form>
                </div>
            </div>
    
            END;
            //$studentable = "$result";
        }else{ // Search post form wasn't found so its probably a first time login
            if (isset($_POST['password']) || $flag){ //Check if there is a valid post(a valid post will contain a password)
                if($flag){
                    $flag = false;
                    displayAdminPanel();
                }
                else if ($_POST['password'] == 'secret' && $_POST['username'] == 'admin'){ //Check to see if details are valid
                    //
                    displayAdminPanel();
                }else{
                    echo "
                    <script>
                        window.location.href = \"admin_login.php\";
                    </script>
                ";
                }   
            }else{
                echo "insuffient credentials";
            }   
        }
    ?>    
    <script script.js></script>
</body>
</html>