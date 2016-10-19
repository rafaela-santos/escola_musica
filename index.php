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
					if($_SESSION['tipo_usuario'] == 0){
                                            header('location: inicial.php');
                                        }else{
                                            header('location: reservas');
                                        }
                                
					
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
<head><meta charset="UTF-8">
	<title>Login</title>
	<link href="scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<center><h1>Login</h1></center>
        
	<?php
		if ($erro == 1) {
	?>
	<div class="errors-msg alert alert-danger"><?php echo $mensagem; ?></div>
	<?php
		}
	?>

<center> <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" id="form" class="form">
                    <input type="text" name="login" placeholder="Login" class="control-input"><br>
		</div><br>
		<div class="control-group">
                    <input type="password" name="senha" placeholder="Senha" class="control-input"><br>
                </div><br>

		<div class="preloader" style="display: none;">Enviando dados...</div>

		<input type="submit" name="enviar" value="Entrar" class="btn btn-success">
    </form></center>
        

<script src="scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

</body>
</html>