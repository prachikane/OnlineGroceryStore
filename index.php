<?php
    require_once 'connect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['username']) && isset($_POST['password'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM users WHERE uname = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $pass = $row["pass"];
                if ($password == $pass) {
                    $_SESSION['user'] = $row["cust_id"];
                    if($row['uname'] == "admin"){
                        header("Location: admin.php");
                    }
                    else{
                        header("Location: about.php");
                    }
                } else {
                    $error_message = "Incorrect password. Please try again.";
                    echo '<script>alert("' . $error_message . '");</script>';
                }
            } else {
                $error_message = "User not found. Please check your username.";
                echo '<script>alert("' . $error_message . '");</script>';
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
        <title>Login Page</title>
        <style>
            body{
                background-image: url("background.avif");
                background-size: cover;
                background-repeat: no-repeat;
            }
            .card{
                max-width: 500px;
                margin: auto;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <form id="loginForm" action="index.php" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        <button type="submit" class="btn btn-info btn-block" name="logsubmit" onclick="setuser()">Login</button>
                    </form>
                </div>
                <div style="text-align: center;"> 
                    Dont have an account yet?
                    <a href="./register.php"><button class="btn btn-info">Click here to register</button></a>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
