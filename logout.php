<?php
	session_start();
	if(isset($_SESSION['Admin']))
	{
		unset($_SESSION['Admin']);
                unset($_SESSION['User']);
                header("location: Login.php");
                exit();
	}else {
		header("location: Login.php");
                exit();
	}
        if(isset($_SESSION['User']))
	{
		unset($_SESSION['User']);
                header("location: Login.php");
                exit();
	}else {
		header("location: Login.php");
                exit();
	}
?>