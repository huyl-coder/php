<?php
	require_once("db.php");
	require_once("util.php");
	include('chualogin.php');
	if(isset($_POST["tao"])){
		if($_POST['noiDung']==''){
			echo '<p style="color:red;padding-left:250px">Nội Dung Trống</p>';
		}else{
			$r=Insert('mavach','noidung',array($_POST['noiDung']));
			header("location:dsmv.php");
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
		<form name=frm method=post action="taomv.php">
		<table>
			<tr>
				<td><?='Xin Chào.'.$_SESSION["USER"]["email"]?></td>
			</tr>
			<tr>
				<td>Nội Dung</td><td><input type=text value="" name="noiDung"></td>
			</tr>
		</table>
		<input type=submit name="tao" value="Thêm mới">
		</form>
	</div>
	</body>
</html>