<?php
	require_once("db.php");
	require_once("util.php");
	include('chualogin.php');
	if(isset($_POST["tao"])){
		if($_POST['ten']==''){
			echo '<p style="color:red;padding-left:250px">Tên Trống</p>';
		}else{
			$r=Insert('tacgia','ten',array($_POST['ten']));
			header("location:dstg.php");
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
		<form name=frm method=post action="taotg.php">
		<table>
			<tr>
				<td><?='Xin Chào.'.$_SESSION["USER"]["email"]?></td>
			</tr>
			<tr>
				<td>Tên Tác Giả</td><td><input type=text value="" name="ten"></td>
			</tr>
		</table>
		<input type=submit name="tao" value="Thêm mới">
		</form>
	</div>
	</body>
</html>