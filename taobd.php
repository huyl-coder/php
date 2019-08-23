<?php
	require_once("db.php");
	require_once("util.php");
	include('chualogin.php');
	if(isset($_POST["tao"])){
		if($_POST['ten']==''){
			echo '<p style="color:red;padding-left:250px">Tên Trống</p>';
		}else{
			$r=Insert('bandoc','ten,ngaytao',array($_POST['ten'],$_POST['ngayTao']));
			header("location:dsbd.php");
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
		<form name=frm method=post action="taobd.php">
		<table>
			<tr>
				<td><?='Xin Chào.'.$_SESSION["USER"]["email"]?></td>
			</tr>
			<tr>
				<td>Tên Bạn Đọc</td><td><input type=text value="" name="ten"></td>
			</tr>
			<tr>
				<td>Ngày Tạo</td><td><input type=date value="" name="ngayTao"></td>
			</tr>
		</table>
		<input type=submit name="tao" value="Thêm mới">
		</form>
	</div>
	</body>
</html>