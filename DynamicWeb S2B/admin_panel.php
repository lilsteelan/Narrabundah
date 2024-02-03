<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Stellan</title>
    <meta name="description" content="Stellan - Shop Winter season">
    <meta name="keywords" content="Admin Panels">
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
<?php
    // Generate Invoice Table
    $username = 'stellan';
    $password = 'lindrud';
    $host = 'localhost';
    $db = 'online_shop';
    $conn = mysqli_connect($host,$username,$password,$db);  
    $invoicetable = "<table>
        <tr>
            <td>Customer Name</td>
            <td>Invoice ID</td>
            <td>Product Name</td>
            <td>Quantity</td>
            <td>Delete</td>
        </tr>
    ";
    
    $mode2 = false;
    if(isset($_GET['order'])){ //Check if they wanna use inner join
        if($_GET['order'] == 'innerjoin'){
            $mode2 = true; //Inner join mode
            $query = "SELECT DISTINCT c.name, i.customer_name, i.invoice_id, i.quantity, i.product_name
            FROM customers as c
            INNER JOIN invoices as i
            ON c.name = i.customer_name;";
            $results = mysqli_query($conn,$query);
            foreach($results as $object){
                // foreach($object as $x){
                //     echo $x;
                // }
                $customer_name =  $object['name'] . "<br>";
                $id =  $object['invoice_id']. "<br>";
                $quantity  = $object['quantity']. "<br>";
                $product_name  = $object['product_name']. "<br>";

                $invoicetable = $invoicetable . 
                "
                    <tr>
                        <td>$customer_name</td>
                        <td>$id</td>
                        <td>$product_name</td>
                        <td>$quantity</td>
                        <td style='width: 150px;'>
                            <form action='admin_panel.php' method='POST' >
                                <div style='display: none'>
                                    <input type='text' name='customer' value='$id'>
                                </div>
                                <button type='submit' class='btn btn-danger' style='color: black; cursor: pointer;background-color: red;width: 140px;'>DELETE</button>
                            </form>
                        </td>
                    </tr>
                ";
            }
        }
    }

    if($mode2 == false){
        if(isset($_GET['search'])){ //Check if a search request was made
            $search = $_GET['search'];
            $query = "SELECT * FROM invoices WHERE (customer_name LIKE '%$search%' OR product_name LIKE '%$search%')";
            $results = mysqli_query($conn,$query);
        }else{ //No search request check for order
            if(isset($_GET['order'])){
                if($_GET['order'] == 'descending'){
                    $query = 'SELECT * FROM invoices ORDER BY invoice_id DESC';
                }else if($_GET['order'] == 'ascending'){
                    $query = 'SELECT * FROM invoices ORDER BY invoice_id ASC';
                }else if($_GET['order'] == 'ascendingQ'){
                    $query = 'SELECT * FROM invoices ORDER BY quantity ASC';
                }else if($_GET['order'] == 'descendingQ'){
                    $query = 'SELECT * FROM invoices ORDER BY quantity DESC';
                }
            }
            else{
                $query = 'SELECT * FROM invoices';
            }
            $results = mysqli_query($conn,$query);
        }

        foreach($results as $x){
            $id = $x['invoice_id'];
            $customer_name = $x['customer_name'];
            $product_name = $x['product_name'];
            $quantity = $x['quantity'];
    
            $invoicetable = $invoicetable . 
            "
                <tr>
                    <td>$customer_name</td>
                    <td>$id</td>
                    <td>$product_name</td>
                    <td>$quantity</td>
                    <td style='width: 150px;'>
                        <form action='admin_panel.php' method='POST' >
                            <div style='display: none'>
                                <input type='text' name='customer' value='$id'>
                            </div>
                            <button type='submit' class='btn btn-danger' style='color: black; cursor: pointer;background-color: red;width: 140px;'>DELETE</button>
                        </form>
                    </td>
                </tr>
            ";
        }
    }

    if(isset($_POST['customer'])){ //check if a request to delete a user was made
        //delete their account
        $invoice_id = $_POST['customer'];
        $sql = "DELETE FROM invoices WHERE invoice_id = '$invoice_id'";
        mysqli_query($conn, $sql);
        Header('Location: admin_panel.php');
    }

    ?>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
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

    <section class="product-table">
        <form action="admin_panel.php" method="get" style="display: flex; justify-content: center;">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Search</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="search" aria-describedby="emailHelp" style="width: 300px;">
                <!-- <label for="order">Sort:</label> -->
                <button type="button" class="btn btn-primary" type="submit" style="margin-top: 10px;" value="submit">Submit</button>
                <a href="admin_panel.php"><button type="button"  class="btn btn-info" style="margin-top: 10px;">Reset</button></a>
            </div>  
            
        </form>
        <div class="dropdown" style="display:flex;justify-content:center;">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Order
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="http://localhost:83/DynamicWeb/admin_panel.php">Ascending</a></li>
                    <li><a class="dropdown-item" href="http://localhost:83/DynamicWeb/admin_panel.php?order=descending#">Descending</a></li>
                    <li><a class="dropdown-item" href="http://localhost:83/DynamicWeb/admin_panel.php?order=ascendingQ">Ascending Quant</a></li>
                    <li><a class="dropdown-item" href="http://localhost:83/DynamicWeb/admin_panel.php?order=descendingQ">Descending Quant</a></li>
                    <li><a class="dropdown-item" href="http://localhost:83/DynamicWeb/admin_panel.php?order=innerjoin">Inner Join</a></li>                
                </ul>
            </div>
        <div class="invoices">
            <h1 style="margin-left: 100px;">Invoices</h1>
            
        </div>  
        <div class="table">
            <!-- Table is rendered here -->
            <?php echo $invoicetable."
                <table style='display:none'>
                <th></th>
                </table>
            "; ?>
        </div>
    </section>

    <div class="end-text">
        <p>Copyright Stellan Inc ©2023</p>
        <p><?php echo date("Y.m.d"); ?></p>
    </div>

    <script src="script.js"></script>
    
</body>
</html>