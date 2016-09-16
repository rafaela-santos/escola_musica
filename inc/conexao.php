<?php
	$conexao = mysql_connect("localhost", "root", "root") or print (mysql_error()); 
	mysql_select_db("cadastro", $conexao) or print(mysql_error()); 
	//print "Conexão OK!"; 
	//mysql_close($conecta);
?>