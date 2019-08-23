<?php
	require_once("db.php");
	require_once("util.php");
	include('chualogin.php');
	if(isset($_POST["tao"])){
		$r=Insert('chitietphieumuon','maphieumuon,masach,trangthai',array($_POST['ma'],$_POST['maSach'],$_POST['trangThai']));
		header("location:ctpm.php?ma=".$_POST['ma']);
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
	<div style="padding-left:250px">
		<?php
			$r1=queryAll('select * from sach',array());
		?>
		<form name=frm method=post action="taoctpm.php">
			<input type=hidden value="<?=$_GET['ma']?>" name='ma'>
			<table>
				<tr>
					<td><?='Xin Chào.'.$_SESSION["USER"]["email"]?></td>
				</tr>
				<tr>
					<td>Sách</td><td><select name="maSach">
							<?php foreach($r1 as $key=>$value){?>
							<option value="<?=$value['ma']?>"><?=$value['ten']?></option><?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Trạng Thái</td><td>
						<select name="trangThai">
							<option value="Đã Trả">Đã Trả</option>
							<option value="Chưa Trả">Chưa Trả</option>
						</select>
					</td>
				</tr>
			</table>
			<input type=submit name="tao" value="Thêm mới">
		</form>
	</div>
	</body>
</html>