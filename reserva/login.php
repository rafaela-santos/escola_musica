<?php
include('../inc/conexao.php');

?>
<?PHP

$usuario= isset($_POST['usuario']);
$senha=isset($_POST['senha']);

if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
        $sql = "SELECT *  FROM  login WHERE  usuario= '".$_REQUEST['id']."'";
        $handle= mysqli_query($conexao, $sql);

if ($handle && mysqli_num_rows ($handle ) > 0) {
  
    session_start();
     
     $usuario=$_SESSION['usuario'] ;
     $senha=$_SESSION['senha'] ;
}
 
else {
   
   session_destroy();
 
   
    unset ($_SESSION['usuario']);
    unset ($_SESSION['senha']);
   header('location:login.php');
     
}
}
?>

<html>
    <head>
        <title>Login</title>
        <link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
       <form method="post" enctype="multipart/form-data" id="form" class="form" action="valida.php">
       <div class="form-group">
           <label>Login:</label>
			<input type="text" name="login" placeholder="Login" class="form-control" >
		</div>
            <div class="form-group">
                <label>Senha:</label>
			<input type="password" name="senha" placeholder="Senha" class="form-control" >
                      <input type="submit" name="entrar" value="Entrar" class="btn btn-success">
            </div>
        </form>
        
    </body>
</html>

