<!DOCTYPE html>
<html>
    <head>
        <title>FreshCart</title>
        <link rel="stylesheet" type="text/css" href="style.css">        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body onload="display_items(candies, 'Shop All','candies')">
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
                <div class="filters">
                    <h3>Filters</h3>
                    <p>Sort by Categories</p>
                    <ul class="categories">
                        <li><a href="javascript:void(0);" onclick="display_items(candies,'Shop All')">Shop All</a></li>
                    </ul>
                    <input type="text" id="search" name="candyName" placeholder="Enter a candy name">
                    <button type="submit" value="Search" onclick="checkInventory(candies)">Search</button>
                </div>
            </div>
            <div class="maincontent">
            </div>
        </div>
        <div class="footer">
            <h3><em>Name: Prachi Shekhar Kane &nbsp;&nbsp;&nbsp;NetId: PXK220024 &nbsp;&nbsp;&nbsp;CourseNumber: CS6314.001</em></h3>
        </div>
        <script src="functions.js"></script>
        <script>
            var candies;
            $(document).ready(function(){
                $.ajax({
                    type: "GET",
                    url: "/candies.xml",
                    dataType: "xml",
                    success: function(xml) {
                        console.log(xml);
                        candies = xml;
                    },
                    error: function() {
                        alert("Cannot load XML file");
                    }
                });

            });
        </script>
    </body>
</html>