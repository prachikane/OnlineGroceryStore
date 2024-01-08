<?php
    require_once 'connect.php';
    $sql = "SELECT * FROM inventory where category = 'freshproducts'";

    if (isset($_POST['category'])) {
        $category = $_POST['category'];
        if ($category == 'Shop All') {
            $sql = "SELECT * FROM inventory where category = 'freshproducts'";
        } else {
            $sql = "SELECT * FROM inventory where subcategory = '$category'";
        }   
    }
    $products = $conn->query($sql);
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
                <div class="filters">
                    <h3>Filters</h3>
                    <p>Sort by Categories</p>
                    <ul class="categories">
                        <li><a href="javascript:void(0);" onclick="display('Shop All')">Shop all</a></li>
                        <li><a href="javascript:void(0);" onclick="display('Vegetables')">Vegetables</a></li>
                        <li><a href="javascript:void(0);" onclick="display('Fruits')">Fruits</a></li>
                        <li><a href="javascript:void(0);" onclick="display('Pre-Cut Fruits')">Pre-Cut Fruits</a></li>
                        <li><a href="javascript:void(0);" onclick="display('Flowers')">Flowers</a></li>
                        <li><a href="javascript:void(0);" onclick="display('Salsa and Dips')">Salsa and Dips</a></li>
                        <li><a href="javascript:void(0);" onclick="display('Season Produce')">Season Produce</a></li>
                        <li><a href="javascript:void(0);" onclick="display('New Items')">New Items</a></li>
                        <li><a href="javascript:void(0);" onclick="display('Rollbacks')">Rollbacks</a></li>
                    </ul>
                </div>
            </div>
            <div class="maincontent">
                <section class="container">
                    <?php
                        if ($products->num_rows > 0) {
                            while ($row = $products->fetch_assoc()) {
                                ?>
                                <div class="card">
                                    <img src="./freshproducts/<?php echo $row["img"] ?>"/>
                                    <h3><?php echo $row["itemname"] ?></h3>
                                    <p>$<?php echo $row["unit_price"] ?></p>
                                    <br>
                                    <div class="qtyTextBox">
                                        <button type="button" onclick="addtocart('<?php echo $row['itemname'] ?>', <?php echo $row['unit_price'] ?>, document.getElementById('item<?php echo $row['item_number']?>'))">Add to Cart</button>
                                        <input id="item<?php echo $row['item_number']?>" type="text" placeholder="Quantity"/>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "No results";
                        }
                    ?>
                </section>
            </div>
        </div>
        <div class="footer">
            <h3><em>Name: Prachi Shekhar Kane &nbsp;&nbsp;&nbsp;NetId: PXK220024 &nbsp;&nbsp;&nbsp;CourseNumber: CS6314.001</em></h3>
        </div>
        <script src="functions.js"></script>
        <script>
            function display(category) {
                $.ajax({
                    type: "POST",
                    url: "freshproducts.php",
                    data: { category: category },
                    success: function(response) {
                        $("body").html(response); // Update the content of the container div
                    }
                });
            }
            function addtocart(itemName, itemPrice, itembtn){
                console.log(itemName + " "+itemPrice+" "+itembtn.value);
                $.ajax({
                    type: "POST",
                    url: "update.php",
                    data: { itemName: itemName, itemPrice: itemPrice, quantity: itembtn.value },
                    success: function(response) {
                        $("body").html(response); // Update the content of the container div
                    }
                });
            }
        </script>
    </body>
</html>

