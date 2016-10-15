<?php
	session_start();
	include('../inc/verifica_login.php');
	include('../inc/conexao.php');

	$erro = 0;
	$sucesso = 0;

	$nome = '';
	$idade = '';
	$email = '';
	$telefone = '';

	//...Pega o nível do aluno
	$sql = "SELECT * FROM alunos WHERE id_aluno = '".$_SESSION['id']."' ";
	$handle = mysqli_query($conexao, $sql);

	if ($handle && mysqli_num_rows($handle) > 0) {
		while($linha = mysqli_fetch_array($handle)) {
			$nivel = $linha['id_nivel'];
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<h1>Login</h1>

	<?php
		if ($erro == 1) {
	?>
	<div class="errors-msg alert alert-danger"><?php echo $mensagem; ?></div>
	<?php
		}
	?>

	<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" id="form" class="form" >

		<div class="form-group">
		<?php
		$sql = "SELECT * FROM instrumentos WHERE id_nivel = ".$nivel."";
		$handle = mysqli_query( $conexao, $sql);

		if ($handle && mysqli_num_rows($handle) > 0) {
		?>
		<select name="instrumentos" id="instrumentos">
			<option value="">Selecione o instrumento</option>
			<?php
			while($linha = mysqli_fetch_array($handle)) {
			?>
			<option value="<?php echo $linha['id_instrumento'];?>"><?php echo $linha['tipo']; ?></option>
			<?php
			}
			?>
		</select>
		<?php
		}
		?>
		</div>
		<div class="form-group">
		<?php
		$sql = "SELECT * FROM salas";
		$handle = mysqli_query($conexao, $sql);

		if ($handle && mysqli_num_rows($handle) > 0) {
		?>
		<select name="sala" id="sala">
			<option value="">Selecione a sala</option>
			<?php
			while($linha = mysqli_fetch_array($handle)) {
			?>
			<option value="<?php echo $linha['id_sala'];?>"><?php echo $linha['nome']; ?></option>
			<?php
			}
			?>
		</select>
		<?php
		}
		?>
                    <br> <table class="table table-striped">
                 <br><th> Horario Disponivel:</th>
		<tr>
                   <td><input type="checkbox" name="horario" value="1">13:00<br></td>
                 </tr>
                <tr>
                   <td><input type="checkbox" name="horario" value="1">16:30<br></td>
                 </tr>
                </table>

		<div class="preloader" style="display: none;">Enviando dados...</div>

		<input type="submit" name="enviar" value="Enviar dados" class="btn btn-success">
	</form>


<script src="scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

</body>
</html>