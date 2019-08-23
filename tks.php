<?php
	$search=queryAll("select count(*) as tong
					from sach left join nhaxuatban on nhaxuatban.ma=sach.manhaxuatban
					left join tacgia on tacgia.ma=sach.matacgia
					left join mavach on mavach.ma=sach.mavach 
					left join noiluutru on noiluutru.ma=sach.maluutru
					where sach.ten like ? or sach.ma=? or sach.ISBN=? or nhaxuatban.ten like ? or tacgia.ten like ? or mavach.noidung=? or noiluutru.ten=?",array('%'.$_GET['search'].'%',$_GET['search'],$_GET['search'],'%'.$_GET['search'].'%','%'.$_GET['search'].'%',$_GET['search'],$_GET['search']));
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
						timKiem('dss.php');
					?>
				</div>
			</body>
		</html>
	<?php		
		echo '<p style="color:red;padding-left:300px">Không Tìm Thấy Kết Quả !</p>';
		exit;
		}
	?>