<?php
	$order='';
	if(isset($_GET['dk'])){
		$order='order by '.$_GET['dk'].' '.$_GET['sort'];
	}