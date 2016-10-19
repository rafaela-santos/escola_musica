<?php
	session_start();
	include('../inc/verifica_login.php');
	include('../inc/verifica_usuario.php');
	include('../inc/conexao.php');

	$erro = 0;
	$sucesso = 0;
        $id_sala='';
        $data_inicio='';
        $data_fim='';
        

	if ($_POST) {
		
		//...Valida se esta tudo preenchido
		if ( $_POST['id_sala'] != '' && $_POST['data_inicio'] != ''  && $_POST['data_fim'] != '') {

			if (!isset($_POST['editar'])) {
					$sql = "INSERT INTO salas ( id_sala, data_inicio, data_fim)
							VALUES ( '".$_POST['id_sala']."', '".$_POST['data_inicio']."', '".$_POST['data_fim']."')";
			}else{
				$sql = "UPDATE salas SET  id_sala='".$_POST['id_sala']."', data_inicio='".$_POST['data_inicio']."', data_fim'".$_POST['data_fim']."'WHERE id_reserva = '".$_POST['editar']."'";
			}

			if($erro != 1) {
				$handle = mysqli_query($conexao, $sql);

				if ($handle) {
					$sucesso = 1;
					$mensagem = 'Cadastro realizado com sucesso!';
				}else{
					$erro = 1;
					$mensagem = 'Erro ao gravar no banco';
				}
			
		}else{
			$erro = 1;
			$mensagem = 'preencha tudo!!!';
		}

                }
        }

?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
	<title>Atualização de horarios</title>
	<link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<h1>Atualização de Horarios</h1>

	<a href="./index.php" class="btn btn-primary">
		<i class="glyphicon glyphicon-backward"></i>
	</a>

	<?php
		if ($erro == 1) {
	?>
	<div class="errors-msg alert alert-danger"><?php echo $mensagem; ?></div>
	<?php
		}

		if ($sucesso == 1) {
	?>
	<div class="success-msg alert alert-success"><?php echo $mensagem; ?></div>
	<?php
		}
	?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" id="form" class="form" >
		<?php 
		if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
			$sql = "SELECT * FROM salas WHERE id_sala = '".$_REQUEST['id']."'";
			$handle = mysqli_query($conexao, $sql);

			if ($handle && mysqli_num_rows($handle) > 0) {

				while($linha = mysqli_fetch_array($handle)) {
                                        $id_sala=$linha=['id_sala'];
                                        $data_inicio=$linha['data_inicio'];
                                        $data_fim=$linha['data_fim'];
				}

			}
		?>
		<input type="hidden" name="editar" value="<?php echo $_REQUEST['id'] ?>">
		<?php
		}
		?>
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
                        <option value="<?php echo $linha['id_sala'];?>" <?php if($id_sala == $linha['nome']) echo 'selected="selected"'; else echo ''; ?> ><?php echo $linha['nome']; ?></option><br>
			<?php
			}
			?>
		</select>
		<?php
		}
		?>
                <div class="form-group">
                    <input type="Datetime" name="data_inicio" placeholder="Horario Inicial" class="form-control" value="<?php if($data_inicio) echo $data_inicio; ?>">
		</div>
                <div class="form-group">
                    <input type="Datetime" name="data_fim" placeholder="Horario Final" class="form-control" value="<?php if($data_fim) echo $data_fim; ?>">
		</div>
                </div>
		
		<div class="preloader" style="display: none;">Enviando dados...</div>

		<input type="submit" name="enviar" value="Atualizar" class="btn btn-success">
	</form>


<script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>


</body>
</html>
