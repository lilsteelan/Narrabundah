<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Stellan</title>
    <meta name="description" content="Stellan - Shop Winter season">
    <meta name="keywords" content="Admin Logon">
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
        // Check if login details are correct
        $servername = 'localhost';
        $username = 'stellan';
        $password = 'lindrud';
        $db = 'online_shop';
        $conn = new mysqli($servername,$username,$password,$db);

        if($conn){
            $sql = 'SELECT * from users';
            $result = mysqli_query($conn,$sql);
            $loggedIn = false;
            if ($result){
                foreach($result as $x){ //Perform a linear search through all accounts
                    if($_POST['password'] == $x['user_password'] && $_POST['email']==$x['user_email']){
                        $loggedIn = true;
                        Header('Location: admin_panel.php');
                    }
                }
                if($loggedIn == false)
                {
                    Header('Location: admin.php');
                }else{ //Logged in
                    Header('Location: admin_panel.php');
                }
            }
        }
        else
        {
            // echo "Connection failed";
            // echo "
            // <script>
            //     window.location.href = \"admin.php\";
            // </script>";

        }



    ?>
    <header>
        <a href="index.php" class="logo"><img src="image/logo2.png" alt=""></a>

        <ul class="navmenu">
            <li><a href="index.php">home</a></li>
            <li><a href="#trending">shop</a></li>
        </ul>

        <div class="nav-icon">
            <a href="login.php"><i class='bx bx-user' ></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    
    <div class="end-text">
        <p>Copyright Stellan Inc ©2023</p>
        <p><?php echo date("Y.m.d"); ?></p>
    </div>

    <script src="script.js"></script>
    
</body>
</html>