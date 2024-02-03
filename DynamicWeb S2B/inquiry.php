<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry - Stellan</title>
    <meta name="description" content="Stellan - Shop Winter season">
    <meta name="keywords" content="Air Flight Mid">
    <!-- CSS-link -->
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <?php
    //Check if an inquiry was made
    if(isset($_GET['name'])){
        $db = 'online_shop';
        $username = 'stellan';
        $password = 'lindrud';
        $host = 'localhost';

        $name = $_GET['name'];
        $link = $_GET['link'];
        $conn = mysqli_connect($host, $username, $password, $db);
        $query = "INSERT INTO inquiries (Name,Product_Link,Age_Range) values ('$name','$link','') ";
        mysqli_query($conn,$query);

        $range = $_GET['age-range'];
        // $sql = "UPDATE students SET student_state='$state' WHERE student_last_name='$lname'";

        $query = "UPDATE inquiries SET Age_Range = '$range' WHERE Name = '$name'";
        mysqli_query($conn,$query);
        Header("Location: inquirysuccesful.php");
    }
    else[
        // Continue
    ]


    ?>

    <header>
        <a href="index.php" class="logo"><img src="image/logo2.png" alt=""></a>

        <ul class="navmenu">
            <li><a href="index.php">home</a></li>
            <li><a href="#trending">shop</a></li>
        </ul>

        <div class="nav-icon">
            <a href="#"><i class='bx bx-user' ></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <section class="product">
        <div class="left">
            <h5>Send an Inquiry</h5>
            <h1>Want a <span style="text-decoration: underline; color:#E75480"><i>NEW</i></span> <br><span style="color: aqua;">product?</span></h1>
            <p>Send us an inquiry and we'll try and get it set up!</p>
            
        </div>
        <div class="right" style="background-color: #ebebeb;">
            <form action="inquiry.php" method="get" style="width: 90%;margin-top: -120px;">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
                </div>  

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Product Link</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="link" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Where can the product be found?</div>
                </div>


                <p>Product manufacturing origin</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="selectArea" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        International
                    </label>
                </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="selectArea" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Domestic
                    </label>
                </div>

                <label for="cars">Select age range:</label>
                    <select name="age-range" id="age-range">
                    <option value="1-16">1-16</option>
                    <option value="16-20">16-20</option>
                    <option value="20-26">20-26</option>
                    <option value="26+">26+</option>
                </select>
                <div class="form-check form-switch" style="margin-top: 40px;">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Receive updates from us</label>
                </div>
                <button class="buy" role="button" type="submit" style="margin-top: 25px">Submit!</button>
            </form>
        </div>
    </section>

    <div class="end-text">
        <p>Copyright Stellan Inc ©2023</p>
        <p><?php echo date("Y.m.d"); ?></p>
    </div>

    <script src="script.js"></script>
    
</body>
</html>