<?php
	include('../inc/conexao.php');
?>

</html>
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
  /* if(isset($_FILES['fileUpload']))
   {
      date_default_timezone_set("Brazil/East"); 
 
      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); 
      $new_name = date("Y.m.d-H.i.s") . $ext; 
      $dir = 'imagens/'; 
 
      move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); 
   }*/
 /*if(isset($_FILES['foto_inst']))
   {
      date_default_timezone_set("Brazil/East"); 
      $tiposPermitidos= array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
      $ext = strtolower(substr($_FILES['foto_inst']['name'],-4)); 
      $new_name = date("Y.m.d-H.i.s") . $ext; 
      $arqname=$_FILES['foto_inst']['tmp_name'];
      $arqType = $_FILES['arquivo']['type'];
      $arqError=$_FILES['arquivo']['error'];
      
      if ($arqError == 0) {
            if (array_search($arqname, $tiposPermitidos) === false) {
                echo 'O tipo de arquivo enviado é inválido!';
        
        } else {
                $dir = 'fotos/'; 
                $extensao = strtolower(end(explode('.', $arqname)));
                $nome = time() . '.' . $extensao;
                $nomeMySQL = mysql_real_escape_string($_POST['foto_inst']);
                move_uploaded_file($arqname, $dir.$new_name); 
   }
      }
   }*/
   if(isset($_FILES['fileUpload']))
   {
      date_default_timezone_set("Brazil/East"); 
 
      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); 
      $new_name = date("Y.m.d-H.i.s") . $ext; 
      if($ext==0){
          echo "não há nenhum arquivo";
          
      }else{
      $dir = 'fotos/'; 
      move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); 
      echo "arquivo salvo";
      }
   }

?>
