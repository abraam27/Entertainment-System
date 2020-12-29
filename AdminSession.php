<?php
    require_once 'config.php';
    if(is_numeric($_SESSION["Admin"]))
    {
        
    }else {
        header("location: ../../login.php");
        exit();
    }
