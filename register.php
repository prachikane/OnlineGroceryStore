<?php
    require_once 'connect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['regsubmit'])){
        if(isset($_POST['firstname']) && isset($_POST['lastname']) 
        && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['rpassword']) 
        && isset($_POST['email']) && isset($_POST['dob']) && isset($_POST['address'])){
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $address = $_POST['address'];

            $sql = "SELECT * FROM users WHERE uname = '$username'";
            $result = $conn->query($sql);
            if($result->num_rows == 0){
                $sql1="INSERT INTO `customers` (`fname`, `lname`, `email`, `address`) values ( '$firstname', '$lastname', '$email', '$address')";

                $query1 = mysqli_query($conn,$sql1);
                if($query1){
                    $cust_id = $conn->insert_id;

                    $sql2 = "INSERT INTO `users` (`cust_id`, `uname`, `pass`) VALUES ('$cust_id', '$username','$password')";
                    $query2 = $conn->query($sql2);

                    if ($query2) {
                        echo "<script>alert('Records inserted successfully.')</script>";
                        header("Location: index.php");
                    } else {
                        echo "Error inserting into the users table: " . $conn->error;
                    }
                } else {
                    echo "Error inserting into the first table: " . $conn->error;
                }
            }
            else{
                echo "<script>alert('Username already exists. Please select a different username.')</script>";

            }
            $conn->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>Registration Page</title>
        <style>
            body{
                background-image: url("background.avif");
                background-size: cover;
                background-repeat: no-repeat;
            }
            .card{
                max-width: 600px;
                margin: auto;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header  bg-info text-white">
                            <h4>Register</h4>
                        </div>
                        <div class="card-body">
                            <form action="register.php" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="firstname">First Name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="rpassword">Re-enter Password</label>
                                        <input type="password" class="form-control" id="rpassword" name="rpassword" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-block" name="regsubmit">Register</button>
                                </div>
                            </form>
                        </div>
                        <div  style="text-align: center;"> 
                            Already have an account?
                            <a href="./index.php"><button class="btn btn-info">Click here to login</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </body>
</html>
