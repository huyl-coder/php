<?php
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	if(isset($_POST["tao"])){
		$r=Edit('sachvatheloai','matheloai=?',array($_POST['theLoai'],$_POST['ma']));
		header("location:dss.php");
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
	<form name=frm method=post action="suatlvss.php">
		<input type=hidden value="<?=$_GET['ma']?>" name="ma">
		<?php $r=query('select * from sachvatheloai where ma=?',array($_GET['ma']));
			$r1=queryAll('select * from theloai',array());
		?>
		<div style="padding-left:250px">
			<table>
				<tr>
					<td><?='Xin Chào.'.$_SESSION["USER"]["email"]?></td>
				</tr>
				<tr>
					<td>Thể Loại</td><td><?php toBox('theLoai',$r1,'ma','ten',$r['matheloai']);?></td>
				</tr>
			</table>
			<input type=submit name="tao" value="EDIT">
		</div>
	</form>
	</body>
</html>