<?php
    session_start();
    include('../inc/verifica_login.php');
	include('../inc/verifica_usuario.php');
	include('../inc/conexao.php');

	$erro = 0;
	$sucesso = 0;
	$tipo= '';
	$id_nivel = '';
	$foto = '';

	if (isset($_POST['deletar'])) {

		$sql = "SELECT foto FROM instrumentos WHERE id_instrumento = '".$_POST['deletar']."'";
		$handle = mysqli_query($conexao, $sql);

		if ($handle) {
			while($linha = mysqli_fetch_array($handle)) {
				$foto = $linha['foto'];
			}
		}

		$sql = "DELETE FROM instrumentos WHERE id_instrumento = '".$_POST['deletar']."'";
		$handle = mysqli_query($conexao, $sql);

		if ($handle) {
			@unlink('imagens/'.$foto);
			$sucesso = 1;
                        header("Location: index_inst.php");
		}else{
			$erro = 1;
			$mensagem = 'Erro ao gravar no banco';
		}
	}
	
?>


<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
	<title>Remoção de instrumentos</title>
	<link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<h1>Remoçãode instrumentos</h1>

	<a href="./index_inst.php" class="btn btn-primary">
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
	<form method="post" enctype="multipart/form-data"  action="<?php echo $_SERVER['PHP_SELF']?>" id="form" class="form" >
		<?php

		if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
			$sql = "SELECT * FROM instrumentos WHERE id_instrumento = '".$_REQUEST['id']."'";
			$handle = mysqli_query($conexao,$sql);

			if ($handle && mysqli_num_rows($handle) > 0) {

				while($linha = mysqli_fetch_array($handle)) {
					$tipo = $linha['tipo'];
					$id_nivel = $linha['id_nivel2'];
					$foto = $linha['foto'];					
				}

			}
		?>
		<input type="hidden" name="deletar" value="<?php echo $_REQUEST['id'] ?>">
		<?php
		}
		?>
		<div class="form-group">
			<input type="tipo" name="tipo" placeholder="Tipo" class="form-control" value="<?php if($tipo) echo $tipo; ?>" disabled="disabled">
		</div>
		<div class="form-group">
		<?php
		$sql = "SELECT * FROM niveis";
		$handle = mysqli_query($conexao, $sql);

		if ($handle && mysqli_num_rows($handle) > 0) {
		?>
		<select name="nivel" id="nivel" disabled="disabled">
			<option value="">Selecione o nível</option>
			<?php
			while($linha = mysqli_fetch_array($handle)) {
			?>
			<option value="<?php echo $linha['id_nivel'];?>" <?php if ($id_nivel == $linha['id_nivel']
	) echo 'selected="selected"'; ?>> <?php echo $linha['nivel']; ?></option>
			<?php
			}
			?>
		</select>
		<?php
		}
		?>
		</div>

	    <div class="form-group">
			<img width="100" height="100" src="./imagens/<?php echo $foto;?>" />
		</div>

		<div class="preloader" style="display: none;">Enviando dados...</div>

		<input type="submit" name="enviar" value="Deletar" class="btn btn-danger">
                
	</form>
         

<script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>


</body>
</html>

