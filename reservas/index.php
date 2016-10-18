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
        

	//Pega o nível do aluno
	$sql = "SELECT * FROM alunos WHERE id_aluno = '".$_SESSION['id']."' ";
	$handle = mysqli_query($conexao, $sql);

	if ($handle && mysqli_num_rows($handle) > 0) {
		while($linha = mysqli_fetch_array($handle)) {
			$nivel = $linha['id_nivel'];
		}
	}
?>
<?php

		if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
			$sql = "SELECT * FROM reservas WHERE id_reserva = '".$_REQUEST['id']."'";
			$handle = mysqli_query($conexao, $sql);

			if ($handle && mysqli_num_rows($handle) > 0) {

				while($linha = mysqli_fetch_array($handle)) {
					$id_aluno = $linha['id_aluno'];
					$id_sala = $linha['id_sala'];
                                        $id_instrumento = $linha['id_instrumento'];
                                        $data_inicio = $linha['data_inicio'];
                                        $data_fim = $linha['data_fim'];
				}

			}
                }
		?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
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
		$sql = "SELECT * FROM instrumentos WHERE id_nivel2 = ".$nivel."";
		$handle = mysqli_query($conexao, $sql);

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
		</div>

		<div class="form-group">
			Data inicio
			<input type="text" name="data_inicio" id="data_inicio"> Hora
			<input type="text" name="hora_inicio" id="hora_inicio">

		</div>


		<div class="preloader" style="display: none;">Enviando dados...</div>
                <?php
                    if($_POST[id_aluno]=0){
                ?>
		<input type="submit" name="enviar" value="Enviar dados" class="btn btn-success">
	</form>
        <?php
                  header("Location: sair.php");
                    }
        ?>
        <!--enviar email-->
       <?php
       $email = "coloqueseuemail@seuservidor";
       $mensagem = "select * from alunos where nome= ".$nome."";

        mail ("$email","$mensagem");
       ?>


<script src="scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

</body>
</html>