<?php
	session_start();
	include('../inc/verifica_login.php');
	include('../inc/verifica_usuario.php');
	include('../inc/conexao.php');
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
	<title>Listagem de reservas</title>
	<link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<h1>Listagem de alunos</h1>

	<?php
		$sql = "SELECT * FROM reservas";
		$handle = mysqli_query($conexao, $sql);

		if ($handle && mysqli_num_rows($handle) > 0) {
	?>

	<table class="table table-striped">
		<tr>
			<th>Id da reserva</th>
			<th>Id do aluno</th>
			<th>Id da sala</th>
			<th>Id do instrumeto</th>
                        <th>hora de inicio</th>
                        <th>horario do fim</th>
			<th width="100px;">Ações</th>
		</tr>
		<?php
			while($linha = mysqli_fetch_array($handle)) {
		?>
		<tr>
			<td><?php echo $linha['id_reserva'];?></td>
			<td><?php echo $linha['id_aluno'];?></td>
			<td><?php echo $linha['id_sala'];?></td>
			<td><?php echo $linha['id_instrumento'];?></td>
			<td><?php echo $linha['data_inicio'];?></td>
                        <td><?php echo $linha['data_fim'];?></td>
			<td>
				<!--<a href="./cadastro.php?id=<?php echo $linha['id_aluno'];?>">
					<span class="glyphicon glyphicon-pencil"></span>
				</a> 
                                 <a href="./delete.php?id=<?php echo $linha['id_aluno'];?>">
                                        <span class="glyphicon glyphicon-trash"></span>
				</a>-->
                             
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

<script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>

