<?php
	include('../inc/conexao.php');
?>
<?php
$sql = "DELETE FROM instrumentos WHERE id_instrumento = '".$_REQUEST['id']."'";
$handle = mysqli_query($conexao, $sql);
if($handle){
echo "Registro excluído com sucesso!";
}
else{
    echo("não é possivel deletar");
}
?>
<input type="hidden" name="deletar" value="<?php echo $_POST['id'] ?>">
<html>
    <head>
        <link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <br><br><a href="index_inst.php">Voltar</a>
    </body>
    <script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</html>
