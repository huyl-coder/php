<?php
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	if(isset($_POST["tao"])){
		$r=Edit('noiluutru','ten=?,loai=?,maluutrucha=?,mavach=?',array($_POST['ten'],$_POST['loai'],$_POST['maLuuTruCha'],$_POST['maVach'],$_POST['ma']));
		header("location:dsnlt.php");
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
	<form name=frm method=post action="suanlt.php">
		<input type=hidden value="<?=$_GET['ma']?>" name="ma">
		<?php $r1=queryAll('select * from mavach',array());
			$r=query('select * from noiluutru where ma=?',array($_GET['ma']));
		?>
		<div style="padding-left:250px">
			<table>
				<tr>
					<td><?='Xin Chào.'.$_SESSION["USER"]["email"]?></td>
				</tr>
				<tr>
					<td>Tên Nơi Lưu Trữ</td><td><input type=text value="<?=$r['ten']?>" name="ten"></td>
				</tr>
				<tr>
					<td>Loại</td><td><input type=text value="<?=$r['loai']?>" name="loai"></td>
				</tr>
				<tr>
					<td>Mã Lưu Trữ Cha</td><td>
						<select name="maLuuTruCha">
							<option value=0></option>
							<?php multilLevelBoxSua(0,'',$r['maluutrucha'],$r['ma']); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Mã Vạch</td><td><?php toBox('maVach',$r1,'ma','noidung',$r['mavach']);?></td>
				</tr>
			</table>
			<input type=submit name="tao" value="EDIT">
		</div>
	</form>
	</body>
</html>