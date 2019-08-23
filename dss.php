<?php
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	$trang=$_GET['trang']??1;//?? là ko có lấy cái sau
	$sodong1trang=5;
	$from=($trang-1)*$sodong1trang;
	include('sapxep.php');
	if(isset($_GET['search'])){
		$r=queryAll("select sach.ISBN,sach.ma,sach.ten,nhaxuatban.ten as ten1,tacgia.ten as ten2,mavach.noidung,noiluutru.ma as malt
					,(select group_concat(theloai.ten) from theloai inner join sachvatheloai on theloai.ma=sachvatheloai.matheloai where sachvatheloai.masach=sach.ma) as theloai
					from sach left join nhaxuatban on nhaxuatban.ma=sach.manhaxuatban
					left join tacgia on tacgia.ma=sach.matacgia
					left join mavach on mavach.ma=sach.mavach 
					left join noiluutru on noiluutru.ma=sach.maluutru
					where sach.ten like ? or sach.ma=? or sach.ISBN=? or nhaxuatban.ten like ? or tacgia.ten like ? or mavach.noidung=? or noiluutru.ten=? $order limit $from,$sodong1trang",array('%'.$_GET['search'].'%',$_GET['search'],$_GET['search'],'%'.$_GET['search'].'%','%'.$_GET['search'].'%',$_GET['search'],$_GET['search']));
		include('tks.php');
	}else{
		$r=queryAll("select sach.ISBN,sach.ma,sach.ten,nhaxuatban.ten as ten1,tacgia.ten as ten2,mavach.noidung,noiluutru.ma as malt 
				,(select group_concat(theloai.ten) from theloai inner join sachvatheloai on theloai.ma=sachvatheloai.matheloai where sachvatheloai.masach=sach.ma) as theloai
				from sach left join nhaxuatban on nhaxuatban.ma=sach.manhaxuatban
				left join tacgia on tacgia.ma=sach.matacgia
				left join mavach on mavach.ma=sach.mavach 
				left join noiluutru on noiluutru.ma=sach.maluutru
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
				timKiem('dss.php'); 
				demRow('sach','taos.php');
			?>
		</div>
		<div style="padding-left:250px">
			<table width=1100px style="text-align:center;padding-top=150px">
				<tr>
					<?= 'Xin Chào.'.$_SESSION['USER']['email']?>
				</tr>
				<tr>
					<td style="border: 1px solid black">Mã Sách<?php linkSearch($kTr,'ma');?></td>
					<td style="border: 1px solid black">Tên Sách<?php linkSearch($kTr,'ten');?></td>
					<td style="border: 1px solid black">ISBN<?php linkSearch($kTr,'ISBN');?></td>
					<td style="border: 1px solid black">Nhà Xuất Bản<?php linkSearch($kTr,'ten1');?></td>
					<td style="border: 1px solid black">Tác Giả<?php linkSearch($kTr,'ten2');?></td>
					<td style="border: 1px solid black">Mã Vạch<?php linkSearch($kTr,'noidung');?></td>
					<td style="border: 1px solid black">Nơi Lưu Trữ<?php linkSearch($kTr,'malt');?></td>
					<td style="border: 1px solid black">Thể Loại<?php linkSearch($kTr,'theloai');?></td>
					<td style="border: 1px solid black">Action</td>
				</tr>
				<?php foreach($r as $key=>$value){?>
				<tr>
					<td style="border: 1px solid black"><?=$value['ma']?></td>
					<td style="border: 1px solid black"><?=$value['ten']?></td>
					<td style="border: 1px solid black"><?=$value['ISBN']?></td>
					<td style="border: 1px solid black"><?=$value['ten1']?></td>
					<td style="border: 1px solid black"><?=$value['ten2']?></td>
					<td style="border: 1px solid black"><?=$value['noidung']?></td>
					<td style="border: 1px solid black"><?php noiLuuTru($value['malt'],array());?></td>
					<td style="border: 1px solid black"><?=$value['theloai']?></td>
					<td style="border: 1px solid black"><a href="taosvtl.php?ma=<?=$value['ma']?>">Chọn Thể loại</a>.<a href="dstlvsss.php?masach=<?=$value['ma']?>">Sửa&XóaTL</a>.<a href="suas.php?ma=<?=$value['ma']?>">EDIT</a>.<a href="xoas.php?id=<?=$value['ma']?>">DELETE</a></td>
				</tr>
				<?php } ?>
			</table>
			<button type=submit><a href='taos.php'>ADD</a></button>
			<?php
				if(isset($_GET['search'])){
					$x=$search;
				}else{
					$x=queryAll("select count(*) as tong from sach",array());
				}
				phantrang($x,'dss.php');
			?>
		</div>
	</body>
</html>