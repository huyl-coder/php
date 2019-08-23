<?php
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	if(isset($_POST["tao"])){
		$r=Edit('phieumuon','mabandoc=?,ngaymuon=?,ngaytra=?,trangthai=?,mavach=?',array($_POST['maBD'],$_POST['ngayMuon'],$_POST['ngayTra'],$_POST['trangThai'],$_POST['maVach'],$_POST['ma']));
		header("location:dspm.php");
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
		<form name=frm method=post action="suapm.php">
			<input type=hidden value="<?=$_GET['ma']?>" name="ma">
			<?php 
				$r=query('select * from phieumuon where ma=?',array($_GET['ma']));
				$r1=queryAll('select * from mavach',array());
				$r2=queryAll('select * from bandoc',array());
			?>
			<table>
				<tr>
					<td><?='Xin Chào.'.$_SESSION["USER"]["email"]?></td>
				</tr>
				<tr>
					<td>Bạn Đọc</td><td><?=toBox('maBD',$r2,'ma','ten',$r['mabandoc'])?></td>
				</tr>
				<tr>
					<td>Ngày Mượn</td><td><input type=date value="<?=$r['ngaymuon']?>" name="ngayMuon"></td>
				</tr>
				<tr>
					<td>Ngày Trả</td><td><input type=date value="<?=$r['ngaytra']?>" name="ngayTra"></td>
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
				<tr>
					<td>Mã Vạch</td><td><?=toBox('maVach',$r1,'ma','noidung',$r['mavach'])?></td>
				</tr>
			</table>
			<input type=submit name="tao" value="EDIT">
		</form>
	</body>
</html>