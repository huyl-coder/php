<?php 
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	$id=$_GET['ma'];
	$r=Xoa('theloai',array($id));
	header("location:dstl.php");