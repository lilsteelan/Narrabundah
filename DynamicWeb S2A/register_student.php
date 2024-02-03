<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Built by Stellan Lindrud -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Succesfully Registered - Narrabundah College</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: linear-gradient(to right, #00B4DB,#0083B0);">
    <header class="">
        <img src="img/logo.png" alt="" class="logo" href="index.php">
        <ul>
            <li><a href="#">Student Portfolio</a></li>
            <li><a href="#">Admin Logon</a></li>
            <li><a href="#">Order Food</a></li>
            <li><a href="#">Library</a></li>
        </ul>
    </header>


    <?php
        //UPDATE example
        // UPDATE `students` SET `year` = '12' WHERE `students`.`ID` = 16;
        //Check if the post includes the second form 
        $username = 'admin';
        $password = 'secret';
        $host = 'localhost';
        $db = 'narc';
        $tablename = 'students';

        $conn = mysqli_connect($host,$username,$password,$db);
        if(isset($_POST['state'])){
            echo "Form was completed";
            //Update and send second the second set of data
            $state = $_POST['state'];
            $gender = $_POST['gender'];
            //$age = $_POST['age'];
            $lname = $_POST['lname'];

            //Get most recently added user ID
            //$sql = 'SELECT * from students';
            //$results = mysqli_query($conn,$sql);
            //$id = end($results)['ID'];
            //$id = 33;

            //UPDATE `students` SET `state` = 'ACT' WHERE `students`.`ID` = 23;
            $sql = "UPDATE students SET student_state='$state' WHERE student_last_name='$lname'";
            mysqli_query($conn, $sql);
            $sql = "UPDATE students SET student_gender='$gender' WHERE student_last_name='$lname'";
            mysqli_query($conn, $sql);

            //`header("Location : index.php");`
            // $_SESSION['ID'] = "test";
            // setcookie('id',$x['ID']);
            // setcookie('fname',end($results)['fname']);
            // setcookie('lname',end($results)['lname']);
            echo "
                <script>
                    window.location.href = \"index.php\";
                </script>
            ";
            //$sql = "UPDATE students SET gender"
            //UPDATE `students` SET `gender` = '$gender' WHERE `fname` = $_SESSION["fname"]
            

        }
        else
        {  //Second form has not been completed
            $username = 'admin';
            $password = 'secret';
            $host = 'localhost';
            $db = 'narc';
            $tablename = 'students';
    
            $conn = mysqli_connect($host,$username,$password,$db);
            if ($conn){
                // Continue on, we don't want to log it
            }else{
                echo "Failed to connect";
            }

            $fname = $_POST['fname'];
            //$_SESSION["fname"] = $fname; //Store session so we know which user to update settings on
            $lname = $_POST['lname'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $year = $_POST['grade'];

            //Encrypt the password so that if the DB is hacked the accounts cannot be stolen
            $encryptedpw = password_hash($password, PASSWORD_DEFAULT);
            
            $sql="INSERT into $tablename (student_first_name, student_last_name, student_email, student_password,student_year, student_balance) values ('$fname', '$lname','$email','$encryptedpw','$year','100')";

            if (mysqli_query($conn, $sql)){
                // Succsefully added user data
            }else{
                echo "Failed to insert data";
            }

            echo
            "
            <div class=\"content\">
                <div class=\"form-content\" style='margin-top: 200px;'>
                    <h2 style=\"text-align: center\">Welcome $fname, tell us<br> a bit more about yourself</h2>
                    <div class=\"spacer-small\"></div>
                    <form class=\"more-info\" method='post' action='register_student.php'>
                        <select name=\"state\" id='' class=\"padded\" required>
                            <option value=\"WA\">Western Australia</option>
                            <option value=\"VIC\">Victoria</option>
                            <option value=\"NSW\">New South Wales</option>
                            <option value=\"ACT\">Australian Capital Territory</option>
                            <option value=\"QLD\">Queensland</option>
                            <option value=\"TAS\">Tasmania</option>
                        </select>
                        
                        <select name=\"gender\" id='' class=\"padded\" required>
                            <option value=\"M\">Male</option>
                            <option value=\"F\">Female</option>
                        </select>
        
                        <!--<input type=\"number\" class=\"input-field\" placeholder=\"AGE\" required style=\"width: 200px;\" class='padded' name='age' value=''>-->
                        <input type='text' style='display: none;' value='$lname' name='lname'>
                    <button type=\"submit\" class=\"submit-btn\" style=\"width: 120px;\">Finish!</button>
                </form>
                </div>
            </div>
            ";
        }
    ?>



    <script>
        window.addEventListener("scroll", function(){
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
</body>
</html>