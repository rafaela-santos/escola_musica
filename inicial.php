<?php
	session_start();
        include('inc/verifica_login.php');
	include('inc/verifica_usuario.php');
        ?>
<html>
<head><meta charset="UTF-8">
	<title>Pagina inicial</title>
	<link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<center><p><font size=15>Escola Publica de Música</font></p></center>
    <form >
    
        <center><a target="direita" href="http://localhost/escola_musica/aluno/index.php" >Listagem dos alunos</a></center><br>
        <center><a target="direita" href="http://localhost/escola_musica/aluno/cadastro.php">cadastrar aluno</a></center><br>
        <center><a target="direita" href="http://localhost/escola_musica/instrumentos/index_inst.php">listagem de instrumentos</a></center><br>
        <center><a target="direita" href="http://localhost/escola_musica/instrumentos/cadastro_inst.php">cadastrar instrumentos</a></center><br>
        <center><a target="direita" href="http://localhost/escola_musica/reservas/listagem.php">listagem das reservas</a></center><br>
        <center><a target="direita" href="http://localhost/escola_musica/reservas/cadastro_res.php">Atualização de reservas</a></center><br>
           <center><a target="direita" href="http://localhost/escola_musica/reservas/index.php">Fazer reserva</a></center><br>
    </form>
    <script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>

