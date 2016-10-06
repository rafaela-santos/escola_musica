<?php
	include('../inc/conexao.php');

	$erro = 0;
	$sucesso = 0;
	$nome = '';
	$idade = '';
	$email = '';
	$telefone = '';
        $nivel='';

	if ($_POST) {
		
		//...Valida se está tudo preenchido
		if ($_POST['nome'] != '' && $_POST['idade'] != '' && $_POST['email'] != ''&& $_POST['telefone'] != '' && $_POST['nivel'] != '') {

			if (!isset($_POST['editar'])) {
				$sql = "INSERT INTO alunos (nome, idade, email, telefone, nivel)
						VALUES ('".$_POST['nome']."', '".$_POST['idade']."', '".$_POST['email']."', '".$_POST['telefone']."', '".$_POST['nivel']."')";
			}else{
				$sql = "UPDATE alunos SET nome = '".$_POST['nome']."', idade = '".$_POST['idade']."', email = '".$_POST['email']."', telefone = '".$_POST['telefone']."', nivel = '".$_POST['nivel']."' WHERE id_aluno = '".$_POST['editar']."'";
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
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" id="form" class="form" >
		<?php

		if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
			$sql = "SELECT * FROM alunos WHERE id_aluno = '".$_REQUEST['id']."'";
			$handle = mysqli_query($conexao,$sql);

			if ($handle && mysqli_num_rows($handle) > 0) {

				while($linha = mysqli_fetch_array($handle)) {
					$nome = $linha['nome'];
					$idade = $linha['idade'];
					$email = $linha['email'];
					$telefone = $linha['telefone'];
                                        $nivel = $linha['nivel'];
				}

			}
		?>
		<input type="hidden" name="editar" value="<?php echo $_REQUEST['id'] ?>">
		<?php
		}
		?>
		<div class="form-group">
			<input type="nome" name="nome" placeholder="Nome" class="form-control" value="<?php if($nome) echo $nome; ?>">
		</div>
		<div class="form-group">
			<input type="idade" name="idade" placeholder="Idade" class="form-control" onkeyup="somenteNumeros(this);" value="<?php if($idade) echo $idade; ?>">
		</div>
		<div class="form-group">
			<input type="email" name="email" placeholder="Email" class="form-control" value="<?php if($email) echo $email; ?>">
		</div>
		<div class="form-group">
			<input type="telefone" name="telefone" placeholder="Telefone" class="form-control" value="<?php if($telefone) echo $telefone; ?>">
		</div>
                <div class="form-group">
			<input type="nivel" name="nivel" placeholder="Nivel" class="form-control" value="<?php if($nivel) echo $nivel; ?>">
		</div>

		<div class="preloader" style="display: none;">Enviando dados...</div>

		<input type="submit" name="enviar" value="Enviar dados" class="btn btn-success">
           
                
	</form>


<script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

 <script>
    function somenteNumeros(num) {
        var er = /[^0-9.]/;
        er.lastIndex = 0;
        var campo = num;
        if (er.test(campo.value)) {
          campo.value = "";
        }
    }
 </script>

</body>
</html>
