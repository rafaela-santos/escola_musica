<?php
    session_start();
    include('../inc/verifica_login.php');
	include('../inc/verifica_usuario.php');
	include('../inc/conexao.php');

	$erro = 0;
	$sucesso = 0;
	$tipo= '';
	$id_nivel = '';

	if ($_POST) {
		
		//Valida se esta tudo preenchido
		if ($_POST['tipo'] != '' && $_POST['nivel'] != '') {

			if(isset($_FILES['fileUpload'])) { 

               $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); 
               $new_name = date("Y.m.d-H.i.s") . $ext; 
               $dir = 'imagens/';

               move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); 
            }

			if (!isset($_POST['editar'])) {
				$sql = "INSERT INTO instrumentos (tipo, id_nivel2, foto)
						VALUES ('".$_POST['tipo']."', '".$_POST['nivel']."', '".$new_name."')";
			}else{
				$sql = "UPDATE instrumentos SET tipo = '".$_POST['tipo']."', id_nivel2 = '".$_POST['nivel']."', foto = '".$new_name."' WHERE id_instrumento = '".$_POST['editar']."'";
			}

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
?>


<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
	<title>Cadastro de instrumentos</title>
	<link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<h1>Cadastro de instrumentos</h1>

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
			$handle = mysqli_query($conexao, $sql);

			if ($handle && mysqli_num_rows($handle) > 0) {

				while($linha = mysqli_fetch_array($handle)) {
					$tipo = $linha['tipo'];
					$id_nivel = $linha['id_nivel2'];
					
				}

			}
		?>
		<input type="hidden" name="editar" value="<?php echo $_REQUEST['id'] ?>">
		<?php
		}
		?>
		<div class="form-group">
			<input type="tipo" name="tipo" placeholder="Tipo" class="form-control" value="<?php if($tipo) echo $tipo; ?>">
		</div>
		<div class="form-group">
		<?php
		$sql = "SELECT * FROM niveis";
		$handle = mysqli_query($conexao, $sql);

		if ($handle && mysqli_num_rows($handle) > 0) {
		?>
		<select name="nivel" id="nivel">
			<option value="">Selecione o nível</option>
			<?php
			while($linha = mysqli_fetch_array($handle)) {
			?>
			<option value="<?php echo $linha['id_nivel'];?>" <?php if($id_nivel == $linha['id_nivel']) echo 'selected="selected"'; else echo ''; ?> ><?php echo $linha['nivel']; ?></option>
			<?php
			}
			?>
		</select>
		<?php
		}
		?>
		</div>
                
        <input type="file" name="fileUpload" class="form-control"><br>

		<div class="preloader" style="display: none;">Enviando dados...</div>

		<input type="submit" name="enviar" value="Enviar dados" class="btn btn-success">
                
	</form>
         

<script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>


</body>
</html>
