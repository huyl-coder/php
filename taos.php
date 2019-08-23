<?php
	require_once("db.php");
	require_once("util.php");
	include('chualogin.php');
	if(isset($_POST["tao"])){
		if($_POST['ten']=='' && $_POST['isbn']==''){
			echo '<p style="color:red;padding-left:250px">Tên Và ISBN Trống</p>';
		}else if($_POST['ten']==''){
			echo '<p style="color:red;padding-left:250px">Tên Trống</p>';
		}else if($_POST['isbn']==''){
			echo '<p style="color:red;padding-left:250px">ISBN Trống</p>';
		}else{
			$r=Insert('sach','ten,ISBN,manhaxuatban,matacgia,mavach,maluutru',array($_POST['ten'],$_POST['isbn'],$_POST['maNXB'],$_POST['maTG'],$_POST['maVach'],$_POST['maLT']));
			header("location:dss.php");
			exit;
		}
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
	<div style="padding-left:250px">
		<?php 
			$r1=queryAll('select * from mavach',array());
			$r2=queryAll('select * from nhaxuatban',array());
			$r3=queryAll('select * from tacgia',array());
		?>
		<form name=frm method=post action="taos.php">
		<table>
			<tr>
				<td><?='Xin Chào.'.$_SESSION["USER"]["email"]?></td>
			</tr>
			<tr>
				<td>Tên Sách</td><td><input type=text value="" name="ten"></td>
			</tr>
			<tr>
				<td>ISBN</td><td><input type=text value="" name="isbn"></td>
			</tr>
			<tr>
				<td>Nhà Xuất Bản</td><td><select name="maNXB">
					<?php foreach($r2 as $key=>$value){?>
						<option value="<?php echo $value['ma'];?>"><?php echo $value['ten'];?></option><?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Tác Giả</td><td><select name="maTG">
					<?php foreach($r3 as $key=>$value){?>
						<option value="<?php echo $value['ma'];?>"><?php echo $value['ten'];?></option><?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Mã Vạch</td><td><select name="maVach">
					<?php foreach($r1 as $key=>$value){?>
						<option value="<?php echo $value['ma'];?>"><?php echo $value['noidung'];?></option><?php } ?>
					</select></td>
			</tr>
			<tr>
				<td>Nơi Lưu Trữ</td><td>
						<select name="maLT">
							<?php multilLevelBox(0,'',''); ?>
						</select>
					</td>
				</tr>
		</table>
		<input type=submit name="tao" value="Thêm mới">
		</form>
	</div>
	</body>
</html>