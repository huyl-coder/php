<?php 
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	$id=$_GET['ma'];
	$r=Xoa('nhaxuatban',array($id));
	header("location:dsnxb.php");