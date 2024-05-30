<?php require "connect.php" ?>

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
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-md-6"><h5 class="text-light">Home Page</h5></div>
                                <div class="col-md-6">
                                    <a href="login.php" class="float-end ms-3">Login</a>
                                    <a href="register.php" class="float-end">Register</a>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="card-body">
                        <h5>About our website</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque optio, recusandae perspiciatis enim labore unde, explicabo nam distinctio tenetur, maxime aliquam fuga deserunt a quidem rerum architecto? Libero, sint voluptatibus?</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus illum at cumque, laudantium suscipit eveniet unde autem nostrum maiores ipsa, explicabo quos culpa tenetur soluta maxime quo error debitis velit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>