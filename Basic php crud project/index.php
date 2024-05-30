<?php
require 'connect.php';
session_start();
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
        padding:50px;
    }
</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Post List</h3>
                            </div>
                            <div class="col-md-6">
                                <a href="post-create.php" class="float-end btn btn-primary">+ Add new</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <?php if(isset($_SESSION["successMsg"])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION["successMsg"]; ?>
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    <?php unset($_SESSION["successMsg"]); endif; ?>

                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM posts";
                                $results = mysqli_query($db, $query);
                                foreach($results as $result){
                                    ?>
                            <tr>
                                <td><?= $result['id'] ?></td>
                                <td><?= $result['title'] ?></td>
                                <td><?= $result['description'] ?></td>
                                <td>
                                    <a href="post-edit.php?postId=<?= $result['id'] ?>">Edit</a> |
                                    <a href="index.php?deleteId=<?= $result['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
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

    <?php

        if(isset($_GET['deleteId'])){
            $deleteId = $_GET['deleteId'];
            mysqli_query($db, "DELETE FROM posts WHERE id=$deleteId");
            $_SESSION['successMsg'] = "A post is deleted successfully";
            header("location:index.php");
        }

    ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>