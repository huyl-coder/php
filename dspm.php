<?php
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	$trang=$_GET['trang']??1;
	$sodong1trang=5;
	$from=($trang-1)*$sodong1trang;
	include('sapxep.php');
	if(isset($_GET['search'])){
		$r=queryAll("select phieumuon.ma,bandoc.ten,phieumuon.ngaymuon,phieumuon.ngaytra,phieumuon.trangthai,mavach.noidung from phieumuon 
					inner join bandoc on bandoc.ma=phieumuon.mabandoc
					inner join mavach on mavach.ma=phieumuon.mavach
					where bandoc.ten like ? or phieumuon.ma=? or phieumuon.ngaymuon=? or phieumuon.ngaytra=? or phieumuon.trangthai=? or mavach.noidung=? $order limit $from,$sodong1trang",array('%'.$_GET['search'].'%',$_GET['search'],$_GET['search'],$_GET['search'],$_GET['search'],$_GET['search']));
		include('tkpm.php');
	}else{
		$r=queryAll("select phieumuon.ma,bandoc.ten,phieumuon.ngaymuon,phieumuon.ngaytra,phieumuon.trangthai,mavach.noidung from phieumuon 
				inner join bandoc on bandoc.ma=phieumuon.mabandoc
				inner join mavach on mavach.ma=phieumuon.mavach
				$order limit $from,$sodong1trang",array());
	}
?>
<html lang='vi'>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<div style="float:left">
			<?php include('menu.php'); ?>
		</div>
		<div style="padding-left:350px">
			<?php
				timKiem('dspm.php'); 
				demRow('phieumuon','taopm.php');
			?>
		</div>
		<div style="padding-left:250px">
			<table width=1000px style="text-align:center;padding-top=150px">
				<tr>
					<?= 'Xin Chào.'.$_SESSION['USER']['email']?>
				</tr>
				<tr>
					<td style="border: 1px solid black">Mã Phiếu Mượn<?php linkSearch($kTr,'ma');?></td>
					<td style="border: 1px solid black">Bạn Đọc<?php linkSearch($kTr,'ten');?></td>
					<td style="border: 1px solid black">Ngày Mượn<?php linkSearch($kTr,'ngaymuon');?></td>
					<td style="border: 1px solid black">Ngày Trả<?php linkSearch($kTr,'ngaytra');?></td>
					<td style="border: 1px solid black">Trạng Thái<?php linkSearch($kTr,'trangthai');?></td>
					<td style="border: 1px solid black">Mã Vạch<?php linkSearch($kTr,'noidung');?></td>
					<td style="border: 1px solid black">Action</td>
				</tr>
				<?php foreach($r as $key=>$value){?>
				<tr>
					<td style="border: 1px solid black"><?=$value['ma']?></td>
					<td style="border: 1px solid black"><?=$value['ten']?></td>
					<td style="border: 1px solid black"><?=$value['ngaymuon']?></td>
					<td style="border: 1px solid black"><?=$value['ngaytra']?></td>
					<td style="border: 1px solid black"><?=$value['trangthai']?></td>
					<td style="border: 1px solid black"><?=$value['noidung']?></td>
					<td style="border: 1px solid black"><a href="ctpm.php?ma=<?=$value['ma']?>">Chi tiết</a>.<a href="suapm.php?ma=<?=$value['ma']?>">EDIT</a>.<a href="xoapm.php?ma=<?=$value['ma']?>">DELETE</a></td>
				</tr>
				<?php } ?>
			</table>
			<button type=submit><a href='taopm.php'>ADD</a></button>
			<?php 
				if(isset($_GET['search'])){
					$x=$search;
				}else{
					$x=queryAll("select count(*) as tong from phieumuon",array());
				}
				phantrang($x,'dspm.php');
			?>
		</div>
	</body>
</html>