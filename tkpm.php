<?php
	$search=queryAll("select count(*) as tong from phieumuon 
					inner join bandoc on bandoc.ma=phieumuon.mabandoc
					inner join mavach on mavach.ma=phieumuon.mavach
					where bandoc.ten like ? or phieumuon.ma=? or phieumuon.ngaymuon=? or phieumuon.ngaytra=? or phieumuon.trangthai=? or mavach.noidung=?",array('%'.$_GET['search'].'%',$_GET['search'],$_GET['search'],$_GET['search'],$_GET['search'],$_GET['search']));
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
						timKiem('dspm.php');
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