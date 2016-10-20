<?php
	session_start();
	include('../inc/verifica_login.php');
	include('../inc/conexao.php');

	$erro = 0;
	$sucesso = 0;

	$nome = '';
	$idade = '';
	$email = '';
	$telefone = '';
        
        $id_aluno='';
        $id_sala='';
        $id_instrumento='';
        $data_inicio='';
        $data_fim='';
        
                if ($_POST) {
		
		//...Valida se esta tudo preenchido
		if ( $_POST['id_aluno'] != '' && $_POST['id_sala'] != '' && $_POST['id_instrumento'] != ''  && $_POST['data_inicio'] != '' && $_POST['data_fim'] != '') {

			if (!isset($_POST['editar'])) {
					$sql = "INSERT INTO reservas ( id_aluno, id_sala, id_instrumento, data_inicio, data_fim)
							VALUES ( '".$_POST['id_aluno']."', '".$_POST['id_sala']."', '".$_POST['id_instrumento']."', '".$_POST['data_inicio']."', '".$_POST['data_fim']."')";
				}else{
					$erro = 1;
					$mensagem = 'preencha tudo!';
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
	
	//Pega o nível do aluno
	$sql = "SELECT * FROM alunos WHERE id_aluno = '".$_SESSION['id']."' ";
	$handle = mysqli_query($conexao, $sql);

	if ($handle && mysqli_num_rows($handle) > 0) {
		while($linha = mysqli_fetch_array($handle)) {
			$nivel = $linha['id_nivel'];
                }
        }
        
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
	<title>Reserva</title>
	<link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<h1>Reserva</h1>

	<?php
		if ($erro == 1) {
	?>
	<div class="errors-msg alert alert-danger"><?php echo $mensagem; ?></div>
	<?php
		}
	?>

	<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" id="form" class="form" >
                    <?php 
		if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
			$sql = "SELECT * FROM reservas WHERE id_reserva = '".$_REQUEST['id']."'";
			$handle = mysqli_query($conexao, $sql);

			if ($handle && mysqli_num_rows($handle) > 0) {

				while($linha = mysqli_fetch_array($handle)) {
                                        $id_aluno=$linha=['id_aluno'];
                                        $id_sala=$linha=['id_sala'];
                                        $id_instrumento=$linha=['id_instrumento'];
                                        $data_inicio=$linha['data_inicio'];
                                        $data_fim=$linha['data_fim'];
				}

			}
                }
		?>
		<div class="form-group">
		<?php
		$sql = "SELECT * FROM instrumentos WHERE id_nivel2 = ".$nivel."";
		$handle = mysqli_query($conexao, $sql);

		if ($handle && mysqli_num_rows($handle) > 0) {
		?>
		<select name="instrumentos" id="instrumentos">
			<option value="">Selecione o instrumento</option>
			<?php
			while($linha = mysqli_fetch_array($handle)) {
			?>
			<option value="<?php echo $linha['id_instrumento'];?>"><?php echo $linha['tipo']; ?></option>
			<?php
			}
			?>
		</select>
		<?php
		}
		?>
		</div>
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
			<option value="<?php echo $linha['id_sala'];?>"><?php echo $linha['nome']; ?></option>
			<?php
			}
			?>
		</select>
		<?php
		}
		?>
		</div>
                        <?php 
                        $sql= "SELECT * FROM salas";
                        $handle = mysqli_query($conexao, $sql);
                        if ($handle && mysqli_num_rows($handle) > 0) {
                        while($linha = mysqli_fetch_array($handle)) {
                        ?>
		<table class="table table-striped">
                    <tr>
			<td><?php echo $linha['id_sala'];?></td>
			<td><?php echo $linha['data_inicio'];?></td>
			<td><?php echo $linha['data_fim'];?></td>
		</tr>
                <?php
                        }
                 ?>
                </table>
                <?php
                        }else{
                            echo "<br>Não existe registro de horarios";
                        }
                        ?>


		<div class="preloader" style="display: none;">Enviando dados...</div>
                
		<input type="submit" name="enviar" value="Enviar dados" class="btn btn-success" onclick="Sair()" >
	</form>

     <script language="JavaScript">
   function Sair()
   {
     document.nome_formulario.action="sair.php";
     document.forms.nome_formulario.submit();
   }
      </script>


<script src="scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

</body>
</html>