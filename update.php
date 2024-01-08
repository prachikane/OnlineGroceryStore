<?php
require_once 'connect.php';

$_SESSION['transaction_id'] = 0;
if(isset($_POST['itemName']) && isset($_POST['itemPrice']) && isset($_POST['quantity'])){
    $itemname = $_POST['itemName'];
    $itemprice = $_POST['itemPrice'];
    $quantity = $_POST['quantity'];
    $cust_id = $_SESSION['user'];
    $transaction_id = $_SESSION['transaction_id'];
    $currentDateTime = date("Y-m-d H:i:s");
    $total_price = $quantity*$itemprice;

    $query = "SELECT * FROM inventory WHERE itemname = '$itemname'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Query failed";
    }
    else{
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
            echo 'Item not found';
        }

        $currentQuantity = $row['quantity'];
        $itemNumber = $row['item_number'];

        if($currentQuantity < $quantity){
            echo "<script>alert('Item not available. Update inventory.')</script>";                
            header("Location: freshproducts.php");
        }
        else{
            $newQuantity = $currentQuantity - $quantity;
            $sql1 = "UPDATE inventory SET quantity = $newQuantity WHERE itemname = '$itemname'";

            if ($conn->query($sql1) !== TRUE) {
                echo 'Update query failed:';
            }
            else{
                $sql1 = "SELECT * from transactions where transaction_id = $transaction_id ";
                $result=$conn->query($sql1);
                if($result->num_rows == 0){
                    $sql = "INSERT into transactions (transaction_status, transaction_date, total_price) values ('incart', '$currentDateTime', $total_price)";
                    $query = $conn->query($sql);
                    $transaction_id = $conn->insert_id;
                    $_SESSION['transaction_id'] = $transaction_id;
                    echo $transaction_id;
                    echo '<script>sessionStorage.setItem("transaction_id", " '. $transaction_id .' ");</script>';
                }
                else{
                    $row = $result->fetch_assoc();
                    $total = $row['total_price'];
                    $total_price = $total_price + $total;
                    echo $total_price;
                    $sql = "UPDATE transactions SET total_price = $total_price WHERE transaction_id = $transaction_id)";
                    $query = $conn->query($sql);
                }
                
                if ($query) {
                    $transaction = $_SESSION['transaction_id'];
                    $sql = "INSERT into carts (cust_id, transaction_id, item_number, quantity, cart_status) values ($cust_id, $transaction, $itemNumber, $quantity, 'inprogress')";
                    $query1 = $conn->query($sql);
                    if($query1){
                        echo "Records inserted into Cart and Transactions table.";
                        header("Location: freshproducts.php");
                    }
                    else{
                        echo "Error inserting into the cart table: " . $conn->error;
                    }
                } else {
                    echo "Error inserting into the transactions table: " . $conn->error;
                }
            }
        }
        
    }
}
?>