<?php
	include('../inc/conexao.php');
?>
<html>
    <head>
        <title>Fazer reserva</title>
        <link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h1> login </h1>
      <?php
		$sql = "SELECT * FROM login";
		$handle = mysqli_query($conexao,$sql);

		if ($handle && mysqli_num_rows($handle) > 0) {
	?>

	<table class="table table-striped">
		<tr>
			<th>Usuario</th>
			<th>Senha</th>
			
			<th width="100px;">Ações</th>
		</tr>
		<?php
			while($linha = mysqli_fetch_array($handle)) {
		?>
		<tr>
			<td><?php echo $linha['usuario'];?></td>
			<td><?php echo $linha['senha'];?></td>
			<td>
				<a href="./cadastro.php?id=<?php echo $linha['id_aluno'];?>">
					<span class="glyphicon glyphicon-pencil"></span>
				</a> 
                                 <a href="./delete.php?id=<?php echo $linha['id_aluno'];?>">
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
		echo 'Não existem registros.';
	}
	?>
    </body>
    <script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</html>