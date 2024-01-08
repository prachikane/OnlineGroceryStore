<?php
    require_once 'connect.php';
    $cust_id = $_SESSION['user'];
    $sql = "SELECT *  FROM 
    inventory i join carts c on i.item_number = c.item_number 
    join transactions t on c.transaction_id = t.transaction_id 
    where c.cust_id = '$cust_id' and transaction_status like 'incart' and cart_status = 'inprogress'";

    $products = $conn->query($sql);
    $total = 0;

    if(isset($_POST['message'])){
        $sql = "SELECT i.item_number, sum(c.quantity) as totalquantity ,t.transaction_id,i.quantity FROM 
        inventory i join carts c on i.item_number = c.item_number 
        join transactions t on c.transaction_id = t.transaction_id 
        where c.cust_id = '$cust_id' and transaction_status like 'incart' 
        group by t.transaction_id, i.quantity, i.item_number";
        $result = $conn->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $newquantity = $row['totalquantity'] + $row['quantity'];
                $itemnumber = $row['item_number'];
                $transaction_id= $row['transaction_id'];
                $sql1 = "UPDATE inventory set quantity = '$newquantity' where item_number = '$itemnumber'"; 
                $sql2 = "UPDATE transactions set transaction_status = 'cancelled' where transaction_id = '$transaction_id'"; 
                $sql3 = "UPDATE carts set cart_status = 'cancelled' where transaction_id = '$transaction_id' and cust_id = '$cust_id'";
                $conn->query($sql1);
                $conn->query($sql2);
                $conn->query($sql3);
                $result = $conn->query($sql);
            }
        }
        header("Location: cart.php");
    }
    if(isset($_POST['checkout'])){
        $sql = "SELECT i.item_number, sum(c.quantity) as totalquantity ,t.transaction_id,i.quantity FROM 
        inventory i join carts c on i.item_number = c.item_number 
        join transactions t on c.transaction_id = t.transaction_id 
        where c.cust_id = '$cust_id' and transaction_status like 'incart' 
        group by t.transaction_id, i.quantity, i.item_number";
        $result = $conn->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $transaction_id= $row['transaction_id'];
                $sql2 = "UPDATE transactions set transaction_status = 'complete' where transaction_id = '$transaction_id'"; 
                $sql3 = "UPDATE carts set cart_status = 'checkedout' where transaction_id = '$transaction_id' and cust_id = '$cust_id'";
                $conn->query($sql2);
                $conn->query($sql3);
            } 
        }
        header("Location: cart.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>FreshCart</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        </head>
    <body>
        <div class="header">
            <a href="about.php"><img src="grocery.jpeg" alt="grocery bag"/><span id="date"></span></a>
            <h1 style="text-align: center; font-size: 48px; padding:  10px 5px;">FreshCart</h1>
            <ul>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="myaccount.php">My-account</a></li>
                <li><a href="about.php">About-us</a></li>
                <li><a href="contact.php">Contact-us</a></li>
            </ul>
        </div>
        <div class="navbar">
            <ul>
                <li><a href="freshproducts.php">Fresh products</a></li>
                <li><a href="frozenproducts.php">Frozen</a></li>
                <li><a href="pantry.php">Pantry</a></li>
                <li><a href="breakfastandcereal.php">Breakfast and Cereal</a></li>
                <li><a href="baking.php">Baking</a></li>
                <li><a href="snacks.php">Snacks</a></li>
                <li><a href="candy.php">Candy</a></li>
                <li><a href="specialtyshops.php">Specialty shops</a></li>
                <li><a href="deals.php">Deals</a></li>
            </ul>
            <div>
                <button onclick="clearcart('clearcart')" style="height: 50px; width:200px; float:right;">Clear Cart</button>
                <button onclick="checkout('checkout')" style="height: 50px; width:200px; float:right;">Checkout</button>
            </div>
        </div>
        <div class="content">
            <div class="maincontent">
                <section class="container">
                    <?php
                        if ($products->num_rows > 0) {
                            while ($row = $products->fetch_assoc()) {
                                $total+=$row['total_price'];
                                ?>
                                <div class="card">
                                    <img src="./<?php echo $row['category']?>/<?php echo $row["img"]?>"/>
                                    <h3><?php echo $row["itemname"] ?></h3>
                                    <p>$<?php echo $row["total_price"] ?></p>
                                    <br>
                                </div>
                                <?php
                            }
                        } else {
                            echo "Cart is empty";
                        }
                    ?>
                </section>
                    <h1>Total amount : $<?php echo $total?></h1>
            </div>
        </div>
        <div class="footer">
            <h3><em>Name: Prachi Shekhar Kane &nbsp;&nbsp;&nbsp;NetId: PXK220024 &nbsp;&nbsp;&nbsp;CourseNumber: CS6314.001</em></h3>
        </div>
        <script src="functions.js"></script>
        <script>
            function clearcart(message){
                console.log("inside clear cart");
                $.ajax({
                    type: "POST",
                    url: "cart.php",
                    data: {message: message},
                    success: function(response) {
                        console.log("done");
                        $("body").html(response);
                    }
                });
            }
            function checkout(message){
                console.log("inside checkout cart");
                $.ajax({
                    type: "POST",
                    url: "cart.php",
                    data: {checkout: message},
                    success: function(response) {
                        console.log("done");
                        $("body").html(response);
                    }
                });
            }
        </script>
    </body>
</html>

