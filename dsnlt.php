<?php
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	$trang=$_GET['trang']??1;
	$sodong1trang=5;
	$from=($trang-1)*$sodong1trang;
	include('sapxep.php');
	if(isset($_GET['search'])){
		$r=queryAll("select noiluutru.ma,noiluutru.ten,noiluutru.loai,noiluutru.maluutrucha,mavach.noidung from noiluutru 
					inner join mavach on mavach.ma=noiluutru.mavach where noiluutru.ten like ? or noiluutru.ma=? or noiluutru.maluutrucha=? or mavach.noidung=? $order limit $from,$sodong1trang",array('%'.$_GET['search'].'%',$_GET['search'],$_GET['search'],$_GET['search']));
		include('tknlt.php');
	}else{
		$r=queryAll("select noiluutru.ma,noiluutru.ten,noiluutru.loai,noiluutru.maluutrucha,mavach.noidung from noiluutru 
					inner join mavach on mavach.ma=noiluutru.mavach $order limit $from,$sodong1trang",array());
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
				timKiem('dsnlt.php'); 
				demRow('noiluutru','taonlt.php');
			?>
		</div>
		<div style="padding-left:250px">
			<table width=800px style="text-align:center;padding-top=150px">
				<tr>
					<?= 'Xin Chào.'.$_SESSION['USER']['email']?>
				</tr>
				<tr>
					<td style="border: 1px solid black">Mã Nơi Lưu Trữ<?php linkSearch($kTr,'ma');?></td>
					<td style="border: 1px solid black">Tên Nơi Lưu Trữ<?php linkSearch($kTr,'ten');?></td>
					<td style="border: 1px solid black">Loại<?php linkSearch($kTr,'loai');?></td>
					<td style="border: 1px solid black">Mã Lưu Trữ Cha<?php linkSearch($kTr,'maluutrucha');?></td>
					<td style="border: 1px solid black">Mã Vạch<?php linkSearch($kTr,'noidung');?></td>
					<td style="border: 1px solid black">Action</td>
				</tr>
				<?php foreach($r as $key=>$value){?>
				<tr>
					<td style="border: 1px solid black"><?=$value['ma']?></td>
					<td style="border: 1px solid black"><?=$value['ten']?></td>
					<td style="border: 1px solid black"><?=$value['loai']?></td>
					<td style="border: 1px solid black"><?=$value['maluutrucha']?></td>
					<td style="border: 1px solid black"><?=$value['noidung']?></td>
					<td style="border: 1px solid black"><a href="suanlt.php?ma=<?=$value['ma']?>">EDIT</a>.<a href="xoanlt.php?ma=<?=$value['ma']?>">DELETE</a></td>
				</tr>
				<?php } ?>
			</table>
			<button type=submit><a href='taonlt.php'>ADD</a></button>
			<?php 
				if(isset($_GET['search'])){
					$x=$search;
				}else{
					$x=queryAll("select count(*) as tong from noiluutru",array());
				}
				phantrang($x,'dsnlt.php');
			?>
		</div>
	</body>
</html>