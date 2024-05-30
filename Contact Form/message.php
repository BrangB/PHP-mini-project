<?php
$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$message = $_POST["message"];
$website = $_POST["website"];

if (!empty($email) && !empty($message)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $receiver = "brangtsawmaung89@gmail.com";
        $subject = "From: $name <$email>";
        $body = "Name: $name\nEmail: $email\nPhone No: $phone\nWebsite: $website\nMessage: $message\n\nRegards, \n$name";
        $sender = "From: $email";
        if (mail($receiver, $subject, $body, $sender)) {
            echo "Your Message has been sent";
        } else {
            echo "Sorry!! Failed to send Message";
        }
    } else {
        echo "Enter valid email!!";
    }
} else {
    echo "Email or Message field is required";
}
