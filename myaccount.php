<?php
    require_once 'connect.php';
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
    $user=$_SESSION['user'];
    $sql = "SELECT * FROM customers WHERE cust_id = '$user'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    }
    if(isset($_POST['view'])){

        $sql = "SELECT * from transactions t join carts c on c.transaction_id = t.transaction_id where c.cust_id = '$user'";
        $view = $conn->query($sql);
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
        </div>
        <div class="content">
            <div class="side">
                <div class="profile">
                    <img style="width: 100px;" src="profile.jpeg" alt="profile pic"/>
                </div>
                <table class="profile">
                    <tr>
                        <td>Name </td>
                        <td><?php echo $row['fname']. " " .$row['lname'] ?></td>
                    </tr>
                    <tr>
                        <td>Email </td>
                        <td><?php echo $row['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Phone No </td>
                        <td><?php echo $row['phone'] ?></td>
                    </tr>
                    <tr>
                        <td>Address </td>
                        <td><?php echo $row['address'] ?></td>
                    </tr>
                    <tr>
                        <td>Age </td>
                        <td><?php echo $row['age'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="maincontent">
            <div>
            <button onclick="logout()" style="height: 50px; width:200px;">Logout</button>
                <button onclick="viewtransactions('view')" style="height: 50px; width:200px; float:right;">View transactions</button>
            </div>
            <table class="profile">
                <?php
                    if ($view->num_rows > 0) {
                        ?>
                        <tr>
                        <th>Transaction Number</th>
                        <th>Item Number</th>
                        <th>Status</th>
                    </tr>
                    <?php
                        while ($row = $view->fetch_assoc()) {
                        ?>
                        <tr>
                            <td> <?php echo $row["transaction_id"]?></td>
                            <td> <?php echo $row["item_number"] ?> </td>
                            <td> <?php echo $row["transaction_status"] ?> </td>
                        </tr>
                        <?php
                    }
                }
                else{
                    echo "<h1>Hello</h1>";
                }
                ?>
                </table>
            </div>
        </div>

        <div class="footer">
            <h3><em>Name: Prachi Shekhar Kane &nbsp;&nbsp;&nbsp;NetId: PXK220024 &nbsp;&nbsp;&nbsp;CourseNumber: CS6314.001</em></h3>
        </div>
        <script>
            var user_id = sessionStorage.getItem("user");
            console.log("User ID:", user_id);
            function logout(){
                sessionStorage.clear();
                window.location.href = "index.php";
            }
            function viewtransactions(view){
                console.log("inside view transactions");
                $.ajax({
                    type: "POST",
                    url: "myaccount.php",
                    data: {view: view},
                    success: function(response) {
                        console.log("done");
                        $("body").html(response);
                    }
                });
            }
        </script>
        <script src="functions.js"></script>
    </body>
</html>