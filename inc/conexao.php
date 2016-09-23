<?php
        $conexao = mysqli_connect("localhost","root","root","cadastro") or die("Error " . mysqli_error($conexao));
        mysqli_select_db($conexao, "cadastro");
	//$conexao = mysqli_connect("localhost", "root", "root") or print (mysqli_error()); 
	//mysql_select_db("cadastro", $conexao) or print(mysqli_error()); 
	//print "Conexão OK!"; 
	//mysql_close($conecta);
?>