<?php

$dbConnection=mysqli_connect("localhost", "root", "", "login_registration_system");
if(!$dbConnection){
    echo "Error". mysqli_connect_error();
}


?>