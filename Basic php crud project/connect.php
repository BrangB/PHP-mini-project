<?php

$db=mysqli_connect("localhost", "root", "", "basic_php_crud");
if($db){
    //
}else{
    die("Error ". mysqli_connect_error());
}