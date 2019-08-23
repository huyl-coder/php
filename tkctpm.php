<?php
	$search=queryAll("select count(*) as tong from chitietphieumuon inner join sach on sach.ma=chitietphieumuon.masach 
					where chitietphieumuon.maphieumuon=?
					and (sach.ten like ? or chitietphieumuon.ma=? or chitietphieumuon.trangthai=?) ",array($_GET['ma'],'%'.$_GET['search'].'%',$_GET['search'],$_GET['search']));
	$tong='';
	foreach($search as $key=>$value){
		$tong=$value['tong'];
	}
	if($tong<=0 && $_GET['search'] != ''){ ?>
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
					?>
				</div>
			</body>
		</html>
	<?php		
		echo '<p style="color:red;padding-left:300px">Không Tìm Thấy Kết Quả !</p>';
		exit;
		}
	?>
</html>