<?php
	include('../inc/conexao.php');

	$erro = 0;
	$sucesso = 0;
	$tipo= '';
	$nivel = '';

	if ($_POST) {
		
		//...Valida se está tudo preenchido
		if ($_POST['tipo'] != '' && $_POST['nivel'] != '') {

			if (!isset($_POST['editar'])) {
				$sql = "INSERT INTO instrumentos (tipo, nivel)
						VALUES ('".$_POST['tipo']."', '".$_POST['nivel']."')";
			}else{
				$sql = "UPDATE instrumentos SET tipo = '".$_POST['tipo']."', nivel = '".$_POST['nivel']."' WHERE id_instrumento = '".$_POST['editar']."'";
			}

			$handle = mysqli_query($conexao,$sql);

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
<head>
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
			$handle = mysqli_query($conexao,$sql);

			if ($handle && mysqli_num_rows($handle) > 0) {

				while($linha = mysqli_fetch_array($handle)) {
					$tipo = $linha['tipo'];
					$nivel = $linha['nivel'];
					
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
			<input type="nivel" name="nivel" placeholder="Nivel" class="form-control" value="<?php if($nivel) echo $nivel; ?>">
		</div>
                
                <input type="file" name="fileUpload" class="form-control"><br>
                <?php
                  if(isset($_FILES['fileUpload']))
                    {
                       date_default_timezone_set("Brazil/East"); 

                       $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); 
                       $new_name = date("Y.m.d-H.i.s") . $ext; 
                       $dir = 'imagens/';

                       move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); 
                    }
                  ?>

		<div class="preloader" style="display: none;">Enviando dados...</div>

		<input type="submit" name="enviar" value="Enviar dados" class="btn btn-success">
                
	</form>
         

<script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>


</body>
</html>
