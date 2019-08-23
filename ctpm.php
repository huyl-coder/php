<?php
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	$trang=$_GET['trang']??1;
	$sodong1trang=5;
	$from=($trang-1)*$sodong1trang;
	include('sapxep.php');
	if(isset($_GET['ma'])==false){
		header('location:dspm.php');
	}else{
		if(isset($_GET['search'])){
			$r=queryAll("select chitietphieumuon.ma,chitietphieumuon.maphieumuon,chitietphieumuon.trangthai,sach.ten from chitietphieumuon inner join sach on sach.ma=chitietphieumuon.masach 
					where chitietphieumuon.maphieumuon=?
					and (sach.ten like ? or chitietphieumuon.ma=? or chitietphieumuon.trangthai=?) $order limit $from,$sodong1trang",array($_GET['ma'],'%'.$_GET['search'].'%',$_GET['search'],$_GET['search']));
			include('tkctpm.php');
		}else{
			$r=queryAll("select chitietphieumuon.ma,chitietphieumuon.maphieumuon,chitietphieumuon.trangthai,sach.ten from chitietphieumuon inner join sach on sach.ma=chitietphieumuon.masach 
					where chitietphieumuon.maphieumuon=?
					$order limit $from,$sodong1trang",array($_GET['ma']));
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
				timKiem1('ctpm.php','ma',$_GET['ma']);
				demRowCo2ThamSo('chitietphieumuon','maphieumuon','taoctpm.php',$_GET['ma']);
			?>
		</div>
		<div style="padding-left:250px">
			<table width=650px style="text-align:center;padding-top=150px">
				<tr>
					<?= 'Xin Chào.'.$_SESSION['USER']['email']?>
				</tr>
				<tr>
					<td style="border: 1px solid black">Mã Chi Tiết Phiếu Mượn<?php linkSearch1($kTr,'ma',$_GET['ma'],'ma');?></td>
					<td style="border: 1px solid black">Mã Phiếu Mượn<?php linkSearch1($kTr,'maphieumuon',$_GET['ma'],'ma');?></td>
					<td style="border: 1px solid black">Tên Sách<?php linkSearch1($kTr,'ten',$_GET['ma'],'ma');?></td>
					<td style="border: 1px solid black">Trạng Thái<?php linkSearch1($kTr,'trangthai',$_GET['ma'],'ma');?></td>
					<td style="border: 1px solid black">Action</td>
				</tr>
				<?php foreach($r as $key=>$value){?>
				<tr>
					<td style="border: 1px solid black"><?=$value['ma']?></td>
					<td style="border: 1px solid black"><?=$value['maphieumuon']?></td>
					<td style="border: 1px solid black"><?=$value['ten']?></td>
					<td style="border: 1px solid black"><?=$value['trangthai']?></td>
					<td style="border: 1px solid black"><a href="suactpm.php?ma=<?=$value['ma']?>">EDIT</a>.<a href="xoactpm.php?ma=<?=$value['ma']?>&idpm=<?=$_GET['ma']?>">DELETE</a></td>
				</tr>
				<?php } ?>
			</table>
			<button type=submit><a href='taoctpm.php?ma=<?=$_GET['ma']?>'>ADD</a></button>
			<?php 
				if(isset($_GET['search'])){
					$x=$search;
				}else{
					$x=queryAll("select count(*) as tong from chitietphieumuon where maphieumuon=?",array($_GET['ma']));
				}
				phantrang1($x,'ctpm.php',$_GET['ma'],'ma');
	}
			?>
		</div>
	</body>
</html>