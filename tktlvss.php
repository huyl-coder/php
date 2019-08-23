<?php
	$search=queryAll("select count(*) as tong from sachvatheloai inner join theloai on theloai.ma=sachvatheloai.matheloai 
					where  sachvatheloai.masach=? and (theloai.ten like ? or sachvatheloai.ma=?)",array($_GET['masach'],'%'.$_GET['search'].'%',$_GET['search']));
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
					<?php timKiem1('dstlvsss.php','masach',$_GET['masach']) ;?>
				</div>
			</body>
		</html>
	<?php		
		echo '<p style="color:red;padding-left:300px">Không Tìm Thấy Kết Quả !</p>';
		exit;
		}
	?>