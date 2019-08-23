<?php
	session_start();
	session_destroy();
	if(isset($_SESSION['USER'])){
		header("location:home.php");
	}else{
		header("location:login.php");
	}