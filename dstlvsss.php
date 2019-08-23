<?php
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	$trang=$_GET['trang']??1;
	$sodong1trang=5;
	$from=($trang-1)*$sodong1trang;
	include('sapxep.php');
	if(isset($_GET['masach'])==false){
		header('location:dss.php');
	}else{
		if(isset($_GET['search'])){
			$r=queryAll("select theloai.ten as ten,sachvatheloai.ma from sachvatheloai inner join theloai on theloai.ma=sachvatheloai.matheloai 
						where sachvatheloai.masach=? and (ten like ? or sachvatheloai.ma=?)  $order limit $from,$sodong1trang",array($_GET['masach'],'%'.$_GET['search'].'%',$_GET['search']));
			include('tktlvss.php');
		}else{
			$r=queryAll("select theloai.ten as ten,sachvatheloai.ma from sachvatheloai inner join theloai on theloai.ma=sachvatheloai.matheloai
					where sachvatheloai.masach=? $order limit $from,$sodong1trang",array($_GET['masach']));
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
				timKiem1('dstlvsss.php','masach',$_GET['masach']);
				demRowCo2ThamSo('sachvatheloai','masach','taosvtl.php',$_GET['masach']);
			?>
		</div>
		<div style="padding-left:250px">
			<table width=500px style="text-align:center;padding-top=150px">
				<tr>
					<?= 'Xin Chào.'.$_SESSION['USER']['email']?>
				</tr>
				<tr>
					<td style="border: 1px solid black">Mã Sách và Thể Loại<?php linkSearch1($kTr,'ma',$_GET['masach'],'masach');?></td>
					<td style="border: 1px solid black">Tên Thể Loại<?php linkSearch1($kTr,'ten',$_GET['masach'],'masach');?></td>
					<td style="border: 1px solid black">Action</td>
				</tr>
				<?php foreach($r as $key=>$value){ ?>
				<tr>
					<td style="border: 1px solid black"><?=$value['ma']?></td>
					<td style="border: 1px solid black"><?=$value['ten']?></td>
					<td style="border: 1px solid black"><a href="suatlvss.php?ma=<?=$value['ma']?>">EDIT</a>.<a href="xoatlvss.php?ma=<?=$value['ma']?>">DELETE</a></td>
				</tr>
				<?php } ?>
			</table>
			<?php 
				if(isset($_GET['search'])){
					$x=$search;
				}else{
					$x=queryAll("select count(*) as tong from sachvatheloai where sachvatheloai.masach=?",array($_GET['masach']));
				}
				phantrang1($x,'dstlvsss.php',$_GET['masach'],'masach');
	}
			?>
		</div>
	</body>
</html>