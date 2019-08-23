<?php
	require_once('db.php');
	require_once('util.php');
	include('chualogin.php');
	if(isset($_POST['doiMK'])){
		if($_POST['mKC']=='' && $_POST['mKM']=='' && $_POST['mXN']==''){
			echo '<p style="color:red;padding-left:250px">From Trống</p>';
		}else if($_POST['mKC']==''){
			echo '<p style="color:red;padding-left:250px">Chưa Nhập Mật Khẩu Cũ</p>';
		}else if($_POST['mKM']==''){
			echo '<p style="color:red;padding-left:250px">Chưa Nhập Mật Khẩu Mới</p>';
		}else if($_POST['mXN']==''){
			echo '<p style="color:red;padding-left:250px">Chưa Nhập Mã Xác Nhận</p>';
		}else if(md5($_POST['mKC'])!=$_SESSION['USER']['matkhau']){
			echo '<p style="color:red;padding-left:250px">Mật Khẩu Cũ Sai</p>';
		}else if($_POST['mLKM']!=$_POST['mKM']){
			echo '<p style="color:red;padding-left:250px">Mật Khẩu Mới Không Trùng Khớp</p>';
		}else if($_POST['mXN']!=$_SESSION['maXacNhan']){
			echo '<p style="color:red;padding-left:250px">Mã Xác Nhận Sai</p>';
		}else{
			$r1=Edit('taikhoan','matkhau=?',array(md5($_POST['mKM']),$_SESSION['USER']['ma']));
			session_destroy();
			header("location:login.php");
			exit;
		}
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
		<div style='padding-left:250px'>
			<form name=frm method=post action='dmk.php'>
				<table>
					<tr>
						<?='Xin Chào.'.$_SESSION['USER']['email']?>
					</tr>
					<tr>
						<td>Nhập Mật Khẩu Cũ</td><td><input type=password value='' name='mKC'></td>
					</tr>
					<tr>
						<td>Nhập Mật Khẩu Mới</td><td><input type=password value='' name='mKM'></td>
					</tr>
					<tr>
						<td>Nhập Lại Mật Khẩu Mới</td><td><input type=password value='' name='mLKM'></td>
					</tr>
					<tr>
						<td>Mã Xác Nhận</td><td><input type=text value='' name='mXN'></td><td style='background:black;color:white'><?php maXacNhan();?></td>
					</tr>
				</table>
				<input type=submit name="doiMK" value="Đổi">
			</form>
		</div>
	</body>
</html>