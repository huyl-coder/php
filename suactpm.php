<?php
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	if(isset($_POST["tao"])){
		$x=$_POST['maPM'];
		$r=Edit('chitietphieumuon','maphieumuon=?,masach=?,trangthai=?',array($x,$_POST['ten'],$_POST['trangThai'],$_POST['ma']));
		header("location:ctpm.php?trang=1&ma=$x");
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
		<?php 
			$r1=queryAll('select * from sach',array());
			$r=query('select * from chitietphieumuon where ma=?',array($_GET["ma"]));
		?>
		<form name=frm method=post action="suactpm.php">
			<input type=hidden value='<?=$r["ma"]?>' name='ma'>
			<input type=hidden value='<?=$r["maphieumuon"]?>' name='maPM'>
			<table>
				<tr>
					<td><?='Xin Chào.'.$_SESSION["USER"]["email"]?></td>
				</tr>
				<tr>
					<td>Tên Sách</td><td><?=toBox('ten',$r1,'ma','ten',$r['masach'])?></td>
				</tr>
				<tr>
					<td>Trạng Thái</td><td>
						<select name="trangThai">
							<?php
								if($r['trangthai']=='Chưa Trả'){ ?>
									<option value="Chưa Trả">Chưa Trả</option>
									<option value="Đã Trả">Đã Trả</option>
							<?php }else{ ?>
								<option value="Đã Trả">Đã Trả</option>
								<option value="Chưa Trả">Chưa Trả</option>
							<?php } ?>
						</select>
					</td>
				</tr>
			</table>
			<input type=submit name="tao" value="EDIT">
		</form>
	</body>
</html>