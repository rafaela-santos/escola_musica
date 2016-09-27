
<?php
include('../inc/conexao.php');
$result=mysql_query("SELECT * FROM PESSOA") or die("Impossível executar a query");
while($row=mysql_fetch_object($result)) { 
echo "<img src='img.php?PicNum=$row->foto_inst' \">"; 
}
 ?>