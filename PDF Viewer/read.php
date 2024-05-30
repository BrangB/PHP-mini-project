<?php

    $file = "Alex_Banks_and_Eve_Porcello-Learning_React-EN.pdf";

    header("Content-type:application/pdf");
    header('Content-Description:inline;filename="'.$file.'"');
    header('Content-Transfer-Encoding:binary');
    header('Accept-Ranges:bytes');
    @readfile($file);
