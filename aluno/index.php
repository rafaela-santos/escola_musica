<?php
	session_start();
	include('../inc/verifica_login.php');
	include('../inc/verifica_usuario.php');
	include('../inc/conexao.php');
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
	<title>Listagem de alunos</title>
	<link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<h1>Listagem de alunos</h1>
	<a href="./cadastro.php" type="button" class="btn btn-primary btn-lg btn-cadastrar">
	  Cadastrar
	</a>

	<?php
		$sql = "SELECT * FROM alunos";
		$handle = mysqli_query($conexao, $sql);

		if ($handle && mysqli_num_rows($handle) > 0) {
	?>

	<table class="table table-striped">
		<tr>
			<th>Id</th>
			<th>Nome</th>
			<th>Idade</th>
			<th>Email</th>
			<th>Telefone</th>
                        <th>Nivel</th>
                        <th>Login</th>
			<th width="100px;">Ações</th>
		</tr>
		<?php
			while($linha = mysqli_fetch_array($handle)) {
		?>
		<tr>
			<td><?php echo $linha['id_aluno'];?></td>
			<td><?php echo $linha['nome'];?></td>
			<td><?php echo $linha['idade'];?></td>
			<td><?php echo $linha['email'];?></td>
			<td><?php echo $linha['telefone'];?></td>
                        <td><?php echo $linha['id_nivel'];?></td>
                        <td><?php echo $linha['login'];?></td>
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
		echo 'NÃ£o existem registros.';
	}
	?>

<script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>
