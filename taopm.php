<?php
	require_once("db.php");
	require_once("util.php");
	include('chualogin.php');
	if(isset($_POST["tao"])){
		if($_POST['ngayMuon']=='' && $_POST['ngayTra']==''){
			echo '<p style="color:red;padding-left:250px">Ngày Mượn Và Ngày Trả Trống</p>';
		}else if($_POST['ngayMuon']==''){
			echo '<p style="color:red;padding-left:250px">Ngày Mượn Trống</p>';
		}else if($_POST['ngayTra']==''){
			echo '<p style="color:red;padding-left:250px">Ngày Trả Trống</p>';
		}else{
			$r=Insert('phieumuon','mabandoc,ngaymuon,ngaytra,trangthai,mavach',array($_POST['maBD'],$_POST['ngayMuon'],$_POST['ngayTra'],$_POST['trangThai'],$_POST['maVach']));
			header("location:dspm.php");
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
			$r2=queryAll('select * from bandoc',array());
		?>
		<form name=frm method=post action="taopm.php">
			<table>
				<tr>
					<td><?='Xin Chào.'.$_SESSION["USER"]["email"]?></td>
				</tr>
				<tr>
					<td>Bạn Đọc</td><td><select name="maBD">
						<?php foreach($r2 as $key=>$value){?>
							<option value="<?php echo $value['ma'];?>"><?php echo $value['ten'];?></option><?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Ngày Mượn</td><td><input type=date value="" name="ngayMuon"></td>
				</tr>
				<tr>
					<td>Ngày Trả</td><td><input type=date value="" name="ngayTra"></td>
				</tr>
				<tr>
					<td>Trạng Thái</td><td>
						<select name="trangThai">
							<option value="Đã Trả">Đã Trả</option>
							<option value="Chưa Trả">Chưa Trả</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Mã Vạch</td><td><select name="maVach">
						<?php foreach($r1 as $key=>$value){?>
							<option value="<?php echo $value['ma'];?>"><?php echo $value['noidung'];?></option><?php } ?>
						</select></td>
				</tr>
			</table>
			<input type=submit name="tao" value="Thêm mới">
		</form>
	</div>
	</body>
</html>