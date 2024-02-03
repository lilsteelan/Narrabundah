<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Built by Stellan Lindrud -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Succesfully Logged In - Narrabundah College</title>
</head>
<body>
    <?php
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

        $sql = 'SELECT * from students';
        $result = mysqli_query($conn,$sql);
        $loggedIn = false;
        if ($result){
            //echo $_POST['password'] . " is the pw <br>";
            foreach($result as $x){
                //echo $x['email'];
                //echo $_POST['password'];
                //unencrpyt and check
                //echo $x['password'] . "<br> is the encryption <br>";
                if(password_verify($_POST['password'], $x['student_password']) && $_POST['email']==$x['student_email']){
                    //echo "<h1>Logged In</h1>";
                    //$name = $x['first_name'];
                    //echo "<h2>Welcome back $name </h2>";
                    $loggedIn = true;
                    setcookie('id',$x['student_id']);
                    setcookie('fname',$x['student_first_name']);
                    setcookie('lname',$x['student_last_name']);
                    echo "
                    <script>
                        window.location.href = \"student_portal.php\";
                    </script>
                ";
                    //$x['ID'];
                }
            }

            
            //check if they are the special user
            if ($_POST['email'] == 'aaa' && $_POST['password'] == '222' && !$loggedIn){
                $loggedIn = true;
                setcookie('fname','special');
                setcookie('lname','user');
                setcookie('id',0);
                echo "
                <script>
                    window.location.href = \"student_portal.php\";
                </script>
            ";
            }

            if(!$loggedIn){
                //echo "match not found";
                echo "
                <script>
                    window.location.href = \"index.php\";
                </script>
            ";
            }
        }else{
            echo "Query failed";
        }
    ?>

    <div class="content">
        
        <p><b>
            <?php
            ?>
        
        </b></p>
    </div>
</body>
</html>