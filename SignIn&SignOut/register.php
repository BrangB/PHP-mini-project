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
    require 'connect.php';
    $name = "";
    $email =  '';
    $address = '';
    $password = '';
    $confirm_password = '';
    $name_err = "";
    $email_err = "";
    $address_err = "";
    $password_err = "";
    $confirm_err = "";
    $common = " is required";
    $check = false;
    if(isset($_POST['register_button'])){
        $name = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $check = true;

        if(empty($name)){
            $name_err = "username". $common;
        }
        if(empty($email)){
            $email_err = "Email". $common;
        }
        if(empty($address)){
            $address_err = "Address". $common;
        }
        if(empty($password)){
            $password_err = "Password". $common;
        }
        if(empty($confirm_password)){
            $confirm_err = "Confirm Password". $common;
        }
        if(!($password == $confirm_password)){
            $confirm_err = "Password doesn't match";
        }

        if(!empty($name) && !empty($email) && !empty($address) && !empty($password) && !empty($confirm_password)){
            $encrptPassword = md5($password);
            $query = "INSERT INTO users(name, email, address, password) VALUES('$name', '$email', '$address', '$encrptPassword')";
            $result = mysqli_query($dbConnection, $query);
            if($result){
                echo "<script>alert('Registration Successful');</script>";
                header("location:login.php");
            }
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
                                <div class="col-md-6"><h5>Registeration Form</h5></div>
                                <div class="col-md-6">
                                    <a href="index.php" class="float-end ms-3 btn btn-success"> << Back </a>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <form method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                <div class="card">
                                <div class="card-header bg-info">
                                    <h5 class="card-title text-light">Register</h5>
                                </div>
                                <div class="card-body py-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="mb-2">Name</label>
                                            <input type="text" name="username" value="<?= $name ?>" class="form-control <?= empty($name) && $check ? 'is-invalid' : '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
                                            <p class="text-danger small"><?= $name_err ?></p>
                                        </div>
                                        <div class="form-group my-3">
                                            <label for="email" class="mb-2">Email</label>
                                            <input type="email" name="email" value="<?= $email ?>" class="form-control <?= empty($email) && $check ? 'is-invalid' : '' ?>" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                                            <p class="text-danger small"><?= $email_err ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="mb-2">Address</label>
                                            <input type="text" name="address" value="<?= $address ?>" class="form-control <?= empty($address) && $check ? 'is-invalid' : '' ?>" aria-describedby="emailHelp" placeholder="Your Address">
                                            <p class="text-danger small"><?= $address_err ?></p>
                                        </div>
                                        <div class="form-group my-3">
                                            <label for="password" class="mb-2">Password</label>
                                            <input type="text" name="password" value="<?= $password ?>" class="form-control <?= empty($password) && $check ? 'is-invalid' : '' ?>" aria-describedby="emailHelp" placeholder="Your Password">
                                            <p class="text-danger small"><?= $password_err ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="dd" class="mb-2">Confirm Password</label>
                                            <input type="text" name="confirm_password" value="<?= $confirm_password ?>" class="form-control <?= empty($confirm_password) && $check ? 'is-invalid' : '' ?>" id="dd" aria-describedby="emailHelp" placeholder="Confirm Password">
                                            <p class="text-danger small"><?= $confirm_err ?></p>
                                        </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" name="register_button" class="btn btn-success">Sign Up</button>
                                </div>
                            </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>