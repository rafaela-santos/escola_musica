<?php
	include('../inc/conexao.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Listagem de instrumentos</title>
	<link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<h1>Listagem de instrumentos</h1>
	<a href="./cadastro_inst.php" type="button" class="btn btn-primary btn-lg btn-cadastrar">
	  Cadastrar
	</a>

	<?php
		$sql = "SELECT * FROM instrumentos";
		$handle = mysqli_query($conexao,$sql);

		if ($handle && mysqli_num_rows($handle) > 0) {
	?>

	<table class="table table-striped">
		<tr>
			<th>Id</th>
			<th>Tipo</th>
			<th>Nivel</th>
			<th>Imagem</th>
			<th width="100px;">Ações</th>
		</tr>
		<?php
			while($linha = mysqli_fetch_array($handle)) {
		?>
		<tr>
			<td><?php echo $linha['id_instrumento'];?></td>
			<td><?php echo $linha['tipo'];?></td>
			<td><?php echo $linha['nivel'];?></td>
                        <td>'.'<img width="100" height="100" src="imagens/foto_inst.jpeg'"/>'.'</td>
			<td>
				<a href="./cadastro_inst.php?id=<?php echo $linha['id_instrumento'];?>">
					<span class="glyphicon glyphicon-pencil"></span>
				</a> 
                                 <a href="./delete_img.php?id=<?php echo $linha['id_instrumento'];?>">
                                        <span class="glyphicon glyphicon-trash"></span>
				</a>
                             
			</td>
		</tr>
		<?php
			}
		?>		

	</table>
	<?php
	}else{
		echo '<br>Não existem registros de instrumentos.';
	}
	?>

<script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>
