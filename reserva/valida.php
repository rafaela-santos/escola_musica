<?php
	include('../inc/conexao.php');
?>
<?php

?>
<html>
    <head>
       <title>Fazer reserva</title>
        <link href="../scripts/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
       <h1> Reservas </h1>
       	<table class="table table-striped">
            <th> Nivel:</th>
            <th> Instrumento:</th>
            <th> Horario:</th>
            <th> Sala:</th>
            <tr>
                <td><input type="checkbox" name="vehicle" value="1">1<br></td>
                <td><input type="checkbox" name="vehicle" value="2">Violão<br></td>
                <td><input type="checkbox" name="vehicle" value="3">13:00<br></td>
                <td> <input type="checkbox" name="vehicle" value="4">1<br></td>
            </tr>
            <tr>
                <td><input type="checkbox" name="vehicle" value="1">2<br></td>
                <td><input type="checkbox" name="vehicle" value="2">Tambor<br></td>
                <td><input type="checkbox" name="vehicle" value="3">15:00<br></td>
                <td> <input type="checkbox" name="vehicle" value="4">2<br></td>
            </tr>
            <tr>
                <td><input type="checkbox" name="vehicle" value="1">3<br></td>
                <td><input type="checkbox" name="vehicle" value="2">Gaita<br></td>
                <td><input type="checkbox" name="vehicle" value="3">16:30<br></td>
                <td> <input type="checkbox" name="vehicle" value="4">3<br></td>
            </tr>
            <tr>
                <td><input type="checkbox" name="vehicle" value="1">4<br></td>
                <td><input type="checkbox" name="vehicle" value="2">Piano<br></td>
                <td><input type="checkbox" name="vehicle" value="3">18:30<br></td>
                <td> <input type="checkbox" name="vehicle" value="4">4<br></td>
            </tr>     
        </table>
           <input type="submit" name="enviar" value="Enviar dados" class="btn btn-success">
    </body>
     <script src="../scripts/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</html>


