<?php

session_start();
require 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    body{
        padding-top: 2px;
    }
    a{
        text-decoration: none;
        color: white;
    }
</style>
<?php

$email="";
$password="";
$error_msg="";

if(isset($_POST['loginButton'])){
    $email = trim($_POST['email']);
    $password = trim( $_POST['password']);
    $encryptPs = md5($password);

    $result = mysqli_query($dbConnection, "SELECT * FROM users WHERE email='$email' AND password='$encryptPs'");
    $result_count = mysqli_num_rows($result);
    if($result_count == 1){
        $user = mysqli_fetch_assoc($result);
        $_SESSION["user_array"] = $user;
        if($user['role'] == "user"){
            header("location:userDashboard.php");
        }else{
            header("location:adminDashboard.php");
        }
    }else{
        $error_msg = "Invalid Email or Password";
    }
}

?>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-md-6"><h5>Log In Form</h5></div>
                                <div class="col-md-6">
                                    <a href="index.php" class="float-end ms-3 btn btn-success"> << Back </a>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                            <div class="card">
                            <div class="card-header bg-info">
                                <h5 class="card-title text-light">Log In</h5>
                            </div>
                            <form action="login.php" method="POST">
                                <div class="card-body py-4">
                                    <?php
                                    if($error_msg == ""){
                                        //
                                    }else{
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= $error_msg ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                        <div class="form-group ">
                                            <label for="email" class="mb-2">Email</label>
                                            <input type="email" name="email" value="<?= $email ?>" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                                        </div>
                                        <div class="form-group my-3">
                                            <label for="password" class="mb-2">Password</label>
                                            <input type="text" name="password" value="<?= $password ?>" class="form-control" id="password" aria-describedby="emailHelp" placeholder="Your Password">
                                        </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" name="loginButton" class="btn btn-success me-3">Log In</button>
                                    <span>If you have no account, <a href="register.php" class="text-primary">register here</a>.</span>
                                </div>
                            </form>
                        </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   
</body>
</html>