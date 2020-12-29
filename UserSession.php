<?php
    require_once 'config.php';
    if(is_numeric($_SESSION["User"]))
    {
        
    }else {
        header("location: ../../login.php");
        exit();
    }
