<?php
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	if(isset($_POST["tao"])){
		$r=Edit('mavach','noidung=?',array($_POST['noiDung'],$_POST['ma']));
		header("location:dsmv.php");
		exit;
	}
?>
<html lang='vi'>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
	<div style="float:left">
		<?php
			include('menu.php');
		?>
	</div>
	<form name=frm method=post action="suamv.php">
		<input type=hidden value="<?=$_GET['ma']?>" name="ma">
		<?php $r=query('select * from mavach where ma=?',array($_GET['ma']));?>
		<div style="padding-left:250px">
			<table>
				<tr>
					<td><?='Xin Chào.'.$_SESSION["USER"]["email"]?></td>
				</tr>
				<tr>
					<td>Nội Dung</td><td><input type=text value="<?=$r['noidung']?>" name="noiDung"></td>
				</tr>
			</table>
			<input type=submit name="tao" value="EDIT">
		</div>
	</form>
	</body>
</html>