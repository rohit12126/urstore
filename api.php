<?php
$url=('http://localhost/nce/api.php?action=checksession');
		$data=@file_get_contents($url);
		print_r($data);
?>