<?php
    //Store data in session to generate invoice 
    session_start();
    if(isset($_GET['name']) &&  isset($_GET['card_number']) && isset($_GET['cvv']) && isset($_GET['expiry']) && isset($_GET['quantity'])){
        // Check if details are valid
        if (strlen($_GET['cvv']) != 3){
            echo "CVV is invalid";
        }else if(strlen($_GET['card_number']) != 16){
            echo "Card Number Invalid";
        }
        else
        {
            // All checks were passed, so transaction should now occur
            $servername = "localhost";
            $username = "stellan";
            $password = "lindrud";
            $db = "online_shop"; 
            if(!isset($_COOKIE['customer'])){ //There is no selected customer
                $customer = 'unidentified';
            }else{
                $customer = $_COOKIE['customer'];
            }
            $product = $_COOKIE['product'];
            $quantity = $_GET['quantity'];

            $con = new mysqli($servername,$username,$password,$db);
            echo $product;
            $date = date("Y-m-d");
            $query = "
                INSERT INTO `invoices` (`customer_name`, `invoice_id`, `product_name`, `quantity`,`date`) VALUES ('$customer', NULL, '$product', '$quantity','$date');
            ";
            
            // Get the product price    
            


            //UPDATE `customers` SET `money` = '2000' WHERE `customers`.`name` = 'Gabe';

            $_SESSION["name"] = $customer;
            $_SESSION["product"] = $product;
            $_SESSION["quanity"] = $quantity;
            $_SESSION["date"] = $date;

            mysqli_query($con,$query);
            
            //Get price
            $price = mysqli_query($con, "SELECT price FROM products WHERE name='$product'");
            foreach($stock as $x){
               $price = $x['price'];
            }

            $stock = mysqli_query($con,"SELECT stock from products WHERE name='$product'");
            foreach($stock as $x){
                foreach($x as $y){
                    $newStock = $y - $quantity;
                }
            }
            $query = "UPDATE products SET stock='$newStock' WHERE name='$product'";
            mysqli_query($con,$query);
            
            //Redirect to Succesful Payment
            header('Location: successfull.php');
        }
    }   
    else
    {
        echo "Variable is not set";
    }
?>