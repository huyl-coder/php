<?php
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	$trang=$_GET['trang']??1;
	$sodong1trang=5;
	$from=($trang-1)*$sodong1trang;
	include('sapxep.php');
	if(isset($_GET['search'])){
		$r=queryAll("select * from bandoc where ten like ? or ma=? or ngaytao like ? $order limit $from,$sodong1trang",array('%'.$_GET['search'].'%',$_GET['search'],'%'.$_GET['search'].'%'));
		include('tkbd.php');
	}else{
		$r=queryAll("select * from bandoc $order limit $from,$sodong1trang",array());
	}
?>
<html lang='vi'>
	<body>
		<div style="float:left">
			<?php include('menu.php'); ?>
		</div>
		<div style="padding-left:350px">
			<?php
				timKiem('dsbd.php'); 
				demRow('bandoc','taobd.php');
			?>
		</div>
		<div style="padding-left:250px">
			<table width=800px style="text-align:center;padding-top=150px">
				<tr>
					<?= 'Xin Chào.'.$_SESSION['USER']['email']?>
				</tr>
				<tr>
					<td style="border: 1px solid black">Mã Bạn Đọc<?php linkSearch($kTr,'ma');?></td>
					<td style="border: 1px solid black">Tên Bạn Đọc<?php linkSearch($kTr,'ten');?></td>
					<td style="border: 1px solid black">Ngày Tạo<?php linkSearch($kTr,'ngaytao');?></td>
					<td style="border: 1px solid black">Action</td>
				</tr>
				<?php foreach($r as $key=>$value){?>
				<tr>
					<td style="border: 1px solid black"><?=$value['ma']?></td>
					<td style="border: 1px solid black"><?=$value['ten']?></td>
					<td style="border: 1px solid black"><?=$value['ngaytao']?></td>
					<td style="border: 1px solid black"><a href="suabd.php?ma=<?=$value['ma']?>">EDIT</a>.<a href="xoabd.php?ma=<?=$value['ma']?>">DELETE</a></td>
				</tr>
				<?php } ?>
			</table>
			<button type=submit><a href='taobd.php'>ADD</a></button>
			<?php 
				if(isset($_GET['search'])){
					$x=$search;
				}else{
					$x=queryAll("select count(*) as tong from bandoc",array());
				}
				phantrang($x,'dsbd.php');
			?>
		</div>
	</body>
</html>