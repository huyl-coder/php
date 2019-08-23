<?php session_start(); ?>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<?php if(isset($_SESSION["USER"])){
			echo 'Xin Chào.'.$_SESSION["USER"]["email"];
			include('menu.php');
		?>
		<?php }else{
			echo 'Bạn Chưa Đăng Nhập';
		?>
			<ul>
				<li><a href='login.php'>Đăng Nhập</a></li>
			</ul>
		<?php } ?>
	</body>
</html>