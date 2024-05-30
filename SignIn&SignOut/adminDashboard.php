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
    $showEditForm = false;

    if (!(isset($_SESSION["user_array"]))) {
        header("location:login.php");
    }
    if($_SESSION["user_array"]["role"] != "admin"){
        header("location:userDashboard.php");
    }

    if (isset($_POST['logout_btn'])) {
        session_destroy();
        header('Location: login.php');
    }

    if(isset($_GET["user_Id"])){
        $showEditForm=true;
        $userId = $_GET["user_Id"];
        $query = "SELECT * FROM users WHERE id=$userId";
        $result = mysqli_query($dbConnection, $query);
        if($result){
            $user = mysqli_fetch_assoc($result);
            
        }else{
            die("Error". mysqli_error($dbConnection));
        }
    }

    if(isset($_POST["update_btn"])){
        
        $role = $_POST["role"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $user_id = $_POST["user_id"];

        $response = mysqli_query($dbConnection, "SELECT * FROM users WHERE id=$user_id");
        $data = mysqli_fetch_assoc($response);
        $passwordCheck = $data["password"];
        $password = $_POST["password"] == $passwordCheck ? $_POST["password"] : md5($_POST["password"]);


        if($passwordCheck == $password){
            $query = "UPDATE users SET `name`='$name',`email`='$email',`address`='$address',`role`='$role' WHERE id=$user_id";
            $result = mysqli_query($dbConnection, $query);
            if($result){
                // $_SESSION["alert-msg"] = "<script>swal('Good job!', 'You clicked the button!', 'success', {
                //     button: 'Aww yiss!',
                //   });</script>";
                //   echo $_SESSION["alert-msg"];
                  echo "<script>swal('Good job!', 'You clicked the button!', 'success', {
                    button: 'Aww yiss!',
                  });</script>";
                  echo "<script>alert('Success') </script>";
            }
        }else{
            $query = "UPDATE users SET `name`='$name',`email`='$email',`address`='$address',`password`='$password',`role`='$role' WHERE id=$user_id";
            $result = mysqli_query($dbConnection, $query);
            if($result){
                // $_SESSION["alert-msg"] = "<script>swal('Good job!', 'You clicked the button!', 'success', {
                //     button: 'Aww yiss!',
                //   });</script>";
                //   echo $_SESSION["alert-msg"];
                echo "<script>swal('Good job!', 'You clicked the button!', 'success', {
                    button: 'Aww yiss!',
                  });</script>";
                  echo "<script>alert('Success') </script>";
            }
        }


    }

    if(isset($_GET["delete_Id"])){
        $delete_id = $_GET['delete_Id'];
        $query = "DELETE FROM users WHERE id=$delete_id";
        $result = mysqli_query($dbConnection, $query);
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
                                    <h5 class="text-light">Admin-Dashboard</h5>
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
                                        <h6>Admin info</h6>
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
                                <?php if($showEditForm == true) : ?>
                                    <div class="card mt-3">
                                        <div class="card-header">User Edition Form</div>
                                        <form action=<?php echo $_SERVER['PHP_SELF'] ?> method="POST">
                                            <div class="card-body">
                                                <input type="hidden" name="user_id" value=<?= $user["id"] ?>>
                                                <div class="mb-3">
                                                    <label class="mb-1">Name</label>
                                                    <input type="text" name="name" value=<?= $user["name"] ?> class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-1">Email</label>
                                                    <input type="email" name="email" value=<?= $user["email"] ?> class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="mb-1">Address</label>
                                                    <input type="text" name="address" value=<?= $user["address"] ?> class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="mb-1">Password</label>
                                                    <input type="text" name="password" value=<?= $user["password"] ?> class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="mb-1">Role</label>
                                                    <select class="form-control" name="role">
                                                        <option value="" >Select Role</option>
                                                        <option value="user" <?php if($user["role"] == "user") :?> selected <?php endif ?>>User</option>
                                                        <option value="admin" <?php if($user["role"] == "admin") :?> selected <?php endif ?>>Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button class="btn btn-primary" name="update_btn">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                <?php endif ?>

                            </div>
                            <div class="col-md-8">
                                <h5>User Lists</h5>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $result = mysqli_query($dbConnection, "SELECT * FROM users");
                                            foreach($result as $user){
                                        ?>
                                        <tr>
                                            <td><?= $user['id'] ?></td>
                                            <td><?= $user['name'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td><?= $user['address'] ?></td>
                                            <td><?= $user['role'] ?></td>
                                            <td>
                                                <a href="adminDashboard.php?user_Id=<?= $user["id"] ?>" class="btn btn-primary btn-sm">Edit</a> |
                                                <a href="adminDashboard.php?delete_Id=<?= $user["id"] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user!!!')" >Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>