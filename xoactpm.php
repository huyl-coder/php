<?php 
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	$r1=query('select * from chitietphieumuon where ma=?',array($_GET['ma']));
	$r=Xoa('chitietphieumuon',array($_GET['ma']));
	header("location:ctpm.php?ma=".$r1['maphieumuon']);