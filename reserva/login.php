<?php
include('../inc/conexao.php');

$login='';
$password='';
//if(mysqli_num_rows ($result) > 0 ){
if ($result = mysqli_query($conn, "SELECT COUNT(*) FROM users WHERE name='" . $username . "'")) { 
$row = $result->fetch_assoc(); 
$_SESSION['login'] = $login;
$_SESSION['senha'] = $senha;
}
else{
	unset ($_SESSION['login']);
	unset ($_SESSION['senha']);
	
	}
?>
<html>
    <head>
        <title>Login</title>
        <link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <form method="post" enctype="multipart/form-data" id="form" class="form" >
       <div class="form-group">
           <label>|Login:</label>
			<input type="text" name="login" placeholder="Login" class="form-control" >
		</div>
            <div class="form-group">
                <label>Senha:</label>
			<input type="password" name="senha" placeholder="Senha" class="form-control" >
                        <input type="submit" value="Entrar"  />
            </div>
        </form>
    </body>
</html>
