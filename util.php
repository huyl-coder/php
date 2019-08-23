<?php
	function query($sql,$param){
		global $db;
		$sth=$db->prepare($sql);
		$sth->execute($param);
		$r=$sth->fetch();
		return $r;
	}
	function queryAll($sql,$param){
		global $db;
		$sth=$db->prepare($sql);
		$sth->execute($param);
		$r=$sth->fetchAll();
		return $r;
	}
	function phantrang($x,$link){
		global $sodong1trang;
		foreach($x as $key=>$value){
			$tongsodong=$value['tong'];
		}
		$sotrang=ceil($tongsodong/$sodong1trang);
		if(isset($_GET['search'])){
			$GET=$_GET['search'];
			for($i=1;$i<=$sotrang;$i++){
				echo "<a href='$link?search=$GET&trang=$i'>Trang $i</a>-"." ";
			}
		}else{
			for($i=1;$i<=$sotrang;$i++){
				echo "<a href='$link?trang=$i'>Trang $i</a>-"." ";
			}
		}
	}
	function phantrang1($x,$link,$ma,$linkma){
		global $sodong1trang;
		foreach($x as $key=>$value){
			$tongsodong=$value['tong'];
		}
		$sotrang=ceil($tongsodong/$sodong1trang);
		if(isset($_GET['search'])){
			$GET=$_GET['search'];
			for($i=1;$i<=$sotrang;$i++){
				echo "<a href='$link?search=$GET&trang=$i&$linkma=$ma'>Trang $i</a>-"." ";
			}
		}else{
			for($i=1;$i<=$sotrang;$i++){
				echo "<a href='$link?trang=$i&$linkma=$ma'>Trang $i</a>-"." ";
			}
		}
	}
	function Insert($tenTable,$tenFiedlist,$param){
		global $db;
		$value='?';
		for($i=1;$i<count($param);$i++){
			$value=$value.',?';
		}
		$sql="insert into $tenTable($tenFiedlist) value($value)";
		$sth=$db->prepare($sql);
		$sth->execute($param);
		$r=$sth->fetchAll();
		return $r;
	}
	function Xoa($tenTable,$param){
		global $db;
		$sql="delete from $tenTable where ma=?";
		$sth=$db->prepare($sql);
		$sth->execute($param);
		$r=$sth->fetchAll();
		return $r;
	}
	function Edit($tenTable,$tenField,$param){
		global $db;
		$sql="update $tenTable set $tenField where ma=?";
		$sth=$db->prepare($sql);
		$sth->execute($param);
		$r=$sth->fetchAll();
		return $r;
	}
	function toBox($name,$r,$fieldMa,$fieldTen,$selectValue){ 
		echo "<select name='$name'>";
			foreach($r as $key=>$value){
				echo "<option ".($selectValue==$value[$fieldMa]?'selected':'')." value=".$value[$fieldMa].">".$value[$fieldTen]."</option>";
			}
		echo "</select>";
	}
	function multilLevelBox($parent,$Dau='',$selectValue){
		$r=queryAll('select * from noiluutru where maluutrucha=?',array($parent));
		foreach($r as $key=>$value){
			echo '<option '.($selectValue==$value['ma']?'selected':'').' value='.$value['ma'].'>'.$Dau.$value['ten'].'</option>';
			multilLevelBox($value['ma'],$Dau.'|---',$selectValue);
		}
	}
	function multilLevelBoxSua($parent,$Dau='',$selectValue,$me){
		$r=queryAll('select * from noiluutru where maluutrucha=?',array($parent));
		foreach($r as $key=>$value){
			if($value['ma']!=$me && $value['maluutrucha']!=$me){
				echo '<option '.($selectValue==$value['ma']?'selected':'').' value='.$value['ma'].'>'.$Dau.$value['ten'].'</option>';
				multilLevelBoxSua($value['ma'],$Dau.'|---',$selectValue,$me);
			}
		}
	}
	function noiLuuTru($me,$mang=array()){
		$r=query('select * from noiluutru where ma=?',array($me));
		$mang[]=$r['ten'];
		if($r['maluutrucha']>0){
			noiLuuTru($r['maluutrucha'],array());
		}
		foreach($mang as $value){
			echo $value.'->';
		}
	}
	function maXacNhan(){
		$ma=rand(1000,9999);
		echo $_SESSION['maXacNhan']=$ma;
	}
	function timKiem($tenLink){
		global $kTr;
		echo "<form action='$tenLink' method='get'>";
				echo "Search: <input type='text' value='$kTr' name='search' />";
				echo '<input type="submit" value="search" />';
		echo "</form>";
	}
	function timKiem1($tenLink,$name,$GET){
		global $kTr;
		echo "<form action='$tenLink' method='get'>";
				echo "<input type=hidden name='$name' value='$GET' />";
				echo "Search: <input type='text' value='$kTr' name='search' />";
				echo '<input type="submit" value="search" />';
		echo "</form>";
	}
	function linkSearch($kTr,$field){
		echo "<a href='?search=$kTr&sort=Asc&dk=$field'>▲</a><a href='?search=$kTr&sort=Desc&dk=$field'>▼</a>";
	}
	function linkSearch1($kTr,$field,$GET,$fieldtim){
		echo "<a href='?search=$kTr&$fieldtim=$GET&sort=Asc&dk=$field'>▲</a><a href='?search=$kTr&$fieldtim=$GET&sort=Desc&dk=$field'>▼</a>";
	}
	function demRow($table,$link){
		$tong=0;
		$r=queryAll("select count(*) as tong from $table",array());
		foreach($r as $key=>$value){
			$tong=$value['tong'];
		}
		if($tong==0){
			echo "Bạn Chưa Có Dữ Liệu".".<a href='$link'>ADD</a>";
			exit;
		}
	}
	function demRowCo2ThamSo($table,$dk,$link,$param){
		$tong=0;
		$r=queryAll("select count(*) as tong from $table where $dk=?",array($param));
		foreach($r as $key=>$value){
			$tong=$value['tong'];
		}
		if($tong==0){
			echo "Bạn Chưa Có Dữ Liệu".".<a href='$link?ma=$param'>ADD</a>";
			exit;
		}
	}
	