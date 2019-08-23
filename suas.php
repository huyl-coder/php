<?php
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	if(isset($_POST["tao"])){
		$r=Edit('sach','ten=?,ISBN=?,manhaxuatban=?,matacgia=?,mavach=?,maluutru=?',array($_POST['ten'],$_POST['isbn'],$_POST['maNXB'],$_POST['maTG'],$_POST['maVach'],$_POST['maLT'],$_POST['ma']));
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
		<form name=frm method=post action="suas.php">
			<input type=hidden value="<?=$_GET['ma']?>" name='ma'>
			<?php 
				$r=query('select * from sach where ma=?',array($_GET['ma']));
				$r1=queryAll('select * from mavach',array());
				$r2=queryAll('select * from nhaxuatban',array());
				$r3=queryAll('select * from tacgia',array());
			?>
			<table>
				<tr>
					<td><?='Xin Chào.'.$_SESSION["USER"]["email"]?></td>
				</tr>
				<tr>
					<td>Tên Sách</td><td><input type=text value="<?=$r['ten']?>" name="ten"></td>
				</tr>
				<tr>
					<td>ISBN</td><td><input type=text value="<?=$r['ISBN']?>" name="isbn"></td>
				</tr>
				<tr>
					<td>Nhà Xuất Bản</td><td><?php toBox('maNXB',$r2,'ma','ten',$r["manhaxuatban"]);?></td>
				</tr>
				<tr>
					<td>Tác Giả</td><td><?php toBox('maTG',$r3,'ma','ten',$r["matacgia"]);?></td>
				</tr>
				<tr>
					<td>Mã Vạch</td><td><?php toBox('maVach',$r1,'ma','noidung',$r["mavach"]);?></td>
				</tr>
				<tr>
					<td>Nơi Lưu Trữ</td><td>
						<select name="maLT">
							<?php multilLevelBox(0,'',$r['maluutru']); ?>
						</select>
					</td>	
				</tr>
			</table>
			<input type=submit name="tao" value="EDIT">
		</form>
	</body>
</html>