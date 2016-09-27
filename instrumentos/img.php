<?php
$PicNum = $_GET["PicNum"];

$result=mysql_query("SELECT * FROM instrumentos WHERE foto_inst=$PicNum") or die("Impossível executar a query "); 
	$row=mysql_fetch_object($result); 
	Header( "Content-type: image/gif"); 
	echo $row->foto_inst;

