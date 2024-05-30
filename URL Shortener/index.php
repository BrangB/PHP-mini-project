<?php

if(isset($_GET['u'])){
    include "php/config.php";
    $u = mysqli_real_escape_string($conn, $_GET['u']);

    $sql= mysqli_query($conn, "SELECT full_url FROM url WHERE shorten_url = '{$u}'");
    if(mysqli_num_rows($sql)>0){
        $full_url = mysqli_fetch_assoc($sql);
        header("Location:".$full_url['full_url']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>URL Shortener in PHP | CodingNepal</title>
    <link rel="stylesheet" href="style.css">
    <!-- Iconsout Link for Icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
</head>
<body>
    <div class="wrapper">
        <form action="#" method="post">
            <i class="url-icon uil uil-link"></i>
            <input type="text" name="full_url" placeholder="Enter or paste a long url" required>
            <button>Shorten</button>
        </form>
        <div class="count">
            <span>Total Links: <span>10</span> & Total Clicks: <span>110</span></span>
            <a href="#">Clear All</a>
        </div>
        <div class="urls-area">
            <div class="title">
                <li>Shorten URL</li>
                <li>Original URL</li>
                <li>Clicks</li>
                <li>Action</li>
            </div>
            <div class="data">
                <li><a href="#">example.com</a></li>
                <li>https://brangtsawmaung.com</li>
                <li>16</li>
                <li><a href="#">Delete</a></li>
            </div>
            <div class="data">
                <li><a href="#">example.com</a></li>
                <li>https://brangtsawmaung.com</li>
                <li>16</li>
                <li><a href="#">Delete</a></li>
            </div>

        </div>
    </div>

    <div class="blur-effect"></div>
    <div class="popup-box">
        <div class="info-box ">Your short link is ready. You can also edit you start link now but can't edit once you save it.</div>
        <form action="#">
            <label>Edit your Shorten url</label>
            <input type="text" spellcheck="false"  value="">
            <i class="copy-icon uil uil-copy-alt"></i>
            <button>Save</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>