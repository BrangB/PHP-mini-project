<?php  session_start(); ?>
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
<?php
require "connect.php";
$title_err = '';
$desc_err = '';
$title = '';
$desc = '';

// if(isset($_POST["create"])){
//     $title = $_POST["title"];
//     $desc = $_POST["description"];

//     if($title === ''){
//         $title_err = "Please fill the title";
//     }
//     if($desc === ''){
//         $desc_err = "Please fill the title";
//     }
//     if($title !== '' && $desc !== ''){
//         // $query = "insert into posts(title, description) values('$title', '$desc')";
//         // mysqli_query($db, $query);
//         // $_SESSION["successMsg"] = "A post is created successfully";
//         // header('location: index.php');
//         echo $title;
//         echo $desc;
//     }
// }
?>
<body>
    <?php
    $postId = '';
    if(isset($_GET["postId"])){
        $postId = $_GET["postId"];

        $posts=mysqli_query($db, "SELECT * FROM posts WHERE id=$postId");
        if(mysqli_num_rows($posts)==1){
            foreach($posts as $post){
                $title = $post['title'];
                $desc = $post['description'];
            }
        }

    }

    if(isset($_POST['update_post_btn'])){
       $title = $_POST['title'];
       $desc = $_POST['description'];
       $id = $_POST['id'];

       $query = "UPDATE posts SET title='$title', description='$desc' WHERE id='$id'";
       mysqli_query($db, $query);
        $_SESSION["successMsg"] = "A post is updated successfully";
        header('location: index.php');
    }

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Post Edit Form</h3>
                            </div>
                            <div class="col-md-6">
                                <a href="index.php" class="float-end btn btn-secondary"><< Back</a>
                            </div>
                        </div>
                    </div>
                    <form action="post-edit.php" method="POST">
                        <div class="card-body">
                            <div class="form-group mb-4">
                                <input type="hidden" name="id" class="form-control <?php if($title_err !== '') : ?> is-invalid <?php endif ?>" value=<?php echo $postId ?>>
                                <label>Title</label>
                                <input type="text" name="title" class="form-control <?php if($title_err !== '') : ?> is-invalid <?php endif ?>" placeholder="Enter the title" value=<?php echo $title ?>>
                                <span class="text-danger"><?php echo $title_err ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description"  class="form-control <?php if($desc_err !== '') : ?> is-invalid <?php endif ?>" placeholder="Enter post description" value=<?php echo $desc ?>><?php echo $desc ?></textarea>
                                <span class="text-danger"><?php echo $desc_err ?></span>
                            </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" name="update_post_btn" class="btn btn-md btn-primary" >Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>