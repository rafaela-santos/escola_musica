<?php
	include('../inc/conexao.php');
?>
<?php


function validaUsuario($usuario, $senha) {
  global $_POST;
  $cS = ($_POST['caseSensitive']) ? 'BINARY' : '';

  $nusuario = addslashes($usuario);
  $nsenha = addslashes($senha);

  $sql = "SELECT `id`, `nome` FROM `".$_POST['login']."` WHERE ".$cS." `usuario` = '".$nusuario."' AND ".$cS." `senha` = '".$nsenha."' LIMIT 1";
  $query = mysqli_query($sql, $conexao);
  $resultado = mysqli_fetch_assoc($query, $conexao);

  if (empty($resultado)) {
 
    return false;
  } else {

    $_SESSION['usuarioID'] = $resultado['id']; 
    $_SESSION['usuarioNome'] = $resultado['nome']; 
    if ($_POST['validaSempre'] == true) {
    $_SESSION['usuarioLogin'] = $usuario;
    $_SESSION['usuarioSenha'] = $senha;
    }
    return true;
  }
}
?>
<html>
    <head>
        <title> pagina do usuario</title>
    </head>
    <body>
        <a>ola</a>
    </body>
</html>


