<?php
    require_once 'connect.php';
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

    if (isset($_POST['xmlupload'])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir.basename($_FILES["xmlFile"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        if ($fileType != "xml") {
            echo "Sorry, only XML files are allowed.";
            $uploadOk = 0;
        }
    
        if (file_exists($targetFile)) {
            echo "Sorry, the file already exists.";
            $uploadOk = 0;
        }
    
        if ($uploadOk) {
            if (move_uploaded_file($_FILES["xmlFile"]["tmp_name"], $targetFile)) {
                $file=htmlspecialchars(basename($_FILES["xmlFile"]["name"]));
                echo "The file ". $file . " has been uploaded.";
    
                $xml = simplexml_load_file($targetFile) or die("Error: Cannot create object");
    
                foreach ($xml->product as $item) {
                    $name = $conn->real_escape_string((string)$item->name);
                    $category = trim($file,".xml");
                    $subcategory = $conn->real_escape_string((string)$item->category);
                    $unit_price = (float)$item->price;
                    $quantity = (int)$item->count;
                    $img = $conn->real_escape_string((string)$item->img);

                    $sql = "INSERT INTO inventory (`itemname`, `category`, `subcategory`, `unit_price`, `quantity`, `img`)
                            VALUES ('$name', '$category', '$subcategory', '$unit_price', '$quantity', '$img')";
                    
                    if ($conn->query($sql) !== TRUE) {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                unlink($targetFile);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    if (isset($_POST['viewinventory'])) {
        $sql = "SELECT * FROM inventory";
        $products = $conn->query($sql);
    }

    if (isset($_POST['lowinventory'])) {
        $sql = "SELECT * FROM inventory WHERE quantity < 3";
        $products = $conn->query($sql);
    }
    if (isset($_POST['customers'])) {
        $sql = "SELECT c.fname, c.lname, count(t.transaction_id) as numoft FROM 
        customers c join carts ct on ct.cust_id = c.cust_id 
        join transactions t on ct.transaction_id = t.transaction_id 
        group by c.cust_id having numoft >3";
        $customers = $conn->query($sql);
    }
    if (isset($_POST['allcustomers'])) {
        $sql = "SELECT c.fname, c.lname, count(t.transaction_id) as numoft FROM 
        customers c join carts ct on ct.cust_id = c.cust_id 
        join transactions t on ct.transaction_id = t.transaction_id 
        group by c.cust_id";
        $customers = $conn->query($sql);
    }

    $conn->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>FreshCart</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            button{
                float:left;
                width:100px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <a><img src="grocery.jpeg" alt="grocery bag"/><span id="date"></span></a>
            <h1 style="text-align: center; font-size: 48px;">FreshCart</h1>
            <ul>
                <li><a href="admin.php">My-account</a></li>
            </ul>
            <button onclick="logout()" style="height: 50px; width:200px;">Logout</button>

        </div>
        <div class="content">
            <div class="side" style="width: 30%">
                <ul>
                    <li>
                        <div>
                        <form action="admin.php" method="post" enctype="multipart/form-data">
                            <legend>Upload XML</legend>
                            <input type="file" name="xmlFile" accept=".xml" required>
                            <button type="submit" name="xmlupload">Upload</button>
                        </form>
                        </div>  
                    </li>
                    <li>
                        <div>
                        <form action="admin.php" method="post" enctype="multipart/form-data">
                            <legend>Click to view inventory</legend>
                            <button type="submit" name="viewinventory">View</button>
                        </form>
                        </div>
                    </li>
                    <li>
                        <div>
                        <form action="admin.php" method="post" enctype="multipart/form-data">
                            <legend>Click to view low inventory items</legend>
                            <button type="submit" name="lowinventory">View</button>
                        </form>
                        </div>
                    </li>
                    <li>
                        <div>
                        <form action="admin.php" method="post" enctype="multipart/form-data">
                        <legend>Click to view customers with more than 3 transactions</legend>
                            <button type="submit" name="customers">View</button>
                        </form>
                        </div>
                    </li>
                    <li>
                        <div>
                        <form action="admin.php" method="post" enctype="multipart/form-data">
                            <legend>Click to view all customers</legend>
                            <button type="submit" name="allcustomers">View</button>
                        </form>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="maincontent" style="width: 70%; height:500px; overflow:auto;">
                <table class="profile">
                <?php
                    if ($products->num_rows > 0) {
                        ?>
                        <tr>
                        <th>Item Number</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                    </tr>
                    <?php
                        while ($row = $products->fetch_assoc()) {
                        ?>
                        <tr>
                            <td> <?php echo $row["item_number"]?></td>
                            <td> <?php echo $row["itemname"] ?> </td>
                            <td> <?php echo $row["category"] ?> </td>
                            <td> <?php echo $row["subcategory"] ?> </td>
                            <td> <?php echo $row["unit_price"] ?> </td>
                            <td> <?php echo $row["quantity"] ?> </td>
                        </tr>
                        <?php
                    }
                }
                else if ($customers->num_rows > 0) {
                        ?>
                        <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Num of Transactions</th>
                    </tr>
                    <?php
                        while ($row = $customers->fetch_assoc()) {
                        ?>
                        <tr>
                            <td> <?php echo $row["fname"]?></td>
                            <td> <?php echo $row["lname"] ?> </td>
                            <td> <?php echo $row["numoft"] ?> </td>
                        </tr>
                        <?php
                    }
                }
                else{
                    echo "<h1>Hello Admin</h1>";
                }
                ?>
                </table>
            </div>
        </div>
        <div class="footer">
            <h3><em>Name: Prachi Shekhar Kane &nbsp;&nbsp;&nbsp;NetId: PXK220024 &nbsp;&nbsp;&nbsp;CourseNumber: CS6314.001</em></h3>
        </div>
        <script>
                sessionStorage.setItem("user", "<?php echo $_SESSION['user'] ?>");
                function logout(){
                    sessionStorage.clear();
                    window.location.href = "index.php";
                }
        </script>
        <script src="functions.js"></script>
    </body>
</html>