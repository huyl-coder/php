<?php
	require_once("db.php");
	require_once("util.php");
	include('chualogin.php');
	if(isset($_POST["tao"])){
		$r1=queryAll('select * from sachvatheloai where sachvatheloai.masach=?',array($_POST['ma']));
		foreach($r1 as $key=>$value){
			if($value['matheloai']==$_POST['maTL']){
				echo '<p style="color:red">Thể Loại Đã Có</p>';
				exit;
			}
		}
		$r=Insert('sachvatheloai','matheloai,masach',array($_POST['maTL'],$_POST['ma']));
		header("location:dss.php");
		exit;
	}
?>
<html lang='vi'>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
	<div style="float:left">
		<?php
			include('menu.php');
		?>
	</div>
	<div style="padding-left:250px">
		<?php 
			$r1=queryAll('select * from theloai',array());
		?>
		<form name=frm method=post action="taosvtl.php">
			<input type=hidden value="<?=$_GET['ma']?>" name="ma">
			<table>
				<tr>
					<td><?='Xin Chào.'.$_SESSION["USER"]["email"]?></td>
				</tr>
				<tr>
					<td>Thể Loại</td><td><select name="maTL">
						<?php foreach($r1 as $key=>$value){?>
							<option value="<?php echo $value['ma'];?>"><?php echo $value['ten'];?></option><?php } ?>
						</select>
					</td>
				</tr>
			</table>
			<input type=submit name="tao" value="Thêm mới">
		</form>
	</div>
	</body>
</html>