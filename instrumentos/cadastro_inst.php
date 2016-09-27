<?php
	include('../inc/conexao.php');

	$erro = 0;
	$sucesso = 0;
	$tipo= '';
	$nivel = '';
        $foto_inst = '';

	if ($_POST) {
		
		//...Valida se está tudo preenchido
            $imagem= array();
            $mostra=$_FILES['foto_inst'];
            if ($_POST['tipo'] != '' && $_POST['nivel'] != '' && $_FILES['foto_inst'] != '') {
			if (!isset($_POST['editar'])) {
				$sql = "INSERT INTO instrumentos (tipo, nivel, foto_inst)
                                    VALUES ('".$_POST['tipo']."', '".$_POST['nivel']."', '".$_FILES['foto_inst']."')";
			}else{
				$sql = "UPDATE instrumentos SET tipo = '".$_POST['tipo']."', nivel = '".$_POST['nivel']."', foto_inst = '".$_FILES['foto_inst']."' WHERE id_instrumento = '".$_POST['editar']."'";
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
<?php
/*  if ($_POST) {
	
	$nome = $_POST['tipo'];
	$email = $_POST['nivel'];
	$foto_inst = $_FILES["foto_inst"];
	
	if (!empty($foto["tipo"])) {
		
		$largura = 150;
		$altura = 180;
		$tamanho = 1000;
 
    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
     	   $error[1] = "Isso não é uma imagem.";
   	 	} 

		$dimensoes = getimagesize($foto["tmp_name"]);

		if($dimensoes[0] > $largura) {
			$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
		}

		if($dimensoes[1] > $altura) {
			$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
		}
	
		if($foto["size"] > $tamanho) {
   		 	$error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
		}

		if (count($error) == 0) {
		
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
 
        	$foto_inst = md5(uniqid(time())) . "." . $ext[1];
 
        	$caminho_imagem = "fotos/" . $foto_inst;
 
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
		
			$sql = mysql_query("INSERT INTO instrumentos VALUES ('', '".$tipo."', '".$nivel."', '".$foto_inst."')");

			if ($sql){
				echo "Você foi cadastrado com sucesso.";
			}
		}
	
		if (count($error) != 0) {
			foreach ($error as $erro) {
				echo $erro . "<br />";
			}
		}
	}
}*/

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
	<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>" id="form" class="form" >
		<?php

		if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
			$sql = "SELECT * FROM instrumentos WHERE id_instrumento = '".$_REQUEST['id']."'";
			$handle = mysqli_query($conexao,$sql);

			if ($handle && mysqli_num_rows($handle) > 0) {

				while($linha = mysqli_fetch_array($handle)) {
					$tipo = $linha['tipo'];
					$nivel = $linha['nivel'];
					$foto_inst = $linha['foto_inst'];
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
                <div class="form-group">
                <input type="file" name="foto_inst" placeholder="Imagem" value="<?php if($mostra) echo $mostra; ?>">
                </div>

		<div class="preloader" style="display: none;">Enviando dados...</div>

		<input type="submit" name="enviar" value="Enviar dados" class="btn btn-success">
           
                
	</form>


<script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>


</body>
</html>
