<?php 
	session_start();
	$kTr=isset($_GET['search'])?$_GET['search']:'';
	if(isset($_SESSION['USER'])==false){
		header("location:login.php");
	}