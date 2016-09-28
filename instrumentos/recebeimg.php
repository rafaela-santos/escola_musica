<?php
	/*include('../inc/conexao.php');
?>

<html>
<head>
   <title>upload de imagens</title>
</head>
<body>
   <form action="#" method="POST" enctype="multipart/form-data">
      <input type="file" name="fileUpload">
      <input type="submit" value="Enviar">
   </form>
</body>
</html>
 
<?php
   if(isset($_FILES['fileUpload']))
   {
      date_default_timezone_set("Brazil/East"); 
 
      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); 
      $new_name = date("Y.m.d-H.i.s") . $ext; 
      $dir = 'imagens/'; 
 
      move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); 
   }*/
?>
