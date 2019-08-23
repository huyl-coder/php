<?php
	session_start();
	require_once('db.php');
	require_once('util.php');
	if(isset($_SESSION['USER'])==false){
		if(isset($_POST['login'])){
			$r=query("select * from taikhoan where email=?",array($_POST["email"]));
			if($_POST['email'] == '' || $_POST['matKhau']==''){
				echo '<p style="color:red">Email Hoac Mat Khau Trống</p>';
			}else if(md5($_POST['matKhau'])==$r['matkhau']){
				$_SESSION["USER"]=$r;
				header("location:home.php");
				exit;
			}else{
				echo '<p style="color:red">Email Hoac Mat Khau Khong Dung</p>';
			}
		}
?>
<html lang='vi'>
	<head>
		<title>Đăng Nhập</title>
		<meta charset="UTF-8">
	</head>
	<body>
	<form name=frm method=post action="login.php">
		<table>
			<tr>
				<td>Email</td><td><input type=text value="" name="email"></td>
			</tr>
			<tr>
				<td>Mật Khẩu</td><td><input type=password value="" name="matKhau"></td>
			</tr>
		</table>
			<input type=submit name="login" value="LOGIN">
			<button type=submit><a href='home.php'>Về Trang Chủ</a></button>
	</form>
	<?php }else{
		header("location:home.php");
	} ?>
	</body>
</html>