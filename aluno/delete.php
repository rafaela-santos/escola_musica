<?php
	session_start();
	include('../inc/verifica_login.php');
	include('../inc/verifica_usuario.php');
	include('../inc/conexao.php');

	$erro = 0;
	$sucesso = 0;
	$nome = '';
	$idade = '';
	$email = '';
	$telefone = '';
        $id_nivel='';
        $login='';
        $senha='';
        $tipo = '';

	if (isset($_POST['deletar'])) {
		
        if ($_POST['deletar']) {
            
                                $sql = "SELECT foto FROM alunos WHERE id_aluno = '".$_POST['deletar']."'";
                                $handle = mysqli_query($conexao, $sql);

				$sql = "DELETE FROM alunos WHERE id_aluno = '".$_POST['deletar']."'";
				$handle = mysqli_query($conexao, $sql);

				if ($handle) {
					$sucesso = 1;
					 header("Location: index.php");
				}else{
					$erro = 1;
					$mensagem = 'Erro ao gravar no banco';
				}
        }
        }
	
        

?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
	<title>Remoção de alunos</title>
	<link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<h1>Remoção de alunos</h1>

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
			$handle = mysqli_query($conexao, $sql);

			if ($handle && mysqli_num_rows($handle) > 0) {

				while($linha = mysqli_fetch_array($handle)) {
					$nome = $linha['nome'];
					$idade = $linha['idade'];
					$email = $linha['email'];
					$telefone = $linha['telefone'];
                                        $id_nivel = $linha['id_nivel'];
                                        $login = $linha['login'];
                                        $senha = $linha['senha'];
                                        $tipo = $linha['tipo'];
				}

			}
		?>
		<input type="hidden" name="deletar" value="<?php echo $_REQUEST['id'] ?>">
		<?php
		}
		?>
		<div class="form-group">
                    <input type="text" name="nome" placeholder="Nome" class="form-control" value="<?php if($nome) echo $nome; ?>" disabled="disabled">
		</div>
		<div class="form-group">
			<input type="idade" name="idade" placeholder="Idade" class="form-control"  value="<?php if($idade) echo $idade; ?>" disabled="disabled">
		</div>
		<div class="form-group">
			<input type="email" name="email" placeholder="Email" class="form-control" value="<?php if($email) echo $email; ?>" disabled="disabled">
		</div>
		<div class="form-group">
			<input type="telefone" name="telefone" placeholder="Telefone" class="form-control" value="<?php if($telefone) echo $telefone; ?>" disabled="disabled">
		</div>
        <div class="form-group">
		<?php
		$sql = "SELECT * FROM niveis";
		$handle = mysqli_query($conexao, $sql);

		if ($handle && mysqli_num_rows($handle) > 0) {
		?>
		<select name="nivel" id="nivel" disabled="disabled">
			<option value="">Selecione o nivel</option>
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
		<div class="form-group">
		<select name="tipo" id="tipo" disabled="disabled">
			<option value="">Selecione o tipo</option>			
			<option value="0" <?php if ($tipo == 0) echo 'selected="selected"'; ?> >Funcionario</option>
			<option value="1" <?php if ($tipo == 1) echo 'selected="selected"'; ?>>Aluno</option>
		</select>

		</div>
        <div class="form-group">
			<input type="login" name="login" placeholder="Login" class="form-control" value="<?php if($login) echo $login; ?>" disabled="disabled">
		</div>
		<?php
		//if (!isset($_REQUEST['id']) && $_REQUEST['id'] == '') {
		?>
        <div class="form-group">
            <input type="password" name="senha" placeholder="Senha" class="form-control" disabled="disabled">
		</div>
		<?php
		//}
		?>
		<div class="preloader" style="display: none;">Enviando dados...</div>

		<input type="submit" name="enviar" value="Deletar" class="btn btn-danger">
	</form>


<script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>



</body>
</html>