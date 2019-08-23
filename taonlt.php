<?php
	require_once("db.php");
	require_once("util.php");
	include('chualogin.php');
	if(isset($_POST["tao"])){
		if($_POST['ten']=='' && $_POST['loai']=='' && $_POST['maLuuTruCha']==''){
			echo '<p style="color:red;padding-left:250px">Form Trống</p>';
		}else if($_POST['ten']==''){
			echo '<p style="color:red;padding-left:250px">Tên Trống</p>';
		}else if($_POST['loai']==''){
			echo '<p style="color:red;padding-left:250px">Loại Trống</p>';
		}else if($_POST['maLuuTruCha']==''){
			echo '<p style="color:red;padding-left:250px">Mã Lưu Trữ Cha Trống</p>';
		}else{
			$r=Insert('noiluutru','ten,loai,maluutrucha,mavach',array($_POST['ten'],$_POST['loai'],$_POST['maLuuTruCha'],$_POST['maVach']));
			header("location:dsnlt.php");
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
		<?php $r1=queryAll('select * from mavach',array());
			$r2=queryAll('select * from noiluutru',array());
		?>
		<form name=frm method=post action="taonlt.php">
		<table>
			<tr>
				<td><?='Xin Chào.'.$_SESSION["USER"]["email"]?></td>
			</tr>
			<tr>
				<td>Tên Nơi Lưu Trữ</td><td><input type=text value="" name="ten"></td>
			</tr>
			<tr>
				<td>Loại</td><td><input type=text value="" name="loai"></td>
			</tr>
			<tr>
				<td>Mã Lưu Trữ Cha</td><td>
					<select name="maLuuTruCha">
						<option value=0></option>
						<?php multilLevelBox(0,'',''); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Mã Vạch</td><td>
					<select name="maVach">
						<?php foreach($r1 as $key=>$value){?>
							<option value="<?php echo $value['ma'];?>"><?php echo $value['noidung'];?></option><?php } ?>
					</select>
				</td>
			</tr>
		</table>
		<input type=submit name="tao" value="Thêm mới">
		</form>
	</div>
	</body>
</html>