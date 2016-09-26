<?php
	include('../inc/conexao.php');
?>
<?php
$sql = "DELETE FROM alunos WHERE id_aluno = '".$_REQUEST['id']."'";
$handle = mysqli_query($conexao, $sql);
if($handle){
echo "Registro excluído com sucesso!";
echo "<a href= index.php>";
}
else{
    echo("não é possivel deletar");
}
?>
<input type="hidden" name="deletar" value="<?php echo $_POST['id'] ?>">

