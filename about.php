<?php
    require_once 'connect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>FreshCart</title>
        <link rel="stylesheet" type="text/css" href="style.css">
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
                <li><a href="frozen.php">Frozen</a></li>
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
            <div class="maincontent">
                <dl>
                    <strong>Welcome to FreshCart.</strong>
                </dl> 
                <dd>
                    Your one-stop destination for all your grocery needs delivered right to your doorstep! 
                    We understand that life can be busy, and that's why we're here to make your shopping experience convenient and hassle-free. 
                    Explore our wide selection of fresh produce, pantry staples, gourmet delights, and household essestials all at your fingertips. 
                    Whether you're a busy professional, a parent on the go, or simply looking to simplify your grocery shopping, FreshCart has you covered. 
                    With our user-friendly website and fast, reliable delivery service, you can enjoy more time doing what you love. 
                    Join our community of satisfied customers today and discover a new way to shop for groceries. FreshCart: Freshness Delivered to You!
                </dd>
                
                <strong><p style="margin: 20px 0px 0px 0px; padding: 0px 0px;">Our Services:</p></strong>
                <ol>
                    <li>Door to door delivery</li>
                    <li>Cheapest prices</li>
                    <li>Fresh Produce</li>
                </ol>
            </div>
        </div>
        <div class="footer">
            <h3><em>Name: Prachi Shekhar Kane &nbsp;&nbsp;&nbsp;NetId: PXK220024 &nbsp;&nbsp;&nbsp;CourseNumber: CS6314.001</em></h3>
        </div>
        <script>
                sessionStorage.setItem("user", "<?php echo $_SESSION['user'] ?>");
        </script>
        <script src="functions.js"></script>
    </body>
</html>