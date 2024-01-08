<!DOCTYPE html>
<html>
    <head>
        <title>FreshCart</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body onload="display_items(deals, 'Rollbacks')">
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
                        <li><a href="javascript:void(0);" onclick="display_items(deals,'Rollbacks')">Shop All</a></li>
                    </ul>
                    <input type="text" id="search" name="candyName" placeholder="Enter an item name">
                    <button type="submit" value="Search" onclick="checkInventory(deals)">Search</button>
                </div>
            </div>
            <div class="maincontent">
            </div>
        </div>
        <div class="footer">
            <h3><em>Name: Prachi Shekhar Kane &nbsp;&nbsp;&nbsp;NetId: PXK220024 &nbsp;&nbsp;&nbsp;CourseNumber: CS6314.001</em></h3>
        </div>
        <script>
            let deals = [
                {img : "./deals/beer.avif",name : "Beer",price : 3.5, discount : 1, newPrice: 2.5, category : ["Rollbacks"],count : 5},
                {img : "./deals/breads.avif",name : "Breads",price : 1.5, discount : 0.5, newPrice: 1, category : ["Rollbacks"],count : 5},
                {img : "./deals/cakes.avif",name : "Cakes",price : 11.8, discount : 3.2, newPrice: 8.6, category : ["Rollbacks"],count : 5},
                {img : "./deals/chips.avif",name : "Chips",price : 4.6, discount : 0.25, newPrice: 4.35, category : ["Rollbacks"],count : 5},
                {img : "./deals/coconutwater.avif",name : "Coconut Water",price : 6, discount : 0.75, newPrice: 5.25, category : ["Rollbacks"],count : 5},
                {img : "./deals/cookies.avif",name : "Cookies",price : 4, discount : 1, newPrice: 3, category : ["Rollbacks"],count : 5},
                {img : "./deals/doughnuts.avif",name : "Doughnuts",price : 2.5, discount : 1, newPrice: 2.5, category : ["Rollbacks"],count : 5},
                {img : "./deals/rice.avif",name : "Rice",price : 13.5, discount : 3, newPrice: 10.5, category : ["Rollbacks"],count : 5},
        ]
        </script>
        <script src="functions.js"></script>
    </body>
</html>