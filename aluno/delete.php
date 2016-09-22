<?php
	include('../inc/conexao.php');
?>
<?php
if (isset($_POST['id']) && $_POST['id'] != '') {
/*$id = $_GET['id']; 

mysql_query("DELETE FROM alunos WHERE id='".$_POST['id']."'"); 

echo "Registro excluído com sucesso!" or die ("não é possivel deletar");
}*/
$sql = mysql_query("DELETE FROM alunos WHERE id_aluno = '".$_POST['id']."'");
$handle = mysql_query($sql);
echo "Registro excluído com sucesso!" 
or die ("não é possivel deletar");
?>
<input type="hidden" name="deletar" value="<?php echo $_POST['id'] ?>">
<?php
}
?>
