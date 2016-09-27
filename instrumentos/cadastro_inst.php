<?php
	include('../inc/conexao.php');

	$erro = 0;
	$sucesso = 0;
	$tipo= '';
	$nivel = '';
        $foto_inst = '';

	if ($_POST) {
		
		//...Valida se está tudo preenchido
		if ($_POST['tipo'] != '' && $_POST['nivel'] != '' && $_POST['foto_inst'] != '') {

			if (!isset($_POST['editar'])) {
				$sql = "INSERT INTO instrumentos (tipo, nivel)
						VALUES ('".$_POST['tipo']."', '".$_POST['nivel']."', '".$_POST['foto_inst']."')";
			}else{
				$sql = "UPDATE instrumentos SET tipo = '".$_POST['tipo']."', nivel = '".$_POST['nivel']."', foto_inst = '".$_POST['foto_inst']."' WHERE id_instrumento = '".$_POST['editar']."'";
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
if(!empty($foto_inst["foto_inst"])){
    $largura=150;
    $altura=180;
    $tamanho=1000;
}
if(!preg_match("/^imagem/(pjpeg|jpeg|png|gif|bmp)$/", $foto_inst["type"])){
    $error[1]= "isso não é uma imagem";
    $dimensoes=  getimagesize($foto_inst["tpm_name"]);
    if($dimensoes[0]> $largura){
        $error[2]="a largura da imagem não deve ultrapassar".$largura. "pixels";
    }
    if($dimensoes[0]> $altura){
        $error[3]="a altura da imagem não deve ultrapassar".$altura. "pixels";  
    }
        if($foto_inst("size")> $tamanho){
        $error[4]="a imagem deve ter no máximo".$tamanho. "bytes";
        }
        if(count($error)==0){
            preg_match("/.(pjpeg|jpeg|png|gif|bmp)$/i", $foto_inst["fotoinst"], $ext);
        }
    
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de alunos</title>
	<link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<h1>Cadastro de alunos</h1>

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
	<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>" id="form" class="form" >
		<?php

		if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
			$sql = "SELECT * FROM instrumentos WHERE id_instrumento = '".$_REQUEST['id']."'";
			$handle = mysqli_query($conexao,$sql);

			if ($handle && mysqli_num_rows($handle) > 0) {

				while($linha = mysqli_fetch_array($handle)) {
					$nome = $linha['tipo'];
					$idade = $linha['nivel'];
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
                <input type="foto_inst" name="foto_inst" placeholder="Imagem" syze="50" class="form-control" value="<?php if($foto_inst) echo $foto_inst; ?>">
                </div>
   

		<div class="preloader" style="display: none;">Enviando dados...</div>

		<input type="submit" name="enviar" value="Enviar dados" class="btn btn-success">
           
                
	</form>


<script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>


</body>
</html>
