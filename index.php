<?php
	session_start();

	include('inc/conexao.php');

	$erro = 0;
	$sucesso = 0;

	$nome = '';
	$idade = '';
	$email = '';
	$telefone = '';

	if ($_POST) {
		if ($_POST['login'] != '' && $_POST['senha'] != ''){
			
			$sql = "SELECT * FROM alunos WHERE login = '".$_POST['login']."' AND senha = '".md5($_POST['senha'])."'";
			$handle = mysqli_query($conexao, $sql);

			if ($handle && mysqli_num_rows($handle) > 0) {
				while($linha = mysqli_fetch_array($handle)) {
                                        
                                        
                                        $_SESSION['id'] = $linha['id_aluno'];
					$_SESSION['login'] = $linha['login'];
					$_SESSION['nome'] = $linha['nome'];
					$_SESSION['tipo_usuario'] = $linha['tipo'];
					
					header('location: reservas');
				}
				
			}else{
				$erro = 1;
				$mensagem = 'Login incorreto.'; 
			}
			echo $sql;

		}else{
			$erro = 1;
			$mensagem = 'Login incorreto.'; 
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
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
			<input type="text" name="login" placeholder="Login" class="form-control">
		</div>
		<div class="form-group">
			<input type="password" name="senha" placeholder="Senha" class="form-control">
		</div>

		<div class="preloader" style="display: none;">Enviando dados...</div>

		<input type="submit" name="enviar" value="Enviar dados" class="btn btn-success">
	</form>


<script src="scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

</body>
</html>