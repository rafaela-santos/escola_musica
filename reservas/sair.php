<!--enviar email-->
       <?php
       $to= "rafaelalorysantos@gmail.com";
       $destino= "FROM: rafaelalorysantos@gmail.com";
       $assunto="reservas";
       $mensagem = "teste";
       mail ("$to","$destino","$assunto","$mensagem");
        if($destino){
                echo "Sua mensagem foi enviada com sucesso.";
        }else{
            echo "erro ao enviar email";
        }
        ?>

<html>
    <head><meta charset="UTF-8">
        <title>Reserva feita</title>
    </head>
    <body>
        <form method="post" action="index.php" id="form" class="form" >
        <a href="./index.php" class="btn btn-primary">
		<i class="glyphicon glyphicon-backward"></i>
	</a>
        Sua reserva foi registrada.
        <input name="Sair" type="button" id="button" value="Sair" /> 
      <!--  </form>
        <form action="http://localhost/escola_musica/index.php" method="post" name="form">

        <input type="hidden" name="recipient" value="rafaelalorysantos@gmail.co">

        <input type="hidden" name="subject" value="titulo do email">

        <input type="hidden" name="redirect" value="http://localhost/escola_musica/sair.php">

        <input type="submit" name="Submit" value="Enviar">

        </form>-->

    </body>
</html>




