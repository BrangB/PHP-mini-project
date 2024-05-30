<?php
session_start();
require "connect.php";

$userArray = $_SESSION["user_array"];

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
    body {
        padding-top: 2px;
    }

    a {
        text-decoration: none;
        color: white;
    }
</style>

<body>
    <?php

    if (!(isset($_SESSION["user_array"]))) {
        header("location:login.php");
    }
    if($_SESSION["user_array"]["role"] != "user"){
        header("location:adminDashboard.php");
    }

    if (isset($_POST['logout_btn'])) {
        session_destroy();
        header('Location: login.php');
    }

    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success ">
                        <div class="card-title ">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <h5 class="text-light">User-Dashboard</h5>
                                </div>
                                <div class="col-md-6">
                                    <form class="float-end" method="POST">
                                        <button name="logout_btn" class="btn btn-outline-light btn-sm" onclick="return confirm('Are you sure you want to logout')">Log Out</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h6>User info</h6>
                                        <div>
                                            Role:  <span class="badge bg-success text-center"><?= $userArray["role"] ?></span>
                                        </div>
                                        <div>
                                            Name:  <?= $userArray["name"] ?>
                                        </div>
                                        <div>
                                            Email:  <?= $userArray["email"] ?>
                                        </div>
                                        <div>
                                            Address:  <?= $userArray["address"] ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-8">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>