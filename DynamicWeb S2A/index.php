<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Built by Stellan Lindrud -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Narrabundah College - Student Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="max-height: 100vh;">

    <header class="">
        <!-- <img src="img/logo.png" alt="" class="logo">
        <ul>
            <li><a href="student_portal.php">Student Portal</a></li>
            <li><a href="admin_login.php">Admin Logon</a></li>
            <li><a href="shop.php">Order Food</a></li>
            <li><a href="#">Library</a></li>
        </ul> -->
    </header>
    <!-- ENTIRE LOGIN SECTION -->
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
        </div>
        <!-- LOGIN -->
        <form id="login" action="login_student.php" class="input-group" method="post">
            <input type="text" class="input-field" placeholder="Email" required name="email">
            <input type="password" class="input-field" placeholder="Password" required name="password">
            <select name="grade" id="grade" class="input-field" placeholder="grade">
                <option value="11">Year 11</option>
                <option value="12">Year 12</option>
            </select>
            <!-- <input type="checkbox" class="check-box"><span>Remember Me</span> -->
            <button type="submit" class="submit-btn">Login</button>
        </form>
        <!-- REGISTER -->
        <form action="register_student.php" id="register" class="input-group" method="post">
            <input type="email" class="input-field" placeholder="Email" name="email" required>
            <input type="password" class="input-field" placeholder="Password" name="password" required>
            <input type="text" class="input-field" placeholder="First Name" name="fname" required>
            <input type="text" class="input-field" placeholder="Last Name" name="lname" required>
            <!-- <input type="select" class="input-field"> -->

            <select name="grade" id="grade" class="input-field" placeholder="grade">
                <option value="11">Year 11</option>
                <option value="12">Year 12</option>
            </select>
            <button type="submit" class="submit-btn">Register</button>
        </form>
    </div>

    <!-- RealTime Client side logic for switching from Login to Register -->
    <!-- Only for aesthetic purposes -->
    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        function register() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }

        function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
        }

        window.addEventListener("scroll", function(){
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>

</body>
</html>